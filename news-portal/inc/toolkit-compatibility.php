<?php
/**
 * News Portal - MysteryThemes Toolkit Integration & Compatibility
 *
 * Provides theme-side support and integration for MysteryThemes Toolkit plugin.
 * The Toolkit plugin provides the 8 free News Portal Gutenberg blocks.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 2.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'News_Portal_Toolkit_Integration' ) ) {

	/**
	 * Class News_Portal_Toolkit_Integration
	 */
	class News_Portal_Toolkit_Integration {

		/**
		 * Instance of this class.
		 *
		 * @var News_Portal_Toolkit_Integration
		 */
		private static $instance = null;

		/**
		 * Get instance of the class.
		 *
		 * @return News_Portal_Toolkit_Integration
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
			add_action( 'tgmpa_register', array( $this, 'recommend_toolkit_plugin' ), 20 );
		}

		/**
		 * Add theme support for block editor features when Toolkit is available.
		 *
		 * @return void
		 */
		public function theme_support() {
			// Add support for responsive embeds and wide/full align blocks.
			add_theme_support( 'responsive-embeds' );
			add_theme_support( 'align-wide' );
		}

		/**
		 * Recommend MysteryThemes Toolkit plugin via TGMPA.
		 *
		 * @return void
		 */
		public function recommend_toolkit_plugin() {
			if ( ! function_exists( 'tgmpa' ) ) {
				return;
			}

			$plugins = array(
				array(
					'name'     => esc_html__( 'MysteryThemes Toolkit', 'news-portal' ),
					'slug'     => 'mysterythemes-toolkit',
					'required' => false,
				),
			);

			tgmpa( $plugins );
		}
	}

	News_Portal_Toolkit_Integration::get_instance();
}
