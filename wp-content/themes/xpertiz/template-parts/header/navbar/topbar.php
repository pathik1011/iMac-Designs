<?php
/**
 * Top Bar Layout
 *
 * @package Xpertiz
 */

if ( xpertiz_theme_setting( 'topbar-switch' ) !== 'true' ) {
	return;
}
?>

<div id="topbar" class="topbar-desktop d-none d-lg-block">
	<div class="container">
		<div class="row topbar-content">
			<div class="topbar-left col-12 col-sm-6">
<?php
				echo wp_kses( xpertiz_theme_setting( 'topbar-left' ), 'post' );
?>
			</div>
			<div class="topbar-right col-12 col-sm-6">
<?php
				echo wp_kses( xpertiz_theme_setting( 'topbar-right' ), 'post' );
?>
			</div>
		</div>
	</div>
</div>
