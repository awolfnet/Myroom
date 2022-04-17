<?php
/**
 * Linna back compat functionality
 *
 * Prevents Linna from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Linna
 * @since Linna 1.0.0
 */

if ( ! function_exists( 'linna_switch_theme' ) ) {
	/**
	 * Prevent switching to Linna on old versions of WordPress.
	 *
	 * Switches to the default theme.
	 *
	 * @since Linna 1.0.0
	 */
	function linna_switch_theme() {
		switch_theme( WP_DEFAULT_THEME );
		unset( $_GET['activated'] );
		add_action( 'admin_notices', 'linna_upgrade_notice' );
	}

	add_action( 'after_switch_theme', 'linna_switch_theme' );
}

if ( ! function_exists( 'linna_upgrade_notice' ) ) {
	/**
	 * Adds a message for unsuccessful theme switch.
	 *
	 * Prints an update nag after an unsuccessful attempt to switch to
	 * Linna on WordPress versions prior to 4.7.
	 *
	 * @since Linna 1.0.0
	 *
	 * @global string $wp_version WordPress version.
	 */
	function linna_upgrade_notice() {
		/* translators: %s WordPress version */
		$message = sprintf( __( 'Linna requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'linna' ), $GLOBALS['wp_version'] );
		printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
	}
}

if ( ! function_exists( 'linna_preview' ) ) {
	/**
	 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
	 *
	 * @since Linna 1.0.0
	 *
	 * @global string $wp_version WordPress version.
	 */
	function linna_preview() {
		if ( isset( $_GET['preview'] ) ) {
			wp_die(
				sprintf(
					/* translators: %s WordPress version */
					esc_html__( 'Linna requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'linna' ),
					esc_html( $GLOBALS['wp_version'] )
				)
			);
		}
	}

	add_action( 'template_redirect', 'linna_preview' );
}

