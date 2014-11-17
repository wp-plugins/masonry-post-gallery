<?php
/**
 * @package Cactus Masonry
 * @version 0.3.6.1b
 */
/*
 * Plugin Name: Cactus Masonry
 * Plugin URI: http://cactuscomputers.com.au/masonry
 * Description: A highly customizable masonry styled gallery of post thumbnails.  Please refer to the <a href="http://cactuscomputers.com.au/masonry">plugin Home Page</a> for detailed instructions.
 * Version: 0.3.6.1b
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
add_action('wp_head', 'cmpg_prep_JS_globals');

add_shortcode("cactus-masonry", "masonrypostgallery_handler");
add_shortcode("masonry-post-gallery", "masonrypostgallery_handler");
add_action('wp_enqueue_scripts', 'cmpg_prep_scripts');
add_action('admin_menu', 'cmpg_add_instructions');
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'plugin_settings_link');

include_once('cactus-masonry-options.php');

function plugin_settings_link($links)
{
	$newlink = "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=cactus%40cactuscomputers%2ecom%2eau&amp;lc=AU&amp;currency_code=AUD&amp;bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted'>Donate</a>";
	array_unshift($links, $newlink);
	$newlink = "<a href='http://cactuscomputers.com.au/masonry/' target='_blank'>Our Website</a>";
	array_unshift($links, $newlink);
	$newlink = "<a href='http://cactuscomputers.com.au/masonry/how-to-use/' target='_blank'>Instructions</a>";
	array_unshift($links, $newlink);
	return $links;
}



function cmpg_prep_scripts()
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

function cmpg_prep_JS_globals()
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

$MPG_SEARCH_START = 0;
$MPG_PAGE_SIZE = 1000;

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

$MPG_TEST = false;
$MPG_DEFAULT_IMAGE = false;

$MPG_SHOW_POSTS = true;
$MPG_SHOW_PAGES = false;

function masonrypostgallery_handler($atts)
{
	//Prepare output variable
	$output = "";
	//Find global variables
	global $a;
	global $post;
	global $MPG_SEARCH_START;
	global $MPG_PAGE_SIZE;
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
	global $MPG_TEST;
	global $MPG_DEFAULT_IMAGE;
	global $MPG_SHOW_POSTS;
	global $MPG_SHOW_PAGES;
	
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
	'show_loader' => $MPG_SHOW_LOADER, 'search_start' => $MPG_SEARCH_START, 
	'page_size' => $MPG_PAGE_SIZE, 'test_mode' => $MPG_TEST, 
	'default_image_id' => $MPG_DEFAULT_IMAGE, 'show_posts' => $MPG_SHOW_POSTS,
	'show_pages' => $MPG_SHOW_PAGES), $atts);
	
	//Fix boolean parameter values
	$a['show_lightbox'] = cmpg_fix_boolean($a['show_lightbox'], $MPG_LINK_LIGHTBOX);
	$a['browse_with_lightbox'] = cmpg_fix_boolean($a['browse_with_lightbox'], $MPG_LINK_LIGHTBOX_SCROLL);
	$a['show_lightbox_title'] = cmpg_fix_boolean($a['show_lightbox_title'], $MPG_LINK_LIGHTBOX_TITLE);
	$a['masonry'] = cmpg_fix_boolean($a['masonry'], $MPG_MASONRY_DEF);
	$a['fit_width'] = cmpg_fix_boolean($a['fit_width'], $MPG_FIT_WIDTH);
	$a['infinite_scroll'] = cmpg_fix_boolean($a['infinite_scroll'], $MPG_INFINITE_SCROLL);
	$a['show_loader'] = cmpg_fix_boolean($a['show_loader'], $MPG_SHOW_LOADER);
	$a['show_browser_warning'] = cmpg_fix_boolean($a['show_browser_warning'], $MPG_SHOW_BROWSER_WARNING);
	$a['test_mode'] = cmpg_fix_boolean($a['test_mode'], $MPG_TEST);
	$a['show_pages'] = cmpg_fix_boolean($a['show_pages'], $MPG_SHOW_PAGES);
	$a['show_posts'] = cmpg_fix_boolean($a['show_posts'], $MPG_SHOW_POSTS);
	//Disable masonry in IE 7 and lower
	if(preg_match('/(?i)msie [5-7]/',$_SERVER['HTTP_USER_AGENT']))
	{
		$a['masonry'] = false;
	}	
	//Start the Main DIV
	$output = "
	<div id='masonry_post_gallery'>
		" . cmpg_create_styles() . "
		<script type='text/javascript'>
			elems = Array();
			pageStart = 0;
			pageEnd = 0;
			pagePosition = 0;
			lastImageOffset = 0;
	</script>\n";
	//Prepare & Execute WordPress query
	//$args = array('posts_per_page' => $a['page_size'], 'offset' => $a['search_start'], 'category_name' => $a['post_category'], 'orderby' => $a['post_orderby'], 'order' => $a['post_order']);
	$post_type = ['cactus_none'];
	if($a['show_pages'])
	{
		array_push($post_type, 'page');
	}
	if($a['show_posts'])
	{
		array_push($post_type, 'post');
	}
	$args = array(	'posts_per_page' => $a['page_size'], 
					'offset' => $a['search_start'], 
					'category_name' => $a['post_category'], 
					'orderby' => fix_sort_column($a['post_orderby']), 
					'order' => $a['post_order'],
					'post_type' => $post_type);
	$lastposts = get_posts($args);
	
	
	//For each post found by the query:
	foreach($lastposts as $post)
	{
		setup_postdata($post);
		if(has_post_thumbnail($post->ID) || !($a['default_image_id'] === false))
		{	
			$output.=render_post();
		}	
	}
		
	
	wp_reset_postdata();
	//Close off the masonry gallery main div
	$output .= "</div>\n";
	//Draw loading box
	$output .= "
		<div id='MPG_Loader_Container'>
			<div id='MPG_Loader_Color'>
				<div id='MPG_Spin_Box'>
				</div>
				<div id='MPG_Loader'>
					Loading...
				</div>
			</div>
		</div>\n";
	//Send Header and Footer JS and CSS
	
	add_action('wp_footer','cmpg_create_javascript');
	
	return $output;
}

function fix_sort_column($col)
{
	if($col == 'author' || $col ==  'date' || $col ==  'modified' || $col ==  'parent' || $col == 'title' || $col == 'excerpt' || $col == 'content')
	{
		return 'post_' . $col;
	}
	return $col;
}

function render_post()
{
	global $a;
	global $post;
	$output = "";
	$tit = str_replace("'", "&#39;", get_post_field("post_title",($post->ID), "display"));
	if(has_post_thumbnail())
	{
		$iid = get_post_thumbnail_id($post->ID);
	}
	else
	{
		$iid = $a['default_image_id'];
	}
	$thumbnail = cmpg_upsize_image($iid, $a['quality'], $a['max_upscale_quality'], $a['upscale_max_width'], $a['upscale_max_height'], $a['upscale_narrow_images'], $a['upscale_short_images']);		
	
	if(!$thumbnail)
	{
		$output.="\n<script>console.log('Cactus Masonry Error: -{$a['default_image_id']}- Image with ID={$iid} cannot be found');</script>\n";
		return $output;
	}
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
		$output .= "height: {$a['height']}; ";
		
		//REMOVED DUE TO WIDTH PROBLEM
		/*if(strpos($a['max_width'], '%') !== false) 
		{
			$output .= "max-width: none; ";
		}
		else
		{
			$output .= "max-width: {$a['max_width']}; ";
		}*/
		//if($a['max_width'] != 'none')
		{
			$output .= "max-width: 100%; ";
		}
				
				
		
		$output .= "max-height: {$a['max_height']}; ";
		$output .= "'/></{$link_type}>\";\n";
		//Create DOM Element for masonry_brick DIV
		$output .= "
		var el = document.createElement('div');
		el.innerHTML = s;
		el.className = 'masonry_brick';
		el.style.opacity = '0';
		el.style.display = 'inline-block';
		el.style.height = '{$a['height']}';\n";
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
		$output .= "
		<noscript>
			<div class='masonry_brick'><!--
				--><{$link_type} class='masonry_brick_a' href='{$lnk}'><!--
					--><img class='masonry_brick_img' src='{$thumbnail[0]}' alt='{$tit}'/><!--
				--></{$link_type}><!--
			--></div>
		</noscript>\n";
	/*
		MASONRY IS OFF
	*/
	}
	else//Masonry OFF
	{
		$output .= "
	<div class='masonry_brick'><!--
		--><{$link_type} {$lightbox_text} class='masonry_brick_a' href='{$lnk}'><!--
			--><img class='masonry_brick_img' src='{$thumbnail[0]}' alt='{$tit}'><!--
		--></{$link_type}><!--
	--></div>\n";
	}
	return $output;
}


function cmpg_bool_to_string($bool)
{
	return ($bool) ? "true" : "false";
}

function cmpg_fix_boolean($val, $default)
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

function cmpg_search_array_for_index($value, $arr, $default)
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

function cmpg_get_next_image_size($original, $max)
{
	$sizes = array("thumbnail", "medium", "large", "full");
	//Get index of $max size - this will be as far as we search
	$max_size_index = cmpg_search_array_for_index($max, $sizes, count($sizes)-1)+1;
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

function cmpg_text_to_number($txt)
{
	$out = filter_var($txt, FILTER_SANITIZE_NUMBER_INT);
	if($out == "")
	{
		return 0;
	}
	return $out;
}

function cmpg_upsize_image($ID, $quality, $max_quality, $max_width, $max_height, $min_width, $min_height)
{
	$thumb = wp_get_attachment_image_src($ID,$quality);
	if(!$thumb)
	{
		return false;
	}
	//1 - width - 2 - height
	//Exit if required
	if(($min_width == 0 && $min_height == 0) || ($thumb[1] >= $min_width && $thumb[2] >= $min_height))
	{
		array_push($thumb, false);
		array_push($thumb, false);
		return $thumb;
	}
	$nextsize = cmpg_get_next_image_size($quality, $max_quality);
	//Sanitize maximums
	$max_height = cmpg_text_to_number($max_height);
	$max_width = cmpg_text_to_number($max_width);
	//Record nature of upsize
	$width_resize = (($thumb[1] < $min_width) && ($thumb[1] < $max_width || $max_width == 0));
	$height_resize = (($thumb[2] < $min_height) && ($thumb[2] < $max_height || $max_height == 0));
	//While
	//	- Either thumb width or height is less than minimum
	//	- There is a larger size thumbnail available
	//	- Both thumb width and height are less than maximum (unless maximum is 0)
	while(($thumb[1] < $min_width || $thumb[2] < $min_height) && ($nextsize != $quality) && ($thumb[1] < $max_width || $max_width == 0) && ($thumb[2] < $max_height || $max_height == 0))
	{
		$quality = $nextsize;
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($ID),$nextsize);	
		$nextsize = cmpg_get_next_image_size($quality, $max_quality);
	}
	if(!$thumb)
	{
		return false;
	}
	array_push($thumb, $width_resize);
	array_push($thumb, $height_resize);
	return $thumb;
}

/**		Creates the stylesheet for the gallery		**/
function cmpg_create_styles()
{
	global $a;
	return "
	<style scoped>
		div.masonry_brick
		{
			height: {$a['noscript_max_height']};
			width: {$a['noscript_max_width']};
			margin-bottom: " . round($a['vertical_spacing']/2,1) . "px;
			padding-right: " . round($a['horizontal_spacing']/2,1) . "px;
			padding-left: " . round($a['horizontal_spacing']/2,1) . "px;
			margin-top: " . round($a['vertical_spacing']/2,1) . "px;
		}
		.masonry_brick_a
		{
			border-width: {$a['outer_border_thickness']};
			border-color: {$a['outer_border_color']};
			background-color: {$a['hover_color']};
		}
		img.masonry_brick_img:hover
		{
			opacity: {$a['hover_intensity']};
		}
		div#masonry_post_gallery
		{
 			" . cmpg_return_if_true($a['gallery_align'] == "left" || $a['gallery_align'] == "center", "margin-right: auto;\n") . "
 			" . cmpg_return_if_true($a['gallery_align'] == "right" || $a['gallery_align'] == "center", "margin-left: auto;\n") . "
		}
		img.masonry_brick_img
		{
			height: {$a['noscript_height']};
			width: {$a['noscript_width']};
			border-width: {$a['border_thickness']};
			border-color: {$a['border_color']};
		}
	</style>\n";
}

function cmpg_return_if_true($test, $text_if_true, $text_if_false = "")
{
	if($test)
	{
		return $text_if_true;
	}
	return $text_if_false;
}

function cmpg_create_javascript()
{
	global $a;
	//Show loading bar
	if($a['masonry'] === true)
	{
	?>
	<script type='text/javascript'>
<?php
	if($a['show_loader'] === true)
	{
?>
		var spinbox = document.getElementById('MPG_Spin_Box');
		spinbox.style.width = '50px';
		spinbox.appendChild(MPG_spinner.spin().el);
		var spincontainer = document.getElementById('MPG_Loader_Container');
		spincontainer.style.display = 'block';
<?php
	}
?>
		if(elems.length > 0)
		{
			MPG_Loading = true;
			pageStart = 0;
			pageEnd = <?php echo cmpg_return_if_true($a['infinite_scroll'], "Math.min(elems.length, {$a['posts_per_page']})", "elems.length"); ?>;
			pagePosition = 0;
			//masonryFinishedEvent
			add_elem(0);
		}
		else
		{
			document.getElementById('MPG_Loader_Container').style.display = 'none';
		}	
		function gcd(o){
			if(!o.length)
				return 0;
			for(var r, a, i = o.length - 1, b = o[i]; i;)
				for(a = o[--i]; r = a % b; a = b, b = r);
			return b;
		};
		function getColumnWidth()
		{
			var colWidths = new Array();
			var elems = document.getElementsByClassName('masonry_brick');
			for(var o = 0; o < elems.length; o++)
			{
				colWidths.push(elems[o].offsetWidth);
			}
			return gcd(colWidths);	
		}
		function add_elem(count)
		{
			MPG_Loading = true;
			document.getElementById('masonry_post_gallery').appendChild(elems[count]);
			imagesLoaded('#masonry_post_gallery', function()
			{
				var msnry = new Masonry('#masonry_post_gallery', {columnWidth: <?php if(strpos($a['width'],'%') !== false){echo "'.masonry_brick'";}else{echo "getColumnWidth()";} ?>, gutter: <?php echo $a['soft_gutter']; ?>, isFitWidth: <?php echo cmpg_bool_to_string($a['fit_width']); ?>});
				elems[count].style.transition = 'opacity 0.5s';
				elems[count].style.opacity = '1';
				if(count+1 < elems.length && (! <?php echo cmpg_bool_to_string($a['infinite_scroll']); ?> || pagePosition < pageEnd))
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