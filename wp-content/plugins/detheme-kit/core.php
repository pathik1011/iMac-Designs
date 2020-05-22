<?php

namespace DethemeKit;
/**
 * Class Core
 *
 * Main Core class
 * @since 1.2.0
 */
class Core {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Core The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Core An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required Core core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'detheme-kit', plugins_url( '/assets/js/dethemekit.js', __FILE__ ), [ 'jquery' ], false, true );

	}
	/**
     * Enqueue scripts
     *
     * Enqueue js and css to admin.
     *
     * @since 1.0.0
     * @access public
     */
    public function enqueue_admin(){
        
        wp_register_style( 'dethemekit-css-admin', plugins_url( 'widgets/init/assets/css/dethemekit.css'), \Detheme_Kit::VERSION );
        wp_enqueue_style( 'dethemekit-css-admin' );

    }

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/breadcrumb.php' );
		require_once( __DIR__ . '/widgets/dt-post-title.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Breadcrumb() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\DT_Post_Title() );
	}

	/**
	 *  Core class constructor
	 *
	 * Register Core action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Enqueue admin scripts.
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin'] );
	}
}

// Instantiate Core Class
Core::instance();
