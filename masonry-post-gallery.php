<?php
/**
 * @package Cactus Masonry
 * @version 0.4.0.1b
 */
/*
 * Plugin Name: Cactus Masonry
 * Plugin URI: http://cactuscomputers.com.au/masonry
 * Description: A highly customizable masonry styled gallery of post thumbnails.  Please refer to the <a href="http://cactuscomputers.com.au/masonry">plugin Home Page</a> for detailed instructions.
 * Version: 0.4.0.1b
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

/*TO DO
- ADD TAGS
- ADD PARENT ID 
*/

class Cactus_Masonry
{	
	private static $id = "CM_GALLERY_";
	private static $CM_version = "0.4.0.1b";
	private static $a = null;
	private static $post_count = 0;
	
	private static $noscript_text;
	private static $nomasonry_text;
	
	static public function init()
	{
		include_once('cactus-masonry-options.php');
		add_shortcode("cactus-masonry", array(__CLASS__, "masonrypostgallery_handler"));
		add_shortcode("masonry-post-gallery", array(__CLASS__, "masonrypostgallery_handler"));
		add_action("wp_headers", array(__CLASS__, "cmpg_add_header"));
		add_action("wp_enqueue_scripts", array(__CLASS__, "cmpg_add_dependencies"));
		//ADD JQUERY TO HEAD
		add_action('admin_menu', 'cmpg_add_instructions');
		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", array(__CLASS__, 'plugin_settings_link'));
	}

	static public function cmpg_add_dependencies()
	{
		wp_enqueue_script('jquery');
	}
	
	//Attempts to stop iNTERNET eXPLORER!!!!!! from entering incompatibility mode
	static public function cmpg_add_header($head)
	{
		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) $head['X-UA-Compatible'] = 'IE=edge,chrome=1';
		return $head;
	}
	
	static public function plugin_settings_link($links)
	{
		$newlink = "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=cactus%40cactuscomputers%2ecom%2eau&amp;lc=AU&amp;currency_code=AUD&amp;bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted'>Donate</a>";
		array_unshift($links, $newlink);
		$newlink = "<a href='http://cactuscomputers.com.au/masonry/' target='_blank'>Our Website</a>";
		array_unshift($links, $newlink);
		$newlink = "<a href='http://cactuscomputers.com.au/masonry/how-to-use/' target='_blank'>Instructions</a>";
		array_unshift($links, $newlink);
		return $links;
	}

	static private function cmpg_prep_JS_globals()
	{
		return "
			<script type='text/javascript'>
				IE_LT_9" . self::$id . " = false;//Lower than IE9
			</script>
			<!--[if lt IE 9 ]>
				<script type='text/javascript'>
					IE_LT_9" . self::$id . " = true;
				</script>
			<![endif]-->
		";
	}

	static public function masonrypostgallery_handler($atts)
	{
		global $CM_JS_MSG_COUNTER;
		global $CM_LOADER_COUNTER;
		if(!isset($CM_LOADER_COUNTER)) $CM_LOADER_COUNTER = 0;
		if(!isset($CM_JS_MSG_COUNTER)) $CM_JS_MSG_COUNTER = 0;
		self::$id = "CM_GALLERY_" . mt_rand(10000,99999);
		self::$post_count = 0;
		//Prepare output variable
		$output = self::cmpg_prep_JS_globals();
		//Find global variable
		global $post;
		//Accept input parameters
		self::$a = shortcode_atts(array(
			'quality' 					=> 	"thumbnail", 
			'masonry' 					=> 	true,
			'max_width'					=> 	"none", 
			'max_height' 				=> 	"none", 
			'width' 					=> 	"auto",
			'height'					=> 	"auto", 
			'horizontal_spacing' 		=> 	10,
			'vertical_spacing' 			=> 	10, 
			'fit_width' 				=> 	false,
			'border_color' 				=>	"#000000", 
			'border_thickness' 			=>	"0px",
			'outer_border_color' 		=>	"#000000",  
			'outer_border_thickness'	=>	"0px",
			'post_category' 			=>	"", 
			'post_order'				=>	"DESC", 
			'post_orderby' 				=> 	"post_date", 
			'gallery_align' 			=> 	"center",
			'image_background_color' 	=> 	"#ffffff", 
			'hover_color' 				=> 	"#ffffff", 
			'hover_intensity' 			=> 	"0.5",
			'upscale_narrow_images'		=> 0, 
			'upscale_short_images' 		=> 0, 
			'max_upscale_quality' 		=> "large",
			'noscript_width' 			=> "auto", 
			'noscript_height' 			=> "auto",
			'noscript_max_width' 		=> "none",
			'noscript_max_height' 		=> "none",
			'upscale_max_width' 		=> "none", 
			'upscale_max_height' 		=> "none",
			'link_location' 			=> "post", 
			'show_lightbox' 			=> false,
			'browse_with_lightbox' 		=> false, 
			'show_lightbox_title' 		=> false, 
			'soft_gutter' 				=> 0,
			'infinite_scroll' 			=> true, 
			'posts_per_page' 			=> 30,
			'show_loader' 				=> true, 
			'search_start'				=> 0, 
			'page_size' 				=> 1000, 
			'test_mode' 				=> false, 
			'default_image_id' 			=> false, 
			'show_posts' 				=> true,
			'show_pages' 				=> false,
			'require_javascript' 		=> false,
			'javascript_error_message' 	=> 'Please enable JavaScript to properly view this page.',
			'infinite_scroll_buffer' 	=> 400,
			'display_post_titles' 		=> false,
			'display_post_excerpts' 	=> false,
			'custom_post_types' 		=> "",
			'load_js'					=> true,
			'force_auto_width'			=> false,
			'crop_images'				=> false,
			'ajax_mode'					=> false,
			'link_custom_class'			=> ''
			), $atts);
		
		//Fix boolean parameter values
		self::$a['show_lightbox'] = self::cmpg_fix_boolean(self::$a['show_lightbox'], false);
		self::$a['browse_with_lightbox'] = self::cmpg_fix_boolean(self::$a['browse_with_lightbox'], false);
		self::$a['show_lightbox_title'] = self::cmpg_fix_boolean(self::$a['show_lightbox_title'], false);
		self::$a['masonry'] = self::cmpg_fix_boolean(self::$a['masonry'], true);
		self::$a['fit_width'] = self::cmpg_fix_boolean(self::$a['fit_width'], false);
		self::$a['infinite_scroll'] = self::cmpg_fix_boolean(self::$a['infinite_scroll'], true);
		self::$a['show_loader'] = self::cmpg_fix_boolean(self::$a['show_loader'], true);
		self::$a['test_mode'] = self::cmpg_fix_boolean(self::$a['test_mode'], false);
		self::$a['show_pages'] = self::cmpg_fix_boolean(self::$a['show_pages'], false);
		self::$a['show_posts'] = self::cmpg_fix_boolean(self::$a['show_posts'], true);
		self::$a['require_javascript'] = self::cmpg_fix_boolean(self::$a['require_javascript'], false);
		self::$a['display_post_titles'] = self::cmpg_fix_boolean(self::$a['display_post_titles'], false);
		self::$a['display_post_excerpts'] = self::cmpg_fix_boolean(self::$a['display_post_excerpts'], false);
		self::$a['load_js'] = self::cmpg_fix_boolean(self::$a['load_js'], true);
		self::$a['force_auto_width'] = self::cmpg_fix_boolean(self::$a['force_auto_width'], true);
		self::$a['crop_images'] = self::cmpg_fix_boolean(self::$a['crop_images'], true);
		self::$a['ajax_mode'] = self::cmpg_fix_boolean(self::$a['ajax_mode'], true);
		//Load external libraries
		if(self::$a['load_js'])
		{
			wp_enqueue_style('MPG_style', plugin_dir_url(__FILE__) . 'masonry-post-gallery.css');
			wp_enqueue_style('Lightbox_style', plugin_dir_url(__FILE__) . 'lightbox.css');
			wp_enqueue_script('Masonry', plugin_dir_url(__FILE__) . 'masonry.pkgd.min.js');
			wp_enqueue_script('ImagesLoaded', plugin_dir_url(__FILE__) . 'imagesloaded.pkgd.min.js');
			wp_enqueue_script('Spin', plugin_dir_url(__FILE__) . 'spin.min.js');
			wp_enqueue_script('CactusMasonry', plugin_dir_url(__FILE__) . 'cactus-masonry.js');
			wp_enqueue_script('Lightbox',plugin_dir_url(__FILE__) . 'lightbox.min.js', array('jquery'));
		}
		//Disable masonry in IE 7 and lower
		if(preg_match('/(?i)msie [5-7]/',$_SERVER['HTTP_USER_AGENT'])) self::$a['masonry'] = false;
		//Start the Main DIV
		$output .= "
	<div class='CM_area' data-plugin='Cactus Masonry' data-version='" . self::$CM_version . "'>" . self::cmpg_create_styles() . "
		<div data-version='" . self::$CM_version . "' class='masonry_post_gallery'>
			<noscript>";
		if(self::$a['javascript_error_message'] != "" && self::$a['masonry'])
		{
			if($CM_JS_MSG_COUNTER == 0) $output .= "
				<h3 class='cmpg_javascript_error'>" . self::$a['javascript_error_message'] . "</h3>";
			$CM_JS_MSG_COUNTER++;
		}
		//Prepare & Execute WordPress query
		$post_type = array('cactus_none');
		if(self::$a['show_pages']) array_push($post_type, 'page');
		if(self::$a['show_posts']) array_push($post_type, 'post');
		//Set up custom post types
		echo self::$a['custom_post_types'];
		$args = array(	'posts_per_page' => -1, 
						'offset' => 0,
						'category_name' => self::$a['post_category'], 
						'orderby' => self::fix_sort_column(self::$a['post_orderby']), 
						'order' => self::$a['post_order'],
						'post_type' => array_merge($post_type, explode(',', self::$a['custom_post_types'])));
		$lastposts = get_posts($args);
		//For each post found by the query:
		$script_text = "";
		self::$noscript_text = "";
		self::$nomasonry_text = "";
		foreach($lastposts as $post)
		{
			setup_postdata($post);
			if(has_post_thumbnail($post->ID) || !(self::$a['default_image_id'] === false))
			{	
				if($post_count >= self::$a['search_start'] && $post_count < self::$a['page_size']) $script_text .= self::render_post();
				$post_count++;
			}	
		}
		$output .= self::$noscript_text . "
			</noscript>
		</div>";
		self::$noscript_text = "";
		if(self::$a['masonry']) 
		{
			$output .= "
			<script>
				var elems" . self::$id . " = Array();
				var timer" . self::$id . " = null;
				var s = '';
				var el = null;\n";
		
			$output .= $script_text . "</script>";
		}
		$output .= "
		<div id='" . self::$id . "' data-version='" . self::$CM_version . "' class='masonry_post_gallery'>";
		if(!self::$a['masonry']) $output .= self::$nomasonry_text;
		self::$nomasonry_text = "";
		$output .= "
		</div>";
		$script_text = "";
		wp_reset_postdata();
		//Draw loading box
		if(self::$a['show_loader'] && $CM_LOADER_COUNTER == 0)
		{
			$CM_LOADER_COUNTER++;
			$output .= "
		<div id='MPG_Loader_Container'>
			<div id='MPG_Loader_Color'>
				<div id='MPG_Spin_Box'>
				</div>
				<div id='MPG_Loader'>
					Loading...
				</div>
			</div>
		</div>";
		}
		$output .= "
	</div>";
		return $output . self::cmpg_create_javascript();
	}

	static private function fix_sort_column($col)
	{
		if($col == 'author' || $col ==  'date' || $col ==  'modified' || $col ==  'parent' || $col == 'title' || $col == 'excerpt' || $col == 'content') return 'post_' . $col;
		return $col;
	}

	static private function remove_special_chars($str, $hide_new_lines = true)
	{
		$str = trim($str);
		$str = str_replace("'", "&#39;", $str);
		$str = str_replace('�', "&lsquo;", $str);
		$str = str_replace('�', "&rsquo;", $str);
		$str = str_replace('�', "&ldquo;", $str);
		$str = str_replace('�', "&rdquo;", $str);
		if($hide_new_lines) $str = str_replace(array("\r\n","\r","\n"), "", $str);
		else $str = str_replace(array("\r\n","\r","\n"), "<br/>", $str);
		return wptexturize($str);
	}
	
	static private function render_post()
	{
		global $post;
		$output = "";
		$data_text = "";
		$tit = self::remove_special_chars(get_post_field("post_title",($post->ID), "display"));
		$excerpt = self::remove_special_chars(get_post_field("post_excerpt",($post->ID), "display"), false);
		$show_databox = ((self::$a['display_post_titles'] && strlen($tit) > 0) || (self::$a['display_post_excerpts'] && strlen($excerpt) > 0));
		if(has_post_thumbnail()) $iid = get_post_thumbnail_id($post->ID);
		else $iid = self::$a['default_image_id'];
		$thumbnail = self::cmpg_upsize_image($iid, self::$a['quality'], self::$a['max_upscale_quality'], self::$a['upscale_max_width'], self::$a['upscale_max_height'], self::$a['upscale_narrow_images'], self::$a['upscale_short_images']);		
		if(!$thumbnail)
		{
			$output.="console.log('Cactus Masonry Error: -" . self::$a['default_image_id'] . "- Image with ID={$iid} cannot be found');";
			return $output;
		}
		$link_type = "a";
		$link_class = "masonry_brick_a";
		if(self::$a['link_custom_class'] != '') $link_class .= " " . self::$a['link_custom_class'];
		$link_class = "class=\"{$link_class}\"";
		$lightbox_text = " data-lightbox=\"";
		if(self::$a['browse_with_lightbox'] === true) $lightbox_text .= "thispage\"";
		else $lightbox_text .= $post->ID . "\"";
		if(self::$a['show_lightbox_title'] === true) $lightbox_text .= " data-title=\"" . $tit . "\"";
		//Set where each image links and handle any interference with the show_lightbox parameter
		if(has_post_thumbnail())
		{
			switch(self::$a['link_location'])
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
					self::$a['show_lightbox'] = false;
					break;
				default:
					$lnk = get_permalink();	
					self::$a['show_lightbox'] = false;
			}
		}
		else switch(self::$a['link_location'])
		{//Default Image
			case "image":
				$lnk = $thumbnail[0];
				break;
			case "thumbnail":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'thumbnail');
				$lnk = $lnka[0];
				break;
			case "medium":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'medium');
				$lnk = $lnka[0];
				break;
			case "large":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'large');
				$lnk = $lnka[0];
				break;
			case "full":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'full');
				$lnk = $lnka[0];
				break;
			case "none":
				$lnk = "";
				$link_type = "div";
				self::$a['show_lightbox'] = false;
				break;
			default:
				$lnk = get_permalink();	
				self::$a['show_lightbox'] = false;
		}
		if(!(self::$a['show_lightbox'] === true)) $lightbox_text = "";
		//Sort out databox
		if($show_databox)
		{
			$data_text = "<div class=\"cactus_masonry_databox\">";
			if(self::$a['display_post_titles'] && strlen($tit) > 0) $data_text .= "<div class=\"cm_title\">{$tit}</div>";
			if(self::$a['display_post_excerpts'] && strlen($excerpt) > 0) $data_text .= "<div class=\"cm_exerpt\">{$excerpt}</div>";
			$data_text .= "</div>";	
		}
		//Get div max dimensions
		if($thumbnail[4]) $max_height = self::$a['upscale_max_height'];
		else $max_height = self::$a['max_height'];
		if($thumbnail[5]) $max_width = self::$a['upscale_max_width'];
		else $max_width = self::$a['max_width'];
		//Add borders to max-heights if px values
		if(substr(strtoupper($max_width), -2) == 'PX')
		{
			$tmw = (int)(substr($max_width, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$max_width = "" . $tmw . "px";
		}
		if(substr(strtoupper($max_height), -2) == 'PX')
		{
			$tmh = (int)(substr($max_height, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$max_height = "" . $tmh . "px";
		}
		//Get div normal dimensions
		$norm_width = self::$a['width'];
		$norm_height = self::$a['height'];
		if(substr(strtoupper($norm_width), -2) == 'PX')
		{
			$tmw = (int)(substr($norm_width, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$norm_width = "" . $tmw . "px";
		}
		if(substr(strtoupper($norm_height), -2) == 'PX')
		{
			$tmh = (int)(substr($norm_height, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$norm_height = "" . $tmh . "px";
		}
		if(self::$a['masonry'] === true)
		{
			/*
				DRAW JAVASCRIPT BOX
			*/
			//Write the JavaScript
			//Start with the innerHTML of the masonry_brick DIVs
			$output .= "				s = '<{$link_type} {$lightbox_text} {$link_class} style=\"display: block;\" href=\"{$lnk}\"><img class=\"masonry_brick_img size-thumbnail\" src=\"{$thumbnail[0]}\" alt=\"{$tit}\" style=\"";
			if(!($thumbnail[5] && strpos(self::$a['upscale_max_width'], '%') !== false) && (self::$a['width'] != 'auto')) $output .= "width: 100%; ";
			$output .= "height: " . self::$a['height'] . "; ";		
			$output .= "max-height: " . self::$a['max_height'] . "; ";
			if(self::$a['crop_images']) $output .= "visibility: hidden; ";
			$output .= "\"/>";
			if(self::$a['crop_images']) $output .= "<div class=\"cactus_masonry_cropped\" style=\"background-image: url({$thumbnail[0]});\"></div>";
			//Add the databox containing the title and excerpt
			if($show_databox) $output .= $data_text;
			$output .= "</{$link_type}>';";
			//Create DOM Element for masonry_brick DIV
			$output .= "
				el = document.createElement('div');
				el.innerHTML = s;
				el.className = 'masonry_brick';
				el.style.opacity = '0';
				el.style.display = 'inline-block';
				el.style.height = '" . $norm_height . "';\n";
			//Set width
			if($thumbnail[5] && strpos(self::$a['upscale_max_width'], '%') !== false) $output .= "			el.style.width = 'auto';\n";
			else $output .= "				el.style.width = '" . $norm_width . "';\n";
			$output .= "				el.style.maxWidth = '" . $max_width . "';\n";
			$output .= "				el.style.maxHeight = '" . $max_height . "';\n";

			$output .= "				elems" . self::$id . ".push(el);\n";
			/*
				DRAW NOSCRIPT BOX
			*/
			if(!self::$a['require_javascript'])
			{
				self::$noscript_text .= "		
					<div class='masonry_brick' style='height: " . self::$a['noscript_height'] . "; width: " . self::$a['noscript_width'] . ";	max-height: " . self::$a['noscript_max_height'] . "; max-width: " . self::$a['noscript_max_width'] . ";'>
						<{$link_type} {$link_class} style='display: block; height: 100%; width: 100%' href='{$lnk}'>
							<img class='masonry_brick_img' style='display: block; height: 100%; width: 100%' src='{$thumbnail[0]}' alt='{$tit}'/>
						</{$link_type}>
					</div>";
			}
		/*
			MASONRY IS OFF
		*/
		}
		else if(!self::$a['masonry'])//Masonry OFF
		{
			self::$nomasonry_text .= "
			<div class='masonry_brick' style='display: inline-block; width: {$norm_width}; height: {$norm_height}; max-width: {$max_width}; max-height: {$max_height};' >
			<{$link_type} {$lightbox_text} {$link_class} href='{$lnk}'>
				<img class='masonry_brick_img' src='{$thumbnail[0]}' alt='{$tit}' style='";
			if(!($thumbnail[5] && strpos(self::$a['upscale_max_width'], '%') !== false) && (self::$a['width'] != 'auto')) self::$nomasonry_text .= "width: 100%; ";
			if(self::$a['crop_images']) self::$nomasonry_text .= "visibility: hidden; ";
			self::$nomasonry_text .= "height: " . self::$a['height'] . "; ";		
			self::$nomasonry_text .= "max-height: " . self::$a['max_height'] . "; ";
			self::$nomasonry_text .= "'/>";
			if(self::$a['crop_images']) self::$nomasonry_text .= "<div class='cactus_masonry_cropped' style='background-image: url({$thumbnail[0]});'></div>";
			if($show_databox) self::$nomasonry_text .= $data_text;
			self::$nomasonry_text .= "
			</{$link_type}>
		</div>\n";
		}
		return $output;
	}

	static private function cmpg_bool_to_string($bool)
	{
		return ($bool) ? "true" : "false";
	}

	static private function cmpg_fix_boolean($val, $default)
	{
		if($val === true || $val === false) return $val;
		if($val == "true") return true;
		if($val == "false") return false;
		return $default;
	}

	static private function cmpg_search_array_for_index($value, $arr, $default)
	{
		for($i = 0; $i < count($arr); $i++)
		{
			if($arr[$i] == $value) return $i;
		}
		return $default;
	}

	static private function cmpg_get_next_image_size($original, $max)
	{
		$sizes = array("thumbnail", "medium", "large", "full");
		//Get index of $max size - this will be as far as we search
		$max_size_index = cmpg_search_array_for_index($max, $sizes, count($sizes)-1)+1;
		//Return the next index value after the original element
		$found = false;
		for($i = 0; $i < $max_size_index; $i++)
		{
			if($found) return $sizes[$i];
			$found = ($sizes[$i] == $original);
		}
		return $original;
	}

	static private function cmpg_text_to_number($txt)
	{
		$out = filter_var($txt, FILTER_SANITIZE_NUMBER_INT);
		if($out == "") return 0;
		return $out;
	}

	static private function cmpg_upsize_image($ID, $quality, $max_quality, $max_width, $max_height, $min_width, $min_height)
	{
		$thumb = wp_get_attachment_image_src($ID,$quality);
		if(!$thumb) return false;
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
		if(!$thumb) return false;
		array_push($thumb, $width_resize);
		array_push($thumb, $height_resize);
		return $thumb;
	}

	/**		Creates the stylesheet for the gallery		**/
	static private function cmpg_create_styles()
	{
		return "
		<style scoped>
			div.masonry_brick
			{
				margin-bottom: " . round(self::$a['vertical_spacing']/2,1) . "px;
				padding-right: " . round(self::$a['horizontal_spacing']/2,1) . "px;
				padding-left: " . round(self::$a['horizontal_spacing']/2,1) . "px;
				margin-top: " . round(self::$a['vertical_spacing']/2,1) . "px;
				display: block;
			}
			.masonry_brick_a
			{
				border-width: " . self::$a['outer_border_thickness'] . ";
				border-color: " . self::$a['outer_border_color'] . ";
				background-color: " . self::$a['hover_color'] . ";
			}
			img.masonry_brick_img:hover
			{
				opacity: " . self::$a['hover_intensity'] . ";
			}
			div.masonry_post_gallery
			{
				" . self::cmpg_return_if_true(self::$a['gallery_align'] == "left" || self::$a['gallery_align'] == "center", "margin-right: auto;") . "
				" . self::cmpg_return_if_true(self::$a['gallery_align'] == "right" || self::$a['gallery_align'] == "center", "margin-left: auto;") . "
			}
			img.masonry_brick_img, div.cactus_masonry_cropped
			{
				border-width: " . self::$a['border_thickness'] . ";
				border-color: " . self::$a['border_color'] . ";
				background-color: " . self::$a['image_background_color'] . ";
			}
		</style>";
	}

	static private function cmpg_return_if_true($test, $text_if_true, $text_if_false = "")
	{
		if($test) return $text_if_true;
		return $text_if_false;
	}

	static private function cmpg_create_javascript()
	{
		$output = "";
		if(self::$a['masonry'] === true)
		{
			//JavaScript to load the gallery.  If the gallery is AJAXed, then the external JS files may not be ready.
			//   So, set the load on a timer and check for readiness if not already uh.. ready...
			$output .= "
		<script type='text/javascript'>
			jQuery(document).ready(function()
			{
				function cm" . self::$id . "_drawGallery()
				{				
					var cm" . self::$id . " = new Cactus_Masonry(" . self::cmpg_bool_to_string(self::$a['show_loader']) . ", " . self::cmpg_bool_to_string(self::$a['infinite_scroll']) . ", " . self::$a['posts_per_page'] . ", '" . self::$id . "', IE_LT_9" .self::$id . ", '" . self::$a['width'] . "', " . self::$a['soft_gutter'] . ", " . self::cmpg_bool_to_string(self::$a['fit_width']) . ", " . self::cmpg_bool_to_string(self::$a['force_auto_width']) . ");
					cm" . self::$id . ".drawGallery(elems" . self::$id . ");	
				}
				function cm" . self::$id . "_testGallery()
				{
					if(typeof Cactus_Masonry === 'function')
					{
						window.clearInterval(timer" . self::$id . ");
						cm" . self::$id . "_drawGallery();
					}
				}
				if(typeof Cactus_Masonry === 'function') cm" . self::$id . "_drawGallery();
				else timer" . self::$id . " = window.setInterval(cm" . self::$id . "_testGallery,10);
			});
		</script>\n";
		}
		return $output;
	}
}
Cactus_Masonry::init();
?>