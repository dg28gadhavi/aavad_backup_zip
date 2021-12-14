<?php
/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wbcomdesigns.com
 * @since             1.0.0
 * @package           Wc_Document_Preview
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Document Preview
 * Plugin URI:        http://wbcomdesigns.com
 * Description:       This plugin will add an extended feature to the big name “ WooCommerce ” that will allow you to add document preview feature in single product page.
 * Version:           1.2.0
 * Author:            Wbcom Designs <admin@wbcomdesigns.com>
 * Author URI:        http://wbcomdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-document-preview
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-document-preview-activator.php
 */
function activate_wc_document_preview() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-document-preview-activator.php';
	Wc_Document_Preview_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-document-preview-deactivator.php
 */
function deactivate_wc_document_preview() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-document-preview-deactivator.php';
	Wc_Document_Preview_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_document_preview' );
register_deactivation_hook( __FILE__, 'deactivate_wc_document_preview' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-document-preview.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_document_preview() {

	$plugin = new Wc_Document_Preview();
	$plugin->run();

}
run_wc_document_preview();
