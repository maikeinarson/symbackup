<?php

/*
Velocity Child Theme - functions.php
*/
add_filter( 'qppr_filter_quickredirect_append_QS_data', create_function('$a', "return '';"));

add_action( 'wp_enqueue_scripts', 'velocity_child_enqueue_styles' );
function velocity_child_enqueue_styles() {
	// Bootstrap Adaption
	wp_enqueue_style( 'velocity_bootstrap_style',get_template_directory_uri().'/css/bootstrap.min.css',null);
	wp_enqueue_style( 'velocity_bootstrap-responsive_style',get_template_directory_uri().'/css/bootstrap-responsive.min.css',null);

	// Main CSS
    wp_enqueue_style( 'parent-style',get_template_directory_uri().'/style.css',null);


}

function agentwp_print_post_title() {
$external_url = get_post_meta(get_the_ID(), 'external_url', true);
if (empty($external_url)) {
$link = get_permalink();
} else {
$link = $external_url;
}
echo '<h2><a href="'.$link.'">'.get_the_title().'</a></h2>';
}

?>