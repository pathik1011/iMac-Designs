<?php
/**
 * Header Image
 *
 * @package Xpertiz
 */

global $wp_locale;

if ( is_404() ) {
	return;
}

if ( ! has_header_image() && ! xpertiz_is_gutenberg_ready() ) {
	return;
}

if ( 'xpertiz-header-image-hide' === xpertiz_theme_setting( 'header_image_show_frontpage' ) && is_front_page() ) {
	return;
}
if ( 'xpertiz-header-image-hide' === xpertiz_theme_setting( 'header_image_show_on_page' ) && is_page() ) {
	return;
}
if ( 'xpertiz-header-image-hide' === xpertiz_theme_setting( 'header_image_show_on_blog' ) &&
( is_home() || is_category() || is_tag() || is_search() || is_author() || is_date() ) ) {
	return;
}
if ( 'xpertiz-header-image-hide' === xpertiz_theme_setting( 'header_image_show_on_post' ) && is_single() ) {
	return;
}

if ( class_exists( 'WooCommerce' ) ) :
	if ( 'xpertiz-header-image-hide' === xpertiz_theme_setting( 'header_image_show_on_product' ) && is_product() ) {
		return;
	}
	if ( 'xpertiz-header-image-hide' === xpertiz_theme_setting( 'header_image_show_on_shop' ) &&
	( is_shop() || is_cart() || is_checkout() || is_woocommerce() ) ) {
		return;
	}
	if ( 'xpertiz-header-image-hide-product' === xpertiz_theme_setting( 'header_image_show_on_product' ) &&
	( is_shop() || is_cart() || is_checkout() || is_woocommerce() ) ) {
		return;
	}
endif;


$bg_thumbnail = '';

if ( has_post_thumbnail() ) :
	if ( is_single() || is_page() ) :
		$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		$bg_thumbnail = 'background-image: url(' . esc_attr( $url ) . ')';
	endif;
endif;

?>

<div id="header-image">
	<div id="header-image-bg" style="<?php echo esc_attr( $bg_thumbnail ); ?>">
		<div class="header-overlay">
			<div class="container d-flex flex-column align-items-center justify-content-center h-100 text-center site-title-wrapper">
				<?php if ( is_front_page() ) : ?>
					<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
				<?php else : ?>
					<?php
					$queried_object = get_queried_object();
					$xpertiz_title = '';

					set_query_var( 'ob', $queried_object );

					if ( is_home() && 'page' === get_option( 'show_on_front' ) ) :
						$xpertiz_title = get_the_title( get_option( 'page_for_posts' ) );
					elseif ( is_single() || is_page() ) :
						if ( is_single() && ( 'xpertiz-blog-type-gutenberg-ready' !== xpertiz_theme_setting( 'blog-type' ) ) ) :
							get_template_part( 'template-parts/single/categories' );
							get_template_part( 'template-parts/single/meta' );
						endif;

						$xpertiz_title = get_the_title();
					elseif ( is_category() ) :
						/* translators: %s: Category name */
						$xpertiz_title = sprintf( esc_html__( 'Category: %s' , 'xpertiz' ), get_cat_name( $queried_object->term_id ) );
					elseif ( is_tag() ) :
						/* translators: %s: Tag name */
						$xpertiz_title = sprintf( esc_html__( 'Tag: %s' , 'xpertiz' ), get_tag( $queried_object->term_id )->name );
					elseif ( is_search() ) :
						/* translators: %s: Search term */
						$xpertiz_title = sprintf( esc_html__( 'Search result for: %s' , 'xpertiz' ), get_search_query() );
					elseif ( is_author() ) :
						/* translators: %s: Author name */
						$xpertiz_title = sprintf( esc_html__( '%s Posts', 'xpertiz' ), get_the_author() );
					elseif ( is_date() ) :
						$year = get_query_var( 'year' );
						$month = get_query_var( 'monthnum' );

						if ( $year ) {
							/* translators: %s: Year */
							$xpertiz_title = sprintf( esc_html__( 'Year: %s' , 'xpertiz' ), $year );
						}

						if ( $month ) {
							/* translators: %s: Month */
							$xpertiz_title = sprintf( esc_html__( 'Month: %1$s %2$s' , 'xpertiz' ), $wp_locale->get_month( $month ), $year );
						}
					endif;

					if ( is_single() ) :
						if ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) :
							get_template_part( 'template-parts/single/categories' );
							endif;
						endif;
?>
					<div class="site-title"><?php echo wp_kses( $xpertiz_title, 'post' ); ?></div>
<?php
if ( is_single() ) :
	if ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) :
		get_template_part( 'template-parts/gutenberg/single/meta' );
	endif;
						endif;

					endif;
?>
			</div>
		</div>
	</div>
</div>
