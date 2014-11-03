=== Plugin Name ===
Contributors: bortpress
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nge%40tpg%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: Posts, Gallery, Masonry, Image, Post Gallery, Thumbnail Gallery
Requires at least: 3.9.1
Tested up to: 4.0.0
Stable tag: 0.3.5.3b
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a customizable gallery of your posts in either a grid or a masonry layout.

== Description ==
= What is Cactus Masonry? =

Cactus Masonry (originally called the Masonry Post Gallery… very original) is a WordPress plugin designed to display a gallery of post thumbnails that can be filtered, sorted, and treated as hyperlinks.

In other words, a Cactus Masonry gallery will display a list of all matching posts which link back to their permalinks when clicked! This functionality would be perfect for an art or photo gallery where further information needs to be displayed on each item. Of course, you can choose where each picture links, whether back to the original image (at a size of your choosing), the original post, a Lightbox styled gallery, or nowhere at all.

As Cactus Masonry essentially searches your WordPress site for posts, you can specify which category (or categories) of post to display, and sort those posts by date, comment count, author, randomly, and more!

You can also specify the layout options for the pictures. By default, the pictures are positioned in a masonry styled layout, where the images are slotted into each other like irregular bricks in an old stone wall. However, you can force the plugin to restrict or constrain the heights or widths of the images to create a tidy and whitespace free gallery of images. Check out the [Cactus Masonry Home Page](http://cactuscomputers.com.au/masonry) for an example where the width has been constrained to 33.3%.

You may also specify how the images glow when the user’s mouse hovers overhead, whether the images have borders, and how much (if any) spacing should exist between each image.

The Cactus Masonry plugin provides a versatile WordPress plugin that allows you to display your posts by their thumbnail in a clean and visually pleasing format. 

= Can I See it In Action? =

Yes, go to the main page of [Cactus Masonry Website](http://cactuscomputers.com.au/masonry) to check it out! 

= Does it Cost Money? =

No, it’s all free to use. This is not one of those “free” plugins that require a payment before you can use any of its useful features. This is completely free – no watermarks, no ads, no nagging. Just one free plugin.

However, it did take a fair amount of time to make… so if you are feeling generous… feel free to [donate something](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=cactus%40cactuscomputers%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted). But no pressure or anything :). 

= Can I Make a Feature Request? =

Yes. Contact us and we will consider any requests that are feasible and within the scope of the plugin. 

== Installation ==

Just click the Download link and Activate it!

Cactus Masonry is currently undergoing a name change to match the documentation website, so these instructions may change shortly. This will unfortunately require older copies of Masonry Post Gallery to be replaced with the newer Cactus Masonry – although backwards compatibility will remain.

To Upgrade from Masonry Post Gallery within WordPress:

    Disable Masonry Post Gallery from within WordPress
    Choose Add New Plugin
    Search for Cactus Masonry
    Download and activate the new plugin. As Cactus Masonry is reverse compatible, no code changes will be required.

To Install Cactus Masonry within WordPress:

    Choose Add New Plugin
    Search for Cactus Masonry
    Download and activate the new plugin.

Cactus Masonry is also available from the [Cactus Masonry Website](http://cactuscomputers.com.au/masonry) as a zip file for manual installation. 

= How Do I Use Cactus Masonry? =

Simple. If you can use a shortcode, then you can use Cactus Masonry.

A shortcode is a special piece of code you can insert into your WordPress posts and pages which links to an active plugin. If you insert [cactus-masonry] into one of your posts, you will see the Cactus Masonry gallery appear when you view (or preview) that post.

The shortcode can take a variety of parameters. For example, [cactus-masonry width=”33.33%”] will generate a gallery were each image is a third of the page wide. An example of this can be seen on the main page of the [Cactus Masonry Website](http://cactuscomputers.com.au/masonry). You can use as many or as few parameters in your shortcode as you want.

For a full list of Cactus Masonry’s shortcode parameters, visit the [Shortcode Parameters](http://cactuscomputers.com.au/masonry/gallery-options) page.

Alternately, visit the [Shortcode Generator](http://cactuscomputers.com.au/masonry/short-code-generator) to have your shortcode made for you! 

== Changelog ==

= 0.1.0b =
* The initial version is released.  This is a testing beta, so there will be revisions, and some features may not work as planned.

= 0.1.1b =
* Incompletely implemented post_order and post_orderby parameters fixed
* Default max_width and max_height parameters changed to "none"
* Default horizontal_spacing and vertical_spacing set to 0
* Minor correction made to the parameters section of the documentation to reflect these changes
* Minor correction made to the parameters section of the documentation to fix incorrect parameter options
* Additional information added to the parameters section of the documentation to clarify the behaviour of the vertical and horizontal spacing

= 0.1.5b =
* Added upscaling feature.  Now images that are shorter or narrower than a specified width or height can be upscaled until they reach the specified size.  The image thumbnail quality will be increased until it reaches the largest size available, reaches the largest size specified under the max_upscale_size parameter, or reaches or exceeds the max_height or max_width parameters. 
* Removed support for percentages in the max_height and max_width fields
* Updated the documentation to include new features
* Added padding to the top of the loading box

= 0.2.0b =
* Updated upscaling feature.  Now has the option to independently set max_height and max_width for upscaled objects.
* Made MPG more functional in the absence of JavaScript.
* Added to option to specify a grid layout that will take effect when JavaScript is disabled
* Updated the documentation to recognize these changes 

= 0.3.0b =
* Fixed the percentage column/row width/height functionality.  Now 33% will give three columns with images fitting their column sizes.
* Added the option to specify whether each image will link to its post, itself, a different sized version of itself, or nowhere
* Added the capability to display a lightbox style gallery using the show_lightbox parameter
* Removed any absolute paths to the plugins directory to make plugin more robust to future WordPress versions
* Fixed some more bugs that have arose with certain image size and alignment functionality
* Fixed the percentage width and height functionalities
* Fixed a problem with boolean shortcode parameters
* Fixed an inconsistancy in the wording of the shortcode instructions
* Updated the documentation to recognize these changes

= 0.3.1b =
* Fixed a bug where the gallery would always appear at the top of the page
* Added a number of code improvements including an external CSS file
* Changed how the borders work to make them more reliable and even
* Changed how the spacing and widths behave to make percentage based column layouts more reliable
* Added a flexible border parameter called soft_gutter
* Fixed a bug where the fit_width parameter would break the code
* Set fit_width to "false" by default as it interacts with columns set to a percentage width causing the page to look wrong while loading
* Made stylesheet improvements to fix minor display issues
* Small documentation errors have been fixed
* Published fit_width parameter to documentation
* Updated documentation to suite changes
* Changed the plugins version numbering system to better match WordPress standards and easier to update

= 0.3.2b =
* Fixed a bug that stopped the category parameter from working

= 0.3.3b =
* Added infinite scroll functionality to improve loading speed on larger pages
* Added the infinite_scroll parameter to toggle infinite scroll
* Added the posts_per_page to determine the number of images to load each time with the infinite scroll
* Made the loading box float at the top centre of the screen
* Addressed graphical bugs with the loading box
* Improved code efficiency
* Removed support for the height parameter set as a percentage
* Fixed a bug that stopped the height parameter from working properly
* Fixed a bug that stopped the vertical spacing parameter from working properly
* Fixed a bug that made the vertical spacing half that of the horizontal spacing
* Fixed a bug with the hover colour parameter
* Fixed a bug where the loading box will block mouse clicks
* Set the default horizontal and vertical spacing values to 10

= 0.3.4.1b =
* A compatibility fix for different versions of PHP

= 0.3.4.2b =
* Fixed error on IE8 that stopped images from loading
* Fixed incompatibility with IE8 that affected the loading box
* Now masonry disables on IE7 and earlier 

= 0.3.4.3b =
* Fixed script breaking bug caused by typo

= 0.3.4.4b =
* Fixed error that occurs on multipage galleries

= 0.3.5.0b =
* Greatly improved gallery efficiency on load and window resize
* Fixed a layout sizing error when maxWidth is set

= 0.3.5.1b =
* Implemented an option to show or hide the infinite scroll loader
* Updated the documentation to use the masonry website and shortcode generator
* Added links to the masonry home page to the WordPress plugin page

= 0.3.5.2b =
* Masonry Post Gallery is renamed to Cactus Masonry 
* Improved documentation on Cactus Masonry website
* Plugin documentation has been rewritten
* The [cactus-masonry] shortcode can now be used (while maintaining reverse compatibility)
* Added the search_start parameter which allows the post query to be offset by a given number of posts
* Added the page_size parameter which allows the post query to be limited to a given number of matches

= 0.3.5.3b =
* Fixed an error that could occur when displaying posts with an apostrophe in their title

== Dependencies ==

Masonry Post Gallery requires the following js files, which are included in the package, i.e. you don't have to worry about it.  But credit where credit is due, thus this section.

**The Amazing Cactus Masonry**
Made by me!

**Masonry**

This JavaScript file handles the masonry layout.  This makes everything possible.

By David DeSandro - you can [find it here](http://masonry.desandro.com/ "masonry JS") under an MIT licence

**ImagesLoaded**

This JavaScript file ensures each image is loaded before the layout is updated.  Otherwise, their sizes would be unknown and they would overlap.  This makes everything possible including the loading bar.

By Tomas Sardyha and David DeSandro - you can [find it here](http://imagesloaded.desandro.com/ "ImagesLoaded JS") under an MIT licence

**spin.js**

This allows the little round loading animation to exist.

By Felix Gnass - you can [find it here](http://fgnass.github.io/spin.js/ "Spin JS") under an MIT licence

**Lightbox**
This is used to display the lightbox style galleries used by the plugin.  This requires JQuery to function.

By Lokesh Dhakar - you can [find it here](http://www.lokeshdhakar.com/projects/lightbox2/ "Lightbox") under a [Creative Commons Attribution 2.5](http://creativecommons.org/licenses/by/2.5/ "CC 2.5") licence

== Frequently Asked Questions == 

No, nothing to see here.  Move along.

== Upgrade Notice ==




Uh?

== Screenshots ==

Sorry, I don't have enough pretty pictures yet.


