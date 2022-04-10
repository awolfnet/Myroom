<?php
if (!defined('ABSPATH')) die('-1');
if(!class_exists('Kirki')) return;
/**
 *
 * Web APP
 *
 */
Kirki::add_section( 'flatmobile_web_app_section', array(
		'title'          => esc_html__( 'Web App', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_web_app', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_web_app',
) );


Kirki::add_field( 'flatmobile_web_app', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_web_app_capable',
		'label'       => esc_html__( 'Activity', 'flatmobile' ),
		'section'     => 'flatmobile_web_app_section',
		'default'     => 'on',
		'priority'    => 25,
		'choices'     => array(
				'on'  => esc_html__( 'On', 'flatmobile' ),
				'off' => esc_html__( 'Off', 'flatmobile' ),
		),
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_web_app_status_bar',
		'label'       => esc_html__( 'Status Bar Style', 'flatmobile' ),
		'section'     => 'flatmobile_web_app_section',
		'default'     => 'black',
		'priority'    => 25,
		'choices'     => array(
				'black'             => esc_html__( 'Black', 'flatmobile' ),
				'black-translucent' => esc_html__( 'Black Translucent', 'flatmobile' ),
		),
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'web_app_ipad_retina_portrait',
		'label'         => esc_html__( 'iPad Retina Portrait | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 1536x2008', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_ipad_retina_landscape',
		'label'         => esc_html__( 'iPad Retina Landscape | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 1496x2048', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_ipad_portrait',
		'label'         => esc_html__( 'iPad Portrait | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 768x1004', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_ipad_landscape',
		'label'         => esc_html__( 'iPad Landscape | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 748x1024', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_iphone_6_plus_portrait',
		'label'         => esc_html__( 'iPhone 6 Plus Portrait | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 1242x2148', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_iphone_6_plus_landscape',
		'label'         => esc_html__( 'iPhone 6 Plus Landscape | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 1182x2208', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_iphone_6_portrait',
		'label'         => esc_html__( 'iPhone 6 Portrait | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 750x1294', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_iphone_6_landscape',
		'label'         => esc_html__( 'iPhone 6 Landscape | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 640x1096', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_iphone_retina_5_and_lower',
		'label'         => esc_html__( 'iPhone Retina < 5 | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 640x920', 'flatmobile' ),
		'section'       => 'flatmobile_flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_web_app', array(
		'settings'      => 'flatmobile_web_app_iphone_5_and_lower',
		'label'         => esc_html__( 'iPhone < 5 | Startup Image', 'flatmobile' ),
		'description'   => esc_html__( 'Required dimensions: 320x460', 'flatmobile' ),
		'section'       => 'flatmobile_web_app_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );



/**
 *
 * Favicons
 *
 */
Kirki::add_section( 'flatmobile_favicons_section', array(
		'title'          => esc_html__( 'Fav Icons', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_favicons', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_favicons',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_favicons_16_16',
		'label'         => esc_html__( 'Favicon 16x16', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_favicons_32_32',
		'label'         => esc_html__( 'Favicon 32x32', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_favicons_96_96',
		'label'         => esc_html__( 'Favicon 96x96', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_favicons_192_192',
		'label'         => esc_html__( 'Favicon 192x192', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_favicons_194_194',
		'label'         => esc_html__( 'Favicon 194x194', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_57x57',
		'label'         => esc_html__( 'Apple Touch Icon 57x57', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_60x60',
		'label'         => esc_html__( 'Apple Touch Icon 60x60', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_72x72',
		'label'         => esc_html__( 'Apple Touch Icon 72x72', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_76x76',
		'label'         => esc_html__( 'Apple Touch Icon 76x76', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_114x114',
		'label'         => esc_html__( 'Apple Touch Icon 114x114', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_120x120',
		'label'         => esc_html__( 'Apple Touch Icon 120x120', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_144x144',
		'label'         => esc_html__( 'Apple Touch Icon 144x144', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_152x152',
		'label'         => esc_html__( 'Apple Touch Icon 152x152', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );

Kirki::add_field( 'flatmobile_favicons', array(
		'settings'      => 'flatmobile_apple_touch_180x180',
		'label'         => esc_html__( 'Apple Touch Icon 180x180', 'flatmobile' ),
		'description'   => esc_html__( 'Must be PNG file type', 'flatmobile' ),
		'section'       => 'flatmobile_favicons_section',
		'type'          => 'image',
		'priority'      => 25,
		'default'       => '',
) );



/**
 *
 * Logo
 *
 */
Kirki::add_section( 'flatmobile_logo_section', array(
		'title'          => esc_html__( 'Logo', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_logo', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_logo',
) );

Kirki::add_field( 'flatmobile_logo', array(
		'settings' => 'flatmobile_url',
		'label'    => esc_html__( 'Image', 'flatmobile' ),
		'section'  => 'flatmobile_logo_section',
		'type'     => 'image',
		'priority' => 10,
		'default'  => '',
) );

Kirki::add_field( 'flatmobile_logo', array(
		'type'        => 'slider',
		'settings'    => 'flatmobile_height',
		'label'       => esc_html__( 'Height', 'flatmobile' ),
		'section'     => 'flatmobile_logo_section',
		'default'     => 15,
		'priority'    => 10,
		'choices'     => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 1
		),
		'output' => ( '15' != flatmobile::option( 'flatmobile_logo', 'flatmobile_height' ) ) ? array(
				array(
						'element'  => '.tc-logo img',
						'property' => 'height',
						'units'    => 'px',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars'   => array(
				array(
						'element'  => '.tc-logo img',
						'function' => 'css',
						'property' => 'height',
						'units'    => 'px',
				),
		)
) );



/**
 *
 * Typography
 *
 */
Kirki::add_section( 'flatmobile_typography_section', array(
		'title'          => esc_html__( 'Typography', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_typography', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_typography',
) );

Kirki::add_field( 'flatmobile_typography', array(
		'type' => 'select',
		'settings' => 'flatmobile_base_font_family',
		'label' => esc_html__( 'Font Family', 'flatmobile' ),
		'section' => 'flatmobile_typography_section',
		'default' => 'Lato',
		'priority' => 20,
		'choices' => Kirki_Fonts::get_font_choices(),
		'output' => array(
				array(
						'element'  => 'body',
						'property' => 'font-family',
				),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
				array(
						'element'  => 'body',
						'function' => 'css',
						'property' => 'font-family',
				),
		)
) );

Kirki::add_field( 'flatmobile_typography', array(
		'type' => 'slider',
		'settings' => 'flatmobile_base_font_weight',
		'label' => esc_html__( 'Font Weight', 'flatmobile' ),
		'section' => 'flatmobile_typography_section',
		'default' => 400,
		'priority' => 24,
		'choices' => array(
				'min' => 100,
				'max' => 900,
				'step' => 100,
		),
		'output' => ( '400' != flatmobile::option( 'flatmobile_typography', 'flatmobile_base_font_weight' ) ) ? array(
				array(
						'element'  => 'body',
						'property' => 'font-weight',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => 'body',
						'function' => 'css',
						'property' => 'font-weight',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_typography', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_base_font_color',
		'label'       => esc_html__( 'Body Font Color', 'flatmobile' ),
		'section'     => 'flatmobile_typography_section',
		'default'     => 'rgba(0,0,0,0.6)',
		'priority'    => 24,
		'output' => ( 'rgba(0,0,0,0.6)' != flatmobile::option( 'flatmobile_typography', 'flatmobile_base_font_color' ) ) ? array(
				array(
						'element'  => 'body',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => 'body',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_typography', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_headings_font_color',
		'label'       => esc_html__( 'Headings Font Color', 'flatmobile' ),
		'section'     => 'flatmobile_typography_section',
		'default'     => 'rgba(0,0,0,0.87)',
		'priority'    => 24,
		'output' => ( 'rgba(0,0,0,0.87)' != flatmobile::option( 'flatmobile_typography', 'flatmobile_headings_font_color' ) ) ? array(
				array(
						'element'  => 'h1,h2,h3,h4,h5,h6',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => 'h1,h2,h3,h4,h5,h6',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_typography', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_links_font_color',
		'label'       => esc_html__( 'Links Font Color', 'flatmobile' ),
		'section'     => 'flatmobile_typography_section',
		'default'     => 'rgba(103,58,183,1)',
		'priority'    => 24,
		'output' => ( 'rgba(103,58,183,1)' != flatmobile::option( 'flatmobile_typography', 'flatmobile_links_font_color' ) ) ? array(
				array(
						'element'  => '.inner a',
						'property' => 'color',
						'units'    => '',
				),
				array(
						'element'  => '.tc-filters a.active:after,.bg-deeppurple',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.inner a',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
				array(
						'element' => '.tc-filters a.active:after,.bg-deeppurple',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

$font_types = array(
		'base' => array(
				'label' => '',
				'element' => 'body',
				'default' => array(
						'size' => 14,
						'line' => 30
				)
		),
		'h1' => array(
				'label' => 'H1 ',
				'element' => 'h1',
				'default' => array(
						'size' => 30,
						'line' => 40
				)
		),
		'h2' => array(
				'label' => 'H2 ',
				'element' => 'h2',
				'default' => array(
						'size' => 24,
						'line' => 44
				)
		),
		'h3' => array(
				'label' => 'H3 ',
				'element' => 'h3',
				'default' => array(
						'size' => 20,
						'line' => 28
				)
		),
		'h4' => array(
				'label' => 'H4 ',
				'element' => 'h4',
				'default' => array(
						'size' => 16,
						'line' => 22
				)
		),
		'h5' => array(
				'label' => 'H5 ',
				'element' => 'h5',
				'default' => array(
						'size' => 11,
						'line' => 16
				)
		),
		'h6' => array(
				'label' => 'H6 ',
				'element' => 'h6',
				'default' => array(
						'size' => 8,
						'line' => 12
				)
		),
);

foreach ( $font_types as $font_type => $val ):
	Kirki::add_field( 'flatmobile_typography', array(
			'type' => 'slider',
			'settings' => 'flatmobile_'.$font_type.'_font_size',
			'label' => $val['label'].esc_html__( 'Font Size', 'flatmobile' ),
			'section' => 'flatmobile_typography_section',
			'default' => $val['default']['size'],
			'priority' => 25,
			'choices' => array(
					'min' => 7,
					'max' => 48,
					'step' => 1,
			),
			'output' => ( $val['default']['size'] != flatmobile::option( 'flatmobile_typography', 'flatmobile_'.$font_type.'_font_size' ) ) ? array(
					array(
							'element'  => $val['element'],
							'property' => 'font-size',
							'units'    => 'px',
					),
			) : null,
			'transport' => 'postMessage',
			'js_vars' => array(
					array(
							'element' => $val['element'],
							'function' => 'css',
							'property' => 'font-size',
							'units' => 'px'
					),
			),
	) );

	Kirki::add_field( 'flatmobile_typography', array(
			'type' => 'slider',
			'settings' => 'flatmobile_'.$font_type.'_line_height',
			'label' => $val['label'].esc_html__( 'Line Height', 'flatmobile' ),
			'section' => 'flatmobile_typography_section',
			'default' => $val['default']['line'],
			'priority' => 25,
			'choices' => array(
					'min' => 7,
					'max' => 70,
					'step' => 1,
			),
			'output' => ( $val['default']['line'] != flatmobile::option( 'flatmobile_typography', 'flatmobile_'.$font_type.'_line_height' ) ) ? array(
					array(
							'element'  => $val['element'],
							'property' => 'line-height',
							'units'    => 'px',
					),
			) : null,
			'transport' => 'postMessage',
			'js_vars' => array(
					array(
							'element' => $val['element'],
							'function' => 'css',
							'property' => 'line-height',
							'units' => 'px'
					),
			),
	) );
endforeach;



/**
 *
 * Navigation Bar
 *
 */
Kirki::add_section( 'flatmobile_navbar_section', array(
		'title'          => esc_html__( 'Navigation Bar', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_navbar', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_navbar',
) );

Kirki::add_field( 'flatmobile_navbar', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_navbar_bg_color',
		'label'       => esc_html__( 'Background Color', 'flatmobile' ),
		'section'     => 'flatmobile_navbar_section',
		'default'     => 'rgba(103, 58, 183, 1)',
		'priority'    => 24,
		'output' => ( 'rgba(103, 58, 183, 1)' != flatmobile::option( 'flatmobile_navbar', 'flatmobile_navbar_bg_color' ) ) ? array(
				array(
						'element'  => '.navbar,.navbar.navbar-fixed.colored',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.navbar,.navbar.navbar-fixed.colored',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_navbar', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_links_icon_color',
		'label'       => esc_html__( 'Icon Color', 'flatmobile' ),
		'section'     => 'flatmobile_navbar_section',
		'default'     => 'rgba(255,255,255,0.87)',
		'priority'    => 24,
		'output' => ( 'rgba(255,255,255,0.87)' != flatmobile::option( 'flatmobile_navbar', 'flatmobile_links_icon_color' ) ) ? array(
				array(
						'element'  => '.navbar .icon-only',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.navbar .icon-only',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );



/**
 *
 * Layout Coloring
 *
 */
Kirki::add_section( 'flatmobile_layout_coloring_section', array(
		'title'          => esc_html__( 'Layout Coloring', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_layout_coloring', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_layout_coloring',
) );

Kirki::add_field( 'flatmobile_layout_coloring', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_card_bg',
		'label'       => esc_html__( 'Card Background', 'flatmobile' ),
		'section'     => 'flatmobile_layout_coloring_section',
		'default'     => 'rgba(255, 255, 255, 1)',
		'priority'    => 24,
		'output' => ( 'rgba(255, 255, 255, 1)' != flatmobile::option( 'flatmobile_layout_coloring', 'flatmobile_card_bg' ) ) ? array(
				array(
						'element'  => '.ms-card',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-card',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_layout_coloring', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_content_bg',
		'label'       => esc_html__( 'Content Background', 'flatmobile' ),
		'section'     => 'flatmobile_layout_coloring_section',
		'default'     => 'rgba(236, 236, 236, 1)',
		'priority'    => 24,
		'output' => ( 'rgba(236, 236, 236, 1)' != flatmobile::option( 'flatmobile_layout_coloring', 'flatmobile_content_bg' ) ) ? array(
				array(
						'element'  => '.tc-page',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.tc-page',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_layout_coloring', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_body_bg',
		'label'       => esc_html__( 'Body Background', 'flatmobile' ),
		'section'     => 'flatmobile_layout_coloring_section',
		'default'     => 'rgba(103,58,183,1)',
		'priority'    => 24,
		'output' => ( 'rgba(103,58,183,1)' != flatmobile::option( 'flatmobile_layout_coloring', 'flatmobile_body_bg' ) ) ? array(
				array(
						'element'  => 'body',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => 'body',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_layout_coloring', array(
		'settings' => 'flatmobile_body_image',
		'label'    => esc_html__( 'Body Image', 'flatmobile' ),
		'section'  => 'flatmobile_layout_coloring_section',
		'type'     => 'image',
		'priority' => 25,
		'default'  => ''
) );



/**
 *
 * Panels
 *
 */
Kirki::add_section( 'flatmobile_panels', array(
		'title'          => esc_html__( 'Panels', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_mspanels', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_mspanels',
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_panels_type',
		'label'       => esc_html__( 'Panels Type', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => 'ms-panels-blur',
		'priority'    => 24,
		'choices'     => array(
				'ms-panels-3d' => '3D',
				'ms-panels-blur' => 'Blur'
		)
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_panels_background_color',
		'label'       => esc_html__( 'Background Color', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => 'rgba(103, 58, 183, 1)',
		'priority'    => 24,
		'output' => ( 'rgba(103, 58, 183, 1)' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_background_color' ) ) ? array(
				array(
						'element'  => '.ms-panel.position-left',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-panel.position-left',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'settings'      => 'flatmobile_panels_left_background_image',
		'label'         => esc_html__( 'Left Panel Background Image', 'flatmobile' ),
		'section'       => 'flatmobile_panels',
		'type'          => 'image',
		'priority'      => 24,
		'output' => ( '' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_left_background_image' ) ) ? array(
				array(
						'element'  => '.ms-panel.position-left',
						'property' => 'background-image'
				),
		) : null
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_panels_right_background_color',
		'label'       => esc_html__( 'Right Panel Background Color', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => 'rgba(103, 58, 183, 1)',
		'priority'    => 24,
		'output' => ( 'rgba(103, 58, 183, 1)' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_background_color' ) ) ? array(
				array(
						'element'  => '.ms-panel.position-right',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-panel.position-right',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'settings'      => 'flatmobile_panels_right_background_image',
		'label'         => esc_html__( 'Right Panel Background Image', 'flatmobile' ),
		'section'       => 'flatmobile_panels',
		'type'          => 'image',
		'priority'      => 24,
		'output' => ( '' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_right_background_image' ) ) ? array(
				array(
						'element'  => '.ms-panel.position-right',
						'property' => 'background-image'
				),
		) : null
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type' => 'slider',
		'settings' => 'flatmobile_panels_font_size',
		'label' => esc_html__( 'Font Size', 'flatmobile' ),
		'section' => 'flatmobile_panels',
		'default' => 12,
		'priority' => 25,
		'choices' => array(
				'min' => 7,
				'max' => 48,
				'step' => 1,
		),
		'output' => ( '12' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_font_size' ) ) ? array(
				array(
						'element'  => '.ms-panel',
						'property' => 'font-size',
						'units'    => 'px',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-panel',
						'function' => 'css',
						'property' => 'font-size',
						'units' => 'px'
				),
		),
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_panels_font_weight',
		'label'       => esc_html__( 'Font Weight', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => '300',
		'priority'    => 25,
		'choices'     => array(
				'100' => '100',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
		'output' => ( '300' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_font_weight' ) ) ? array(
				array(
						'element'  => '.ms-panel',
						'property' => 'font-weight',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-panel',
						'function' => 'css',
						'property' => 'font-weight',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_panels_headings_color',
		'label'       => esc_html__( 'Headings Color', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => 'rgba(255, 255, 255, 0.87)',
		'priority'    => 25,
		'output' => ( 'rgba(255, 255, 255, 0.87)' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_headings_color' ) ) ? array(
				array(
						'element'  => '.ms-panel h1,.ms-panel h2,.ms-panel h3,.ms-panel h4,.ms-panel h5,.ms-panel h6',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-panel h1,.ms-panel h2,.ms-panel h3,.ms-panel h4,.ms-panel h5,.ms-panel h6',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_panels_text_color',
		'label'       => esc_html__( 'Text Color', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => 'rgba(255, 255, 255, 0.87)',
		'priority'    => 25,
		'output' => ( 'rgba(255, 255, 255, 0.87)' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_panels_text_color' ) ) ? array(
				array(
						'element'  => '.ms-panel',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-panel',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_mspanels', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_menu_border_bottom_color',
		'label'       => esc_html__( 'Border Bottom Color', 'flatmobile' ),
		'section'     => 'flatmobile_panels',
		'default'     => 'rgba(0, 0, 0, 0.12)',
		'priority'    => 25,
		'output' => ( 'rgba(0, 0, 0, 0.12)' != flatmobile::option( 'flatmobile_mspanels', 'flatmobile_menu_border_bottom_color' ) ) ? array(
				array(
						'element'  => '.tc-blog-sidebar-box > ul li:not(:last-child):after,.tc-blog-sidebar-box ul.menu li:not(:last-child):after',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.tc-blog-sidebar-box > ul li:not(:last-child):after,.tc-blog-sidebar-box ul.menu li:not(:last-child):after',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );



/**
 *
 * Menu
 *
 */
Kirki::add_section( 'flatmobile_menu_section', array(
		'title'          => esc_html__( 'Menu Styling', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_menu', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_menu',
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type' => 'slider',
		'settings' => 'flatmobile_font_size',
		'label' => esc_html__( 'Font Size', 'flatmobile' ),
		'section' => 'flatmobile_menu_section',
		'default' => 12,
		'priority' => 25,
		'choices' => array(
				'min' => 7,
				'max' => 48,
				'step' => 1,
		),
		'output' => ( '12' != flatmobile::option( 'flatmobile_menu', 'flatmobile_font_size' ) ) ? array(
				array(
						'element'  => '.menu-list a',
						'property' => 'font-size',
						'units'    => 'px',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list a',
						'function' => 'css',
						'property' => 'font-size',
						'units' => 'px'
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_font_weight',
		'label'       => esc_html__( 'Font Weight', 'flatmobile' ),
		'section'     => 'flatmobile_menu_section',
		'default'     => '400',
		'priority'    => 25,
		'choices'     => array(
				'100' => '100',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
		'output' => ( '400' != flatmobile::option( 'flatmobile_menu', 'flatmobile_font_weight' ) ) ? array(
				array(
						'element'  => '.menu-list a',
						'property' => 'font-weight',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list a',
						'function' => 'css',
						'property' => 'font-weight',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type' => 'slider',
		'settings' => 'flatmobile_line_height',
		'label' => esc_html__( 'Line Height', 'flatmobile' ),
		'section' => 'flatmobile_menu_section',
		'default' => 38,
		'priority' => 25,
		'choices' => array(
				'min' => 15,
				'max' => 50,
				'step' => 1,
		),
		'output' => ( 28 != flatmobile::option( 'flatmobile_menu', 'flatmobile_line_height' ) ) ? array(
				array(
						'element'  => '.menu-list a',
						'property' => 'line-height',
						'units'    => 'px',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list a',
						'function' => 'css',
						'property' => 'line-height',
						'units' => 'px'
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_text_color',
		'label'       => esc_html__( 'Text Color', 'flatmobile' ),
		'section'     => 'flatmobile_menu_section',
		'default'     => 'rgba(255, 255, 255, 1)',
		'priority'    => 25,
		'output' => ( 'rgba(255, 255, 255, 1)' != flatmobile::option( 'flatmobile_menu', 'flatmobile_text_color' ) ) ? array(
				array(
						'element'  => '.menu-list a',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list a',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_text_transform',
		'label'       => esc_html__( 'Text Transform', 'flatmobile' ),
		'section'     => 'flatmobile_menu_section',
		'default'     => 'none',
		'priority'    => 25,
		'choices'     => array(
				'uppercase' => esc_html__( 'Upper Case', 'flatmobile' ),
				'lowercase' => esc_html__( 'Lower Case', 'flatmobile' ),
				'capitalize' => esc_html__( 'Capitalize', 'flatmobile' ),
				'none' => esc_html__( 'None', 'flatmobile' ),
		),
		'output' => ( 'none' != flatmobile::option( 'flatmobile_menu', 'flatmobile_text_transform' ) ) ? array(
				array(
						'element'  => '.menu-list a',
						'property' => 'text-transform',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list a',
						'function' => 'css',
						'property' => 'text-transform',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type'        => 'radio',
		'settings'    => 'flatmobile_pills',
		'label'       => esc_html__( 'Pills', 'flatmobile' ),
		'section'     => 'flatmobile_menu_section',
		'default'     => 'inline-block',
		'priority'    => 25,
		'choices'     => array(
				'inline-block'  => esc_html__( 'On', 'flatmobile' ),
				'none'          => esc_html__( 'Off', 'flatmobile' ),
		),
		'output' => ( 'inline-block' != flatmobile::option( 'flatmobile_menu', 'flatmobile_pills' ) ) ? array(
				array(
						'element'  => '.menu-list span',
						'property' => 'display',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list span',
						'function' => 'css',
						'property' => 'display',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type' => 'slider',
		'settings' => 'flatmobile_menu_link_padding',
		'label' => esc_html__( 'Left Space', 'flatmobile' ),
		'section' => 'flatmobile_menu_section',
		'default' => 40,
		'priority' => 25,
		'choices' => array(
				'min' => 0,
				'max' => 100,
				'step' => 5,
		),
		'output' => ( '12' != flatmobile::option( 'flatmobile_menu', 'flatmobile_menu_link_padding' ) ) ? array(
				array(
						'element'  => '.menu-list > li > a',
						'property' => 'padding-left',
						'units'    => 'px',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list > li > a',
						'function' => 'css',
						'property' => 'padding-left',
						'units' => 'px'
				),
		),
) );

Kirki::add_field( 'flatmobile_menu', array(
		'type' => 'slider',
		'settings' => 'flatmobile_menu_icon_top_space',
		'label' => esc_html__( 'Icon Top Space', 'flatmobile' ),
		'section' => 'flatmobile_menu_section',
		'default' => 3,
		'priority' => 25,
		'choices' => array(
				'min' => 0,
				'max' => 20,
				'step' => 1,
		),
		'output' => ( '3' != flatmobile::option( 'flatmobile_menu', 'flatmobile_menu_icon_top_space' ) ) ? array(
				array(
						'element'  => '.menu-list li[class*="uiicon-"]:before',
						'property' => 'top',
						'units'    => 'px',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.menu-list li[class*="uiicon-"]:before',
						'function' => 'css',
						'property' => 'top',
						'units' => 'px'
				),
		),
) );



/**
 *
 * Loading Screen
 *
 */
Kirki::add_section( 'flatmobile_ls_section', array(
		'title'          => esc_html__( 'Loading Screen', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_loading_screen', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_loading_screen',
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_ls_switch',
		'label'       => esc_html__( 'Enable/Disable', 'flatmobile' ),
		'section'     => 'flatmobile_ls_section',
		'default'     => 'on',
		'priority'    => 25,
		'choices'     => array(
				'on'  => esc_html__( 'On', 'flatmobile' ),
				'off' => esc_html__( 'Off', 'flatmobile' ),
		),
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_ls_show',
		'label'       => esc_html__( 'Show Always', 'flatmobile' ),
		'section'     => 'flatmobile_ls_section',
		'default'     => 'off',
		'priority'    => 25,
		'choices'     => array(
				'on'  => esc_html__( 'On', 'flatmobile' ),
				'off' => esc_html__( 'Off', 'flatmobile' ),
		),
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_ls_type',
		'label'       => esc_html__( 'Type', 'flatmobile' ),
		'section'     => 'flatmobile_ls_section',
		'default'     => 'nine',
		'priority'    => 25,
		'choices'     => array(
				'one'    => esc_html__( 'One', 'flatmobile' ),
				'two'    => esc_html__( 'Two', 'flatmobile' ),
				'three'  => esc_html__( 'Three', 'flatmobile' ),
				'four'   => esc_html__( 'Four', 'flatmobile' ),
				'five'   => esc_html__( 'Five', 'flatmobile' ),
				'six'    => esc_html__( 'Six', 'flatmobile' ),
				'seven'  => esc_html__( 'Seven', 'flatmobile' ),
				'eight'  => esc_html__( 'Eight', 'flatmobile' ),
				'nine'   => esc_html__( 'Nine', 'flatmobile' ),
				'ten'    => esc_html__( 'Ten', 'flatmobile' ),
				'eleven' => esc_html__( 'Eleven', 'flatmobile' ),
				'twelve' => esc_html__( 'Twelve', 'flatmobile' ),
		)
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'text',
		'settings'    => 'flatmobile_bottom_text',
		'label'       => esc_html__( 'Bottom Text', 'flatmobile' ),
		'default'     => 'Loading, Please Wait...',
		'section'     => 'flatmobile_ls_section',
		'priority'    => 25,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-page-loading .sub-text',
						'function' => 'html',
				),
		),
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_ls_bg',
		'label'       => esc_html__( 'Background Color', 'flatmobile' ),
		'section'     => 'flatmobile_ls_section',
		'default'     => 'rgba(103,58,183,1)',
		'priority'    => 25,
		'output' => ( 'rgba(103,58,183,1)' != flatmobile::option( 'flatmobile_loading_screen', 'flatmobile_ls_bg' ) ) ? array(
				array(
						'element'  => '.ms-page-loading',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-page-loading',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_ls_sub_text_color',
		'label'       => esc_html__( 'Sub Text Color', 'flatmobile' ),
		'section'     => 'flatmobile_ls_section',
		'default'     => 'rgba(255, 255, 255, 1)',
		'priority'    => 25,
		'output' => ( 'rgba(255, 255, 255, 1)' != flatmobile::option( 'flatmobile_loading_screen', 'flatmobile_ls_sub_text_color' ) ) ? array(
				array(
						'element'  => '.ms-page-loading .sub-text',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-page-loading .sub-text',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_loading_screen', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_ls_animation_color',
		'label'       => esc_html__( 'Animation Color', 'flatmobile' ),
		'section'     => 'flatmobile_ls_section',
		'default'     => 'rgba(255, 255, 255, 1)',
		'priority'    => 25,
		'output' => ( 'rgba(255, 255, 255, 1)' != flatmobile::option( 'flatmobile_loading_screen', 'flatmobile_ls_animation_color' ) ) ? array(
				array(
						'element'  => '.ms-loading-1,.ms-loading-2 .double-bounce1,.ms-loading-2 .double-bounce2,.ms-loading-3 > div,.ms-loading-4 .cube1,.ms-loading-4 .cube2,.ms-loading-5,.ms-loading-6 .dot1,.ms-loading-6 .dot2,.ms-loading-7 > div,.ms-loading-8 .sk-child:before,.ms-loading-9 .sk-cube,.ms-loading-10 .sk-circle:before,.ms-loading-11 .sk-cube:before,.ms-loading-12 span',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-loading-1,.ms-loading-2 .double-bounce1,.ms-loading-2 .double-bounce2,.ms-loading-3 > div,.ms-loading-4 .cube1,.ms-loading-4 .cube2,.ms-loading-5,.ms-loading-6 .dot1,.ms-loading-6 .dot2,.ms-loading-7 > div,.ms-loading-8 .sk-child:before,.ms-loading-9 .sk-cube,.ms-loading-10 .sk-circle:before,.ms-loading-11 .sk-cube:before,.ms-loading-12 span',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );




/**
 *
 * Footer
 *
 */
Kirki::add_section( 'flatmobile_footer_section', array(
		'title'          => esc_html__( 'Footer Styling', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_footer', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
) );

Kirki::add_field( 'flatmobile_footer', array(
		'type'        => 'select',
		'settings'    => 'flatmobile_footer_display',
		'label'       => esc_html__( 'Enable/Disable', 'flatmobile' ),
		'section'     => 'flatmobile_footer_section',
		'default'     => 'on',
		'priority'    => 25,
		'choices'     => array(
				'on'  => esc_html__( 'Off', 'flatmobile' ),
				'off' => esc_html__( 'On', 'flatmobile' ),
		),
) );

Kirki::add_field( 'flatmobile_footer', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_bg',
		'label'       => esc_html__( 'Background Color', 'flatmobile' ),
		'section'     => 'flatmobile_footer_section',
		'default'     => 'rgba(103,58,183,1)',
		'priority'    => 25,
		'output' => ( 'rgba(103,58,183,1)' != flatmobile::option( 'flatmobile_footer', 'flatmobile_bg' ) ) ? array(
				array(
						'element'  => '.ms-footer',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-footer',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_footer', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_color',
		'label'       => esc_html__( 'Text Color', 'flatmobile' ),
		'section'     => 'flatmobile_footer_section',
		'default'     => 'rgba(255, 255, 255, 1)',
		'priority'    => 25,
		'output' => ( 'rgba(255, 255, 255, 1)' != flatmobile::option( 'flatmobile_footer', 'flatmobile_color' ) ) ? array(
				array(
						'element'  => '.ms-footer span',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-footer span',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_footer', array(
		'type'        => 'text',
		'settings'    => 'flatmobile_copyright_text',
		'option_type' => 'theme_mod',
		'label'       => esc_html__( 'Copyright Text', 'flatmobile' ),
		'help'        => esc_html__( 'Leave blank to disable.', 'flatmobile' ),
		'default'     => 'Copyright 2015 by Mobius Studio',
		'section'     => 'flatmobile_footer_section',
		'priority'    => 25,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.ms-footer span',
						'function' => 'html',
				),
		),
) );

Kirki::add_field( 'flatmobile_footer', array(
		'type'        => 'code',
		'option_type' => 'theme_mod',
		'settings'    => 'flatmobile_custom_html',
		'label'       => esc_html__( 'Custom HTML', 'flatmobile' ),
		'section'     => 'flatmobile_footer_section',
		'default'     => '<a href="#" class="tc-icon-ball socialicon-facebook43 color-facebook"></a>
<a href="#" class="tc-icon-ball socialicon-google109 color-google"></a>
<a href="#" class="tc-icon-ball socialicon-twitter34 color-twitter"></a>
<a href="#" class="tc-icon-ball socialicon-pinterest26 color-pinterest"></a>
<a href="#" class="tc-icon-ball socialicon-dribbble11 color-dribbble"></a>',
		'priority'    => 25,
		'choices'     => array(
				'language' => 'html',
				'theme'    => 'monokai',
				'height'   => 450,
		),
) );



/**
 *
 * Custom Code
 *
 */
Kirki::add_section( 'flatmobile_custom_code_section', array(
		'title'          => esc_html__( 'Custom Code', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_custom_code', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod'
) );

Kirki::add_field( 'flatmobile_custom_code', array(
		'type'        => 'code',
		'settings'    => 'flatmobile_custom_code_css',
		'label'       => esc_html__( 'Custom CSS Code', 'flatmobile' ),
		'section'     => 'flatmobile_custom_code_section',
		'default'     => '',
		'priority'    => 25,
		'choices'     => array(
				'language' => 'css',
				'theme'    => 'monokai',
				'height'   => 450,
		),
) );

Kirki::add_field( 'flatmobile_custom_code', array(
		'type'        => 'code',
		'settings'    => 'flatmobile_custom_code_js',
		'label'       => esc_html__( 'Custom JS Code', 'flatmobile' ),
		'section'     => 'flatmobile_custom_code_section',
		'default'     => '',
		'priority'    => 25,
		'choices'     => array(
				'language' => 'javascript',
				'theme'    => 'monokai',
				'height'   => 450,
		),
) );



/**
 *
 * 404 Page
 *
 */
Kirki::add_section( 'flatmobile_page_404_section', array(
		'title'          => esc_html__( '404 Page', 'flatmobile' ),
		'priority'       => 160,
		'capability'     => 'edit_theme_options',
) );

Kirki::add_config( 'flatmobile_page_404', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'flatmobile_page_404',
) );

Kirki::add_field( 'flatmobile_page_404', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_page_404_text_color',
		'label'       => esc_html__( 'Text Color', 'flatmobile' ),
		'section'     => 'flatmobile_page_404_section',
		'default'     => 'rgba(255, 255, 255, .87)',
		'priority'    => 24,
		'output' => ( 'rgba(255, 255, 255, .87)' != flatmobile::option( 'flatmobile_page_404', 'flatmobile_page_404_text_color' ) ) ? array(
				array(
						'element'  => '.error404 .tc-page,.error404 .navbar .icon-only',
						'property' => 'color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.error404 .tc-page,.error404 .navbar .icon-only',
						'function' => 'css',
						'property' => 'color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_page_404', array(
		'type'        => 'color-alpha',
		'settings'    => 'flatmobile_page_404_background_color',
		'label'       => esc_html__( 'Background Color', 'flatmobile' ),
		'section'     => 'flatmobile_page_404_section',
		'default'     => 'rgba(103,58,183,1)',
		'priority'    => 24,
		'output' => ( 'rgba(103,58,183,1)' != flatmobile::option( 'flatmobile_page_404', 'flatmobile_page_404_background_color' ) ) ? array(
				array(
						'element'  => '.error404 .tc-page',
						'property' => 'background-color',
						'units'    => '',
				),
		) : null,
		'transport' => 'postMessage',
		'js_vars' => array(
				array(
						'element' => '.error404 .tc-page',
						'function' => 'css',
						'property' => 'background-color',
						'units' => ''
				),
		),
) );

Kirki::add_field( 'flatmobile_page_404', array(
		'settings'      => 'flatmobile_page_404_background_image',
		'label'         => esc_html__( '404 Page Background Image', 'flatmobile' ),
		'section'       => 'flatmobile_page_404_section',
		'type'          => 'image',
		'priority'      => 24,
		'output' => ( '' != flatmobile::option( 'flatmobile_page_404', 'flatmobile_page_404_background_image' ) ) ? array(
				array(
						'element'  => '.error404 .tc-page',
						'property' => 'background-image'
				),
		) : null
) );