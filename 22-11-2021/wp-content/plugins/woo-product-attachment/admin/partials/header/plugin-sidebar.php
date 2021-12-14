<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$image_url = WCPOA_PLUGIN_URL . 'admin/images/right_click.png';
$review_url = '';
$plugin_at = '';
$tweet_url = 'https://twitter.com/share?text=' . urlencode( "I use Product Attachment for #WooCommerce by @dotstore to help attach any kind of files (doc, jpg, videos, pdf) for #customerorders Enhance your customer experience of #productpages with downloadable Attached files.Checkout this #plugin" ) . '&amp;hashtags=wordpress,woo &amp;url=https://wordpress.org/plugins/woo-product-attachment';
$review_url = esc_url( 'https://wordpress.org/plugins/woo-product-attachment/#reviews' );
$plugin_at = 'WP.org';
?>
<div class="dotstore_plugin_sidebar">
<?php 

if ( wpap_fs()->is__premium_only() && wpap_fs()->can_use_premium_code() ) {
} else {
    ?>
            <div class="dotstore-sidebar-section dotstore-upgrade-to-pro">
                <div class="dotstore-important-link-heading">
                    <span class="heading-text"><?php 
    esc_html_e( 'Upgrade to Product Attachment Pro', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></span>
                </div>
                <div class="dotstore-important-link-content">
                    <ul class="dotstore-pro-list">
                        <li><?php 
    esc_html_e( 'Add as many attachments as you want', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Use multiple file formats including doc, JPG, Videos and PDF', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Add valuable information to Product pages', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Create highly-targeted attachments', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Create attachments based on the status of the order', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Make use of any URL as attachment', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Make attachments stand out with the use of appealing icons', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( 'Save time by uploading attachments in bulk', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                        <li><?php 
    esc_html_e( '24/7 email support', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></li>
                    </ul>
                    <div class="dotstore-pro-button">
                        <a class="button" target="_blank" href="<?php 
    echo  esc_url( 'https://bit.ly/3qjiooM' ) ;
    ?>"><?php 
    esc_html_e( 'Get Premium Now »', WCPOA_PLUGIN_TEXT_DOMAIN );
    ?></a>
                    </div>
                </div>
            </div>
            <?php 
}

?>
    <div class="dotstore-important-link">
		<div class="image_box">
			<img src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL . 'admin/images/rate-us.png' ) ;
?>" alt="">
		</div>
		<div class="content_box">
			<h3><?php 
esc_html_e( 'Like This Plugin?', WCPOA_PLUGIN_TEXT_DOMAIN );
?></h3>
            <p class="star-container">
                <a href="<?php 
echo  esc_url( $review_url ) ;
?>" target="_blank">
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                </a>
            </p>
			<p><?php 
esc_html_e( 'Your Review is very important to us as it helps us to grow more.', WCPOA_PLUGIN_TEXT_DOMAIN );
?></p>
			<a class="btn_style" href="<?php 
echo  esc_url( $review_url ) ;
?>" target="_blank"><?php 
esc_html_e( 'Review Us on ', WCPOA_PLUGIN_TEXT_DOMAIN );
?> <?php 
esc_html_e( $plugin_at, WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
            <h3><?php 
esc_html_e( 'Tweet about us!', WCPOA_PLUGIN_TEXT_DOMAIN );
?></h3>
            <a class="btn_style" href="<?php 
echo  esc_url( $tweet_url ) ;
?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i><?php 
esc_html_e( ' Tweet', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
		</div>
	</div>

    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-image-rotate-right"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Free vs Pro Feature', WCPOA_PLUGIN_TEXT_DOMAIN );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'Here’s an at a glance view of the main differences between Premium and free plugin features.', WCPOA_PLUGIN_TEXT_DOMAIN );
?></p>
            <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/woocommerce-product-attachment#tab-free-vs-premium' ) ;
?>"><?php 
esc_html_e( 'Click here »', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
        </div>
    </div>
    
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-star-filled"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Suggest A Feature', WCPOA_PLUGIN_TEXT_DOMAIN );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'Let us know how we can improve the plugin experience.', WCPOA_PLUGIN_TEXT_DOMAIN );
?></p>
            <p><?php 
esc_html_e( 'Do you have any feedback & feature requests?', WCPOA_PLUGIN_TEXT_DOMAIN );
?></p>
            <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/feature-requests/' ) ;
?>"><?php 
esc_html_e( 'Submit Request »', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
        </div>
    </div>

    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-editor-kitchensink"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Changelog', WCPOA_PLUGIN_TEXT_DOMAIN );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'We improvise our products on a regular basis to deliver the best results to customer satisfaction.', WCPOA_PLUGIN_TEXT_DOMAIN );
?></p>
            <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/woocommerce-product-attachment#tab-update-log' ) ;
?>"><?php 
esc_html_e( 'Visit Here »', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
        </div>
    </div>

    <!-- html for popular plugin !-->
    <div class="dotstore-important-link dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-plugins-checked"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Our Popular Plugins', WCPOA_PLUGIN_TEXT_DOMAIN );
?></span>
        </div>
        <div class="video-detail important-link">
            <ul>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/Advanced-Flat-Rate-Shipping-Method.png' ;
?>" alt="<?php 
esc_attr_e( 'Advanced Flat Rate Shipping Method', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/flat-rate-shipping-plugin-for-woocommerce/" ) ;
?>"><?php 
esc_html_e( 'Advanced Flat Rate Shipping Method', WCPOA_PLUGIN_TEXT_DOMAIN );
?> </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/Extra-Fees-Plugin-for-WooCommerce.png' ;
?>" alt="<?php 
esc_attr_e( 'Extra Fees Plugin for WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/product/woocommerce-extra-fees-plugin/" ) ;
?>"><?php 
esc_html_e( 'Extra Fees Plugin for WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/Advance-Menu-Manager-For-WordPress.png' ;
?>" alt="<?php 
esc_attr_e( 'Advance Menu Manager For WordPress', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/advance-menu-manager-wordpress/" ) ;
?>">
						<?php 
esc_html_e( 'Advance Menu Manager For WordPress', WCPOA_PLUGIN_TEXT_DOMAIN );
?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/Enhanced-Ecommerce-Google-Analytics-For-WooCommerce.png' ;
?>" alt="<?php 
esc_attr_e( 'Enhanced Ecommerce Google Analytics for WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/woocommerce-enhanced-ecommerce-analytics-integration-with-conversion-tracking" ) ;
?>">
						<?php 
esc_html_e( 'Enhanced Ecommerce Google Analytics for WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/WooCommerce-Conditional-Discount-Rules-For-Checkout.png' ;
?>" alt="<?php 
esc_attr_e( 'Conditional Discount Rules For WooCommerce Checkout', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/woocommerce-conditional-discount-rules-for-checkout/" ) ;
?>">
                        <?php 
esc_html_e( 'Conditional Discount Rules For WooCommerce Checkout', WCPOA_PLUGIN_TEXT_DOMAIN );
?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/wcbm-logo.png' ;
?>" alt="<?php 
esc_attr_e( 'WooCommerce Category Banner Management', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/product/woocommerce-category-banner-management/" ) ;
?>">
                        <?php 
esc_html_e( 'WooCommerce Category Banner Management', WCPOA_PLUGIN_TEXT_DOMAIN );
?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/WooCommerce-Blocker-Prevent-Fake-Orders.png' ;
?>" alt="<?php 
esc_attr_e( 'WooCommerce Anti-Fraud', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/woocommerce-anti-fraud" ) ;
?>">
                        <?php 
esc_html_e( 'WooCommerce Anti-Fraud', WCPOA_PLUGIN_TEXT_DOMAIN );
?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/hide-shipping.png' ;
?>" alt="<?php 
esc_attr_e( 'Hide Shipping Method For WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/hide-shipping-method-for-woocommerce" ) ;
?>">
                        <?php 
esc_html_e( 'Hide Shipping Method For WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( WCPOA_PLUGIN_URL ) . 'admin/images/Advanced-Product-Size-Charts-for-WooCommerce.png' ;
?>" alt="<?php 
esc_attr_e( 'Product Size Charts Plugin For WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( "https://www.thedotstore.com/woocommerce-advanced-product-size-charts/" ) ;
?>">
                        <?php 
esc_html_e( 'Product Size Charts Plugin For WooCommerce', WCPOA_PLUGIN_TEXT_DOMAIN );
?>
                    </a>
                </li>
                </br>
            </ul>
        </div>
        <div class="view-button">
            <a class="button button-primary button-large" target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/plugins' ) ;
?>"><?php 
esc_html_e( 'VIEW ALL', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
        </div>
    </div>

    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-sos"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Five Star Support', WCPOA_PLUGIN_TEXT_DOMAIN );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'Got a question? Get in touch with theDotstore developers. We are happy to help! ', WCPOA_PLUGIN_TEXT_DOMAIN );
?></p>
            <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/support/' ) ;
?>"><?php 
esc_html_e( 'Submit a Ticket »', WCPOA_PLUGIN_TEXT_DOMAIN );
?></a>
        </div>
    </div>
</div>
</div>
</body>
</html>