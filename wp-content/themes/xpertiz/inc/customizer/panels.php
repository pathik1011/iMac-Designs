<?php
/**
 * This file config of panels customizer.
 *
 * @package Xpertiz
 */

$xpertiz_customizer_panels['site-identity-panel'] = array(
	'title' => esc_html__( 'Site Identities', 'xpertiz' ),
	'description' => esc_html__( 'Control your blog setting\'s, layout, sidebar position', 'xpertiz' ),
	'priority' => 10,
);

$xpertiz_customizer_panels['footer-panel'] = array(
	'title' => esc_html__( 'Footer', 'xpertiz' ),
	'description' => esc_html__( 'Control your footer setting\'s', 'xpertiz' ),
	'priority' => 110,
);
