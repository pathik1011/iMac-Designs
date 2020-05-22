<?php
/**
 * This file includes helper functions used throughout the theme.
 *
 * @package Xpertiz
 */

if ( ! function_exists( 'xpertiz_header_classes' ) ) {

	/**
	 * Xpertiz Header Classes
	 *
	 * @param array $classes Class List.
	 * @return array
	 */
	function xpertiz_header_classes( $classes = array() ) {
		// Apply filters for child theming.
		$classes = apply_filters( 'xpertiz_header_classes', $classes );

		// Turn classes into space seperated string.
		$classes = implode( ' ', $classes );

		// return classes.
		return $classes;

	}
}

if ( ! function_exists( 'xpertiz_content_class' ) ) :

	/**
	 * Xpertiz Content Class
	 *
	 * @param array $classes Class List.
	 */
	function xpertiz_content_class( $classes = array() ) {
		// Default class.
		$classes[] = 'xpertiz-content';
		$classes[] = 'order-lg-1';

		// Layout class.
		$classes[] = 'sidebar-none' === xpertiz_theme_setting( 'sidebar-layout' ) || is_active_sidebar( 'sidebar' ) === false ? 'col-12' : 'col-lg-8 col-md-8';

		// Apply filters for child theming.
		$classes = apply_filters( 'xpertiz_content_class', $classes );

		// Turn classes into space seperated string.
		$classes = array_unique( $classes );
		$classes = implode( ' ', $classes );

		// return classes.
		echo wp_kses_data( 'class="' . esc_attr( $classes ) . '"' );
	}
endif;

if ( ! function_exists( 'xpertiz_sidebar_class' ) ) :

	/**
	 * Xpertiz Sidebar Class
	 *
	 * @param array $classes Class List.
	 */
	function xpertiz_sidebar_class( $classes = array() ) {
		// Default class.
		$classes[] = 'xpertiz-sidebar';
		$classes[] = 'col-lg-4 col-md-4';

		// Layout class.
		$classes[] = 'sidebar-left' === xpertiz_theme_setting( 'sidebar-layout' ) ? 'order-lg-0' : 'order-lg-1';

		// Apply filters for child theming.
		$classes = apply_filters( 'xpertiz_sidebar_class', $classes );

		// Turn classes into space seperated string.
		$classes = array_unique( $classes );
		$classes = implode( ' ', $classes );

		$style = '';

		if ( 'sidebar-none' === xpertiz_theme_setting( 'sidebar-layout' ) && is_customize_preview() ) {
			$style = 'display:none';
		}

		// return classes.
		echo wp_kses_data( 'class="' . esc_attr( $classes ) . '" style="' . esc_attr( $style ) . '"' );
	}
endif;

if ( ! function_exists( 'xpertiz_comment' ) ) :

	/**
	 * Xpertiz Custom Comment Style
	 *
	 * @param object $comment Comment Object.
	 * @param array  $args    comment_form arguments.
	 * @param int    $depth   Comment's depth.
	 */
	function xpertiz_comment( $comment, $args, $depth ) {
		global $post;
		?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<?php
		switch ( $comment->comment_type ) :
			// Display trackbacks differently than normal comments..
			case 'pingback':
			case 'trackback':
			?>
				<article id="comment-<?php comment_ID(); ?>" class="comment-container" itemscope>
				<p>
					<?php esc_html_e( 'Pingback:', 'xpertiz' ); ?>
					<span itemprop="name"><?php comment_author_link(); ?></span>
					<?php edit_comment_link( esc_html__( '(Edit)', 'xpertiz' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
				</article>
			<?php
				break;

			default:
				// Proceed with normal comments..
				?>
				<div <?php comment_class( 'comment-body' ); ?>>
					<?php echo wp_kses( get_avatar( $comment, apply_filters( 'xpertiz_comment_avatar_size', 70 ) ), 'post' ); ?>
					<div class="comment-content">
						<div class="comment-card">
							<div class="comment-author">
								<div class="comment-link">
									<?php
									// translators: Get Comment Author Link.
									printf( esc_html__( '%s ', 'xpertiz' ), sprintf( '%s', get_comment_author_link() ) );
									?>
								</div>
							</div>
							<?php if ( '0' === $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation. ', 'xpertiz' ); ?></p>
							<?php endif; ?>
							<?php comment_text(); ?>
						</div>
						<div class="comment-info" id="comment-info-<?php comment_ID(); ?>">
							<span class="comment-meta commentmetadata">
								<?php
									edit_comment_link(
										esc_html__( 'edit', 'xpertiz' ),
										'',
										wp_kses(
											'<span class="dot"></span>',
											array(
												'span' => array(
													'class' => array(),
												),
											)
										)
									);
									comment_reply_link(
										array_merge(
											$args, array(
												'add_below' => 'comment-info',
												'depth' => $depth,
												'max_depth' => $args['max_depth'],
											)
										)
									);
								?>

								<?php if ( is_rtl() ) : ?>
								<div class="comment-info"><?php comment_date(); ?></div>
								<?php endif; ?>
							</span>
							<span class="comment-date"><?php comment_date(); ?>, <?php comment_time(); ?></span>
						</div>
					</div>

				</div><!-- #comment-## -->
			<?php
		endswitch;
	}
endif;

if ( ! function_exists( 'xpertiz_theme_setting' ) ) {
	/**
	 * Get xpertiz theme mod.
	 *
	 * @param string $key           Theme Mod key.
	 * @param bool   $control_value Whether using control value or not.
	 * @param string $control_attr  Control key from $xpertiz_customizer_settings.
	 * @return mixed
	 */
	function xpertiz_theme_setting( $key = '', $control_value = false, $control_attr = 'default' ) {
		global $xpertiz_customizer_settings;

		if ( isset( $key ) && ! empty( $key ) ) {
			$default_value = isset( $xpertiz_customizer_settings[ $key ] ) ? $xpertiz_customizer_settings[ $key ][ $control_attr ] : '';
			$theme_mod = get_theme_mod( $key, $default_value );
			$setting = $control_value ? $default_value : $theme_mod;
			return empty( $setting ) ? $default_value : $setting;
		}

		/**
		 * Get all settings.
		 */
		$settings = array();

		foreach ( $xpertiz_customizer_settings as $key => $setting ) {
			$default_value = $setting[ $control_attr ];
			$theme_mod = get_theme_mod( $key, $default_value );
			$setting = $control_value ? $default_value : $theme_mod;
			$settings[ $key ] = empty( $setting ) ? $default_value : $setting;
		}

		return $settings;
	}
}

if ( ! function_exists( 'xpertiz_logo' ) ) :
	/**
	 * Display logo from site identity in customizer.
	 *
	 * @return void
	 */
	function xpertiz_logo() {
		if ( function_exists( 'the_custom_logo' ) && '' !== get_theme_mod( 'custom_logo', '' ) ) {
			the_custom_logo();
		} else {
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"><?php echo esc_attr( bloginfo( 'name' ) ); ?></a>
		<?php
		}
	}
endif;

if ( ! function_exists( 'xpertiz_logo_sticky' ) ) :
	/**
	 * Display Sticky logo from site identity in customizer.
	 *
	 * @return void
	 */
	function xpertiz_logo_sticky() {
		if ( '' !== get_theme_mod( 'logo-sticky', '' ) ) {
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-sticky-link" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php echo esc_attr( get_theme_mod( 'logo-sticky' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
		<?php
		} else {
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-sticky-link" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"><?php echo esc_attr( bloginfo( 'name' ) ); ?></a>
		<?php
		}
	}
endif;


/**
 * Filter an array based on a black list of keys
 *
 * @param array $array
 * @param array $keys
 *
 * @return array
 */
if ( ! function_exists( 'xpertiz_array_keys_blacklist' ) ) :

	/**
	 * Blacklist array
	 *
	 * @param array $array Array List.
	 * @param array $keys  Blacklisted keys.
	 * @return array
	 */
	function xpertiz_array_keys_blacklist( $array = array(), $keys = array() ) {
		foreach ( $array as $key => $value ) {
			if ( in_array( $key, $keys, true ) ) {
				unset( $array[ $key ] );
			}
		}

		return $array;
	}

endif;

if ( ! function_exists( 'xpertiz_limit_string_at_title' ) ) :

	/**
	 * Limit how many characters you want to display.
	 *
	 * @param string $text  Get Title Post.
	 * @return string
	 */
	function xpertiz_limit_string_at_title( $text ) {
		$text = substr( $text, 0, 33 );
		$sl = strlen( $text );
		if ( $sl > 30 ) {
			$text .= '...';
		}
		return $text;
	}

endif;

if ( ! function_exists( 'xpertiz_page_parents' ) ) :

	/**
	 * Get page or taxonomy like category or tags parent IDs.
	 *
	 * @param int    $id Page ID.
	 * @param string $type Parent Type.
	 * @return array
	 */
	function xpertiz_get_parent_ids( $id, $type = 'page' ) {
		$parent_ids = array();

		switch ( $type ) {
			case 'page':
				global $post;
				$parent_id = wp_get_post_parent_id( $id );
				break;

			case 'cat':
				$category = get_category( $id );
				$parent_id = $category->parent;
				break;
		}

		if ( 0 === $parent_id ) {
			return $parent_ids;
		}

		$parent_ids[] = $parent_id;
		$parent_ids = array_merge( xpertiz_get_parent_ids( $parent_id, $type ), $parent_ids );

		return $parent_ids;
	}
endif;

if ( ! function_exists( 'xpertiz_breadcrumbs' ) ) :

	/**
	 * Display bradcrumbs
	 *
	 * @return void
	 */
	function xpertiz_breadcrumbs() {
		if ( is_single() || is_page() ) {
			global $post;
		}

		if ( is_date() ) {
			global $wp_locale;
		}

		$queried_object = get_queried_object();

		if ( is_category() || is_tag() ) {
			$term_id = $queried_object->term_id;
		}

		// Template support schema.
		$active_template = '<span property="name">%s</span>';
		$link_template = '<a property="item" typeof="WebPage" title="%s" href="%s"><span property="name">%s</span></a>';
		$breadcrumb_template = '<span property="itemListElement" typeof="ListItem">%s<meta property="position" content="%s"></span>';

		// Breadcrumbs list.
		$breadcrumbs = array();

		if ( is_single() || is_category() || is_tag() || is_date() ) {
				$breadcrumbs[] = array(
					'title'    => esc_html( 'Home', 'xpertiz' ),
					'link'     => home_url( '/' ),
				);
		} else {
			$breadcrumbs[] = array(
				'title'    => esc_html( 'Home', 'xpertiz' ),
				'link'     => home_url( '/' ),
			);
		}

		// Add breadcrumbs in single.
		if ( is_single() ) {
			if ( is_attachment() ) {
				$breadcrumbs[] = array(
					'title'    => get_post( $queried_object->post_parent )->post_title,
					'link'     => get_permalink( $queried_object->post_parent ),
				);
			} else {
				// Post category.
				$categories = get_the_category( $post->ID );
				if ( isset( $categories[0] ) ) {
					$first_cat = isset( $categories[0] ) ? $categories[0] : '';
					$breadcrumbs[] = array(
						'title'    => $first_cat->cat_name,
						'link'     => get_category_link( $first_cat->cat_ID ),
					);
				}
			}
		}

		// Add breadcrumbs in page.
		if ( is_single() || is_page() ) {
			// If it's page and has parent.
			if ( is_page() ) {
				foreach ( xpertiz_get_parent_ids( $post->ID ) as $id ) {
					$breadcrumbs[] = array(
						'title'    => get_the_title( $id ),
						'link'     => get_the_permalink( $id ),
					);
				}
			}

			// Single post / page.
			$breadcrumbs[] = array(
				'title'    => get_the_title( $post->ID ),
				'link'     => get_the_permalink( $post->ID ),
			);
		}

		// Category archive.
		if ( is_category() ) {
			// Categories parent.
			foreach ( xpertiz_get_parent_ids( $term_id, 'cat' ) as $id ) {
				$breadcrumbs[] = array(
					'title'    => get_cat_name( $id ),
					'link'     => get_category_link( $id ),
				);
			}

			$breadcrumbs[] = array(
				'title'    => get_cat_name( $term_id ),
				'link'     => get_category_link( $term_id ),
			);
		}

		// Tag archive.
		if ( is_tag() ) {
			$tag = get_tag( $term_id );
			$breadcrumbs[] = array(
				'title'    => $tag->name,
				'link'     => get_tag_link( $term_id ),
			);
		}

		// Date archive.
		if ( is_date() ) {
			$year = get_query_var( 'year' );
			$month = get_query_var( 'monthnum' );

			if ( $year ) {
				$breadcrumbs[] = array(
					'title'    => $year,
					'link'     => get_year_link( $year ),
				);
			}

			if ( $month ) {
				$breadcrumbs[] = array(
					'title'    => $wp_locale->get_month( $month ),
					'link'     => get_month_link( $year, $month ),
				);
			}
		}

		if ( is_paged() ) {
			$breadcrumbs[] = array(
				/* translators: page number */
				'title'    => sprintf( esc_html__( 'Page %s', 'xpertiz' ), get_query_var( 'paged' ) ),
				'link'     => '',
			);
		}

		if ( is_search() ) {
			$breadcrumbs[] = array(
				/* translators: search query */
				'title'    => sprintf( esc_html__( 'Search result for &quot;%s&quot;', 'xpertiz' ), get_search_query() ),
				'link'     => '',
			);
		}

		if ( is_author() ) {
			$breadcrumbs[] = array(
				/* translators: author name */
				'title'    => sprintf( esc_html__( '%s Posts', 'xpertiz' ), get_the_author() ),
				'link'     => '',
			);
		}

		// Set breadcrumb class filters.
		$xpertiz_breadcrumb_class = apply_filters( 'xpertiz_breadcrumb_class', array() );
		$xpertiz_breadcrumb_class = implode( ' ', $xpertiz_breadcrumb_class );

		// Render content.
		$breadcrumb_length = count( $breadcrumbs ) - 1;
		$output = sprintf( '<div class="%s">', esc_attr( $xpertiz_breadcrumb_class ) );

		foreach ( $breadcrumbs as $index => $breadcrumb ) {
			$link = ( $index === $breadcrumb_length )
				? sprintf( $active_template, wp_kses( $breadcrumb['title'], 'post' ) )
				: sprintf( $link_template, esc_attr( $breadcrumb['title'] ), esc_url( $breadcrumb['link'] ), $breadcrumb['title'] );

			$output .= sprintf( $breadcrumb_template, $link, $index + 1 );
		}
		$output .= '</div>';
		echo wp_kses(
			$output, array(
				'div' => array(
					'class' => array(),
				),

				'span' => array(
					'property' => array(),
					'typeof'   => array(),
				),

				'meta' => array(
					'property' => array(),
					'content'  => array(),
				),

				'a' => array(
					'property' => array(),
					'typeof' => array(),
					'title' => array(),
					'href' => array(),
					'class' => array(),
				),

				'em' => array(),

				'b' => array(),

				'sup' => array(),
			)
		);
	}
endif;

if ( ! function_exists( 'xpertiz_entries_class' ) ) :

	/**
	 * Xpertiz entries class
	 *
	 * @since 1.0.0
	 */
	function xpertiz_entries_class() {

		// Define classes array.
		$classes = array();

		$classes[] = 'entry';

		// Style layout class.
		if ( 'xpertiz-masonry-layout' === xpertiz_theme_setting( 'style-layout' ) ) {
			$classes[] = 'grid-item';
		}

		if ( has_post_thumbnail() ) {
			$classes[] = 'has-thumbnail';
		}

		return $classes;
	}

endif;

if ( ! function_exists( 'xpertiz_related_posts' ) ) :

	/**
	 * Related posts.
	 *
	 * @param array $args get array of args.
	 * @return $related_posts
	 */
	function xpertiz_related_posts( $args = array() ) {
		global $post;

		// Create an array of current category ID's.
		$cats     = wp_get_post_terms( $post->ID, 'category' );
		$cats_ids = array();
		foreach ( $cats as $xpertiz_related_cat ) {
			$cats_ids[] = $xpertiz_related_cat->term_id;
		}

		if ( empty( $cats_ids ) ) {
			$cats_ids[] = 1;
		}

		if ( xpertiz_is_gutenberg_ready() ) {
			$posts_per_page = 3;
		} else {
			$posts_per_page = 4;
		}

		if ( empty( $args ) ) :
			$args = array(
				'posts_per_page' => $posts_per_page,
				'orderby'        => 'rand',
				'category__in'   => $cats_ids,
				'post__not_in'   => array( get_the_ID() ),
				'no_found_rows'  => true,
				'tax_query'      => array(
					'relation'  => 'AND',
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => array( 'post-format-quote', 'post-format-link' ),
						'operator' => 'NOT IN',
					),
				),
			);
		endif;

		$related_posts = new WP_Query( $args );

		if ( 'related-posts-off' === xpertiz_theme_setting( 'related-posts' ) && is_customize_preview() ) {
			$style = 'display:none';
		}

		return $related_posts;
	}

endif;

if ( ! function_exists( 'xpertiz_add_menu_parent_class' ) ) :

	/**
	 * Add Menu Parent Class.
	 *
	 * @param array $items Menu Items Array.
	 * @return $items Menu Items Array
	 */
	function xpertiz_add_menu_parent_class( $items ) {

		$parents = array();
		foreach ( $items as $item ) {
			if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
				$parents[] = $item->menu_item_parent;
			}
		}

		foreach ( $items as $item ) {
			if ( in_array( $item->ID, $parents, false ) ) {
				$item->classes[] = 'menu-parent-item';
			}
		}

		return $items;
	}
	add_filter( 'wp_nav_menu_objects', 'xpertiz_add_menu_parent_class' );

endif;

if ( ! function_exists( 'xpertiz_fallback_menu' ) ) :

	/**
	 * Xpertiz fallback menu function.
	 *
	 * @return string The Menu's HTML
	 */
	function xpertiz_fallback_menu() {
		$menu_args = array(
			'menu_id'        => 'header_navigation',
			'menu_class'     => 'main-menu nav navbar-nav ml-auto',
			'container'      => 'ul',
			'fallback_cb'    => 'xpertiz_wp_page_menu',
		);

		return wp_nav_menu( $menu_args );
	}
endif;

if ( ! function_exists( 'xpertiz_wp_page_menu' ) ) :

	/**
	 * Displays or retrieves a list of pages with an optional home link.
	 *
	 * The arguments are listed below and part of the arguments are for wp_list_pages()} function.
	 * Check that function for more info on those arguments.
	 *
	 * @param array|string $args {
	 *     Optional. Arguments to generate a page menu. See wp_list_pages() for additional arguments.
	 *
	 *     @type string          $sort_column  How to sort the list of pages. Accepts post column names.
	 *                                         Default 'menu_order, post_title'.
	 *     @type string          $menu_id      ID for the div containing the page list. Default is empty string.
	 *     @type string          $menu_class   Class to use for the element containing the page list. Default 'menu'.
	 *     @type string          $container    Element to use for the element containing the page list. Default 'div'.
	 *     @type bool            $echo         Whether to echo the list or return it. Accepts true (echo) or false (return).
	 *                                         Default true.
	 *     @type int|bool|string $show_home    Whether to display the link to the home page. Can just enter the text
	 *                                         you'd like shown for the home link. 1|true defaults to 'Home'.
	 *     @type string          $link_before  The HTML or text to prepend to $show_home text. Default empty.
	 *     @type string          $link_after   The HTML or text to append to $show_home text. Default empty.
	 *     @type string          $before       The HTML or text to prepend to the menu. Default is '<ul>'.
	 *     @type string          $after        The HTML or text to append to the menu. Default is '</ul>'.
	 *     @type string          $item_spacing Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'discard'.
	 *     @type Walker          $walker       Walker instance to use for listing pages. Default empty (Walker_Page).
	 * }
	 * @return string|void HTML menu
	 */
	function xpertiz_wp_page_menu( $args = array() ) {
		$args['walker'] = new Xpertiz_Walker_Page();

		return wp_page_menu( $args );
	}
endif;

if ( ! function_exists( 'xpertiz_page_css_class' ) ) :

	/**
	 * Xpertiz Page CSS Class function.
	 *
	 * @param array   $css_class    An array of CSS classes to be applied
	 *                              to each list item.
	 * @param WP_Post $page         Page data object.
	 * @param int     $depth        Depth of page, used for padding.
	 * @param array   $args         An array of arguments.
	 * @param int     $current_page ID of the current page.
	 *
	 * @return string The Menu's HTML
	 */
	function xpertiz_page_css_class( $css_class, $page, $depth, $args, $current_page ) {
		if ( ! isset( $args['menu_id'] ) ) {
			return $css_class;
		}

		if ( 'header_navigation' === $args['menu_id'] ) {
			// Desktop Version Navigation.
			if ( in_array( 'page_item_has_children', $css_class ) ) {
				$css_class[] = 'dropdown';
				$css_class[] = 'nav-item';

				if ( $depth > 0 ) {
					if ( is_rtl() ) {
						$css_class[] = 'icon-chevron-left';
					} else {
						$css_class[] = 'icon-chevron-right';
					}
				} else {
					$css_class[] = 'icon-chevron-down';
					$css_class[] = 'd-flex';
					$css_class[] = 'align-items-center';
				}
			}
		}

		return $css_class;
	}
	add_filter( 'page_css_class', 'xpertiz_page_css_class', 10, 5 );

endif;

if ( ! function_exists( 'xpertiz_page_menu_link_attributes' ) ) :

	/**
	 * Xpertiz Page CSS Class function.
	 *
	 * @param array   $atts {
	 *       The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
	 *
	 *     @type string $href The href attribute.
	 * }
	 * @param WP_Post $page         Page data object.
	 * @param int     $depth        Depth of page, used for padding.
	 * @param array   $args         An array of arguments.
	 * @param int     $current_page ID of the current page.
	 *
	 * @return string The Menu's HTML
	 */
	function xpertiz_page_menu_link_attributes( $atts, $page, $depth, $args, $current_page ) {
		if ( ! isset( $args['menu_id'] ) ) {
			return $atts;
		}

		if ( 'mobile_navigation' === $args['menu_id'] ) {
			// Mobile Version Navigation.
			$atts['class'] = esc_attr( 'nav-link' );
		} else {
			// Desktop Version Navigation.
			if ( $args['has_children'] ) {
				$atts['class'] = esc_attr( 'nav-link dropdown-item dropdown-toggle' );
			} else {
				$atts['class'] = esc_attr( 'nav-link' );
			}
		}

		return $atts;
	}
	add_filter( 'page_menu_link_attributes', 'xpertiz_page_menu_link_attributes', 10, 5 );

endif;

if ( ! function_exists( 'xpertiz_fallback_menu_mobile' ) ) :

	/**
	 * Xpertiz fallback menu mobile function.
	 *
	 * @return string The Menu's HTML
	 */
	function xpertiz_fallback_menu_mobile() {
		$menu_args = array(
			'menu_id'        => 'mobile_navigation',
			'menu_class'     => 'main-menu nav navbar-nav',
			'container'      => false,
			'fallback_cb'    => 'xpertiz_wp_page_menu',
			'walker'         => new xpertiz_mobile_nav_walker(),
		);

		return wp_nav_menu( $menu_args );
	}
endif;

if ( ! function_exists( 'xpertiz_is_gutenberg_ready' ) ) :

	/**
	 * Check if selected blog type is gutenberg ready function.
	 *
	 * @return string The Menu's HTML
	 */
	function xpertiz_is_gutenberg_ready() {
		$return = ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) ? true : false ;

		return $return;
	}
endif;

if ( ! function_exists( 'xpertiz_darken' ) ) :

	/**
	 * Darken Hex Color.
	 *
	 * @param string $colourstr       Color to dark.
	 * @param int    $procent         Dark Percentage.
	 * @return string Darken Color in Hex
	 */
	function xpertiz_darken( $colourstr, $procent = 0 ) {
		$colourstr = str_replace( '#','',$colourstr );
		$rhex = substr( $colourstr,0,2 );
		$ghex = substr( $colourstr,2,2 );
		$bhex = substr( $colourstr,4,2 );

		$r = hexdec( $rhex );
		$g = hexdec( $ghex );
		$b = hexdec( $bhex );

		$r = max( 0,min( 255,$r - ($r * $procent / 100) ) );
		$g = max( 0,min( 255,$g - ($g * $procent / 100) ) );
		$b = max( 0,min( 255,$b - ($b * $procent / 100) ) );

		return '#' . str_repeat( '0', 2 - strlen( dechex( $r ) ) ) . dechex( $r ) . str_repeat( '0', 2 - strlen( dechex( $g ) ) ) . dechex( $g ) . str_repeat( '0', 2 - strlen( dechex( $b ) ) ) . dechex( $b );
	}
endif;

if ( ! function_exists( 'xpertiz_lighten' ) ) :

	/**
	 * Lighten Hex Color.
	 *
	 * @param string $colourstr       Color to Light.
	 * @param int    $procent         Light Percentage.
	 * @return string Lighten Color in Hex.
	 */
	function xpertiz_lighten( $colourstr, $procent = 0 ) {

		$colourstr = str_replace( '#','',$colourstr );
		$rhex = substr( $colourstr,0,2 );
		$ghex = substr( $colourstr,2,2 );
		$bhex = substr( $colourstr,4,2 );

		$r = hexdec( $rhex );
		$g = hexdec( $ghex );
		$b = hexdec( $bhex );

		$r = max( 0,min( 255,$r + ($r * $procent / 100) ) );
		$g = max( 0,min( 255,$g + ($g * $procent / 100) ) );
		$b = max( 0,min( 255,$b + ($b * $procent / 100) ) );

		return '#' . str_repeat( '0', 2 - strlen( dechex( $r ) ) ) . dechex( $r ) . str_repeat( '0', 2 - strlen( dechex( $g ) ) ) . dechex( $g ) . str_repeat( '0', 2 - strlen( dechex( $b ) ) ) . dechex( $b );
	}

endif;

if ( ! function_exists( 'xpertiz_has_more_link' ) ) :
	/**
	 * Takes a WordPress post ID and checks if the post has a more link.
	 *
	 * @param  int $post_id Post ID.
	 * @return boolean  True if text exists before more tag, else false.
	 */
	function xpertiz_has_more_link( $post_id ) {

		$post = get_post( $post_id );
		$content = $post->post_content;
		$data_array = get_extended( $content );

		return '' !== $data_array['extended'];
	}
endif;
