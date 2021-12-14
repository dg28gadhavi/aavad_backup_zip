<?php
/*
Plugin Name: Templatemela Meta Box
Description: Templatemela meta box for editing pages for templatemela wordpress themes.
Version: 1.0
Author: Templatemela
Text Domain: templatemela-meta-box
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Script version, used to add version for scripts and styles
define( 'RWMB_VER', '4.3.8' );

// Define plugin URLs, for fast enqueuing scripts and styles
if ( ! defined( 'RWMB_URL' ) )
	define( 'RWMB_URL', plugin_dir_url( __FILE__ ) );
define( 'RWMB_JS_URL', trailingslashit( RWMB_URL . 'js' ) );
define( 'RWMB_CSS_URL', trailingslashit( RWMB_URL . 'css' ) );

// Plugin paths, for including files
if ( ! defined( 'RWMB_DIR' ) )
	define( 'RWMB_DIR', plugin_dir_path( __FILE__ ) );
define( 'RWMB_INC_DIR', trailingslashit( RWMB_DIR . 'inc' ) );
define( 'RWMB_FIELDS_DIR', trailingslashit( RWMB_INC_DIR . 'fields' ) );

// Optimize code for loading plugin files ONLY on admin side
// @see http://www.deluxeblogtips.com/?p=345

// Helper function to retrieve meta value
require_once RWMB_INC_DIR . 'helpers.php';

if ( is_admin() )
{
	require_once RWMB_INC_DIR . 'common.php';
	require_once RWMB_INC_DIR . 'field.php';

	// Field classes
	foreach ( glob( RWMB_FIELDS_DIR . '*.php' ) as $file )
	{
		require_once $file;
	}

	// Main file
	require_once RWMB_INC_DIR . 'meta-box.php';
	require_once RWMB_INC_DIR . 'init.php';
}

// define global metaboxes array
global $TM_META_BOXES;
$TM_META_BOXES = array();
// include metaboxes
$metaboxes = array(
	'metaboxes-post.php',
	'metaboxes-common.php',
	'metaboxes-page.php',
	'metaboxes-testimonial.php',
	'metaboxes-staff.php'
);
foreach ( $metaboxes as $metabox ) {
	require_once RWMB_INC_DIR . $metabox ;		
}
/**
 * Register meta boxes
 *
 * @return void
 */
add_action( 'admin_init', 'rw_register_meta_box' );
function rw_register_meta_box()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) ) {
		return;
	}	
	global $TM_META_BOXES;	
	foreach ( $TM_META_BOXES as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
/**
 * Localize meta boxes
 *
 * @return void
 */
function presscore_localize_meta_boxes() {
	global $TM_META_BOXES;
	$localized_meta_boxes = array();
	foreach ( $TM_META_BOXES as $meta_box ) {
		$localized_meta_boxes[ $meta_box['id'] ] = isset($meta_box['display_on'], $meta_box['display_on']['template']) ? (array) $meta_box['display_on']['template'] : array(); 
	}
	wp_localize_script( 'tmpmela-metabox-script', 'tmMetaboxes', $localized_meta_boxes );
}
add_action( 'admin_enqueue_scripts', 'presscore_localize_meta_boxes', 15 );
/* End Metabox */