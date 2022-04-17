<?php
/**
 * Small helper functions.
 *
 * @package Mobius Studio Elementor Helpers Trait
 * @category Mobius Studio Elementor
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Trait Helpers
 */
trait Helpers {

	/**
	 * Get the options from elementor and map those to proper SwiperJS plugin options.
	 * Compatible with SwiperJS < 5.0.
	 *
	 * @param array $elementor_options Option array from elementor.
	 *
	 * @return array Return as array, it will be json encoded after for javascript object.
	 */
	public function map_elementor_options_to_swiper_options( $elementor_options ) {

		$responsive = [ 'slides_to_show', 'slides_to_scroll', 'image_spacing_custom' ];

		$key_transitions = [
			'slides_to_show'                         => 'slidesPerView',
			'slides_to_scroll'                       => 'slidesPerGroup',
			'image_spacing_custom'                   => 'spaceBetween',
			'infinite'                               => 'loop',
			'speed'                                  => 'speed',
			'autoplay'                               => 'autoplay',
			'autoplay_children_pause_on_interaction' => 'disableOnInteraction',
			'autoplay_children_autoplay_speed'       => 'delay',
		];

		$output = [
			'breakpoints' => [
				576 => [],
				768 => [],
			],
		];

		$elementor_breakpoints = [
			'_mobile' => 576,
			'_tablet' => 768,
		];

		array_walk_recursive(
			$key_transitions,
			function ( $swiper_key, $elementor_key ) use ( $key_transitions, $elementor_breakpoints, $responsive, &$output, $elementor_options ) {

				if ( in_array( $elementor_key, $responsive, true ) ) {

					foreach ( $elementor_breakpoints as $elementor_key_append => $breakpoint ) {
						if ( array_key_exists( $elementor_key . $elementor_key_append, $elementor_options ) ) {

							if ( isset( $elementor_options[ $elementor_key . $elementor_key_append ] ) && '' !== $elementor_options[ $elementor_key . $elementor_key_append ] ) {
								$output['breakpoints'][ $breakpoint ][ $swiper_key ] = $this->get_raw_value_from_elementor_option( $elementor_options[ $elementor_key . $elementor_key_append ] );
							}
						}
					}
				}

				if ( strpos( $elementor_key, '_children_' ) !== false ) {

					preg_match( '/^(.*?)_children_(.*?)$/', $elementor_key, $matches );

					if ( count( $matches ) === 3 ) {
						if ( ! isset( $output[ $matches[1] ] ) || ( isset( $elementor_options[ $matches[2] ] ) && ! is_array( $output[ $matches[1] ] ) ) ) {
							$output[ $matches[1] ] = [];
						}

						if ( isset( $elementor_options[ $matches[2] ] ) && '' !== $elementor_options[ $matches[2] ] ) {
							$output[ $matches[1] ][ $swiper_key ] = $this->get_raw_value_from_elementor_option( $elementor_options[ $matches[2] ] );
						}
					}
				} elseif ( array_key_exists( $elementor_key, $elementor_options ) ) {
					if ( isset( $elementor_options[ $elementor_key ] ) && '' !== $elementor_options[ $elementor_key ] ) {
						$output[ $swiper_key ] = $this->get_raw_value_from_elementor_option( $elementor_options[ $elementor_key ] );
					}
				}
			}
		);

		return $output;
	}

	/**
	 * If the elementor option contains more than value, this helper function will return the value only.
	 *
	 * @param array $elementor_option Option value from elementor.
	 *
	 * @return integer|string|array
	 */
	function get_raw_value_from_elementor_option( $elementor_option ) {
		return isset( $elementor_option['size'] ) ? $elementor_option['size'] : $elementor_option;
	}
}
