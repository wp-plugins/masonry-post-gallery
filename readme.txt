=== Plugin Name ===
Contributors: bortpress
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=cactus%40cactuscomputers%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: Posts, Gallery, Masonry, Image, Post Gallery, Thumbnail Gallery
Requires at least: 3.9.1
Tested up to: 4.0.0
Stable tag: 0.3.7.0b
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a customizable gallery of your posts in either a grid or a masonry layout.

== Description ==
= What is Cactus Masonry? =

Cactus Masonry is a WordPress plugin designed to display a gallery of post and/or page thumbnails that can be filtered, sorted, and treated as hyperlinks.

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

= 0.3.7.0b =
* Updated the infinite scroll to allow for IE8 compatibility
* Fixed bug in infinite scroll code that would sometimes stop a page from loading until the user scrolled the page up
* Improved the infinite scroll loading buffer to better address a range of scenarios
* Removed the spinner from the loading box when run within IE8 to reduce outdated browser related bugs
* Cleaned up code to slightly improve performance and improve backwards compatibility
* Added parameters to allow for better gallery handling on browsers where JavaScript is disabled
* Added the require_javascript parameter which will hide the gallery when set to true on any browser without JavaScript
* Added the javascript_error_message parameter to set an error message that should be displayed when JavaScript is disabled
* Fixed noscript_height and noscript_width to force images to a specific size when JavaScript is disabled.
* Fixed a small typo and updated a link in the documentation
* Added the upgrade notice

= 0.3.6.1b =
* Modified documentation to improve readability
* Fixed a bug that affected the post/page sort order since the last update

= 0.3.6.0b =
* Added link to plugin home page in short description
* Updated function names to reduce the chance of a conflict
* Restructured some code to improve flow and testing capabilities
* Added the ability to specify a default image.  Now posts without a featured image can be shown if a default image is specified.
* Added the ability to search for posts, pages, posts and pages, or nothing at all
* Added an instructions page under the WordPress Dashboard Settings menu
* Improved documentation on website to address new features

= 0.3.5.4b =
* Improved plugin short description to reduce confusion
* Reorganized code output to fix a W3C compliance issue
* Small code layout fixes

= 0.3.5.3b =
* Fixed an error that could occur when displaying posts with an apostrophe in their title

= 0.3.5.2b =
* Masonry Post Gallery is renamed to Cactus Masonry 
* Improved documentation on Cactus Masonry website
* Plugin documentation has been rewritten
* The [cactus-masonry] shortcode can now be used (while maintaining reverse compatibility)
* Added the search_start parameter which allows the post query to be offset by a given number of posts
* Added the page_size parameter which allows the post query to be limited to a given number of matches

= 0.3.5.1b =
* Implemented an option to show or hide the infinite scroll loader
* Updated the documentation to use the masonry website and shortcode generator
* Added links to the masonry home page to the WordPress plugin page

= 0.3.5.0b =
* Greatly improved gallery efficiency on load and window resize
* Fixed a layout sizing error when maxWidth is set

= 0.3.4.4b =
* Fixed error that occurs on multipage galleries

= 0.3.4.3b =
* Fixed script breaking bug caused by typo

= 0.3.4.2b =
* Fixed error on IE8 that stopped images from loading
* Fixed incompatibility with IE8 that affected the loading box
* Now masonry disables on IE7 and earlier 

= 0.3.4.1b =
* A compatibility fix for different versions of PHP

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

= 0.3.2b =
* Fixed a bug that stopped the category parameter from working

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

= 0.2.0b =
* Updated upscaling feature.  Now has the option to independently set max_height and max_width for upscaled objects.
* Made MPG more functional in the absence of JavaScript.
* Added to option to specify a grid layout that will take effect when JavaScript is disabled
* Updated the documentation to recognize these changes 

= 0.1.5b =
* Added upscaling feature.  Now images that are shorter or narrower than a specified width or height can be upscaled until they reach the specified size.  The image thumbnail quality will be increased until it reaches the largest size available, reaches the largest size specified under the max_upscale_size parameter, or reaches or exceeds the max_height or max_width parameters. 
* Removed support for percentages in the max_height and max_width fields
* Updated the documentation to include new features
* Added padding to the top of the loading box

= 0.1.1b =
* Incompletely implemented post_order and post_orderby parameters fixed
* Default max_width and max_height parameters changed to "none"
* Default horizontal_spacing and vertical_spacing set to 0
* Minor correction made to the parameters section of the documentation to reflect these changes
* Minor correction made to the parameters section of the documentation to fix incorrect parameter options
* Additional information added to the parameters section of the documentation to clarify the behaviour of the vertical and horizontal spacing

= 0.1.0b =
* The initial version is released.  This is a testing beta, so there will be revisions, and some features may not work as planned.

== Frequently Asked Questions == 

No, nothing to see here.  Move along.

== Upgrade Notice ==

= 0.3.7.0b =
Upgrade for a number of new features and new IE8 backwards compatibility.  Cactus Masonry now has better error detection and handling abilities when dealing with browsers with JavaScript disabled.  Now default image sizes, error messages, and gallery behaviour can be modified to suit any browser with JavaScript disabled.  The infinite scroll feature has been improved to remove a bug, work on IE8, and perform under a variety of different conditions.  Upgrade notices have also been added and the Cactus Masonry WordPress.org listing has been improved.

= 0.3.6.1b =
Upgrade for a bug fix and some modified documentation to improve readability

= 0.3.6.0b =
Upgrade for a variety of new exciting features including improved documentation, a default image parameter (for posts with no image), the ability to show pages as well as posts, and an instructions page in WordPress itself!

= 0.3.5.4b =
Upgrade for improved W3C compliance, code fixes, and improved documentation

= 0.3.5.3b =
Upgrade to fix an error that could occur when displaying posts with an apostrophe in their title

= 0.3.5.2b =
Upgrade to enjoy the new version of Masonry Post Gallery - now called Cactus Masonry! The new version comes with some exciting new features to match its exciting new name.  The new version has a new shortcode (but maintains reverse compatibility), new search parameters, and some rewritten documentation.

= 0.3.5.1b =
Upgrade for an option to show/hide the loading box and for much improved documentation

= 0.3.5.0b =
Upgrade for greatly improved gallery efficiency on load and window resize and to fixed a layout sizing error that occurs when maxWidth is set

= 0.3.4.4b =
Upgrade to fix an error that occurs on multipage galleries

= 0.3.4.3b =
Upgrade to address a script breaking bug

= 0.3.4.2b =
Upgrade to fix a bug in IE8 that stopped images from loading and affected the loading box. The new version checks for older versions of IE to avoid displaying a broken website on an incompatible and outdated browser.

= 0.3.4.1b =
Upgrade for a compatibility fix to address some older versions of PHP

= 0.3.3b =
Upgrade for new infinite scroll functionality to heavily improve performance and user experience.  This update also contains various bug fixes.

= 0.3.2b =
Upgrade to fix a bug that stopped the category parameter from working

= 0.3.1b =
Upgrade for a major gallery positioning bug fix, coding improvements, border and spacing behaviour improvements, code fixes, and a variety of other improvements.

= 0.3.0b =
Upgrade for a width/height bug fix, new image link options, new lightbox functionality, redesigned code for future-proofing, a major shortcode bug fix, various smaller bug fixes, and more consistent documentation.

= 0.2.0b =
Upgrade for new features and some JavaScript free functionality.

= 0.1.5b =
Upgrade for new features, bug fixes, display improvements, and more documentation

= 0.1.1b =
Upgrade for fixed broken sort parameters, improved default sizing and spacing values, some parameter changes, and documentation improvements.

== Screenshots ==

Check out the [Cactus Masonry Website](http://cactuscomputers.com.au/masonry) to see the plugin in action!


