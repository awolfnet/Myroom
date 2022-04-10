<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */

add_filter( 'rwmb_meta_boxes', 'flatmobile_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "flatmobile" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function flatmobile_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'flatmobile_';

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
			'id'         => 'flatmobile-featured-type',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
			'title'      => esc_html__( 'Featured Type', 'flatmobile' ),

		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
			'post_types' => array( 'post', 'portfolio'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
			'context'    => 'normal',

		// Order of meta box: high (default), low. Optional.
			'priority'   => 'high',

		// Auto save: true, false (default). Optional.
			'autosave'   => true,

		// List of meta fields
			'fields'     => array(
				// RADIO BUTTONS
					array(
							'name'    => esc_html__( 'Choose Type', 'flatmobile' ),
							'id'      => "{$prefix}type",
							'type'    => 'radio',
							'options' => array(
									'none'   => esc_html__( 'None', 'flatmobile' ),
									'oembed' => esc_html__( 'oEmbed', 'flatmobile' ),
									'images' => esc_html__( 'Slider Images', 'flatmobile' ),
							),
					),

				//'title-2'  => esc_html__( 'Type Source', 'flatmobile' ),

				// OEMBED
					array(
							'name' => esc_html__( 'oEmbed', 'flatmobile' ),
							'id'   => "{$prefix}oembed",
							'desc' => '<a href="https://codex.wordpress.org/Embeds" target="_blank">'.esc_html__('Check available Embed Services.','flatmobile').'</a>',
							'type' => 'oembed',
					),

				// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
					array(
							'name'             => esc_html__( 'Slider Images', 'flatmobile' ),
							'id'               => "{$prefix}slider_images",
							'type'             => 'image_advanced',
							'max_file_uploads' => 6,
					),
			),
	);

	// 2nd meta box
	$meta_boxes[] = array(
			'title'  => esc_html__( 'Custom CSS', 'flatmobile' ),

			'fields' => array(
				// TEXTAREA
					array(
							'name' => esc_html__( 'Valid CSS', 'flatmobile' ),
							'desc' => esc_html__( 'Please make sure your CSS is not broken', 'flatmobile' ),
							'id'   => "{$prefix}customcss",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 3,
					),
			)
	);

	// 1st meta box
	$meta_boxes[] = array(
			'id'         => 'page-type',
			'title'      => esc_html__( 'Navbar Style', 'flatmobile' ),
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
					array(
							'name'    => esc_html__( 'Choose', 'flatmobile' ),
							'id'      => "{$prefix}navbar_style",
							'type'    => 'radio',
							'options' => array(
									'default'   => esc_html__( 'Default', 'flatmobile' ),
									'navbar-fixed' => esc_html__( 'On Content', 'flatmobile' ),
							),
					),
			),
	);

	// 1st meta box
	$meta_boxes[] = array(
			'id'         => 'is-page-title-hidden',
			'title'      => esc_html__( 'Hide Default Page Title', 'flatmobile' ),
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
					array(
							'name'    => esc_html__( 'Choose', 'flatmobile' ),
							'id'      => "{$prefix}page_title_hidden",
							'type'    => 'radio',
							'options' => array(
									'visible'   => esc_html__( 'Visible', 'flatmobile' ),
									'hidden' => esc_html__( 'Hidden', 'flatmobile' ),
							),
					),
			),
	);

	return $meta_boxes;
}

