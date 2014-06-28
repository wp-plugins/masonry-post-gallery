<?php
/**
 * @package Masonry Post Gallery
 * @version 0.1b
 */
/*
 * Plugin Name: Masonry Post Gallery
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A masonry style gallery of posts
 * Version: 0.1b
 * Author: N. E - Cactus Computers
 * Author URI: http://www.cactuscomputers.com.au
 * License: Licenced to Thrill
 */
 /*  Copyright 2014  Cactus Computers  (email : cactus@cactuscomputers.com.au)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Add Shortcode
add_shortcode("masonry-post-gallery", "masonrypostgallery_handler");
add_action('wp_head','prep_masonry');
add_action('wp_enqueue_scripts', 'prep_scripts');


function prep_masonry()
{
	?>
	<script type="text/javascript">
		//DOM Array
		elems = Array();
		
	</script>
	<?php
}

function prep_scripts()
{
	wp_register_script('Masonry','/wp-content/plugins/masonry-post-gallery/masonry.pkgd.min.js');
	wp_register_script('ImagesLoaded','/wp-content/plugins/masonry-post-gallery/imagesloaded.pkgd.min.js');
	wp_register_script('Spin','/wp-content/plugins/masonry-post-gallery/spin.min.js');
	wp_enqueue_script('Masonry');
	wp_enqueue_script('ImagesLoaded');
	wp_enqueue_script('Spin');
}
//Define that shit

	
	

$MPG_QUALITY_DEF = "thumbnail";  //thumbnail, medium, large, full

$MPG_IMAGE_COLUMNS_DEF = false;
$MPG_MAX_WIDTH_DEF = "300px";
$MPG_MAX_HEIGHT_DEF = "300px";
$MPG_WIDTH_DEF = "auto";
$MPG_HEIGHT_DEF = "auto";

$MPG_HOVER_COLOR = "#ffffff";
$MPG_HOVER_INTENSITY = "0.5";

$MPG_MASONRY_DEF = true;

$MPG_HORIZONTAL_SPACING = 10;
$MPG_VERTICAL_SPACING = 10;

$MPG_FIT_WIDTH = true;

$MPG_BORDER_WEIGHT = "0px";
$MPG_BORDER_COLOR = "#000000";

$MPG_POST_CATEGORY = "";
$MPG_POST_ORDER = "DESC";
$MPG_POST_ORDERBY = "post_date";

$MPG_GALLERY_ALIGN = "center";

function masonrypostgallery_handler($atts)
{
	global $MPG_QUALITY_DEF;
	global $MPG_IMAGE_COLUMNS_DEF;
	global $MPG_MAX_WIDTH_DEF;
	global $MPG_MAX_HEIGHT_DEF;
	global $MPG_WIDTH_DEF;
	global $MPG_HEIGHT_DEF;
	global $MPG_HOVER_COLOR;
	global $MPG_HOVER_INTENSITY;
	global $MPG_MASONRY_DEF;
	global $MPG_HORIZONTAL_SPACING;
	global $MPG_VERTICAL_SPACING;
	global $MPG_FIT_WIDTH;
	global $MPG_BORDER_WEIGHT;
	global $MPG_BORDER_COLOR;
	global $MPG_POST_CATEGORY;
	global $MPG_POST_ORDER;
	global $MPG_POST_ORDERBY;
	global $MPG_GALLERY_ALIGN;
	$a = shortcode_atts(array('quality' => $MPG_QUALITY_DEF, 'masonry' => $MPG_MASONRY_DEF,
	'max_width' => $MPG_MAX_WIDTH_DEF, 'max_height' => $MPG_MAX_HEIGHT_DEF, 'width' => $MPG_WIDTH_DEF,
	'height' => $MPG_HEIGHT_DEF, 'horizontal_spacing' => $MPG_HORIZONTAL_SPACING,
	'vertical_spacing' => $MPG_VERTICAL_SPACING, 'fit_width' => $MPG_FIT_WIDTH,
	'border_color' => $MPG_BORDER_COLOR, 'border_thickness' => $MPG_BORDER_WEIGHT,
	'post_category' => $MPG_POST_CATEGORY, 'post_order' => $MPG_POST_ORDER, 
	'post_orderby' => $MPG_POST_ORDERBY, 'gallery_align' => $MPG_GALLERY_ALIGN,
	'hover_color' => $MPG_HOVER_COLOR, 'hover_intensity' => $MPG_HOVER_INTENSITY), $atts);
	mpg_get_started($a);
	global $post;
		
	$args = array('posts_per_page' => 100, 'category' => $a['post_category'], 'orderby' => $MPG_POST_ORDERBY);
	$lastposts = get_posts($args);

	foreach($lastposts as $post):
		setup_postdata($post);
		if(has_post_thumbnail())
		{	
			$tit = get_post_field("post_title",($post->ID), "display");
			$lnk = get_permalink();
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$a['quality']);
			if($a['masonry'] === true)
			{
			?>
			
			<script type="text/javascript">
			<!--
				var s = "<a class='masonry_brick_a' href='<?php echo $lnk ?>'><img class='masonry_brick_img' src='<?php echo $thumbnail[0]; ?>' alt='<?php echo $tit ?>'></a>";
				var el = document.createElement('div');
				el.innerHTML = s;
				el.className = "masonry_brick";
				el.style.opacity = "0";
				elems.push(el);
			//--></script>
			<noscript>
				<div class='masonry_brick'><!--
					--><a class='masonry_brick_a' href='<?php echo $lnk ?>'><!--
						--><img class='masonry_brick_img' src='<?php echo $thumbnail[0]; ?>' alt='<?php echo $tit ?>'><!--
					--></a><!--
				--></div>
			</noscript>
			<?php
			}
			else//Masonry OFF
			{
			?>
			<div class='masonry_brick'><!--
				--><a class='masonry_brick_a' href='<?php echo $lnk ?>'><!--
					--><img class='masonry_brick_img' src='<?php echo $thumbnail[0]; ?>' alt='<?php echo $tit ?>'><!--
				--></a><!--
			--></div>
			<?php
			}

		}
	endforeach;	
	wp_reset_postdata();
	mpg_finish_up($a);
}



function mpg_get_started($a)
{
	?>
	<style scoped>
		div.masonry_brick
		{
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			display: inline-block;
			height: auto;
			width: auto;
			float:left;
			background-color: <?php echo $a['hover_color'];?>;
		}
		a.masonry_brick_a, img.masonry_brick_img
		{
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			padding: 0px;
			margin: 0px;
			display:block;
		}
		a.masonry_brick_a
		{	
			-webkit-transition: all 0.5s ease-in-out;
			-moz-transition: all 0.5s ease-in-out;
			-o-transition: all 0.5s ease-in-out;
			transition: all 0.5s ease-in-out;
		}
		a.masonry_brick_a:hover
		{
			opacity: <?php echo $a['hover_intensity'];?>;
		}
		div#masonry_post_gallery
		{
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			width: 100%;
			text-align: center;
			height: auto;
		<?php
			if($a['gallery_align'] == "left" || $a['gallery_align'] == "center")
			{
		?>
				margin-right: auto;
		<?php
			}
			if($a['gallery_align'] == "right" || $a['gallery_align'] == "center")
			{
		?>
				margin-left: auto;
		<?php
			}
		?>
		}
		img.masonry_brick_img
		{
			max-height: <?php echo $a['max_height'];?>;
			max-width: <?php echo $a['max_width'];?>;
			height: <?php echo $a['height'];?>;
			width: <?php echo $a['width'];?>;
		<?php
			if($a['masonry'] === true)
			{
		?>			
				margin-bottom: <?php echo $a['vertical_spacing'] . "px";?>;
		<?php
			}
			else
			{
		?>
				margin-bottom: <?php echo $a['vertical_spacing'] . "px";?>;
				margin-right: <?php echo $a['horizontal_spacing'] . "px";?>;
				margin-left: 0px;
				margin-top: 0px;
		<?php
			}
		?>
			border-style: solid;
			border-width: <?php echo $a['border_thickness'];?>;
			border-color: <?php echo $a['border_color'];?>;
		}
		
		div#MPG_Loader_Container
		{
			width: 100%;
			text-align: center;
			display: block;
			position: relative;
			-webkit-transition: all 1s;
			-moz-transition: all 1s;
			-ms-transition: all 1s;
			-o-transition: all 1s;
		}
		div#MPG_Loader_Color
		{
			background-color: #353535;
			color: #FFF;
			border-radius: 4px;
			display: inline-block;
			font-size: 1.4em;
			font-weight: bold;
			text-align: center;
			vertical-align: middle;
		}
		div#MPG_Spin_Box, div#MPG_Loader
		{
			height: 50px;
			text-align: center;
			margin: 0px;
			vertical-align: middle;
		}
		div#MPG_Spin_Box
		{
			display: inline-block;
			position: relative;
		}
		div#MPG_Loader
		{
			line-height: 50px;
			padding: 0px 10px 0px 10px;			
			display: inline-block;
		}
		
		
		
	</style>
	<div id="masonry_post_gallery">
	<?php
}

function mpg_finish_up($a)
{
	//Show loading bar
	if($a['masonry'] === true)
	{
	?>
		</div>
		<script type="text/javascript">
			if(elems.length > 0)
			{
				add_elem(0);		
			}else
			{
				document.getElementById("MPG_Loader_Container").style.display = "none";
			}
			
			function add_elem(count)
			{
				document.getElementById("masonry_post_gallery").appendChild(elems[count]);
				imagesLoaded('#masonry_post_gallery', function()
				{
					var msnry = new Masonry('#masonry_post_gallery', {columnWidth: 1, gutter: <?php echo $a['horizontal_spacing'];?>, isFitWidth: <?php echo $a['fit_width'];?>});
					elems[count].style.transition = "opacity 0.5s";
					elems[count].style.opacity = "1";
					if(count+1 < elems.length)
					{
						add_elem(count+1);	
						document.getElementById("MPG_Loader").innerHTML = "Loading (" + ((((count+1)/elems.length)*100) | 0) + "%)"; 	
					}
					else
					{
						document.getElementById("MPG_Loader").innerHTML = "Loaded (" + ((((count+1)/elems.length)*100) | 0) + "%)"; 
						document.getElementById("MPG_Loader_Container").style.opacity = "0";
					}
				});	
			}
		</script>

		<div id="MPG_Loader_Container">
			<div id="MPG_Loader_Color">
				<div id="MPG_Spin_Box">
				</div>
				<div id="MPG_Loader">
					Loading...
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var opts = {
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
			var spinbox = document.getElementById("MPG_Spin_Box");
			spinbox.style.width = "50px";
			spinbox.appendChild(new Spinner(opts).spin().el);
		</script>
	<?php
	}
}



?>