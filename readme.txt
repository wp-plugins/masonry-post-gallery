=== Plugin Name ===
Contributors: bortpress
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nge%40tpg%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: Posts, Gallery, Masonry, Image
Requires at least: 3.9.1
Tested up to: 3.9.1
Stable tag: 0.1b
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a customizable gallery of your posts in either a grid or a masonry layout.

== Description ==

Creates a customizable grid or masonry styled gallery of posts using just a shortcode.

Posts can be searched by category and ordered by title, date, random, and so forth.

This plugin will show a gallery of post thumbnails that link to said posts.  Great for an art, image, or photo site... i guess :).

Just install and enter the [masonry-post-gallery] shortcode to get started.  There are a whole bunch of parameters in the documentation to help you customize your results.

Feel free to comment or [donate something](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nge%40tpg%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted "yey!") if you like it... or don't.  I'm just a readme and cannot tell you want to do.

== Installation ==

Click the download link, install and click activate.  Just like any other plugin.  Nothing different here.

== Changelog ==

= 0.1b =
* The initial version is released.  This is a testing beta, so there will be revisions, and some features may not work as planned.

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

== Gallery Parameter List ==

= quality =
This sets the quality of the thumbnails loaded.  Using a quality that is too low will lead to low image quality.  Using a quality too high will make the page too slow to load and use up your bandwidth.  Consider the physical size of the images you are displaying and how your image sizes are configures in WordPress.  You can find this option under the Settings | Media menu within WordPress.

Default value:    "thumbnail"

Possible values:  "thumbnail", "medium", "large", "full"

= masonry =
Turns masonry layout on or off.  With masonry off, the images will be displayed as a grid.  This would work best if each images width and height is uniform.

Default value:    true

Possible values:  true, false

= max_width =
Limits the maximum width of each image.  Setting this will form a column layout of the same width.  Smaller items won’t be affected.

Default value:    "300px" 

Possible values:  "##px" or "##%" or "auto"

= max_height =
Limits the maximum height of each image.

Default value:    "300px"

Possible values:  "##px" or "##%" or "auto"

= width =
Forces the width of each image, regardless of its actual size.  This can cause an image to stretch.

Default value:    "auto"

Possible values:  "##px" or "##%" or "auto"

= height =
Forces the height of each image, regardless of its actual size.  This can cause an image to stretch.

Default value:    "auto"

Possible values:  "##px" or "##%" or "auto"

= horizontal_spacing =
The horizontal spacing between each image – measured in pixels.

Default value:    10

Possible values:  Any whole number, e.g. 0, 5, 25, etc

= vertical_spacing =
The vertical spacing between each image – measured in pixels.

Default value:    10

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

= gallery_align =
Specifies whether the entire gallery is aligned to the left, right, or centre of the page.  This does not align the images within the gallery.

Default value:    "center"

Possible values:  "left", "right", "center

== Frequently Asked Questions == 

No, nothing to see here.  Move along.

== Upgrade Notice ==

Uh?

== Screenshots ==

Sorry, I don't have enough pretty pictures yet.


