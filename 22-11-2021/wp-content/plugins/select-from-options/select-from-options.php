<?php
/**
 * Plugin Name: Select From Options
 * Plugin URI: https://github.com/rajat1192
 * Description: Select From Options aavad products
 * Author: Rajat Patel
 * Author URI: https://github.com/rajat1192
 * Version: 1.0.0
 * Text Domain: aavad
 */

function custom_meta_box_markup( $object )
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    global $wpdb;
    $results = $wpdb->get_results($wpdb->prepare('SELECT `name`, `id` FROM `wp_frm_forms`' ));
    $get_form = get_post_meta($object->ID, "submit_product_form", true);

    ?>

        <p>
            <label for="my_meta_box_post_type"><?php echo  __( 'Select Forms:', 'aavad' );?> </label>
            <select name='submit_product_form' id='my_meta_box_post_type'>
                    <option name="submit_product_form" value="Select option" selected ><?php echo __( 'Select option', 'aavad' ); ?></option>
                    <?php $post_types = $results; foreach ($post_types as $post_type): ?> 
                    <option name="submit_product_form" value="<?php echo esc_attr($post_type->name); ?>"<?php if( $post_type->name == $get_form){ echo 'selected';} ?> ><?php echo esc_attr($post_type->name); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    <?php  
}
function add_custom_meta_box(){
    add_meta_box("add=ge-quote", __( 'Select Product Form', 'aavad' ), "custom_meta_box_markup", "product","side", "core", false );
}
add_action("add_meta_boxes", "add_custom_meta_box" );


function save_custom_meta_box( $post_id, $post ){

    $slug = "product";
    if( $slug != $post->post_type )
        return $post_id;

    $submit_product_form = $form_id = "";

    if( isset( $_POST["submit_product_form"] ) )
    {
        $submit_product_form = $_POST["submit_product_form"];
    }
    global $wpdb;
    $get_form_id = $wpdb->get_results($wpdb->prepare("SELECT `id` FROM `wp_frm_forms` WHERE `name` = '$submit_product_form' LIMIT 1" ));
    $insert_id = $get_form_id[0]->id;

    update_post_meta( $post_id, "submit_product_form", $submit_product_form );
    if ( $submit_product_form !== 'Select option' ){
        update_post_meta( $post_id, "form_id", '[formidable id='.$insert_id.']' );
    }else{
        update_post_meta( $post_id, "form_id", '' );
    }

}

add_action("save_post", "save_custom_meta_box", 10, 3);

add_action( 'woocommerce_after_single_product_summary', 'aavad_extra_info', 1 );
function aavad_extra_info(){
 
    if ( !empty( get_the_ID() ) ){

       $submit_product_form = get_post_meta( get_the_ID(), 'submit_product_form', true );
       $form_id             = get_post_meta( get_the_ID(), 'form_id', true );

        if( $submit_product_form !== 'Select option' ){
            echo do_shortcode( $form_id );
        }

	}
}
