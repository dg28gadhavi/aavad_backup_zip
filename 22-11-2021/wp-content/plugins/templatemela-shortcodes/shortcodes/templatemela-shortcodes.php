<?php
/***************** accordion ****************/
function shortcode_accordion($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'style'	=> '1'	
	), $atts));
	
	$output = '';
	$output .= '<div class="accordion style'.$style.'">';
	$output .=	do_shortcode($content);
	$output .=	'</div>';
	return $output;
	return $output;
}
add_shortcode('tmpmela_accordion', 'shortcode_accordion');
function shortcode_single_accordion($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' => 'Click here to hide/show Div'
	), $atts));
	$output = '';
	$output .= '<div class="single_accordion">';
	$output .= '<a class="tog" href="#"><div class="accordion-title"><span class="icon"></span>'.$title.'</div></a>';
	$output .= '<div class="tab_content">'.do_shortcode($content).'</div>';
	$output .=	'</div>';
	return $output;
}
add_shortcode('accordion', 'shortcode_single_accordion');
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_tmpmela_accordion extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_accordion extends WPBakeryShortCode {
	}
}

/***************** Blog Posts ****************/
function shortcode_blog_posts_container($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => 'grid',
		'items_per_column' => '5',
		'number_of_posts' => '10',
		'category' => '',
		'width' => '303',
		'height' => '166',
		'linkurl' => '',
		'linktext' => '',

	), $atts));
	
	$linktextvariable = "";
	
	if(!empty($linkurl) || !empty($linkurl)):
		$linktextvariable .= '<div class="blog-more-link"><a href='.$linkurl.'>'.$linktext.'</a></div>';
endif;

if(!empty($category)):
	$term_id = $category;	
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $number_of_posts,
		'orderby' => 'date',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $term_id
			)
		)
	);	
else:
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $number_of_posts,
		'orderby' => 'date'	
	);	
endif;	

$i = 1;
wp_reset_postdata();

$output = '';
$blog_array = new WP_Query( $args );	
$count = $blog_array->post_count;
$output = '';
$style='';
if ( $blog_array->have_posts() ):
	$output .= '<div id="blog-posts-products" class="blog-posts-content posts-content '.$type.'">';	
	if($type == "slider") { 
		if($count > $items_per_column)
			$output .= '<div id="'.$items_per_column.'_blog_carousel" class="slider blog-carousel style-'.$style.'">';
		else
			$output .= '<div id="blog_grid" class="blog-grid grid cols-'.$items_per_column.'">';
	} else {
		$output .= '<div id="blog_grid" class="blog-grid grid cols-'.$items_per_column.'">';
	}
	
	while ( $blog_array->have_posts() ) : $blog_array->the_post();

		if($i % $items_per_column == 1 )
			$class = " first";
		elseif($i % $items_per_column == 0 )
			$class = " last";
		else
			$class = "";
		$post_day = get_the_date('jS');
		$post_month = get_the_date('F');
		$post_year = get_the_date('Y');
		$post_author = get_the_author();
		$args = array(
			'status' => 'approved',
			'number' => '5',
			'post_id' => get_the_ID()
		);
		$comments = wp_count_comments(get_the_ID()); 				   
		if ( has_post_thumbnail() && ! post_password_required() ) :	
			$post_thumbnail_id = get_post_thumbnail_id();
		$image = wp_get_attachment_url( $post_thumbnail_id );
	else:
		$image = get_template_directory_uri()."/images/placeholders/placeholder.jpg";					
	endif;
	$src = tmpmela_mr_image_resize($image, $width, $height, true, 't', false);
	if( empty ( $src ) || $src == 'image_not_specified' ):
		$src = get_template_directory_uri()."/images/megnor/placeholder.png";
		$src = tmpmela_mr_image_resize($src, $width, $height, true, 't', false);			
	endif;

		$output .= '<div class="item container '.$class.'">';
		$output .= '<div class="container-inner">';

		$output .= '<div class="post-image-outer"><div class="post-image">';
		$output .= '<img src="'.$src.'" title="'.get_the_title().'" alt="'.get_the_title().'" />';
		$output .= '<div class="block_hover">';
		$output .= '<div class="links">';				
		$output .= '<a href="'.$image.'" class="icon mustang-gallery"><i class="fa fa-plus"></i></a>';				
		$output .= '<a href="'.get_permalink().'" class="icon"><i class="fa fa-link"></i></a>';
		$output .= '</div>';
		$output .= '</div>';					
		$output .= '</div></div>';
		$output .= '<div class="post-content-outer">';
		$output .= '<div class="post-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div>';
		$output .= '<div class="post-date">'.$post_day.' '.$post_month.', '.$post_year.'</div>';
		$output .= '<div class="post-description">'.tmpmela_blog_post_excerpt(110).'</div>';
		$output .= '</div>';

		$output .= '</div></div>';

	$i++;
endwhile;
$output .= $linktextvariable;
wp_reset_postdata();
$output .=	'</div></div>';
else:
	$output .= '<div class="no-result">'.esc_html__('No results found...', 'firezy').'</div>';
endif;
return $output;
}
add_shortcode('blog_posts', 'shortcode_blog_posts_container');

/***************** Logo ****************/
function shortcode_logo($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'type' => 'slider',
		'items_per_column' => 5
	), $atts));
	$output = '';
	$output .= '<div id="brand-products" class="tmpmela_logocontent">';
	if($type == 'slider'):
		$output .= '<div id="'.$items_per_column.'_brand_carousel" class="brand-carousel tm-logo-content">';
	else:
		$output .= '<div id="'.$items_per_column.'_brand_grid" class="brand-grid tm-logo-content cols-'.$items_per_column.'">';							
	endif;
	$output .=	do_shortcode($content).'</div></div>';
	return $output;
}
add_shortcode('tmpmela_logo', 'shortcode_logo');
function shortcode_logoinner($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"image" => '',
		"link_url" => '',
		"target" => '_self',
		"title" => 'Logo Image',
	), $atts));

	$output = '';
	$image = tmpmela_vc_image($image);		
	$output .= '<div class="item brand_main"><div class="product-block"><a href="'.$link_url.'" target="'.$target.'"><img src="'.$image.'" alt="'.$title.'"/></a></div></div>';	
	return $output;
}
add_shortcode("tmpmela_logoinner", "shortcode_logoinner");
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_tmpmela_logo extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_tmpmela_logoinner extends WPBakeryShortCode {
	}
}
/***************** Button *****************/
function shortcode_button($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' => '',
		'background_color' => '',
		'link_url' => '',
		'icon' => '',
		'icon_align' => 'left',
		'target' => '_self'
	), $atts)); 
	wp_reset_query();
	$style_css = '';
	if(!empty($background_color)):
		$style_css .= 'background-color: #'.$background_color.';';
		$icon_class = '';
	else:
		$icon_class = ' no-background';
	endif;
	$output = '';
	$output .= '<div class="button_content_inner '.$icon_align.'">';
	if(!empty($icon)){
		if($icon_align == 'left')
			$output .= '<a href="'.$link_url.'" target="'.$target.'" class="button button_'.$type.' '.$icon_align.'" style="'.$style_css.'"><i class="fa '.$icon.'"></i>'.do_shortcode($content).'</a>';
		if($icon_align == 'right')
			$output .= '<a href="'.$link_url.'" target="'.$target.'" class="button button_'.$type.' '.$icon_align.'" style="'.$style_css.'">'.do_shortcode($content).'<i class="fa '.$icon.'"></i></a>';
	}else{
		$output .= '<a href="'.$link_url.'" target="'.$target.'" class="button button_'.$type.'" style="'.$style_css.'">'.do_shortcode($content).'</a>';
	}	
	$output .=	'</div>';
	return $output;
}
add_shortcode('tmpmela_button', 'shortcode_button');

/***** Product Category Tabs List******/
function shortcode_category_tabs($atts, $content = null){
	extract(shortcode_atts(array(
		'tab1_text' => '',
		'tab2_text' => '',
		'tab3_text' => '',
		'tab4_text' => '',
	), $atts));
	
	$output = '';
	
	$output .= '<div id="horizontalTab">';
	$output .= '<ul class="resp-tabs-list">';
	if(!empty($tab1_text)):
		$output .= '<li ><div class="tab-title">'.$tab1_text.'</div></li>';
	endif;
	if(!empty($tab2_text)):
		$output .= '<li ><div class="tab-title">'.$tab2_text.'</div></li>';
	endif;
	if(!empty($tab3_text)):
		$output .= '<li ><div class="tab-title">'.$tab3_text.'</div></li>';
	endif;
	
	$output .= '</ul>';
	$output .= '<div class="resp-tabs-container">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode('tmpmela_category_tabs', 'shortcode_category_tabs');
function shortcode_woo_category_slider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'category_ids' => '',
		'items_per_column' => '3',
		'items_per_page' => '20',
		'type' => 'slider'
	), $atts));	
	
	$category_ids_array = explode(",",$category_ids);
	
	$output = '';
	if (class_exists( 'WooCommerce' )) {
		$output .= '<div id="categorytab">';
		$category_ids = '';
		$term_category_id = '';
		$term_category_name = '';
		$term_categroy_slug = '';
		$term_thumbnai_id = '';
		$term_image = '';			
		$output .= '<ul class="resp-tabs-list">';
		foreach($category_ids_array as $key){
			$category_ids = get_term( $key, 'product_cat' );
			if($category_ids){
				$term_category_id = $category_ids->term_id;
				$term_category_name = $category_ids->name;
				$term_category_slug = $category_ids->slug;
				$term_thumbnail_id =  get_term_meta( $term_category_id , 'thumbnail_id', true );		
					$term_image = wp_get_attachment_url( $term_thumbnail_id );  // get the image URL
					$output .= '<li><div class="tab-title">'.$term_category_name.'</div></li>';
				}
			}
			$output .= '</ul>';
			$output .= '<div class="resp-tabs-container '.$type.'">';
			foreach($category_ids_array as $key){
				$term_array = get_term( $key, 'product_cat' );
				$term_category_id = isset($term_array->term_id) ? $term_array->term_id : '';
				$term_category_slug = isset($term_array->slug) ? $term_array->slug : '';
				$output .= do_shortcode('[woo_products type="'.$type.'" items_per_column="'.$items_per_column.'"][product_category  per_page="'.$items_per_page.'" Columns="'.$items_per_column.'" category="'.$term_category_slug.'"][/woo_products]');
			}
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}
	add_shortcode('woo_categories', 'shortcode_woo_category_slider');
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tmpmela_category_tabs extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_woo_categories extends WPBakeryShortCode {
		}
	}

/****CMS Category Product******/
function shortcode_cms_woo_category_slider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'image' =>'',
		'category_ids' =>'',
		'items_per_column' => '3',
		'items_per_page' => '20',
		'type' => 'slider',
		'title_color'=>'',
		'description_color'=>'',
		'link_text' => '',
		'link_url' => '',
		'linktext_color'=>'',
		'button_color'=>'',
		'target' => '_self',
		'excerpt_length' => 100
	), $atts));

	$term = get_term_by('slug', $category_ids, 'product_cat'); 
	$category_ids_array = $term->term_id;

	$output = '';
	$cmstitle_color='';
	$cmsdescription_color='';
	$cmslinktext_color='';
	$cmsbutton_color='';

	$image = tmpmela_vc_image($image);
	if(!empty($title_color)) :
		$cmstitle_color .= 'color: '.$title_color.';';
	endif;
	if(!empty($description_color)) :
		$cmsdescription_color .= 'color: '.$description_color.';';
	endif;

	if(!empty($linktext_color)) :
		$cmslinktext_color .= 'color: '.$linktext_color.';';
	endif;

	if(!empty($button_color)) :
		$cmsbutton_color .= 'background-color: '.$button_color.';';
	endif;
	if(empty($image)) :
		$noimage = 'no-image';
	endif;
	if (class_exists( 'WooCommerce' )) {
		$output .= '<div class="imagecategorytab">';
		$category_ids_array = '';
		$term_category_id = '';
		$term_category_name = '';
		$term_category_slug = '';
		$term_category_description = '';
		$term_thumbnai_id = '';
		$term_image = '';

		
		if(!empty($image)):
			
			$output .= '<div class="category-banner-image one-category">';
			$output .= '<a href="'.$link_url.'" target="'.$target.'"><img src="'.$image.'" alt="'.get_the_title().'"/></a>';

		 endif;
		 if(empty($image)):
			$output .= '<div class="category-banner-image one-category no-image">';
		 endif;
			
			$output .= '<div class="image-category-block">';
			
			if($term){
				$term_category_id = $term->term_id;
				$term_category_name = $term->name;
				$term_category_slug = $term->slug;
				$term_category_description = $term->description;
				$term_thumbnail_id =  get_term_meta( $term_category_id , 'thumbnail_id', true );
                $term_image = wp_get_attachment_url( $term_thumbnail_id );  // get the image URL
                $output .='<div class="tab-title" style="'.$cmstitle_color.'">'.$term_category_name.'</div>';
                $output .='<div class="category_description" style="'.$cmsdescription_color.'">'.substr( $term_category_description, 0,$excerpt_length ).'</div>';
                $output .='<div class="category_button"><a class="cat-link" style="'.$cmslinktext_color.' '.$cmsbutton_color.'" href="'.$link_url.'" title="'.$link_text.'" target="_Self" >'.$link_text.'</a></div>';
            }
         
            $output .= '</div>';
            $output .= '</div>';
       
        $output .= '<div class="category-container '.$type.'">';
   
			$term_array = get_term( $term, 'product_cat' );
        	$term_category_id = isset($term_array->term_id) ? $term_array->term_id : '';
        	$term_category_slug = isset($term_array->slug) ? $term_array->slug : '';
        	$output .= do_shortcode('[woo_products type="'.$type.'" items_per_column="'.$items_per_column.'"][product_category  per_page="'.$items_per_page.'" Columns="'.$items_per_column.'" category="'.$term_category_slug.'"][/woo_products]');

        $output .= '</div>';
        $output .= '</div>';
    }
    return $output;
}
add_shortcode('cms_woo_categories', 'shortcode_cms_woo_category_slider');
	/****************** CMS Image Banners ******************/
	function shortcode_cms_block($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'image' => '',
			'classname' => '',
			'style' => '1',
			'cms_text_align' => 'cms-left-text',
			'link_text' => '',
			'linktext_color' => '',
			'link_url' => '',
			'button_color'=>'',
			'target' => '_self',
			'text1'  => '',
			'text1_color' => '',
			'text2'  => '',
			'text2_color' => '',
			'text3'  => '',
			'text3_color' => '',
		), $atts));
		$output = '';
		$cmstext1 = '';	
		$cmstext2 = '';	
		$cmstext3 = '';	
		$cmstext1_color = '';
		$cmstext2_color = '';
		$cmstext3_color = '';
		$cmslinktext_color = '';	
		$cmsbutton_color ='';
		$cmsimg = '';	
		$noimage ='';


		$image=tmpmela_vc_image($image);
		if(empty($image)) :
			$noimage = 'no-image';
		endif;
		if(!empty($text1_color)) :
			$cmstext1_color .= 'color:'.$text1_color.';';
		endif;
		if(!empty($text2_color)) :
			$cmstext2_color .= 'color:'.$text2_color.';';
		endif;
		if(!empty($text3_color)) :
			$cmstext3_color .= 'color:'.$text3_color.';';
		endif;
		if(!empty($linktext_color)) :
			$cmslinktext_color .= 'color: '.$linktext_color.';';
		endif;
		if(!empty($button_color)) :
				$cmsbutton_color .= 'background-color: '.$button_color.';';
		endif;
		
		if(!empty($image)) :
			$cmsimg = '<div class="cms-banner-img"><a href="'.$link_url.'" target="'.$target.'"><img src="'.$image.'" alt="'.get_the_title().'"/></a></div>';
		endif;
		if(!empty($text1)) :	
			$cmstext1 = '<span class="text1 static-text" style="'.$cmstext1_color.'">'.$text1.'</span>';		
		endif;
		if(!empty($text2)) :	
			$cmstext2 = '<span class="text2 static-text" style="'.$cmstext2_color.'">'.$text2.'</span>';		
		endif;
		if(!empty($link_text)) :	
			$link_text = '<span class="shop-now"><a href="'.$link_url.'" target="'.$target.'" class="link-text"  style="'.$cmslinktext_color.' '.$cmsbutton_color.'">'.$link_text.'</a></span>';		
		endif;		
		if(!empty($text3)) :	
			$cmstext3 = '<span class="banner-text"><span class="text3 static-text" style="'.$cmstext3_color.'">'.$text3.'</span></span>';		
		endif;
		
		$output .='<div class="cms-banner-item '.$classname.' style-'.$style.' '.$noimage.'"><div class="cms-banner-inner">'.$cmsimg.'<span class="static-wrapper '.$cms_text_align.'">'.$cmstext1.''.$cmstext2.''.$link_text.''.$cmstext3.'</span></div></div>';
		
		return $output;
	}
	add_shortcode('tmpmela_cms_block', 'shortcode_cms_block');
	/************** Contact Address **************/
	function shortcode_address($atts, $content = null){
		extract(shortcode_atts(array(
			'title' => '',	
			'description' => '',
			'address_label' => 'Address:',
			'phone_label' => 'Phone numbers:',
			'phone' => '',
			'email_label' => 'Email:',
			'email' => '',
			'email_link' => '',
			'other_label' => 'We are open:',
			'other' => '',

		), $atts));
		$output = '';
		$output .= '<div class="address-container hb-animate-element right-to-left">';
		if(!empty($title))
			$output .= '<h1 class="address-title simple-title"><span>'.$title.'</span></h1>';
		if(!empty($description))
			$output .= '<div class="address-description description">'.$description.'</div>';


		$output .= '<div class="address-text first"><div class="address-text-inner"><div class="icon"><i class="fa fa-map-marker"></i></div> <div class="content"><div class="address-label">'.$address_label.'</div>'.do_shortcode($content).'</div> </div></div>';
		
		if(!empty($phone)):
			$output .= '<div class="address-text second"><div class="address-text-inner"><div class="icon"><i class="fa fa-phone"></i></div> <div class="content"><div class="address-label">'.$phone_label.'</div>'.$phone.'</div> </div></div>';
		endif;
		
		if(!empty($email)):
			if(!empty($email_link)):
				$output .= '<div class="address-text third"><div class="address-text-inner"><div class="icon"><i class="fa fa-envelope "></i></div> <div class="content"><div class="address-label">'.$email_label.'</div><a href="'.$email_link.'">'.$email.'</a><p>'.$other.'</p></div></div></div>';	
			else:
				$output .= '<div class="address-text><div class="address-text-inner"><div class="icon"><i class="fa fa-envelope "></i></div>  <div class="content"><div class="address-label">'.$email_label.'</div>'.$email.'></div></div></div>';	
			endif;
		endif;	
		$output .= '</div>';
		return $output;

	}
	add_shortcode('tmpmela_address', 'shortcode_address');


	/*****************  Faqs  *****************/
	function shortcode_faqs($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'style' => '1',
			'category' => ''
		), $atts));
		$output = '';
		$output .= '<div class="faqs-container">';
		$output .= '<div class="faqs-content style-'.$style.'">';

		if(!empty($category)):	
			$term_id = $category;	
			$args = array(
				'post_type' => 'faq',
				'post_status' => 'publish',
				'posts_per_page' => '50',
				'tax_query' => array(
					array(
						'taxonomy' => 'faq_categories',
						'field' => 'id',
						'terms' => $term_id
					)
				)
			);
			query_posts($args);	
			$term = get_term( $term_id, 'faq_categories' );		
			if(!empty($term)):	
				$output .= '<h3 class="small-title">'.$term->name.'</h3>';
			endif;	
			$output .= '<div class="faqs-category-container">';
			while (have_posts()) : the_post(); 
				if($style == '1'):
					$output .= '<div class="single-faq toogle_div">';
					$output .= '<a class="tog" href="#"><span class="faq_title">'. get_the_title() .' </span></a>';
					$output .= '<div class="tab_content">'.get_the_content().'</div>';
					$output .= '</div>';
				endif;
				if($style == '2'):
					$output .= '<div class="single-faq">';
					$output .= '<div class="title">'.get_the_title().'</div>';
					$output .= '<div class="content">'.get_the_content().'</div>';
					$output .= '</div>';
				endif;
			endwhile; 
			$output .= '</div>';
		else:
			$categories = get_categories('hide_empty=0&orderby=name&taxonomy=faq_categories');		
			foreach ($categories as $category_item ) {
				$args = array(
					'post_type' => 'faq',
					'post_status' => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => 'faq_categories',
							'field' => 'id',
							'terms' => $category_item->term_id
						)
					)
				);
				query_posts($args);	
				$output .= '<h3 class="small-title">'.$category_item->name.'</h3>';
				$output .= '<div class="faqs-category-container">';
				while (have_posts()) : the_post(); 
					if($style == '1'):
						$output .= '<div class="single-faq toogle_div">';
						$output .= '<a class="tog" href="#"><span class="faq_title">'. get_the_title() .' </span></a>';
						$output .= '<div class="tab_content">'.get_the_content().'</div>';
						$output .= '</div>';
					endif;
					if($style == '2'):
						$output .= '<div class="single-faq">';
						$output .= '<div class="title">'.get_the_title().'</div>';
						$output .= '<div class="content">'.get_the_content().'</div>';
						$output .= '</div>';
					endif;
				endwhile; 
				$output .= '</div>';
			}
		endif; 
		$output .= '</div>';
		$output .= '</div>';
		wp_reset_query();
		return $output;
	}
	add_shortcode('faqs', 'shortcode_faqs');

	/****************  Features Content  ************/
	function shortcode_about($atts, $content = null){
		extract(shortcode_atts(array(					
			'title' => '',
			'link_text' => 'read more',
			'link_url' => '#',	
			'image' => '',
			'image_align' => 'right',	
			'target' => '_self',					 
		), $atts));
		
		$output = '';
		$image=tmpmela_vc_image($image);
		$output .='<div class="tmpmela_about">';
		$output .='<div class="tmpmela_about_inner image-'.$image_align.'">';
		if(!empty($image)):		
			$output .='<div class="about_image">';
			$output .='<img src="'.$image.'" alt="'.get_the_title().'" />';
			$output .='</div>';
		endif;
		if(!empty($image))
			$output .='<div class="about_content">';
		else
			$output .='<div class="about_content">';
		$output .='<h1 class="title">'.$title.'</h1>';
		$output .='<div class="description">'.do_shortcode($content).'</div>';
		$output .='<div class="readmore"><a href="'.$link_url.'" title="'.$link_text.'" target="'.$target.'">'.$link_text.'<i class="fa fa-arrow-right"></i></a></div>';
		$output .='</div>';
		$output .='</div></div>';
		return $output;
	}
	add_shortcode('tmpmela_about', 'shortcode_about');

	/***************** Home Page Service ****************/
	function shortcode_service($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'service_number'=>'',
			'service_title'=>'',
			'service_other_text'=>'',
			'link_url'=>'',
			'target'=>'_self'
		), $atts));

		$output ='';
		$output .='<div class="service-list service-'.$service_number.'">';
		$output .='<div class="service-content">';
		$output .='<span class="icon-image"> </span>';
		$output .='<div class="content">';
		$output .='<a href="'.$link_url.'" title="'.$service_title.'" target="'.$target.'">';
		$output .='<div class="service-title">'.$service_title.'</div>';
		$output .='<div class="service_other_text">'.$service_other_text.'</div></a>';
		$output .='</div>';
		$output .='</div>';
		$output .='</div>';
		return $output;
	}
	add_shortcode('tmpmela_service', 'shortcode_service');

	/***************** Hot Product With Thumbnail ****************/
	function shortcode_home_products_container($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'height' => '368',
			'width' => '280',
			'number_of_items' => '5',
			'excerpt_length' => '20'
		), $atts));
		$output = '';

		global $post;
		$params = array('posts_per_page' => -1,'post_type' => array('product', 'product_variation'));
		$wc_query = new WP_Query($params);
		if ( in_array( 'woocommerce/woocommerce.php' ,apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
			$output .= '<div id="home_featured_carousel" class="home-featured-carousel owl-carousel woocommerce single-product products">';
			if ($wc_query->have_posts()) :
				while ($wc_query->have_posts()) :	   
					$wc_query->the_post(); 
					$today = date('Y-m-d');	
					$sale_price_dates_from = ( $date = get_post_meta( $post->ID, '_sale_price_dates_from', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';	  
					$sale_price_dates_to    = ( $date = get_post_meta( $post->ID, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';

					if ($today >= $sale_price_dates_from  && $today <= $sale_price_dates_to){
						if ($sale_price_dates_to != "")
						{	
							global $product;
							$rating = $product->get_average_rating();
							$attachment_ids = $product->get_gallery_image_ids();

							$output .= '<div class="item">';

							$output .= '<div class="feature-image-wrapper">';	    	
							if($product->is_on_sale() ) :
								$output.='<span class="onsale">'. __( 'Sale', 'woocommerce' ).'</span>';
							endif;
							$output .= '<div class="images image-carousel owl-carousel">';	

							if ( has_post_thumbnail() ) {

								$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
								$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
								$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
									'title'	=> get_the_title( get_post_thumbnail_id() )
								) ); 
								$output .= '<img alt="'.get_the_title().'" src="'.$image_link.'" height="'.$height.'"  width="'.$width.'"/>';
							}  

							foreach( $attachment_ids as $attachment_id ) 
								{ $image_link = wp_get_attachment_url( $attachment_id );
									$output .='<img alt="'.get_the_title().'" src="'.$image_link.'"  height="'.$height.'"  width="'.$width.'"/>';	
								} 

								$output .='</div></div>';

								$output .= '<div class="product-detail">';	
								$output .='<h1 class="product_title">';
								$output .='<a href="'.get_permalink().'">'.$product->get_title().'</a>';
								$output .='</h1>';
								$output .='<div class="woocommerce-product-rating">'.wc_get_rating_html($rating).'</div>';
								$output .='<div class="product-price price">'.$product->get_price_html().'</div>';
								$output .='<div class="product-description">'.tmpmela_excerpt($excerpt_length).'</div>';
								$output .='<div class="count-down">';
								$output .='<div class="countbox hastime" data-time="'.$sale_price_dates_to.'">';
								$output .= '</div></div>';

								if ( ! $product->is_in_stock() ) : 
									$output .= '<a href="'.apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->get_id() ) ).'" class="button">'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ).'</a>';
								else :
									$link = array(
										'url'   => '',
										'label' => '',
										'class' => ''
									);
									switch ( $product->get_type() ) {
										case "variable" :
										$link['url']    = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->get_id() ) );
										$link['label']  = apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
										break;
										case "grouped" :
										$link['url']    = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->get_id() ) );
										$link['label']  = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'woocommerce' ) );
										break;
										case "external" :
										$link['url']    = apply_filters( 'external_add_to_cart_url', get_permalink( $product->get_id() ) );
										$link['label']  = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
										break;
										default :
										if ( $product->is_purchasable() ) {
											$link['url']    = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
											$link['label']  = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'woocommerce' ) );
											$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
										} else {
											$link['url']    = apply_filters( 'not_purchasable_url', get_permalink( $product->get_id() ) );
											$link['label']  = apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );
										}
										break;
									} 	
									$output .='<div class="product-button product-block-hover">';
// If there is a simple product.
									if ( $product->get_type() == 'simple' ) {
// Display the submit button.
										$output .= sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s product_type_simple ">%s</a>',
											esc_url( $product->add_to_cart_url() ),
											esc_attr( isset( $quantity ) ? $quantity : 1 ),
											esc_attr( $product->get_id() ),
											esc_attr( $product->get_sku() ),
											esc_attr( isset( $class ) ? $class : 'button add_to_cart_button ajax_add_to_cart' ),
											esc_html( $product->add_to_cart_text() ));
									} 
									else
									{
										$output .= sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
											esc_url( $product->add_to_cart_url() ),
											esc_attr( isset( $quantity ) ? $quantity : 1 ),
											esc_attr( $product->get_id() ),
											esc_attr( $product->get_sku() ),
											esc_attr( isset( $class ) ? $class : 'button add_to_cart_button ajax_add_to_cart' ),
											esc_html( $product->add_to_cart_text() ));
									}
								endif;	

	
	if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
			$output .= do_shortcode( "[yith_compare_button]" );
		endif;	
	
	if ( in_array( 'yith-woocommerce-quick-view/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
			$output .= do_shortcode( "[yith_quick_view]" );
		endif; 
	if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
			$output .= do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		endif;		
	$output .='</div>';
								$output .='</div>';


								$output .='</div>';
							}
						}

					endwhile; 
					wp_reset_postdata();
				endif;
				$output .='</div>';
			}
			return $output;
		}
		add_shortcode('home_products', 'shortcode_home_products_container');


	/***************** List Style ****************/
	function shortcode_tmpmela_list($atts, $content = null){
		extract(shortcode_atts(array(				 
		), $atts));
		$output = '';
		$output .= '<ul class="list">';
		$output .= do_shortcode($content);
		$output .=	'</ul>';
		return $output;
	}
	add_shortcode('tmpmela_list', 'shortcode_tmpmela_list');
	function shortcode_list($atts, $content = null){
		extract(shortcode_atts(array(
			'icon' =>  'fa-circle-o',
			'color' => '000000',
			'target' => '_self',
			'link_url' => '',
		), $atts));
		$output = '';
		$output .= '<li><a href="'.$link_url.'" target="'.$target.'"><i style="color:'.$color.'" class="fa '.$icon.'"></i>'.do_shortcode($content).'</a></li>';
		return $output;
	}
	add_shortcode('list_item', 'shortcode_list');
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tmpmela_list extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_list_item extends WPBakeryShortCode {
		}
	}

	/***************** Static Text ****************/
	function shortcode_static_text($atts, $content = null){
		extract(shortcode_atts(array(
			'align' => 'left'
		), $atts));

		$output = '';
		$output .= '<div class="static-text-container '.$align.'">';
		$output .= '<div class="text">'.do_shortcode($content).'</div>';
		$output .= '</div>';	
		return $output;
	}
	add_shortcode('text', 'shortcode_static_text');

	/***************** Static links ****************/
	function shortcode_tmpmela_links($atts, $content = null){
		extract(shortcode_atts(array(				 
		), $atts));
		$output = '';
		$output .= '<ul class="links">';
		$output .= do_shortcode($content);
		$output .=	'</ul>';
		return $output;
	}
	add_shortcode('tmpmela_links', 'shortcode_tmpmela_links');
	function shortcode_link($atts, $content = null){
		extract(shortcode_atts(array(
			'link_url' =>  '',
			'target' => '_self',								 
		), $atts));
		$output = '';
		if(!empty($link_url))
			$output .= '<li><a href="'.$link_url.'" target="'.$target.'">'.do_shortcode($content).'</a></li>';
		else
			$output .= '<li>'.do_shortcode($content).'</li>';
		return $output;
	}
	add_shortcode('link', 'shortcode_link');
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tmpmela_links extends WPBakeryShortCodesContainer {
		}
	}

	/***************** Portfolio Filter ****************/
	function shortcode_portfolio_filter_container($atts, $content = null, $code) {
		global $logotype;
		extract(shortcode_atts(array(
			'items_per_column' => 4,
			'align' => '',
			'width' => '',
			'height' => ''		
		), $atts));
		$categories = get_categories('hide_empty=0&orderby=name&taxonomy=portfolio_categories');	
		$output = '';
		$output .= '<div class="clearfix portfolio-filter-container filter-container">';
		$output .= '<section id="portfolio_filter_options" class="options category-container">';
		$output .= '<ul id="filters" class="option-set"  data-option-key="filter">';
		$output .= '<li><a href="#show-all" data-option-value="*" class="selected">Show All</a></li>';
		foreach ($categories as $category_item ) {
			$output .= '<li><a href="#'.$category_item->slug.'" data-option-value=".'.$category_item->slug.'">'.$category_item->cat_name.'</a></li>';
		}
		$output .= '</ul></section>'; 
		$output .= '<div class="portfolio-filter-outer portfolios">';					 
		$output .= '<div id="portfolio_filter" class="portfolio-container portfolio-filter clearfix da-thumbs portfolio-cols-'.$items_per_column.'">';
		foreach ($categories as $category_item ):
			$paged = ( isset( $my_query_array['paged'] ) && !empty( $my_query_array['paged'] ) ) ? $my_query_array['paged'] : 1;
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $category_item->term_id,
						'paged' => $paged
					)
				)
			);
			query_posts($args);  
			while (have_posts()) : the_post();
				$image = tmpmela_get_first_post_images(get_the_ID());
				$src = tmpmela_mr_image_resize($image, $width, $height, true, 't', false);
				if( empty ( $src ) || $src == 'image_not_specified' ):
					$src = get_template_directory_uri()."/images/megnor/placeholder.png";
					$src = tmpmela_mr_image_resize($src, $width, $height, true, false);
				endif;
				$output .= '<div class="'.$category_item->slug.' main item single-portfolio">';
				$output .= '<div class="image image-block">';
				$output .= '<img src="'.$src.'" title="'.get_the_title().'" alt="'.get_the_title().'" />';
				$output .= '<div class="block_hover"><div class="block_hover_inner">';
				$output .= '<h3 class="entry-title">'.get_the_title().'</h3>';
				$output .= '<div class="links">';
				$output .= '<a href="'.$image.'" class="icon mustang-gallery"><i class="fa fa-plus"></i></a>';
				$output .= '<a href="'.get_permalink().'" class="icon"><i class="fa fa-link"></i></a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div></div>';		
				$output .= '<p style="font-size: 16px; font-weight: 600; color: #000;">'.get_the_title().'</p></div>';
			endwhile; 
		endforeach;
		wp_reset_query();
		$output .= '</div></div></div>'; 
		return $output;
	}
	add_shortcode('tmpmela_portfolio_filter', 'shortcode_portfolio_filter_container');

	/***************** Portfolio Slider ****************/
	function shortcode_portfolio_slider_container($atts, $content = null, $code) {
		global $logotype;
		extract(shortcode_atts(array(
			'category' => '',
			'items_per_column' => 3,
			'number_of_posts' => 10,
			'width' => '',
			'height' => '',
			'excerpt_length' => '100'
		), $atts));

		if(!empty($category)):
			$term_id = $category;	
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'posts_per_page' => $number_of_posts,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $term_id
					)
				)
			);		
		else:
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'posts_per_page' => "'".$number_of_posts."'"
			);		
		endif;			
		$array_posts = query_posts($args);
		$count = count($array_posts);
		$output = '';
		if($count > 0):
			$output .= '<div class="portfolio-container">';
			$output .= '<div id="'.$items_per_column.'_portfolio_carousel" class="portfolio-carousel  cols-'.$items_per_column.'">';
			$i = 1;
			while (have_posts()) : the_post();
				if($i % $items_per_column == 1 )
					$class = "first";
				elseif($i % $items_per_column == 0 )
					$class = "last";
				else
					$class = "";

				$image = tmpmela_get_first_post_images(get_the_ID());
				$image_src = tmpmela_mr_image_resize($image, $width, $height, true, 't', false);
				if(empty($image_src))
					$image_src = get_template_directory_uri()."/images/megnor/placeholder.png";
				$output .= '<div class="item portfolio-main">';
				$output .= '<div class="product-block single-portfolio '.$class.'">';
				$output .= '<div class="portfolio-image">';
				$output .= '<img src="'.$image_src.'" title="'.get_the_title().'" alt="'.get_the_title().'" />';
				$output .= '<div class="block_hover">';
				$output .= '<div class="links">';
				$output .= '<a href="'.$image.'" title="Click to view Full Image" class="icon mustang-gallery"><i class="fa fa-plus"></i></a>';
				$output .= '<a href="'.get_permalink().'" title="'.esc_html__('Click to view read more', 'firezy').'" class="icon"><i class="fa fa-link"></i></a>';							
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
				$output .= '<div class="portfolio-description">'.tmpmela_portfolio_excerpt($excerpt_length	).'</div>';	
				$output .= '<div class="read-more"><a href="'.get_permalink().'" title="'.get_the_title().'">'.esc_html__('Read more', 'firezy').'</a></div>';				
				$output .= '</div>';
				$output .= '</div>';
				$i++;
			endwhile;
			$output .= '</div>';
			wp_reset_query();
			$output .= '</div>';
		else:
			$output .= '<div class="no-result">'.esc_html__(''.esc_html__('No results found...', 'firezy').'', 'firezy').'</div>';
		endif;
		return $output;
	}
	add_shortcode('tmpmela_portfolio_slider', 'shortcode_portfolio_slider_container');

	/***************** Portfolio Grid  ****************/
	function shortcode_portfolio($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'column' => 4,
			'cat' => '',
			'max' => '12',
			'width' => '',
			'height' => '',
			'excerpt_length' => '100'
		), $atts));

		$output = '';
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$terms = array();
		if ($cat != '') {
			$cat = preg_replace('/\s*,\s*/', ',', $cat);
			foreach(explode(',', $cat) as $term_name) {
				$terms[] = get_term_by('name', $term_name, 'portfolio_categories');
			}	
			foreach($terms as $term) {	
				$term_ids[] = $term->term_id;
			}	
			$args = array(
				'posts_per_page' => $max,
				'paged' => $paged,
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $term_ids
					)
				)
			);	
		} else {
			$args = array(
				'posts_per_page' => $max,
				'paged' => $paged,
				'post_type' => 'portfolio',
				'post_status' => 'publish'
			);
		}
		query_posts($args);
		$output = '<div class="portfolios">';
		$output .= '<ul class="portfolio_'.$column.'column da-thumbs">';
		$num_layout =  substr($column, 0, 1);	
		$i = 1;
		while(have_posts()) {
			the_post();
			$terms = get_the_terms(get_the_ID(), 'portfolio_categories');
			if ( strlen( $img = get_the_post_thumbnail( get_the_ID()) ) ): 
				$image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );	
			else:
				$image = tmpmela_get_first_post_images(get_the_ID());
			endif;
			$src = tmpmela_mr_image_resize($image, $width, $height, true, 't',false);
			if( empty ( $src ) || $src == 'image_not_specified' ):
				$src = get_template_directory_uri()."/images/megnor/placeholder.png";
				$image = $src;
				$src = tmpmela_mr_image_resize($image, $width, $height, true, 't',false);	
			endif;
			?>
			<?php $terms_slug = array();
			if (is_array($terms)) {
				foreach($terms as $term) {
					$terms_slug[] = $term->slug;
				}
			}
			if($i % $num_layout == 0)
				$li_class = "last";
			else if($i % $num_layout == 1)
				$li_class = "first";
			else
				$li_class = "inner";
			$output .= '<li class="'.$li_class.'">';
			$more = get_post_meta(get_the_ID(), '_more', true);
			$output .= '<div class="main"><div class="image-block">';
			if(get_option('portfolio','display_image') || $column == 1):	
				$output .= '<a href= "'.$image.'" class="mustang-gallery">';
				$output .= '<img class="image1" src="'.$src.'"/ >';
				$output .= '</a>';
			endif;
			$output .= '<div class="block_hover">';
			$output .= '<div class="links">';
			$output .= '<a href="'.$image.'" title="Click to view Full Image" class="icon mustang-gallery"><i class="fa fa-plus"></i></a>';
			$output .= '<a href="'.get_permalink().'"  title="'.esc_html__('Click to view read more', 'firezy').'" class="icon"><i class="fa fa-link"></i></a>';
			$output .= '</div></div>';
			$output .= '</div>';
			$output .= '<a class="portfolio-title" href="'.get_permalink().'">'.get_the_title().'</a>';
			$output .=  tmpmela_excerpt_length_limit($excerpt_length);
			$output .= '</li>';
			$i++;
		}
		$output .= '</ul>';
		$output .= tmpmela_shortcode_paging_nav();  
		$output .= '</div>';	  
		wp_reset_query();
		return $output;
	}
	add_shortcode('tmpmela_portfolio', 'shortcode_portfolio');
	/***************** Pricing Table ****************/
	function shortcode_pricingtable($atts, $content = null) {
		extract(shortcode_atts(array(
			"heading" => '',
			"button_text" => '',
			"button_link" => '',
			"price" => '',
			"price_per" => '',
			"selected" => 'no',
			"target" => '_self',
		), $atts));

		if($selected == 'yes') 
		{
			$selected = 'selected';
		}
		$output = '';
		$output .='<div class="pricing_wrapper">';
		$output .='<div class="pricing_wrapper_inner '.$selected.'">';
		if($heading != '' && $price_per != '' && $price != '') { 
			$output .='<div class="pricing_heading">'.$heading.'</div>';
			$output .='<div class="pricing_top">';
			$output .='<div class="pricing_per">'.$price_per.'</div>';
			$output .='<div class="pricing_price">'.$price.'</div></div>';
		} 	
		else{
			$output .='<div class="nopricing_heading"></div>';
			$output .='<div class="nopricing_top"><div class="pricing_per"></div><div class="pricing_price"></div></div>';
		}


		$output .='<div class="pricing_bottom">';
		$output .='<ul>';
		$output .= do_shortcode($content);
		$output .='</ul>';
		$output .='<div class="pricing_button">';
		if($button_text != '') { 
			$output .='<a href="'.$button_link.'" target="'.$target.'" class="button" id="pricing-btn">'.$button_text .'</a>';
		} 
		$output .='</div></div>';
		$output .='</div></div>';
		return $output; 
	}
	add_shortcode("tmpmela_pricingtable", "shortcode_pricingtable");
	function shortcode_pricingtable_row($atts, $content = null){
		extract(shortcode_atts(array(	
			"symbol" => '',						 
		), $atts));
		$output = '';
		if(!empty($symbol))		
			$output .= '<li><i class="fa '.$symbol.'"></i>'.do_shortcode($content).'</li>';
		else
			$output .= '<li>'.do_shortcode($content).'</li>';
		return $output;
	}
	add_shortcode('price_row', 'shortcode_pricingtable_row');

	/***************** Products ****************/
	function shortcode_woo_products_container($atts, $content = null, $code) {
		global $logotype;
		extract(shortcode_atts(array(
			'type' => 'slider',
			'items_per_column' => 5,
			'product' => 'shop',
			'classname' => '',
			'no_more'  => 'No more Products to display'	
		), $atts));
		$logotype = $type;	
		static  $cnt = 1;
		$output = '';	
		

		$output .= '<div class="woo-products woo-content products_block '.$product.' '.$classname.'">';

		if($type == "slider") { 
			$output .= '<div id="'.$items_per_column.'_woo_carousel" class="woo-carousel cols-'.$items_per_column.'">';
		} else {
			$output .= '<div class="woo_grid woo-grid cols-'.$items_per_column.'">';
		}
		$output .= do_shortcode($content).'</div>';
		if($type == "grid") {  
			$output .=	'<div class="tmpmela-message"><i class="fa fa-frown-o"></i>'.$no_more.'</div>';
			$output .=	'<div class="loadgridlist-wrapper"><button class="woocount loadgridlist">'.esc_html__('View More Products', 'firezy').'</button></div>';		
		}

		$output .='</div>';
		$cnt++;
		return $output;
	}
	add_shortcode('woo_products', 'shortcode_woo_products_container');


		/************** Products Tabs **************/
		function shortcode_product_tabs($atts, $content = null)
		{
			extract(shortcode_atts(array(
				'tab1_text' => '',
				'tab2_text' => '',
				'tab3_text' => '',
				'tab4_text' => '',
			), $atts));

			$output = '';

			$output .= '<div id="horizontalTab">';
			$output .= '<ul class="resp-tabs-list">';
			if(!empty($tab1_text)):
				$output .= '<li ><div class="tab-title">'.$tab1_text.'</div></li>';
			endif;
			if(!empty($tab2_text)):
				$output .= '<li ><div class="tab-title">'.$tab2_text.'</div></li>';
			endif;
			if(!empty($tab3_text)):
				$output .= '<li ><div class="tab-title">'.$tab3_text.'</div></li>';
			endif;
			if(!empty($tab4_text)):
				$output .= '<li ><div class="tab-title">'.$tab4_text.'</div></li>';
			endif;
			$output .= '</ul>';
			$output .= '<div class="resp-tabs-container">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
		add_shortcode('tmpmela_product_tabs', 'shortcode_product_tabs');
		function shortcode_product_tab($atts, $content = null){
			extract(shortcode_atts(array(							 
			), $atts));
			$output = '';
			$output .= do_shortcode($content);
			return $output;
		}
		add_shortcode('tmpmela_tab_home', 'shortcode_product_tab');

		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_tmpmela_product_tabs extends WPBakeryShortCodesContainer {
			}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_tmpmela_tab_home extends WPBakeryShortCode {
			}
		}

		/***************** Services ****************/
		function shortcode_services($atts, $content = null) {	
			extract(shortcode_atts(array(
				"color" => '',
				"icon_background_color" => '',
				"icon" => 'fa-arrows-alt',
				"title" => '',
				"link_text" => '',
				"link_url" => '',
				"target" => '_self',
				"style" => '1'	
			), $atts));

			if(!empty($color)):
				$style_css = 'color:'.$color.';';
			endif;
			
			if(!empty($icon_background_color)):
				$style_css .= 'background-color:'.$icon_background_color.';';
				$icon_class = '';
			else:
				$icon_class = ' no-background';
			endif;

			$output = '';		
			$output .= '<div class="service hb-animate-element bottom-to-top style-'.$style.'">';
			$output .= '<div class="service-content style-'.$style.'">';

			if($style == '1' || $style == '2'):	
				if(!empty($icon))
					$output .= '<div class="icon"><i class="service-icon fa '.$icon.$icon_class.'" style="'.$style_css.'"></i></div>';
				if(!empty($title))
					$output .= '<div class="title service-text"><a href="'.$link_url.'" target="'.$target.'">'.$title.'</a></div>';	
			endif;	

			if($style == '3'):		
				$output .= '<div class="service-top">';		
				if(!empty($icon))
					$output .= '<div class="icon"><i class="service-icon fa '.$icon.$icon_class.'" style="'.$style_css.'"></i></div>';
				if(!empty($title))
					$output .= '<div class="title service-text">'.$title.'</div>';
				$output .= '</div>';
			endif;
			$content = do_shortcode($content);
			if(!empty($content)):
				$output .= '<div class="service-desc">';	
				$output .= '<div class="description other-font">'.do_shortcode($content).'</div>';
				$output .= '</div>';
			endif;
			if(!empty($link_text)):
				if(!empty($link_url)):
					$output .= '<div class="service-read-more other-font"><a href="'.$link_url.'" class="other-read-more" target="'.$target.'">'.$link_text.'<i class="fa fa-arrow-right"></i></a></div>';	
				else:
					$output .= '<div class="service-read-more other-font">'.$link_text.'></div>';	
				endif;
			endif;	

			$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
		add_shortcode("service", "shortcode_services");

		/******  Tabs ( Horizontal + vertical ) ******/
		$maintab_div = '';
		function tabs_group($atts, $content = null ) {
			global $maintab_div;
			extract(shortcode_atts(array(  
				'tab_type' => 'horizontal', 
				'style'	=> '1'	
			), $atts));  

			switch ($tab_type) {
				case 'vertical' :
				$element_class = 'vertical_tab';
				break;
				default :
				$element_class = 'horizontal_tab';
				break;
				break;
			}


			$maintab_div = '';
			$output = '<div id="'.$element_class.'" class="'.$element_class.' style'.$style.'"><div id="tab" class="tab"><ul class="tabs">';
			$output.= do_shortcode($content).'</ul>';
			$output.= '<div class="tab_groupcontent">'.$maintab_div.'</div></div></div>';
			return $output;  
		}  
		add_shortcode('tmpmela_tabs', 'tabs_group');
		function tab($atts, $content = null) {  
			global $maintab_div;

			static $oddeven_class=0;
			$oddeven_class++;
			$newclass = '';
			$output = ''; 
			if($oddeven_class % 2 == 0) { $newclass .= "even"; } else  { $newclass .= "odd"; }

			extract(shortcode_atts(array(  
				'title' => '', 
			), $atts));  
			$dummy_title = "'. __( 'Tab', 'templatemela' ) .'";

			if($title != NULL) { 
				$output .= '<li class="'.$newclass.'"><a href="#">'.$title.'<span class="leftarrow"></span></a></li>';			
			} else {
				$output .= '<li class="'.$newclass.'"><a href="#">'.$dummy_title.'<span class="leftarrow"></span></a></li>';			
			}
			$maintab_div.= '<div class="tabs_tab">'.do_shortcode($content).'</div>';
			return $output;
		}
		add_shortcode('tmpmela_tab', 'tab');
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_tmpmela_tabs extends WPBakeryShortCodesContainer {
			}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_tmpmela_tab extends WPBakeryShortCode {
			}
		}

		/***************   Title  ****************/
		function shortcode_title($atts, $content = null) {

			extract(shortcode_atts(array(
				'size' => 'normal',
				'color' => '',
				'align' => 'center',
				'subtitle' =>'',
				'classname' =>''
			), $atts));

			$output = '';	
			$output .= '<div class="shortcode-title '.$align.' '.$classname.'">';
			if(!empty($color))	
				$output .= '<h1 class="'.$size.'-title" style="color:'.$color.';">'.do_shortcode($content).'</h1>';	
			else
				$output .= '<h1 class="'.$size.'-title">'.do_shortcode($content).'</h1>';
			if(!empty($subtitle))	
				$output .= '<h3 class="sub-title">'.$subtitle.'</h3>';
			$output .= '</div>';
			return $output;
		}
		add_shortcode("title", "shortcode_title");
		function shortcode_our_features($atts, $content = null) {	
			extract(shortcode_atts(array(
				"icon" => '',
				"title" => '', 
				"read_more_text" => 'read more',
				"read_more_link" => '',	
			), $atts));

			$output = '';		
			$output .= '<div class="feature-container">';
			$output .= '<div class="feature-content">';
			if(!empty($icon))
				$output .= '<div class="icon"><i class="'.$icon.'"></i></div>';
			if(!empty($title))
				$output .= '<div class="title">'.$title.'</div>';
			$output .= '<div class="description">'.do_shortcode($content).'</div>';
			if(!empty($read_more_link))
				$output .= '<a href="'.$read_more_link.'" class="other-read-more">'.$read_more_text.'</a>';	
			$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
		add_shortcode("feature", "shortcode_our_features");

		/***************** Our Team ****************/
		function shortcode_ourteam($atts, $content = null) {
			extract(shortcode_atts(array(
				'type' => '',
				'items_per_column' => 4,
				'image_width' => 600,
				'image_height' => 600,
				'number_of_posts' => -1
			), $atts));

			global $post;	
			$i = 1;
			$output = '';
			wp_reset_postdata();
			$args = array(
				'posts_per_page' => $number_of_posts,
				'post_status' => 'publish',
				'post_type' => 'staff',
				'orderby' => 'date'
			);		

			$output = '';
			$team_array = new WP_Query( $args );

			if ( $team_array->have_posts() ):
				$output .= '<div id="team-posts-products" class="team-posts-content staff-page posts-content">';	
				if($type == "slider") { 
					$output .= '<div id="'.$items_per_column.'_team_carousel" class="team-carousel">';
				} else {
					$output .= '<div id="team_grid" class="team-grid grid cols-'.$items_per_column.'">';
				}	
				while ( $team_array->have_posts() ) : $team_array->the_post();
					get_post_meta(get_the_ID(), 'staff_position', TRUE) ? $staff_position = get_post_meta(get_the_ID(), 'staff_position', TRUE) : $staff_position = '';
					get_post_meta(get_the_ID(), 'staff_link', TRUE) ? $staff_link = get_post_meta(get_the_ID(), 'staff_link', TRUE) : $staff_link = '';
					get_post_meta(get_the_ID(), 'staff_phone', TRUE) ? $staff_phone = get_post_meta(get_the_ID(), 'staff_phone', TRUE) : $staff_phone = '';
					get_post_meta(get_the_ID(), 'staff_email', TRUE) ? $staff_email = get_post_meta(get_the_ID(), 'staff_email', TRUE) : $staff_email = '';
					get_post_meta(get_the_ID(), 'staff_twitter', TRUE) ? $staff_twitter = get_post_meta(get_the_ID(), 'staff_twitter', TRUE) : $staff_twitter = '';
					get_post_meta(get_the_ID(), 'staff_facebook', TRUE) ? $staff_facebook = get_post_meta(get_the_ID(), 'staff_facebook', TRUE) : $staff_facebook = '';
					get_post_meta(get_the_ID(), 'staff_google_plus', TRUE) ? $staff_google_plus = get_post_meta(get_the_ID(), 'staff_google_plus', TRUE) : $staff_google_plus = '';
					get_post_meta(get_the_ID(), 'staff_linkedin', TRUE) ? $staff_linkedin = get_post_meta(get_the_ID(), 'staff_linkedin', TRUE) : $staff_linkedin = '';
					get_post_meta(get_the_ID(), 'staff_youtube', TRUE) ? $staff_youtube = get_post_meta(get_the_ID(), 'staff_youtube', TRUE) : $staff_youtube = '';
					get_post_meta(get_the_ID(), 'staff_rss', TRUE) ? $staff_rss = get_post_meta(get_the_ID(), 'staff_rss', TRUE) : $staff_rss = '';
					get_post_meta(get_the_ID(), 'staff_pinterest', TRUE) ? $staff_pinterest = get_post_meta(get_the_ID(), 'staff_pinterest', TRUE) : $staff_pinterest = '';
					get_post_meta(get_the_ID(), 'staff_skype', TRUE) ? $staff_skype = get_post_meta(get_the_ID(), 'staff_skype', TRUE) : $staff_skype = ''; 
					$s = 0; 
					if(!empty($staff_link)) $s++;
					if(!empty($staff_email)) $s++; 
					if(!empty($staff_twitter)) $s++; 
					if(!empty($staff_facebook)) $s++; 
					if(!empty($staff_google_plus)) $s++; 
					if(!empty($staff_linkedin)) $s++; 
					if(!empty($staff_youtube)) $s++; 
					if(!empty($staff_rss)) $s++; 
					if(!empty($staff_pinterest)) $s++; 
					if(!empty($staff_skype)) $s++;	
					if($i % $items_per_column == 1 )
						$class = " first";
					elseif($i % $items_per_column == 0 )
						$class = " last";
					else
						$class = "";
					if ( has_post_thumbnail() && ! post_password_required() ) :	
						$post_thumbnail_id = get_post_thumbnail_id();
					$image = wp_get_attachment_url( $post_thumbnail_id );
				else:
					$image = get_template_directory_uri()."/images/placeholders/placeholder.jpg";
				endif;
				$src = tmpmela_mr_image_resize($image, $image_width, $image_height, true, 't', false);
				if( empty ( $src ) || $src == 'image_not_specified' ):
					$src = get_template_directory_uri()."/images/megnor/placeholder.png";
					$src = tmpmela_mr_image_resize($src, $image_width, $image_height, true, 't', false);
				endif;
				$output .= '<article class="item container'.$class.'">';
				$output .= '<div class="single-team container-inner">';
				$output .= '<div class="staff-image">';
				$output .= '<img src="'.$src.'" title="'.get_the_title().'" alt="'.get_the_title().'" />';
				$output .= '<div class="staff-image-hover"></div>';
				$output .= '</div>';	
				$output .= '<div class="team-info">';	
				$output .= '<div class="staff-content">';	
				$shorttitle = substr(the_title('','',FALSE),0,150);
				if(!empty($staff_position) && $staff_position != '')
					$output .= '<div class="staff-position"><span>'.$staff_position.'</span></div>';
				if(!empty($shorttitle) && $shorttitle != '')
					$output .= '<div class="staff-name"><a title="'.get_the_title().'" href="'.get_permalink().'" >'.$shorttitle.'</a></div>';
				$content = substr(get_the_content('','',FALSE),0,70);
				$output .= '<div class="staff_content">'.$content.'</div>';

				$output .= '<div class="staff-social icon-'.$s.'">';			
				if(!empty($staff_link) && $staff_link != '')
					$output .= '<a href="'.$staff_link.'" title="Website" class="website icon"><i class="fa fa-link"></i></a>';
				if(!empty($staff_email) && $staff_email != '')
					$output .= '<a href="mailto:'.$staff_email.'" title="Email" class="email icon"><i class="fa fa-envelope-o"></i></a>';
				if(!empty($staff_twitter) && $staff_twitter != '')
					$output .= '<a href="'.$staff_twitter.'" title="Twitter" class="twitter icon"><i class="fa fa-twitter"></i></a>';
				if(!empty($staff_facebook) && $staff_facebook != '')
					$output .= '<a href="'.$staff_facebook.'" title="Facebook" class="facebook icon"><i class="fa fa-facebook"></i></a>';
				if(!empty($staff_google_plus) && $staff_google_plus != '')
					$output .= '<a href="'.$staff_google_plus.'" title="Google Plus" class="google-plus icon"><i class="fa fa-google-plus"></i></a>';
				if(!empty($staff_linkedin) && $staff_linkedin != '')
					$output .= '<a href="'.$staff_linkedin.'" title="Linkedin" class="linkedin icon"><i class="fa fa-linkedin"></i></a>';
				if(!empty($staff_youtube) && $staff_youtube != '')
					$output .= '<a href="'.$staff_youtube.'" title="Youtube" class="youtube icon"><i class="fa fa-youtube"></i></a>';
				if(!empty($staff_rss) && $staff_rss != '')
					$output .= '<a href="'.$staff_rss.'" title="RSS" class="rss icon"><i class="fa fa-rss"></i></a>';
				if(!empty($staff_pinterest) && $staff_pinterest != '')
					$output .= '<a href="'.$staff_pinterest.'" title="Pinterest" class="pinterest icon"><i class="fa fa-pinterest"></i></a>';
				if(!empty($staff_skype) && $staff_skype != '')
					$output .= '<a href="'.$staff_skype.'" title="Skype" class="skype icon"><i class="fa fa-skype"></i></a>';
				$output .= '</div>';			
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div></article>';
				$i++;
			endwhile;
			wp_reset_postdata();
			$output .=	'</div></div>';
		else:
			$output .= '<div class="no-result">'.esc_html__('No results found...', 'firezy').'</div>';
		endif;
		return $output;
	}
	add_shortcode("tmpmela_ourteam", "shortcode_ourteam");
	/***************** Custom Testimonial ****************/
	function shortcode_custom_testimonials($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'type' => '',
			'items_per_column' => 3,
			'number_of_posts' => 5,		
	   	        'image_width' => 50,
		        'image_height' => 50,
		        'excerpt_length' => 160
		), $atts));


		global $post;	
		$i = 1;
		$args = array(
			'posts_per_page' => $number_of_posts,
			'post_status' => 'publish',
			'post_type' => 'testimonial',
		);					
		$testimonial_array = get_posts($args);
		$testimonial_count = count($testimonial_array);
		$output = '';
		if($testimonial_count > 0 ):
			$output .= '<div class="custom-testimonial '.$type.'">';		
			if($type == "slider") { 
				$output .= '<div id="'.$items_per_column.'_testimonial_carousel" class="testimonial-carousel">';
			} elseif($type == "grid") {
				$output .= '<div id="testimonial_grid" class="testimonial-grid testimonial-cols-'.$items_per_column.'">';
			} 
			$i = 1;
			$temp2 = 0;
			foreach($testimonial_array as $post) : setup_postdata($post);	
				get_post_meta($post->ID, 'testimonial_position', TRUE) ? $testimonial_position = get_post_meta($post->ID, 'testimonial_position', TRUE) : $testimonial_position = '';
				get_post_meta($post->ID, 'testimonial_link', TRUE) ? $testimonial_link = get_post_meta($post->ID, 'testimonial_link', TRUE) : $testimonial_link = '';		
				$contents = strip_tags(tmpmela_strip_images($post->post_content));
				if($i % $items_per_column == 1)
					$class = " first-item";	
				elseif($i % $items_per_column == 0)
					$class = " last-item";
				else
					$class = "";
				$output .= '<div class="item'.$class.'">';					
				$output .= '<div class="product-block">';
				$output .= '<div class="custom-testimonial-inner">';											

				$output .= '<div class="testmonial-image">';
				if ( has_post_thumbnail() && ! post_password_required() ) :
					$post_thumbnail_id = get_post_thumbnail_id();
					$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
					$output .= '<img src="'.tmpmela_mr_image_resize($post_thumbnail_url, $image_width, $image_height, true, 'left', false).'" title="'.get_the_title().'" alt="'.get_the_title().'" />';
				else:
					$output .= '<i style="width:'.$image_width.';height:'.$image_height.';" class="fa fa-user"></i>';
				endif;
				$output .= '</div>';

				$output .= '<div class="testmonial-text">';			
				$output .= '<div class="testimonial-title"><a title="'.get_the_title().'" href="'.get_permalink().'" >'.get_the_title().'</a></div>';
				if(!empty($testimonial_position)):
					if(!empty($testimonial_link)):
						$output .= '<div class="testimonial-designation">'.$testimonial_position.'</div>';	
					else:
						$output .= '<div class="testimonial-email">'.$testimonial_position.'</div>';
					endif;
				endif;
				$output .= '</div>';
				
				$output .= '<div class="testimonial-wrapper">';
				$output .=  '<div class="testimonial-content">';
				$output .= '<div class="testimonial-top"><blockquote><q>'.tmpmela_excerpt_length_limit($excerpt_length).'</q></blockquote></div>';
				$output .= '<div class="read-more"><a title="'.get_the_title().'" href="'.get_permalink().'" >'.esc_html__('read more', 'firezy').'</a></div>';
				$output .= '</div></div>';

			$output .= '</div>';
				$output .= '</div>';
			
				$output .= '</div>';

				$i++;
			endforeach;
			$output .= '</div>';
			$output .= '</div>';
		else:
			$output .= '<div class="no-result">'.esc_html__('No results found...', 'firezy').'</div>';
		endif;
		wp_reset_query();
		return $output;
	}
	add_shortcode('tmpmela_custom_testimonials', 'shortcode_custom_testimonials');

	/***************** Toggle ****************/
	function shortcode_toggle($atts, $content = null) {
		extract(shortcode_atts(array(
			'style'	=> '1'	
		), $atts));

		$output = '';
		$output .= '<div class="toggle style'.$style.'">';
		$output .=	do_shortcode($content);
		$output .=	'</div>';
		return $output;
	}
	add_shortcode('tmpmela_toggle', 'shortcode_toggle');
	function shortcode_single_toggle($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title' => 'Click here to hide/show Div'
		), $atts));
		$output = '';
		$output .= '<div class="single_toggle toogle_div">';
		$output .= '<a class="tog" href="#"><div class="toggle-title"><span class="icon"></span>'.$title.'</div></a>';
		$output .= '<div class="tab_content">'.do_shortcode($content).'</div>';
		$output .=	'</div>';
		return $output;
	}
	add_shortcode('toggle', 'shortcode_single_toggle');

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tmpmela_toggle extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_toggle extends WPBakeryShortCode {
		}
	}

	/***************** Banner slider ****************/
	function shortcode_single_slide($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'title' => '',
		), $atts));
		$output = '';
		$output .= '<div class="banner-slider-container">';
		$output .= '<div class="slider-container-inner">';	
		$output .= '<div class="title">'.$title.'</div>';
		$output .= '<ul class="slides">';
		$output .=	do_shortcode($content);
		$output .= '</ul>';
		$output .= '</div></div>';
		return $output;
	}
	add_shortcode('slider', 'shortcode_single_slide');
	function shortcode_single_slider($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'image' => '',	
			'link' => '',
			'height' => '',
			'width' => '',							 
		), $atts));
		$output = ''; 
		$output .= '<li><div class="banner-image">';
		if(!empty($link)):
			$output .= '<a target="_Self" href="'.$link.'"><img src="'.$image.'" alt="'.get_the_title().'" height="'.$height.'" width="'.$width.'" class="vv" /></a>';
		else:
			$output .= '<img src="'.$image.'" alt="'.get_the_title().'" class="vv" />';
		endif;
		$output .= '</li></div">';
		return $output;
	}
	add_shortcode('slide', 'shortcode_single_slider');

//deactivate WordPress function
	remove_shortcode('gallery', 'gallery_shortcode');

//activate own function
	add_shortcode('gallery', 'msdva_gallery_shortcode');
	function msdva_gallery_shortcode($attr) {
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attr['ids'] ) ) {
// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}

// Allow plugins/themes to override the default gallery template.
		$output = apply_filters('post_gallery', '', $attr);
		if ( $output != '' )
			return $output;

// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract(shortcode_atts(array(
			'order' => 'ASC',
			'orderby' => 'menu_order ID',
			'id' => $post ? $post->ID : 0,
			'itemtag' => 'dl',
			'icontag' => 'dt',
			'captiontag' => 'dd',
			'divtag' => 'div',
			'columns' => 3,
			'size' => 'full',
			'include' => '',
			'exclude' => '',
'link' => 'file' // CHANGE #1
), $attr, 'gallery'));

		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($include) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= tmpmela_wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$icontag = tag_escape($icontag);
		$valid_tags = wp_kses_allowed_html( 'post' );
		if ( ! isset( $valid_tags[ $itemtag ] ) )
			$itemtag = 'dl';
		if ( ! isset( $valid_tags[ $captiontag ] ) )
			$captiontag = 'dd';
		if ( ! isset( $valid_tags[ $icontag ] ) )
			$icontag = 'dt';

		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';
		$selector = "gallery-{$instance}";

		$gallery_style = $gallery_div = '';
		if ( apply_filters( 'use_default_gallery_style', true ) )
			$gallery_style = "
		<style type='text/css'>
#{$selector} {
		margin: auto;
	}
#{$selector} .gallery-item {
	float: {$float};
	margin-top: 10px;
	text-align: center;
	width: {$itemwidth}%;
}
#{$selector} img {
border: 2px solid #cfcfcf;
}
#{$selector} .gallery-caption {
margin-left: 0;
}
/* see gallery_shortcode() in wp-includes/media.php */
</style>";
$size_class = sanitize_html_class( $size );
$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

$i = 0;
foreach ( $attachments as $id => $attachment ) {
	$image_url = $attachment->guid;
	$image_output = tmpmela_wp_get_attachment_link( $id, $size, true, false );
	$image_meta = wp_get_attachment_metadata( $id );

	$orientation = '';
	if ( isset( $image_meta['height'], $image_meta['width'] ) )
		$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
	$output .= "<{$itemtag} class='gallery-item'>";
	$output .= "
	<{$icontag} class='gallery-icon {$orientation}'>
	$image_output
	</{$icontag}>";
	$output .= "
	<{$captiontag} class='wp-caption-text gallery-caption'>
	<{$divtag} class='gallery-caption-inner'>";
	$output .= " <{$divtag} class='wp-caption-text gallery-title'>
	" . wptexturize($attachment->post_title) . "
	</{$divtag}>";
	
	if ( $captiontag && trim($attachment->post_excerpt) ) {		
		$output .= "<{$divtag} class='wp-caption-text gallery-excerpt'>";
		if($columns == 1):		
			$excerpt_length = 100;
		elseif($columns == 2):
			$excerpt_length = 300;
		elseif($columns == 3):
			$excerpt_length = 200;
		elseif($columns == 4):
			$excerpt_length = 50;
		elseif($columns == 5):
			$excerpt_length = 10;
		endif;
		$output .= substr($attachment->post_excerpt,0,$excerpt_length);		
		$output .= "</{$divtag}>";

		$output .= "<{$divtag} class='wp-caption-text gallery-zoom'>
		<a href=" . $image_url . " title='Click to view Full Image' class='icon mustang-gallery'><i class='fa fa-plus'></i></a>
		</{$divtag}>";

		$output .= "<{$divtag} class='wp-caption-text gallery-redirect'>
		<a href=" . get_attachment_link( $attachment->ID ) . " title='Click to view read more' class='icon readmore'><i class='fa fa-link'></i></a>
		</{$divtag}>"; 
	}else{
		$output .= "<{$divtag} class='wp-caption-text gallery-zoom no-text'>
		<a href=" . $image_url . " title='Click to view Full Image' class='icon mustang-gallery'><i class='fa fa-plus'></i></a>
		</{$divtag}>";		
		$output .= "<{$divtag} class='wp-caption-text gallery-redirect'>
		<a href=" . get_attachment_link( $attachment->ID ) . " title='Click to view read more' class='icon readmore'><i class='fa fa-link'></i></a>
		</{$divtag}>";
	}
	$output .= "</{$divtag}>";	
	$output .= "</{$captiontag}>";
	$output .= "</{$itemtag}>";
}

$output .= "
</div>\n";

return $output;
}


function tmpmela_wp_get_attachment_link( $id = 0, $size = 'thumbnail', $permalink = true, $icon = false, $text = false ) {
	$id = intval( $id );
	$_post = get_post( $id );
	if ( empty( $_post ) || ( 'attachment' != $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) )
		return __( 'Missing Attachment', 'firezy' );

	if ( $permalink )
// $url = get_attachment_link( $_post->ID ); // we want the "large" version!!
// FIX!! ask for large URL
		$image_attributes = wp_get_attachment_image_src( $_post->ID, 'large' );
	$url = $image_attributes[0];
// $url = wp_get_attachment_image( $_post->ID, 'large' );

	$post_title = esc_attr( $_post->post_title );

	if ( $text )
		$link_text = $text;
	elseif ( $size && 'none' != $size )
		$link_text = wp_get_attachment_image( $id, $size, $icon );
	else
		$link_text = '';

	if ( trim( $link_text ) == '' )
		$link_text = $_post->post_title; 
	return apply_filters( 'wp_get_attachment_link', "<a rel='gallery-nr'>$link_text</a>", $id, $size, $permalink, $icon, $text );
}

/******************* WooCommerce Small Prodcuts ******/
function shortcode_woo_small_products_container($atts, $content = null, $code) {
	global $logotype;
	extract(shortcode_atts(array(
		'type' => 'grid',
		'items_per_column' => 2,
	), $atts));
	$logotype = $type;
	
	$output = '';
	$output .= '<div id="woo-small-products" class="woo-content products_block">';
	
	if($type == "slider") { 
	} else {
		$output .= '<div id="woo_grid" class="woo-grid cols-'.$items_per_column.'">';
	}
	$output .=	do_shortcode($content).'</div></div>';
	return $output;
}
add_shortcode('woo_small_products', 'shortcode_woo_small_products_container');

/*************** Woo Category Slider **************/
function shortcode_woo_categories_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		'items_per_column' => '7',
		'height' => '130',
		'width' => '130',
		'display_category' => '',
		'hide_empty' => '1',
	), $atts));
	$category_ids_array = explode(",",'product_cat');	
	$output = '';
	$name='';
	$readmore='';
	$output .= '<div class="woo_categories_slider">';
	$output .= '<div id="'.$items_per_column.'_category_carousel" class="category-carousel">';
	$args = array(
		'parent'        => $display_category,
		'hide_empty'    => $hide_empty,
		'taxonomy'      => 'product_cat',
	);
	$categories = get_categories( $args );
	foreach($categories as $cat){	
		$category_ids = get_term( $cat, 'product_cat' );
		$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		if( empty ($thumbnail_id)):
			$image = get_template_directory_uri()."/images/megnor/category-placeholder.jpg";		
		else:
			$image = wp_get_attachment_url( $thumbnail_id );				
		endif;
		$src = tmpmela_mr_image_resize($image, $width, $height, true, 't', false);
		$output .= '<div class="cat-outer-block"><div class="cat-img-block"><a class="cat-img" href="'.get_category_link( $category_ids ).'" title="'.$cat->name.'"><img src="'.$src.'" title="'.$cat->name.'" alt="'.$cat->name.'" height="'.$height.'" width="'.$width.'"/></a>';
		$output .= '</div>';

		$output .= '<div class="cat_description"><a class="cat_name" href="'.get_category_link( $category_ids ).'"  title="'.$cat->name.'">'.$cat->name.'</a></div>';
		$output .= '</div>';
	}
	$output .= '</div></div>';
	return $output;
}
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
	add_shortcode("woo_categories_slider", "shortcode_woo_categories_slider");
endif;
/************* Static Text Newsletter *************/
function shortcode_tmpmela_newsletter($atts, $content = null){
	extract(shortcode_atts(array(	
		'title' => '',
	), $atts));
	
	$output = '';
	$output .= '<div class="tmpmela-newsletter-container">';
	if($title != '') :
		$output .= '<div class="tmpmela-newsletter-title">'.$title.'</div>';
	endif;
	$output .= '<div class="tmpmela-newsletter-form">'.do_shortcode($content).'</div>';
	$output .= '</div>';	
	return $output;
}
add_shortcode('tmpmela_newsletter', 'shortcode_tmpmela_newsletter');
?>