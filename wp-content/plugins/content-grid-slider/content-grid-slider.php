<?php
/**
Plugin Name: Content Grid Slider
Plugin URI: http://www.councilsoft.com/products/wordpress-plugins/content-grid-slider/
Description: This Content Grid Slider plugin allows you to add quick links to your services or products by using custom posts and icons. It has an auto sliding feature.
Author: CouncilSoft Inc.
Author URI: http://www.councilsoft.com
Requires at least: 3.4
Tested up to: 3.9.1
Version: 1.5
Text Domain: content-grid-slider
Grid Content Slider
Copyright 2014, CouncilSoft - councilsoft@gmail.com 
*/
$qs = new ContentGridSlider();
 
class ContentGridSlider{
function __construct(){
		$this->path = (string) dirname(__FILE__);
        $this->dir = plugins_url('content-grid-slider');
       
		// add actions
        add_action('init', array($this, 'cgs_init'));
        add_action('init', array($this, 'cgs_image_sizes'));
        add_action('add_meta_boxes', array($this, 'cgs_ext_url'));
		add_action('save_post', array($this, 'cgs_ext_url_save'));
		add_action('admin_menu', array($this, 'cgs_admin_settings_menu'));
		//add_action( 'admin_init', array($this, 'cgs_custom_color_settings' ));
		add_action( 'admin_init', 'cgs_custom_color_settings' );
		add_shortcode('content-slider', array($this, 'cgs_shortcodes'));
		add_action('wp_enqueue_scripts',  array($this,'cgs_scripts'));
		add_action('admin_enqueue_scripts', array($this,'cgs_admin_scripts') );
		add_action('admin_head-edit-tags.php', array($this,'cgs_remove_parent_category'));
		add_action('wp_ajax_update-cgs-slide-order', array($this, 'cgs_reorder_slides'));
		
		//add_action('admin_head', array($this,'ontent_slider_custom_colors'));
		//add_action('admin_head', array($this,'ontent_slider_add_jquery_data'));
		// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
		  
		//Additional links on the plugin page
		add_filter('plugin_row_meta', array('ContentGridSlider', 'RegisterPluginLinks'),10,2);
		
		//Adding category filter on slider's listing page
		add_action('restrict_manage_posts', array($this,'cgs_restrict_manage_posts'));
		add_action( 'parse_query',  array($this,'cgs_restrict_manage_posts_request'));
		
		//Adding author filter on slider's listing page
		add_action('restrict_manage_posts', array($this,'cgs_author_filter'));
		add_filter('manage_edit-content-slider_columns', array($this,'cgs_columns_author'));
		
		//Including color Settings file
		include('actions/content-slider-color-settings.php');
		
}

//Install plugin
function cgs_install(){
	//Install Plugin
} 
//Register custom post type and taxonomy
function cgs_init(){
	include('actions/content-slider-custom-posts.php');
	include('actions/content-slider-custom-taxonomy.php');
}
 
 static function RegisterPluginLinks($links, $file) {
  $base = ContentGridSlider::GetBaseName();
  if ($file == $base) {
   $links[] = '<a href="edit.php?post_type=content-slider&page=content-slider-settings">' . __('Settings','content-grid-slider') . '</a>';
   $links[] = '<a href="http://www.councilsoft.com/products/wordpress-plugins/content-grid-slider/">' . __('FAQ','content-grid-slider') . '</a>';
   $links[] = '<a href="http://www.councilsoft.com/products/wordpress-plugins/content-grid-slider/">' . __('Support','content-grid-slider') . '</a>';
   $links[] = '<a href="http://www.councilsoft.com/donate">' . __('Donate','content-grid-slider') . '</a>';
  }
  return $links;
 }
 
 //Calling CSS and JS
 function cgs_scripts() {
  wp_register_style( 'content-slider-css', plugins_url('css/content-slider-style.css', __FILE__ ) );
  wp_enqueue_style( 'content-slider-css' );
  wp_enqueue_script('jquery');
  wp_register_script( 'content-slider-custom-jquery', plugins_url('js/content-slider.js', __FILE__ ));
  wp_enqueue_script( 'content-slider-custom-jquery');
 }
 
 //Calling CSS and JS to Admin Panel
function cgs_admin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	wp_register_style( 'content-slider-admin-css', plugins_url('admin/css/content-slider-admin-style.css', __FILE__ ) );
	wp_enqueue_style( 'content-slider-admin-css' );
	wp_register_script( 'content-slider-admin-jquery', plugins_url('admin/js/content-slider-settings.js', __FILE__ ));
	wp_enqueue_script( 'content-slider-admin-jquery');
	wp_register_style( 'content-slider-custom-admin-css', plugins_url('css/content-slider-style.css', __FILE__ ) );
	wp_enqueue_style( 'content-slider-custom-admin-css' );
	wp_register_script( 'content-slider-custom-admin-jquery', plugins_url('js/content-slider.js', __FILE__ ));
	wp_enqueue_script( 'content-slider-custom-admin-jquery');
}

//farbtrastic scripts
function my_admin_scripts() {
    wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
	wp_enqueue_script( 'content-slider-custom-colors', plugins_url('admin/js/content-slider-custom-colors.js', __FILE__ ), array( 'farbtastic', 'jquery' ));
}

//Show Drop-down list of categories on Content Grid Slider post type page in admin panel
function cgs_restrict_manage_posts() {
	global $typenow;
	$post_types = get_post_types($args);
	if( $typenow != "page" && $typenow != "post" && in_array($typenow, $post_types )){
		$filters = get_object_taxonomies($typenow);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->label;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' </option>'; }
			echo "</select>";
		}
	}
}

//Show Drop-down list of categories on Content Grid Slider post type page in admin panel continue...
function cgs_restrict_manage_posts_request($query) {
	global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
			$var = $query->query_vars[$tax_slug];
			if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
			    $var = $term->slug;
			}
        }
    }
    return $query;
}
//Show Drop-down list of categories on Content Grid Slider post type page in admin panel ends

//Show author filter in dropdown
function cgs_author_filter(){
	$args = array('name' => 'author', 'show_option_all' => 'View all authors');
	if (isset($_GET['user'])) {
    	$args['selected'] = $_GET['user'];
	}
	wp_dropdown_users($args);
}

//Show author filter in dropdown continues..
function cgs_columns_author($columns) {
	$columns['author'] = 'Author';
	return $columns;
}
//code ends

//Add setting page under settings tab
function cgs_admin_settings_menu() {
	$page = add_submenu_page( 'edit.php?post_type=content-slider', 'Content Slider Settings', 'Settings', 'edit_theme_options', 'content-slider-settings', array( $this,'cgs_tabs_settings' )); // creating color settings page
	add_action( 'admin_print_styles-' . $page, array( $this,'my_admin_scripts' ));
}

/***********Custom color settings Starts**************/
function cgs_admin_tabs( $current ) {
    $tabs = array( 'general' => 'General', 'colors' => 'Colors', 'reorder' => 'Custom Order' ); 
    $links = array(); 
    foreach( $tabs as $tab => $name ) : 
        if ( $tab == $current ) : 
            $links[] = "<a class='nav-tab nav-tab-active' href='?post_type=content-slider&page=content-slider-settings&tab=$tab'>$name</a>"; 
        else : 
            $links[] = "<a class='nav-tab' href='?post_type=content-slider&page=content-slider-settings&tab=$tab'>$name</a>"; 
        endif; 
    endforeach; 
    echo '<h2 class=cgs-settings-tabs>'; 
    foreach ( $links as $link )
        echo $link; 
    echo '</h2>';
}

// Function to generate options page
function cgs_tabs_settings() {
	
	$this->cgs_admin_tabs($_GET['tab']);
	
	if ($_GET['page'] == 'content-slider-settings' ) : 
    if ( isset ( $_GET['tab'] ) ) : 
        $tab = $_GET['tab']; 
    else: 
        $tab = 'general';
    endif; 
	switch ( $tab ) : 
        case 'general' : 
            $this->cgs_general_settings(); 
            break;
		case 'colors' : 
            cgs_color_settings(); 
            break;
		case 'reorder' :
			$this->cgs_sort_page();
			break;
	endswitch; 
	endif;
}

// Function to generate options page
function cgs_general_settings() {
	include('actions/content-slider-settings.php');
}

//Reorder-save slides starts
//Function for sorting slides
function cgs_sort_page(){
	include('actions/content-slider-reorder-settings.php');
}

// Function to save order of slides
function cgs_reorder_slides() {
	global $wpdb;
	parse_str($_POST['order'], $data);
	if (is_array($data)){
		foreach($data as $key => $values ){
			if ( $key == 'item' ){
				foreach( $values as $position => $id ){
					$wpdb->update( $wpdb->posts, array('menu_order' => $position), array('ID' => $id) );
				} 
			}
			else{
				foreach( $values as $position => $id ){
					$wpdb->update( $wpdb->posts, array('menu_order' => $position, 'post_parent' => str_replace('item_', '', $key)), array('ID' => $id) );
				}
			}
		}
	}
}
//Reorder-save slides ends here

//Add Page URL Custom Metaboxex
 function cgs_ext_url() {
  include('actions/add-page-url-custom-metabox.php');
 }
 
 //Display Page URL Meta-box on Custom Post Page
 function cgs_ext_url_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'cgs_ext_url_content_nonce' );
  include('actions/display-page-url-custom-metabox.php');
 }
 
 //Save Page URL Custom Meta-box Value
 function cgs_ext_url_save( $post_id) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if (isset($_POST['cgs_ext_url_content_nonce']) && !wp_verify_nonce( $_POST['cgs_ext_url_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;
  include('actions/save-page-url-custom-metabox.php');
 }
 
 //Create Shortcodes
 function cgs_shortcodes($atts,$content = null){
  $defaults = array(
   'groups'  => -1,
   'orderby' => 'menu_order',
   'order'   => 'ASC'
  );
  extract( shortcode_atts( $defaults, $atts ) );
  ob_start();
  include('actions/content-slider-custom-shortcodes.php');
  $output = ob_get_clean();
  return $output;
 }
 
 //Adding Image Sizes
 function cgs_image_sizes(){
  if ( function_exists( 'add_image_size' ) ) {
   add_theme_support( 'post-thumbnails' );
   add_image_size( 'content-slider-desc', 100, 100, false );
   add_image_size( 'content-slider-thumb', 53, 53, false );
  }
 }
 
 //Remove Parent category options
 function cgs_remove_parent_category(){
  include('actions/remove-parent-category-links.php');
 }
 
 /**
  * Returns the plugin basename of the plugin (using __FILE__)
  *
  * @return string The plugin basename, "content-grid-slider" for example
  */
 static function GetBaseName() {
  //return "content-grid-slider.php";
  return plugin_basename(__FILE__);
 }

 /**
  * Returns the name of this loader script, using __FILE__
  *
  * @return string The __FILE__ value of this loader script
  */
 static function GetPluginFile() {
  return __FILE__;
 }

 /**
  * Returns the plugin version
  *
  * Uses the WP API to get the meta data from the top of this file (comment)
  *
  * @return string The version like 3.1.1
  */
 static function GetVersion() {
  if(!isset($GLOBALS["sm_version"])) {
   if(!function_exists('get_plugin_data')) {
    if(file_exists(ABSPATH . 'wp-admin/includes/plugin.php')) require_once(ABSPATH . 'wp-admin/includes/plugin.php'); //2.3+
    else if(file_exists(ABSPATH . 'wp-admin/admin-functions.php')) require_once(ABSPATH . 'wp-admin/admin-functions.php'); //2.1
    else return "0.ERROR";
   }
   $data = get_plugin_data(__FILE__, false, false);
   $GLOBALS["sm_version"] = $data['Version'];
  }
  return $GLOBALS["sm_version"];
 } 

}
register_activation_hook( __FILE__, array( 'ContentGridSlider', 'cgs_install'));
?>