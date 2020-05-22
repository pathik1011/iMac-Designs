<?php
/**
 * The template for displaying copyright on footer.
 *
 * @package Xpertiz
 * @since 1.0.0
 */

if ( ! get_theme_mod( 'footer-display-copyright', true ) ) {
	return;
}
?>
<div id="legal">
	<?php echo wp_kses( xpertiz_theme_setting( 'footer-legal' ), 'post' ); ?>
</div><!-- #legal -->
