/**
 * Swiper init for PostsCarousel Widget.
 *
 * @constructor
 * @package Mobius Studio Elementor
 */

export default function PostsCarousel() {
	const el__posts_carousels = document.querySelectorAll( '.mobius-studio-posts-carousel-wrapper.swiper-container' );

	if (el__posts_carousels) {
		el__posts_carousels.forEach(
			el => {
				const options = JSON.parse( el.dataset.options );
				if ( el.querySelector( '.elementor-swiper-button-prev' ) && el.querySelector( '.elementor-swiper-button-next' ) ) {
					options.navigation = {
						nextEl: '.elementor-swiper-button-next',
						prevEl: '.elementor-swiper-button-prev',
						};
				}
				if ( el.querySelector( '.swiper-pagination' ) ) {
					options.pagination = {
						el: '.swiper-pagination',
						type: 'bullets',
						};
				}
				new Swiper(
					el,
					options
				);
			}
		);
	}
}
