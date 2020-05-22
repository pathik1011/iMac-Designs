<?php
/**
 * The Hooks
 *
 * @package Xpertiz
 */

if ( ! function_exists( 'xpertiz_theme_setup' ) ) :

	/**
	 * Theme Setup.
	 */
	function xpertiz_theme_setup() {
		// Add default features.
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );

		// Add available post formats.
		add_theme_support(
			'post-formats', array(
				'video',
				'gallery',
				'audio',
				'quote',
				'link',
			)
		);

		// Add logo.
		add_theme_support(
			'custom-logo', array(
				'width'       => 250,
				'height'      => 65,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Post thumbnail.
		add_theme_support(
			'post-thumbnails', array(
				'post',
				'page',
			)
		);

		// Woocommerce.
		add_theme_support( 'woocommerce' );

		// Gutenberg.
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support(
			'editor-color-palette', array(
				array(
					'name' => __( 'Brand', 'xpertiz' ),
					'slug' => 'brand',
					'color' => '#355EBD',
				),
				array(
					'name' => __( 'Welirang', 'xpertiz' ),
					'slug' => 'welirang',
					'color' => '#333333',
				),
				array(
					'name' => __( 'Bromo', 'xpertiz' ),
					'slug' => 'bromo',
					'color' => '#6b6b6b',
				),
				array(
					'name' => __( 'Semeru', 'xpertiz' ),
					'slug' => 'semeru',
					'color' => '#aeaeae',
				),
				array(
					'name' => __( 'Lawu', 'xpertiz' ),
					'slug' => 'lawu',
					'color' => '#e3e3e3',
				),
				array(
					'name' => __( 'Sempu', 'xpertiz' ),
					'slug' => 'sempu',
					'color' => '#ffffff',
				),
				array(
					'name' => __( 'Indrayanti', 'xpertiz' ),
					'slug' => 'indrayanti',
					'color' => 'rgba(255, 255, 255, 0.6)',
				),
				array(
					'name' => __( 'Kenjeran', 'xpertiz' ),
					'slug' => 'kenjeran',
					'color' => 'rgba(255, 255, 255, 0.4)',
				),
				array(
					'name' => __( 'Sedahan', 'xpertiz' ),
					'slug' => 'sedahan',
					'color' => 'rgba(255, 255, 255, 0.2)',
				),
				array(
					'name' => __( 'Toba1', 'xpertiz' ),
					'slug' => 'toba1',
					'color' => '#dc3545',
				),
				array(
					'name' => __( 'Toba2', 'xpertiz' ),
					'slug' => 'toba2',
					'color' => '#28a745',
				),
				array(
					'name' => __( 'Rating', 'xpertiz' ),
					'slug' => 'rating',
					'color' => '#febc00',
				),
				array(
					'name' => __( 'Facebook', 'xpertiz' ),
					'slug' => 'facebook',
					'color' => '#3b5998',
				),
				array(
					'name' => __( 'Twitter', 'xpertiz' ),
					'slug' => 'twitter',
					'color' => '#1da1f2',
				),
				array(
					'name' => __( 'Google+', 'xpertiz' ),
					'slug' => 'google-plus',
					'color' => '#f12f26',
				),
			)
		);

		// Banner / Header Image.
		register_default_headers(
			array(
				'wheel' => array(
					'url'           => '%s/assets/images/header.jpg',
					'thumbnail_url' => '%s/assets/images/header-thumbnail.jpg',
					'description'   => esc_html__( 'Default Header', 'xpertiz' ),
				),
			)
		);

		add_theme_support(
			'custom-header', array(
				'width'       => 1920,
				'height'      => 380,
				'flex-height' => false,
				'flex-width'  => false,
				'uploads'     => true,
				'header-text' => false,
			)
		);

		// Image size.
		add_image_size( 'xpertiz-banner-size', 1920, 380, array( 'center', 'center' ) );

		// Add Menus.
		register_nav_menus(
			array(
				'main_menu'       => esc_html__( 'Main', 'xpertiz' ),
			)
		);

		// Translate text from .mo files.
		load_theme_textdomain( 'xpertiz', XPERTIZ_THEME_DIR . '/languages' );
	}

	add_action( 'after_setup_theme', 'xpertiz_theme_setup' );

endif;

if ( ! function_exists( 'xpertiz_gallery_theme_setup' ) ) :

	/**
	 * WooCommerce Lightbox
	 */
	function xpertiz_gallery_theme_setup() {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	add_action( 'after_setup_theme', 'xpertiz_gallery_theme_setup' );

endif;

if ( ! function_exists( 'xpertiz_assets' ) ) :

	/**
	 * Register all css file.
	 */
	function xpertiz_assets() {
		// Register css file in here.
		// Get theme info.
		$theme_info = wp_get_theme();

		/**
		 * Load Vendor Scripts.
		 */
		// Poppper.
		if ( 'xpertiz-dropdown-style' === xpertiz_theme_setting( 'dropdown-layout' ) ) {
			// Selectize.js for dropdowns.
			wp_enqueue_style( 'selectize', get_theme_file_uri( '/assets/vendors/selectize/css/selectize.css' ), array(), null );
			wp_enqueue_script( 'selectize', get_theme_file_uri( '/assets/vendors/selectize/js/selectize.min.js' ), array(), null, true );
			wp_enqueue_script( 'dropdown', get_theme_file_uri( '/assets/vendors/selectize/js/dropdown.js' ), array(), null, true );
			wp_enqueue_script( 'dropdown-hover', get_theme_file_uri( '/assets/vendors/selectize/js/dropdownhover.js' ), array(), null, true );
		}

		if ( 'xpertiz-sticky' === xpertiz_theme_setting( 'sticky-layout' ) ) {
			// Headroom.js script.
			wp_enqueue_script( 'headroom', get_theme_file_uri( '/assets/vendors/headroom/headroom.min.js' ), array(), null, true );
			wp_enqueue_script( 'sticky-header', get_theme_file_uri( '/assets/vendors/headroom/sticky-header.js' ), array(), null, true );
		}

		if ( 'xpertiz-header-parallax' === xpertiz_theme_setting( 'parallax-layout' ) ) {
			// rellax.js script.
			wp_enqueue_script( 'rellax', get_theme_file_uri( '/assets/vendors/rellax/rellax.min.js' ), array(), null, true );
			wp_enqueue_script( 'rellax-banner', get_theme_file_uri( '/assets/vendors/rellax/banner.js' ), array(), null, true );
		}

		if ( 'xpertiz-masonry-layout' === xpertiz_theme_setting( 'style-layout' ) ) {
			wp_enqueue_script( 'masonry', '', array( 'imagesloaded' ), null, true );
			wp_enqueue_script( 'modernizr', get_theme_file_uri( '/assets/vendors/modernizr/modernizr-custom.min.js' ), array(), null, true );
			wp_enqueue_script( 'classie', get_theme_file_uri( '/assets/vendors/classie/classie.js' ), array(), null, true );
			wp_enqueue_script( 'anim-on-scroll', get_theme_file_uri( '/assets/vendors/anim-on-scroll/anim-on-scroll.js' ), array(), null, true );
		}

		/**
		 * Theme Scripts.
		 */
		// Custom Bootstrap.
		wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.min.css' ), array(), null );
		wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), null, true );

		// Load all javascripts.
		wp_enqueue_style( 'xpertiz-theme-style', get_theme_file_uri( '/assets/css/theme.min.css' ), array(), $theme_info->get( 'Version' ) );
		wp_enqueue_script( 'xpertiz-theme-js', get_theme_file_uri( '/assets/js/theme.min.js' ), array( 'jquery' ), $theme_info->get( 'Version' ), true );

		/**
		 * Load Main Style.
		 */
		wp_enqueue_style( 'xpertiz-style', get_theme_file_uri( 'style.css' ), array(), null );

		if ( is_rtl() ) {
			wp_style_add_data( 'xpertiz-theme-style', 'rtl', 'replace' );
		}

		// Comments script.
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			wp_enqueue_script( 'masonry', '', array( 'imagesloaded' ), null, true );
			wp_enqueue_script( 'modernizr', get_theme_file_uri( '/assets/vendors/modernizr/modernizr-custom.min.js' ), array(), null, true );
			wp_enqueue_script( 'classie', get_theme_file_uri( '/assets/vendors/classie/classie.js' ), array(), null, true );
			wp_enqueue_script( 'anim-on-scroll-shop', get_theme_file_uri( '/assets/vendors/anim-on-scroll/anim-on-scroll-shop.js' ), array(), null, true );
		}

		if ( class_exists( 'WooCommerce' ) && is_product() ) {
			wp_dequeue_script( 'dropdown' );
		}

		// Custom Style.
		wp_enqueue_style( 'xpertiz-custom-style', get_theme_file_uri( '/assets/css/custom.css' ), array(), null );
	}

	add_action( 'wp_enqueue_scripts', 'xpertiz_assets' );

endif;

if ( ! function_exists( 'xpertiz_fonts_callback' ) ) :
	/**
	 * Font format callback.
	 *
	 * @param string $font_choosen   font name.
	 */
	function xpertiz_fonts_callback( $font_choosen ) {

		$font_choosen = strtolower( trim( $font_choosen ) );
		$font_choosen = preg_replace( '/[^a-z0-9-]/', '-', $font_choosen );
		$font_choosen = preg_replace( '/-+/', '-', $font_choosen );

		return $font_choosen;

	}
endif;

if ( ! function_exists( 'xpertiz_load_fonts' ) ) :
	/**
	 * Load Font Google.
	 */
	function xpertiz_load_fonts() {

		// Variabel ini digunakan untuk menampung variabel jenis font family yang akan diload, dalam bentuk array.
		$font_choosen = array( 'Lato', 'Montserrat', 'Merriweather' );

		if ( ! is_array( $font_choosen ) ) {
			return;
		}

		$font_slug = array_map( 'xpertiz_fonts_callback', $font_choosen );

		xpertiz_enqueue_gooogle_font( $font_slug );

	}

	add_action( 'wp_enqueue_scripts', 'xpertiz_load_fonts' );

endif;

if ( ! function_exists( 'xpertiz_body_classes' ) ) :

	/**
	 * Xpertiz Body Class
	 *
	 * @param array $classes HTML Class.
	 * @return string
	 */
	function xpertiz_body_classes( $classes ) {
		$classes[] = esc_attr( xpertiz_theme_setting( 'blog-type' ) );

		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$classes[] = esc_attr( 'xpertiz-masonry-layout' );

		} else {
			if ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) {
				$classes[] = esc_attr( 'xpertiz-classic-layout' );
			} else {
				$classes[] = esc_attr( xpertiz_theme_setting( 'style-layout' ) );
			}
		}
		$classes[] = esc_attr( xpertiz_theme_setting( 'blog-layout' ) );
		$classes[] = esc_attr( xpertiz_theme_setting( 'header_image_show_frontpage' ) );
		$classes[] = esc_attr( xpertiz_theme_setting( 'header_image_show_on_product' ) );

		$classes[] = 'sidebar-none' === xpertiz_theme_setting( 'sidebar-layout' ) || is_active_sidebar( 'sidebar' ) === false ? 'no-sidebar' : 'has-sidebar';

		$classes[] = esc_attr( xpertiz_theme_setting( 'sidebar-layout' ) );
		$classes[] = esc_attr( xpertiz_theme_setting( 'sticky-layout' ) );

		return $classes;
	}

	add_filter( 'body_class', 'xpertiz_body_classes' );

endif;

if ( ! function_exists( 'xpertiz_header_template' ) ) :

	/**
	 * Xpertiz Header Template
	 */
	function xpertiz_header_template() {
		get_template_part( 'template-parts/header/layout' );

		get_template_part( 'template-parts/header/banner' );
	}

	add_action( 'xpertiz_header', 'xpertiz_header_template' );

endif;

if ( ! function_exists( 'xpertiz_related_post_template' ) ) :

	/**
	 * Xpertiz Header Template
	 */
	function xpertiz_related_post_template() {
		get_template_part( 'template-parts/header/layout' );

		if ( has_header_image() && ! is_404() ) {
			get_template_part( 'template-parts/header/banner' );
		}
	}

	add_action( 'xpertiz_related_post', 'xpertiz_related_post_template' );

endif;

if ( ! function_exists( 'xpertiz_widgets' ) ) :

	/**
	 * Register sidebar and footer widgets.
	 */
	function xpertiz_widgets() {
		if ( 'xpertiz-blog-type-gutenberg-ready' !== xpertiz_theme_setting( 'blog-type' ) ) :
			// Sidebar.
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar', 'xpertiz' ),
					'id'            => 'sidebar',
					'description'   => esc_html__( 'This sidebar area will be shown on blog page.', 'xpertiz' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		endif;

		// 1st Footer.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 1', 'xpertiz' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Widgets in this area will be shown in leftmost column in footer in each page.', 'xpertiz' ),
				'before_widget' => '<section id="%1$s" class="widget uf-dark-scheme %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// 2nd Footer.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 2', 'xpertiz' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Widgets in this area will be shown in 2nd column in footer in each page.', 'xpertiz' ),
				'before_widget' => '<section id="%1$s" class="widget uf-dark-scheme %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// 3rd Footer.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 3', 'xpertiz' ),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Widgets in this area will be shown in 3rd column in footer in each page..', 'xpertiz' ),
				'before_widget' => '<section id="%1$s" class="widget uf-dark-scheme %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// 4th Footer.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 4', 'xpertiz' ),
				'id'            => 'footer-4',
				'description'   => esc_html__( 'Widgets in this area will be shown in rightmost column in footer in each page.', 'xpertiz' ),
				'before_widget' => '<section id="%1$s" class="widget uf-dark-scheme %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	add_action( 'widgets_init', 'xpertiz_widgets' );

endif;

if ( ! function_exists( 'xpertiz_add_classes_on_li' ) ) :

	/**
	 * Add bootstrap class on menu li.
	 *
	 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
	 * @param object $item    Menu item data object.
	 * @param array  $args    An array of arguments. @see wp_nav_menu().
	 * @param int    $depth   Depth of menu item.
	 */
	function xpertiz_add_classes_on_li( $classes, $item, $args, $depth ) {
		// for header navigation only, not widget.
		if ( ! empty( $args->menu_id ) ) {
			if ( 'header_navigation' === $args->menu_id ) {
				if ( in_array( 'menu-item-has-children', $classes, false ) ) {
					$classes[] = 'dropdown';

					if ( $depth > 0 ) {
						if ( is_rtl() ) {
							$classes[] = 'icon-chevron-left';
						} else {
							$classes[] = 'icon-chevron-right';
						}
					} else {
						$classes[] = 'icon-chevron-down';
					}
				}

				if ( 0 === $depth ) {
					$classes[] = 'd-flex align-items-center';
				}
			}
		}

		$classes[] = 'nav-item';
		return $classes;
	}

	add_filter( 'nav_menu_css_class','xpertiz_add_classes_on_li', 1, 4 );

endif;

if ( ! function_exists( 'xpertiz_add_classes_on_link' ) ) :

	/**
	 * Add bootstrap class on menu anchor tag.
	 *
	 * @param array  $atts    The CSS classes that applied to the menu link's <a>.
	 * @param object $item    Menu item data object.
	 * @param array  $args    An array of arguments. @see wp_nav_menu().
	 */
	function xpertiz_add_classes_on_link( $atts, $item, $args ) {
		// for header navigation only, not widget.
		if ( ! empty( $args->menu_id ) ) {
			if ( 'header_navigation' === $args->menu_id ) {
				if ( in_array( 'menu-item-has-children', $item->classes, false ) ) {
					$atts['class'] = 'nav-link dropdown-item dropdown-toggle';
				} else {
					$atts['class'] = 'nav-link';
				}
			} else {
				$atts['class'] = 'nav-link';
			}
		}

		return $atts;
	}

	add_filter( 'nav_menu_link_attributes','xpertiz_add_classes_on_link', 10, 3 );

endif;

if ( ! function_exists( 'xpertiz_add_classes_on_submenu' ) ) :

	/**
	 * Add bootstrap class on submenu anchor tag.
	 *
	 * @param array $classes    The CSS classes that are applied to the menu <ul> element.
	 * @param array $args    An array of arguments. @see wp_nav_menu().
	 * @param int   $depth    Depth of menu item. Used for padding.
	 */
	function xpertiz_add_classes_on_submenu( $classes, $args, $depth ) {
		if ( 'header_navigation' === $args->menu_id ) {
			if ( $depth > 0 ) {
				$classes[] = 'uf-submenu-right dropdown-menu arrow_box';
			} else {
				$classes[] = 'dropdown-menu uf-submenu';
			}
		}

		return $classes;
	}

	add_filter( 'nav_menu_submenu_css_class','xpertiz_add_classes_on_submenu', 10, 3 );
endif;

if ( ! function_exists( 'xpertiz_add_submenu_arrow_on_mobile_menu' ) ) :

	/**
	 * Add submenu arrow on mobile menu.
	 *
	 * @param string   $item_output The menu item's starting HTML output.
	 * @param WP_Post  $item        Menu item data object.
	 * @param int      $depth       Depth of menu item. Used for padding.
	 * @param stdClass $args        An object of wp_nav_menu() arguments.
	 */
	function xpertiz_add_submenu_arrow_on_mobile_menu( $item_output, $item, $depth, $args ) {
		if ( ! empty( $args->menu_id ) ) {
			if ( 'mobile_navigation' === $args->menu_id ) {
				if ( in_array( 'menu-item-has-children', $item->classes, false ) ) {
					if ( is_rtl() ) {
						$item_output .= '<label class="uf-mobile-nav-expand-submenu"><i class="icon-chevron-left"></i></label>';
					} else {
						$item_output .= '<label class="uf-mobile-nav-expand-submenu"><i class="icon-chevron-right"></i></label>';
					}
				}
			}
		}

		return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el','xpertiz_add_submenu_arrow_on_mobile_menu', 10, 4 );
endif;

if ( ! function_exists( 'xpertiz_sanitize_pagination' ) ) :

	/**
	 * Remove screen reader text on pagination.
	 *
	 * @param string $content The content of pagination.
	 */
	function xpertiz_sanitize_pagination( $content ) {

		$content = preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $content );
		return $content;
	}

	add_action( 'navigation_markup_template', 'xpertiz_sanitize_pagination' );

endif;

if ( ! function_exists( 'xpertiz_comment_fields' ) ) :

	/**
	 * Add placeholder to comments form.
	 *
	 * @param array $fields List of comment fields.
	 */
	function xpertiz_comment_fields( $fields ) {
		$fields['author'] = str_replace(
			'<input',
			'<input placeholder="'
				. esc_attr_x(
					'Name',
					'comment author placeholder',
					'xpertiz'
				)
				. '"',
			$fields['author']
		);

		$fields['email'] = str_replace(
			'<input id="email" name="email" type="text"',
			'<input placeholder="'
				. esc_attr_x(
					'Email',
					'comment email placeholder',
					'xpertiz'
				)
				. '" id="email" name="email" type="email"',
			$fields['email']
		);

		$fields['url'] = str_replace(
			'<input id="url" name="url" type="text"',
			'<input placeholder="'
				. esc_attr_x(
					'Website',
					'comment url placeholder',
					'xpertiz'
				)
				. '" id="url" name="url" type="url"',
			$fields['url']
		);

		return $fields;
	}

	add_filter( 'xpertiz_comment_form_default_fields', 'xpertiz_comment_fields' );
endif;

if ( ! function_exists( 'xpertiz_form_field' ) ) :

	/**
	 * Add placeholder to textarea
	 *
	 * @param string $field The comment field.
	 */
	function xpertiz_form_field( $field ) {
		$search = '<textarea';
		$replace = '<textarea placeholder="' . esc_attr__( 'Your comment here...', 'xpertiz' ) . '" ';
		$field = str_replace( $search, $replace, $field );

		return $field;
	}

	add_filter( 'comment_form_field_comment', 'xpertiz_form_field' );
endif;

if ( ! function_exists( 'xpertiz_add_classes_on_category' ) ) :

	/**
	 * Function to add classes on category list
	 *
	 * @param array  $thelist The comment field.
	 * @param string $separator The separator.
	 */
	function xpertiz_add_classes_on_category( $thelist, $separator ) {
		$count = 0;
		$class_to_add = 'pills pills-primary';

		// Remove separator.
		$thelist = str_replace( '>' . $separator . '<',  '><', $thelist, $count );

		// Add custom class.
		$result = str_replace( '<a href="',  '<a class="' . esc_attr( $class_to_add ) . '" href="', $thelist, $count );

		if ( 0 === $count ) {
			$result = '';
		}
		return $result;
	}

	if ( ! is_admin() ) {
		add_filter( 'the_category', 'xpertiz_add_classes_on_category', 10, 2 );
	}
endif;

if ( ! function_exists( 'xpertiz_breadcrumb_classes' ) ) :
	/**
	 * Add breadcrumbs class filters.
	 *
	 * @param array $classes Class List.
	 * @return array
	 */
	function xpertiz_breadcrumb_classes( $classes ) {
		$classes[] = 'uf-breadcrumbs';

		return $classes;
	}

	add_filter( 'xpertiz_breadcrumb_class', 'xpertiz_breadcrumb_classes' );
endif;

if ( ! function_exists( 'xpertiz_gallery_post' ) ) :

	/**
	 * Custom gallery output.
	 *
	 * @param string $output of gallery galery post.
	 * @param array  $attr atributes of gallery post output.
	 * @return array
	 */
	function xpertiz_gallery_post( $output, $attr ) {
		global $post;

		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		$atts = shortcode_atts(
			array(
				'order' => 'ASC',
				'orderby' => 'menu_order ID',
				'id' => $post->ID,
				'class' => '',
				'itemtag' => 'dl',
				'icontag' => 'dt',
				'captiontag' => 'dd',
				'columns' => 3,
				'size' => 'thumbnail',
				'include' => '',
				'exclude' => '',
			), $attr
		);

		$id = intval( $atts['id'] );

		if ( ! empty( $atts['include'] ) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $atts['include'] );
			$_attachments = get_posts(
				array(
					'include' => $include,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => $atts['order'],
					'orderby' => $atts['orderby'],
				)
			);
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		if ( 'carousel' === $atts['class'] ) {

			// Here's your actual output, you may customize it to your needs.
			$carousel_id = 'carousel-' . uniqid();

			$output = '<div id=' . $carousel_id . ' class="uf-carousel carousel slide" data-ride="carousel">' .
			'<div class="carousel-inner">';

			$i = 0;

			foreach ( $attachments as $id => $attachment ) {
				$img = wp_get_attachment_image_src( $id, 'large' );

				if ( 0 === $i ) {
					$output .= '<div class="carousel-item active">';
				} else {
					$output .= '<div class="carousel-item">';
				}

				$output .= '<img src="' . esc_attr( $img[0] ) . '" width="' . esc_attr( $img[1] ) . '" height="' . esc_attr( $img[2] ) . '" class="d-block w-100" />';
				$output .= '</div>';
				$i++;
			}

			$output .= '<a class="carousel-control-prev" href="#' . $carousel_id . '" role="button" data-slide="prev">' .
				'<span class="icon-chevron-left" aria-hidden="false"></span>' .
				'<span class="sr-only">' . esc_html__( 'Previous', 'xpertiz' ) . '</span>' .
			'</a>' .
			'<a class="carousel-control-next" href="#' . $carousel_id . '" role="button" data-slide="next">' .
				'<span class="icon-chevron-right" aria-hidden="false"></span>' .
				'<span class="sr-only">' . esc_html__( 'Next', 'xpertiz' ) . '</span>' .
			'</a>' .
			'</div>' .
			'</div>';
		}

		return $output;
	}

	add_filter( 'post_gallery', 'xpertiz_gallery_post', 10, 2 );
endif;

if ( ! function_exists( 'xpertiz_wp_list_categories_args' ) ) :

	/**
	 * Alter wp list categories arguments.
	 * Adds a span around the counter for easier styling.
	 *
	 * @param string $links Links.
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function xpertiz_wp_list_categories_args( $links ) {
		$categories = preg_replace( '/<\/a> \(([0-9]+)\)/', ' (\\1)</a>', $links );
		return $categories;
	}

	add_filter( 'wp_list_categories','xpertiz_wp_list_categories_args' );
endif;

if ( ! function_exists( 'xpertiz_breadcrumbs_template' ) ) :

	/**
	 * Xpertiz breadcrumbs Template
	 */
	function xpertiz_breadcrumbs_template() {
		if ( is_404() || is_front_page() ) {
			return;
		}

		get_template_part( 'template-parts/breadcrumbs/layout' );
	}

	add_action( 'xpertiz_breadcrumbs', 'xpertiz_breadcrumbs_template' );

endif;

if ( ! function_exists( 'xpertiz_banner_style' ) ) :

	/**
	 * Xpertiz breadcrumbs Template
	 */
	function xpertiz_banner_style() {
		$css = array();

		if ( has_header_image() ) {
			$css[] = array(
				'element' => '#header-image-bg',
				'rules'   => array(
					'background-image' => 'url(' . get_header_image() . ')',
				),
			);
		}

		if ( has_custom_logo() ) {
			$css[] = array(
				'element' => '.custom-logo-link img',
				'rules'   => array(
					'max-height' => esc_attr( xpertiz_theme_setting( 'logo-height' ) . xpertiz_theme_setting( 'logo-height', true, 'unit' ) ),
				),
			);
		}

		// If it's not the same with default value.
		$logo_sticky = xpertiz_theme_setting( 'logo-sticky' );
		if ( xpertiz_theme_setting( 'logo-sticky', true ) !== $logo_sticky ) {
			$css[] = array(
				'element' => '.custom-logo-sticky-link img',
				'rules'   => array(
					'max-height' => esc_attr( xpertiz_theme_setting( 'logo-sticky-height' ) . xpertiz_theme_setting( 'logo-sticky-height', true, 'unit' ) ),
				),
			);
		}

		// If it's not the same with default value.
		$navbar_bottom_border = xpertiz_theme_setting( 'navbar-bottom-border' );
		if ( xpertiz_theme_setting( 'navbar-bottom-border', true ) !== $navbar_bottom_border ) {
			$css[] = array(
				'element' => '.home #header.sticky--top, .home.xpertiz-scroll #header',
				'rules'   => array(
					'border-bottom' => esc_attr( $navbar_bottom_border ),
				),
			);

			$css[] = array(
				'element' => '.home #header.sticky--top .navbar-toggler',
				'rules'   => array(
					'border-right' => esc_attr( $navbar_bottom_border ),
				),
			);
		}

		// If it's not the same with default  value.
		$navbar_font_color = xpertiz_theme_setting( 'navbar-font-color' );
		if ( xpertiz_theme_setting( 'navbar-font-color', true ) !== $navbar_font_color ) {
			$css[] = array(
				'element' => '.home .navbar-light .navbar-nav .nav-link, .home #navbar .icon-chevron-down::before, .home #header.sticky.sticky--top #quadmenu.detheme_default_menu .quadmenu-navbar-nav > li > a > .quadmenu-item-content, .home #header.sticky.sticky--top #quadmenu.quadmenu-default_theme .quadmenu-navbar-nav > li:not(.quadmenu-item-type-button) > a > .quadmenu-item-content, .home .navbar-light .navbar-nav .menu-item-has-children::before, .home .navbar-light .navbar-nav .page_item_has_children::before',
				'rules'   => array(
					'color' => esc_attr( $navbar_font_color ),
				),
			);
		}

		// If it's not the same with default value.
		$navbar_background_color = xpertiz_theme_setting( 'navbar-background-color' );
		if ( xpertiz_theme_setting( 'navbar-background-color', true ) !== $navbar_background_color ) {
			$css[] = array(
				'element' => '.xpertiz-scroll #header, #header.sticky.sticky--top',
				'rules'   => array(
					'background-color' => esc_attr( $navbar_background_color ),
				),
			);
		}

		// If it's not the same with default value.
		$navbar_font_sticky_color = xpertiz_theme_setting( 'navbar-font-sticky-color' );
		if ( xpertiz_theme_setting( 'navbar-font-sticky-color', true ) !== $navbar_font_sticky_color ) {
			$css[] = array(
				'element' => '#header.sticky.sticky--top .navbar-light .navbar-nav .sub-menu .nav-link, #header.sticky.sticky--not-top .navbar-light .navbar-nav .nav-link, #header.sticky.sticky--not-top .icon-chevron-down::before, #header #quadmenu.detheme_default_menu .quadmenu-navbar-nav > li > a > .quadmenu-item-content, #header #quadmenu.quadmenu-default_theme .quadmenu-navbar-nav > li:not(.quadmenu-item-type-button) > a > .quadmenu-item-content, .uf-mobile-nav-modal #quadmenu.detheme_default_menu .quadmenu-navbar-nav > li > a > .quadmenu-item-content, .uf-mobile-nav-modal #quadmenu.quadmenu-default_theme .quadmenu-navbar-nav > li:not(.quadmenu-item-type-button) > a > .quadmenu-item-content,.home #header.sticky.sticky--not-top #quadmenu.detheme_default_menu .quadmenu-navbar-nav > li > a > .quadmenu-item-content',
				'rules'   => array(
					'color' => esc_attr( $navbar_font_sticky_color ),
				),
			);
		}

		// If it's not the same with default value.
		$navbar_background_sticky_color = xpertiz_theme_setting( 'navbar-background-sticky-color' );
		if ( xpertiz_theme_setting( 'navbar-background-sticky-color', true ) !== $navbar_background_sticky_color ) {
			$css[] = array(
				'element' => '#header.sticky.sticky--not-top',
				'rules'   => array(
					'background-color' => esc_attr( $navbar_background_sticky_color ),
				),
			);
		}

		// Top Bar font color ( homepage only ).
		// If it's not the same with default  value.
		$topbar_home_font_color = xpertiz_theme_setting( 'topbar-home-font-color' );
		if ( xpertiz_theme_setting( 'topbar-home-font-color', true ) !== $topbar_home_font_color ) {
			$css[] = array(
				'element' => '.home .topbar-desktop',
				'rules'   => array(
					'color' => esc_attr( $topbar_home_font_color ),
				),
			);

			$css[] = array(
				'element' => '.home .topbar-desktop a',
				'rules'   => array(
					'color' => esc_attr( $topbar_home_font_color ),
				),
			);
		}

		// Top Bar background color ( homepage only ).
		// If it's not the same with default value.
		$topbar_home_background_color = xpertiz_theme_setting( 'topbar-home-background-color' );
		if ( xpertiz_theme_setting( 'topbar-home-background-color', true ) !== $topbar_home_background_color ) {
			$css[] = array(
				'element' => '.home .topbar-desktop',
				'rules'   => array(
					'background-color' => esc_attr( $topbar_home_background_color ),
				),
			);
		}

		// Top Bar background color ( homepage only ).
		// If it's not the same with default value.
		$topbar_home_border_color = xpertiz_theme_setting( 'topbar-home-border-color' );
		if ( xpertiz_theme_setting( 'topbar-home-border-color', true ) !== $topbar_home_border_color ) {
			$css[] = array(
				'element' => '.home .topbar-desktop .topbar-content',
				'rules'   => array(
					'border-bottom-color' => esc_attr( $topbar_home_border_color ),
				),
			);
		}

		// If it's not the same with default value.
		$primary_color = xpertiz_theme_setting( 'primary-color' );
		if ( xpertiz_theme_setting( 'primary-color', true ) !== $primary_color ) {
			$css[] = array(
				'element' => 'blockquote, .pagination .current, .xpertiz-blog-type-gutenberg-ready .wp-block-quote',
				'rules'   => array(
					'border-color' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => '.uf-breadcrumbs>span>span, .widget .rsswidget:hover, .widget .recentcomments .comment-author-link .url:hover, .widget #wp-calendar tbody td a:hover, .widget.uf-dark-scheme .rsswidget:hover, .widget.uf-dark-scheme #wp-calendar tbody tr td a:hover, #navbar ul li:hover .sub-menu li:hover, main#content #archive-post a.more-link:hover, main#content #blog-entries a.more-link:hover, main#content #blog-entries .sticky-icon span.icon-bookmark2,main#content #archive-post .sticky-icon span.icon-bookmark2, .uf-single-post .wp-caption-text a:hover, #footer .widget a:hover, .error404 #not-found h1, .mejs-container * .mejs-controls .mejs-volume-button a:hover, .navbar-light .navbar-nav .menu-item:hover::before, .navbar-light .navbar-nav .menu-item:hover > .nav-link, .navbar-light .navbar-nav .page_item:hover::before, .navbar-light .navbar-nav .page_item:hover > .nav-link, .list-item .kc-entry_meta > span i, .kc_tabs_nav li.ui-tabs-active a, .kc_tabs_nav li.ui-tabs-active a:hover, .kc_tabs_nav li:hover a, .post-grid > div > .content > .post-title-alt > a:hover, .post-grid > div > .content > .entry-meta > span > a, .list-post-type > .list-item > .post-content > h3 > a:hover, .list-item .kc-entry_meta > span a:hover, .uf-single-post__content a, .xpertiz-blog-type-gutenberg-ready .more-link, .entry__content a, .single__content a',
				'rules'   => array(
					'color' => esc_attr( $primary_color . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.xpertiz-blog-type-gutenberg-ready .more-link:hover',
				'rules'   => array(
					'color' => esc_attr( xpertiz_darken( $primary_color, 10 ) . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.xpertiz-blog-type-gutenberg-ready .wp-block-search__button',
				'rules'   => array(
					'background-color' => esc_attr( $primary_color . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.xpertiz-blog-type-gutenberg-ready .wp-block-search__button:hover',
				'rules'   => array(
					'background-color' => esc_attr( xpertiz_darken( $primary_color, 10 ) . ' !important' ),
				),
			);

			$css[] = array(
				'element' => 'a:hover, .uf-card-body .entry__content a',
				'rules'   => array(
					'color' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => 'main#content #archive-post a.more-link:hover::after, main#content #blog-entries a.more-link:hover::after',
				'rules'   => array(
					'background-color' => esc_attr( $primary_color . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.uf-checkbox .uf-checkbox-label input:checked ~ .checkmark, .widget #wp-calendar tr #today, .widget.uf-dark-scheme #wp-calendar tbody tr td#today, .selectize-control.single .selectize-dropdown .option.active, .uf-dark-scheme .selectize-control.single .selectize-dropdown .option.active, a.uf-buttons,.uf-buttons,input[type=\'submit\'],input[type=\'reset\'],input[type=\'button\'],#comments .comment-form .form-submit input, .kc-ui-progress, .kc_button,.widget.widget_tag_cloud .pills-primary.tag-cloud-link, .pagination .current, .mejs-container * .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-container * .mejs-controls .mejs-volume-button .mejs-volume-current, .mejs-container * .mejs-controls .mejs-horizontal-volume-current, .content-button a, .kc-blog-posts .kc-post-2-button, a.kc-read-more, .kc-team .content-socials a',
				'rules'   => array(
					'background-color' => esc_attr( $primary_color . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.uf-radio input:checked ~ .uf-radio-label::before',
				'rules'   => array(
					'box-shadow' => esc_attr( 'inset 0 0 0 3px ' . $primary_color ),
				),
			);

			$css[] = array(
				'element' => '.uf-single-post__content a:hover',
				'rules'   => array(
					'filter' => 'brightness(90%)',
				),
			);

			$css[] = array(
				'element' => '.pills.pills-primary:hover , .uf-buttons:hover',
				'rules'   => array(
					'box-shadow' => 'inset 0 0 100px 100px rgba(0, 0, 0, 0.1)',
				),
			);

			$css[] = array(
				'element' => '.xpertiz-blog-type-gutenberg-ready .pills.pills-primary',
				'rules'   => array(
					'color' => esc_attr( $primary_color . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.xpertiz-blog-type-gutenberg-ready .pills.pills-primary:after',
				'rules'   => array(
					'background' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => '.kc_button:hover',
				'rules' => array(
					'color' => '#ffffff',
				),
			);

			$css[] = array(
				'element' => '.kc_button:hover',
				'rules' => array(
					'box-shadow' => 'inset 0 0 100px 100px rgba(0, 0, 0, 0.1)',
				),
			);

			$css[] = array(
				'element' => '.kc_tabs_nav li.ui-tabs-active a, .kc_tabs_nav li.ui-tabs-active a:hover, .kc_tabs_nav li:hover a, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .single-product div.product .related.products h2:hover, .woocommerce ul.products li.product h2.woocommerce-loop-product__title:hover',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.kc_button, .kc-ui-progress, .content-button a, .content-button a, .owl-theme .owl-controls .owl-page span, .woocommerce-cart .button, .woocommerce-checkout .button, .woocommerce-account .button, .woocommerce .comment-respond input.submit, #sidebar .woocommerce a.button.checkout, #footer .woocommerce a.button.checkout',
				'rules' => array(
					'background-color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.woocommerce .single_add_to_cart_button, .single-product div.product .product_meta .posted_in a',
				'rules' => array(
					'background' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.widget .widget-title:before',
				'rules' => array(
					'background' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => '.navbar-light .navbar-nav .current-menu-item, .current-menu-item > .nav-link, .menu-item:hover::before, .menu-item:hover > .nav-link, .navbar-light .navbar-nav .current_page_item, .current_page_item > .nav-link, .page_item:hover::before, .page_item:hover > .nav-link',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.navbar-light .navbar-nav .current-menu-ancestor, .current-menu-ancestor > .nav-link, .navbar-light .navbar-nav .current_page_ancestor, .current_page_ancestor > .nav-link, .navbar-light .navbar-nav .current-menu-parent, .navbar-light .navbar-nav .current-menu-parent > .nav-link',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.navbar-light .navbar-nav .current-menu-ancestor::after, .current-menu-parent::after, .current-menu-item::after, .navbar-light .navbar-nav .current_page_ancestor::after, .current-menu-parent::after, .current_page_item::after',
				'rules' => array(
					'background' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '#header.sticky--not-top.sticky--unpinned .navbar-light .navbar-nav .menu-item:hover::before, .menu-item:hover > .nav-link, #header.sticky--not-top.sticky--unpinned .navbar-light .navbar-nav .page_item:hover::before, .page_item:hover > .nav-link',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.navbar-light .navbar-nav .dropdown-menu .menu-item:hover > .nav-link, .navbar-light .navbar-nav .dropdown-menu .page_item:hover > .nav-link',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '#header.sticky--not-top.sticky--unpinned .navbar-light .navbar-nav .dropdown-menu .menu-item:active > .nav-link, .menu-item:hover > .nav-link, #header.sticky--not-top.sticky--unpinned .navbar-light .navbar-nav .dropdown-menu .page_item:active > .nav-link, .page_item:hover > .nav-link',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '#header.sticky.sticky--not-top .navbar-light .navbar-nav .current-menu-ancestor.menu-item::before, .current-menu-item.menu-item::before, #header.sticky.sticky--not-top .navbar-light .navbar-nav .current_page_ancestor.page_item::before, .current_page_item.page_item::before',
				'rules' => array(
					'color' => esc_attr( $primary_color . '!important' ),
				),
			);

			$css[] = array(
				'element' => '.home .topbar-desktop a:hover',
				'rules'   => array(
					'color' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => '.post-navigation .nav-links .nav-next:hover i, .post-navigation .nav-links .nav-previous:hover i',
				'rules'   => array(
					'border-color' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => '.post-navigation .nav-links .nav-next:hover i, .post-navigation .nav-links .nav-previous:hover i',
				'rules'   => array(
					'background-color' => esc_attr( $primary_color ),
				),
			);

			$css[] = array(
				'element' => 'article.entry.sticky::before',
				'rules'   => array(
					'color' => esc_attr( $primary_color . ' !important' ),
				),
			);

			$css[] = array(
				'element' => '.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]',
				'rules'   => array(
					'background-color' => esc_attr( $primary_color ),
				),
			);

			$css = apply_filters( 'xpertiz_primary_color_filter', $css, $primary_color );
		}

		$css_output = array();

		foreach ( $css as $_css ) {
			$css_output[] = $_css['element'] . '{';

			foreach ( $_css['rules'] as $rule => $props ) {
				$css_output[] = $rule . ':' . $props;
			}

			$css_output[] = '}';
		}

		wp_add_inline_style( 'xpertiz-theme-style', implode( '', $css_output ) );
	}

	add_action( 'wp_enqueue_scripts', 'xpertiz_banner_style' );

endif;

if ( ! function_exists( 'xpertiz_custom_logo' ) ) :

	/**
	 * Overrides itemprop value from custom_logo.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function xpertiz_custom_logo() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
			esc_url( home_url( '/' ) ),
			wp_get_attachment_image(
				$custom_logo_id, 'full', false, array(
					'class'    => esc_attr( 'custom-logo' ),
					'alt'      => esc_attr__( 'Xpertiz', 'xpertiz' ),
				)
			)
		);
		return $html;
	}

	add_filter( 'get_custom_logo', 'xpertiz_custom_logo' );

endif;

if ( ! function_exists( 'xpertiz_next_post_link' ) ) :

	/**
	 * Add tag span before next post link to fix justify-content: space between issue in flexbox.
	 *
	 * @since 1.0.0
	 * @param string $output HTML Navigation.
	 * @return string
	 */
	function xpertiz_next_post_link( $output ) {
		return '<span></span>' . $output;
	}

	add_filter( 'next_post_link','xpertiz_next_post_link' );
endif;

if ( ! function_exists( 'xpertiz_navigation_template' ) ) :

	/**
	 * Overrides role navigation from from navigation template.
	 *
	 * @since 1.0.0
	 * @param string $template HTML Navigation.
	 * @return string
	 */
	function xpertiz_navigation_template( $template ) {
		$template = '
		<nav class="navigation %1$s">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
		</nav>';

		return $template;
	}

	add_filter( 'navigation_markup_template', 'xpertiz_navigation_template' );

endif;

if ( ! function_exists( 'xpertiz_smartslider3_skip_license_modal' ) ) :

	/**
	 * Smartslider 3 skip license modal.
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	function xpertiz_smartslider3_skip_license_modal() {
		return true;
	}

	add_filter( 'smartslider3_skip_license_modal', 'xpertiz_smartslider3_skip_license_modal' );
endif;

if ( ! function_exists( 'xpertiz_woocommerce_pagination_args' ) ) :

	/**
	 * Override Woocommerce Pagination.
	 *
	 * @since 1.0.0
	 * @param array $args Woocommerce Pagination Arguments.
	 * @return array
	 */
	function xpertiz_woocommerce_pagination_args( $args ) {
		$args['type'] = 'plain';

		$args['prev_text'] = is_rtl() ? wp_kses(
			'<span class="icon-chevron-right"></span>',
			array(
				'span' => array(
					'class' => array(),
				),
			)
		) : wp_kses(
			'<span class="icon-chevron-left"></span>',
			array(
				'span' => array(
					'class' => array(),
				),
			)
		);

		$args['next_text'] = is_rtl() ? wp_kses(
			'<span class="icon-chevron-left"></span>',
			array(
				'span' => array(
					'class' => array(),
				),
			)
		) : wp_kses(
			'<span class="icon-chevron-right"></span>',
			array(
				'span' => array(
					'class' => array(),
				),
			)
		);

		return $args;
	}

	add_filter( 'woocommerce_pagination_args', 'xpertiz_woocommerce_pagination_args' );
endif;

if ( ! function_exists( 'xpertiz_check_php_version' ) ) :

	/**
	 * Check Minimum requirement PHP Version.
	 */
	function xpertiz_check_php_version() {

		// Compare versions.
		if ( version_compare( PHP_VERSION, XPERTIZ_THEME_REQUIRED_PHP_VERSION, '<' ) ) :

			// Theme not activated info message.
			add_action( 'admin_notices', 'xpertiz_php_version_admin_notice' );

			/**
			 * Notice Minimum requirement PHP Version.
			 */
			function xpertiz_php_version_admin_notice() {
				?>
				<div class="update-nag"><strong>
					<?php
					echo esc_html__( 'Xpertiz theme requires a minimum PHP version of ', 'xpertiz' ) . esc_html( XPERTIZ_THEME_REQUIRED_PHP_VERSION );
					echo esc_html__( '. Your PHP version is ', 'xpertiz' ) . esc_html( PHP_VERSION );
					echo esc_html__( '. Your previous theme has been restored.', 'xpertiz' );
					?>
				</strong></div>
				<?php
			}

			// Switch back to previous theme.
			switch_theme( get_option( 'theme_switched' ) );
				return false;

		endif;
	}

	add_action( 'after_switch_theme', 'xpertiz_check_php_version' );

endif;

if ( ! function_exists( 'xpertiz_custom_wp_admin_style' ) ) :

	/**
	 * Load Custom WP Admin Style.
	 */
	function xpertiz_custom_wp_admin_style() {
		wp_register_style( 'xpertiz_wp_admin_css', get_theme_file_uri( '/assets/css/theme-admin.css' ), false, '1.0.0' );
		wp_enqueue_style( 'xpertiz_wp_admin_css' );
	}

	add_action( 'admin_enqueue_scripts', 'xpertiz_custom_wp_admin_style' );

endif;

if ( ! function_exists( 'xpertiz_edit_post_link' ) ) :

	/**
	 * Filters the edit post link to add an icon and use the post meta structure.
	 *
	 * @param string $link    Anchor tag for the edit link.
	 * @param int    $post_id Post ID.
	 * @param string $text    Anchor text.
	 */
	function xpertiz_edit_post_link( $link, $post_id, $text ) {
		if ( is_admin() ) {
			return $link;
		}

		$edit_url = get_edit_post_link( $post_id );

		if ( ! $edit_url ) {
			return;
		}

		$text = sprintf(
			wp_kses(
				/* translators: %s: Post title. Only visible to screen readers. */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'xpertiz' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title( $post_id )
		);

			return '<div class="post-meta-wrapper post-meta-edit-link-wrapper"><svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M12.5719 10.7787L13.5719 9.77865C13.7281 9.6224 14 9.73178 14 9.95678V14.5005C14 15.3287 13.3281 16.0005 12.5 16.0005H1.5C0.671875 16.0005 0 15.3287 0 14.5005V3.50052C0 2.67239 0.671875 2.00052 1.5 2.00052H10.0469C10.2688 2.00052 10.3813 2.26927 10.225 2.42864L9.225 3.42864C9.17813 3.47552 9.11563 3.50052 9.04688 3.50052H1.5V14.5005H12.5V10.9537C12.5 10.888 12.525 10.8255 12.5719 10.7787ZM17.4656 4.47239L9.25937 12.6787L6.43437 12.9912C5.61562 13.0818 4.91875 12.3912 5.00938 11.5662L5.32188 8.74115L13.5281 0.534888C14.2437 -0.180738 15.4 -0.180738 16.1125 0.534888L17.4625 1.88489C18.1781 2.60052 18.1781 3.75989 17.4656 4.47239ZM14.3781 5.43802L12.5625 3.62239L6.75625 9.43178L6.52812 11.4724L8.56875 11.2443L14.3781 5.43802ZM16.4031 2.94739L15.0531 1.59739C14.925 1.46926 14.7156 1.46926 14.5906 1.59739L13.625 2.56302L15.4406 4.37864L16.4062 3.41302C16.5312 3.28177 16.5312 3.07552 16.4031 2.94739Z" fill="#FF4C00"/>
	</svg>
	<span class="meta-text"><a href="' . esc_url( $edit_url ) . '">' . $text . '</a></span><!-- .post-meta --></div><!-- .post-meta-wrapper -->';

	}

	add_filter( 'edit_post_link', 'xpertiz_edit_post_link', 10, 3 );

endif;

if ( ! function_exists( 'xpertiz_read_more_tag' ) ) :
	/**
	 * Overwrite default more tag with styling and screen reader markup.
	 *
	 * @param string $html The default output HTML for the more tag.
	 *
	 * @return string $html
	 */
	function xpertiz_read_more_tag( $html ) {
		return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span>$2</span></a></div>', get_the_title( get_the_ID() ) ), $html );
	}

	add_filter( 'the_content_more_link', 'xpertiz_read_more_tag' );
endif;

if ( ! function_exists( 'xpertiz_has_custom_404_elementskit' ) ) :

	/**
	 * Has Custom 404 Elementskit.
	 *
	 * @since 1.0.0
	 */
	function xpertiz_has_custom_404_elementskit() {
		$result = false;

		if ( class_exists( '\ElementsKit\Modules\Header_Footer\Activator' ) ) :
			$template = \ElementsKit\Modules\Header_Footer\Activator::template_ids();

			$value = get_post_meta( $template[0], 'elementskit_template_condition_singular', true );

			$result = ( '404page' === $value ) ? true : false;
		endif;

		return $result;
	}
	add_filter( 'xpertiz_has_custom_404', 'xpertiz_has_custom_404_elementskit', 99 );

endif;

/**
 * Enqueue supplemental block editor styles.
 */
function xpertiz_block_editor_styles() {

	$css_dependencies = array();

	// Enqueue the editor styles.
	wp_enqueue_style( 'xpertiz-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'xpertiz-block-editor-styles', 'rtl', 'replace' );
}

add_action( 'enqueue_block_editor_assets', 'xpertiz_block_editor_styles', 1, 1 );
