<?php
/**
 * @package Masonry Post Gallery
 * @version 0.3b
 */
/*
 * Plugin Name: Masonry Post Gallery
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A masonry style gallery of posts
 * Version: 0.3b
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
	//Register Styles
	wp_register_style('Lightbox_style', plugins_url() . '/masonry-post-gallery/lightbox.css');
	//Enqueue Styles
	wp_enqueue_style('Lightbox_style');
	//Register Scripts
	wp_register_script('Masonry', plugins_url() . '/masonry-post-gallery/masonry.pkgd.min.js');
	wp_register_script('ImagesLoaded', plugins_url() . '/masonry-post-gallery/imagesloaded.pkgd.min.js');
	wp_register_script('Spin', plugins_url() . '/masonry-post-gallery/spin.min.js');
	wp_register_script('Lightbox', plugins_url() . '/masonry-post-gallery/lightbox.min.js', array('jquery'));
	//Enqueue Scripts
	wp_enqueue_script('Masonry');
	wp_enqueue_script('ImagesLoaded');
	wp_enqueue_script('Spin');
	wp_enqueue_script('Lightbox');
}
//Define that shit

	
	

$MPG_QUALITY_DEF = "thumbnail";  //thumbnail, medium, large, full


$MPG_MAX_WIDTH_DEF = "none";
$MPG_MAX_HEIGHT_DEF = "none";
$MPG_WIDTH_DEF = "auto";
$MPG_HEIGHT_DEF = "auto";

$MPG_NOSCRIPT_WIDTH = "auto";
$MPG_NOSCRIPT_HEIGHT = "auto";
$MPG_NOSCRIPT_MAX_WIDTH = "none";
$MPG_NOSCRIPT_MAX_HEIGHT = "none";

$MPG_HOVER_COLOR = "#ffffff";
$MPG_HOVER_INTENSITY = "0.5";

$MPG_MASONRY_DEF = true;

$MPG_HORIZONTAL_SPACING = 0;
$MPG_VERTICAL_SPACING = 0;

$MPG_FIT_WIDTH = true;

$MPG_BORDER_WEIGHT = "0px";
$MPG_BORDER_COLOR = "#000000";

$MPG_POST_CATEGORY = "";
$MPG_POST_ORDER = "DESC";
$MPG_POST_ORDERBY = "post_date";

$MPG_GALLERY_ALIGN = "center";

$MPG_UPSCALE_NARROW_IMAGES = 0;
$MPG_UPSCALE_FLAT_IMAGES = 0;
$MPG_UPSCALE_MAX_SIZE = "large";
$MPG_MAX_UPSCALE_WIDTH = "none";
$MPG_MAX_UPSCALE_HEIGHT = "none";

$MPG_LINK_LOCATION = "post";
$MPG_LINK_LIGHTBOX = false;
$MPG_LINK_LIGHTBOX_SCROLL = false;
$MPG_LINK_LIGHTBOX_TITLE = false;


function masonrypostgallery_handler($atts)
{
	global $MPG_QUALITY_DEF;
	global $MPG_MAX_WIDTH_DEF;
	global $MPG_MAX_HEIGHT_DEF;
	global $MPG_WIDTH_DEF;
	global $MPG_HEIGHT_DEF;
	global $MPG_NOSCRIPT_WIDTH;
	global $MPG_NOSCRIPT_HEIGHT;
	global $MPG_NOSCRIPT_MAX_WIDTH;
	global $MPG_NOSCRIPT_MAX_HEIGHT;
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
	global $MPG_UPSCALE_NARROW_IMAGES;
	global $MPG_UPSCALE_FLAT_IMAGES;
	global $MPG_UPSCALE_MAX_SIZE;
	global $MPG_MAX_UPSCALE_WIDTH;
	global $MPG_MAX_UPSCALE_HEIGHT;
	global $MPG_LINK_LOCATION;
	global $MPG_LINK_LIGHTBOX;
	global $MPG_LINK_LIGHTBOX_SCROLL;
	global $MPG_LINK_LIGHTBOX_TITLE;
	$a = shortcode_atts(array('quality' => $MPG_QUALITY_DEF, 'masonry' => $MPG_MASONRY_DEF,
	'max_width' => $MPG_MAX_WIDTH_DEF, 'max_height' => $MPG_MAX_HEIGHT_DEF, 'width' => $MPG_WIDTH_DEF,
	'height' => $MPG_HEIGHT_DEF, 'horizontal_spacing' => $MPG_HORIZONTAL_SPACING,
	'vertical_spacing' => $MPG_VERTICAL_SPACING, 'fit_width' => $MPG_FIT_WIDTH,
	'border_color' => $MPG_BORDER_COLOR, 'border_thickness' => $MPG_BORDER_WEIGHT,
	'post_category' => $MPG_POST_CATEGORY, 'post_order' => $MPG_POST_ORDER, 
	'post_orderby' => $MPG_POST_ORDERBY, 'gallery_align' => $MPG_GALLERY_ALIGN,
	'hover_color' => $MPG_HOVER_COLOR, 'hover_intensity' => $MPG_HOVER_INTENSITY,
	'upscale_narrow_images' => $MPG_UPSCALE_NARROW_IMAGES, 
	'upscale_short_images' => $MPG_UPSCALE_FLAT_IMAGES, 'max_upscale_quality' => $MPG_UPSCALE_MAX_SIZE,
	'noscript_width' => $MPG_NOSCRIPT_WIDTH, 'noscript_height' => $MPG_NOSCRIPT_HEIGHT,
	'noscript_max_width' => $MPG_NOSCRIPT_MAX_WIDTH, 'noscript_max_height' => $MPG_NOSCRIPT_MAX_HEIGHT,
	'upscale_max_width' => $MPG_MAX_UPSCALE_WIDTH, 'upscale_max_height' => $MPG_MAX_UPSCALE_HEIGHT,
	'link_location' => $MPG_LINK_LOCATION, 'show_lightbox' => $MPG_LINK_LIGHTBOX,
	'browse_with_lightbox' => $MPG_LINK_LIGHTBOX_SCROLL, 
	'show_lightbox_title' => $MPG_LINK_LIGHTBOX_TITLE), $atts);
	//Fix boolean values
	$a['show_lightbox'] = fix_boolean($a['show_lightbox'], $MPG_LINK_LIGHTBOX);
	$a['browse_with_lightbox'] = fix_boolean($a['browse_with_lightbox'], $MPG_LINK_LIGHTBOX_SCROLL);
	$a['show_lightbox_title'] = fix_boolean($a['show_lightbox_title'], $MPG_LINK_LIGHTBOX_TITLE);
	$a['masonry'] = fix_boolean($a['masonry'], $MPG_MASONRY_DEF);
	$a['fit_width'] = fix_boolean($a['fit_width'], $MPG_FIT_WIDTH);
	
	mpg_get_started($a);
	global $post;
		
	$args = array('posts_per_page' => 100, 'category' => $a['post_category'], 'orderby' => $a['post_orderby'], 'order' => $a['post_order']);
	$lastposts = get_posts($args);

	foreach($lastposts as $post):
		setup_postdata($post);
		if(has_post_thumbnail())
		{	
			$tit = get_post_field("post_title",($post->ID), "display");
			$thumbnail = upsize_image($post->ID, $a['quality'], $a['max_upscale_quality'], $a['upscale_max_width'], $a['upscale_max_height'], $a['upscale_narrow_images'], $a['upscale_short_images']);		
			$link_type = "a";
			$lightbox_text = " data-lightbox='";
			if($a['browse_with_lightbox'] === true)
			{
				$lightbox_text .= "thispage'";
			}
			else
			{
				$lightbox_text .= $post->ID . "'";
			}
			if($a['show_lightbox_title'] === true)
			{
				$lightbox_text .= " data-title='" . $tit . "'";
			}
			//Set Link Location
			switch($a['link_location'])
			{
				case "image":
					$lnk = $thumbnail[0];
					break;
				case "thumbnail":
					$lnk = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'thumbnail')[0];
					break;
				case "medium":
					$lnk = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium')[0];
					break;
				case "large":
					$lnk = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large')[0];
					break;
				case "full":
					$lnk = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full')[0];
					break;
				case "none":
					$lnk = "";
					$link_type = "div";
					$a['show_lightbox'] = false;
					break;
				default:
					$lnk = get_permalink();	
					$a['show_lightbox'] = false;
			}
			if(!($a['show_lightbox'] === true))
			{
				$lightbox_text = "";
			}
			if($a['masonry'] === true)
			{
			?>
			
			<script type="text/javascript">
			<!--
				var s = "<<?php echo $link_type; echo $lightbox_text;?> class='masonry_brick_a' style='display: block;' href='<?php echo $lnk; ?>'><img class='masonry_brick_img size-thumbnail' src='<?php echo $thumbnail[0]; ?>' alt='<?php echo $tit ?>' style='<?php if($a['width'] != 'auto'){echo "width: 100%; ";} if($a['height'] != 'auto'){echo "height: 100%; ";}?>'></<?php echo $link_type;?>>";
				
				var el = document.createElement('div');
				el.innerHTML = s;
				el.className = "masonry_brick";
				el.style.opacity = "0";
				el.style.display = "inline-block";
				el.style.height = "<?php echo $a['height'];?>";
				el.style.width = "<?php echo $a['width'];?>";
				
				
				//Do max heights
				<?php 
					if($thumbnail[4])
					{
						echo "el.style.maxHeight = '" . $a['upscale_max_height'] . "';";
					}
					else
					{
						echo "el.style.maxHeight = '" . $a['max_height'] . "';";
					}
					if($thumbnail[5])
					{
						echo "el.style.maxWidth = '" . $a['upscale_max_width'] . "';";
					}
					else
					{
						echo "el.style.maxWidth = '" . $a['max_width'] . "';";
					}
				?>
				
				elems.push(el);
			//--></script>
			<noscript>
				<div class='masonry_brick'><!--
					--><<?php echo $link_type;?> class='masonry_brick_a' href='<?php echo $lnk ?>'><!--
						--><img class='masonry_brick_img' src='<?php echo $thumbnail[0]; ?>' alt='<?php echo $tit ?>'><!--
					--></<?php echo $link_type;?>><!--
				--></div>
			</noscript>
			<?php
			}
			else//Masonry OFF
			{
			?>
			<div class='masonry_brick'><!--
				--><<?php echo $link_type; echo $lightbox_text;?> class='masonry_brick_a' href='<?php echo $lnk ?>'><!--
					--><img class='masonry_brick_img' src='<?php echo $thumbnail[0]; ?>' alt='<?php echo $tit ?>'><!--
				--></<?php echo $link_type;?>><!--
			--></div>
			<?php
			}

		}
	endforeach;	
	wp_reset_postdata();
	mpg_finish_up($a);
}

function fix_boolean($val, $default)
{
	if($val === true || $val === false)
	{
		return $val;
	}
	if($val == "true")
	{
		return true;
	}
	if($val == "false")
	{
		return false;
	}
	return $default;
}

function search_array_for_index($value, $arr, $default)
{
	for($i = 0; $i < count($arr); $i++)
	{
		if($arr[$i] == $value)
		{
			return $i;
		}
	}
	return $default;
}

function get_next_image_size($original, $max)
{
	$sizes = array("thumbnail", "medium", "large", "full");
	//Get index of $max size - this will be as far as we search
	$max_size_index = search_array_for_index($max, $sizes, count($sizes)-1)+1;
	//Return the next index value after the original element
	$found = false;
	for($i = 0; $i < $max_size_index; $i++)
	{
		if($found)
		{
			return $sizes[$i];
		}
		$found = ($sizes[$i] == $original);
	}
	return $original;
}

function text_to_number($txt)
{
	$out = filter_var($txt, FILTER_SANITIZE_NUMBER_INT);
	if($out == "")
	{
		return 0;
	}
	return $out;
}

function upsize_image($ID, $quality, $max_quality, $max_width, $max_height, $min_width, $min_height)
{
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($ID),$quality);
	//1 - width - 2 - height
	//Exit if required
	if(($min_width == 0 && $min_height == 0) || ($thumb[1] >= $min_width && $thumb[2] >= $min_height))
	{
		array_push($thumb, false);
		array_push($thumb, false);
		return $thumb;
	}
	$nextsize = get_next_image_size($quality, $max_quality);
	//Sanitize maximums
	$max_height = text_to_number($max_height);
	$max_width = text_to_number($max_width);
	//Record nature of upsize
	$width_resize = (/*($nextsize != $quality) && */($thumb[1] < $min_width) && ($thumb[1] < $max_width || $max_width == 0));
	$height_resize = (/*($nextsize != $quality) && */($thumb[2] < $min_height) && ($thumb[2] < $max_height || $max_height == 0));
	//While
	//	- Either thumb width or height is less than minimum
	//	- There is a larger size thumbnail available
	//	- Both thumb width and height are less than maximum (unless maximum is 0)
	while(($thumb[1] < $min_width || $thumb[2] < $min_height) && ($nextsize != $quality) && ($thumb[1] < $max_width || $max_width == 0) && ($thumb[2] < $max_height || $max_height == 0))
	{
		$quality = $nextsize;
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($ID),$nextsize);	
		$nextsize = get_next_image_size($quality, $max_quality);
	}
	array_push($thumb, $width_resize);
	array_push($thumb, $height_resize);
	return $thumb;
}

function mpg_get_started($a)
{
	?>
	<style scoped>
		div.masonry_brick
		{
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			display: table;
			height: <?php echo $a['noscript_max_height'];?>;
			width: <?php echo $a['noscript_max_width'];?>;
			float: left;
			background-color: <?php echo $a['hover_color'];?>;
		}
		a.masonry_brick_a, div.masonry_brick_a, img.masonry_brick_img
		{
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			padding: 0px;
			margin: 0px;
		}
		img.masonry_brick_img
		{
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		a.masonry_brick_a, div.masonry_brick_a 
		{	
			display: table-cell;
			vertical-align: middle;
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
			display: block;
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
		
			
			height: <?php echo $a['noscript_height'];?>;
			width: <?php echo $a['noscript_width'];?>;
				
				
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
			display: none;
			position: relative;
			margin-top: 20px;
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
			var spincontainer = document.getElementById("MPG_Loader_Container");
			spincontainer.style.display = "block";
		</script>
	<?php
	}
}



?>