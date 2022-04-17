<?php
/**
 * Plugin Name: Mobius Studio Elementor
 * Description: Custom Elementor extension by Mobius Studio.
 * Plugin URL: https://plugins.mobius.studio/linna-wp/mobius-studio-elementor.zip
 * Version: 1.0.0
 * Author: Mobius Studio
 * Author URI: https://mobius.studio
 * Contributors: Mobius Studio
 * Text Domain: mobius-studio-elementor
 * Domain Path: languages
 *
 * @package Mobius Studio Elementor
 * @category Mobius Studio Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Mobius_Studio_Elementor {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Mobius_Studio_Elementor The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Mobius_Studio_Elementor An instance of the class.
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'mobius-studio-elementor' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

			return;
		}

		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

			return;
		}

		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );

			return;
		}

		// Add Plugin actions.
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'editor_styles' ] );

	}

	/**
	 * Register and enqueue styles and scripts.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function widget_styles() {

		wp_register_style( 'mobius-studio-elementor', plugins_url( 'assets/css/bundle.css', __FILE__ ), array(), self::VERSION );
		wp_register_script( 'mobius-studio-elementor', plugins_url( 'assets/js/bundle.js', __FILE__ ), array(), self::VERSION, true );

		wp_enqueue_style( 'mobius-studio-elementor' );

		wp_enqueue_script( 'swiper' );

		wp_enqueue_script( 'mobius-studio-elementor' );

	}

	/**
	 * Register and enqueue styles and scripts for Elementor edit mode.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function editor_styles() {

		wp_register_script( 'mobius-studio-elementor-admin', plugins_url( 'assets/js/bundle-admin.js', __FILE__ ), array(), self::VERSION, true );

		wp_enqueue_script( 'mobius-studio-elementor-admin' );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( ( wp_verify_nonce( 'elementor' ) || wp_verify_nonce( 'mobius-studio-elementor' ) ) && isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mobius-studio-elementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'mobius-studio-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mobius-studio-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', esc_html( $message ) );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( ( wp_verify_nonce( 'elementor' ) || wp_verify_nonce( 'mobius-studio-elementor' ) ) && isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mobius-studio-elementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'mobius-studio-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mobius-studio-elementor' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', esc_html( $message ) );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( ( wp_verify_nonce( 'elementor' ) || wp_verify_nonce( 'mobius-studio-elementor' ) ) && isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mobius-studio-elementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'mobius-studio-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mobius-studio-elementor' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', esc_html( $message ) );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include helpers trait.
		require_once plugin_dir_path( __FILE__ ) . 'helpers.php';

		$widgets = [
			'title-with-subtitle-widget' => '\Title_With_Subtitle_Widget',
			'posts-carousel'             => '\Posts_Carousel_Widget',
			'timeline-item'              => '\Timeline_Item_Widget',
		];

		foreach ( $widgets as $file_name => $class_name ) {
			// Include Widget files.
			require_once plugin_dir_path( __FILE__ ) . 'widgets' . DIRECTORY_SEPARATOR . $file_name . DIRECTORY_SEPARATOR . $file_name . '.php';

			// Register widget.
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
		}
	}

	/**
	 * Add Elementor Widget Categories
	 *
	 * Create custom widget category for Mobius Studio
	 *
	 * @param object $elements_manager Elementors category manager.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'mobius-studio',
			[
				'title' => __( 'Mobius Studio', 'mobius-studio-elementor' ),
				'icon'  => 'fa fa-dna',
			]
		);

	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {}

}

Mobius_Studio_Elementor::instance();
