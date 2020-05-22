<?php
/**
 * Template part for displaying related post in single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Xpertiz
 * @since 1.0
 * @version 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( get_post_type( get_the_ID() ) == 'recipe' && function_exists( 'ketocist_related_posts_show' ) ) {
	do_action( 'ketocist_related_posts_show' );
} else {

	$related_posts = xpertiz_related_posts();

	if ( $related_posts->have_posts() ) :
		?>

		<div class="related-posts">
		<h3><?php echo esc_html__( 'Related posts', 'xpertiz' ); ?></h3>

		<div class="row">
		<?php

		if ( xpertiz_is_gutenberg_ready() ) {
			$rows_count = 4;
		} else {
			$rows_count = 3;
		}

		foreach ( xpertiz_related_posts()->posts as $xpertiz_post ) :
			setup_postdata( $xpertiz_post );
			$classes = 'card-col col-lg-' . $rows_count . ' col-md-12';
			?>

			<div class="<?php echo esc_attr( $classes ); ?>">
			<div class="card">
				<?php
				if ( 'related-post-image-show' === xpertiz_theme_setting( 'related-post-image' ) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $xpertiz_post->ID ), 'medium' );
					$is_shortdesc = get_post_meta( $xpertiz_post->ID, '_short_desc', true );
					$is_time      = get_post_meta( $xpertiz_post->ID, '_time', true );
					$is_difficulty     = get_post_meta( $xpertiz_post->ID, '_difficulty', true );
					if ( ! empty( $image ) ) {
						$show_image = $image[0];
						?>
						<div class="featured-image" style="background-image: url('<?php echo esc_attr( $show_image ); ?>')">
						</div>
					<?php
					}
				}
				?>

					<div class="card-body d-flex flex-column justify-content-center">
						<h5 class="card-title"><a href="<?php echo esc_url( get_the_permalink( $xpertiz_post->ID ) ); ?>"><?php echo wp_kses( get_the_title( $xpertiz_post->ID ), 'post' ); ?></a></h5>
						<?php get_template_part( 'template-parts/single/related-posts-author' ); ?>
					</div>
				</div>
			</div>

<?php
		endforeach;
?>
		</div>
		</div>
		<?php
endif;
}
wp_reset_postdata();
?>
