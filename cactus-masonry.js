/*** NOTE ***/
/* This script will be minified in future updates */

function Cactus_Masonry(showLoader, infiniteScroll, postsPerPage, id, IE9, width, softGutter, fitWidth, forceAutoWidth)
{	
	/************************/
	/*	PUBLIC VARIABLES	*/
	/************************/
	var that = this;
	
	//Important
	that.IE9 = IE9;  //IE 8 or below
	
	/************************/
	/*	UTILITY FUNCTIONS	*/
	/************************/
	that.verifyBool = function (b)
	{
		if(b === true || b === "true" || (b !== -1 && b !== false && b !== "false")) return true;
		return false;
	}
	
	that.returnIfTrue = function (test, textIfTrue, textIfFalse)
	{
		if(textIfFalse === 'undefined') textIfFalse = "";
		if(test === true) return textIfTrue;
		return textIfFalse;
	}
	
	//The greatest common denominator
	that.gcd = function (o)
	{
		if(!o.length) return 0;
		for(var r, a, i = o.length - 1, b = o[i]; i;) for(a = o[--i]; r = a % b; a = b, b = r);
		return b;
	}
	
	//Get the widths of columns.  This is used to set the col_width to the highest amount possible to improve masonry performance
	that.getColumnWidth = function ()
	{
		var colWidths = new Array();
		var els = null;
		if(that.IE9) els = document.querySelector('.masonry_brick'); //Slow but supported by IE8
		else els = document.getElementsByClassName('masonry_brick'); //getElements has much better performance
		for(var o = 0; o < els.length; o++)
		{
			colWidths.push(els[o].offsetWidth);
		}
		return that.gcd(colWidths);	
	}

	/************************/
	/*	PRIVATE VARIABLES	*/
	/************************/
	that.elems = Array();
	that.pageStart = 0;
	that.pageEnd = 0;
	that.pagePosition = 0;
	that.lastImageOffset = 0;
	that.loading = false;
	that.opts = {
					lines: 13, // The number of lines to draw
					length: 0, // The length of each line
					width: 6, // The line thickness
					radius: 12, // The radius of the inner circle
					corners: 1, // Corner roundness (0..1)
					rotate: 0, // The rotation offset
					direction: 1, // 1: clockwise, -1: counterclockwise
					color: '#DFDFDF', // #rgb or #rrggbb or array of colors
					speed: 1.2, // Rounds per second
					trail: 100, // Afterglow percentage
					shadow: false, // Whether to render a shadow
					hwaccel: false, // Whether to use hardware acceleration
					className: 'spinner', // The CSS class to assign to the spinner
					zIndex: 2e9, // The z-index (defaults to 2000000000)
					top: '50%', // Top position relative to parent
					left: '50%' // Left position relative to parent
				};
	that.showLoader = that.verifyBool(showLoader);	
	that.infiniteScroll = that.verifyBool(infiniteScroll);
	that.postsPerPage = postsPerPage;
	that.id = id;
	that.width = width;
	that.softGutter = softGutter;
	that.fitWidth = that.verifyBool(fitWidth);
	that.forceAutoWidth = that.verifyBool(forceAutoWidth);
	
	that.spinner = null;
	that.spinbox = null;
	that.spincontainer = null;
	
	/************************/
	/*	PUBLIC FUNCTIONS	*/
	/************************/
	
	this.drawGallery = function (elems)
	{
		that.elems = elems;
		//Handle initiating the loading box
		if(that.showLoader)
		{
			that.spinner = new Spinner(that.opts);
			if(!that.IE9) 
			{
				that.spinbox = document.getElementById('MPG_Spin_Box');
				that.spinbox.style.width = '50px';
				that.spinbox.appendChild(that.spinner.spin().el);
			}
			that.spincontainer = document.getElementById('MPG_Loader_Container');
			that.spincontainer.style.display = 'block';
			that.spincontainer.style.opacity = '1';
		}
		//If there is anything to display - Start loading
		if(that.elems.length > 0)//that.elems = array of HTML elements containing masonry objects to add
		{
			that.loading = true;	
			that.pageEnd = that.returnIfTrue(that.infiniteScroll, Math.min(that.elems.length, that.postsPerPage), that.elems.length);
			that.add_elem(0);//Start infinite scroll
		}
		else if(that.showLoader) //Otherwise, nothing to see here
		{
			document.getElementById('MPG_Loader_Container').style.display = 'none';
		}	
	}
	
	/************************/
	/*	PRIVATE FUNCTIONS	*/
	/************************/		
	//Add an element to the masonry display
	that.add_elem = function(count)
	{
		that.loading = true;
		document.getElementById(that.id).appendChild(that.elems[count]);//Add element
		imagesLoaded('#'+that.id, function() //Once the appended image has loaded:
		{//Apply masonry to newly loaded image
			var msnry = new Masonry('#'+that.id, {"columnWidth": that.returnIfTrue(that.forceAutoWidth, that.getColumnWidth(), that.returnIfTrue((that.width !== 'auto'), ".masonry_brick", that.getColumnWidth())), "itemSelector": ".masonry_brick", "gutter": that.softGutter, "isFitWidth": that.fitWidth});
			that.elems[count].style.transition = 'opacity 0.5s';
			that.elems[count].style.opacity = '1';
			if(count+1 < that.elems.length && (!that.infiniteScroll || that.pagePosition < that.pageEnd))
			{
				if(that.endOfPage(that.getOffsetTop(that.elems[count])))
				{
					that.pageEnd = that.returnIfTrue(that.infiniteScroll, Math.min(that.elems.length, that.pageEnd+1), that.elems.length);
				}
				that.pagePosition++;
				that.add_elem(count+1);
				if(that.showLoader) document.getElementById('MPG_Loader').innerHTML = 'Loading (' + ((((count-that.pageStart)/(that.pageEnd-that.pageStart))*100) | 0) + '%)';
			}
			else
			{
				if(that.showLoader)
				{
					document.getElementById('MPG_Loader').innerHTML = 'Loaded (100%)';
					document.getElementById('MPG_Loader_Container').style.opacity = '0';
					if(that.IE9)
					{
						document.getElementById('MPG_Loader_Container').style.visibility = 'hidden';
					}	
					if(!that.IE9) that.spinner.stop();
				}
				if(that.infiniteScroll)
				{
					if(that.pagePosition+1 < that.elems.length)
					{
						that.pageStart = that.pageEnd;
						that.pageEnd = Math.min(that.pageStart + that.postsPerPage,that.elems.length);
						that.lastImageOffset = that.getOffsetTop(that.elems[count]);
						window.onscroll = that.scrollListener;
					}
				}
				that.loading = false;
			}
		});
	}
	
	that.getOffsetTop = function(element)
	{
		var y = 0;
		while(element && !isNaN(element.offsetLeft) && !isNaN(element.offsetTop))
		{
			y += element.offsetTop - element.scrollTop;
			element = element.offsetParent;	
		}
		return y;
	}
	that.endOfPage = function(datum)
	{
		if(typeof(window.innerHeight) == 'number') return (window.pageYOffset + window.innerHeight*1.25 >= datum);//Everyone
		return (document.documentElement.scrollTop + document.documentElement.clientHeight*1.25 >= datum);//IE8
	}
	
	that.scrollListener = function(e)
	{
		that.loadNextSection();
	}

	that.loadNextSection = function()
	{
		if(that.endOfPage(that.lastImageOffset))
		{
			that.loading = true;
			if(that.showLoader)
			{
				if(!that.IE9) document.getElementById('MPG_Spin_Box').appendChild(that.spinner.spin().el);
				else document.getElementById('MPG_Loader_Container').style.visibility = 'visible';
				document.getElementById('MPG_Loader_Container').style.opacity = '1';
			}
			window.onscroll = null;
			that.add_elem(that.pagePosition);
		}
	}
}