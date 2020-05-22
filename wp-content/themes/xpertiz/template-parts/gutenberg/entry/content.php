<?php
/**
 * Template part for displaying blog content in blog entriess.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Xpertiz
 * @since 1.0
 * @version 1.0
 */

$classes = xpertiz_entries_class();
$xpertiz_post_id = 'post-' . get_the_ID();

?>
<article id="<?php echo esc_attr( $xpertiz_post_id ); ?>" <?php post_class( $classes ); ?>>

  <header class="entry__header">
	<?php get_template_part( 'template-parts/entry/categories' ); ?>
	<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
	<?php get_template_part( 'template-parts/gutenberg/entry/meta' ); ?>
	<?php
	if ( has_post_thumbnail() ) {
			$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			echo wp_kses( '<div class="uf-card-header thumbnail" style="background-image: url(' . esc_attr( $url ) . ')" ><a href="' . esc_url( get_permalink() ) . '"><img src="' . esc_attr( $url ) . '" class="uf-hidden-post-thumbnail" /></a></div>', 'post' );
	} else {
?>
	<hr class="header_divider" />
<?php
	}
?>
  </header><!-- .entry__header -->

  <div class="entry__content clearfix">
	<?php
	if ( has_excerpt( $post->ID ) || is_search() ) :
		the_excerpt();
	  else :
			the_content( esc_html__( 'Read More', 'xpertiz' ) );

			wp_link_pages(
				array(
					'before' => '<div class="page-links">',
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after' => '</span>',
				)
			);
	  endif;
	?>
  </div><!-- .entry-content -->

  <div class="entry__footer clearfix">
	<?php get_template_part( 'template-parts/gutenberg/entry/footer' ); ?>
  </div>

</article><!-- #post-## -->
