/**
 * Swiper init for PostsCarousel Widget.
 *
 * @constructor
 * @package Mobius Studio Elementor
 */

/* global jQuery */
import PostsCarousel from "./posts-carousel";

export default function PostsCarouselAdmin() {
	jQuery(
		function( $ ) {
			if ( window.elementorFrontend ) {
				elementorFrontend.hooks.addAction(
					'frontend/element_ready/posts_carousel.default',
					function( $scope ) {
						PostsCarousel();
					}
				);
			}
		}
	);
}
