<?php
/**
 * Pco Image Handler (frontend)
 *
 * @package   Pco_Image_Handler
 * @author    James Bonham <jb@peytz.dk>
 * @license   GPL-2.0+
 * @copyright 2014 Peytz & Co
 */

/**
 * Frontend plugin class. For the public-facing side of the WordPress site.
 *
 * @package Pco_Image_Handler
 * @author  James Bonham <jb@peytz.dk>
 */
class Pco_Media_Handler {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Run the hooks
	 *
	 * @since    1.0.0
	 */
	private function __construct() {

		// Filter out p tags that wrap around inline images
		if( $this->get_ih_option( 'pco_ih_keep_p_wrap' ) == false ) {
			add_filter( 'the_content', array( $this, 'remove_image_p_tags' ) );
		}

		// Remove width/height on avatars
		if( $this->get_ih_option( 'pco_ih_allow_avatar_dimensions' ) == false ) {
			add_filter( 'get_avatar', array( &$this, 'remove_image_dimensions' ) );
		}

		// Remove width/height on inline image in the_content
		if( $this->get_ih_option( 'pco_ih_allow_inline_image_dimensions' ) == false ) {
			add_filter( 'the_content', array( &$this, 'remove_inline_image_dimensions') );
		}

		// Remove width/height on featured images
		if( $this->get_ih_option( 'pco_ih_allow_thumbnail_dimensions' ) == false ) {
			add_filter( 'post_thumbnail_html', array( &$this, 'remove_image_dimensions' ), 10 );
		}

		// Change inline images with captions to html5 figure/figcaption element (if not already defined in theme_supports)
		if( !current_theme_supports('html5', 'caption') && $this->get_ih_option( 'pco_ih_captioned_images_no_html5' ) == false ) {
			add_filter( 'img_caption_shortcode', array( &$this, 'use_html5_captioned_images' ), 1, 3 );
		}

		// Resize oembeds so they fit the container width
		if( $this->get_ih_option( 'pco_ih_leave_oembeds_alone' ) == false ) {
			add_filter( 'embed_oembed_html', array( &$this, 'make_oembeds_responsive' ), 9999, 3 );

			// Add styles if selected
			if( $this->get_ih_option( 'pco_ih_hide_oembed_styles_in_head' ) == false ) {
				add_action( 'wp_head', array( $this, 'add_responsive_embed_styles' ) );
			}
		}
	}

	/**
	 * Looks for options first in an array defined in wp-config, and second in the options table
	 *
	 * @since    1.0.0
	 */
	public function get_ih_option( $name ) {
		global $pco_ih_options;
		return ( isset( $pco_ih_options[ $name ] ) ) ? $pco_ih_options[ $name ] : get_option( $name );
	}

	/**
	 * Add a little css ot the head for resonsive embeds
	 *
	 * @since    1.0.0
	 */
	public function add_responsive_embed_styles() {
		$css = '<!-- Resonsive embed styles --><style type="text/css">';
		$css .= '.embed-container { max-width: 100%; margin: 1.5em 0; } ';
		$css .= '.embed-container .embed-container-inner { position: relative !important; padding-bottom: 56.25% !important; height: 0 !important; overflow: hidden !important; } ';
		$css .= '.embed-container iframe, .embed-container object, .embed-container embed { position: absolute !important; top: 0 !important; left: 0 !important; width: 100% !important; height: 100% !important; }';
		$css .= '</style>';
		echo apply_filters( 'pco_media_handler_embed_css', $css );
	}

	/**
	 * Removes the p from around imgs
	 *
	 * @see    http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
	 * @param  string $content HTML from the WYSIWYG
 	 * @since  1.0.0
	*/
	public function remove_image_p_tags( $content ) {
	   return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}

	/**
	 * Removes image dimensions on the featured image, content images and avatars
	 *
	 * @param  string $html HTML of the image tag
 	 * @since  1.0.0
	 */
	public function remove_image_dimensions( $html ) {
		return preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	}

	/**
	 * Search post content for images to rebuild, and sends the matches tot he callback
	 *
	 * @param  string $content HTML of the post content
	 * @since  1.0.0
	 */
	public function remove_inline_image_dimensions( $content ) {
		return preg_replace_callback( '|(<img.*/>)|', array( $this, 'the_content_callback' ), $content );
	}

	/**
	 * Callback, to process inline images using remove_inline_dimensions
	 *
	 * @param  array $match The matched elements in the content. The <img> element is the first element in the array.
	 * @since  1.0.0
	 */
	public function the_content_callback( $match ) {
		return $this->remove_image_dimensions( $match[0] );
	}

	/**
	 * Customize caption shortcode to use figure and figcaption in inline images
	 *
	 * @param  string $output The html to filter
	 * @param  string $attr Attributes attributed to the shortcode: id, align, width, caption
	 * @param  string $content Shortcode content - contains the <img> element
	 * @since  1.0.0
	 */
	public function use_html5_captioned_images( $output, $attr, $content )
	{
		// Not for feed
		if ( is_feed() ) {
			return $output;
		}

		// Set up shortcode atts
		$attr = shortcode_atts( array(
			'align'	 => 'alignnone',
			'caption' => '',
			'width'	 => ''
		), $attr );

		// Add id and classes to caption
		$attributes = '';

		if( !empty( $attr['id'] ) ) {
			$attributes .= ' id="' . esc_attr( $attr['id'] ) . '"';
		}

		$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';

		// Create HTML and return it
		$output = '
			<figure' . $attributes .'><div>' .
				do_shortcode( $content ) .
				'<figcaption class="wp-caption-text">' . $attr['caption'] . '</div></figcaption>' .
			'</figure>
		';

		return $output;
	}

	/**
	 * Responsive oembeds in WordPress so they scale to the containers width
	 *
	 * @param  string $html The html to filter
	 * @param  string $url The source of the oembed as specified by the user
	 * @param  string $attr Shortcode content - contains the <img> element
	 * @since  1.0.0
	 */
	public function make_oembeds_responsive( $html, $url, $attr ) {

		// Only run this process for embeds that don't require fixed dimensions
		$resize = false;
		$accepted_providers = array(
			'youtube',
			'vimeo',
			'slideshare',
			'dailymotion',
			'viddler.com',
			'hulu.com',
			'blip.tv',
			'revision3.com',
			'funnyordie.com',
			'wordpress.tv',
			'scribd.com',
			'spotify.com'
		);

		$accepted_providers = apply_filters( 'pco_media_handler_oembed_providers', $accepted_providers );

		// Check each provider
		foreach ( $accepted_providers as $provider ) {
			if ( strstr($url, $provider) ) {
				$resize = true;
				$this_type = $provider;
				break;
			}
		}

		// Not an accepted provider
		if ( !$resize )
			return $html;

		// Stop related videos if youtube, and make branding more discreet
		$youtube_params = apply_filters( 'pco_media_handler_youtube_params', '?feature=oembed&amp;rel=0&amp;showinfo=0&amp;modestbranding=1' );
		if( $this_type == 'youtube' )
			$html = str_replace( '?feature=oembed', $youtube_params, $html );

		// Remove width and height attributes
		$attr_pattern = '/(width|height)="[0-9]*"/i';
		$embed = preg_replace($attr_pattern, "", $html);

		// Clean up whitespace
		$whitespace_pattern = '/\s+/';
		$embed = preg_replace($whitespace_pattern, ' ', $embed); // Clean-up whitespace
		$embed = trim($embed);

		// Add container around the video
		$html = '<div class="embed-container">';
		$html .= '<div class="embed-container-inner">';
		$html .= $embed;
		$html .= "</div></div>";

		return $html;
	}

}
