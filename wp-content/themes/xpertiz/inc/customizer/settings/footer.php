<?php
/**
 * This file config of custom control for customizer.
 *
 * @package Xpertiz
 */

if ( function_exists( 'detheme_display_footer_builder' ) ) {
	$xpertiz_customizer_settings['footer-option'] = array(
		'section'         => 'footer-section',
		'type'            => 'select',
		'default'         => 'footer-widget',
		'label'           => esc_html__( 'Select Footer', 'xpertiz' ),
		'transport'       => 'refresh',
		'description'     => esc_html__( 'Select widget or page to appear on Footer.' , 'xpertiz' ),
		'choices'         => array(
			'footer-widget' => esc_html__( 'Footer from Widget' , 'xpertiz' ),
			'footer-page'   => esc_html__( 'Footer from Page' , 'xpertiz' ),
		),
	);

	$xpertiz_customizer_settings['footer-url'] = array(
		'section'         => 'footer-section',
		'type'            => 'custom',
		'custom_type'     => 'xpertiz-link',
		'default'         => '',
		'label'           => esc_html__( 'Click here to edit footer widgets', 'xpertiz' ),
		'description'     => esc_html__( '#', 'xpertiz' ),
		'transport'       => 'refresh',
	);

	$xpertiz_customizer_settings['footer-content'] = array(
		'section'         => 'footer-section',
		'type'            => 'select',
		'default'         => 'xpertiz-page-1',
		'label'           => esc_html__( 'Footer from Page', 'xpertiz' ),
		'transport'       => 'refresh',
		'description'     => esc_html__( 'Select a page to appear on Footer.' , 'xpertiz' ),
		'choices'         => detheme_get_pages_array(),
	);
}

$xpertiz_customizer_settings['footer-display-copyright'] = array(
	'section'     => 'footer-section',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'label'       => esc_html__( 'Copyright Text', 'xpertiz' ),
	'description' => esc_html__( 'Write your copyright', 'xpertiz' ),
	'default'     => true,
	'choices'     => array(
		false   => esc_html__( 'Hidden' , 'xpertiz' ),
		true    => esc_html__( 'Show' , 'xpertiz' ),
	),
);

/* translators: %s: site legal */
$default = sprintf( esc_html__( 'Copyright %s', 'xpertiz' ), get_bloginfo( 'name' ) );

$xpertiz_customizer_settings['footer-legal'] = array(
	'section'     => 'footer-section',
	'type'        => 'textarea',
	'default'     => $default,
	'transport'   => 'postMessage',
	'input_attrs' => array(
		'class' => 'my-custom-class',
		'placeholder' => esc_html__( 'Enter message...', 'xpertiz' ),
	),
);
