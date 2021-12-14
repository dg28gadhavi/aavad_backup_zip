<?php
/*
  Plugin Name: Templatemela Shortcode
  Description: Templatemela Custom Shortcodes for templatemela wordpress themes.
  Version: 1.0
  Author: Templatemela
 */
?>
<?php  if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
?>
<?php 
 // Before VC Init
if ( ! defined( 'TM_SHORTCODE_DIR' ) ) {
define( 'TM_SHORTCODE_DIR', plugin_dir_path( __FILE__ ) );  
}
if ( ! defined( 'TM_SHORTCODE_URL' ) ) {
	define( 'TM_SHORTCODE_URL', plugin_dir_url( __FILE__ ) );
}
    //.. Code from other Tutorials ..//
function tmpmela_shortcode_init()
{
    // Require new custom Element
    require_once( TM_SHORTCODE_DIR.'/vc-elements/vc-element.php' ); 
    require_once( TM_SHORTCODE_DIR.'/shortcodes/templatemela-shortcodes.php' ); 
}
add_action('tmpmela_shortcode_init', 'tmpmela_shortcode_init');
function tmpmela_shortcode_install() { 
	do_action( 'tmpmela_shortcode_init' );
}
add_action( 'plugins_loaded', 'tmpmela_shortcode_install', 11 );
function tmpmela_shortcode_wp_admin_style() {
        wp_register_style( 'tmshortcode-style', TM_SHORTCODE_URL.'assets/css/style.css', false, '1.0.0' );
        wp_enqueue_style( 'tmshortcode-style' );
}
add_action( 'admin_enqueue_scripts', 'tmpmela_shortcode_wp_admin_style' );
if( ! function_exists( 'tmpmela_get_categories' ) ){
/**
 * GET Categories | Categories for posts or specified taxonomy
 *
 * @param string $category Category slug
 * @return array
 */
function tmpmela_get_categories( $category ) {
    $categories = get_categories( array( 'taxonomy' => $category ));
    $array = array( '' => __( 'All', 'tmpmela-opts' ) );
        foreach( $categories as $cat ){
        if( is_object($cat) ) $array[$cat->slug] = $cat->name;
        }
        return $array;
    }
}
/**
 * GET Product Categories | Product Categories for Products
 *
 * @param string $category Category slug
 * @return array
 */

if( ! function_exists( 'tmpmela_product_get_categories' ) ){
  function tmpmela_product_get_categories( $category ) {
     $taxonomy = 'product_cat';
        $orderby = 'name';
        $show_count = 0;      // 1 for yes, 0 for no
        $pad_counts = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;    // 1 for yes, 0 for no
        $title = '';
        $empty = 0;
        
        $args = array(
            'taxonomy' => $taxonomy,
            'orderby' => $orderby,
            'show_count' => $show_count,
            'pad_counts' => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li' => $title,
            'hide_empty' => $empty
        );
     $categories = get_categories($args); 
     $array = array( '' => __( 'All', 'tmpmela-opts' ) );
        foreach( $categories as $cat ){
        if( is_object($cat) ) 
          $array[$cat->name] = $cat->slug;    
        }
        return $array;
    }
  } 
?>