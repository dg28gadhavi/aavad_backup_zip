<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */
?>
<?php tmpmela_content_after(); ?>
</div>
<!-- .main-content-inner -->
</div>
<!-- .main_inner -->
</div>
<!-- #main -->
<?php tmpmela_footer_before(); ?>
<footer id="colophon" class="site-footer" >	
	    
		<?php tmpmela_footer_inside(); ?>
		<?php get_sidebar('footer'); ?>
		
		
		
		 <div class="footer-bottom">
		     <div class="theme-container" style="center">  
		<center><h2 style="font-size: 22px;"><a href="https://www.aavadinstrument.com/product-category/ceramic-tube-thermocouple/">TEMPERATURE</a> | <a href="https://www.aavadinstrument.com/product-category/pressure-gauge/">PRESSURE</a> | <a href="https://www.aavadinstrument.com/product-category/electromagnetic-flowmeter/">FLOW</a> | <a href="https://www.aavadinstrument.com/product-category/level/">LEVEL</a> | <a href="https://www.aavadinstrument.com/product-category/process-indicator-and-controller/">PROCESS CONTROLLER</a>
		</h2></center></div>	
		 	 <div class="theme-container">
					<?php if ( has_nav_menu('footer-menu') ) { ?>    
					<div class="footer-menu-links">
					<?php
								$tmpmela_footer_menu=array(
								'menu' => esc_html__('TM Footer Navigation','firezy'),
								'depth'=> 1,
								'echo' => false,
								'menu_class'      => 'footer-menu', 
								'container'       => '', 
								'container_class' => '', 
								'theme_location' => 'footer-menu'
								);
							//	echo wp_nav_menu($tmpmela_footer_menu);		/*sdmistry*/		    
								?>
								
								
					</div><!-- #footer-menu-links -->	
					
					<?php } ?> 
					
				   	<div class="site-info">  <?php echo esc_html__( 'Copyright', 'firezy' ); ?> &copy; <?php echo esc_attr(date('Y')); ?> Aavad Instrument<?php //echo esc_attr(stripslashes(get_option('tmpmela_footer_slog')));?>
							<?php do_action( 'tmpmela_credits' ); ?>
					</div>
					
				<?php if ( is_active_sidebar( 'footer-bottom-widget-area' ) ) : ?>
					<?php dynamic_sidebar( 'footer-bottom-widget-area' ); ?>
				<?php endif; ?>
			</div>
	 </div>
</footer>
<!-- #colophon -->
<?php tmpmela_footer_after(); ?>
</div>
<!-- #page -->
<?php tmpmela_go_top(); ?>
<?php tmpmela_get_widget('before-end-body-widget'); ?>
<?php wp_footer(); ?>
</body>
</html>