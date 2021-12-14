<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 * @author         TemplateMela
 * @version        Release: 1.0
 */
add_image_size('tmpmela_gallery_thumbnail', 145, 145, true);
if ( ! isset( $content_width ) )
	$content_width = 1150;
/**  Set Default options : Theme Settings  */
function tmpmela_set_default_options()
{
/*  General Settings  */
	add_option("tmpmela_show_site_loader","yes"); // Show Loader
	add_option("tmpmela_loader_background_color","2457AA"); //Loader Background color
	add_option("tmpmela_logo_image", get_stylesheet_directory_uri() . "/images/megnor/logo.png"); // set logo image
	add_option("tmpmela_logo_image_alt",'firezy'); // set logo image alt
    add_option("tmpmela_showsite_description", 'no'); // yes/no, control panel
	add_option("tmpmela_mob_logo_image", get_stylesheet_directory_uri() . "/images/megnor/mob-logo.png"); // set logo image
	add_option("tmpmela_mob_logo_image_alt",'firezy'); // set logo image alt		
	add_option("tmpmela_contact_email",'support@example.com'); // yes/no, control panel
	add_option("tmpmela_background_upload",""); // Default, background image
	add_option("tmpmela_back_repeat","repeat"); // background repeate
	add_option("tmpmela_back_position","top+left"); // background position
	add_option("tmpmela_back_attachment","scroll"); // background attachment
	add_option("tmpmela_bkg_color","FFFFFF"); // background color
	add_option("tmpmela_bodyfont_color","838383"); // body font color
	add_option("tmpmela_bodyfont",'Poppins'); // Poppins	
	add_option("tmpmela_bodyfont_other",'Arial'); // Arial	
	add_option("tmpmela_button_font_family",'Poppins'); // Button Font	
	add_option("tmpmela_button_color","2457AA"); // button color
	add_option("tmpmela_button_text_color","FFFFFF"); // button Text color	
	add_option("tmpmela_button_hover_color","FFD200"); // button hover color
	add_option("tmpmela_button_hover_text_color","000000"); // button hover Text color
	
	
	/*  Header Settings  */	
	add_option("tmpmela_header_background_upload",''); // Header Background image
	add_option("tmpmela_header_back_repeat","no-repeat"); // Header Background repeate
	add_option("tmpmela_header_back_position","top+center"); // Header Background position
	add_option("tmpmela_header_back_attachment","scroll"); // Header Background attachment	
	add_option("tmpmela_header_top_bkg_color","2457AA"); // Header Top Background color		
	
	add_option("tmpmela_header_bottom_bkg_color","1f4c94"); // header bottom background color		
	
	add_option("tmpmela_show_header_services","yes"); // show header services & contact
	add_option("tmpmela_header_topservice_text1","Free"); // Header top service Text1
	add_option("tmpmela_header_topservice_text1_color","FFFFFF"); // Header top service Text1 Color
	add_option("tmpmela_header_topservice_text2","Shipping"); // Header top service Text2
	add_option("tmpmela_header_topservice_text2_color","FFFFFF"); // Header top service Text2 Color
	
	add_option("tmpmela_contact_text","Contact"); // Contact Text
	add_option("tmpmela_contact_number","01 2121  313"); // Contact Number	
	add_option("tmpmela_show_header_right_services","yes"); // Show Header Right Service CMS
	
	add_option("tmpmela_header_right_service_text","New User Zone"); // Header Right Service Text 
	add_option("tmpmela_header_right_service_text_url","#"); // Header Right Service Text 
    add_option("tmpmela_header_right_service_text_color","000000"); // Header Right Service Text Color
	add_option("tmpmela_header_right_service_background_color","FFFFFF"); // Header Right Service Text Background Color	

	
    /*  Navigation Menu Setting  */
	add_option("tmpmela_navbar_category_title1","Shop By"); // Sidebar Category Title
	add_option("tmpmela_categoty_title1_text_color","FFFFFF"); // Header Category Title text color
	add_option("tmpmela_navbar_category_title2","Categories"); // Sidebar Category Title
	add_option("tmpmela_categoty_title2_text_color","FFD200"); // Header Category Title text color
	add_option("tmpmela_sidebar_category_bg_color","2457aa"); // Sidebar Category Background Color
	add_option("tmpmela_sidebar_category_link_color","FFFFFF"); // Sidebar Category Link Color
	add_option("tmpmela_sidebar_category_link_hover_color","FFD200"); // Sidebar Category link Hover Color
	add_option("tmpmela_sidebar_category_child_link_color","2457aa"); // Sidebar Category Child Link Color
	add_option("tmpmela_sidebar_category_child_link_hover_color","FFD200"); // Sidebar Category Child link Hover Color
	add_option("tmpmela_sidebar_category_sub_child_link_color","000000"); // Sidebar Category Sub Child Link Color
	add_option("tmpmela_sidebar_category_sub_child_link_hover_color","2457aa"); // Sidebar Category Sub Child link Hover Color
	
	add_option("tmpmela_top_menu_text_color","FFFFFF"); // Top Menu Text color
	add_option("tmpmela_top_menu_texthover_color","FFD200"); // Top Menu Text hover color
	add_option("tmpmela_sub_menu_bkg_color","FFFFFF"); // Sub Menu Background color
	add_option("tmpmela_sub_menu_text_color","000000"); // Sub Menu Text color
	add_option("tmpmela_sub_menu_texthover_color","1F4C94"); // Sub Menu Text hover color
	
	/*  Content Settings  */
	add_option("tmpmela_h1font",'Poppins'); // h1 family google font
	add_option("tmpmela_h1font_other",'Arial'); // h1 family specified font
	add_option("tmpmela_h1color",'000000'); // h1 family font color	 
	add_option("tmpmela_h2font",'Poppins'); // h2 family google font
	add_option("tmpmela_h2font_other",'Arial'); // h2 family specified font
	add_option("tmpmela_h2color",'000000'); // h2 family font color	
	add_option("tmpmela_h3font",'Poppins'); // h3 family google font
	add_option("tmpmela_h3font_other",'Arial'); // h3 family specified font
	add_option("tmpmela_h3color",'000000'); // h3 family font color	
	add_option("tmpmela_h4font",'Poppins'); // h4 family google font
	add_option("tmpmela_h4font_other",'Arial'); // h4 family specified font
	add_option("tmpmela_h4color",'000000'); // h4 family font color	
	add_option("tmpmela_h5font",'Poppins'); // h5 family google font
	add_option("tmpmela_h5font_other",'Arial'); // h5 family specified font 
	add_option("tmpmela_h5color",'000000'); // h5 family font color	
	add_option("tmpmela_h6font",'Poppins'); // h6 family google font
	add_option("tmpmela_h6font_other",'Arial'); // h6 family specified font 
	add_option("tmpmela_h6color",'000000'); // h6 family font color	
	add_option("tmpmela_link_color","000000"); // link color
	add_option("tmpmela_hoverlink_color","2457aa"); // link hover color
	
	/*  Sidebar setting for other pages  */
	add_option("tmpmela_page_sidebar","yes");
	
	/*  Footer Settings  */	
	add_option("tmpmela_footer_bkg_color","2457AA"); // Footer Background color	
	add_option("tmpmela_footer_background_upload","");//Footer Background image
	add_option("tmpmela_footer_back_repeat","no-repeat");//Background repeat
	add_option("tmpmela_footer_back_position","top+center");//Background position
	add_option("tmpmela_footer_back_attachment","scroll"); //Background attachment
	add_option("tmpmela_footer_title_color","FFD200"); // Footer link text color
	add_option("tmpmela_footerlink_color","EBEBEB"); // Footer link text color
	add_option("tmpmela_footerhoverlink_color","ffd200"); // Footer link hover text color
	add_option("tmpmela_footerfont",'Poppins'); // Footer Google font
	add_option("tmpmela_footerfont_other",'Arial'); // Footer Specified font
	add_option("tmpmela_footer_slog",'Templatemela'); // Copyright statement : Theme By templatemela
	
	/* Product setting */
	add_option("tmpmela_related_items","12"); 
	add_option("tmpmela_upsells_items","12"); 
	add_option("tmpmela_crosssell_items","12");
	
	/* Sidebar setting for Single product page  */
	add_option("tmpmela_secondaryimage","yes");
	add_option("tmpmela_shop_sidebar","no");
}
add_action('init', 'tmpmela_set_default_options');
add_action( 'after_setup_theme', 'tmpmela_product_gallery' );
function tmpmela_product_gallery() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}  
// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );
// Load default block styles.
	add_theme_support( 'wp-block-styles' );
// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );
function tmpmela_get_logo() {
	if (trim(get_option('tmpmela_logo_image_alt')) != '') $logo_alt = get_option('tmpmela_logo_image_alt') ; else $logo_alt = esc_attr(get_bloginfo('name', 'display' ));
	if (trim(get_option('tmpmela_logo_image')) != ''){ echo '<img alt="'.esc_attr(get_option('tmpmela_logo_image_alt')).'" src="'.get_option('tmpmela_logo_image').'" />';}
	           else{echo '<img alt="'.esc_attr(get_option('tmpmela_logo_image_alt')).'" src=" '.get_template_directory_uri(). '/images/megnor/logo.png">';}
}
function tmpmela_get_mob_logo() {
	if (trim(get_option('tmpmela_mob_logo_image_alt')) != '') $logo_alt = get_option('tmpmela_mob_logo_image_alt') ; else $logo_alt = esc_attr(get_bloginfo('name', 'display' ));
	if (trim(get_option('tmpmela_mob_logo_image')) != ''){ echo '<img alt="'.esc_attr(get_option('tmpmela_mob_logo_image_alt')).'" src="'.get_option('tmpmela_mob_logo_image').'" />';}
	           else{echo '<img alt="'.esc_attr(get_option('tmpmela_mob_logo_image_alt')).'" src=" '.get_template_directory_uri(). '/images/megnor/mob-logo.png">';}
}
function tmpmela_service_cms() {
	echo '<div class="service-block">
	<div class="service-icon"></div>
	<div class="service-block-inner">
	<div class="service-text text1">'.stripslashes(get_option('tmpmela_header_topservice_text1')).'</div>
	<div class="service-text text2">'.stripslashes(get_option('tmpmela_header_topservice_text2')).'</div>
	</div>
	</div>';
	echo '<div class="contact-block">	
	<div class="contact-icon"></div>
	<div class="contact-block-inner">	
	<div class="service-text text1">'.get_option('tmpmela_contact_text').'</div>
	<div  class="service-text text2">'.get_option('tmpmela_contact_number').'</div>
	</div>
	</div>';
}
function tmpmela_header_right_service_cms() {
	echo '<div class="icon-image"></div>	
	<div class="service-text text"><a href="' . get_option('tmpmela_header_right_service_text_url') . '" title="'.get_option('tmpmela_header_right_service_text').'">'.get_option('tmpmela_header_right_service_text').'</a></div>';
	
}
function tmpmela_get_sort_column() {
	$sort_column=''; 
	if(trim(get_option('tmpmela_navigation_type'))=='categories'){
		if( trim(get_option('tmpmela_navigation_sort_column')) =='id' || trim(get_option('tmpmela_navigation_sort_column'))=='menu_order')
			$sort_column = 'ID';
		elseif(trim(get_option('tmpmela_navigation_sort_column'))=='name' || trim(get_option('tmpmela_navigation_sort_column'))=='post_title')
			$sort_column = 'name';
		elseif(trim(get_option('tmpmela_navigation_sort_column'))=='count')
			$sort_column = 'count';
	}
	elseif(trim(get_option('tmpmela_navigation_type'))=='pages'){
		if(trim(get_option('tmpmela_navigation_sort_column'))=='id')
			$sort_column = 'ID';
		elseif(trim(get_option('tmpmela_navigation_sort_column'))=='menu_order')
			$sort_column = 'menu_order';
		elseif(trim(get_option('tmpmela_navigation_sort_column'))=='post_title' || trim(get_option('tmpmela_navigation_sort_column'))=='name')
			$sort_column = 'post_title';
	}
	return $sort_column;
}
function tmpmela_get_sort_order() {
	$sort_order='';
	if(trim(get_option('tmpmela_navigation_sort_order'))=='asc')
		return 'asc';
	if(trim(get_option('tmpmela_navigation_sort_order'))=='desc')
		return 'desc';
	return $sort_order;
}
function tmpmela_get_all_categories() {
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	$categories = wp_get_post_categories( $postid );
	$cats = ', ';
	foreach($categories as $c){
		$cat = get_category( $c );	
		$cats .= $cat->name. ',';
	}
	$cats=strtolower(rtrim($cats, " ,"));
	return $cats;
}
function tmpmela_get_all_tags() {
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	$alltags = wp_get_post_tags( $postid );
	$tags = ', ';
	foreach($alltags as $tag){
		$tags .= $tag->name. ',';
	}
	$tags=strtolower(rtrim($tags, " ,"));
	return $tags;
}
function tmpmela_extra_head(){
	$themeinfo = wp_get_theme(get_template_directory() . '/style.css');	
	echo '<meta name="generator" content="'.$themeinfo['Name'].' - '.$themeinfo['Version'].'" />';
}
add_action('wp_head','tmpmela_extra_head');
add_action( "admin_enqueue_scripts", 'tmpmela_admin_scripts');
add_action( "admin_enqueue_scripts", 'tmpmela_admin_styles');
add_action( "admin_enqueue_scripts", 'tmpmela_admin_metabox_script');
add_action( "admin_enqueue_scripts", 'tmpmela_admin_metabox_styles');
function tmpmela_admin_scripts() {
	//Scripts	
	wp_enqueue_script( 'tmpmela-pscript-admin', get_template_directory_uri() . '/js/megnor/admin/pscript_admin.js');
	wp_enqueue_script( 'jscolor', get_template_directory_uri() . '/js/megnor/admin/jscolor/jscolor.js');
	wp_enqueue_script( 'easytabs', get_template_directory_uri() . '/js/megnor/admin/jquery.easytabs.min.js');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('tmpmela-my-upload', get_template_directory_uri() . '/js/megnor/admin/custom.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('tmpmela-my-upload');	
}

function tmpmela_admin_styles() { 
	//Styles
	wp_enqueue_style('tmpmela-admin', get_template_directory_uri() . '/css/megnor/admin/tmpmela_admin.css');
	wp_enqueue_style('tmpmela-tab', get_template_directory_uri() . '/css/megnor/admin/tab.css');
	wp_enqueue_style('thickbox');
}
function tmpmela_admin_metabox_script() { 
	//Scripts
	wp_enqueue_script( 'tmpmela-metabox-script', get_template_directory_uri() . '/js/megnor/admin/tmpmela_metabox_script.js' );
}
function tmpmela_admin_metabox_styles() { 
	//Styles
	wp_enqueue_style('tmpmela-metabox-style', get_template_directory_uri() . '/css/megnor/admin/tmpmela_metabox_style.css');
}
function tmpmela_add_admin_menu_separator($position) {
  global $menu;
  $index = 0;
  foreach($menu as $offset => $section) {
    if (substr($section[2],0,9)=='separator')
      $index++;
    if ($offset>=$position) {
      $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
      break;
    }
  }
  ksort($menu);
}
if ( ! function_exists( 'tmpmela_admin_header_style' ) ) :
	function tmpmela_admin_header_style() {}
endif;
function tmpmela_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 * @deprecated Deprecated in TemplateMela for WordPress 3.1
 * @return string The gallery style filter, with the styles themselves removed.
 */
function tmpmela_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.3.2', '<' ) )
	add_filter( 'gallery_style', 'tmpmela_remove_gallery_css' );
/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function tmpmela_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;
	return esc_url_raw( $matches[1] );
}
function tmpmela_get_widget($location = '') {
	if ( is_active_sidebar($location) ) { 
		dynamic_sidebar($location); 
	}
}
if (version_compare( $GLOBALS['wp_version'], '3.3', '>=' )) 	
	get_template_part('templatemela/widgets');		
/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using TemplateMela in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default TemplateMela styling.
 *
 */
function tmpmela_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'tmpmela_remove_recent_comments_style' );
function tmpmela_get_pagination($range = 4){  
	// $paged - number of the current page  
	global $paged, $wp_query, $max_page;  
	// How much pages do we have?  
	if ( !$max_page ) {  
		$max_page = $wp_query->max_num_pages;  
	}  
	// We need the pagination only if there are more than 1 page  
	if($max_page > 1){  
		if(!$paged){  
			$paged = 1;  
		}  
		// On the first page, don't put the First page link  
		if($paged != 1){  
			echo '<a class="first" href=" '. get_pagenum_link(1) .' "> << </a>';  
		}
		// To the previous page  
		previous_posts_link(' < ');
		// We need the sliding effect only if there are more pages than is the sliding range  
		if($max_page > $range){  
		 // When closer to the beginning  
			 if($paged < $range){  
			   for($i = 1; $i <= ($range + 1); $i++){  
			   	 if($i==$paged){$class = "current number"; }else { $class = "number"; } 
				 echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";  
			   }  
			 }  
			 // When closer to the end  
			 elseif($paged >= ($max_page - ceil(($range/2)))){  
			   for($i = $max_page - $range; $i <= $max_page; $i++){  
				  if($i==$paged){$class = "current number"; }else { $class = "number"; } 
				 echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";   
			   }  
			 }  
			 // Somewhere in the middle  
			 elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){  
			   for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){  
				  if($i==$paged){$class = "current number"; }else { $class = "number"; } 
				 echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";  
			   }  
			 }  
		}  
		// Less pages than the range, no sliding effect needed  
		else{  
		 for($i = 1; $i <= $max_page; $i++){  
		  if($i==$paged){$class = "current number"; }else { $class = "number"; } 
		   echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";  
		 }  
		}  
		// Next page  
		next_posts_link(' > ');  
		// On the last page, don't put the Last page link  
		if($paged != $max_page){  
		 echo '<a class="last" href=" '. get_pagenum_link($max_page) .' "> >> </a>';  
		}  
	}  
}  	
function tmpmela_posts_next_link_attributes($html){
	$html = str_replace('<a','<a class="next-post"',$html);
	return $html;
	}
	function tmpmela_posts_previous_link_attributes($html){
	$html = str_replace('<a','<a class="prev-post"',$html);
	return $html;
	}
add_filter('next_post_link','tmpmela_posts_next_link_attributes',10,1);
add_filter('previous_post_link','tmpmela_posts_previous_link_attributes',10,1);
function tmpmela_get_first_post_images($post_ID){
	global $post, $posts;
	$first_img_src = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	if (isset($matches[1][0]))
	$first_img_src = $matches[1][0];
	if(empty($first_img_src)){ 
		return 0;
	}
	return $first_img_src;
}
function tmpmela_excerpt($limit) 
{
	
      $excerpt = explode(' ', tmpmela_strip_images(strip_tags(get_the_content())), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'.<div class="read-more"><a class="read-more-link" href="'.esc_url(get_permalink()).'">'.esc_html__( 'Read More' , 'firezy' ) .'</a></div>';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
}
function tmpmela_blog_post_excerpt( $limit ) {
$excerpt = get_the_content();
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, $limit);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
return $excerpt;
}
function tmpmela_excerpt_length_limit($limit)
{
    $contents = substr(tmpmela_strip_images(strip_tags(get_the_content())), 0, $limit);
    $excerpt = $contents;
    if (strlen($contents) >= $limit) {
        $excerpt .= '&hellip;';
    }
    return $excerpt;
}
function tmpmela_portfolio_excerpt($limit) 
{
    $contents = substr(tmpmela_strip_images(strip_tags(get_the_content())),0,$limit);	
	$excerpt = $contents; if (strlen($contents) >= $limit){ $excerpt .= '&hellip;'; }
  	return $excerpt;
}
if ( ! function_exists( 'tmpmela_go_top' ) ) :
function tmpmela_go_top(){ ?>
<div class="backtotop"><a id="to_top" href="#"></a></div>
<?php } 
endif;
add_action('wp_head','tmpmela_custom_css',15);
if ( ! function_exists( 'tmpmela_strip_images' ) ) :
function tmpmela_strip_images($content){	
   $content = preg_replace('/<img[^>]+./','',$content);
   return preg_replace('/<\/?a[^>]*>/','',$content);
}
endif;
/**
 * Remove inline styles printed when the gallery shortcode is used.
 * Galleries are styled by the theme in TemplateMela's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 */
add_filter( 'use_default_gallery_style', '__return_false' );
/**
 * Enqueue Templatemela Fonts
 */
function tmpmela_load_fonts() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Poppins, translate this to 'off'. Do not translate
    * into your own language.
    */
   
	$Poppins = _x( 'on', 'Poppins font: on or off', 'firezy' );
	
		
	  if (  'off' !== $Poppins ) {
			$font_families = array(); 
			 if ( 'off' !== $Poppins ) {
				$font_families[] = 'Poppins:300,400,500,600,600,800';		
			}  
		
		    $query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
	 
			$fonts_url = esc_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ));
		} 
    return esc_url_raw( $fonts_url );
}
/*
Enqueue scripts and styles.
*/
function tmpmela_google_fonts() {
    wp_enqueue_style( 'google-fonts', tmpmela_load_fonts(), array(), '1.0.0' );
}
add_action( 'get_header', 'tmpmela_google_fonts' );
//Load responsive.css file in the header
function tmpmela_responsive()
{
wp_enqueue_style('tmpmela-responsive', get_stylesheet_directory_uri() . '/responsive.css');
}
add_action('wp_footer','tmpmela_responsive');
/**
 * Enqueue Templatemela Styles
 */
if ( ! function_exists( 'tmpmela_load_styles' ) ) :
function tmpmela_load_styles() {
	wp_enqueue_style('tmpmela-block-style', get_template_directory_uri() . '/css/megnor/blocks.css');
	wp_enqueue_style('tmpmela-isotope', get_template_directory_uri() . '/css/isotop-port.css');
	wp_enqueue_style('tmpmela-custom', get_template_directory_uri() . '/css/megnor/custom.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/megnor/owl.carousel.css');
	wp_enqueue_style('owl-transitions', get_template_directory_uri() . '/css/megnor/owl.transitions.css');		
	wp_enqueue_style('shadowbox', get_template_directory_uri() . '/css/megnor/shadowbox.css');
	wp_enqueue_style('tmpmela-shortcode-style', get_template_directory_uri() . '/css/megnor/shortcode_style.css');
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/megnor/animate.min.css');	
	
	//Adds wocommerce style
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
		wp_enqueue_style('tmpmela-woocommerce-css', get_template_directory_uri() . '/css/megnor/woocommerce.css');
	endif;
}
endif;
add_action('get_header', 'tmpmela_load_styles');
function tmpmela_block_editor_styles() {
    wp_enqueue_style('tmpmela-block-editor-style', get_template_directory_uri() . '/css/megnor/editor-blocks.css',false);
}
add_action( 'enqueue_block_editor_assets', 'tmpmela_block_editor_styles' );
/**
 * Enqueue Templatemela Scripts
 */
if ( ! function_exists( 'tmpmela_load_scripts' ) ) :
function tmpmela_load_scripts() {	
		
	wp_enqueue_script( 'tmpmela-custom-script', get_template_directory_uri() . '/js/megnor/jquery.custom.min.js', array(), '', false);
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '', false);
	wp_enqueue_script( 'tmpmela-megnor', get_template_directory_uri() . '/js/megnor/megnor.min.js', array(), '', false);		
	wp_enqueue_script( 'tmpmela-custom', get_template_directory_uri() . '/js/megnor/custom.js', array(), '', false);
	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/js/megnor/owl.carousel.min.js', array(), '', false);
	wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/megnor/jquery.validate.js', array(), '', false);
	wp_enqueue_script( 'shadowbox', get_template_directory_uri() . '/js/megnor/shadowbox.js', array(), '', false);		
	wp_enqueue_script( 'megamenu', get_template_directory_uri() . '/js/megnor/jquery.megamenu.js', array(), '', false);	
	wp_enqueue_script( 'easyResponsiveTabs', get_template_directory_uri() . '/js/megnor/easyResponsiveTabs.js', array(), '', false);
	wp_enqueue_script( 'jtree', get_template_directory_uri() . '/js/megnor/jquery.treeview.js', array(), '', false);
	wp_enqueue_script( 'countUp', get_template_directory_uri() . '/js/megnor/countUp.js', array(), '', false);	
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/megnor/jquery.countdown.min.js', array(), '', false);
       
        
    ?>
<!--[if lt IE 9]>
	<?php wp_enqueue_script( 'tmpmela-html5', get_template_directory_uri() . '/js/html5.js', array(), '', false); ?>
	<![endif]-->
<?php }
endif;
add_action( 'wp_enqueue_scripts', 'tmpmela_load_scripts' );
if ( ! function_exists( 'tmpmela_breadcrumbs' ) ) :
function tmpmela_breadcrumbs() { ?>
<div class="breadcrumbs">
  <?php if ( function_exists('yoast_breadcrumb') ) { ?>
  <?php yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
  <?php } ?>
</div>
<?php }
endif;
function tmpmela_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <div><label class="screen-reader-text" for="s">' . esc_attr_x( 'Search for:','label','firezy' ) . '</label>
    <input class="search-field" type="text" placeholder="'. esc_attr__( 'Search', 'firezy' ) .'" value="' . get_search_query() . '" name="s" id="s" />
    <input class="search-submit" type="submit" id="searchsubmit" value="'. esc_attr_x( 'Go','label','firezy' ) .'" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'tmpmela_search_form' );
if ( ! function_exists( 'tmpmela_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tmpmela_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function tmpmela_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php esc_html_e( 'Pingback:', 'firezy' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( esc_html__( '(Edit)', 'firezy' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
</li>
<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>" class="comment-body">
    <div class="alignleft"> <?php echo get_avatar( $comment, 48 ); ?> </div>
    <div class="author-content">
      <h6><?php echo esc_html($comment->comment_author); ?></h6>
      <?php edit_comment_link( esc_html__( 'Edit', 'firezy' ), ' ' ); ?>
      <div class="clearfix"></div>
      <abbr class="published" title="<?php echo get_the_title() ?>"><?php printf( esc_html__( '%1$s at %2$s', 'firezy' ), get_comment_date(),  get_comment_time() ); ?></abbr> </div>
    <div class="comment-content">
      <?php comment_text(); ?>
      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation">
    <?php esc_html_e( 'Your comment is awaiting moderation.', 'firezy' ); ?>
    </em> <br />
    <?php endif; ?>
  </div>
  <!-- #comment-##  -->
</li>
<?php
		break;
	endswitch; // end comment_type check
}
endif;
if ( ! function_exists( 'tmpmela_sticky_post' ) ) :
function tmpmela_sticky_post() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<div class="meta-inner"><span class="sticky-post">' . esc_html__( 'Sticky', 'firezy' ) . '</span></div>';
}
endif;
if ( ! function_exists( 'tmpmela_categories_links' ) ) :
function tmpmela_categories_links() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( esc_html__( ', ', 'firezy' ) );
	if ( $categories_list ) {
		echo '<div class="meta-inner"><span class="categories-links"><i class="fa fa-folder-o"></i>' . $categories_list . '</span></div>';
	}
}
endif;
if ( ! function_exists( 'tmpmela_tags_links' ) ) :
function tmpmela_tags_links() {
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', esc_html__( ', ', 'firezy' ) );
	if ( $tag_list ) {
		echo '<div class="meta-inner"><span class="tags-links"><i class="fa fa-tags"></i>' . $tag_list . '</span></div>';		
	}
}
endif;
if ( ! function_exists( 'tmpmela_author_link' ) ) :
function tmpmela_author_link() {
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<div class="meta-inner"><span class="author vcard"><i class="fa fa-pencil-square-o"></i><a class="url fn n" href="%1$s" title="%2$s" rel="author">'.esc_html__("by ",'firezy').'%3$s</a></span></div>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'firezy' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;
if ( ! function_exists( 'tmpmela_comments_link' ) ) :
function tmpmela_comments_link() {
	//comments open
	if ( comments_open() && ! is_single() ) :
	echo '<div class="meta-inner"><span class="comments-link"><i class="fa fa-comment"></i>';
	comments_popup_link( esc_html__( 'Leave a Comment', 'firezy' ), esc_html__( '1 Comment', 'firezy' ), esc_html__( '% Comments', 'firezy' ) );
	echo '</span></div>';
	endif; 
}
endif;
if ( ! function_exists( 'tmpmela_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own tmpmela_entry_date() to override in a child theme.
 *
 * @since Templatemela 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function tmpmela_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'firezy' );
	else
		$format_prefix = '%2$s';
	$date = sprintf( '<div class="meta-inner"><span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o" aria-hidden="true"></i>
<time class="entry-date" datetime="%3$s">%4$s</time></a></span></div>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( esc_html__( 'Permalink to %s', 'firezy' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);
	if ( $echo )
		echo wp_kses_post($date);
	return $date;
}
endif;
if ( ! function_exists( 'tmpmela_post_entry_date' ) ) :
function tmpmela_post_entry_date( ) {
	$date = get_the_date();	
	$month = get_the_date('M');
	$day = get_the_date('d'); 
	$year = get_the_date('Y'); 
	$date = '<div class="meta-inner"><span class="entry-date"><i class="fa fa-calendar-o"></i>' . $date . '</span></div>';
	echo wp_kses_post($date);
	return $date;
}
endif;
if ( ! function_exists( 'tmpmela_posts_short_description' ) ) :
function tmpmela_posts_short_description() {
	$tmpmela_posts_short_description = get_post_meta(get_the_ID(), 'tmpmela_posts_short_description', true);
	if(empty($tmpmela_posts_short_description))
		$tmpmela_posts_short_description = tmpmela_excerpt(35);
	return $tmpmela_posts_short_description;
}
endif;
if ( ! function_exists( 'tmpmela_posts_show_thumbnail' ) ) :
function tmpmela_posts_show_thumbnail() {
	$tmpmela_posts_show_thumbnail = get_post_meta(get_the_ID(), 'tmpmela_posts_show_thumbnail', true);
	if(empty($tmpmela_posts_show_thumbnail))
		$tmpmela_posts_show_thumbnail = '';
	return $tmpmela_posts_show_thumbnail;
}
endif;
if ( ! function_exists( 'tmpmela_page_layout' ) ) :
function tmpmela_page_layout() {
	$page_layout_class = '';
	global $wp_query;	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	if(is_shop()):
		$page_id = wc_get_page_id('shop');
	else:
		$page_id = $wp_query->get_queried_object_id();
	endif;
	}else{
		$page_id = $wp_query->get_queried_object_id();
	}
	$tmpmela_page_layout = get_post_meta($page_id, 'tmpmela_page_layout', true);
	if(empty($tmpmela_page_layout))
		$tmpmela_page_layout = '';
		
	if($tmpmela_page_layout == "box"):
		$page_layout_class = "box-page";
	elseif($tmpmela_page_layout == "wide"):
		$page_layout_class = "wide-page";
	endif;
	return $page_layout_class;
}
endif;
if ( ! function_exists( 'tmpmela_sidebar_position' ) ) :
function tmpmela_sidebar_position() {
  $sidebar_class = '';
  global $wp_query;  
  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  if(is_shop() || is_archive() || is_single() || is_search()):
    $page_id = wc_get_page_id('shop');
  else:
    $page_id = $wp_query->get_queried_object_id();
  endif;
    }
  else{
    $page_id = $wp_query->get_queried_object_id();
  }
  $tmpmela_sidebar_position = get_post_meta($page_id, 'tmpmela_sidebar_position', true);
  
  if(empty($tmpmela_sidebar_position))
    $tmpmela_sidebar_position = '';
    
  if($tmpmela_sidebar_position == "left"):
    $sidebar_class = "left-sidebar";
  elseif($tmpmela_sidebar_position == "right"):
    $sidebar_class = "right-sidebar";
  elseif($tmpmela_sidebar_position == "disabled"):
    $sidebar_class = "full-width";
  endif;
  return $sidebar_class;
}
endif;
if ( ! function_exists( 'tmpmela_blog_box_display' ) ) :
function tmpmela_blog_box_display() {
	$main_container = '';
	$tmpmela_blog_box_display = get_post_meta(get_the_ID(), 'tmpmela_blog_box_display', true);
	if(empty($tmpmela_blog_box_display))
		$tmpmela_blog_box_display = '';
	if($tmpmela_blog_box_display == 'masonry'):
		$main_container = 'masonry';
	elseif($tmpmela_blog_box_display == 'grid'):
		$main_container = 'grid';
	endif;
	return $main_container;
}
endif;
if ( ! function_exists( 'tmpmela_blog_box_columns_class' ) ) :
function tmpmela_blog_box_columns_class() {
	$columns_class = '';
	$tmpmela_blog_box_columns = get_post_meta(get_the_ID(), 'tmpmela_blog_box_columns', true);
	if(empty($tmpmela_blog_box_columns))
		$tmpmela_blog_box_columns = '';
	if($tmpmela_blog_box_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tmpmela_blog_box_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tmpmela_blog_box_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	return $columns_class;
}
endif;
if ( ! function_exists( 'tmpmela_blog_box_columns_number' ) ) :
function tmpmela_blog_box_columns_number() {
	$columns_number = '';
	$tmpmela_blog_box_columns = get_post_meta(get_the_ID(), 'tmpmela_blog_box_columns', true);
	if(empty($tmpmela_blog_box_columns))
		$tmpmela_blog_box_columns = '';
	if($tmpmela_blog_box_columns == 'two'):
		$columns_number = '2';
	elseif($tmpmela_blog_box_columns == 'three'):
		$columns_number = '3';
	elseif($tmpmela_blog_box_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;
if ( ! function_exists( 'tmpmela_blog_box_posts_per_page' ) ) :
function tmpmela_blog_box_posts_per_page() {
	$tmpmela_blog_box_posts_per_page = get_post_meta(get_the_ID(), 'tmpmela_blog_box_posts_per_page', true);
	if(empty($tmpmela_blog_box_posts_per_page))
		$tmpmela_blog_box_posts_per_page = '';
	return $tmpmela_blog_box_posts_per_page;
}
endif;
if ( ! function_exists( 'tmpmela_blog_list_posts_per_page' ) ) :
function tmpmela_blog_list_posts_per_page() {
	$tmpmela_blog_list_posts_per_page = get_post_meta(get_the_ID(), 'tmpmela_blog_list_posts_per_page', true);
	if(empty($tmpmela_blog_list_posts_per_page))
		$tmpmela_blog_list_posts_per_page = '';
	return $tmpmela_blog_list_posts_per_page;
}
endif;
if ( ! function_exists( 'tmpmela_blog_filter_columns_class' ) ) :
function tmpmela_blog_filter_columns_class() {
	$columns_class = '';
	$tmpmela_blog_filter_columns = get_post_meta(get_the_ID(), 'tmpmela_blog_filter_columns', true);
	if(empty($tmpmela_blog_filter_columns))
		$tmpmela_blog_filter_columns = '';
	if($tmpmela_blog_filter_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tmpmela_blog_filter_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tmpmela_blog_filter_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	return $columns_class;
}
endif;
if ( ! function_exists( 'tmpmela_blog_filter_columns_number' ) ) :
function tmpmela_blog_filter_columns_number() {
	$columns_number = '';
	$tmpmela_blog_filter_columns = get_post_meta(get_the_ID(), 'tmpmela_blog_filter_columns', true);
	if(empty($tmpmela_blog_filter_columns))
		$tmpmela_blog_filter_columns = '';
	if($tmpmela_blog_filter_columns == 'two'):
		$columns_number = '2';
	elseif($tmpmela_blog_filter_columns == 'three'):
		$columns_number = '3';
	elseif($tmpmela_blog_filter_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;
if ( ! function_exists( 'tmpmela_testimonial_box_posts_per_page' ) ) :
function tmpmela_testimonial_box_posts_per_page() {
	$tmpmela_testimonial_box_posts_per_page = get_post_meta(get_the_ID(), 'tmpmela_testimonial_box_posts_per_page', true);
	if(empty($tmpmela_testimonial_box_posts_per_page))
		$tmpmela_testimonial_box_posts_per_page = '';
	return $tmpmela_testimonial_box_posts_per_page;
}
endif;
if ( ! function_exists( 'tmpmela_testimonial_list_posts_per_page' ) ) :
function tmpmela_testimonial_list_posts_per_page() {
	$tmpmela_testimonial_list_posts_per_page = get_post_meta(get_the_ID(), 'tmpmela_testimonial_list_posts_per_page', true);
	if(empty($tmpmela_testimonial_list_posts_per_page))
		$tmpmela_testimonial_list_posts_per_page = '';
	return $tmpmela_testimonial_list_posts_per_page;
}
endif;
if ( ! function_exists( 'tmpmela_testimonial_box_columns_class' ) ) :
function tmpmela_testimonial_box_columns_class() {
	$columns_class = '';
	$tmpmela_testimonial_box_columns = get_post_meta(get_the_ID(), 'tmpmela_testimonial_box_columns', true);
	if(empty($tmpmela_testimonial_box_columns))
		$tmpmela_testimonial_box_columns = '';
	if($tmpmela_testimonial_box_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tmpmela_testimonial_box_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tmpmela_testimonial_box_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	return $columns_class;
}
endif;
if ( ! function_exists( 'tmpmela_testimonial_box_columns_number' ) ) :
function tmpmela_testimonial_box_columns_number() {
	$columns_number = '';
	$tmpmela_testimonial_box_columns = get_post_meta(get_the_ID(), 'tmpmela_testimonial_box_columns', true);
	if(empty($tmpmela_testimonial_box_columns))
		$tmpmela_testimonial_box_columns = '';
	if($tmpmela_testimonial_box_columns == 'two'):
		$columns_number = '2';
	elseif($tmpmela_testimonial_box_columns == 'three'):
		$columns_number = '3';
	elseif($tmpmela_testimonial_box_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;
if ( ! function_exists( 'tmpmela_staff_box_posts_per_page' ) ) :
function tmpmela_staff_box_posts_per_page() {
	$tmpmela_staff_box_posts_per_page = get_post_meta(get_the_ID(), 'tmpmela_staff_box_posts_per_page', true);
	if(empty($tmpmela_staff_box_posts_per_page))
		$tmpmela_staff_box_posts_per_page = '';
	return $tmpmela_staff_box_posts_per_page;
}
endif;
if ( ! function_exists( 'tmpmela_staff_list_posts_per_page' ) ) :
function tmpmela_staff_list_posts_per_page() {
	$tmpmela_staff_list_posts_per_page = get_post_meta(get_the_ID(), 'tmpmela_staff_list_posts_per_page', true);
	if(empty($tmpmela_staff_list_posts_per_page))
		$tmpmela_staff_list_posts_per_page = '';
	return $tmpmela_staff_list_posts_per_page;
}
endif;
if ( ! function_exists( 'tmpmela_staff_box_columns_class' ) ) :
function tmpmela_staff_box_columns_class() {
	$columns_class = '';
	$tmpmela_staff_box_columns = get_post_meta(get_the_ID(), 'tmpmela_staff_box_columns', true);
	if(empty($tmpmela_staff_box_columns))
		$tmpmela_staff_box_columns = '';
	if($tmpmela_staff_box_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tmpmela_staff_box_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tmpmela_staff_box_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	$columns_class;
	return $columns_class;
}
endif;
if ( ! function_exists( 'tmpmela_staff_box_columns_number' ) ) :
function tmpmela_staff_box_columns_number() {
	$columns_number = '';
	$tmpmela_staff_box_columns = get_post_meta(get_the_ID(), 'tmpmela_staff_box_columns', true);
	if(empty($tmpmela_staff_box_columns))
		$tmpmela_staff_box_columns = '';
	if($tmpmela_staff_box_columns == 'two'):
		$columns_number = '2';
	elseif($tmpmela_staff_box_columns == 'three'):
		$columns_number = '3';
	elseif($tmpmela_staff_box_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;
if ( ! function_exists( 'tmpmela_content_position' ) ) :
function tmpmela_content_position() {
	$tmpmela_content_position = get_post_meta(get_the_ID(), 'tmpmela_content_position', true);
	if(empty($tmpmela_content_position))
		$tmpmela_content_position = '';
	return $tmpmela_content_position;
}
endif;
if ( ! function_exists( 'tmpmela_is_related_posts' ) ) :
function tmpmela_is_related_posts() {
	$tmpmela_is_related_posts = get_post_meta(get_the_ID(), 'tmpmela_posts_show_related_posts', true);
	if(empty($tmpmela_is_related_posts))
		$tmpmela_is_related_posts = '';
	return $tmpmela_is_related_posts;
}
endif;
if ( ! function_exists( 'tmpmela_is_author_info' ) ) :
function tmpmela_is_author_info() {
	$tmpmela_is_author_info = get_post_meta(get_the_ID(), 'tmpmela_posts_show_author_info', true);
	if(empty($tmpmela_is_author_info))
		$tmpmela_is_author_info = '';
	return $tmpmela_is_author_info;
}
endif;
if ( ! function_exists( 'tmpmela_shortcode_paging_nav' ) ) :
function tmpmela_shortcode_paging_nav() {
	$output ='';
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );
	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}
	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' =>  wp_kses( __( '<i class="fa fa-angle-left"></i>', 'firezy' ),tmpmela_allowed_html()),
		'next_text' =>  wp_kses( __( '<i class="fa fa-angle-right"></i>', 'firezy' ),tmpmela_allowed_html()),
	) );
	if ( $links ) :
	$output .= '<nav class="navigation paging-navigation" role="navigation">';
		$output .= '<div class="pagination loop-pagination">';
		$output .= $links;
		$output .= '</div>';
	$output .= '</nav>';
	endif; 
	}
	return $output;
}
endif;
// Adds custom image height X width for small thumbnails
add_image_size( 'tmpmela-blog-posts-list', 1100, 1100, true );
add_image_size( 'tmpmela-small-thumb', 50, 50, true );
//Create HTML list of nav menu items and allow HTML tags.
class Description_Walker extends Walker_Nav_Menu { 
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes = empty ( $item->classes ) ? array () : (array) $item->classes;	 
		$class_names = join(' ', apply_filters(	'nav_menu_css_class', array_filter( $classes ), $item ) );	 
		! empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
		// Build default menu items
		$output .= "<li id='menu-item-$item->ID' $class_names>";
		$attributes = '';	 
		! empty( $item->attr_title )
		and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
		! empty( $item->target )
		and $attributes .= ' target="' . esc_attr( $item->target ) .'"';
		! empty( $item->xfn )
		and $attributes .= ' rel="' . esc_attr( $item->xfn ) .'"';
		! empty( $item->url )
		and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
		// Build the description (you may need to change the depth to 0, 1, or 2)
		$description = ( ! empty ( $item->description ) and 1 == $depth ) ? '<span class="nav_desc">'. $item->description . '</span>' : '';		 
		$title = apply_filters( 'the_title', $item->title, $item->ID );		 
		$item_output = $args->before . "<a $attributes>" . $args->link_before . $title . '</a> ' . $args->link_after . $description . $args->after;
		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id  );
	}
} 
if ( ! function_exists( 'tmpmela_shop_body_classes' ) ) :
function tmpmela_shop_body_classes( $classes ) {
		global $wp,$query_args;
		$current= esc_url(home_url( add_query_arg( $query_args , $wp->request ) ));
		$str = substr(strrchr($current, '?'), 1);
		$variable = substr($str, 0, strpos($str, "&"));
			if($variable == 'left'){
				$classes[] = 'shop-left-sidebar'; 
			}elseif($variable == 'right'){
				$classes[] = 'shop-right-sidebar'; 
			}elseif($variable == 'full'){
				$classes[] = 'shop-full-width';	
			}
            elseif ( !is_active_sidebar( 'sidebar-1' ) )  
            { $classes[] = "shop-full-width";}
else{
	$classes[] = 'shop-left-sidebar' ;
}
return $classes;
}
endif;
add_filter( 'body_class', 'tmpmela_shop_body_classes' );
function tmpmela_is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) ||  (is_home()) ||  (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}
/* Related Product settings */
function tmpmela_related_products_args( $args ) {
  	$no = get_option("tmpmela_related_items");	
	$args['posts_per_page'] = $no; 
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'tmpmela_related_products_args' );
/* Upsell Product settings */
function tmpmela_output_upsells() {
		$no1 = get_option("tmpmela_upsells_items");	
	    woocommerce_upsell_display( $no1); 
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'tmpmela_output_upsells', 15 );
/* crosssell Product settings */
function tmpmela_output_crosssell() {
		$no1 = get_option("tmpmela_crosssell_items");	
	   woocommerce_cross_sell_display( $no1);
}
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_after_cart', 'tmpmela_output_crosssell', 10 );
/* To display Wishlist in product block */
if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
if( ! function_exists( 'tmpmela_add_to_wishlist_in_product' ) ){
    function tmpmela_add_to_wishlist_in_product(){
        echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'tmpmela_add_to_wishlist_in_product', 11 );
endif;
/* compare product block */
if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
if( ! function_exists( 'tmpmela_add_to_compare_in_product' ) ){
    function tmpmela_add_to_compare_in_product(){
        echo do_shortcode( "[yith_compare_button]" );
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'tmpmela_add_to_compare_in_product', 11 );
endif;


/* compare button in menu */
if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
if( ! function_exists( 'tmpmela_add_to_compare_in_menu' ) ){
    function tmpmela_add_to_compare_in_menu(){
		echo '<div class="compare-counter">';
		?>
        <a href="/?action=yith-woocompare-view-table&amp;iframe=yes" class="yith-woocompare-open" data-text="Compare">Compare</a>
		<?php
        echo'</div>';
    }
}
endif;
function tmpmela_product_navigation()
{		
		global $post , $previous ,$next;
		$current_url = get_permalink( $post->ID );
		$next_text = '';
		$previous_text = '';		
		
		// Get the previous and next product links
		$previous_link = get_permalink(get_adjacent_post(false,'',false)); 
		$next_link = get_permalink(get_adjacent_post(false,'',true));
		
		// Create the two links provided the product exists
		if ( $next_link != $current_url ) {
				$next = "<a href='" . esc_url($next_link) . "'>" . $next_text . "</a>";
			}
			if ( $previous_link != $current_url ) {
				$previous = "<a href='" .esc_url($previous_link) . "'>" . $previous_text . "</a>";
		}
		
		// Create the two links provided the product exists
			if ( $next_link != $current_url ) {
				$next_text = get_adjacent_post(false,'',true)->post_title;
				$next = "<a href='" .esc_url( $next_link ). "'>" . $next_text . "</a>";
			} 
			if ( $previous_link != $current_url ) {
				$previous_text = get_adjacent_post(false,'',false)->post_title;
				$previous = "<a href='" . esc_url($previous_link) . "'>" . $previous_text . "</a>";
			}
			
		// Create HTML Output
		$output  = '<div class="tmpmela_product_nav_buttons">'; 
		if ( $previous != '' )
			$output .= '<span class="previous"> ' . $previous . '</span>';
		if ( $next != '' )
			$output .= '<span class="next">' . $next .'</span>';
		$output .= '</div>';
		
		// Display the final output
		echo wp_kses_post($output);
}
add_action( 'woocommerce_single_product_summary', 'tmpmela_product_navigation', 5 );
/*	This function is used to convert hex color into rgb or rgba */
function tmpmela_hex_to_rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 		//Return default if no color provided
		if(empty($color))
          return $default; 
 		//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        } 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        } 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        } 
        //Return rgb(a) color string
        return $output;
}
// Display the additional product images
function tmpmela_second_product_thumbnail() {
	global $product, $woocommerce,$id;
	$attachment_ids = $product->get_gallery_image_ids();
	$id =	get_post_thumbnail_id( $product->get_id() );
	if(get_option( 'tmpmela_secondaryimage' ) == "yes"){
		if ( count($attachment_ids) > 0 ) {
			$secondary_image_id = $attachment_ids['0'];		
			echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
		}
		else{				
			echo wp_get_attachment_image( $id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );		
		}
	}
	else{				
		echo wp_get_attachment_image( $id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );		
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'tmpmela_second_product_thumbnail');
/* for escaping i.e wp_kses( __()); the html element update to WP 4.3.1 */
function tmpmela_allowed_html() {
	 $tmpmela_allowed_html = array(
	'span' => array(
	 'class' => array(),
	 'style' => array(),
	),
	'div' => array(
	 'class' => array(),
	 'style' => array(),
	),
	'a' => array(
	 'href' => array(),
	),
	'i' => array(
	 'class' => array(),
	),
	);
return  $tmpmela_allowed_html;
}
/* Transfer the php data to custom js */
function tmpmela_load_more(){
	// Register the script
	wp_enqueue_script( 'phpvariable', get_template_directory_uri() . '/js/megnor/megnorloadmore.js', array(), '', false);	
	// Localize the script with new data
	$translation_array = array(
		'tmpmela_loadmore' => get_option( 'tmpmela_loadmore' ),
		'tmpmela_pagination' => get_option( 'tmpmela_pagination' ),
		'tmpmela_nomore' =>  get_option( 'tmpmela_nomore' )
	);
	wp_localize_script( 'phpvariable', 'php_var', $translation_array );
	// Enqueued script with localized data.
	wp_enqueue_script( 'phpvariable' );
}
add_action( 'wp_enqueue_scripts', 'tmpmela_load_more' );
/* Function to show cart header cart dropdown in all pages */
function tmpmela_always_show_cart() {
    return false;
}
add_filter( 'woocommerce_widget_cart_is_hidden', 'tmpmela_always_show_cart', 40, 0 );
/* advanced search */
if ( ! function_exists( 'tmpmela_advanced_search_query' ) ) :
function tmpmela_advanced_search_query($query) {
    if($query->is_search()) {
        	if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
					$query->set('tax_query', array(array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => array($_GET['product_cat']) )
				));
			}   
		}
        return $query;
   }
  endif;
add_action('pre_get_posts', 'tmpmela_advanced_search_query', 1000);
/*  Out of Stock */
if ( ! function_exists( 'tmpmela_out_of_stock' ) ) :
function tmpmela_out_of_stock() {
 global $product;
 	if ( !$product->is_in_stock() ) {
        echo '<div class="soldout_wrapper"><span class="soldout">'.esc_html__('SOLD OUT','firezy').'</span></div>';
    }
}
endif;
add_action('woocommerce_before_shop_loop_item_title', 'tmpmela_out_of_stock');
//dequeue css from plugins
add_action('wp_print_styles', 'tmpmela_dequeue_css_from_plugins', 100);
function tmpmela_dequeue_css_from_plugins()  {
wp_dequeue_style('newsletter');
}	
/* Show an Counter in Single product page. */
if ( ! function_exists( 'tmpmela_sale_counter' ) ) {
	function tmpmela_sale_counter() {
		global $post,$product , $today;
		$ids =  $product->get_id();
		$today = date('Y-m-d');
		$sale_price_dates_from = ( $date = get_post_meta( $post->ID, '_sale_price_dates_from', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
		$sale_price_dates_to = ( $date = get_post_meta( $post->ID, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
			if ($today >= $sale_price_dates_from  && $today <= $sale_price_dates_to){
			 if($product->is_type( 'simple' ) && $sale_price_dates_to != "" )
			 {	echo '<div class="count-down"><div class="countbox hastime" data-time="'.$sale_price_dates_to.'"></div></div>';	}
			}
	}
}
add_action( 'woocommerce_single_product_summary', 'tmpmela_sale_counter');
//Percentage sale badge
if (!function_exists('tmpmela_sale_percentage')) {
    function tmpmela_sale_percentage()
    {
        global $product;
        $max_percentage = 0;
        if ($product->is_on_sale()) {
            if (!$product->is_type(array('variable', 'grouped'))) {
                $max_percentage = (($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100;
            } else {
                $percentage = 0;
                foreach ($product->get_children() as $child_id) {
                    $variation = wc_get_product($child_id);
                    $price = $variation->get_regular_price();
                    $sale = $variation->get_sale_price();
                    if ($price != 0 && !empty($sale)) $percentage = ($price - $sale) / $price * 100;
                    if ($percentage > $max_percentage) {
                        $max_percentage = $percentage;
                    }
                }
           }
            echo "<span class='onsale'>-" . round($max_percentage) . "%</span>";
        }
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'tmpmela_sale_percentage', 10);
add_action('woocommerce_product_thumbnails', 'tmpmela_sale_percentage', 10);
/* Move the price div */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5 );
//Remove Sales Flash
add_filter('woocommerce_sale_flash', 'tmpmela_custom_hide_sales_flash');
function tmpmela_custom_hide_sales_flash()
{ return false;}
// Woocommerce rating stars always
	add_filter('woocommerce_product_get_rating_html', 'tmpmela_get_rating_html', 10, 2);
function tmpmela_get_rating_html($rating_html, $rating)
{
  	if ( $rating > 0 ) {
    	$title = sprintf( __( 'Rated %s out of 5', 'firezy' ), $rating );
  	} else {
    	$title = 'Not yet rated';
    	$rating = 0;
  	}
  	$rating_html  = '<div class="star-rating" title="' . $title . '">';
    $rating_html .= '<span style="width:' . (($rating / 5) * 100) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_attr__('out of 5', 'firezy') . '</span>';
  	$rating_html .= '</div>';
  	return $rating_html;
	}
	
/* for move comment field*/
function tmpmela_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}
 
add_filter( 'comment_form_fields', 'tmpmela_move_comment_field_to_bottom' );
function tmpmela_update_comment_fields( $fields ) {
$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$label     = $req ? '*' : ' ' . __( '(optional)', 'firezy' );
$aria_req  = $req ? "aria-required='true'" : '';
$fields['author'] =
'<p class="comment-form-author comment-block">
<input id="author" name="author" type="text" placeholder="' . esc_attr__( "Name*", "firezy" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
'" size="30" ' . $aria_req . ' />
</p>';
$fields['email'] =
'<p class="comment-form-email comment-block">
<input id="email" name="email" type="email" placeholder="' . esc_attr__( "E-mail*", "firezy" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
'" size="30" ' . $aria_req . ' />
</p>';
$fields['url'] =
'<p class="comment-form-url comment-block">
<input id="url" name="url" type="url"  placeholder="' . esc_attr__( "Website", "firezy" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
'" size="30" />
</p>';
return $fields;
}
add_filter( 'comment_form_default_fields', 'tmpmela_update_comment_fields' );

/* Function to add cms tab in product single page */
function tmpmela_single_product_cms_tab(){   
		if (is_active_sidebar('single-product-cms-tab')) : ?>
			<div class="product-cms-tab-block">	<?php
				dynamic_sidebar('single-product-cms-tab');  ?>
			</div>
		<?php endif;
}
add_action( 'woocommerce_share', 'tmpmela_single_product_cms_tab' );
/** to change the position of excerpt **/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
/** to change the position of excerpt **/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 11 );
/* remove type attr*/
add_action('wp_loaded', 'tmpmela_prefix_output_buffer_start');
function tmpmela_prefix_output_buffer_start() { 
    ob_start("tmpmela_prefix_output_callback"); 
}
add_action('shutdown', 'tmpmela_prefix_output_buffer_end');
function tmpmela_prefix_output_buffer_end() { 
    if (ob_get_length() > 0) { ob_end_clean(); }
}
function tmpmela_prefix_output_callback($buffer) {
    return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
?>