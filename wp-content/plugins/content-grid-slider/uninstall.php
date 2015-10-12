<?php
//if uninstall not called from WordPress exit
if(!defined('WP_UNINSTALL_PLUGIN'))
	exit();
global $wpdb;

//Deleting plugin option
delete_option('content-slider-main-heading-color');
delete_option('content-slider-normal-font-color');
delete_option('content-slider-active-slide-title-color');
delete_option('content-slider-selected-slide-bgcolor');
delete_option('content-slider-selected-slide-bordercolor');
delete_option('content-slider-active-slide-bgcolor');

//Deleting post meta information
delete_post_meta_by_key( 'content_slider_url' );
delete_post_meta_by_key( 'content_slider_url_target' );

//Deleting posts
$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->posts WHERE post_type = 'content-slider'"));

	
?>