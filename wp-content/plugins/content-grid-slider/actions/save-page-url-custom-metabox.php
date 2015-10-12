<?php
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page',  $post_id) )
		return;
	} else {
		if ( !current_user_can( 'edit_post',  $post_id ) )
		return;
	}
	
	$content_slider_url = $_POST['content_slider_url_page'];
	if(empty($content_slider_url))
		$content_slider_url = $_POST['content_slider_url_post'];
	if(empty($content_slider_url))
		$content_slider_url = $_POST['content_slider_url_custom'];
	update_post_meta( $post_id, 'content_slider_url', $content_slider_url );
	
	$content_slider_url_target = $_POST['content_slider_url_target'];
	update_post_meta($post_id, 'content_slider_url_target', $content_slider_url_target);
	