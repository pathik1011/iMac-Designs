<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Xpertiz
 * @since 1.0.0
 */

get_header();

if ( 'xpertiz-blog-type-gutenberg-ready' === xpertiz_theme_setting( 'blog-type' ) ) :
	get_template_part( 'template-parts/gutenberg/page/page' );
else :
?>

	<div class="container">
		<div class="row">
			<div id="single-page" 
			<?php
			if ( is_home() ) {
				xpertiz_content_class();
			} else {
				echo wp_kses_data( 'class="' . esc_attr( 'xpertiz-content order-lg-1 col-12' ) . '"' );
			}
			?>
			>
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/page/content' );
					endwhile;

					comments_template();
				?>
			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php
endif;

get_footer();
?>
