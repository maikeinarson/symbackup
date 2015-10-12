=== Content Grid Slider ===

Contributors: CouncilSoft Inc.
Donate link: http://www.councilsoft.com/donate/
Tags: random tabs, rotating tabs, rotating services, custom post slider, sliders,  grid slider, text slider, quick services, services, data services, custom page links, grid carousel slider, carousel slider, jquery carousel, jquery grid carousel, carousel content slider
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A fully responsive carousel type Content Slider with Grid layout. Showcase and spotlight your services or products with this awesome slider.


== Description ==

<p><a href="http://www.councilsoft.com/products/wordpress-plugins/content-grid-slider/" target="_blank">Plugin's Link</a></p>
<p><a href="http://www.councilsoft.com/content-grid-slider-demo/" target="_blank">Plugin's Demo</a></p>

Content Grid Slider uses custom post type for slides.

This plugin allows you to add a carousel type grid slider with posts containing text and a custom link to redirect on a custom page by using custom posts.

You can make different groups of posts depending upon your requirements.

You can add custom page URL's to your posts where you want to redirect users. You can use this on pages(recommended), widgets and even in your template files via shortcode.

You have full control over their grouping and their sort order.

A new feature of preview in color settings page has also been added.

You can also see the live preview of slider while changing colors without actually saving it.

If you see any formatting while copying the shortcode in visual mode, please remove formatting from wordpress dashboard.

= Steps to follow for creating grid slider with content =
* Go to 'Grid Slider' and click on 'Add New Slide'
* Give title, and short description(3-4 list items recommended)
* Set feature image for post thumbnail
* Additionally you can select `Target Page URL`, where you want to redirect your user on read more link.
* You can select a page, a post or even a custom page URL for redirecting Page.
* You can also select `Target` attribute whether you want to open link in same window or another window.
* Then you can use shortcode according to your needs
* We recommend you to use one slider per page

= Simple Usage (Shortcode) =

`[content-slider]`

= Simple Usage (PHP) =

`<?php echo do_shortcode('[content-slider]'); ?>`

= Advanced Usage (Shortcode) =

`[content-slider groups=3 orderby=ID]`

= Advanced Usage (PHP) =

`<?php echo do_shortcode('[content-slider groups=3 orderby=ID]'); ?>`

= Additional Features =

* Set Page URL - URL on which you want to add Read More link
* Shortcode - Add rotating slides(in grids) like carousel slider to pages or Text Widget using the [content-slider] shortcode.
* PHP Function - Embed Content Grid Slider in your template files with do_shortcode('[content-slider]') function.
* Content Grid Slider Groups - Set up 'Groups' to display different groups of grid slides in different places. (*Example: Home Page, portfolio, Products, etc...*)

== Installation ==

This section describes how to install this plugin and get it working.

1. Upload the 'Content Grid Slider' folder to the '/wp-content/plugins/' directory
1. Activate the *Content Grid Slider* plugin through the 'Plugins' menu in WordPress
1. Generate shortcode by selecting 'Content Grid Slider' > Settings.
1. Insert the shortcode into your pages, Text widget or by adding the PHP template code to your theme's template files.

== Frequently Asked Questions ==

* See complete tutorials page at <a href="http://www.councilsoft.com/products/wordpress-plugins/content-grid-slider/">Content Grid Slider Tutorial</a>

* See Demo at
<a href="http://www.councilsoft.com/content-grid-slider-demo/" target="_blank">Content Grid Slider Plugin Demo</a>


== Screenshots ==
1. Live view of Content Grid Slider
2. Responsive View of Content Grid Slider
3. Add a new Content Grid Slider slide
4. Groups of Slides for different pages
5. View a list of all of the Content Grid Slider slides you've created
6. Configure the Content Grid Slider's settings
7. Preview of Shortcode Generated
8. Custom color Settings
9. Live preview of color applied
10. Custom Ordering of slides
11. Add shortcode to Page


== Changelog ==

= 1.5 =

Following bugs has been fixed in this version

* Fixed border issues in both sides of slider in responsive view.
* Fixed issues with display/hide icons, content etc. while viewing in responsive modes.
* Added demo link of the plugin.
* File structure has been modified in a more organized way.
* Color tab under settings is now responsive.
* Design improvements under settings tab.

Following new features has been added in this version

* Live preview of color selection has been added i.e. user can see color preview without actually saving it.
* A new tab 'custom order' has been added under settings page where you can re-arrange your slides display order with simple drag-drop.
* uninstall.php has been added so that plugin's data will get deleted after user deletes the plugin.
* Two sections has been created in color settings tab for better representation for applying colors.
* New Feature of 'filter slider items' based on categories has been applied on grid slides listing page.
* New Feature of 'filter slider items' based on author has been added also on grid slides listing page.
* Author info column has been added with each grid slide.

= 1.0 =

* The first version of this plugin! Enjoy! :)

<i>*If you like the plugin, please vote for it!*</i>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=councilsoft%40gmail%2ecom&lc=US&item_name=ContentGridSlider&item_number=CS-PLUGIN-CGS&amount=5%2e00&currency_code=USD&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest" target="_blank">Please Donate</a>

== Upgrade Notice ==

= 1.5 =

* This version fixes some responsive issues and js issues.
* New features also has been added. Please refer to changelog section for details.

= 1.0 =

* The first version of this plugin! Enjoy! :)