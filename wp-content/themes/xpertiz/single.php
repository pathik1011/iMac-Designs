<?php
/**
 * The template for displaying single post.
 *
 * @package Xpertiz
 * @since 1.0.0
 */

get_header();

if ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) :
	get_template_part( 'template-parts/gutenberg/single/single' );
else :
?>

<div class="container">
	<div class="row">
		<article id="blog-post" class="xpertiz-content order-lg-1 col-lg-12 col-md-12">
			<?php

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/single/content' );

				comments_template();
			endwhile;

			?>
		</article>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
endif;

get_footer();
