/**
 * Take actions after scss file transformed to css.
 *
 * @type {*|postcss.Plugin<unknown>}
 * @package Mobius Studio Elementor
 */

var postcssFocusWithin = require( 'postcss-focus-within' );

module.exports = {
	plugins: {
		autoprefixer: {}
	}
};

module.exports = {
	plugins: [
		postcssFocusWithin( /* pluginOptions */ )
	]
};
