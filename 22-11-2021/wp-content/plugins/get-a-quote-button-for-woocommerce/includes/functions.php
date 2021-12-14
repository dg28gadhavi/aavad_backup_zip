<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/* -------------------------------------------------------------------------- */
/* Get settings option 
/* -------------------------------------------------------------------------- */

if( !function_exists('wpb_gqb_get_option') ){
    function wpb_gqb_get_option( $option, $section, $default = '' ) {
 
        $options = get_option( $section );
     
        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }
     
        return $default;
    }
}



/**
 * CF7 Post Shortcode
 */

add_action( 'wpcf7_init', 'wpb_gqb_cf7_add_form_tag_for_post_title' );
 
function wpb_gqb_cf7_add_form_tag_for_post_title() {
    wpcf7_add_form_tag( 'post_title', 'wpb_gqb_cf7_post_title_tag_handler' ); // "clock" is the type of the form-tag
}
 
function wpb_gqb_cf7_post_title_tag_handler( $tag ) {
    if(isset($_POST['wpb_post_id'])){
        return '<input type="hidden" name="post-title" value="'. get_the_title( (int) $_POST['wpb_post_id'] ).'">';
    }
}


/**
 * Premium Links
 */

add_action( 'wpb_gqb_after_settings_page', function(){
    ?>
    <div class="wpb_gqb_pro_features wrap">
        <h3>Premium Version Features:</h3>
        <ul>
            <li>Advenced custom shortcode builder for multiple quote buttons.</li>
            <li>Different quote button for different products.</li>
            <li>Different contact forms for different quote buttons.</li>
            <li>Adding the custom quote buttons to the WooCommerce hooks directly from the shortcode generator.</li>
            <li>Products, Products categories, Products tags, Featured Products, Products type, Products stock status, User status, User role, etc filter can be added to the quote button.</li>
            <li>Different text and size for each quote buttons.</li>
            <li>Elementor support, adding custom quote button directly from the Elementor editor. </li>
        </ul>
        <div class="wpb-submit-button">
            <a class="button button-primary button-pro" href="https://wpbean.com/downloads/get-a-quote-button-pro-for-woocommerce-and-elementor/" target="_blank">Get the Pro</a>
        </div>
    </div>
    <?php
} );