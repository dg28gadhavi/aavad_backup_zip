<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 * @author         TemplateMela
 * @version        Release: 1.0
 */
/**  Set Default options : Theme Settings  */
function tmpmela_set_default_options_child()
{
	/*  General Settings  */
	add_option("tmpmela_show_site_loader","yes"); // Show Loader
	add_option("tmpmela_loader_background_color","1C1C1C"); //Loader Background color
	add_option("tmpmela_logo_image",get_stylesheet_directory_uri()."/images/megnor/logo.png"); // set logo image	
	add_option("tmpmela_logo_image_alt",'firezy'); // set logo image alt
	add_option("tmpmela_mob_logo_image", get_stylesheet_directory_uri()."/images/megnor/mob-logo.png"); // set logo image	
	add_option("tmpmela_mob_logo_image_alt",'firezy'); // set logo image alt
	
	add_option("tmpmela_button_color","1c1c1c"); // Button color
	add_option("tmpmela_button_text_color","FFFFFF"); // Buttons Text Color
	add_option("tmpmela_button_hover_color","fdd400"); // Buttons Hover Color
	add_option("tmpmela_button_hover_text_color","1c1c1c"); // Buttons Hover Text Color
	
	/*  Header Settings  */		
	add_option("tmpmela_header_top_bkg_color","1c1c1c"); // header top background color		
	add_option("tmpmela_header_bottom_bkg_color","262626"); // header bottom background color		
	add_option("tmpmela_header_topservice_text1_color","FFFFFF");//Header CMS Service Text1 color
	add_option("tmpmela_header_topservice_text1_color","FFFFFF");//Header CMS Service Text2 color
	add_option("tmpmela_header_right_service_text_color","000000"); //Header Right CMS Service text color
	add_option("tmpmela_header_right_service_background_color","FFFFFF");//Header Right CMS Service Background color
	
    /*  Navigation Menu Setting  */
	add_option("tmpmela_top_menu_text_color","FFFFFF"); // Top Menu text color
	add_option("tmpmela_top_menu_texthover_color","FDD400"); // Top Menu text Hover color
	add_option("tmpmela_sub_menu_bkg_color","FFFFFF"); // Sub Menu Background Color
	add_option("tmpmela_sub_menu_text_color","000000"); // Sub Menu Text color
	add_option("tmpmela_sub_menu_texthover_color","FDD400"); // Sub Menu Text Hover color
	
	add_option("tmpmela_categoty_title1_text_color","FFFFFF"); //Category Title1 Text color
	add_option("tmpmela_categoty_title2_text_color","FDD400"); //Category Title2 Text color
	
	add_option("tmpmela_sidebar_category_bg_color","1c1c1c"); // Sidebar Category Background Color
	add_option("tmpmela_sidebar_category_link_color","FFFFFF"); // Sidebar Category Link Color
	add_option("tmpmela_sidebar_category_link_hover_color","fdd400"); // Sidebar Category link Hover Color
	add_option("tmpmela_sidebar_category_child_link_color","262626"); // Sidebar Category Child Link Color
	add_option("tmpmela_sidebar_category_child_link_hover_color","fdd400"); // Sidebar Category Child link Hover Color
	add_option("tmpmela_sidebar_category_sub_child_link_color","838383"); // Sidebar Category Sub Child Link Color
	add_option("tmpmela_sidebar_category_sub_child_link_hover_color","262626"); // Sidebar Category Sub Child link Hover Color
	
	/*  Content Settings  */
	add_option("tmpmela_hoverlink_color","1c1c1c"); // link hover color
	
	/*  Footer Settings  */	
	add_option("tmpmela_footer_bkg_color","1c1c1c"); // footer background color	
}
add_action('init', 'tmpmela_set_default_options_child');
function tmpmela_child_scripts() {
    wp_enqueue_style( 'tmpmela-child-style', get_template_directory_uri(). '/style.css' );	
}
add_action( 'wp_enqueue_scripts', 'tmpmela_child_scripts' );
/********************************************************
**************** One Click Import Data ******************
********************************************************/

if ( ! function_exists( 'sampledata_import_files' ) ) :
function sampledata_import_files() {
    return array(
		 array(
            'import_file_name'             => 'firezy_layout9',
            'local_import_file'            => trailingslashit( get_stylesheet_directory() ) . 'demo-content/demo9/firezy_layout9.wordpress.xml',
            'local_import_customizer_file' => trailingslashit( get_stylesheet_directory() ) . 'demo-content/demo9/firezy_layout9_customizer_export.dat',
			'local_import_widget_file'     => trailingslashit( get_stylesheet_directory() ) . 'demo-content/demo9/firezy_layout9_widgets_settings.wie',
            'import_notice'                => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'firezy' ),
        ),
		);
}
add_filter( 'pt-ocdi/import_files', 'sampledata_import_files' );
endif;

if ( ! function_exists( 'sampledata_after_import' ) ) :
function sampledata_after_import($selected_import) {
         //Set Menu
         $header_menu = get_term_by('name', 'MainMenu', 'nav_menu');
        $top_menu = get_term_by('name', 'Header Top Links', 'nav_menu');
		$footer_menu = get_term_by('name', 'footer-menu', 'nav_menu');
        set_theme_mod( 'nav_menu_locations' , array( 
		 'primary'   => $header_menu->term_id,
		 'header-menu'   => $top_menu->term_id ,
		 'footer-menu'   => $footer_menu->term_id 
         ) 
        );
		
		//Set Front page and blog page
       $page = get_page_by_title( 'Home');
       if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
        update_option( 'show_on_front', 'page' );
       }
	   $post = get_page_by_title( 'Blog');
       if ( isset( $page->ID ) ) {
        update_option( 'page_for_posts', $post->ID );
        update_option( 'show_on_posts', 'post' );
       }
	   
	   //Import Revolution Slider
       if ( class_exists( 'RevSlider' ) ) {
           $slider_array = array(
              get_stylesheet_directory()."/demo-content/demo9/tmpmela_homeslider_layout9.zip",
              );
 
           $slider = new RevSlider();
        
           foreach($slider_array as $filepath){
             $slider->importSliderFromPost(true,true,$filepath);  
           }
           echo esc_html__( 'Slider processed', 'firezy' );
      }
}
add_action( 'pt-ocdi/after_import', 'sampledata_after_import' );
endif;

add_action( 'init', 'remove_default_sorting_storefront' );
 
function remove_default_sorting_storefront() {
   remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 30 );
   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}

?>