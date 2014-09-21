<?php
/**
 * @package Masonry Post Gallery
 * @version 0.3.4.4b
 */
/*
 * Plugin Name: Masonry Post Gallery
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A masonry style gallery of posts
 * Version: 0.3.4.4b
 * Author: N. E - Cactus Computers
 * Author URI: http://www.cactuscomputers.com.au/masonry
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

$a = null;
//Add Shortcode
add_action('wp_head', 'prep_JS_globals');

add_shortcode("masonry-post-gallery", "masonrypostgallery_handler");
add_action('wp_enqueue_scripts', 'prep_scripts');


function prep_scripts()
{
	//Register Styles
	wp_register_style('MPG_style', plugins_url() . '/masonry-post-gallery/masonry-post-gallery.css');
	wp_register_style('Lightbox_style', plugins_url() . '/masonry-post-gallery/lightbox.css');
	//Enqueue Styles
	wp_enqueue_style('MPG_style');
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

function prep_JS_globals()
{
?>
	<script type="text/javascript">
		//DOM Array
		elems = Array();
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
		pageStart = 0;
		pageEnd = 0;
		pagePosition = 0;
		lastImageOffset = 0;
		MPG_Loading = false;
		MPG_spinner = new Spinner(opts);
		infiniteScrollEvent = document.createEvent('CustomEvent');
		infiniteScrollEvent.initEvent('CustomEvent', true, true);
		masonryLoadEvent = document.createEvent('CustomEvent');
		masonryLoadEvent.initEvent('CustomEvent', true, true);
		masonryFinishedEvent = document.createEvent('CustomEvent');
		masonryFinishedEvent.initEvent('CustomEvent', true, true);
		//Version Check
		IE_LT_9 = false;
	</script>
		<!--[if lt IE 9 ]>
			<script type="text/javascript">
				IE_LT_9 = true;
			</script>
		<![endif]-->
<?php
}

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

$MPG_HORIZONTAL_SPACING = 10;
$MPG_VERTICAL_SPACING = 10;

$MPG_FIT_WIDTH = false;

$MPG_BORDER_WEIGHT = "0px";
$MPG_BORDER_COLOR = "#000000";
$MPG_OUTER_BORDER_WEIGHT = "0px";
$MPG_OUTER_BORDER_COLOR = "#000000";

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

$MPG_SOFT_GUTTER = 0;

$MPG_INFINITE_SCROLL = true;
$MPG_POSTS_PER_PAGE = 30;

$MPG_SHOW_LOADER = true;

function masonrypostgallery_handler($atts)
{
	//Prepare output variable
	$output = "";
	//Find global variables
	global $a;
	global $post;
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
	global $MPG_OUTER_BORDER_WEIGHT;
	global $MPG_OUTER_BORDER_COLOR;
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
	global $MPG_SOFT_GUTTER;
	global $MPG_INFINITE_SCROLL;
	global $MPG_POSTS_PER_PAGE;
	global $MPG_SHOW_LOADER;
	//Accept input parameters
	$a = shortcode_atts(array('quality' => $MPG_QUALITY_DEF, 'masonry' => $MPG_MASONRY_DEF,
	'max_width' => $MPG_MAX_WIDTH_DEF, 'max_height' => $MPG_MAX_HEIGHT_DEF, 'width' => $MPG_WIDTH_DEF,
	'height' => $MPG_HEIGHT_DEF, 'horizontal_spacing' => $MPG_HORIZONTAL_SPACING,
	'vertical_spacing' => $MPG_VERTICAL_SPACING, 'fit_width' => $MPG_FIT_WIDTH,
	'border_color' => $MPG_BORDER_COLOR, 'border_thickness' => $MPG_BORDER_WEIGHT,
	'outer_border_color' => $MPG_OUTER_BORDER_COLOR, 'outer_border_thickness' => $MPG_OUTER_BORDER_WEIGHT,
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
	'show_lightbox_title' => $MPG_LINK_LIGHTBOX_TITLE, 'soft_gutter' => $MPG_SOFT_GUTTER,
	'infinite_scroll' => $MPG_INFINITE_SCROLL, 'posts_per_page' => $MPG_POSTS_PER_PAGE,
	'show_loader' => $MPG_SHOW_LOADER), $atts);
	//Fix boolean parameter values
	$a['show_lightbox'] = fix_boolean($a['show_lightbox'], $MPG_LINK_LIGHTBOX);
	$a['browse_with_lightbox'] = fix_boolean($a['browse_with_lightbox'], $MPG_LINK_LIGHTBOX_SCROLL);
	$a['show_lightbox_title'] = fix_boolean($a['show_lightbox_title'], $MPG_LINK_LIGHTBOX_TITLE);
	$a['masonry'] = fix_boolean($a['masonry'], $MPG_MASONRY_DEF);
	$a['fit_width'] = fix_boolean($a['fit_width'], $MPG_FIT_WIDTH);
	$a['infinite_scroll'] = fix_boolean($a['infinite_scroll'], $MPG_INFINITE_SCROLL);
	$a['show_loader'] = fix_boolean($a['show_loader'], $MPG_SHOW_LOADER);
	$a['show_browser_warning'] = fix_boolean($a['show_browser_warning'], $MPG_SHOW_BROWSER_WARNING);
	//Disable masonry in IE 7 and lower
	if(preg_match('/(?i)msie [5-7]/',$_SERVER['HTTP_USER_AGENT']))
	{
		$a['masonry'] = false;
	}	
	//Start the Main DIV
	$output = ""
. "	<div id='masonry_post_gallery'>\n"
. "		<script type='text/javascript'>\n"
. "			elems = Array();\n"
. "			pageStart = 0;\n"
. "			pageEnd = 0;\n"
. "			pagePosition = 0;\n"
. "			lastImageOffset = 0;\n"
. "		</script>\n";
	$output .= mpg_create_styles();
	//Prepare & Execute WordPress query
	$args = array('posts_per_page' => 100, 'category_name' => $a['post_category'], 'orderby' => $a['post_orderby'], 'order' => $a['post_order']);
	$lastposts = get_posts($args);
	//For each post found by the query:
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
			//Set where each image links and handle any interference with the show_lightbox parameter
			switch($a['link_location'])
			{
				case "image":
					$lnk = $thumbnail[0];
					break;
				case "thumbnail":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'thumbnail');
					$lnk = $lnka[0];
					break;
				case "medium":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
					$lnk = $lnka[0];
					break;
				case "large":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
					$lnk = $lnka[0];
					break;
				case "full":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
					$lnk = $lnka[0];
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
				/*
					DRAW JAVASCRIPT BOX
				*/
				//Start script <script ...>
				$output .= "<script type='text/javascript'>\n";
				//Write the JavaScript
				//Start with the innerHTML of the masonry_brick DIVs
				$output .= "var s = \"<{$link_type} {$lightbox_text} class='masonry_brick_a' style='display: block;' href=\'{$lnk}\'><img class='masonry_brick_img size-thumbnail' src='{$thumbnail[0]}' alt='{$tit}' style='";
				if(!($thumbnail[5] && strpos($a['upscale_max_width'], '%') !== false) && ($a['width'] != 'auto'))
				{
					$output .= "width: 100%; ";
				}
				//if($a['height'] != 'auto')
				//{
				//	$output .= "height: 100%; ";
				//}
				$output .= "height: {$a['height']}; ";
				if(strpos($a['max_width'], '%') !== false) 
				{
					$output .= "max-width: none; ";
				}
				else
				{
					$output .= "max-width: {$a['max_width']}; ";
				}
				$output .= "max-height: {$a['max_height']}; ";
				$output .= "'/></{$link_type}>\";\n";
				//Create DOM Element for masonry_brick DIV
				$output .= ""
. "				var el = document.createElement('div');\n"
. "				el.innerHTML = s;\n"
. "				el.className = 'masonry_brick';\n"
. "				el.style.opacity = '0';\n"
. "				el.style.display = 'inline-block';\n"
. "				el.style.height = '{$a['height']}';\n";
				if($thumbnail[5] && strpos($a['upscale_max_width'], '%') !== false)
				{
					$output .= "el.style.width = 'auto';\n";
				}
				else
				{
					$output .= "el.style.width = '{$a['width']}';\n";
				}
				//Do max heights
				if($thumbnail[4])
				{
					$output .= "el.style.maxHeight = '{$a['upscale_max_height']}';\n";
				}
				else
				{
					$output .= "el.style.maxHeight = '{$a['max_height']}';\n";
				}
				if($thumbnail[5])
				{
					$output .= "el.style.maxWidth = '{$a['upscale_max_width']}';\n";
				}
				else
				{
					$output .= "el.style.maxWidth = '{$a['max_width']}';\n";
				}
				$output .= "elems.push(el);\n";
				$output .= "</script>\n";
				/*
					DRAW NOSCRIPT BOX
				*/
				$output .= ""
. "				<noscript>\n"
. "				<div class='masonry_brick'><!--\n"
. "					--><{$link_type} class='masonry_brick_a' href='{$lnk}'><!--\n"
. "						--><img class='masonry_brick_img' src='{$thumbnail[0]}' alt='{$tit}'/><!--\n"
. "					--></{$link_type}><!--\n"
. "				--></div>\n"
. "			</noscript>\n";
			/*
				MASONRY IS OFF
			*/
			}
			else//Masonry OFF
			{
				$output .= ""
. "			<div class='masonry_brick'><!--\n"
. "				--><{$link_type} {$lightbox_text} class='masonry_brick_a' href='{$lnk}'><!--\n"
. "					--><img class='masonry_brick_img' src='{$thumbnail[0]}' alt='{$tit}'><!--\n"
. "				--></{$link_type}><!--\n"
. "			--></div>\n";
			}
		}
	endforeach;	
	wp_reset_postdata();
	//Close off the masonry gallery main div
	$output .= "</div>\n";
	//Draw loading box
	$output .= ""
. "		<div id='MPG_Loader_Container'>\n"
. "			<div id='MPG_Loader_Color'>\n"
. "				<div id='MPG_Spin_Box'>\n"
. "				</div>\n"
. "				<div id='MPG_Loader'>\n"
. "					Loading...\n"
. "				</div>\n"
. "			</div>\n"
. "		</div>\n";
	//Send Header and Footer JS and CSS
	
	
	add_action('wp_footer','mpg_create_javascript');
	

	return $output;
}


function bool_to_string($bool)
{
	return ($bool) ? "true" : "false";
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

/**		Creates the stylesheet for the gallery		**/
function mpg_create_styles()
{
	global $a;
	return ""
. "	<style scoped>\n"
. "		div.masonry_brick\n"
. "		{\n"
. "			height: {$a['noscript_max_height']};\n"
. "			width: {$a['noscript_max_width']};\n"
. "			margin-bottom: " . round($a['vertical_spacing']/2,1) . "px;\n"
. "			padding-right: " . round($a['horizontal_spacing']/2,1) . "px;\n"
. "			padding-left: " . round($a['horizontal_spacing']/2,1) . "px;\n"
. "			margin-top: " . round($a['vertical_spacing']/2,1) . "px;\n"
. "		}\n"
. "		.masonry_brick_a\n"
. "		{\n"
. "			border-width: {$a['outer_border_thickness']};\n"
. "			border-color: {$a['outer_border_color']};\n"
. "			background-color: {$a['hover_color']};\n"
. "		}\n"
. "		img.masonry_brick_img:hover\n"
. "		{\n"
. "			opacity: {$a['hover_intensity']};\n"
. "		}\n"
. "		div#masonry_post_gallery\n"
. "		{\n"
. 			return_if_true($a['gallery_align'] == "left" || $a['gallery_align'] == "center", "margin-right: auto;\n")
. 			return_if_true($a['gallery_align'] == "right" || $a['gallery_align'] == "center", "margin-left: auto;\n") 
. "		}\n"
. "		img.masonry_brick_img\n"
. "		{\n"
. "			height: {$a['noscript_height']};\n"
. "			width: {$a['noscript_width']};\n"
. "			border-width: {$a['border_thickness']};\n"
. "			border-color: {$a['border_color']};\n"
. "		}\n"
. "	</style>\n";
}

function return_if_true($test, $text_if_true, $text_if_false = "")
{
	if($test)
	{
		return $text_if_true;
	}
	return $text_if_false;
}

function mpg_create_javascript()
{
	global $a;
	//Show loading bar
	if($a['masonry'] === true)
	{
	?>
	<script type='text/javascript'>
		var spinbox = document.getElementById('MPG_Spin_Box');
		spinbox.style.width = '50px';
		spinbox.appendChild(MPG_spinner.spin().el);
		var spincontainer = document.getElementById('MPG_Loader_Container');
		spincontainer.style.display = 'block';
		if(elems.length > 0)
		{
			MPG_Loading = true;
			pageStart = 0;
			pageEnd = <?php echo return_if_true($a['infinite_scroll'], "Math.min(elems.length, {$a['posts_per_page']})", "elems.length"); ?>;
			pagePosition = 0;
			//masonryFinishedEvent
			add_elem(0);
		}
		else
		{
			document.getElementById('MPG_Loader_Container').style.display = 'none';
		}	
		function add_elem(count)
		{
			MPG_Loading = true;
			document.getElementById('masonry_post_gallery').appendChild(elems[count]);
			imagesLoaded('#masonry_post_gallery', function()
			{
				var msnry = new Masonry('#masonry_post_gallery', {columnWidth: 1, gutter: <?php echo $a['soft_gutter']; ?>, isFitWidth: <?php echo bool_to_string($a['fit_width']); ?>});
				elems[count].style.transition = 'opacity 0.5s';
				elems[count].style.opacity = '1';
				if(count+1 < elems.length && (! <?php echo bool_to_string($a['infinite_scroll']); ?> || pagePosition < pageEnd))
				{
					pagePosition++;
					add_elem(count+1);
					document.getElementById('MPG_Loader').innerHTML = 'Loading (' + ((((count-pageStart)/(pageEnd-pageStart))*100) | 0) + '%)';
				}
				else
				{
					document.getElementById('MPG_Loader').innerHTML = 'Loaded (100%)';
					document.getElementById('MPG_Loader_Container').style.opacity = '0';
					if(IE_LT_9)
					{
						document.getElementById('MPG_Loader_Container').style.visibility = 'hidden';
					}	
					MPG_spinner.stop();
<?php if($a['infinite_scroll']){ ?>
					if(pagePosition+1 < elems.length)
					{
						pageStart = pageEnd;
						pageEnd = Math.min(pageStart + <?php echo $a['posts_per_page'];?>,elems.length);
						lastImageOffset = elems[count].offsetTop;
						window.onscroll = MPG_scroll_listener;
					}
					else
					{
						document.dispatchEvent(masonryLoadEvent);
					}
<?php } else { echo "document.dispatchEvent(masonryLoadEvent);\n"; } ?>
					MPG_Loading = false;
				}
			});
		}
<?php if($a['infinite_scroll']) { ?>
			function MPG_scroll_listener(e)
			{
				if(window.pageYOffset + window.innerHeight >= lastImageOffset)
				{
					MPG_Loading = true;
					document.getElementById('MPG_Spin_Box').appendChild(MPG_spinner.spin().el);
					document.getElementById('MPG_Loader_Container').style.opacity = '1';
					if(IE_LT_9)
					{
						document.getElementById('MPG_Loader_Container').style.visibility = 'visible';
					}					
					window.onscroll = null;
					add_elem(pagePosition);
				}
			}
<?php } ?>
	</script>
<?php
	}
}
?>