<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Xpertiz
 */

// Core Constants.
define( 'XPERTIZ_THEME_DIR', get_template_directory() );
define( 'XPERTIZ_THEME_URI', get_template_directory_uri() );
// Minimum required PHP version.
define( 'XPERTIZ_THEME_REQUIRED_PHP_VERSION', '5.2.4' );

/**
 * Set global content width
 *
 * @link https://developer.wordpress.com/themes/content-width/
 */
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

/**
 * Global variables
 */
$xpertiz_customizer_panels   = array();
$xpertiz_customizer_settings = array();
$xpertiz_customizer_controls = array(
	'xpertiz-image-selector' => 'Xpertiz_Image_Selector_Control',
	'xpertiz-switcher'       => 'Xpertiz_Switcher_Control',
	'xpertiz-input-slider'   => 'Xpertiz_Input_Slider_Control',
	'xpertiz-alpha-color-picker' => 'Xpertiz_Alpha_Color_Picker_Control',
	'xpertiz-icon-picker' => 'Xpertiz_Icon_Picker_Control',
	'xpertiz-link' => 'Xpertiz_Link_Control',
);

/**
 * Load all core theme function files.
 */
require get_parent_theme_file_path( '/inc/helpers.php' );
require get_parent_theme_file_path( '/inc/hooks.php' );
require get_parent_theme_file_path( '/inc/lib/class-xpertiz-mobile-nav-walker.php' );
require get_parent_theme_file_path( '/inc/lib/webfonts.php' );
require get_parent_theme_file_path( '/inc/lib/class-tgm-plugin-activation.php' );
require get_parent_theme_file_path( '/inc/lib/class-xpertiz-customizer-config.php' );
require get_parent_theme_file_path( '/inc/lib/class-xpertiz-customizer-loader.php' );
require get_parent_theme_file_path( '/inc/lib/class-xpertiz-walker-page.php' );

/**
 * Load panels, sections and settings.
 */
require get_parent_theme_file_path( '/inc/customizer/panels.php' );
require get_parent_theme_file_path( '/inc/customizer/sections.php' );
require get_parent_theme_file_path( '/inc/customizer/settings/general.php' );
require get_parent_theme_file_path( '/inc/customizer/settings/header.php' );
require get_parent_theme_file_path( '/inc/customizer/settings/colors.php' );
require get_parent_theme_file_path( '/inc/customizer/settings/footer.php' );
require get_parent_theme_file_path( '/inc/customizer/settings/default.php' );
require get_parent_theme_file_path( '/inc/customizer/settings/topbar.php' );

/**
 * Class instance init.
 */
$xpertiz_customizer_loader = new Xpertiz_Customizer_Loader();

add_action( 'tgmpa_register', 'xpertiz_register_required_plugins' );

/**
 * Xpertiz TGMPA
 */
function xpertiz_register_required_plugins() {

	$plugins = array(
		array(
			'name'                  => esc_html__( 'Bookly','xpertiz' ),
			'slug'                  => 'bookly-responsive-appointment-booking-tool',
			'required'              => true,
		),
		array(
			'name'                  => esc_html__( 'Detheme Kit for Elementor','xpertiz' ),
			'slug'                  => 'detheme-kit',
			'required'              => true,
			'source'                => 'http://demoimporter.detheme.com/plugins/detheme-kit.zip',
		),
		array(
			'name'                  => esc_html__( 'Elementor','xpertiz' ),
			'slug'                  => 'elementor',
			'required'              => true,
		),
		array(
			'name'                  => esc_html__( 'ElementsKit','xpertiz' ),
			'slug'                  => 'elementskit',
			'required'              => true,
			'source'                => 'http://demoimporter.detheme.com/plugins/elementskit.zip',
		),
		array(
			'name'                  => esc_html__( 'Livemesh Addons for Elementor Page Builder','xpertiz' ),
			'slug'                  => 'addons-for-elementor',
			'required'              => true,
		),
		array(
			'name'                  => esc_html__( 'MetForm','xpertiz' ),
			'slug'                  => 'metform',
			'required'              => true,
		),
		array(
			'name'                  => esc_html__( 'Xpertiz Addon','xpertiz' ),
			'slug'                  => 'xpertiz-addon',
			'required'              => true,
			'source'                => 'http://demoimporter.detheme.com/xpertiz/plugins/xpertiz-addon.zip',
		),
		array(
			'name'                  => esc_html__( 'Vast Demo Import','xpertiz' ),
			'slug'                  => 'vast-demo-import',
			'required'              => true,
			'source'                => 'http://demoimporter.detheme.com/xpertiz/plugins/vast-demo-import.zip',
		),
		array(
			'name'                  => esc_html__( 'WooCommerce','xpertiz' ),
			'slug'                  => 'woocommerce',
			'required'              => false,
		),
	);
	
	$config = array(
		'id'           => 'xpertiz',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}
