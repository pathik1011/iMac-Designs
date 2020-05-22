<?php
/**
 * This file config of custom control for customizer.
 *
 * @package Xpertiz
 */

$xpertiz_customizer_settings['primary-color'] = array(
	'section'     => 'colors',
	'type'        => 'color',
	'default'     => '#355EBD',
	'transport'   => 'postMessage',
	'label'       => esc_html__( 'Brand Color', 'xpertiz' ),
	'description' => esc_html__( 'Change your brand color', 'xpertiz' ),
);
