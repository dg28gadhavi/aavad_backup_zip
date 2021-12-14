<?php

namespace FooPlugins\FooBar\Admin\Notification\Metabox;

use FooPlugins\FooBar\Admin\FooFields\Metabox;

if ( ! class_exists( __NAMESPACE__ . '\Types' ) ) {

	class Types extends Metabox {

		function __construct() {
			parent::__construct(
				array(
					'manager'        => FOOBAR_SLUG,
					'post_type'      => FOOBAR_CPT_NOTIFICATION,
					'metabox_id'     => 'types',
					'metabox_title'  => __( 'What type of notification do you want to create?', 'foobar' ),
					'priority'       => 'high',
					'meta_key'       => FOOBAR_NOTIFICATION_META_TYPE,
					'disable_close'  => true
				)
			);

			add_action( 'admin_footer', array( $this, 'admin_footer' ) );
			add_action( 'admin_head', array( $this, 'custom_css' ) );
			add_filter( 'hidden_meta_boxes', array( $this, 'get_hidden_meta_boxes' ), 10, 3 );

			$this->add_action( 'enqueue_assets', array( $this, 'enqueue' ) );
			$this->add_filter( 'get_posted_data', array( $this, 'get_type' ), 10, 2 );
		}

		function get_fields() {
			$fields = array(
				array(
					'id'      => 'type',
					'type'    => 'htmllist',
					'choices' => foobar_registered_bar_types()
				)
			);

			return $fields;
		}

		/**
		 * Returns a list of all hidden metaboxes
		 *
		 * @param string[]  $hidden       An array of IDs of hidden meta boxes.
		 * @param WP_Screen $screen       WP_Screen object of the current screen.
		 * @param bool      $use_defaults Whether to show the default meta boxes.
		 *
		 * @return mixed
		 */
		function get_hidden_meta_boxes( $hidden, $screen, $use_defaults ) {
			if ( $this->is_admin_edit_mode() && $this->is_current_post_type() ) {

				$ensure_not_hidden = array(
					'foobar_notification-types',
					'foobar_notification-settings'
				);

				foreach ( $ensure_not_hidden as $item ) {
					$key = array_search( $item, $hidden );
					if ( $key !== false ) {
						unset( $hidden[$key] );
					}
				}
			}

			return $hidden;
		}

		/**
		 * Return the data as a string and not an array
		 *
		 * @param $posted_data
		 * @param $metabox Metabox
		 *
		 * @return string
		 */
		function get_type( $posted_data, $metabox ) {
			global $foobar_admin_current_type;

			if ( array_key_exists( 'type', $posted_data ) ) {

				//the type has been set from the metabox
				$foobar_admin_current_type = $posted_data['type'];

			} else {

				//dealing with an existing bar, so get the type from post_meta, and ignore the metabox
				$foobar_admin_current_type = get_post_meta( $metabox->post_id, FOOBAR_NOTIFICATION_META_TYPE, true );

			}

			return $foobar_admin_current_type;
		}

		/**
		 * Render the FooBar to the footer
		 */
		function admin_footer() {
			global $post;

			if ( $this->is_admin_edit_mode() && $this->is_current_post_type() ) {

				$foobar = foobar_get_instance_admin();

				if ( $foobar !== false ) {
					if ( $foobar->get_meta( 'layout', '' ) !== 'fbr-layout-inline' ) {
						foobar_render_bar( $foobar, array( 'preview' => true ) );
					}
				}
			}
		}

		/**
		 * Enqueue foobar assets
		 */
		function enqueue() {
			$types = array_keys( foobar_registered_bar_types() );
			$selected_type = foobar_get_instance_admin_type();
			$types_config = array();

			// TODO: find a better way to handle this but the ID values from the various configs need to be updated
			$metaboxes = array(
				array(
					'post_type' => FOOBAR_CPT_NOTIFICATION,
					'id' => 'settings'
				)
			);

			foreach ( $metaboxes as $metabox ){
				$metabox_id = $metabox['post_type'] . '-' . $metabox['id']; // $metabox->container_id();
				$metabox_config = array();
				foreach ( $types as $type ) {
					$field_config = apply_filters( 'foobar_admin_notification_settings_fields_config-' . $type, false, $selected_type === $type );
					if ( $field_config !== false ) {
						$field_config['container'] = $metabox_id . '-container';
						if ( isset( $field_config['tab'] ) && is_string( $field_config['tab'] ) ){
							$field_config['content'] = $metabox_id . '_' . $field_config['tab'] . '-content';
							$field_config['tab'] = $metabox_id . '_' . $field_config['tab'] . '-tab';
						}
						if ( isset( $field_config['defaults'] ) && is_array( $field_config['defaults'] ) ){
							$defaults = array();
							foreach ( $field_config['defaults'] as $key => $value ){
								$defaults[ $metabox_id . '_' . $key . '-field' ] = $value;
							}
							$field_config['defaults'] = $defaults;
						}
						$metabox_config[$type] = $field_config;
					}
				}
				if ( !empty( $metabox_config ) ){
					$types_config[$metabox_id] = $metabox_config;
				}
			}

			foobar_enqueue_script();
			foobar_enqueue_stylesheet();

			wp_localize_script( 'foobar-core', 'FOOBAR_TYPES', $types_config );
		}

		/**
		 * Output some custom CSS to show and hide the settings metabox
		 */
		function custom_css() {
			$foobar = foobar_get_instance_admin();

			if ( $foobar === false ) {
				//we need to hide the settings metabox

				echo "
    <style type='text/css'>
	    #foobar_notification-settings {
			display: none;
	    }
    </style>";

			} else {
				echo "
    <style type='text/css'>
	    #foobar_notification-types {
			display: none;
	    }
    </style>";
			}
		}
	}
}
