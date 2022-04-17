<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Front end functionalities
 *
 * @package Menu_Icons
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
final class Mobius_Studio_Menu_Icons_Front_End {

	/**
	 * Add hooks for front-end functionalities
	 *
	 * @since 0.9.0
	 */
	public static function init() {

		add_filter( 'wp_nav_menu_args', array( __CLASS__, '_add_menu_item_title_filter' ) );
		add_filter( 'wp_nav_menu', array( __CLASS__, '_remove_menu_item_title_filter' ) );
	}


	/**
	 * Get nav menu ID based on arguments passed to wp_nav_menu()
	 *
	 * @since  0.3.0
	 * @param  array $args wp_nav_menu() Arguments.
	 * @return mixed Nav menu ID or FALSE on failure
	 */
	public static function get_nav_menu_id( $args ) {
		$args = (object) $args;
		$menu = wp_get_nav_menu_object( $args->menu );

		// Get the nav menu based on the theme_location.
		$locations = get_nav_menu_locations();
		if ( ! $menu && $args->theme_location && $locations && isset( $locations[ $args->theme_location ] )
		) {
			$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
		}

		// Get the first menu that has items if we still can't find a menu.
		if ( ! $menu && ! $args->theme_location ) {
			$menus = wp_get_nav_menus();
			foreach ( $menus as $menu_maybe ) {
				$menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) );
				if ( $menu_items ) {
					$menu = $menu_maybe;
					break;
				}
			}
		}

		if ( is_object( $menu ) && ! is_wp_error( $menu ) ) {
			return $menu->term_id;
		} else {
			return false;
		}
	}


	/**
	 * Add filter to 'the_title' hook
	 *
	 * We need to filter the menu item title but **not** regular post titles.
	 * Thus, we're adding the filter when `wp_nav_menu()` is called.
	 *
	 * @since   0.1.0
	 * @wp_hook filter wp_nav_menu_args
	 * @param   array $args Not used.
	 *
	 * @return array
	 */
	public static function _add_menu_item_title_filter( $args ) {
		add_filter( 'the_title', array( __CLASS__, '_add_icon' ), 999, 2 );

		return $args;
	}


	/**
	 * Remove filter from 'the_title' hook
	 *
	 * Because we don't want to filter post titles, we need to remove our
	 * filter when `wp_nav_menu()` exits.
	 *
	 * @since   0.1.0
	 * @wp_hook filter wp_nav_menu
	 * @param   array $nav_menu Not used.
	 * @return  array
	 */
	public static function _remove_menu_item_title_filter( $nav_menu ) {
		remove_filter( 'the_title', array( __CLASS__, '_add_icon' ), 999 );

		return $nav_menu;
	}


	/**
	 * Add icon to menu item title
	 *
	 * @since   0.1.0
	 * @since   0.9.0   Renamed the method to `add_icon()`.
	 * @wp_hook filter  the_title
	 * @param   string $title     Menu item title.
	 * @param   int    $id        Menu item ID.
	 *
	 * @return string
	 */
	public static function _add_icon( $title, $id ) {

		$icon = get_post_meta( $id, '_menu_item_icon', true );

		if ( empty( $icon ) ) {
			return $title;
		}

		if ( ! empty( $icon ) ) {
			$icon = str_replace( '<svg', '<svg width="30px" height="30px"', $icon );

			$title_wrapped = sprintf(
				'<span>%s</span>',
				$title
			);

			$title_with_icon = "{$icon}{$title_wrapped}";

			/**
			 * Allow plugins/themes to override menu item markup
			 *
			 * @since 0.8.0
			 *
			 * @param string  $title_with_icon Menu item markup after the icon is added.
			 * @param integer $id              Menu item ID.
			 * @param array   $meta            Menu item metadata values.
			 * @param string  $title           Original menu item title.
			 *
			 * @return string
			 */
			$title_with_icon = apply_filters( 'mobius_studio_menu_icons_item_title', $title_with_icon, $icon, $title, $id );

			return $title_with_icon;
		}

	}
}
