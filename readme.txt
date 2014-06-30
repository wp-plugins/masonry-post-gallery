=== Plugin Name ===
Contributors: bortpress
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nge%40tpg%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: Posts, Gallery, Masonry, Image
Requires at least: 3.9.1
Tested up to: 3.9.1
Stable tag: 0.31b
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

= 0.1b =
* The initial version is released.  This is a testing beta, so there will be revisions, and some features may not work as planned.

= 0.11b =
* Incompletely implemented post_order and post_orderby parameters fixed
* Default max_width and max_height parameters changed to "none"
* Default horizontal_spacing and vertical_spacing set to 0
* Minor correction made to the parameters section of the documentation to reflect these changes
* Minor correction made to the parameters section of the documentation to fix incorrect parameter options
* Additional information added to the parameters section of the documentation to clarify the behaviour of the vertical and horizontal spacing

= 0.15b =
* Added upscaling feature.  Now images that are shorter or narrower than a specified width or height can be upscaled until they reach the specified size.  The image thumbnail quality will be increased until it reaches the largest size available, reaches the largest size specified under the max_upscale_size parameter, or reaches or exceeds the max_height or max_width parameters. 
* Removed support for percentages in the max_height and max_width fields
* Updated the documentation to include new features
* Added padding to the top of the loading box

= 0.2b =
* Updated upscaling feature.  Now has the option to independently set max_height and max_width for upscaled objects.
* Made MPG more functional in the absence of JavaScript.
* Added to option to specify a grid layout that will take effect when JavaScript is disabled
* Updated the documentation to recognize these changes 

= 0.3b =
* Fixed the percentage column/row width/height functionality.  Now 33% will give three columns with images fitting their column sizes.
* Added the option to specify whether each image will link to its post, itself, a different sized version of itself, or nowhere
* Added the capability to display a lightbox style gallery using the show_lightbox parameter
* Removed any absolute paths to the plugins directory to make plugin more robust to future WordPress versions
* Fixed some more bugs that have arose with certain image size and alignment functionality
* Fixed the percentage width and height functionalities
* Fixed a problem with boolean shortcode parameters
* Fixed an inconsistancy in the wording of the shortcode instructions
* Updated the documentation to recognize these changes

= 0.31b =
* Fixed a bug where the gallery wold always appear at the top of the page
* Changed how the borders work to make them more reliable and even
* Changed how the spacing and widths behave to make percentage based column layouts more reliable
* Added a flexible border parameter called soft_gutter
* Fixed a bug where the fit_width parameter would break the code
* Set fit_width to "false" by default as it interacts with columns set to a percentage width causing the page to look wrong while loading
* Made stylesheet improvements to fix minor display issues
* Small documentation errors have been fixed
* Published fit_width parameter to documentation
* Updated documentation to suite changes

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

== MPG Image Quality Parameters ==
= quality =
This sets the quality of the thumbnails loaded.  Using a quality that is too low will lead to low image quality.  Using a quality too high will make the page too slow to load and use up your bandwidth.  Consider the physical size of the images you are displaying and how your image sizes are configures in WordPress.  You can find this option under the Settings | Media menu within WordPress.

Default value:    "thumbnail"

Possible values:  "thumbnail", "medium", "large", "full"

= upscale_narrow_images =
If an image is less wide than this figure (in pixels) then it will be displayed as the next size up, e.g. a thumbnail will be displayed as a medium if it is narrower than the specified figure.  If this figure is set to 0, then this feature is disabled.

Default value:    0

Possible values:  Any whole number

= upscale_short_images =
If an image is less tall than this figure (in pixels) then it will be displayed as the next size up, e.g. a thumbnail will be displayed as a medium if it is narrower than the specified figure.  If this figure is set to 0, then this feature is disabled.

Default value:    0

Possible values:  Any whole number

= max_upscale_quality =
Sets the maximum size an image can upscale to when the upscale_short_images or upscale_narror_images features are enabled.

Default value:    "large"

Possible values:  "thumbnail", "medium", "large", "full"

= upscale_max_width =
Sets the maximum width of upscaled items.  It is likely that items that have been scaled by height will have a larger width to height ratio.  Therefore, it makes sense to give them more space on screen.  Perhaps double that of the regular items with a max_width setting.

Default value:    "none" 

Possible values:  "##px" or "none", e.g. "300px"

= upscale_max_height =
Sets the maximum height of upscaled items.  It is likely that items that have been scaled by width will have a larger height to width ratio.  Therefore, it makes sense to give them more space on screen.  

Default value:    "none" 

Possible values:  "##px" or "none", e.g. "300px"

== MPG Function and Link Parameters ==
= masonry =
Turns masonry layout on or off.  With masonry off, the images will be displayed as a grid.  This would work best if each images width and height is uniform.

Default value:    "true"

Possible values:  "true" or "false"

= show_lightbox =
Should clicking on an image display an enlarged view of that image on the screen – or should it take the user to another page specified by the link_location parameter.

When set to "true", clicking on an image will show a lightbox gallery of the clicked image rather than change pages.

The size (i.e. thumbnail through to full) of the image to be displayed by the lightbox gallery can be specified using the link_location parameter.

If show_lightbox is "true" and link_location is "medium" then the medium sized version of the image will be shown in the lightbox gallery.

Default value:    "false"

Possible values:  "true" or "false"

= link_location = 
Specifies to where each image will link if clicked.

If set to "post", each image will link to its associated post.  If set to "image", each image will link to the image file displayed in the results (at the size that is displayed).  A specific size of each image can be linked to by specifying "thumbnail", "medium", "large", or "full".  Finally, specifying "none" will remove each image’s linking capability and hover effect.

This parameter will set the show_lightbox parameter to "false" if "post" or "none" is selected.  Otherwise, the lightbox gallery is set to "true" it will show the image size chosen by this parameter.

Default value:    "post"

Possible values:  "post", "image", "thumbnail", "medium", "large", "full", or "none"

= show_lightbox_title =
Specifies whether the title of each post should be displayed in the lightbox.  This parameter has no effect if show_lightbox is set to "false".

Default value:    "false"

Possible values:  "true" or "false"

= browse_with_lightbox =
Determines whether the user can browse each image on the page from within the lightbox.  

If set to "true", the user can change images from within the lightbox.

If set to "false", the user will have to exit the lightbox and select another image to move on.

This parameter has no effect if show_lightbox is set to "false".

Default value:    "false"

Possible values:  "true" or "false"

== MPG Image Appearance & Layout Parameters ==
= max_width =
Limits the maximum width of each image.  Setting this will form a column layout of the same width.  Smaller items won’t be affected.

Default value:    "none" 

Possible values:  "##px" or "none", e.g. "300px"

= max_height =
Limits the maximum height of each image.

Default value:    "none"

Possible values:  "##px" or "none", e.g. "300px"

= width =
Forces the width of each image, regardless of its actual size.  This can cause an image to stretch.  By setting this width to a percentage (e.g. "33%") and leaving the height unspecified, you can create a set of evenly sized columns without stretching the images.

Default value:    "auto"

Possible values:  "##px" or "##%" or "auto", e.g. "150px"

= height =
Forces the height of each image, regardless of its actual size.  This can cause an image to stretch.

Default value:    "auto"

Possible values:  "##px" or "##%" or "auto", e.g. "150px"

= horizontal_spacing =
The hard horizontal spacing between each image – measured in pixels.

Default value:    0

Possible values:  Any whole number, e.g. 0, 5, 25, etc

= vertical_spacing =
The hard vertical spacing between each image – measured in pixels.

Default value:    0

Possible values:  Any whole number, e.g. 0, 5, 25, etc 

= soft_gutter =
The soft horizontal spacing between each image.  This spacing will only appear if there is enough room - the images will take priority.

Default value:    0

Possible values:  Any whole number, e.g. 0, 5, 25, etc

= border_color =
The colour of the image’s borders.  Borders won’t show up unless their thickness is greater than zero – see below.

Default value:    "#000000"

Possible values:  A hexadecimal colour – e.g. "#ffffff" for white, "#000000" for black, and any combination in between.  Additionally approved CSS colour words can be used – e.g. "black", "white", "red", "blue", "darkgreen", etc 

= border_thickness =
The thickness of the image’s borders in pixels.  "0px" will hide the borders.

Default value:    "0px"

Possible values:  "##px"

= hover_color =
The colour each image turns (or glows) when the mouse is hovered overhead.  The default is a white hover.

Default value:    "#ffffff"

Possible values:  A hexadecimal colour – e.g. "#ffffff" for white, "#000000" for black, and any combination in between.  Additionally approved CSS colour words can be used – e.g. "black", "white", "red", "blue", "darkgreen", etc 

= hover_intensity =
The strength of the hover effect for each image when the mouse is overhead.  This is linked to the hover_color parameter above.  This value can range from "0" to "1".  Entering "1" will disable the hover effect, while entering "0" will make the image completely invisible on hover.  Decimals may be used.

Default value:    "0.5"

Possible values:  Any decimal between "1" and "0", e.g. "0.75", "0.4", "1", "0.1", etc

== MPG Post Search & Display Parameters ==
= post_category =
The category of posts to show in the gallery.  You can specify a post’s category while editing it in WordPress.  Omitting this parameter will cause the gallery to show all posts.  Only posts with a thumbnail image will display in the gallery.

Default value:    "" 

Possible values:  "category name"

= post_orderby =
In what order should the posts be displayed.  They are sorted by date by default.

Default value:    "post_date"

Possible values:  "none", "ID", "author", "title", "date", "modified", "rand", "comment_count"

= post_order =
In which order should the posts be sorted – i.e. ascending or descending.  This relates to the post_orderby paramenter above.

Default value:    "DESC"

Possible values:  "ASC", "DESC"

== MPG Gallery Display Parameter ==
= gallery_align =
Specifies whether the entire gallery is aligned to the left, right, or centre of the page.  This does not align the images within the gallery.

Default value:    "center"

Possible values:  "left", "right", "center

= fit_width =
Specifies whether the gallery width grows with its contents.  If "false", then the gallery will be 100% of the width of its parent window, div or DOM object.  If "true" then the gallery will be as wide as its contents.

This parameter should be set to "false" if the image width parameter is set to a percentage

Default value:    "false"

Possible values:  "true" or "false"

== MPG JavaScript Contingency Parameters ==
These parameters exist for when JavaScript is turned off.  Masonry cannot function without JavaScript, so these parameters help you display a workable gallery even when Masonry is not functioning.  Without JavaScript the gallery will revert to a grid layout. 

= noscript_max_width =
This setting here allows you to specify the max_width of each image should JavaScript be disabled. 

This value can be set to a percentage.  "33%" will generate three columns as that is 30% of the layout area.  This can be used in conjunction with the parameters below to create a centred grid layout. 

Default value:    "none"

Possible values:  "##px", "##%" or "none", e.g. "300px" or "33%"

= noscript_max_height =
This allows you to specify the max_height of each image should JavaScript be disabled.

Default value:    "none"

Possible values:  "##px" or "none", e.g. "300px"

= noscript_width =
This allows you to force the width of each element should JavaScript be disabled.

Default value:    "auto"

Possible values:  "##px" or "##%" or "auto", e.g. "150px"

= noscript_height =
This allows you to force the height of each element should JavaScript be disabled.

Default value:    "auto"

Possible values:  "##px" or "##%" or "auto", e.g. "150px"

== Frequently Asked Questions == 

No, nothing to see here.  Move along.

== Upgrade Notice ==

Uh?

== Screenshots ==

Sorry, I don't have enough pretty pictures yet.


