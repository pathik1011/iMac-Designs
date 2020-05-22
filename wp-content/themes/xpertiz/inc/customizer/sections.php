<?php
/**
 * This file config of sections for customizer.
 *
 * @package Xpertiz
 */

$xpertiz_customizer_sections['upload-logo'] = array(
	'title' => esc_html__( 'Logo', 'xpertiz' ),
	'panel' => 'site-identity-panel',
	'priority' => 10,
);

$xpertiz_customizer_sections['address-icon'] = array(
	'title' => esc_html__( 'Favicon', 'xpertiz' ),
	'panel' => 'site-identity-panel',
	'priority' => 40,
);

$xpertiz_customizer_sections['colors'] = array(
	'title' => esc_html__( 'Brand Color', 'xpertiz' ),
	'panel' => 'site-identity-panel',
	'priority' => 60,
);

$xpertiz_customizer_sections['copyright-text'] = array(
	'title' => esc_html__( 'Copyright Text', 'xpertiz' ),
	'panel' => 'site-identity-panel',
	'priority' => 100,
);

// Xpertiz sections.
$xpertiz_customizer_sections['layout-option'] = array(
	'title' => esc_html__( 'Layout Options', 'xpertiz' ),
	'panel' => '',
	'priority' => 20,
);

// Xpertiz Navigation Bar Sticky Menu.
$xpertiz_customizer_sections['menu-option'] = array(
	'title' => esc_html__( 'Navigation Bar', 'xpertiz' ),
	'panel' => '',
	'priority' => 20,
);

// Xpertiz Top Bar.
$xpertiz_customizer_sections['top-bar'] = array(
	'title' => esc_html__( 'Top Bar', 'xpertiz' ),
	'panel' => '',
	'priority' => 30,
);

// Move WordPress default sections to xpertiz sections.
$wp_customizer_sections['static_front_page'] = array(
	'priority' => 40,
);

$wp_customizer_sections['title_tagline'] = array(
	'panel' => 'site-identity-panel',
	'title' => esc_html__( 'Site Title', 'xpertiz' ),
	'priority' => 20,
);

$wp_customizer_sections['header_image'] = array(
	'title' => esc_html__( 'Header Image', 'xpertiz' ),
	'priority' => 100,
);

if ( ! function_exists( 'detheme_display_footer_builder' ) ) {
	$xpertiz_customizer_sections['footer-section'] = array(
		'title' => esc_html__( 'Footer', 'xpertiz' ),
		'panel' => 'site-identity-panel',
		'priority' => 110,
	);
}

$wp_customizer_sections['custom_css'] = array(
	'title' => esc_html__( 'Custom CSS', 'xpertiz' ),
	'priority' => 120,
);
