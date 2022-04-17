<?php
if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'linna-theme-options';

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	'display_name'    => $theme->get( 'Name' ),
	'display_version' => $theme->get( 'Version' ),
	'menu_title'      => esc_html__( 'Theme Options', 'linna' ),
	'customizer'      => true,
);

require_once get_template_directory() . '/options/loader.php';

Redux::setArgs( $opt_name, $args );

/**
 * General Settings
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'General Settings', 'linna' ),
		'id'     => 'general-settings',
		'desc'   => esc_html__( 'Custom Codes ', 'linna' ),
		'icon'   => 'el el-cogs',
		'fields' => array(
			array(
				'id'       => 'header_css',
				'type'     => 'ace_editor',
				'title'    => __( 'Header CSS Code', 'linna' ),
				'subtitle' => __( 'CSS Code to place right before </head> tag. Beware, this code will be html escaped.', 'linna' ),
				'mode'     => 'css',
				'theme'    => 'monokai',
				'default'  => '',
			),
			array(
				'id'       => 'google_anaytics_id',
				'type'     => 'text',
				'title'    => esc_html__( 'Google Analytics', 'linna' ),
				'subtitle' => esc_html__( 'UA-XXXXX-Y', 'linna' ),
			),
		),
	)
);

/**
 * Header
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => __( 'Header', 'linna' ),
		'id'     => 'header',
		'desc'   => __( 'Every option related to header.', 'linna' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'             => 'header-height',
				'type'           => 'dimensions',
				'output'         => array( '.site-header .site-row' ),
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => __( 'Height', 'linna' ),
				'subtitle'       => __( 'Header Height (Logo cannot exceed the height of header)', 'linna' ),
				'width'          => false,
				'default'        => array(
					'height' => 55,
				),
			),
			array(
				'id'       => 'header-background',
				'type'     => 'background',
				'output'   => array( 'header.site-primary-bg' ),
				'title'    => __( 'Header Background', 'linna' ),
				'subtitle' => __( 'Header background with image, color, etc.', 'linna' ),
				'default'  => array(
					'background-color' => '#5782c9',
				),
			),
			array(
				'id'       => 'header-icon-color',
				'type'     => 'color_rgba',
				'title'    => __( 'Icon Colors', 'linna' ),
				'subtitle' => __( 'Specify the body font properties.', 'linna' ),
				'google'   => false,
				'output'   => array( '.site-header a, .site-header button' ),
				'default'  => array(
					'color' => '#fff',
					'alpha' => '.87',
				),
			),
			array(
				'id'       => 'header-sticky',
				'type'     => 'select',
				'title'    => __( 'Sticky/Fixed', 'linna' ),
				'subtitle' => __( 'Keep header on screen all times or not.', 'linna' ),
				// Must provide key => value pairs for select options.
				'options'  => array(
					''                     => 'Normal',
					'site-position-sticky' => 'Sticky / Fixed',
				),
				'default'  => '',
			),
		),
	)
);

/**
 * Logo
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => __( 'Logo', 'linna' ),
		'id'     => 'logo',
		'desc'   => __( 'Logo options', 'linna' ),
		'icon'   => 'el el-bulb',
		'fields' => array(
			array(
				'id'       => 'header-logo-type',
				'type'     => 'select',
				'title'    => __( 'Logo Type', 'linna' ),
				'subtitle' => __( 'You can upload an image or use text as your logo', 'linna' ),
				'options'  => array(
					'image' => 'Image',
					'text'  => 'Text',
				),
				'default'  => 'text',
			),
			array(
				'id'       => 'header-logo-text',
				'type'     => 'text',
				'title'    => esc_html__( 'Logo Text', 'linna' ),
				'subtitle' => esc_html__( 'Will use blog name If left empty.', 'linna' ),
				'default'  => 'Linna',
			),
			array(
				'id'          => 'header-logo-typography',
				'type'        => 'typography',
				'title'       => __( 'Logo Typography', 'linna' ),
				'subtitle'    => __( 'If you choose text as logo type', 'linna' ),
				'font-backup' => true,
				'all_styles'  => true,
				'output'      => array( '.site-logo-text' ),
				'units'       => 'px',
				'default'     => array(
					'color'       => '#fff',
					'font-weight' => '500',
					'font-family' => 'Roboto',
					'font-backup' => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',
					'google'      => true,
					'font-size'   => '16px',
				),
			),
			array(
				'id'       => 'header-logo',
				'type'     => 'media',
				'url'      => true,
				'title'    => __( 'Image', 'linna' ),
				'compiler' => 'true',
			),
			array(
				'id'             => 'header-logo-dimensions',
				'type'           => 'dimensions',
				'output'         => array( 'header .site-logo' ),
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => __( 'Image Dimensions', 'linna' ),
			),
			array(
				'id'       => 'header-logo-position',
				'type'     => 'select',
				'title'    => __( 'Position', 'linna' ),
				'subtitle' => __( 'Align the logo.', 'linna' ),
				'options'  => array(
					''                            => 'Left',
					'site-justify-content-end'    => 'Right',
					'site-justify-content-center' => 'Center',
				),
				'default'  => '',
			),
		),
	)
);

/**
 * Favicons & Apple Icons
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Favicons & Apple Icons', 'linna' ),
		'desc'   => esc_html__( 'Favicons are handled by the Site Icon setting in the customizer since version 4.3.', 'linna' ),
		'id'     => 'favicons',
		'icon'   => 'el el-idea',
		'fields' => array_merge(
			array_map(
				function( $size ) {
					return array(
						'id'          => 'apple-touch-icon-' . $size,
						'type'        => 'media',
						'url'         => true,
						'title'       => __( 'Apple Touch Icon .PNG ', 'linna' ) . ' ' . $size,
						'description' => __( 'Transparent or filled PNG image.', 'linna' ),
						'compiler'    => 'true',
					);
				},
				linna_apple_touch_icons()
			),
			array_map(
				function( $size ) {
					return array(
						'id'          => 'chrome-icon-' . $size,
						'type'        => 'media',
						'url'         => true,
						'title'       => __( 'Chrome Icon .PNG ', 'linna' ) . ' ' . $size,
						'description' => __( 'Transparent or filled PNG image.', 'linna' ),
						'compiler'    => 'true',
					);
				},
				linna_chrome_icons()
			),
		),
	)
);

/**
 * Web App
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Web App', 'linna' ),
		'id'     => 'webapp',
		'icon'   => 'el el-screen-alt',
		'desc'   => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url('https://appsco.pe/developer/splash-screens'), __( 'You can easily create your splash screens from this page, download then upload here. This website is not related to Mobius Studio by any means.', 'linna' ) ),
		'fields' =>
			array_merge(
				array(
					array(
						'id'      => 'web-app-capable',
						'type'    => 'select',
						'title'   => __( 'WebApp Capable', 'linna' ),
						'options' => array(
							'1' => esc_html__( 'Enabled', 'linna' ),
							'0' => esc_html__( 'Disabled', 'linna' ),
						),
						'default' => '0',
					),
					array(
						'id'      => 'web-app-status-bar-style',
						'type'    => 'select',
						'title'   => __( 'Status Bar Style', 'linna' ),
						'options' => array(
							'black'             => esc_html__( 'Black', 'linna' ),
							'black-translucent' => esc_html__( 'Black Translucent', 'linna' ),
						),
						'default' => 'black',
					),
					array(
						'id'      => 'web-app-application-name',
						'type'    => 'text',
						'title'   => __( 'Application Name', 'linna' ),
						'default' => 'Mobius Studio',
					),
					array(
						'id'      => 'web-app-application-name-short',
						'type'    => 'text',
						'title'   => __( 'Application Name (Short)', 'linna' ),
						'default' => 'Mobius Studio',
					),
					array(
						'id'          => 'web-app-theme-color',
						'type'        => 'color',
						'title'       => __( 'Theme Color', 'linna' ),
						'transparent' => false,
						'default'     => '#1e1e1e',
					),
					array(
						'id'          => 'web-app-background-color',
						'type'        => 'color',
						'title'       => __( 'Background Color', 'linna' ),
						'transparent' => false,
						'default'     => '#1e1e1e',
					),
					array(
						'id'      => 'web-app-display',
						'type'    => 'select',
						'title'   => __( 'WebApp Display Mode', 'linna' ),
						'options' => array(
							'fullscreen' => esc_html__( 'Fullscreen', 'linna' ),
							'standalone' => esc_html__( 'Standalone (Native App Like)', 'linna' ),
							'minimal-ui' => esc_html__( 'Minimal UI', 'linna' ),
							'browser'    => esc_html__( 'Browser', 'linna' ),
						),
						'default' => 'standalone',
					),
					array(
						'id'      => 'web-app-orientation',
						'type'    => 'select',
						'title'   => __( 'Preferred Orientation', 'linna' ),
						'options' => array(
							'any'                 => esc_html__( 'Any', 'linna' ),
							'natural'             => esc_html__( 'Natural', 'linna' ),
							'landscape'           => esc_html__( 'Landscape', 'linna' ),
							'landscape-primary'   => esc_html__( 'Landscape Primary', 'linna' ),
							'landscape-secondary' => esc_html__( 'Landscape Secondary', 'linna' ),
							'portrait'            => esc_html__( 'Portrait', 'linna' ),
							'portrait-primary'    => esc_html__( 'Portrait Primary', 'linna' ),
							'portrait-secondary'  => esc_html__( 'Portrait Secondary', 'linna' ),
						),
						'default' => 'portrait',
					),
				),
				array_map(
					function( $size ) {
						return array(
							'id'          => 'web-app-size-' . $size['id'],
							'type'        => 'media',
							'url'         => true,
							'title'       => $size['title'],
							'description' => __( 'StartUp/Splash Screen', 'linna' ),
							'compiler'    => 'true',
						);
					},
					linna_startup_screens()
				),
			),
	),
);

/**
 * Sidebar
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Sidebar', 'linna' ),
		'id'     => 'sidebar-settings',
		'icon'   => 'el el-braille',
		'fields' => array(
			array(
				'id'      => 'sidebar-position',
				'type'    => 'button_set',
				'title'   => __( 'Sidebar Position', 'linna' ),
				'options' => array(
					esc_attr( 'side="left"' )  => 'Left',
					esc_attr( 'side="right"' ) => 'Right',
					'disabled'                 => 'Disabled',
				),
				'default' => 'side="left"',
			),
			array(
				'id'       => 'sidebar-background',
				'type'     => 'background',
				'output'   => array( '.site-sidebar' ),
				'title'    => __( 'Sidebar Background', 'linna' ),
				'subtitle' => __( 'Sidebar background with image, color, etc.', 'linna' ),
				'default'  => array(),
			),
			array(
				'id'      => 'sidebar-text-color',
				'type'    => 'color_rgba',
				'title'   => __( 'Text Color', 'linna' ),
				'google'  => false,
				'output'  => array( '.site-sidebar' ),
				'default' => array(),
			),
			array(
				'id'      => 'sidebar-link-color',
				'type'    => 'link_color',
				'title'   => __( 'Links Color', 'linna' ),
				'output'  => array( '.site-sidebar a' ),
				'default' => array(),
			),
			array(
				'id'            => 'sidebar-box-padding',
				'type'          => 'spacing',
				'output'        => array( '.site-sidebar .sidebar-box' ),
				'units'         => 'px',
				'mode'          => 'padding',
				'all'           => false,
				'display_units' => true,
				'title'         => __( 'Content Padding', 'linna' ),
				'default'       => array(
					'padding-top'    => '17px',
					'padding-right'  => '20px',
					'padding-bottom' => '17px',
					'padding-left'   => '20px',
				),
			),
			array(
				'id'       => 'sidebar-top-background',
				'type'     => 'background',
				'output'   => array( '.site-sidebar-top.site-primary-bg' ),
				'title'    => __( 'Sidebar Top Background', 'linna' ),
				'subtitle' => __( 'Sidebar Top background with image, color, etc.', 'linna' ),
				'default'  => array(),
			),
			array(
				'id'      => 'sidebar-top-text-color',
				'type'    => 'color_rgba',
				'title'   => __( 'Sidebar Top Text Color', 'linna' ),
				'google'  => false,
				'output'  => array( '.site-sidebar-top.site-primary-bg' ),
				'default' => array(),
			),
			array(
				'id'      => 'sidebar-top-text-1',
				'type'    => 'text',
				'title'   => __( 'Text 1', 'linna' ),
				'default' => '',
			),
			array(
				'id'      => 'sidebar-top-text-2',
				'type'    => 'text',
				'title'   => __( 'Text 2', 'linna' ),
				'default' => '',
			),
			array(
				'id'       => 'sidebar-top-logo',
				'type'     => 'media',
				'url'      => true,
				'title'    => __( 'Image', 'linna' ),
				'compiler' => 'true',
				'default'  => array(),
			),
			array(
				'id'             => 'sidebar-top-logo-dimensions',
				'type'           => 'dimensions',
				'output'         => array( '.site-sidebar .site-sidebar-top img' ),
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => __( 'Image Dimensions', 'linna' ),
			),
			array(
				'id'            => 'sidebar-top-logo-border-radius',
				'type'          => 'slider',
				'title'         => __( 'Image Border Radius as %', 'linna' ),
				'default'       => null,
				'min'           => 1,
				'step'          => 1,
				'max'           => 50,
				'display_value' => 'label',
			),
			array(
				'id'      => 'sidebar-top-caret-color',
				'type'    => 'color_rgba',
				'title'   => __( 'Sidebar Top Caret Color (Closing Button)', 'linna' ),
				'google'  => false,
				'output'  => array( '.site-sidebar .site-sidebar-toggle' ),
				'default' => array(),
			),
			array(
				'id'      => 'sidebar-socials',
				'type'    => 'social_icons_field',
				'title'   => esc_html__( 'Socials', 'linna' ),
				'hint'    => array(
					'content' => 'Create as many as you wish.',
				),
				'options' => array(),
				// For checkbox mode.
				'default' => array(),
			),
		),
	)
);

/**
 * Blog
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Blog', 'linna' ),
		'id'     => 'blog-settings',
		'icon'   => 'el el-pencil-alt',
		'fields' => array(
			array(
				'id'      => 'blog-list-preview-position',
				'type'    => 'button_set',
				'title'   => __( 'Preview Position', 'linna' ),
				'options' => array(
					'left'  => 'Left',
					'top'   => 'Top',
					'right' => 'Right',
				),
				'default' => 'top',
			),
			array(
				'id'      => 'blog-list-columns',
				'type'    => 'button_set',
				'title'   => __( 'Blog List Columns', 'linna' ),
				'options' => array(
					'12' => '1',
					'6'  => '2',
					'4'  => '3',
				),
				'default' => '12',
			),
			array(
				'id'      => 'blog-list-show-excerpt',
				'type'    => 'switch',
				'title'   => __( 'Excerpt', 'linna' ),
				'default' => true,
			),
			array(
				'id'            => 'blog-list-excerpt-length',
				'type'          => 'slider',
				'title'         => __( 'Excerpt Character Length', 'linna' ),
				'default'       => 55,
				'min'           => 1,
				'step'          => 5,
				'max'           => 300,
				'display_value' => 'label',
			),
			array(
				'id'      => 'blog-list-sidebar',
				'type'    => 'switch',
				'title'   => __( 'Sidebar', 'linna' ),
				'default' => true,
			),
			array(
				'id'      => 'blog-list-sidebar-position',
				'type'    => 'button_set',
				'title'   => __( 'Sidebar Position', 'linna' ),
				'options' => array(
					'left'  => 'Left',
					'right' => 'Right',
				),
				'default' => 'right',
			),
			array(
				'id'      => 'blog-list-sidebar-size',
				'type'    => 'button_set',
				'title'   => __( 'Sidebar Size out of 12 Columns', 'linna' ),
				'options' => array(
					'2' => '2/12',
					'3' => '3/12',
					'4' => '4/12',
					'5' => '5/12',
					'6' => '6/12',
				),
				'default' => '3',
			),
		),
	)
);

/**
 * 404 Page Not Found
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Page Not Found', 'linna' ),
		'id'     => 'page-not-found',
		'icon'   => 'el el-error',
		'fields' => array(
			array(
				'id'      => 'page-not-found-first-line-status',
				'type'    => 'switch',
				'title'   => __( 'First Line', 'linna' ),
				'default' => true,
			),
			array(
				'id'          => 'page-not-found-first-line',
				'type'        => 'typography',
				'title'       => __( 'First Line Typography', 'linna' ),
				'font-backup' => true,
				'all_styles'  => true,
				'output'      => array( '.site-404 h1' ),
				'units'       => 'px',
			),
			array(
				'id'            => 'page-not-found-first-line-spacing',
				'type'          => 'spacing',
				'output'        => array( '.site-404 h1' ),
				'units'         => 'px',
				'mode'          => 'margin',
				'all'           => false,
				'display_units' => true,
				'title'         => __( 'First Line Margin', 'linna' ),
			),

			array(
				'id'      => 'page-not-found-second-line-status',
				'type'    => 'switch',
				'title'   => __( 'Second Line', 'linna' ),
				'default' => true,
			),
			array(
				'id'          => 'page-not-found-second-line',
				'type'        => 'typography',
				'title'       => __( 'Second Line Typography', 'linna' ),
				'font-backup' => true,
				'all_styles'  => true,
				'output'      => array( '.site-404 span' ),
				'units'       => 'px',
			),
			array(
				'id'            => 'page-not-found-second-line-spacing',
				'type'          => 'spacing',
				'output'        => array( '.site-404 span' ),
				'units'         => 'px',
				'mode'          => 'margin',
				'all'           => false,
				'display_units' => true,
				'title'         => __( 'Second Line Margin', 'linna' ),
			),

			array(
				'id'      => 'page-not-found-third-line-status',
				'type'    => 'switch',
				'title'   => __( 'Third Line', 'linna' ),
				'default' => true,
			),
			array(
				'id'          => 'page-not-found-third-line',
				'type'        => 'typography',
				'title'       => __( 'Third Line Typography', 'linna' ),
				'font-backup' => true,
				'all_styles'  => true,
				'output'      => array( '.site-404 article' ),
				'units'       => 'px',
			),
			array(
				'id'            => 'page-not-found-third-line-spacing',
				'type'          => 'spacing',
				'output'        => array( '.site-404 article' ),
				'units'         => 'px',
				'mode'          => 'margin',
				'all'           => false,
				'display_units' => true,
				'title'         => __( 'Third Line Margin', 'linna' ),
			),

			array(
				'id'      => 'page-not-found-search',
				'type'    => 'switch',
				'title'   => __( 'Search', 'linna' ),
				'default' => true,
			),
		),
	)
);

/**
 * Footer
 */
Redux::setSection(
	$opt_name,
	array(
		'title'  => __( 'Footer', 'linna' ),
		'id'     => 'footer',
		'desc'   => __( 'Footer options', 'linna' ),
		'icon'   => 'el el-download-alt',
		'fields' => array(
			array(
				'id'            => 'footer-padding',
				'type'          => 'spacing',
				'output'        => array( '.site-footer' ),
				'units'         => 'px',
				'mode'          => 'padding',
				'all'           => false,
				'display_units' => true,
				'title'         => __( 'Content Padding', 'linna' ),
				'default'       => array(
					'padding-top'    => '20px',
					'padding-right'  => '15px',
					'padding-bottom' => '20px',
					'padding-left'   => '15px',
				),
			),
			array(
				'id'      => 'footer-border',
				'type'    => 'border',
				'title'   => __( 'Footer Border', 'linna' ),
				'output'  => array( '.site-footer' ),
				'default' => array(
					'border-color'  => 'rgba(0,0,0,.12)',
					'border-style'  => 'solid',
					'border-top'    => '1px',
					'border-right'  => '0',
					'border-bottom' => '0',
					'border-left'   => '0',
				),
			),
			array(
				'id'       => 'footer-text',
				'type'     => 'text',
				'title'    => esc_html__( 'Footer&Copyright Text', 'linna' ),
				'subtitle' => esc_html__( 'Your copyright or any other text.', 'linna' ),
				'default'  => 'Copyright 2020 by Mobius Studio',
			),
			array(
				'id'          => 'footer-typography',
				'type'        => 'typography',
				'title'       => __( 'Footer Typography', 'linna' ),
				'font-backup' => true,
				'all_styles'  => true,
				'output'      => array( '.site-footer-text' ),
				'units'       => 'px',
				'default'     => array(
					'color'       => '#818181',
					'font-weight' => '400',
					'font-family' => 'Roboto',
					'font-backup' => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',
					'google'      => true,
					'font-size'   => '10px',
				),
			),

			array(
				'id'      => 'footer-socials',
				'type'    => 'social_icons_field',
				'title'   => esc_html__( 'Socials', 'linna' ),
				'hint'    => array(
					'content' => 'Create as many as you wish.',
				),
				'options' => array(),
				// For checkbox mode.
				'default' => array(),
			),
		),
	)
);
