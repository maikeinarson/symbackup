<?php
/**
 * Pco Media Handler (frontend)
 *
 * @package   Pco_Media_Handler
 * @author    James Bonham <jb@peytz.dk>
 * @license   GPL-2.0+
 * @copyright 2014 Peytz & Co
 */

/**
 * Backend plugin class. For the admin-facing side of the WordPress site.
 *
 * @package Pco_Media_Handler
 * @author  James Bonham <jb@peytz.dk>
 */
class Pco_Media_Handler_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 * @return object A single instance of this class.
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
	 * @since 1.0.0
	 */
	private function __construct() {

		// Link inline image to none by default,. not to the media file
		if( $this->get_ih_option( 'pco_ih_link_images_to_file' ) == false ) {
			add_action( 'pre_option_image_default_link_type', array( $this, 'default_link_inline_images_to_none' ) );
		}
	}

	/**
	 * Looks for options first in an array defined in wp-config, and second in the options table
	 *
	 * @param string $name The name of the requested option
	 * @since 1.0.0
	 */
	public function get_ih_option( $name ) {
		return ( isset( $pco_ih_options[ $name ] ) ) ? $pco_ih_options[ $name ] : get_option( $name );
	}

	/**
	 * Changes the default link for images added by the media overlay to none
	 *
	 * @since 1.0.0
	 */
	function default_link_inline_images_to_none() {
		return 'none';
	}

}
