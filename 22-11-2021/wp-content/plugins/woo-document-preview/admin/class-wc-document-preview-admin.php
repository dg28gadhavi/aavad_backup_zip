<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Wc_Document_Preview
 * @subpackage Wc_Document_Preview/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Document_Preview
 * @subpackage Wc_Document_Preview/admin
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Wc_Document_Preview_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-document-preview-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-document-preview-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'wcdp_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function update_edit_form() {
		echo ' enctype="multipart/form-data"';
	}

	/**
	 * Register meta box(es).
	 */
	public function wcdp_register_meta_boxes() {
		add_meta_box( 'wc-preview-doc-mata-id', __( 'Preview Item <span class="wcdp-required-span"> ( Only Doc, Xls and PDF allowed here. )</span>', $this->plugin_name ), array( $this, 'wcdp_display_callback' ), 'product' );
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function wcdp_display_callback( $post ) {
		// Add nonce for security and authentication.
		wp_nonce_field( 'wcdp_nonce_action', 'wcdp_nonce' );
		$wcdp_documents = get_post_meta( $post->ID, 'wcdp_documents', true );
		$preview_data = get_post_meta( $post->ID, 'wcdp_preview_attachment', true );
		?>
		<div class="form-field preview_files">
			<table class="widefat woo-document-preview-table">
				<thead>
					<tr>
						<th class="sort">&nbsp;</th>
						<th><?php esc_attr_e( 'Name', 'wc-document-preview' ); ?><span class="woocommerce-help-tip"></span></th>
						<th colspan="2"><?php esc_attr_e( 'File URL', 'wc-document-preview' ); ?> <span class="woocommerce-help-tip"></span></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody class="ui-sortable wcdp-preview-tr">
				<p class="wcdp-del-msg"></p>
				<?php if ( !empty($wcdp_documents) ) :?>
						<?php foreach( $wcdp_documents['wcdp_file_names'] as $key=>$value):?>
							<tr class="wcdp-document-file">
								<td class="sort"></td>
								<td class="file_name"><input class="input_text" placeholder="File Name" name="wcdp_documents[wcdp_file_names][]" value="<?php echo isset( $wcdp_documents['wcdp_file_names'][$key] ) ? $wcdp_documents['wcdp_file_names'][$key] : ''; ?>" type="text"></td>
								<td class="file_url"><input id="wcdp_file_urls" class="input_text" placeholder="http://" name="wcdp_documents[wcdp_file_urls][]" value="<?php echo isset( $wcdp_documents['wcdp_file_urls'][$key] ) ? $wcdp_documents['wcdp_file_urls'][$key] : ''; ?>" type="text"></td>
								<td class="file_url_choose" width="1%"><input type="file" id="wcdp_preview_attachment" name="wcdp_documents[wcdp_preview_attachment][]" value="" size="25"/></td>
								<td width="15%">
									<a href="javascript:void(0)"  class="wcdp-add-document-cl">Add</a>&nbsp;
									<a href="javascript:void(0)" data-p_id="<?php echo $post->ID; ?>" data-file="<?php echo isset( $preview_data['file'] ) ? $preview_data['file'] : ''; ?>" class="wcdp-delete-document-cl" id="wcdp-delete-document-id"><?php esc_attr_e( 'Remove', 'wc-document-preview' );?></a>
								</td>
							</tr>
						<?php endforeach;?>
					<?php else :?>
							<tr class="wcdp-document-file">
								<td class="sort"></td>
								<td class="file_name"><input class="input_text" placeholder="File Name" name="wcdp_documents[wcdp_file_names][]" value="<?php echo isset( $preview_data['name'] ) ? $preview_data['name'] : ''; ?>" type="text"></td>
								<td class="file_url"><input id="wcdp_file_urls" class="input_text" placeholder="http://" name="wcdp_documents[wcdp_file_urls][]" value="<?php echo isset( $preview_data['url'] ) ? $preview_data['url'] : ''; ?>" type="text"></td>
								<td class="file_url_choose" width="1%"><input type="file" id="wcdp_preview_attachment" name="wcdp_documents[wcdp_preview_attachment][]" value="<?php echo isset( $preview_data['file'] ) ? $preview_data['file'] : ''; ?>" size="25"/></td>
								<td width="15%">
									<a href="javascript:void(0)"  class="wcdp-add-document-cl">Add</a>&nbsp;
									<a href="javascript:void(0)" data-p_id="<?php echo $post->ID; ?>" data-file="<?php echo isset( $preview_data['file'] ) ? $preview_data['file'] : ''; ?>" class="wcdp-delete-document-cl" id="wcdp-delete-document-id"><?php esc_attr_e( 'Remove', 'wc-document-preview' );?></a>
								</td>
							</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
		<?php
	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID
	 */
	public function wcdp_save_meta_box( $post_id ) {
		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['wcdp_nonce'] ) ? $_POST['wcdp_nonce'] : '';
		$nonce_action = 'wcdp_nonce_action';

		// Check if nonce is set.
		if ( ! isset( $nonce_name ) ) {
			return;
		}

		// Check if nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}

		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check if not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		if ( isset( $_POST['post_type'] ) && $_POST['post_type'] == 'product' ) {

			if ( isset($_POST['wcdp_documents']) && !empty($_POST['wcdp_documents']) ) {

				if ( isset($_FILES['wcdp_documents']['name']) && !empty($_FILES['wcdp_documents']['name'])) {
					$supported_types = array( 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
					foreach ($_FILES['wcdp_documents']['name']['wcdp_preview_attachment'] as $key=>$value ) {
						$arr_file_type = wp_check_filetype( basename( $value ) );
						$uploaded_type = $arr_file_type['type'];
						if ( in_array( $uploaded_type, $supported_types ) ) {
							// Use the WordPress API to upload the file.
							if ( ! function_exists( 'wp_handle_upload' ) ) {
								require_once ABSPATH . 'wp-admin/includes/file.php';
							}

							$uploadedfile['name']     	= $_FILES['wcdp_documents']['name']['wcdp_preview_attachment'][$key];
							$uploadedfile['type']     	= $_FILES['wcdp_documents']['type']['wcdp_preview_attachment'][$key];
							$uploadedfile['tmp_name']	= $_FILES['wcdp_documents']['tmp_name']['wcdp_preview_attachment'][$key];
							$uploadedfile['error']		= $_FILES['wcdp_documents']['error']['wcdp_preview_attachment'][$key];
							$uploadedfile['size']     	= $_FILES['wcdp_documents']['size']['wcdp_preview_attachment'][$key];
							$upload_overrides = array( 'test_form' => false );

							add_filter( 'upload_dir', array( $this, 'wcdp_set_upload_dir' ) );
							$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
							remove_filter( 'upload_dir', array( $this, 'wcdp_set_upload_dir' ) );
							$_POST['wcdp_documents']['wcdp_file_urls'][$key] = $movefile['url'];

						}
					}

					update_post_meta( $post_id, 'wcdp_documents', $_POST['wcdp_documents'] );
				}
			}

			if ( isset($_POST['wcdp_file_names']) ) {
				$wcdp_file_names = sanitize_text_field( $_POST['wcdp_file_names'] );
				if ( '' == $wcdp_file_names ) {
					$file_name                = explode( '.', $_FILES['wcdp_preview_attachment']['name'] );
					$_POST['wcdp_file_names'] = $file_name[0];
				}
				if ( isset( $_POST['wcdp_file_names'] ) && ! empty( $_POST['wcdp_file_names'] ) ) {

					// Make sure the file array isn't empty.
					if ( ! empty( $_FILES['wcdp_preview_attachment']['name'] ) ) {

						// Setup the array of supported file types. In this case, it's just PDF.
						$supported_types = array( 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );

						// Get the file type of the upload.
						$arr_file_type = wp_check_filetype( basename( $_FILES['wcdp_preview_attachment']['name'] ) );
						$uploaded_type = $arr_file_type['type'];
						// Check if the type is supported. If not, throw an error.
						if ( in_array( $uploaded_type, $supported_types ) ) {
							// Use the WordPress API to upload the file.
							if ( ! function_exists( 'wp_handle_upload' ) ) {
								require_once ABSPATH . 'wp-admin/includes/file.php';
							}
							$uploadedfile     = $_FILES['wcdp_preview_attachment'];
							$upload_overrides = array( 'test_form' => false );

							add_filter( 'upload_dir', array( $this, 'wcdp_set_upload_dir' ) );
							$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
							remove_filter( 'upload_dir', array( $this, 'wcdp_set_upload_dir' ) );

							if ( $movefile && ! isset( $movefile['error'] ) ) {
								$movefile['name'] = sanitize_text_field( $_POST['wcdp_file_names'] );
								add_post_meta( $post_id, 'wcdp_preview_attachment', $movefile );
								update_post_meta( $post_id, 'wcdp_preview_attachment', $movefile );
							} else {
								/**
								 * Error generated by _wp_handle_upload()
								 *
								 * @see _wp_handle_upload() in wp-admin/includes/file.php
								 */
								echo $movefile['error'];
							}
						}// end if/else.
					} else {
						if ( isset( $_POST['wcdp_file_urls'] ) && ! empty( $_POST['wcdp_file_urls'] ) ) {
							$supported_types = array( 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
							$arr_file_type   = wp_check_filetype( $_POST['wcdp_file_urls'] );
							$uploaded_type   = $arr_file_type['type'];
							if ( in_array( $uploaded_type, $supported_types ) ) {
								$doc_url         = array();
								$doc_url['name'] = sanitize_text_field( $_POST['wcdp_file_names'] );
								$doc_url['url']  = sanitize_text_field( $_POST['wcdp_file_urls'] );
								add_post_meta( $post_id, 'wcdp_preview_attachment', $doc_url );
								update_post_meta( $post_id, 'wcdp_preview_attachment', $doc_url );
							}
						}
					}
				}
			}
		}
	}

	public function wcdp_delete_document_ajax() {
		if ( isset( $_POST ) ) {
			$post_id       = sanitize_text_field( $_POST['p_id'] );
			$fileurl       = sanitize_text_field( $_POST['file_url'] );
			$filename      = basename( $fileurl );
			$upload_dir    = wp_upload_dir();
			$upload_path   = $upload_dir['basedir'];
			$uploaded_file = $upload_path . '/wcdp_files/' . $filename;
			if ( file_exists( $uploaded_file ) ) {
				@unlink( $uploaded_file );
				update_post_meta( $post_id, 'wcdp_preview_attachment', '' );
			}
		}
		die();
	}

	/**
	 * Set Upload Directory
	 *
	 * Sets the upload dir to edd. This function is called from
	 * wcdp_change_audio_upload_dir()
	 *
	 * @since 1.0
	 * @return array Upload directory information
	 */
	public function wcdp_set_upload_dir( $upload ) {
		$upload['subdir'] = '/wcdp_files';
		$upload['path']   = $upload['basedir'] . $upload['subdir'];
		$upload['url']    = $upload['baseurl'] . $upload['subdir'];
		return $upload;
	}

}
