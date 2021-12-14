<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?><?php  // Reference:  http://codex.wordpress.org/Widgets_API
class CMSBlockWidget extends WP_Widget
{
    function __construct(){
			$widget_settings = array('description' => 'CMS Block Widget', 'classname' => 'widgets-cms');
		parent::__construct(false,$name='CMS Block',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$service_title = empty($instance['service_title']) ? '' : $instance['service_title']; 
		$window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
                $cms_class = empty($instance['cms_class']) ? '' : $instance['cms_class'];
		$text1 = empty($instance['text1']) ? '' : $instance['text1']; 
		$text2 = empty($instance['text2']) ? '' : $instance['text2'];
		$cms_class = empty($instance['cms_class']) ? '' : $instance['cms_class'];
		echo wp_kses_post($before_widget);		
	 ?>
	
	<div class="service-content <?php echo esc_attr($cms_class); ?>">
		<div class="content"> 
			<?php if($text1) : ?><div class="service-title"><?php echo esc_attr($service_title); ?> </div><?php endif; ?>
			<?php if($text1) : ?><div class="text1"><?php echo esc_attr($text1); ?></div><?php endif; ?>
			<?php if($text2) : ?><div class="text2"><?php echo esc_attr($text2); ?></div><?php endif; ?>
		</div>
	</div>
	
		<?php
		echo wp_kses_post($after_widget);	
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['service_title'] = strip_tags($new_instance['service_title']);
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
                $instance['text1'] = strip_tags($new_instance['text1']);
		$instance['text2'] = strip_tags($new_instance['text2']);
        $instance['cms_class'] = strip_tags($new_instance['cms_class']);
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		   'service_title'=>'SAVE', 
	       'cms_class' => 'sidebar-banner',
		   'text1'=>'Save up to', 
		   'text2'=>'35% OFF',	  
		   'linkURL'=>'#'
		) );
	
		$service_title = esc_attr($instance['service_title']);
 	    $cms_class = esc_attr($instance['cms_class']);
		$text1 = esc_attr($instance['text1']);
		$text2 = esc_attr($instance['text2']);
		
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id('service_title'));?>">Service Title:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('service_title'));?>" name="<?php echo esc_attr($this->get_field_name('service_title'));?>" type="text" value="<?php echo esc_attr($service_title);?>"></input>
		</p>
        <p><label for="<?php echo esc_attr($this->get_field_id('cms_class'));?>">Class Name:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('cms_class'));?>" name="<?php echo esc_attr($this->get_field_name('cms_class'));?>" type="text" value="<?php echo esc_attr($cms_class);?>"></input>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('text1'));?>">Text1:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text1'));?>" name="<?php echo esc_attr($this->get_field_name('text1'));?>" type="text" value="<?php echo esc_attr($text1);?>"></input>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('text2'));?>">Text2:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text2'));?>" name="<?php echo esc_attr($this->get_field_name('text2'));?>" type="text" value="<?php echo esc_attr($text2);?>"></input>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('linkURL'));?>">Link URL:<br /></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL'));?>" type="text" value="<?php echo esc_attr($linkURL);?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<?php
	}
}
function cms_block_register_widgets()
{
    global $wp_widget_factory;
    $wp_widget_factory->register('CMSBlockWidget');
}
add_action('widgets_init', 'cms_block_register_widgets');
// end CMSBlockWidget
?>