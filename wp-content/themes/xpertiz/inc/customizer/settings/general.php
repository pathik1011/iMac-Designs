<?php
/**
 * This file config of custom control for customizer.
 *
 * @package Xpertiz
 */

$xpertiz_customizer_settings['logo-height'] = array(
	'section'         => 'upload-logo',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-input-slider',
	'default'         => 27,
	'unit'            => 'px',
	'priority'        => 9,
	'label'           => esc_html__( 'Height', 'xpertiz' ),
	'description'     => esc_html__( 'Recomended logo height is 21px.' , 'xpertiz' ),
	'transport'       => 'postMessage',
	'input_attrs'     => array(
		'min'  => 10,
		'max'  => 250,
		'step' => 1,
	),
);

$xpertiz_customizer_settings['logo-sticky'] = array(
	'section'         => 'upload-logo',
	'type'            => 'image',
	'priority'        => 9,
	'default'         => '',
	'label'           => esc_html__( 'Logo Sticky', 'xpertiz' ),
	'transport'       => 'refresh',
);

$xpertiz_customizer_settings['logo-sticky-height'] = array(
	'section'         => 'upload-logo',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-input-slider',
	'default'         => 27,
	'unit'            => 'px',
	'priority'        => 9,
	'label'           => esc_html__( 'Logo Sticky Height', 'xpertiz' ),
	'description'     => esc_html__( 'Recomended logo height is 21px.' , 'xpertiz' ),
	'transport'       => 'postMessage',
	'input_attrs'     => array(
		'min'  => 10,
		'max'  => 250,
		'step' => 1,
	),
);

$xpertiz_customizer_settings['blog-type'] = array(
	'section'         => 'layout-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => 'xpertiz-blog-type-gutenberg-ready',
	'label'           => esc_html__( 'Blog Type', 'xpertiz' ),
	'transport'       => 'postMessage',
	'choices'         => array(
		'xpertiz-blog-type-gutenberg-ready'  => esc_html__( 'Gutenberg Ready' , 'xpertiz' ),
		'xpertiz-blog-type-classic-blog'  => esc_html__( 'Classic Blog' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['blog-layout'] = array(
	'section'         => 'layout-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => 'xpertiz-layout-fullwidth',
	'label'           => esc_html__( 'Blog Layout', 'xpertiz' ),
	'transport'       => 'postMessage',
	'choices'         => array(
		'xpertiz-layout-fullwidth'  => esc_html__( 'Fullwidth' , 'xpertiz' ),
		'xpertiz-layout-boxed'      => esc_html__( 'Boxed' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['style-layout'] = array(
	'section'         => 'layout-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => 'xpertiz-classic-layout',
	'label'           => esc_html__( 'Layout Styles', 'xpertiz' ),
	'transport'       => 'refresh',
	'choices'         => array(
		'xpertiz-classic-layout'  => esc_html__( 'Classic' , 'xpertiz' ),
		'xpertiz-masonry-layout'     => esc_html__( 'Masonry' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['sidebar-layout'] = array(
	'section'         => 'layout-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-image-selector',
	'default'         => 'sidebar-none',
	'transport'       => 'refresh',
	'label'           => esc_html__( 'Sidebar Option', 'xpertiz' ),
	'description'     => esc_html__( 'You can choose sidebar position on your site, is it in right, left, or no sidebar.' , 'xpertiz' ),
	'choices'         => array(
		'sidebar-right'  => array(
			'image' => XPERTIZ_THEME_URI . '/inc/customizer/assets/images/rs.png',
			'name' => esc_html__( 'Right Sidebar' , 'xpertiz' ),
		),
		'sidebar-none'  => array(
			'image' => XPERTIZ_THEME_URI . '/inc/customizer/assets/images/ns.png',
			'name' => esc_html__( 'None Sidebar' , 'xpertiz' ),
		),
		'sidebar-left'  => array(
			'image' => XPERTIZ_THEME_URI . '/inc/customizer/assets/images/ls.png',
			'name' => esc_html__( 'Left Sidebar' , 'xpertiz' ),
		),
	),
);

$xpertiz_customizer_settings['parallax-layout'] = array(
	'section'         => 'layout-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => 'xpertiz-header-parallax',
	'label'           => esc_html__( 'Header Image Scrolling', 'xpertiz' ),
	'transport'       => 'refresh',
	'choices'         => array(
		'xpertiz-header-parallax' => esc_html__( 'Parallax' , 'xpertiz' ),
		'xpertiz-header-none' => esc_html__( 'Static' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['dropdown-layout'] = array(
	'section'         => 'layout-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => 'xpertiz-dropdown-style',
	'label'           => esc_html__( 'Dropdown Style', 'xpertiz' ),
	'transport'       => 'refresh',
	'choices'         => array(
		'xpertiz-dropdown-style' => esc_html__( 'Selectize' , 'xpertiz' ),
		'xpertiz-dropdown-none' => esc_html__( 'Original' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['related-post-image'] = array(
	'section'     => 'layout-option',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'label'       => esc_html__( 'Related Post Image', 'xpertiz' ),
	'default'     => 'related-post-image-hidden',
	'choices'     => array(
		'related-post-image-hidden'  => esc_html__( 'Hidden' , 'xpertiz' ),
		'related-post-image-show'    => esc_html__( 'Show' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['breadcrumbs-option'] = array(
	'section'     => 'layout-option',
	'type'        => 'custom',
	'custom_type' => 'xpertiz-switcher',
	'label'       => esc_html__( 'Breadcrumbs', 'xpertiz' ),
	'default'     => 'breadcrumbs-show',
	'choices'     => array(
		'breadcrumbs-hidden'  => esc_html__( 'Hidden' , 'xpertiz' ),
		'breadcrumbs-show'    => esc_html__( 'Show' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['sticky-layout'] = array(
	'section'         => 'menu-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => 'xpertiz-sticky',
	'label'           => esc_html__( 'Navigation Position', 'xpertiz' ),
	'transport'       => 'refresh',
	'choices'         => array(
		'xpertiz-sticky' => esc_html__( 'Sticky' , 'xpertiz' ),
		'xpertiz-scroll' => esc_html__( 'Scroll' , 'xpertiz' ),
	),
);

$xpertiz_customizer_settings['navbar-font-color'] = array(
	'section'     => 'menu-option',
	'type'        => 'color',
	'default'     => '#333333',
	'transport'   => 'refresh',
	'label'       => esc_html__( 'Font & Background Color', 'xpertiz' ),
);

$xpertiz_customizer_settings['navbar-background-color'] = array(
	'section'     => 'menu-option',
	'type'        => 'color-alpha',
	'default'     => '#ffffff',
	'capability'  => 'edit_theme_options',
	'transport'   => 'refresh',
	'show_opacity'  => true,
	'palette'   => array(
		'rgb(150, 50, 220)',
		'rgba(50,50,50,0.8)',
		'rgba( 255, 255, 255, 0.2 )',
		'#00CC99',
	),
);

$xpertiz_customizer_settings['navbar-font-sticky-color'] = array(
	'section'     => 'menu-option',
	'type'        => 'color',
	'default'     => '#333333',
	'transport'   => 'refresh',
	'label'       => esc_html__( 'Font & Background Color Sticky', 'xpertiz' ),
);

$xpertiz_customizer_settings['navbar-background-sticky-color'] = array(
	'section'     => 'menu-option',
	'type'        => 'color-alpha',
	'default'     => '#ffffff',
	'capability'  => 'edit_theme_options',
	'transport'   => 'refresh',
	'show_opacity'  => true,
	'palette'   => array(
		'rgb(150, 50, 220)',
		'rgba(50,50,50,0.8)',
		'rgba( 255, 255, 255, 0.2 )',
		'#00CC99',
	),
);

$xpertiz_customizer_settings['navbar-bottom-border'] = array(
	'section'         => 'menu-option',
	'type'            => 'custom',
	'custom_type'     => 'xpertiz-switcher',
	'default'         => '1px solid #e3e3e3',
	'label'           => esc_html__( 'Bottom Border on Homepage', 'xpertiz' ),
	'transport'       => 'refresh',
	'choices'         => array(
		'none'              => esc_html__( 'Hide' , 'xpertiz' ),
		'1px solid #e3e3e3' => esc_html__( 'Show' , 'xpertiz' ),
	),
);
