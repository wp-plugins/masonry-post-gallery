=== Plugin Name ===
Contributors: bortpress
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nge%40tpg%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: Posts, Gallery, Masonry, Image
Requires at least: 3.9.1
Tested up to: 4.0.0
Stable tag: 0.3.5.1b
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a customizable gallery of your posts in either a grid or a masonry layout.

== Description ==

Creates a customizable grid or masonry styled gallery of posts using just a shortcode.

This is a FREE and FULL VERSION plugin that does NOT limit its functionality until you have payed.  While a donation would be nice, no money is required to use this plugin.

Posts can be searched by category and ordered by title, date, random, and so forth.

This plugin will show a gallery of post thumbnails that link to said posts.  Great for an art, image, or photo site... i guess :).

The images can also link to themselves, a different sized thumbnail, or a lightbox gallery.

Just install and enter the [masonry-post-gallery] shortcode to get started.  There are a whole bunch of parameters in the documentation under "Other Notes" to help you customize your results.

Feel free to comment or [donate something](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nge%40tpg%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted "yey!") if you like it... or don't.  I'm just writing, I can't tell you want to do.

Please not that while I will try to improve this plugin and fix any bugs, it is distributed as is.  It's still in beta and may have issues.

Also, [email any FEEDBACK, BUGS and IDEAS](mailto:cactus@cactuscomputers.com.au "me!") you may have for the plugin!


== Installation ==

Click the download link, install and click activate.  Just like any other plugin.  Nothing different here.

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
* Added links to the masonry home page to the Wordpress plugin page

== Dependencies ==

Masonry Post Gallery requires the following js files, which are included in the package, i.e. you don't have to worry about it.  But credit where credit is due, thus this section.

**The Amazing Masonry Post Gallery**
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

== How to Use ==

Call Masonry Post Gallery (MPG) by using the MPG shortcode in a post or page.
[masonry-post-gallery]

When you view the page, [masonry-post-gallery] will be replaced with the MPG.

== How to Change the Gallery's Appearance ==

You can use parameters to change how the MPG behaves.  Parameters are to be entered into the shortcode after the words “masonry-post-gallery”.  All parameters are optional.
Parameters are optional and must be separated by a space.  

[masonry-post-gallery border_color="#225500" border_thickness="5px"]

*The example above will add a 5 pixel thick dark-green border around each image.*

IMPORTANT:  Note that each parameter is case and context sensitive.  A capital in the wrong place can cause a parameter not to work. Also note that each parameter may or may not have inverted commas around it (“…”).  Incorrect inverted comma use will affect whether a parameter works.  Finally, words such as centre use the American spelling, center.  Follow the parameter format listed in the table below.

Go to http://cactuscomputers.com.au/masonry/ to see a full list of shortcode commands and to use our shortcode generator!

== Frequently Asked Questions == 

No, nothing to see here.  Move along.

== Upgrade Notice ==

Uh?

== Screenshots ==

Sorry, I don't have enough pretty pictures yet.


