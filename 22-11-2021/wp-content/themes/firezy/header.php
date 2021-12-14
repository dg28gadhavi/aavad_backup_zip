<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Templatemela
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="msvalidate.01" content="DA52BC684DA3E9368C250B35CCD85C55" />
<meta charset="utf-8"/>
	<meta name="title" content="Aavad Instrument | Manufacturer of RTD Sensors, Pt100 Sensors,Thermocouples, Thermowells & Electromagnetic Flow Meters in Ahmedabad, Gujarat, India."/>
	<meta name="description" content="Aavad Instrument is one of the leading manufacturer, supplier and exporter of Thermocouples and RTD Pt100 Sensors,Electromagnetic Flow Meter,Telemetry System, Thermocouple Cables, Connectors and associated Temperature Instrumentation."/>
	<meta name="keywords" content="RTD Sensors, Thermocouples, RTD Pt100 Sensors, Thermowell, Temperature Sensors, Electromagnetic Flow Meter, CGWA, CGWA Guideline, Telemetry System, Digital Water Meter, CGWA CGWB Guidelines, Ground Water Monitoring Meter, Borewell water monitoring meter, Borewell Digital Water Meter As Per CGWA, Digital Water Meter With Telemetry As Per CGWA, Digital Water Flow Meter For Borewell As Per CGWA, Telemetry Flow Meter, Flowmeter Telemetry Systems, Telemetry System CGWA Flow Meter, Tamper proof digital Water flow meter with telemetry, Flowmeter, Pressure Gauge, Temperature Gauge, Manufacturer, Supplier, Exporter, Trader, Manufacturers in India, Manufacturers in Ahmedabad. "/>
	<meta name="robots" content="INDEX,FOLLOW"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
	<meta name="format-detection" content="telephone=no"/>
<title>Aavad Instrument | Manufacturer of RTD Sensors, Pt100 Sensors,Thermocouples, Thermowells & Electromagnetic Flow Meters in Ahmedabad, Gujarat, India.</title>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php tmpmela_header(); ?>
 <?php wp_head();?> 
 <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fd0c7f2a1d54c18d8f1f25c/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>
<body <?php body_class(); ?>>
 <?php if (get_option('tmpmela_show_site_loader') == 'yes') : ?> 	
<div class="spinner-wrapper">
<div class="sk-cube-grid">
  <div class="sk-cube sk-cube1"></div>
  <div class="sk-cube sk-cube2"></div>
  <div class="sk-cube sk-cube3"></div>
  <div class="sk-cube sk-cube4"></div>
  <div class="sk-cube sk-cube5"></div>
  <div class="sk-cube sk-cube6"></div>
  <div class="sk-cube sk-cube7"></div>
  <div class="sk-cube sk-cube8"></div>
  <div class="sk-cube sk-cube9"></div>
</div>
</div>
<?php endif; ?>
<div id="page" class="hfeed site">
<?php if ( get_header_image() ) : ?>
<div id="site-header"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php echo esc_attr_e('Siteheader','firezy'); ?>"> </a> </div>
<?php endif; ?>
<!-- Header -->
<?php tmpmela_header_before(); ?>
<header id="masthead" class="site-header header-fix <?php echo "header".esc_attr(get_option('tmpmela_header_layout'));  ?> <?php echo esc_attr(tmpmela_sidebar_position()); ?>">
	<div class="header-main site-header-fix">
				<?php tmpmela_header_inside(); ?>	
					<!-- Start header_top -->			
					
			<div class="header-top">
				<div class="theme-container">
					<div class="header-top-left">
						<!-- Header LOGO-->
							<div class="header-logo">
							<?php if (get_option('tmpmela_logo_image') != '') : ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php tmpmela_get_logo(); ?>
								</a>
							<?php else: ?>
								<h3 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<span class="logo-text"><?php echo stripslashes(get_option('tmpmela_logo_image_alt')); ?></span>
									</a>	
								</h3>
							<?php endif; ?>
                                <?php if (get_option('tmpmela_logo_image') == '' && get_option('tmpmela_logo_image_alt') == '') : ?>
                                    <h3 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                            <span class="logo-text"><?php echo esc_attr(get_bloginfo('name', 'display')); ?></span>
                                        </a>
                                    </h3>
                                <?php endif; ?>
							<?php if(get_option('tmpmela_showsite_description') == 'yes') : ?>
								<h2 class="site-description">
									<?php bloginfo( 'description' ); ?>
								</h2>
							<?php endif; // End tmpmela_showsite_description ?>
							</div>
							<!-- Header Mob LOGO-->
							<div class="header-mob-logo">
							<?php if (get_option('tmpmela_mob_logo_image') != '') : ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php tmpmela_get_mob_logo(); ?>
								</a>
							<?php else: ?>
								<h3 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<span class="moblogo-text"><?php echo stripslashes(get_option('tmpmela_mob_logo_image_alt')); ?></span>
									</a>
								</h3>
							<?php endif; ?>
                                <?php if (get_option('tmpmela_logo_image') == '' && get_option('tmpmela_logo_image_alt') == '') : ?>
                                    <h3 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                            <span class="moblogo-text"><?php echo esc_attr(get_bloginfo('name', 'display')); ?></span>
                                        </a>
                                    </h3>
                                <?php endif; ?>
							<?php if(get_option('tmpmela_showsite_description') == 'yes') : ?>
								<h2 class="site-description">
									<?php bloginfo( 'description' ); ?>
								</h2>
							<?php endif; // End tmpmela_showsite_description ?>
							</div>					 			
					</div>
					
					<div class="header-top-center">
					<!--Search-->
							<?php if (is_active_sidebar('header-search')) : ?>
							<div class="header-search">
									<div class="header-toggle"></div>
										<?php tmpmela_get_widget('header-search');  ?>	
							</div>
							<?php endif; ?>			
					<!--End Search-->
					 <?php if (get_option('tmpmela_show_header_services') == 'yes') : ?> 	
						<div class="header-cms-service"><?php tmpmela_service_cms(); ?></div>	
					 <?php endif; ?>		
					</div>
				
					
					<!--Start Header Right CMS Area-->
						<div class="header-top-right">
							 <?php if (get_option('tmpmela_show_header_right_services') == 'yes') : ?> 	
							<div class="header-right-service-cms">
									<?php tmpmela_header_right_service_cms(); ?>	
							</div>
							<?php endif; ?>		
							
							    <ul class="social-icons">
					        <li class="social_icon_header whatsapp_s"><a href="https://api.whatsapp.com/send?phone=919099622823" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            <li class="social_icon_header facebook_s"><a href="https://www.facebook.com/aavadinstrument/" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li class="social_icon_header instagram_s"><a href="https://www.instagram.com/aavadinstrument/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li class="social_icon_header linkedin_s"><a href="https://www.linkedin.com/in/aavad-instrument/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                        <style>
                        	.social_icon_header{
                        		        display: inline-block;
									    margin: 4px;
									    width: 25px;
									    height: 23px;
									    border-radius: 5px;
									    color: #fff !important;
									    font-size: 20px;
										padding: 2px;
                        	}
                        	.fa-whatsapp:before, .fa-facebook:before, .fa-instagram:before, .fa-linkedin:before {
									color: #fff; 
							}
							.whatsapp_s{
								    border: 3px solid #48b037;
    								background: #48b037;
							}
							.facebook_s{
								    border: 3px solid #3b5998;
    								background: #3b5998;
							}
							.instagram_s{
								    border: 3px solid #e4405f;
    								background: #e4405f;
							}
							.linkedin_s{
								    border: 3px solid #2377b5;
    								background: #2377b5;
							}
						</style>
					</div>
					<!--End Header Right CMS Area-->
				</div>
			</div>
			 	<!-- End header_top -->		
				
				<div class="header-bottom">
					<div class="theme-container">
							<div class="header-bottom-left">	
								<!-- Start header_bottom_left -->	
									<?php if (is_active_sidebar('header-category')) : ?>
								<div class="box-category-heading">
									<div class="box-category">
                                        <div class="title1">
                                            <?php echo stripslashes(get_option( 'tmpmela_navbar_category_title1' )); ?>
                                        </div>
                                        <div class="title2">
                                            <?php echo stripslashes(get_option( 'tmpmela_navbar_category_title2' )); ?>
                                        </div>
                                    </div>
									<!-- category block -->
									<div class="header-category widget_product_categories">
                                        <?php tmpmela_get_widget('header-category');  ?>
                                    </div>
									<!-- end category block -->
								</div>						
								<?php endif; ?>				
							<!-- #site-navigation -->
								<nav id="site-navigation" class="navigation-bar main-navigation">																				
								<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'firezy' ); ?>"><?php esc_html_e( 'Skip to content', 'firezy' ); ?></a>	
									<div class="mega-menu">
										<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class' => 'mega' ) ); ?>		
									</div>	
								</nav>
								<nav class="mobile-navigation">	
								<h3 class="menu-toggle"><?php esc_html_e( 'Menu', 'firezy' ); ?></h3>
									<div class="mobile-menu">	
										<span class="close-menu"></span>	
											<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class' => 'mobile-menu-inner') ); ?>
										</div>
								</nav>
						</div>				
						<!-- End header_bottom_left -->
						<!-- Start header_bottom_right -->		
							<div class="header-bottom-right">
						   <?php /* if (!has_nav_menu('header-menu')): ?>
                                <div class="login-out">
                                    <?php $logout_url = '';
                                    if (is_user_logged_in()) {
                                        $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                                        if ($myaccount_page_id) {
                                            $logout_url = wp_logout_url(get_permalink($myaccount_page_id));
                                            if (get_option('woocommerce_force_ssl_checkout') == 'yes')
                                                if (is_ssl()) {
                                                    $logout_url = str_replace('http:', 'https:', $logout_url);
                                                }
                                        } ?>
                                        <?php if ($myaccount_page_id): ?>
                                            <a class="logout" href="<?php echo esc_url($logout_url); ?>">
                                                <?php echo esc_html_e('Logout', 'firezy'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php } else {
                                        $myaccount_page_id = get_option('woocommerce_myaccount_page_id'); ?>
                                        <?php if ($myaccount_page_id): ?>
                                            <a class="login" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                                <?php echo esc_html_e('Login', 'firezy'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            <?php endif; */ ?>
							<?php if ( has_nav_menu('header-menu') ): ?> 	
										<!-- Topbar link -->							
										<div class="topbar-link">
											<div class="topbar-link-toggle"></div>
											<div class="account-block">
												<span class="account-label">
													<?php
													if ( is_user_logged_in() ) {
													  echo esc_html_e('Sign Out','firezy'); 
													}
													else {
													echo esc_html_e('Sign In','firezy');
													 } ?>
													</span>
													
													<span class="account-contents">
														<?php echo esc_html_e('My Account','firezy'); ?></span></div>
												<div class="topbar-link-wrapper">   
													<div class="header-menu-links">	
																		
															<?php 
															// Woo commerce Header Cart
															$tmpmela_header_menu =array(
															'menu' => esc_html__('TM Header Top Links','firezy'),
															'depth'=> 1,
															'echo' => false,
															'menu_class'      => 'header-menu', 
															'container'       => '', 
															'container_class' => '', 
															'theme_location' => 'header-menu'
															);
															echo wp_nav_menu($tmpmela_header_menu);				    
															?>
															<?php 
													if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>	<?php  tmpmela_add_to_compare_in_menu();  ?>
													<?php endif ?>			
															<?php
															$logout_url = '';
															if ( is_user_logged_in() ) {
																$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' ); 
																if ( $myaccount_page_id ) { 
																$logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) ); 
																if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' )
																if (is_ssl()) {
																$logout_url = str_replace( 'http:', 'https:', $logout_url );
																}
																} ?>
																<a href="<?php echo esc_url($logout_url); ?>" ><?php echo esc_html_e('Logout','firezy'); ?></a>
																<?php }
																else { ?>
																<a href="<?php echo  get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html_e('User Login','firezy'); ?></a>
															<?php } ?>  
														
													</div>			
												</div>
										</div>	
										<?php endif; ?>
										
										<!--Cart -->			
											<?php /*
											// Woo commerce Header Cart
											if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_active_sidebar('header-widget') ) : ?>
											
											<div class="header-cart headercart-block">
											<div class="cart togg">
														<?php global $woocommerce;
														ob_start();?>						
														<div class="shopping_cart tog" title="<?php esc_attr_e('View your shopping cart', 'firezy'); ?>">
															<div class="cart-icon"></div>
															<div class="cart-price">
																<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'firezy'); ?>">
																	<span class="cart-qty"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'firezy'), $woocommerce->cart->cart_contents_count);?></span>
																	<div class="cart-label"><?php echo esc_html_e('My Cart','firezy'); ?></div>
																	<div class="item-total"><?php echo translate($woocommerce->cart->get_cart_total()); ?> </div>
																</a>
															</div>
														</div>	
														<?php global $woocommerce; ?>
														<?php tmpmela_get_widget('header-widget'); ?>		
											</div>
										</div>
												<?php endif; */?>	
										
												
									</div>
					<!-- End header_bottom_right -->	
				</div>	
			<!-- End header_bottom -->	
	</div>					
 <!-- End header-main -->
</div>	
</header>
<?php tmpmela_header_after(); ?>
<?php tmpmela_main_before(); ?>
	<?php 
		$tmpmela_page_layout = tmpmela_page_layout(); 
		if( isset( $tmpmela_page_layout) && !empty( $tmpmela_page_layout ) ):
		$tmpmela_page_layout = $tmpmela_page_layout; 
		else:
		$tmpmela_page_layout = '';
		endif;
	?>
<?php 
$shop = '0';
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
	if(is_shop())
		$tmpmela_page_layout = 'wide-page';
		$shop = '1';
	endif;
?>
<?php
global $wp;
$current = esc_url(home_url( add_query_arg( array( $_GET ), $wp->request ) ));
$str = substr(strrchr($current, '?'), 1);
if($str == 'left'){
  $div_class = 'left-sidebar';
}elseif($str == 'right'){
  $div_class = 'right-sidebar';
}elseif($str == 'full'){
  $div_class = 'full-width';  
}else{
$div_class = tmpmela_sidebar_position();
} 
if ( get_option( 'tmpmela_page_sidebar' ) == 'no' ):
    $div_class = "full-width";
	endif;
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {	
  if ( is_product() ){	
     if ( get_option( 'tmpmela_shop_sidebar' ) == 'no' ):
   		 $div_class = "full-width";
	endif;
   }	
}
if ( is_home() && tmpmela_is_blog() ){
    $div_class = "left-sidebar";
}
?>
<div id="main" class="site-main <?php echo esc_attr($div_class);  ?> <?php echo esc_attr(tmpmela_page_layout()); ?>">
<div class="main_inner">
<?php 
	$tmpmela_page_layout = tmpmela_page_layout(); 
	if( isset( $tmpmela_page_layout) && !empty( $tmpmela_page_layout ) ):
	$tmpmela_page_layout = $tmpmela_page_layout; 
	else:
	$tmpmela_page_layout = '';
	endif;
if ( $tmpmela_page_layout == 'wide-page' ) : ?>
	<div class="main-content-inner-full">
<?php else: 		
if(is_archive() || is_tag() || is_404()) : ?>
	<div class="main-content">
<?php else: ?>
	<div class="main-content-inner <?php echo esc_attr(tmpmela_sidebar_position()); ?>">	
<?php endif; ?>
<?php endif; ?>
<?php tmpmela_content_before(); ?>