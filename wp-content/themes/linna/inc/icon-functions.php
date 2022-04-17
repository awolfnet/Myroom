<?php
/**
 * SVG icons related functions
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( ! function_exists( 'linna_get_icon_svg' ) ) {
	/**
	 * Get SVG icon by name and resize it.
	 *
	 * @param string $icon Defined icon id.
	 * @param int    $size_w Width of the svg icon.
	 * @param bool   $size_h Height of the svg icon.
	 *
	 * @return string|string[]|null
	 */
	function linna_get_icon_svg( $icon, $size_w = 24, $size_h = null ) {
		return Linna_SVG_Icons::get_svg( 'ui', $icon, $size_w, $size_h );
	}
}

if ( ! function_exists( 'linna_get_social_icon_svg' ) ) {
	/**
	 * Get Social SVG icon by name and resize it.
	 *
	 * @param string $icon Defined icon id.
	 * @param int    $size Width of the svg icon.
	 *
	 * @return string|string[]|null
	 */
	function linna_get_social_icon_svg( $icon, $size = 24 ) {
		return Linna_SVG_Icons::get_svg( 'social', $icon, $size );
	}
}

if ( ! function_exists( 'linna_get_social_link_svg' ) ) {
	/**
	 * Find and Get SVG icon by URI of social link and resize it.
	 *
	 * @param string $uri URI of the social link, function will find the related social icon.
	 * @param int    $size Width of the svg icon.
	 *
	 * @return string|string[]|null
	 */
	function linna_get_social_link_svg( $uri, $size = 24 ) {
		return Linna_SVG_Icons::get_social_link_svg( $uri, $size );
	}
}

if ( ! function_exists( 'linna_nav_menu_social_icons' ) ) {
	/**
	 * Display SVG icons in social links menu.
	 *
	 * @param string       $item_output The menu item output.
	 * @param WP_Post      $item Menu item object.
	 * @param int          $depth Depth of the menu.
	 * @param array|object $args wp_nav_menu() arguments.
	 *
	 * @return string  $item_output The menu item output with social icon.
	 */
	function linna_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
		// Change SVG icon inside social links menu if there is supported URL.
		if ( 'social' === $args->theme_location ) {
			$svg = linna_get_social_link_svg( $item->url, 26 );
			if ( empty( $svg ) ) {
				$svg = linna_get_icon_svg( 'link' );
			}
			$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
		}

		return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el', 'linna_nav_menu_social_icons', 10, 4 );
}

