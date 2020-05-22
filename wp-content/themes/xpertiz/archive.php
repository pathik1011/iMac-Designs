<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Xpertiz
 * @since 1.0
 * @version 1.0
 */

get_header();

if ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) :
	get_template_part( 'template-parts/gutenberg/index' );
else :
?>

<div class="container">
	<div class="row">
		<div <?php xpertiz_content_class(); ?>>
			<div id="archive-post">
				<?php if ( have_posts() ) : ?>
					<header class="archive-page-header">
						<?php
							the_archive_title(
								wp_kses(
									'<h3 class="archive-title">',
									array(
										'h3' => array(
											'class' => array(),
										),
									)
								),
								wp_kses(
									'</h3>',
									array(
										'h3' => array(
											'class' => array(),
										),
									)
								)
							);
						?>
					</header><!-- .page-header -->
					<div class="xpertiz-grid flip-effect" id="xpertiz-grid">
					<div class="grid-sizer"></div>
					<?php

					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/entry/content', get_post_format() );
					endwhile;
					?>
					</div>
				<?php endif; ?>
			</div><!-- #archive-post -->
		</div>
		<?php get_sidebar(); ?>
	</div>
</div><!-- .container -->

<?php
endif;

get_footer();
?>
