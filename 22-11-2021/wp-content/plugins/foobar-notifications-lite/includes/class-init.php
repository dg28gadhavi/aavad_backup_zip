<?php
namespace FooPlugins\FooBar;

/**
 * FooBar Init Class
 * Runs at the startup of the plugin
 * Assumes after all checks have been made, and all is good to go!
 */

if ( !class_exists( 'FooPlugins\FooBar\Init' ) ) {

	class Init {

		/**
		 * Initialize the plugin by setting localization, filters, and administration functions.
		 */
		public function __construct() {
			//load the plugin text domain
			add_action( 'plugins_loaded', function() {
				load_plugin_textdomain(
					FOOBAR_SLUG,
					false,
					plugin_basename( FOOBAR_FILE ) . '/languages/'
				);
			} );

			new namespace\PostTypes\Notification();

			if ( is_admin() ) {
				new namespace\Admin\Init();
			} else {
				new namespace\Front\Init();
			}

			//Check if the PRO version of FooBar is running and run the PRO code
			if ( foobar_is_pro() ) {
				new namespace\Pro\Init();
			} else {
				if ( is_admin() ) {
					//include PRO promotion
					new namespace\Admin\Promotions();
				}
			}

		}
	}
}
