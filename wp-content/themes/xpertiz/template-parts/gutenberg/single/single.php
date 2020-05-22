<?php
/**
 * The template for displaying single post.
 *
 * @package Xpertiz
 * @since 1.0.0
 */

?>

<div class="container-fluid">
	<article>
		<?php

		if ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/gutenberg/single/content' );

			comments_template();
		endif;

		?>
	</article>
</div>
