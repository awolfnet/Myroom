<?php
/**
 * Child theme functions.
 *
 * @package Linna
 */

/**
 * Enqueue child theme style.css as well as parents.
 */
function linna_enqueue_styles() {
	$parent_style = 'linna-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style(
		'linna-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'linna_enqueue_styles' );
