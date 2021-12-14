<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Wc_Document_Preview
 * @subpackage Wc_Document_Preview/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Document_Preview
 * @subpackage Wc_Document_Preview/public
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Wc_Document_Preview_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Document_Preview_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Document_Preview_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-document-preview-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Document_Preview_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Document_Preview_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-document-preview-public.js', array( 'jquery' ), $this->version, false );
	}

	public function wcdp_add_preview_field() {
		global $post;
		$wcdp_preview = get_post_meta( $post->ID, 'wcdp_preview_attachment', true );
		$wcdp_documents = get_post_meta($post->ID, 'wcdp_documents', true);
		
		if ( ! empty( $wcdp_preview ) && empty($wcdp_documents) ) {
			$lnk  = 'https://docs.google.com/viewer?url=' . urlencode( $wcdp_preview['url'] );
			$lnk .= '&embedded=true';
			echo "<div class='product_meta wcdp-preview-btn-div'>";
			echo '<a class="wcdp-preview-btn thickbox" href="' . $lnk . '&TB_iframe=true&width=600&height=550">' . $wcdp_preview['name'] . '</a>';
			echo '</div>';
		}
		
		if ( !empty($wcdp_documents) ) :
			foreach( $wcdp_documents['wcdp_file_names'] as $key=>$value) {				
				$lnk  = 'https://docs.google.com/viewer?url=' . urlencode( $wcdp_documents['wcdp_file_urls'][$key] );
				$lnk .= '&embedded=true';
				echo "<div class='product_meta wcdp-preview-btn-div'>";
				echo '<a class="wcdp-preview-btn thickbox" href="' . $lnk . '&TB_iframe=true&width=600&height=550">' . $wcdp_documents['wcdp_file_names'][$key] . '</a>';
				echo '</div>';
			}
		endif;
		return true;
	}

	public function wcdp_add_thickbox() {
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			global $post;
			if ( is_woocommerce() && is_product() && $post->post_type == 'product' ) {
				add_thickbox();
			}
		}
	}
}
