<?php
/**
* Plugin Name: Amazing Content Protector
* Plugin URI: https://wordpress.org/plugins/amazing-content-protector
* Description: Amazing content project help to protect your wordpress website text & image. it will help you to disable ctl+a, ctl+u, ctl+c, ctl+x, ctl+d drag & drop etc.
* Version: 1.1
* Author: codepopular
* Author URI: http://codepopular.com
* Text Domain: amazing-wp-content-protector
* Requires at least: 4.0
* Tested up to: 5.6
* Requires PHP: 5.6
* License: GPLv2
*/

  if (!defined('ABSPATH')) die ('No direct access allowed');
class AmazingcontentProtector{

    public function __construct() {
       require_once('admin/admin.php');
    }
  // ---------- Register admin menu ----------------   
    public static function amazing_content_protector_admin_menu() {
        add_submenu_page(
        'options-general.php',
        'Amazing Content Protector',
        'Amazing Content Protector',
        'manage_options', 
        'amazing_content_protector', 
        'amazingcontent_admin_pages'
    );
    }


  // ----------  Load admin css and js ----------------   
    public static function acp_admin_css_adn_js(){  
         wp_enqueue_style('acp-admin-css', plugins_url('admin/css/admin.css',__FILE__ ));
    }

   // ----------  Load public css and js ----------------   
    public static function acp_public_css_and_js() {
        if (get_option('amazing_content_protector') != 'acp_disable') {
           wp_enqueue_style('acp_public_css', plugins_url('public/css/amazing-content-protector.css',__FILE__ ));
           wp_enqueue_script('acp_public_js', plugins_url('public/js/amazing-content-protector.js',__FILE__ ));
            }
        }
    }

   // ----------  Setting page ---------------- 
  function plugin_settings_links($links) {
        $settings_link = '<a href="options-general.php?page=amazing_content_protector">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
     }
if(class_exists('AmazingcontentProtector')) {
$new = new AmazingcontentProtector();

// Plugin Settings
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'plugin_settings_links');
// Load admin css and js
add_action('admin_enqueue_scripts', array('AmazingcontentProtector', 'acp_admin_css_adn_js'));
// Submenu page
add_action('admin_menu', array('AmazingcontentProtector', 'amazing_content_protector_admin_menu'));
// Load public css and js
add_action('wp_enqueue_scripts', array('AmazingcontentProtector', 'acp_public_css_and_js'));
}

?>