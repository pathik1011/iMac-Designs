<?php
/**
 * Main Header Layout
 *
 * @package Xpertiz
 */

?>

<header id="header" class="<?php echo esc_attr( xpertiz_header_classes() ); ?>">
	<?php get_template_part( 'template-parts/header/navbar/topbar' ); ?>
	<?php get_template_part( 'template-parts/header/navbar/layout' ); ?>
</header>
