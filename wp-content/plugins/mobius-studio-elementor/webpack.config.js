/**
 * Transpile SCSS and JS files to vanilla CSS and JS for old browsers.
 *
 * @type {module:path}
 * @package Mobius Studio Elementor
 */

const path = require( "path" );

module.exports = [
	{
		mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',
		entry: ["./index.js", "./style.scss"],
		output: {
			path: path.resolve( __dirname, "assets" ),
			filename: "js/bundle.js"
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /(node_modules)/,
					use: {
						loader: "babel-loader",
						options: {
							presets: ["@babel/preset-env"]
						}
					}
			},
				{
					test: /\.s[ac]ss$/i,
					use: [
						{
							loader: 'file-loader',
							options: {
								name: 'css/bundle.css',
							}
					},
						{
							loader: 'extract-loader'
					},
						{
							loader: 'css-loader?-url'
					},
						{
							loader: 'postcss-loader'
					},
						{
							loader: 'sass-loader'
					}
					],
			},
			]
		}
	},
	{
		mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',
		entry: "./index-admin.js",
		output: {
			path: path.resolve( __dirname, "assets" ),
			filename: "js/bundle-admin.js"
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /(node_modules)/,
					use: {
						loader: "babel-loader",
						options: {
							presets: ["@babel/preset-env"]
						}
					}
			}
			]
		}
	}
	];
