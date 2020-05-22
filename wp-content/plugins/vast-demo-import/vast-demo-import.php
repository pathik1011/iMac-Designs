<?php
/**
 * Plugin Name:         Vast Demo Import
 * Plugin URI:          https://vast.detheme.com
 * Description:         Import the Vast demo content, widgets and customizer settings with one click.
 * Version:             4.0.3
 * Author:              deTheme
 * Author URI:          https://detheme.com
 * Requires at least:   4.0.3
 * Tested up to:        5.3.0
 *
 * Text Domain: vast-demo-import
 * Domain Path: /languages/
 *
 * @package Vast_Demo_Import
 * @category Core
 * @author deTheme
 * @see This plugin is based on: https://github.com/proteusthemes/one-click-demo-import/
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! function_exists( 'vdi_VAST_OCDI_import_files' ) ) :

	/**
	 * Import Data XML, Widget, Customizer and Screenshot.
	 */
	function vdi_VAST_OCDI_import_files() {
		return array(
			array(
				'import_file_name'           => 'Xpertiz Business',
				'import_file_url'            => 'http://demoimporter.detheme.com/xpertiz/xpertiz-business/xpertiz-business.xml',
				'import_widget_file_url'     => 'http://demoimporter.detheme.com/xpertiz/xpertiz-business/xpertiz-business.wie',
				'import_customizer_file_url' => 'http://demoimporter.detheme.com/xpertiz/xpertiz-business/xpertiz-business.dat',
				'import_preview_image_url'   => 'http://demoimporter.detheme.com/xpertiz/xpertiz-business/xpertiz-business.jpg',
				'import_notice'              => __( 'Before you begin, make sure all the required plugins are activated.<br />No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.<br />Posts, pages, images, widgets, menus and other theme settings will get imported.<br />Please click on the Import button only once and wait, it can take a couple of minutes.', 'vdi' ),
				'preview_url'                => 'https://demo.detheme.com/xpertiz-business/',
      		),
			array(
				'import_file_name'           => 'Xpertiz Accounting',
				'import_file_url'            => 'http://demoimporter.detheme.com/xpertiz/xpertiz-accounting/xpertiz-accounting.xml',
				'import_widget_file_url'     => 'http://demoimporter.detheme.com/xpertiz/xpertiz-accounting/xpertiz-accounting.wie',
				'import_customizer_file_url' => 'http://demoimporter.detheme.com/xpertiz/xpertiz-accounting/xpertiz-accounting.dat',
				'import_preview_image_url'   => 'http://demoimporter.detheme.com/xpertiz/xpertiz-accounting/xpertiz-accounting.jpg',
				'import_notice'              => __( 'Before you begin, make sure all the required plugins are activated.<br />No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.<br />Posts, pages, images, widgets, menus and other theme settings will get imported.<br />Please click on the Import button only once and wait, it can take a couple of minutes.', 'vdi' ),
				'preview_url'                => 'https://demo.detheme.com/xpertiz-accounting/',
      		),
			array(
				'import_file_name'           => 'Xpertiz HR',
				'import_file_url'            => 'http://demoimporter.detheme.com/xpertiz/hr/xpertiz-hr.xml',
				'import_widget_file_url'     => 'http://demoimporter.detheme.com/xpertiz/hr/xpertiz-hr.wie',
				'import_customizer_file_url' => 'http://demoimporter.detheme.com/xpertiz/hr/xpertiz-hr.dat',
				'import_preview_image_url'   => 'http://demoimporter.detheme.com/xpertiz/hr/xpertiz-hr.jpg',
				'import_notice'              => __( 'Before you begin, make sure all the required plugins are activated.<br />No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.<br />Posts, pages, images, widgets, menus and other theme settings will get imported.<br />Please click on the Import button only once and wait, it can take a couple of minutes.', 'vdi' ),
				'preview_url'                => 'https://demo.detheme.com/xpertiz-hr/',
      		),
			array(
				'import_file_name'           => 'Xpertiz IT',
				'import_file_url'            => 'http://demoimporter.detheme.com/xpertiz/it/xpertiz-it.xml',
				'import_widget_file_url'     => 'http://demoimporter.detheme.com/xpertiz/it/xpertiz-it.wie',
				'import_customizer_file_url' => 'http://demoimporter.detheme.com/xpertiz/it/xpertiz-it.dat',
				'import_preview_image_url'   => 'http://demoimporter.detheme.com/xpertiz/it/xpertiz-it.jpg',
				'import_notice'              => __( 'Before you begin, make sure all the required plugins are activated.<br />No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.<br />Posts, pages, images, widgets, menus and other theme settings will get imported.<br />Please click on the Import button only once and wait, it can take a couple of minutes.', 'vdi' ),
				'preview_url'                => 'https://demo.detheme.com/xpertiz-it/',
      		),
			array(
				'import_file_name'           => 'Xpertiz Commerce',
				'import_file_url'            => 'http://demoimporter.detheme.com/xpertiz/xpertiz-commerce/xpertiz-commerce.xml',
				'import_widget_file_url'     => 'http://demoimporter.detheme.com/xpertiz/xpertiz-commerce/xpertiz-commerce.wie',
				'import_customizer_file_url' => 'http://demoimporter.detheme.com/xpertiz/xpertiz-commerce/xpertiz-commerce.dat',
				'import_preview_image_url'   => 'http://demoimporter.detheme.com/xpertiz/xpertiz-commerce/xpertiz-commerce.jpg',
				'import_notice'              => __( 'Before you begin, make sure all the required plugins are activated.<br />No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.<br />Posts, pages, images, widgets, menus and other theme settings will get imported.<br />Please click on the Import button only once and wait, it can take a couple of minutes.', 'vdi' ),
				'preview_url'                => 'https://demo.detheme.com/xpertiz-commerce/',
      		),
			  array(
				'import_file_name'           => 'Xpertiz Social',
				'import_file_url'            => 'http://demoimporter.detheme.com/xpertiz/social/xpertiz-social.xml',
				'import_widget_file_url'     => 'http://demoimporter.detheme.com/xpertiz/social/xpertiz-social.wie',
				'import_customizer_file_url' => 'http://demoimporter.detheme.com/xpertiz/social/xpertiz-social.dat',
				'import_preview_image_url'   => 'http://demoimporter.detheme.com/xpertiz/social/xpertiz-social.jpg',
				'import_notice'              => __( 'Before you begin, make sure all the required plugins are activated.<br />No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.<br />Posts, pages, images, widgets, menus and other theme settings will get imported.<br />Please click on the Import button only once and wait, it can take a couple of minutes.', 'vdi' ),
				'preview_url'                => 'https://demo.detheme.com/xpertiz-social/',
      		),
		);
	}
	add_filter( 'vt-VAST_OCDI/import_files', 'vdi_VAST_OCDI_import_files' );

endif;

if ( ! function_exists( 'vdi_after_import_setup' ) ) :

	/**
	 * Set Default Homepage Display with A Static page (Homepage & Posts page)
	 */
	function vdi_after_import_setup( $selected_import ) {
		$menus = wp_get_nav_menus(); // registered menus

		foreach($menus as $menu) {
			if ( $menu->slug==='main-menu' ) {
				$locations['main_menu'] = $menu->term_id;
			}
		}
		
		set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
		// Assign front page and posts page (blog page).

		$blog_page_id  = get_page_by_title( 'Blog' );

		switch ($selected_import['import_file_name']) {
			case 'Xpertiz Business':
				$front_page_id = get_page_by_title( 'Home' );
				update_option( 'bookly_app_color', '#355ebd' );
				break;
			case 'Xpertiz Accounting':
				$front_page_id = get_page_by_title( 'Home' );
				$blog_page_id  = '';
				update_option( 'bookly_app_color', '#ffb600' );
				break;
			case 'Xpertiz HR':
				$front_page_id = get_page_by_title( 'Home' );
				$blog_page_id  = '';
				update_option( 'bookly_app_color', '#cb0000' );
				break;
			case 'Xpertiz IT':
				$front_page_id = get_page_by_title( 'Home' );
				update_option( 'bookly_app_color', '#98cc00' );
				break;
			case 'Xpertiz Commerce':
				$front_page_id = get_page_by_title( 'ecommerce' );
				update_option( 'bookly_app_color', '#ca3200' );
				break;
			case 'Xpertiz Social':
				$front_page_id = get_page_by_title( 'Home II' );
				update_option( 'bookly_app_color', '#606af0' );
				break;
			default:
				$front_page_id = get_page_by_title( 'Home' );
				update_option( 'bookly_app_color', '#355ebd' );
		}
		
		
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
	}

	add_action( 'vt-VAST_OCDI/after_import', 'vdi_after_import_setup' );
endif;



if ( ! function_exists( 'vdi_enqueue_gooogle_font' ) ) :

	/**
	 * Enqueues a Google Font
	 *
	 * @since 1.0.0
	 * @param array $font   An array of arguments.
	 */
	function vdi_enqueue_gooogle_font( $font ) {

		$google_fonts = vdi_google_fonts_list();

		$font_stack = [];

		$url = 'https://fonts.googleapis.com/css?family=';

		foreach ( $font as $font_slug ) {
			foreach ( $google_fonts as $key => $value ) {
				$font_name = array_keys( $value );
				$font_name = $font_name[0];

				if ( $font_slug === $font_name ) {

					$family = trim( $value[ $font_slug ]['family'] );
					$family = str_replace( ' ', '+', $family );

					$url .= $family . ':';

					$variants = implode( ',', $value[ $font_slug ]['variants'] );

					$url .= $variants . '|';

				}
			}
		}

		$url = substr( $url, 0, -1 );

		wp_enqueue_style( 'vast-google-font', $url, false, false, 'all' );
	}

endif;

if ( ! function_exists( 'vdi_load_fonts' ) ) :

	/**
	 * Load Font Google.
	 */
	function vdi_load_fonts() {

		$font_choosen = [ 'Lato', 'Montserrat', 'Merriweather' ];

		if ( ! is_array( $font_choosen ) ) {
			return;
		}

		$font_slug = array_map(
			function( $font_choosen ) {

					$font_choosen = strtolower( trim( $font_choosen ) );
					$font_choosen = preg_replace( '/[^a-z0-9-]/', '-', $font_choosen );
					$font_choosen = preg_replace( '/-+/', '-', $font_choosen );

					return $font_choosen;

			}, $font_choosen
		);

		vdi_enqueue_gooogle_font( $font_slug );

	}

	add_action( 'admin_enqueue_scripts', 'vdi_load_fonts' );

endif;

function vdi_enqueue_style() {
	wp_enqueue_style( 'vast-font-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_register_style( 'vdi-elements-anywhere', PT_VVAST_OCDI_URL . 'assets/css/ea.css' );
	wp_enqueue_style( 'vdi-elements-anywhere' );
}
add_action( 'admin_enqueue_scripts', 'vdi_enqueue_style' );


function vdi_confirmation_dialog_options( $options ) {
	return array_merge(
		$options, array(
			'width'       => 600,
			'dialogClass' => 'wp-dialog',
			'resizable'   => false,
			'height'      => 'auto',
			'modal'       => true,
		)
	);
}
add_filter( 'vt-VAST_OCDI/confirmation_dialog_options', 'vdi_confirmation_dialog_options', 10, 1 );

function vdi_plugin_intro_text( $default_text ) {
	// Database reset url
	if ( is_plugin_active( 'wordpress-database-reset/wp-reset.php' ) ) {
		$plugin_link = admin_url( 'tools.php?page=database-reset' );
	} else {
		$plugin_link = admin_url( 'plugin-install.php?s=WordPress+Database+Reset&tab=search' );
	}
	$default_text .= sprintf(
		esc_html__( 'Importing demo data allow you to quickly edit everything instead of creating content from scratch. It is recommended uploading sample data on a fresh WordPress install to prevent conflicts with your current content. You can use this plugin to reset your site if needed: %1$sWordpress Database Reset%2$s', 'ocean-extra' ), '<a href="' . $plugin_link . '" target="_blank">', '</a>'
	);
	return $default_text;
}
add_filter( 'vt-VAST_OCDI/plugin_intro_text', 'vdi_plugin_intro_text' );
add_filter( 'vt-VAST_OCDI/disable_pt_branding', '__return_true' );

/**
 * Main plugin class with initialization tasks.
 */
class VDI_VAST_OCDI_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.3.2.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '5.3.2', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'vdi_old_php_admin_error_notice' ) );
		} else {
			// Set plugin constants.
			$this->vdi_set_plugin_constants();

			// Composer autoloader.
			require_once PT_VVAST_OCDI_PATH . 'vendor/autoload.php';

			// Register Fonts.
			require_once PT_VVAST_OCDI_PATH . 'inc/webfonts.php';

			// Instantiate the main plugin class *Singleton*.
			$pt_one_click_demo_import = VAST_OCDI\VastDemoImporter::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'VAST_OCDI list', array( 'VAST_OCDI\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'VAST_OCDI import', array( 'VAST_OCDI\WPCLICommands', 'import' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	public function vdi_old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sVast Demo Import%3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'vdi' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function vdi_set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'PT_VVAST_OCDI_PATH' ) ) {
			define( 'PT_VVAST_OCDI_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'PT_VVAST_OCDI_URL' ) ) {
			define( 'PT_VVAST_OCDI_URL', plugin_dir_url( __FILE__ ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'vdi_set_plugin_version_constant' ) );
	}


	/**
	 * Set plugin version constant -> PT_VVAST_OCDI_VERSION.
	 */
	public function vdi_set_plugin_version_constant() {
		if ( ! defined( 'PT_VVAST_OCDI_VERSION' ) ) {
			$plugin_data = get_plugin_data( __FILE__ );
			define( 'PT_VVAST_OCDI_VERSION', $plugin_data['Version'] );
		}
	}
}

// Instantiate the plugin class.
$VAST_OCDI_plugin = new VDI_VAST_OCDI_Plugin();
