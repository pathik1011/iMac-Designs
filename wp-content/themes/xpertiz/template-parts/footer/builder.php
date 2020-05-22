<?php
/**
 * The template for displaying footer widgets or custom page container.
 *
 * @package Xpertiz
 * @since 1.0.0
 */

$postid = get_the_ID();
$footerpage = xpertiz_theme_setting( 'footer-content' );

if ( get_theme_mod( 'footer-option', 'footer-widget' ) === 'footer-widget' || ! $footerpage || $postid === $footerpage ) {
	return;
}

?>

<div id="builder">
	<div class="row d-flex flex-wrap">
	<?php
		do_action( 'detheme_display_footer_builder' );
	?>

	</div><!-- .row -->
</div><!-- #builder -->
