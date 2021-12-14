<?php
/***********************************************************/
// Common options
/***********************************************************/
$prefix = 'tmpmela_content_';
$TM_META_BOXES[] = array(
	'id'		=> 'tmpmela_content_area',
	'title' 	=> esc_html__('TM - Content Options:', 'firezy'),
	'pages' 	=> array( 'page' ),	
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		// Show sidebar position on post page
		array(
			'name'    		=> esc_html__('Content Position:', 'firezy'),
			'id'      		=> "{$prefix}position",
			'type'    		=> 'radio',
			'std'			=> 'above',
			'options'		=> array(
				'none'		=> 'None',
				'above'		=> 'Above',
				'below'		=> 'Below',
			),
			'top_divider'	=> true
		),
	),
);
$prefix = 'tmpmela_page_';
$TM_META_BOXES[] = array(
	'id'		=> 'tmpmela_page_width_layout',
	'title' 	=> esc_html__('TM - Page Layout:', 'firezy'),
	'pages' 	=> array( 'page' ),	
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		// Show sidebar position on post page
		array(
			'name'    		=> esc_html__('Page Layout:', 'firezy'),
			'id'      		=> "{$prefix}layout",
			'type'    		=> 'radio',
			'std'			=> 'box',
			'options'		=> array(
				'box'		=> 'Box',
				'wide'		=> 'Wide',
			),
			'top_divider'	=> true
		),
	),
);
$prefix = 'tmpmela_sidebar_';
$TM_META_BOXES[] = array(
	'id'		=> 'tmpmela_posts_other_side',
	'title' 	=> esc_html__('TM - Sidebar Options:', 'firezy'),
	'pages' 	=> array( 'page' ),	
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		// Show sidebar position on post page
		array(
			'name'    		=> esc_html__('Sidebar Position:', 'firezy'),
			'id'      		=> "{$prefix}position",
			'type'    		=> 'radio',
			'std'			=> 'left',
			'options'		=> array(
				'right'		=> 'Right',
				'left'		=> 'Left',
				'disabled'	=> 'Disabled',
			),
			'top_divider'	=> true
		),
	),
);
?>