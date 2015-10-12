<?php
/************* creating a custom post type for Content Grid Slider ****************/
    $labels2 = array(
    'name'               => _x('Content Grid Slider','cgs'),
    'singular_name'      => _x('Grid Slide','cgs'),
    'add_new'            => _x('Add New Slide','cgs'),
    'add_new_item'       => _x('Add New Slide Content','cgs'),
    'edit_item'          => _x('Edit Grid Slide','cgs'),
    'new_item'           => _x('New Grid Slide','cgs'),
    'all_items'          => _x('All Grid Slides','cgs'),
    'view_item'          => _x('View Grid Slides','cgs'),
    'search_items'       => _x('Search Grid Slides','cgs'),
    'not_found'          => _x('No Grid Slide found','cgs'),
    'not_found_in_trash' => _x('No Grid Slide found in Trash','cgs'),
    'parent_item_colon'  => _x(':','cgs'),
    'menu_name'          => _x('Content Slider','cgs')
  );

  $args = array(
    'labels'             => $labels2,
    'public'             => true,
    'publicly_queryable' => false,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => false,
    'rewrite'            => array( 'slug' => 'content-slider' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => true,
    'menu_position'      => 6,
	'menu_icon'			 => 'dashicons-format-gallery',
    'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
	//'taxonomies' 		 => array('cgs_groups', 'post_tag')
);
    register_post_type( 'content-slider', $args );
