<?php 
/*
  Plugin Name: Templatemela Custom Post
  Description: Templatemela Custom Taxonomy(Portfolio, Staff, FAQs, Testimonials) for templatemela wordpress themes.
  Version: 1.0
  Author: Templatemela
  Text Domain: templatemela-custom-post
 */
 
// Templatemela FAQS 
 
function faq_theme_custom_posts(){
	
	$labels = array(
	  'name' => _x('FAQs', 'faq','tm'),
	  'singular_name' => _x('FAQ', 'faq','tm'),
	  'add_new' => _x('Add New', 'faq','tm'),
	  'add_new_item' => __('Add New FAQ','tm'),
	  'edit_item' => __('Edit FAQ','tm'),
	  'new_item' => __('New FAQ','tm'),
	  'view_item' => __('View FAQ','tm'),
	  'search_items' => __('Search FAQ','tm'),
	  'not_found' =>  __('No FAQ found','tm'),
	  'not_found_in_trash' => __('No FAQ found in Trash','tm'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'menu_icon' => 'dashicons-editor-help',
	  'rewrite' => array('slug'=>'faq','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('faq',$args);	
	
	// FAQ Categories
	$labels = array(
	  'name' => __( 'FAQ Categories', 'taxonomy general name' ,'tm'),
	  'singular_name' => __( 'FAQ Category', 'taxonomy singular name','tm' ),
	  'search_items' =>  __( 'Search FAQ Category' ,'tm'),
	  'all_items' => __( 'All FAQ Categories' ,'tm'),
	  'parent_item' => __( 'Parent FAQ Category' ,'tm'),
	  'parent_item_colon' => __( 'Parent FAQ Category:' ,'tm'),
	  'edit_item' => __( 'Edit FAQ Category','tm' ), 
	  'update_item' => __( 'Update FAQ Category' ,'tm'),
	  'add_new_item' => __( 'Add New FAQ Category','tm' ),
	  'new_item_name' => __( 'New Genre FAQ Category','tm' ),
	); 	
	
	register_taxonomy('faq_categories',array('faq'), array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'query_var' => true,
	  '_builtin' => false,
	  'paged'=>true,
	  'rewrite' => false,
	));
	
}
add_filter('init', 'faq_theme_custom_posts' );

// Templatemela Portfolio

function portfolio_theme_custom_posts(){
	//Portfolio
	$labels = array(
	  'name' =>
__('Portfolios', 'Portfolio','tm'),
	  'singular_name' => __('Portfolio', 'Portfolio','tm'),
	  'add_new' => __('Add New', 'Portfolio item','tm'),
	  'add_new_item' => __('Add New Portfolio item','tm'),
	  'edit_item' => __('Edit Portfolio Item','tm'),
	  'new_item' => __('New Portfolio Item','tm'),
	  'view_item' => __('View Portfolio Item','tm'),
	  'search_items' => __('Search Portfolio Item','tm'),
	  'not_found' =>  __('No Portfolio item found','tm'),
	  'not_found_in_trash' => __('No Portfolio item found in Trash','tm'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'menu_icon' => 'dashicons-images-alt2',
	  'rewrite' => array('slug'=>'portfolio','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('portfolio',$args);
	
// Portfolio Categories
	$labels = array(
	  'name' => __( 'Portfolio Categories', 'taxonomy general name' ,'tm'),
	  'singular_name' => __( 'Portfolio Category', 'taxonomy singular name','tm' ),
	  'search_items' =>  __( 'Search Portfolio Category' ,'tm'),
	  'all_items' => __( 'All Portfolio Categories' ,'tm'),
	  'parent_item' => __( 'Parent Portfolio Category' ,'tm'),
	  'parent_item_colon' => __( 'Parent Portfolio Category:' ,'tm'),
	  'edit_item' => __( 'Edit Portfolio Category','tm' ), 
	  'update_item' => __( 'Update Portfolio Category' ,'tm'),
	  'add_new_item' => __( 'Add New Portfolio Category','tm' ),
	  'new_item_name' => __( 'New Genre Portfolio Category','tm' ),
	); 	
	
	register_taxonomy('portfolio_categories',array('portfolio'), array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'query_var' => true,
	  '_builtin' => false,
	  'paged'=>true,
	  'rewrite' => false,
	));
}
add_filter('init', 'portfolio_theme_custom_posts' );

// Templatemela Staff

function tmpmela_custom_post_staff(){
		$labels = array(
			'name' => _x( 'Staff', 'post type general name', 'tm' ),
			'singular_name' => _x( 'Staff', 'post type singular name', 'tm' ),
			'add_new' => _x( 'Add Staff', '', 'tm' ),
			'add_new_item' => __( 'Add Staff ', 'tm' ),
			'edit_item' => __( 'Edit Staff', 'tm' ),
			'new_item' => __( 'New Staff', 'tm' ),
			'view_item' => __( 'View Staff', 'tm' ),
			'search_items' => __( 'Search Staff', 'tm' ),
			'not_found' =>  __( 'No Staff found', 'tm' ),
			'not_found_in_trash' => __( 'No Staff found in Trash', 'tm' ), 
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null, 
			'menu_icon' => 'dashicons-groups',
			'taxonomies' => array( '' ), 
			'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail', 'excerpt')
		);
		
		register_post_type( 'staff', $args );	
}
add_filter( 'init', 'tmpmela_custom_post_staff' );
add_action( 'add_meta_boxes', 'staff_add_custom_fields' );
add_action( 'save_post', 'staff_save_custom_fields' );
function staff_add_custom_fields() {
    add_meta_box( 
        'staff_options',
        'Staff Details',
        'staff_inner_custom_field',
        'staff' 
    );
}
function staff_inner_custom_field( $post ) {
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), '_templatemela' );	
	get_post_meta($post->ID, 'staff_position', TRUE) ? $staff_position = get_post_meta($post->ID, 'staff_position', TRUE) : $staff_position = '';
	get_post_meta($post->ID, 'staff_link', TRUE) ? $staff_link = get_post_meta($post->ID, 'staff_link', TRUE) : $staff_link = '';
	get_post_meta($post->ID, 'staff_email', TRUE) ? $staff_email = get_post_meta($post->ID, 'staff_email', TRUE) : $staff_email = '';
	get_post_meta($post->ID, 'staff_twitter', TRUE) ? $staff_twitter = get_post_meta($post->ID, 'staff_twitter', TRUE) : $staff_twitter = '';
	get_post_meta($post->ID, 'staff_facebook', TRUE) ? $staff_facebook = get_post_meta($post->ID, 'staff_facebook', TRUE) : $staff_facebook = '';
	get_post_meta($post->ID, 'staff_google_plus', TRUE) ? $staff_google_plus = get_post_meta($post->ID, 'staff_google_plus', TRUE) : $staff_google_plus = '';
	get_post_meta($post->ID, 'staff_linkedin', TRUE) ? $staff_linkedin = get_post_meta($post->ID, 'staff_linkedin', TRUE) : $staff_linkedin = '';
	get_post_meta($post->ID, 'staff_youtube', TRUE) ? $staff_youtube = get_post_meta($post->ID, 'staff_youtube', TRUE) : $staff_youtube = '';
	get_post_meta($post->ID, 'staff_rss', TRUE) ? $staff_rss = get_post_meta($post->ID, 'staff_rss', TRUE) : $staff_rss = '';
	get_post_meta($post->ID, 'staff_pinterest', TRUE) ? $staff_pinterest = get_post_meta($post->ID, 'staff_pinterest', TRUE) : $staff_pinterest = '';
	get_post_meta($post->ID, 'staff_skype', TRUE) ? $staff_skype = get_post_meta($post->ID, 'staff_skype', TRUE) : $staff_skype = '';	
?>
<table class="form-table">
	<tbody>
	<tr valign="top">
		<th><label for="staff_position">Position:</label></th>
		<td><input type="text" id="staff_position" name="staff_position" value="<?php echo esc_attr($staff_position); ?>" class="regular-text"/><br/>
		<span class="description">Enter the person's position or title (e.g. CEO, Manager etc.)</span> </td>
	</tr>
	<tr valign="top">
		<th><label for="staff_link">Personal blog / website:</label></th>
		<td><input type="text" id="staff_link" name="staff_link" value="<?php echo esc_attr($staff_link); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_email">Email:</label></th>
		<td><input type="text" id="staff_email" name="staff_email" value="<?php echo esc_attr($staff_email); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_twitter">Twitter:</label></th>
		<td><input type="text" id="staff_twitter" name="staff_twitter" value="<?php echo esc_attr($staff_twitter); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_facebook">Facebook:</label></th>
		<td><input type="text" id="staff_facebook" name="staff_facebook" value="<?php echo esc_attr($staff_facebook); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_google_plus">Google Plus:</label></th>
		<td><input type="text" id="staff_google_plus" name="staff_google_plus" value="<?php echo esc_attr($staff_google_plus); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_linkedin">Linkedin:</label></th>
		<td><input type="text" id="staff_linkedin" name="staff_linkedin" value="<?php echo esc_attr($staff_linkedin); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_youtube">Youtube:</label></th>
		<td><input type="text" id="staff_youtube" name="staff_youtube" value="<?php echo esc_attr($staff_youtube); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_rss">RSS:</label></th>
		<td><input type="text" id="staff_rss" name="staff_rss" value="<?php echo esc_attr($staff_rss); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_pinterest">Pinterest:</label></th>
		<td><input type="text" id="staff_pinterest" name="staff_pinterest" value="<?php echo esc_attr($staff_pinterest); ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_skype">Skype:</label></th>
		<td><input type="text" id="staff_skype" name="staff_skype" value="<?php echo esc_attr($staff_skype); ?>" class="regular-text" /></td>
	</tr>	
	</tbody>
</table>
<?php }
function staff_save_custom_fields( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  $mydata = array();
  foreach($_POST as $key => $data) {
    if($key == '_templatemela')
      continue;
	  
    if(preg_match('/^staff/i', $key)) {
      $mydata[$key] = $data;
	  update_post_meta($post_id, $key, $data);
    }
  }  
  return $mydata;
  
}


// Templatemela Testimonials

function testimonial_theme_custom_posts(){
	//testimonial
	$labels = array(
	  'name' => _x('Testimonials', 'Testimonial','tm'),
	  'singular_name' => _x('Testimonial', 'testimonial','tm'),
	  'add_new' => _x('Add New', 'Testimonial','tm'),
	  'add_new_item' => __('Add New Testimonial','tm'),
	  'edit_item' => __('Edit Testimonial','tm'),
	  'new_item' => __('New Testimonial','tm'),
	  'view_item' => __('View Testimonial','tm'),
	  'search_items' => __('Search Testimonial','tm'),
	  'not_found' =>  __('No Testimonial found','tm'),
	  'not_found_in_trash' => __('No Testimonial found in Trash','tm'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'menu_icon' => 'dashicons-format-chat',	 
	  'rewrite' => array('slug'=>'testimonial','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('testimonial',$args);	
}
add_filter('init', 'testimonial_theme_custom_posts' );
add_action( 'admin_init', 'remove_metabox_option' );
function remove_metabox_option() {
   	remove_meta_box( 'commentsdiv', 'testimonial', 'normal' );
	remove_meta_box( 'authordiv', 'testimonial', 'normal' );
	remove_meta_box( 'commentstatusdiv', 'testimonial', 'normal' );
}
add_action( 'add_meta_boxes', 'testimonial_add_custom_fields' );
add_action( 'save_post', 'testimonial_save_custom_fields' );
function testimonial_add_custom_fields() {
    add_meta_box( 
        'testimonial_options',
        'Testimonial Information',
        'testimonial_inner_custom_field',
        'testimonial' 
    );
}
function testimonial_inner_custom_field( $post ) {
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), '_templatemela' );	
	get_post_meta($post->ID, 'testimonial_position', TRUE) ? $testimonial_position = get_post_meta($post->ID, 'testimonial_position', TRUE) : $testimonial_position = '';
	get_post_meta($post->ID, 'testimonial_link', TRUE) ? $testimonial_link = get_post_meta($post->ID, 'testimonial_link', TRUE) : $testimonial_link = '';
?>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th><label for="testimonial_position">
        <?php _e('Designation:', 'tm'); ?>
        </label></th>
      <td><input type="text" id="testimonial_position" name="testimonial_position" value="<?php echo esc_attr($testimonial_position); ?>" class="regular-text"/></td>
    </tr>
    <tr valign="top">
      <th><label for="testimonial_link">
        <?php _e('Link:', 'tm'); ?>
        </label></th>
      <td><input type="text" id="testimonial_link" name="testimonial_link" value="<?php echo esc_attr($testimonial_link); ?>" class="regular-text" /></td>
    </tr>
  </tbody>
</table>
<?php }
function testimonial_save_custom_fields( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  $mydata = array();
  foreach($_POST as $key => $data) {
    if($key == '_templatemela')
      continue;
	  
    if(preg_match('/^testimonial/i', $key)) {
      $mydata[$key] = $data;
	  update_post_meta($post_id, $key, $data);
    }
  }
 
  return $mydata;  
} 
?>