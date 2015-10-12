<?php
/**
 * Pco Media Handler
 *
 * Improve the markup of featured images, inline images and embeds, and make them all responsive to all screen sizes.
 *
 * @package   Pco Media Handler
 * @author    James Bonham <jb@peytz.dk>
 * @license   GPL-2.0+
 * @copyright 2014 Peytz & Co
 *
 * @wordpress-plugin
 * Plugin Name:       Pco Media Handler
 * Description:       Improve the markup of featured images, inline images and embeds, and make them all responsive to all screen sizes.
 * Version:           1.2
 * Author:            Peytz & Co (James Bonham)
 * Author URI:        http://peytz.dk/medarbejdere/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/Peytz-WordPress/pco-media-handler.git
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Public-Facing Functionality
if ( !is_admin() ) {

	// Include the plublic-facing functions
	require_once( plugin_dir_path( __FILE__ ) . 'public/class-pco-media-handler.php' );

	// Call them
	add_action( 'init', array( 'Pco_Media_Handler', 'get_instance' ) );

}

// Dashboard and Administrative Functionality
if ( is_admin() ) {

	// Include the admin-facing functions
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-pco-media-handler-admin.php' );

	// Call them
	add_action( 'plugins_loaded', array( 'Pco_Media_Handler_Admin', 'get_instance' ) );

}
