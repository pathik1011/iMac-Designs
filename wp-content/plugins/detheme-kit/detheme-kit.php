<?php
/**
 * Plugin Name:         Detheme Kit for Elementor
 * Plugin URI:          https://vast.detheme.com
 * Description:         Detheme Widgets for elementor.
 * Version:             1.0.0
 * Author:              deTheme
 * Author URI:          https://detheme.com
 * Requires at least:   5.2
 * Tested up to:        5.3
 *
 * Text Domain: detheme-kit
 * Domain Path: /languages/
 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The Hooks
 *
 * @package Calia
 */

if ( ! function_exists( 'detheme_kit_enqueue_scripts' ) ) :

	/**
	 * Enqueue plugin styles.
	 */
	function detheme_kit_enqueue_scripts() {
		wp_register_style( 'dethemekit-panel', plugins_url( '/detheme-kit/widgets/init/assets/css/dethemekit-panel.css'), \Detheme_Kit::VERSION );
		wp_enqueue_style( 'dethemekit-panel' );

		// wp_register_style( 'calia-plugins-style', CALIA_PLUGIN_URL . 'assets/css/plugins.min.css' );
		// wp_enqueue_style( 'calia-plugins-style' );
	}
	add_action( 'wp_enqueue_scripts', 'detheme_kit_enqueue_scripts' );
endif;
/**
 * Main Elementor Detheme Kit Class
 *
 * The init class that runs the Detheme Kit plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Detheme_Kit {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		// $this->init();
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'detheme-kit' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
		// Register ElementsKit widget category
		add_action('elementor/init', [$this, 'elementor_widget_category']);
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'core.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'detheme-kit' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'detheme-kit' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'detheme-kit' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'detheme-kit' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'detheme-kit' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'detheme-kit' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Plugin file
	 *
	 * @since 1.0.0
	 * @var string plugins's root file.
	 */
	static function plugin_file(){
		return __FILE__;
	}

	/**
	 * Plugin url
	 *
	 * @since 1.0.0
	 * @var string plugins's root url.
	 */
	static function plugin_url(){
		return trailingslashit(plugin_dir_url( __FILE__ ));
	}

	/**
	 * Plugin dir
	 *
	 * @since 1.0.0
	 * @var string plugins's root directory.
	 */
	static function plugin_dir(){
		return trailingslashit(plugin_dir_path( __FILE__ ));
	}

    /**
     * Plugin's widget directory.
     *
     * @since 1.0.0
     * @var string widget's root directory.
     */
	static function widget_dir(){
		return self::plugin_dir() . 'widgets/';
	}
    
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'detheme-kit' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'detheme-kit' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'detheme-kit' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Add category.
	 *
	 * Register custom widget category in Elementor's editor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function elementor_widget_category(){
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'dethemekit',
			[
				'title' =>esc_html__( 'Detheme Kit', 'detheme-kit' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		
	}
	
}

// Instantiate Detheme_Kit.
new Detheme_Kit();
