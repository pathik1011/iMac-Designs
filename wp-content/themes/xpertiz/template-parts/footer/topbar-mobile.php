<?php
/**
 * Top Bar Mobile Layout
 *
 * @package Xpertiz
 */

if ( xpertiz_theme_setting( 'topbar-switch' ) !== 'true' ) {
	return;
}
?>

<div id="topbar-mobile" class="topbar-mobile">
	<div class="topbar-content">
		<div class="topbar-left">
<?php
			echo wp_kses( xpertiz_theme_setting( 'topbar-left' ), 'post' );
?>
		</div>
		<div class="topbar-right">
<?php
			echo wp_kses( xpertiz_theme_setting( 'topbar-right' ), 'post' );
?>
		</div>
	</div>
</div>
