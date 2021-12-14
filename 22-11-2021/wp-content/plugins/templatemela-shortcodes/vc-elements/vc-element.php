<?php
/**
 * Visual Composer functions
 *
 * @author Templatemela
 * @link http://templatmela.com
 */

/* ---------------------------------------------------------------------------
 * Shortcodes | Image compatibility
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'tmpmela_vc_image' ) )
{
	function tmpmela_vc_image( $image = false ){
		if( $image && is_numeric( $image ) ){
			$image = wp_get_attachment_image_src( $image, 'full' );
			$image = $image[0];
		}
		return $image;
	}
}

/* ---------------------------------------------------------------------------
 * Shortcodes | blog
 * --------------------------------------------------------------------------- */

add_action ( 'vc_before_init', 'tmpmela_vc_integrateWithVC' );
if( ! function_exists( 'tmpmela_vc_integrateWithVC' ) )
{
	function tmpmela_vc_integrateWithVC() {

// Accordition	
	vc_map( array (
			'name' 			=> __('Accordion', 'tmpmela-opts'),
			'description' 	=> __('Collapsible content panels', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_accordion',
			"as_parent" => array('only' => 'accordion'),
    		"content_element" => true,
    		"show_settings_on_create" => true,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-accordion',
			'params' 		=> array (
				array (
					'param_name' 	=> 'style',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Style', 'tmpmela-opts'),
					'description' 	=> __('Select type of accordion style.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
					)),
				),
		)
	));	
 	vc_map( array (
			'base' 			=> 'accordion',
			'name' 			=> __('Accordation Content', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_accordion'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-accordion',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('Title ex.Welcome To Store', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));
	
// Blogs
	vc_map( array (
			'base' 			=> 'blog_posts',
			'name' 			=> __('Blogs', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-blog_slider',
			'description' 	=> __('Blogs in grid or slider', 'tmpmela-opts'),
			'params' 		=> array (
				array (
					'param_name' 	=> 'type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'grid'		=> __('Grid', 'tmpmela-opts'),	
						'slider'	=> __('Slider', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'admin_label'	=> true,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'number_of_posts',
					'type' 			=> 'textfield',
					'heading' 		=> __('Total Posts', 'tmpmela-opts'),
					'description' 	=> __('How many total number of items to display per page. (2,3,4 ..)', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'category',
					'type' 	 => 'textfield',
					'heading' 	 => __('Category', 'tmpmela-opts'),
					'description' 	=> __('Post Category ID', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Height', 'tmpmela-opts'),
					'description' 	=> __('Blog image height in pixcel (note:enter number without px, ex.50 )( default valiue is : 166 )', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Width', 'tmpmela-opts'),
					'description' 	=> __('Blog image width in pixcel (note:enter number without px, ex.50 ) ( default valiue is : 303 	)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));	
	
/**** Brand in grid or slider*****/		
	vc_map( array (
			'name' 			=> __('Brand Logos', 'tmpmela-opts'),
			'description' 	=> __('Brand in grid or slider', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_logo',
			"as_parent" => array('only' => 'tmpmela_logoinner'),
    		"content_element" => true,
    		"show_settings_on_create" => true,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-brand',
			'params' 		=> array (
				array (
					'param_name' 	=> 'type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'slider'		=> __('Slider', 'tmpmela-opts'),	
						'grid'		=> __('Grid', 'tmpmela-opts'),	
					)),
				),
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 	 => array_flip(array(
							'1'	 => __('1', 'tmpmela-opts'),
							'2'	 => __('2', 'tmpmela-opts'),	
							'3'	 => __('3', 'tmpmela-opts'),	
							'4'	 => __('4', 'tmpmela-opts'),	
							'5'	 => __('5', 'tmpmela-opts'),	
							'6'	 => __('6', 'tmpmela-opts'),	
					)),
				),
				),
	));	
	
	vc_map( array (
			'base' 			=> 'tmpmela_logoinner',
			'name' 			=> __('Logo Link', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_logo'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-multiple-link',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('Logo Image Title ex.Feature', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Link | Target', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 	=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
				array (
					'param_name' 	=> 'image',
					'type' 			=> 'attach_image',
					'description' 	=> __('Attach here Feature Image.', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));
	
// Button
	vc_map( array (
			'base' 			=> 'tmpmela_button',
			'name' 			=> __('Button', 'tmpmela-opts'),
			'description' 	=> __('Type of buttons with Icon', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-button',
			'params' 		=> array (
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textfield',
					'heading' 		=> __('Button Name', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'description' 	=> __('Defualt valuse is medium', 'tmpmela-opts'),
					'value' 		=> array_flip(array(
						'medium'	=> __('Medium', 'tmpmela-opts'),
						'small'		=> __('Small', 'tmpmela-opts'),
						'big'		=> __('Big', 'tmpmela-opts'),
						'mini'		=> __('Mini', 'tmpmela-opts'),
					)),
					
				),
				array (
					'param_name' 	=> 'icon',
					'type' 			=> 'textfield',
					'heading' 		=> __('Font Awesome Icon', 'tmpmela-opts'),
					'description' 	=> __('fa-arrows-alt', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'icon_align',
					'type' 			=> 'textfield',
					'heading' 		=> __('Icon Alignment', 'tmpmela-opts'),
					'description' 	=> __('Icon Alignment ex.left,right,center', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'background_color',
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Icon Background Color', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
					'description' 	=> __('ex. https://www.google.co.in/', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
		)
	));

// Category Tabs	
	vc_map( array (
				'base' 	 => 'woo_categories',
				'name' 	 => __('Categories Tabs', 'tmpmela-opts'),
				'description' 	=> __('Show Category Tab wise products in grid/slider', 'tmpmela-opts'),
				'category' 	 => __('Templatemela Builder', 'tmpmela-opts'),
				'icon' 	 => 'tmpmela-vc-icon-tabs',
				'params' 	 => array (
							array (
								'param_name' 	=> 'type',
								'type' 	     	=> 'dropdown',
								'heading' 	 	=> __('Type', 'tmpmela-opts'),
								'admin_label'	=> false,
								'value' 	 	=> array_flip(array(
										'slider' => __('Slider', 'tmpmela-opts'),	
										'grid'	 => __('Grid', 'tmpmela-opts'),	
								)),
							),
							array (
								'param_name' 	=> 'items_per_column',
								'type' 	 => 'dropdown',
								'heading' 	 => __('Items Per Column', 'tmpmela-opts'),
								'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
								'admin_label'	=> false,
								'value' 	 => array_flip(array(
								'2'	 => __('2', 'tmpmela-opts'),	
								'3'	 => __('3', 'tmpmela-opts'),	
								'4'	 => __('4', 'tmpmela-opts'),	
								'5'	=> __('5', 'tmpmela-opts'),
							)),
							),
							array (
								'param_name' 	=> 'items_per_page',
								'type' 	 => 'textfield',
								'heading' 	 => __('Items', 'tmpmela-opts'),
								'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
								'admin_label'	=> false,
							),
							array (
								'param_name' 	=> 'category_ids',
								'type' 	 => 'textfield',
								'heading' 	 => __('Category Id', 'tmpmela-opts'),
								'description' 	=> __('Enter ID of product category to display products(ex. 88,105,165)', 'tmpmela-opts'),
								'admin_label'	=> false,
							),
				)
		));

 // CMS Category Tabs
        $array="";
        vc_map( array (
            'base' 	 => 'cms_woo_categories',
            'name' 	 => __('Single Category Products', 'tmpmela-opts'),
            'description' 	=> __('Show image with Category products in grid/slider', 'tmpmela-opts'),
            'category' 	 => __('Templatemela Builder', 'tmpmela-opts'),
            'icon' 	 => 'tmpmela-vc-icon-tabs',
            'params' 	 => array (

                array (
                    'param_name' 	=> 'image',
                    'type' 			=> 'attach_image',
                    'description' 	=> __('Attach here Category Banner Image.', 'tmpmela-opts'),
                    'admin_label'	=> false,
                ),
                array (
                    'param_name' 	=> 'type',
                    'type' 	     	=> 'dropdown',
                    'heading' 	 	=> __('Type', 'tmpmela-opts'),
                    'admin_label'	=> false,
                    'value' 	 	=> array_flip(array(
                        'slider' => __('Slider', 'tmpmela-opts'),
                        'grid'	 => __('Grid', 'tmpmela-opts'),
                    )),
                ),
                array (
                    'param_name' 	=> 'items_per_column',
                    'type' 	 => 'dropdown',
                    'heading' 	 => __('Items Per Column', 'tmpmela-opts'),
                    'description' 	=> __('Select number of items to display per column.', 'tmpmela-opts'),
                    'admin_label'	=> false,
                    'value' 	 => array_flip(array(
                        '2'	 => __('2', 'tmpmela-opts'),
                        '3'	 => __('3', 'tmpmela-opts'),
                        '4'	 => __('4', 'tmpmela-opts'),
                        '5'	=> __('5', 'tmpmela-opts'),
                    )),
                ),
                array (
                    'param_name' 	=> 'items_per_page',
                    'type' 	 => 'textfield',
                    'heading' 	 => __('Items', 'tmpmela-opts'),
                    'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
                    'admin_label'	=> false,
                ),                
                array (
                    'param_name' 	=> 'category_ids',
                    'type' 	 => 'dropdown',
                    'heading' 	 => __('Category', 'tmpmela-opts'),
                    'description' 	=> __('Select product category to display products', 'tmpmela-opts'),
                    'admin_label'	=> false,
                    'value' 	 => tmpmela_product_get_categories($array),
                ),
                array (
                    'param_name' 	=> 'title_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Category Title Color', 'tmpmela-opts'),
                    'description' 	=> __('Select Title color', 'tmpmela-opts'),
                ),
                array (
                    'param_name' 	=> 'description_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Description Text Color', 'tmpmela-opts'),
                    'description' 	=> __('Select Description  color', 'tmpmela-opts'),
                ),
                array (
					'param_name' 	=> 'link_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link Text', 'tmpmela-opts'),
					'description' 	=> __('Enter link text', 'tmpmela-opts'),
				),
				
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
					'description' 	=> __('Give link url', 'tmpmela-opts'),
				),
				  array (
                    'param_name' 	=> 'linktext_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Link Text Color', 'tmpmela-opts'),
                ),
				array (
                    'param_name' 	=> 'button_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Link Text Background Color', 'tmpmela-opts'),
                    'description' 	=> __('Select button background color', 'tmpmela-opts'),
                ),
               
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 	=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					     )),
                ),
				array (
					'param_name' 	=> 'excerpt_length',
					'type' 			=> 'textfield',
					'heading' 		=> __('Limtation of Description', 'tmpmela-opts'),
					'description' 	=> __('Limtation of Category Description. ex.100', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				
            )
        ));


/**** CMS Image Banners *****/		
	vc_map( array (
			'base' 			=> 'tmpmela_cms_block',
			'name' 			=> __('CMS Banners Block', 'tmpmela-opts'),
			'description' 	=> __('CMS block with background Images', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-cms',
			'params' 		=> array (
				array (
					'param_name' 	=> 'image',
					'type' 			=> 'attach_image',
					'heading' 		=> __('Image', 'tmpmela-opts'),
					'description' 	=> __('Attach image for cms block from here', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				  array (
					'param_name' 	=> 'classname',
					'type' 			=> 'textfield',
					'heading' 		=> __('Classname', 'tmpmela-opts'),
					'description' 	=> __('Give classname for this block', 'tmpmela-opts'),
					'admin_label'	=> false,
				),

				array (
					'param_name' 	=> 'style',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Style Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'description' 	=> __('Select type of Hover effect.', 'tmpmela-opts'),
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
					)),
				),
				array (
                    'param_name' 	=> 'cms_text_align',
                    'type' 			=> 'dropdown',
                    'heading' 		=> __('Text Align', 'tmpmela-opts'),
                    'description' 	=> __('Define where to set align', 'tmpmela-opts'),
                    'admin_label'	=> false,
                    'value'			=> array_flip( array(
                        'cms-left-text'     => 'Left',
                        'cms-right-text' 	=> 'Right' ,
                        'cms-center-text' 	=> 'Center' ,
                    )),
                ),
                array (
					'param_name' 	=> 'link_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('link_text', 'tmpmela-opts'),
					'description' 	=> __('URL linkable text  ex.Shop Now', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				 array (
                    'param_name' 	=> 'linktext_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('LinkText Color', 'tmpmela-opts'),
                ),
			 
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
					'description' 	=> __('ex. https://www.google.co.in/', 'tmpmela-opts'),
				),
				array (
                    'param_name' 	=> 'button_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Button Background Color', 'tmpmela-opts'),
                ),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
				array (
					'param_name' 	=> 'text1',
					'type' 			=> 'textarea',
					'heading' 		=> __('Text1', 'tmpmela-opts'),
					'description' 	=> __('Text1  ex.Shopper Bag', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
			  array (
                    'param_name' 	=> 'text1_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Text1 Color', 'tmpmela-opts'),
                ),
				
				array (
					'param_name' 	=> 'text2',
					'type' 			=> 'textarea',
					'heading' 		=> __('Text2', 'tmpmela-opts'),
					'description' 	=> __('Text2  ex.The World Catelog Ideas', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				 array (
                    'param_name' 	=> 'text2_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Text2 Color', 'tmpmela-opts'),
                ),
				array (
					'param_name' 	=> 'text3',
					'type' 			=> 'textarea',
					'heading' 		=> __('Text3', 'tmpmela-opts'),
					'description' 	=> __('Text3  ex.The World Catelog Ideas', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				 array (
                    'param_name' 	=> 'text3_color',
                    'type' 	 => 'colorpicker',
                    'heading' 	 => __('Text3 Color', 'tmpmela-opts'),
                ),
				
			)
	));		
				
// Contact Address	
	vc_map( array (
			'base' 			=> 'tmpmela_address',
			'name' 			=> __('Contact Address', 'tmpmela-opts'),
			'description' 	=> __('Display contact details', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-contact_box',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'description',
					'type' 			=> 'textfield',
					'heading' 		=> __('Description', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'address_label',
					'type' 			=> 'textfield',
					'heading' 		=> __('Address Label', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Address', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'phone_label',
					'type' 			=> 'textfield',
					'heading' 		=> __('Phone Label', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'phone',
					'type' 			=> 'textfield',
					'heading' 		=> __('Phone Number', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'email_label',
					'type' 			=> 'textfield',
					'heading' 		=> __('Email Label', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'email',
					'type' 			=> 'textfield',
					'heading' 		=> __('Email', 'tmpmela-opts'),
					'description' 	=> __('Give Email Address Here ex. demo@example.com', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'email_link',
					'type' 			=> 'textfield',
					'heading' 		=> __('Email Link', 'tmpmela-opts'),
					'description' 	=> __('(ex. mailto:demo@example.com)', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'other_label',
					'type' 			=> 'textfield',
					'heading' 		=> __('Other Label', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'other',
					'type' 			=> 'textfield',
					'heading' 		=> __('Other', 'tmpmela-opts'),
					'description' 	=> __('ex,time of office', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
		)
	));
		
// FAQ
	vc_map( array (
			'base' 			=> 'faqs',
			'name' 			=> __('FAQ', 'tmpmela-opts'),
			'description' 	=> __('List of FAQs questions & answers', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-faq',
			'params' 		=> array (
				array (
					'param_name' 	=> 'style',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Style Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'description' 	=> __('Select type of FAQs style.', 'tmpmela-opts'),
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'category',
					'type' 			=> 'textfield',
					'heading' 		=> __('Category ID', 'tmpmela-opts'),
					'description' 	=> __('Enter Category ID of faq categories ex.92', 'tmpmela-opts'),
					'admin_label'	=> true,
				),	
		)
	));	
			
// Feature Content	
	vc_map( array (
			'base' 			=> 'tmpmela_about',
			'name' 			=> __('Feature Content', 'tmpmela-opts'),
			'description' 	=> __('Feature image with content', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-feature_box',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('Title ex.Feature', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'image',
					'type' 			=> 'attach_image',
					'description' 	=> __('Attach here Feature Image.', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'image_align',
					'type' 			=> 'textfield',
					'heading' 		=> __('Image Align', 'tmpmela-opts'),
					'description' 	=> __('Image Align ex.left,right,center', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
			    array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'link_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link Text', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
		)
	));


        /**** Home Page Service *****/
        vc_map( array (
            'base' 	 => 'tmpmela_service',
            'name' 	 => __('Home Page Service', 'tmpmela-opts'),
            'description' 	=> __('Style For Services with Images', 'tmpmela-opts'),
            'category' 	 => __('Templatemela Builder', 'tmpmela-opts'),
            'icon' 	 => 'tmpmela-vc-icon-services',
            'params' 	 => array (
                array (
                    'param_name' 	=> 'service_number',
                    'type' 	 => 'textfield',
                    'heading' 	 => __('Service Number', 'tmpmela-opts'),
                    'description' 	=> __('Identify Number for service. ex.1,2,3,..', 'tmpmela-opts'),
                    'admin_label'	=> false,
                ),
                array (
                    'param_name' 	=> 'service_title',
                    'type' 	 => 'textfield',
                    'heading' 	 => __('Service Title', 'tmpmela-opts'),
                    'description' 	=> __('Service Title ex. 24 x 7 free Support', 'tmpmela-opts'),
                    'admin_label'	=> false,
                ),
                array (
                    'param_name' 	=> 'service_other_text',
                    'type' 	 => 'textfield',
                    'heading' 	 => __('Other Text', 'tmpmela-opts'),
                    'description' 	=> __('Description  ex. Ready to help you with any questions related to our Global Trade', 'tmpmela-opts'),
                    'admin_label'	=> false,
                ),
                array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),

            )
        ));



/**** Hot Product *****/	
		vc_map( array (
				'base' 	 => 'home_products',
				'name' 	 => __('Hot Product', 'tmpmela-opts'),
				'description' 	=> __('promotional Product with counter', 'tmpmela-opts'),
				'category' 	 => __('Templatemela Builder', 'tmpmela-opts'),
				'icon' 	 => 'tm-vc-icon-woo_pro',
				'params' 	 => array (
				array (
				'param_name' 	=> 'height',
				'type' 	 => 'textfield',
				'heading' 	 => __('Main Image Height', 'tmpmela-opts'),
				'description' 	=> __('Main Image Height in pixel (note:enter number without px ex.368)', 'tmpmela-opts'),
				'admin_label'	=> false,
				),
				array (
				'param_name' 	=> 'width',
				'type' 	 => 'textfield',
				'heading' 	 => __('Main Image Width', 'tmpmela-opts'),
				'description' 	=> __('Main Image Width in pixel (note:enter number without px ex.280)', 'tmpmela-opts'),
				'admin_label'	=> false,
				),
				array (
				'param_name' 	=> 'number_of_items',
				'type' 	 => 'textfield',
				'heading' 	 => __('Total Product', 'tmpmela-opts'),
				'description' 	=> __('2,3,4..', 'tmpmela-opts'),
				'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'excerpt_length',
					'type' 			=> 'textfield',
					'heading' 		=> __('Limtation of Detail', 'tmpmela-opts'),
					'description' 	=> __('Limtation of Detail. ex.250', 'tmpmela-opts'),
					'admin_label'	=> false,
				),	
				)
	));




// Lists
	vc_map( array (
			'name' 			=> __('Lists', 'tmpmela-opts'),
			'description' 	=> __('Show list of content with icon', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_list',
			"as_parent" => array('only' => 'list_item'),
    		"content_element" => true,
    		"show_settings_on_create" => false,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-list',
	));	
	vc_map( array (
			'base' 			=> 'list_item',
			'name' 			=> __('List Item', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_list'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-portfolio_grid',
			'params' 		=> array (
				array (
					'param_name' 	=> 'icon',
					'type' 			=> 'textfield',
					'heading' 		=> __('Font Awesome Icon', 'tmpmela-opts'),
					'description' 	=> __('fa-arrows-alt', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'color',
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Icon Color', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
					'description' 	=> __('ex. https://www.google.co.in/', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
		)
	));
	
// Links
	vc_map( array (
			'name' 			=> __('Multiple Links', 'tmpmela-opts'),
			'description' 	=> __('Craete linkable text', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_links',
			"as_parent" => array('only' => 'link'),
    		"content_element" => true,
    		"show_settings_on_create" => false,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-multiple-link',
	));	
	vc_map( array (
			'base' 			=> 'link',
			'name' 			=> __('Link', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_links'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-portfolio_grid',
			'params' 		=> array (
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));

// Newsletter Text	
	vc_map( array (
			'base' 			=> 'tmpmela_newsletter',
			'name' 			=> __('Newsletter content', 'tmpmela-opts'),
			'description' 	=> __('Newsletter details', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-newslatter-text',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Text', 'tmpmela-opts'),
					'description' 	=> __('Newsletter Text. ex : SUBSCRIBE FOR OUR NEWSLETTER', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed. ex :  [newsletter]', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));		
		
// Portfolio Filter	
	vc_map( array (
			'base' 			=> 'tmpmela_portfolio_filter',
			'name' 			=> __('Portfolio Filter', 'tmpmela-opts'),
			'description' 	=> __('Responsive portfolio filter gallery', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-portfolio',
			'params' 		=> array (
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
						'5'		=> __('Five', 'tmpmela-opts'),			
					)),
				),
				array (
					'param_name' 	=> 'width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Portfilio Image Width', 'tmpmela-opts'),
					'description' 	=> __('Portfilio Image Width in pixcel (note:enter number without px ex.1000)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Portfilio Image Height', 'tmpmela-opts'),
					'description' 	=> __('Portfilio Image Height in pixcel (note:enter number without px ex.1000)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));	
	
// Portfolio Slider
	vc_map( array (
			'base' 			=> 'tmpmela_portfolio_slider',
			'name' 			=> __('Portfolio Slider', 'tmpmela-opts'),
			'description' 	=> __('Portfolio carousel slider', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-portfolio_slider',
			'params' 		=> array (
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'admin_label'	=> true,
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
						'5'		=> __('Five', 'tmpmela-opts'),
							
					)),					
				),
				array (
					'param_name' 	=> 'number_of_posts',
					'type' 			=> 'textfield',
					'heading' 		=> __('Total Posts', 'tmpmela-opts'),
					'description' 	=> __('Enter total number of posts to display. (2,3,4..)', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'category',
					'type' 			=> 'textfield',
					'heading' 		=> __('Category', 'tmpmela-opts'),
					'description' 	=> __('Portfolio Category ID', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Portfilio Image Width', 'tmpmela-opts'),
					'description' 	=> __('Portfilio Image Width in pixcel (note:enter number without px ex.1000)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Portfilio Image Height', 'tmpmela-opts'),
					'description' 	=> __('Portfilio Image Height in pixcel (note:enter number without px ex.1000)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'excerpt_length',
					'type' 			=> 'textfield',
					'heading' 		=> __('Limtation of Description', 'tmpmela-opts'),
					'description' 	=> __('Limtation of Portfilio Description. ex.100', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
			
		)
	));	
	
// Portfolios Grid	
	vc_map( array (
			'base' 			=> 'tmpmela_portfolio',
			'name' 			=> __('Portfolios Grid', 'tmpmela-opts'),
			'description' 	=> __('Responsive portfolio with column', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-portfolio_grid',
			'params' 		=> array (
				array (
					'param_name' 	=> 'column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
						'5'		=> __('Five', 'tmpmela-opts'),				
					)),
				),
				array (
					'param_name' 	=> 'max',
					'type' 			=> 'textfield',
					'heading' 		=> __('Total Posts', 'tmpmela-opts'),
					'description' 	=> __('Enter Maximum number of items to display per page. (2,3,4..)', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Portfilio Image Width', 'tmpmela-opts'),
					'description' 	=> __('Portfilio Image Width in pixcel (note:enter number without px ex.1000)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Portfilio Image Height', 'tmpmela-opts'),
					'description' 	=> __('Portfilio Image Height in pixcel (note:enter number without px ex.1000)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'excerpt_length',
					'type' 			=> 'textfield',
					'heading' 		=> __('Limtation of Description', 'tmpmela-opts'),
					'description' 	=> __('Limtation of Portfilio Description. ex.100', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));	

// Pricing Table
	vc_map( array (
			'base' 			=> 'tmpmela_pricingtable',
			'name' 			=> __('Pricing Table', 'tmpmela-opts'),
			'description' 	=> __('responsive pricing table content', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-pricing_item',
			'params' 		=> array (	
				array (
					'param_name' 	=> 'heading',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'selected',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Featured', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'no'		=> __('No', 'tmpmela-opts'),
						'yes'		=> __('Yes', 'tmpmela-opts')
					)),
				),
				array (
					'param_name' 	=> 'button_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Button Text', 'tmpmela-opts'),
					'description' 	=> __('Read More', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'button_link',
					'type' 			=> 'textfield',
					'heading' 		=> __('Button Link', 'tmpmela-opts'),
					'description' 	=> __('Link will appear only if this field will be filled.', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
				array (
					'param_name' 	=> 'price',
					'type' 			=> 'textfield',
					'heading' 		=> __('Price', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'price_per',
					'type' 			=> 'textfield',
					'heading' 		=> __('Price for period', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> '<ul><li><strong>List</strong> item</li></ul>',
				),
			)
	));	
	
// Products 	
	vc_map( array (
			'base' 			=> 'woo_products',
			'name' 			=> __('Products', 'tmpmela-opts'),
			'description'   => __('Show products in grid or slider', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-woo_pro',
			'params' 		=> array (
				array (
					'param_name' 	=> 'type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'slider'	=> __('Slider', 'tmpmela-opts'),	
						'grid'		=> __('Grid', 'tmpmela-opts'),	
					)),
				),
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
						'5'		=> __('Five', 'tmpmela-opts'),	
									
					)),
				),
				array (
					'param_name' 	=> 'classname',
					'type' 			=> 'textfield',
					'heading' 		=> __('classname', 'tmpmela-opts'),
					'description' 	=> __('classname', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'no_more',
					'type' 			=> 'textfield',
					'heading' 		=> __('No more Products ( use if Product type is "grid")', 'tmpmela-opts'),
					'description' 	=> __('no more product description', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
		)
	));


	
// Products Tabs	
	vc_map( array (
			'name' 			=> __('Product Tabs', 'tmpmela-opts'),
			'description' 	=> __('Woo products tabs', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_product_tabs',
			"as_parent" => array('only' => 'tmpmela_tab_home'),
    		"content_element" => true,
    		"show_settings_on_create" => true,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-tabs',
			'params' 		=> array (
				array (
					'param_name' 	=> 'tab1_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Tab1 Title', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'tab2_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Tab2 Title', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'tab3_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Tab3 Title', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'tab4_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Tab4 Title', 'tmpmela-opts'),
				),
		)
	));	
	vc_map( array (
			'base' 			=> 'tmpmela_tab_home',
			'name' 			=> __('Product Tab Container', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_product_tabs'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-woo_pro',
			'params' 		=> array (
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));
	
// Services	
	vc_map( array (
			'base' 			=> 'service',
			'name' 			=> __('Service', 'tmpmela-opts'),
			'description' 	=> __('Service with different icon & styles', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-services',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('Service Title', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'style',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'icon',
					'type' 			=> 'textfield',
					'heading' 		=> __('Font Awesome Icon', 'tmpmela-opts'),
					'description' 	=> __('ex. fa-arrows-alt', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'color',
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Icon Color', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'icon_background_color',
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Icon Background Color', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'link_text',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link Text', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'link_url',
					'type' 			=> 'textfield',
					'heading' 		=> __('Link URL', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'target',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Button | Target', 'tmpmela-opts'),
					'description' 	=> __('Define where to open the linked document', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value'			=> array_flip( array(
						'_self' 			=> 'Default | _self',
						'_blank' 	=> 'New Tab or Window | _blank' ,
					)),
				),
		)
	));	

// Static Text	
	vc_map( array (
			'base' 			=> 'text',
			'name' 			=> __('Static Text', 'tmpmela-opts'),
			'description' 	=> __('Arbitary text with HTML', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-static-text',
			'params' 		=> array (
				array (
					'param_name' 	=> 'align',
					'type' 			=> 'textfield',
					'heading' 		=> __('Text Align', 'tmpmela-opts'),
					'description' 	=> __('Text-Alignment ex.left,right,center', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Text Detail', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));	

// Tabs ( Horizontal + Vertical )	
	vc_map( array (
			'name' 			=> __('Tabs', 'tmpmela-opts'),
			'description' 	=> __('Horizontal and Vertical tabs with diiferent styles ', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_tabs',
			"as_parent" => array('only' => 'tmpmela_tab'),
    		"content_element" => true,
    		"show_settings_on_create" => true,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-tabs',
			'params' 		=> array (
				array (
					'param_name' 	=> 'style',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Style Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'description' 	=> __('Select type of Tabs style.', 'tmpmela-opts'),
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'tab_type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Tab Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'horizontal'		=> __('Horizontal', 'tmpmela-opts'),
						'vertical'		=> __('Vertical', 'tmpmela-opts'),
					)),
				),
		)
	));	
	vc_map( array (
			'base' 			=> 'tmpmela_tab',
			'name' 			=> __('Tab', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_tabs'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-tabs',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('Title ex.Welcome To Store', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));
		
// Title
	vc_map( array (
			'base' 			=> 'title',
			'name' 			=> __('Title', 'tmpmela-opts'),
			'description' 	=> __('Identify name of content or block', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-fancy_heading',
			'params' 		=> array (
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'subtitle',
					'type' 			=> 'textfield',
					'heading' 		=> __('Subtitle', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'size',
					'type' 			=> 'textfield',
					'heading' 		=> __('Text Size', 'tmpmela-opts'),
					'description' 	=> __('ex. small,normal,big (default value is normal )', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'align',
					'type' 			=> 'textfield',
					'heading' 		=> __('Text Align', 'tmpmela-opts'),
					'description' 	=> __('ex.left,right,center  (default value is center )', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'color',
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Text Color', 'tmpmela-opts'),
				),
				array (
					'param_name' 	=> 'classname',
					'type' 			=> 'textfield',
					'heading' 		=> __('Classname', 'tmpmela-opts'),
					'description' 	=> __('extra classname', 'tmpmela-opts'),
					'admin_label'	=> false,
				),				
		)
	));	

// Team	
	vc_map( array (
			'base' 			=> 'tmpmela_ourteam',
			'name' 			=> __('Our Team', 'tmpmela-opts'),
			'description' 	=> __('Team members in grid or slider', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-team',
			'params' 		=> array (
				array (
					'param_name' 	=> 'type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'grid'		=> __('Grid', 'tmpmela-opts'),
						'slider'	=> __('Slider', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
						'5'		=> __('Five', 'tmpmela-opts'),		
					)),
				),
				array (
					'param_name' 	=> 'number_of_posts',
					'type' 			=> 'textfield',
					'heading' 		=> __('Total Posts', 'tmpmela-opts'),
					'description' 	=> __('How many total number of items to display. (2,3,4..)', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
					array (
					'param_name' 	=> 'image_width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Image width', 'tmpmela-opts'),
					'description' 	=> __('Image width in px, default value is 600px', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'image_height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Image Height', 'tmpmela-opts'),
					'description' 	=> __('Image height in px, default value is 600px', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
		)
	));	
	
// Testimonials	
	vc_map( array (
			'base' 			=> 'tmpmela_custom_testimonials',
			'name' 			=> __('Testimonials', 'tmpmela-opts'),
			'description' 	=> __('Custom testimonials in grid or slider', 'tmpmela-opts'),
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-testimonials',
			'params' 		=> array (
				array (
					'param_name' 	=> 'type',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Type', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'grid'		=> __('Grid', 'tmpmela-opts'),
						'slider'		=> __('Slider', 'tmpmela-opts'),	
					)),
				),
				array (
					'param_name' 	=> 'items_per_column',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items Per Column', 'tmpmela-opts'),
					'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
						'5'		=> __('Five', 'tmpmela-opts'),				
					)),
				),
				array (
					'param_name' 	=> 'number_of_posts',
					'type' 			=> 'textfield',
					'heading' 		=> __('Total Testimonials', 'tmpmela-opts'),
					'description' 	=> __('How many total number of items to display. (1,2,3,4..)', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'image_width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Image width', 'tmpmela-opts'),
					'description' 	=> __('Testimonial image width in px, default value is 50px', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'image_height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Image Height', 'tmpmela-opts'),
					'description' 	=> __('Testimonial image height in px, default value is 50px', 'tmpmela-opts'),
					'admin_label'	=> true,
				),
				array (
					'param_name' 	=> 'excerpt_length',
					'type' 			=> 'textfield',
					'heading' 		=> __('Limtation of Detail', 'tmpmela-opts'),
					'description' 	=> __('Limtation of Detail. ex.250', 'tmpmela-opts'),
					'admin_label'	=> false,
				),	
		)
	));	

// Toggle	
	vc_map( array (
			'name' 			=> __('Toggle', 'tmpmela-opts'),
			'base' 			=> 'tmpmela_toggle',
			"as_parent" => array('only' => 'toggle'),
    		"content_element" => true,
			'description' 	=> __('Toggle element block', 'tmpmela-opts'),
    		"show_settings_on_create" => true,
			 "js_view" => 'VcColumnView',
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-toggle',
			'params' 		=> array (
				array (
					'param_name' 	=> 'style',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Style', 'tmpmela-opts'),
					'admin_label'	=> false,
					'value' 		=> array_flip(array(
						'1'		=> __('One', 'tmpmela-opts'),
						'2'		=> __('Two', 'tmpmela-opts'),
						'3'		=> __('Three', 'tmpmela-opts'),
						'4'		=> __('Four', 'tmpmela-opts'),
					)),
				),
		)
	));	
	vc_map( array (
			'base' 			=> 'toggle',
			'name' 			=> __('Toggle Content', 'tmpmela-opts'),
			"content_element" => true,
		    "as_child" => array('only' => 'tmpmela_toggle'),
			"show_settings_on_create" => true,	
			'category' 		=> __('Templatemela Builder', 'tmpmela-opts'),
			'icon' 			=> 'tmpmela-vc-icon-toggle',
			'params' 		=> array (
				array (
					'param_name' 	=> 'title',
					'type' 			=> 'textfield',
					'heading' 		=> __('Title', 'tmpmela-opts'),
					'description' 	=> __('Title ex.Welcome To Store', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				array (
					'param_name' 	=> 'content',
					'type' 			=> 'textarea',
					'heading' 		=> __('Content', 'tmpmela-opts'),
					'description' 	=> __('HTML tags allowed', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
		)
	));
/**** woo category *****/	
		vc_map( array (
				'base' 	 => 'woo_categories_slider',
				'name' 	 => __('Woo Categories Slider', 'tmpmela-opts'),
				'description' 	=> __('Show All Categories slider', 'tmpmela-opts'),
				'category' 	 => __('Templatemela Builder', 'tmpmela-opts'),
				'icon' 	 => 'tmpmela-vc-icon-tabs',
				'params' 	 => array (
			    array (
						'param_name' 	=> 'items_per_column',
						'type' 	 => 'dropdown',
						'heading' 	 => __('Items Per Column', 'tmpmela-opts'),
						'description' 	=> __('Enter number of items to display per column.', 'tmpmela-opts'),
						'admin_label'	=> false,
						'value' 	 => array_flip(array(
						'2'	 => __('2', 'tmpmela-opts'),	
						'3'	 => __('3', 'tmpmela-opts'),	
						'4'	 => __('4', 'tmpmela-opts'),	
						'5'	=> __('5', 'tmpmela-opts'),
						'6'	=> __('6', 'tmpmela-opts'),
						'7'	=> __('7', 'tmpmela-opts'),
							)),
				),		
				array (
					'param_name' 	=> 'display_category',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Category Display', 'tmpmela-opts'),
					'admin_label'	=> false,
					'description' 	=> __('Default category display.', 'tmpmela-opts'),
					'value' 		=> array_flip(array(
						'0'		=> __('Parent', 'tmpmela-opts'),
						''		=> __('ParentCategory + SubCategory', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'hide_empty',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Hide Empty Category', 'tmpmela-opts'),
					'admin_label'	=> false,
					'description' 	=> __('select option for hide/display empty category', 'tmpmela-opts'),
					'value' 		=> array_flip(array(
						'1'		=> __('Yes', 'tmpmela-opts'),
						'0'		=> __('No', 'tmpmela-opts'),
					)),
				),
				array (
					'param_name' 	=> 'height',
					'type' 			=> 'textfield',
					'heading' 		=> __('Category Image Height', 'tmpmela-opts'),
					'description' 	=> __('Category Image Height in pixcel (note:enter number without px ex.130)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
					array (
					'param_name' 	=> 'width',
					'type' 			=> 'textfield',
					'heading' 		=> __('Category Image Width', 'tmpmela-opts'),
					'description' 	=> __('Category Image Width in pixcel (note:enter number without px ex.130)', 'tmpmela-opts'),
					'admin_label'	=> false,
				),
				)
		));
 }
}
?>