<?php
/**
 * Template part for displaying blog content in single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Xpertiz
 * @since 1.0
 * @version 1.0
 */

?>

<div class="uf-single-post">

	<header class="uf-single-post__title" itemscope>
		<?php if ( ! has_header_image() && ! xpertiz_is_gutenberg_ready() ) : ?>
			<?php get_template_part( 'template-parts/single/categories' ); ?>
			<?php get_template_part( 'template-parts/gutenberg/single/meta' ); ?>
			<h1 class="uf-single-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1><!-- .uf-single-post-title -->
		<?php endif; ?>
	</header>

	<div class="single__content clearfix">
		<?php
		if ( has_excerpt() ) {
			the_excerpt();
		}
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">',
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after' => '</span>',
				)
			);
		?>
	</div>
	
	<div class="entry__footer clearfix">
		<?php get_template_part( 'template-parts/gutenberg/entry/footer' ); ?>
	  </div>

	<div class="single__author clearfix">
		<?php get_template_part( 'template-parts/single/author' ); ?>
	</div>

	<?php
	the_post_navigation(
		array(
			'prev_text' => '<i class="icon-chevron-left"></i><span class="xpertiz_nav_text"><span>' . esc_html__( 'Previous', 'xpertiz' ) . '</span><span>%title</span></span>',
			'next_text' => '<i class="icon-chevron-right"></i><span class="xpertiz_nav_text"><span>' . esc_html__( 'Next', 'xpertiz' ) . '</span><span>%title</span></span>',
		)
	);
	?>

	<?php get_template_part( 'template-parts/single/related-posts' ); ?>

</div>
