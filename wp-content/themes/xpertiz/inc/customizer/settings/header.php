<?php
/**
 * This file config of custom control for customizer.
 *
 * @package Xpertiz
 */

$xpertiz_customizer_settings['header-styling'] = array(
	'section'     => 'header-styling',
	'type'        => 'radio',
	'default'     => 'layout-boxed',
	'label'       => esc_html__( 'Header Style', 'xpertiz' ),
	'description' => esc_html__( 'This option affects your header layout. ( This control just temporary )' , 'xpertiz' ),
	'choices'     => array(
		'style-1' => esc_html__( 'Style 1', 'xpertiz' ),
		'style-2' => esc_html__( 'Style 2', 'xpertiz' ),
		'style-3' => esc_html__( 'Style 3', 'xpertiz' ),
		'style-4' => esc_html__( 'Style 4', 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['header_image_show_frontpage'] = array(
	'section'     => 'header_image',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'default'     => 'xpertiz-header-image-hide',
	'label'       => esc_html__( 'Display at Homepage', 'xpertiz' ),
	'choices'         => array(
		'xpertiz-header-image-show' => esc_html__( 'Show' , 'xpertiz' ),
		'xpertiz-header-image-hide' => esc_html__( 'Hide' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['header_image_show_on_page'] = array(
	'section'     => 'header_image',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'default'     => 'xpertiz-header-image-show',
	'label'       => esc_html__( 'Display at Single Page', 'xpertiz' ),
	'choices'         => array(
		'xpertiz-header-image-show' => esc_html__( 'Show' , 'xpertiz' ),
		'xpertiz-header-image-hide' => esc_html__( 'Hide' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['header_image_show_on_blog'] = array(
	'section'     => 'header_image',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'default'     => 'xpertiz-header-image-show',
	'label'       => esc_html__( 'Display at Blog', 'xpertiz' ),
	'choices'         => array(
		'xpertiz-header-image-show' => esc_html__( 'Show' , 'xpertiz' ),
		'xpertiz-header-image-hide' => esc_html__( 'Hide' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['header_image_show_on_post'] = array(
	'section'     => 'header_image',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'default'     => 'xpertiz-header-image-show',
	'label'       => esc_html__( 'Display at Single Post', 'xpertiz' ),
	'choices'         => array(
		'xpertiz-header-image-show' => esc_html__( 'Show' , 'xpertiz' ),
		'xpertiz-header-image-hide' => esc_html__( 'Hide' , 'xpertiz' ),
	),
);

if ( class_exists( 'WooCommerce' ) ) :
	$xpertiz_customizer_settings['header_image_show_on_shop'] = array(
		'section'     => 'header_image',
		'type'        => 'custom',
		'custom_type' => 'xpertiz-switcher',
		'default'     => 'xpertiz-header-image-hide',
		'label'       => esc_html__( 'Display at Shop', 'xpertiz' ),
		'choices'         => array(
			'xpertiz-header-image-show' => esc_html__( 'Show' , 'xpertiz' ),
			'xpertiz-header-image-hide' => esc_html__( 'Hide' , 'xpertiz' ),
		),
	);

	$xpertiz_customizer_settings['header_image_show_on_product'] = array(
		'section'     => 'header_image',
		'type'        => 'custom',
		'custom_type' => 'xpertiz-switcher',
		'default'     => 'xpertiz-header-image-hide-product',
		'label'       => esc_html__( 'Display at Single Product', 'xpertiz' ),
		'choices'         => array(
			'xpertiz-header-image-show-product' => esc_html__( 'Show' , 'xpertiz' ),
			'xpertiz-header-image-hide-product' => esc_html__( 'Hide' , 'xpertiz' ),
		),
	);
endif;
