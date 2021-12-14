<?php
/**
 * Plugin review class.
 * Prompts users to give a review of the plugin on WordPress.org after a period of usage.
 *
 * Heavily based on code by Rhys Wynne
 * https://winwar.co.uk/2014/10/ask-wordpress-plugin-reviews-week/
 *
 * @package Wc_Document_Preview
 */

if ( ! class_exists( 'WC_Document_Preview_Admin_Feedback' ) ) :

	/**
	 * The feedback.
	 */
	class WC_Document_Preview_Admin_Feedback {

		/**
		 * Slug.
		 *
		 * @var string $slug
		 */
		private $slug;

		/**
		 * Name.
		 *
		 * @var string $name
		 */
		private $name;

		/**
		 * Time limit.
		 *
		 * @var string $time_limit
		 */
		private $time_limit;

		/**
		 * No Bug Option.
		 *
		 * @var string $nobug_option
		 */
		public $nobug_option;

		/**
		 * Activation Date Option.
		 *
		 * @var string $date_option
		 */
		public $date_option;

		/**
		 * Class constructor.
		 *
		 * @param string $args Arguments.
		 */
		public function __construct( $args ) {
			$this->slug = $args['slug'];
			$this->name = $args['name'];

			$this->date_option  = $this->slug . '_activation_date';
			$this->nobug_option = $this->slug . '_no_bug';

			if ( isset( $args['time_limit'] ) ) {
				$this->time_limit = $args['time_limit'];
			} else {
				$this->time_limit = WEEK_IN_SECONDS;
			}

			// Add actions.
			add_action( 'admin_init', array( $this, 'check_installation_date' ) );
			add_action( 'admin_init', array( $this, 'set_no_bug' ), 5 );
		}

		/**
		 * Seconds to words.
		 *
		 * @param string $seconds Seconds in time.
		 */
		public function seconds_to_words( $seconds ) {

			// Get the years.
			$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
			if ( $years > 1 ) {
				/* translators: Number of years */
				return sprintf( __( '%s years', 'wc-document-preview' ), $years );
			} elseif ( $years > 0 ) {
				return __( 'a year', 'wc-document-preview' );
			}

			// Get the weeks.
			$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
			if ( $weeks > 1 ) {
				/* translators: Number of weeks */
				return sprintf( __( '%s weeks', 'wc-document-preview' ), $weeks );
			} elseif ( $weeks > 0 ) {
				return __( 'a week', 'wc-document-preview' );
			}

			// Get the days.
			$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
			if ( $days > 1 ) {
				/* translators: Number of days */
				return sprintf( __( '%s days', 'wc-document-preview' ), $days );
			} elseif ( $days > 0 ) {
				return __( 'a day', 'wc-document-preview' );
			}

			// Get the hours.
			$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
			if ( $hours > 1 ) {
				/* translators: Number of hours */
				return sprintf( __( '%s hours', 'wc-document-preview' ), $hours );
			} elseif ( $hours > 0 ) {
				return __( 'an hour', 'wc-document-preview' );
			}

			// Get the minutes.
			$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
			if ( $minutes > 1 ) {
				/* translators: Number of minutes */
				return sprintf( __( '%s minutes', 'wc-document-preview' ), $minutes );
			} elseif ( $minutes > 0 ) {
				return __( 'a minute', 'wc-document-preview' );
			}

			// Get the seconds.
			$seconds = intval( $seconds ) % 60;
			if ( $seconds > 1 ) {
				/* translators: Number of seconds */
				return sprintf( __( '%s seconds', 'wc-document-preview' ), $seconds );
			} elseif ( $seconds > 0 ) {
				return __( 'a second', 'wc-document-preview' );
			}
		}

		/**
		 * Check date on admin initiation and add to admin notice if it was more than the time limit.
		 */
		public function check_installation_date() {
			if ( ! get_site_option( $this->nobug_option ) || false === get_site_option( $this->nobug_option ) ) {
				add_site_option( $this->date_option, time() );

				// Retrieve the activation date.
				$install_date = get_site_option( $this->date_option );

				// If difference between install date and now is greater than time limit, then display notice.
				if ( ( time() - $install_date ) > $this->time_limit ) {
					add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
				}
			}
		}

		/**
		 * Display the admin notice.
		 */
		public function display_admin_notice() {
			$screen = get_current_screen();

			if ( isset( $screen->base ) && 'plugins' === $screen->base ) {
				$no_bug_url = wp_nonce_url( admin_url( '?' . $this->nobug_option . '=true' ), 'wc-document-preview-feedback-nounce' );
				$time       = $this->seconds_to_words( time() - get_site_option( $this->date_option ) );
				?>

<style>
.notice.wc-document-preview-notice {
	border-left-color: #008ec2 !important;
	padding: 20px;
}

.rtl .notice.wc-document-preview-notice {
	border-right-color: #008ec2 !important;
}

.notice.notice.wc-document-preview-notice .wc-document-preview-notice-inner {
	display: table;
	width: 100%;
}

.notice.wc-document-preview-notice .wc-document-preview-notice-inner .wc-document-preview-notice-icon,
.notice.wc-document-preview-notice .wc-document-preview-notice-inner .wc-document-preview-notice-content,
.notice.wc-document-preview-notice .wc-document-preview-notice-inner .wc-document-preview-install-now {
	display: table-cell;
	vertical-align: middle;
}

.notice.wc-document-preview-notice .wc-document-preview-notice-icon {
	color: #509ed2;
	font-size: 50px;
	width: 60px;
}

.notice.wc-document-preview-notice .wc-document-preview-notice-icon img {
	width: 64px;
}

.notice.wc-document-preview-notice .wc-document-preview-notice-content {
	padding: 0 40px 0 20px;
}

.notice.wc-document-preview-notice p {
	padding: 0;
	margin: 0;
}

.notice.wc-document-preview-notice h3 {
	margin: 0 0 5px;
}

.notice.wc-document-preview-notice .wc-document-preview-install-now {
	text-align: center;
}

.notice.wc-document-preview-notice .wc-document-preview-install-now .wc-document-preview-install-button {
	padding: 6px 50px;
	height: auto;
	line-height: 20px;
}

.notice.wc-document-preview-notice a.no-thanks {
	display: block;
	margin-top: 10px;
	color: #72777c;
	text-decoration: none;
}

.notice.wc-document-preview-notice a.no-thanks:hover {
	color: #444;
}

@media (max-width: 767px) {

	.notice.notice.wc-document-preview-notice .wc-document-preview-notice-inner {
		display: block;
	}

	.notice.wc-document-preview-notice {
		padding: 20px !important;
	}

	.notice.wc-document-preview-noticee .wc-document-preview-notice-inner {
		display: block;
	}

	.notice.wc-document-preview-notice .wc-document-preview-notice-inner .wc-document-preview-notice-content {
		display: block;
		padding: 0;
	}

	.notice.wc-document-preview-notice .wc-document-preview-notice-inner .wc-document-preview-notice-icon {
		display: none;
	}

	.notice.wc-document-preview-notice .wc-document-preview-notice-inner .wc-document-preview-install-now {
		margin-top: 20px;
		display: block;
		text-align: left;
	}

	.notice.wc-document-preview-notice .wc-document-preview-notice-inner .no-thanks {
		display: inline-block;
		margin-left: 15px;
	}
}
</style>
			<div class="notice updated wc-document-preview-notice">
				<div class="wc-document-preview-notice-inner">
					<div class="wc-document-preview-notice-icon">
						<img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/wo_document_preview.png'; ?>" alt="<?php echo esc_attr__( 'Woo Document Preview', 'wc-document-preview' ); ?>" />
					</div>
					<div class="wc-document-preview-notice-content">
						<h3><?php echo esc_html__( 'Are you enjoying Woo Document Preview?', 'wc-document-preview' ); ?></h3>
						<p>
							<?php /* translators: 1. Name */ ?>
							<?php printf( esc_html__( 'We hope you\'re enjoying %1$s! Could you please do us a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'wc-document-preview' ), esc_html( $this->name ) ); ?>
						</p>
					</div>
					<div class="wc-document-preview-install-now">
						<?php printf( '<a href="%1$s" class="button button-primary wc-document-preview-install-button" target="_blank">%2$s</a>', esc_url( 'https://wordpress.org/support/plugin/woo-document-preview/reviews/#new-post' ), esc_html__( 'Leave a Review', 'wc-document-preview' ) ); ?>
						<a href="<?php echo esc_url( $no_bug_url ); ?>" class="no-thanks"><?php echo esc_html__( 'No thanks / I already have', 'wc-document-preview' ); ?></a>
					</div>
				</div>
			</div>
				<?php
			}
		}

		/**
		 * Set the plugin to no longer bug users if user asks not to be.
		 */
		public function set_no_bug() {

			// Bail out if not on correct page.
			if ( ! isset( $_GET['_wpnonce'] ) || ( ! wp_verify_nonce( $_GET['_wpnonce'], 'wc-document-preview-feedback-nounce' ) || ! is_admin() || ! isset( $_GET[ $this->nobug_option ] ) || ! current_user_can( 'manage_options' ) ) ) {
				return;
			}

			add_site_option( $this->nobug_option, true );
		}
	}
endif;

/*
* Instantiate the WC_Document_Preview_Admin_Feedback class.
*/
new WC_Document_Preview_Admin_Feedback(
	array(
		'slug'       => 'wc_document_preview',
		'name'       => __( 'Woo Document Preview', 'wc-document-preview' ),
		'time_limit' => WEEK_IN_SECONDS,
	)
);
