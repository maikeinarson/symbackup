=== Pco Media Handler ===
Contributors: jamesbonham, Compute, PeytzCo
Tags: media, images, image, video, responsive, mobile, tablet, embed, oembed, youtube
Requires at least: 3.8
Tested up to: 3.9.2
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Improve the markup of featured images, inline images and embeds, and make them all responsive to all screen sizes.

== Description ==

This plugin makes images, embedded videos (for example YouTube and Vimeo) and other media fully responsive. It also improves the html markup of images in the content, both with and without captions.

More precisely, this plugin makes the following changes...

1. Removes p tags that wrap around inline images
1. Makes avatars responsive by removing width and height
1. Makes images in the post content responsive by removing width and height
1. Makes featured images responsive by removing width and height
1. Changes inline images that have captions to use the standard html5 figure/figcaption elements (only if not already defined in your theme features)
1. Makes oembeds responsive, so that they fit the width of the container
1. Links inline image to none by default, not to the media file

Contribute to [this project](https://github.com/Peytz-WordPress/pco-media-handler) on [github](https://github.com/Peytz-WordPress) or see [all of our favorite and custom-made plugins](http://profiles.wordpress.org/peytzco/)

== Installation ==

1. Add the plugin by either downloading the folder and uploading it to the wp-content/plugins directory or install it from the Control Panel using Plugins->Add New.
1. Activate Pco Media Handler from the Plugins menu using Plugins->Installed Plugins.

== Frequently Asked Questions ==

= Are there any options? =

Yes, but a settings screen hasn't been made yet. Until then you can override the default behaviour by adding a global array in your wp-config file. Here are the options with their default values...

`
/** Options for Pco Media Mandler */
global $pco_ih_options;
$pco_ih_options = array(
    'pco_ih_keep_p_wrap' => false,
    'pco_ih_allow_avatar_dimensions' => false,
    'pco_ih_allow_inline_image_dimensions' => false,
    'pco_ih_allow_thumbnail_dimensions' => false,
    'pco_ih_captioned_images_no_html5' => false,
    'pco_ih_leave_oembeds_alone' => false,
    'pco_ih_hide_oembed_styles_in_head' => false,
    'pco_ih_link_images_to_file' => false
);
`

This options allow you to opt out of certain features. By setting a feature exception to true, you revert that feature to the standard functionality.

= Filters? =

Yep. The default values for these filters can be found in public/class-pco-media-handler

1. `pco_media_handler_embed_css` - change the css that gets added to the head to deal with responsive embeds.
1. `pco_media_handler_oembed_providers` - change the accepted oembed providers that should get the responsive treatment.
1. `pco_media_handler_youtube_params` - change the params for all YouTube embeds.

= Does this plugin add css files or scripts? =

No, it does not add any HTTP requests. It does, however, add one line of css to the head tag of the site to make oembeds play nicely responsivly. You can turn this off by copying the rules ot your stylesheet and setting the option called `pco_ih_hide_oembed_styles_in_head` to true.

= Does this plugin work on older versions of WordPress? =

It probably works back to at least 3.5, but we have not tested it.

== Changelog ==

= 1.2 =
* Adds new filters to customise oEmbed css, oEmbed providers and YouTube parameters

= 1.1.2 =
* Sorts out Readme and trunk. Everything should work now!

= 1.1.1 =
* Sorts out Readme

= 1.1.0 =
* Checks for existing html5 caption core theme feature support and uses that if defined (since 3.9).
* Removes assets folder that was intended to be only for the plugin directory

= 1.0.0 =
* First release.

== Upgrade Notice ==

= 1.2 =
* Adds new filters to customise oEmbed css, oEmbed providers and YouTube parameters

= 1.1.2 =
* Cleans up the repo for trunk and tagged releases

= 1.1.0 =
* Checks for existing html5 caption core theme feature support and uses that if defined (since 3.9)
