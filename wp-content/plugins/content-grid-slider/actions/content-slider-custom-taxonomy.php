<?php
/****************** creating a services taxonomy for Content Grid Slider****************************/
	$labels = array(
		'name'              => _x( 'Groups', 'taxonomy general name' ),
		'singular_name'     => _x( 'Group', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Groups' ),
		'all_items'         => __( 'All Groups' ),
		//'popular_items'     => __( 'Popular Groups' ),
		'parent_item'       => __( 'Parent Group' ),
		'parent_item_colon' => __( 'Parent Group:' ),
		'edit_item'         => __( 'Edit Group' ),
		'update_item'       => __( 'Update Group' ),
		'add_new_item'      => __( 'Add New Group' ),
		'new_item_name'     => __( 'New Group' ),
		'separate_items_with_commas' => __( 'Separate groups with commas'),
		'choose_from_most_used' => __( 'Choose from most used groups'),
		'menu_name'         => __( 'Groups' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_tagcloud'		=> false,
		'show_admin_column' => true,
		'query_var'         => true,
		'public' 			=> false,
		'show_in_nav_menus' => true
	);
	register_taxonomy( 'cgs_groups', 'content-slider', $args );