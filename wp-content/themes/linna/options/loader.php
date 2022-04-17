<?php
/**
 * Load all extensions.
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( ! function_exists( 'linna_redux_register_custom_extension_loader' ) ) :
	/**
	 * Loader for all custom extensions in extensions folder.
	 *
	 * @param Redux $redux_framework Redux base class.
	 */
	function linna_redux_register_custom_extension_loader( $redux_framework ) {
		$path    = dirname( __FILE__ ) . '/extensions/';
		$folders = scandir( $path, 1 );
		foreach ( $folders as $folder ) {
			if ( '.' === $folder || '..' === $folder || ! is_dir( $path . $folder ) ) {
				continue;
			}
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if ( ! class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/' . $redux_framework->args['opt_name'] . '/' . $folder, $class_file );
				if ( $class_file ) {
					require_once $class_file;
				}
			}
			if ( ! isset( $redux_framework->extensions[ $folder ] ) ) {
				$redux_framework->extensions[ $folder ] = new $extension_class( $redux_framework );
			}
		}
	}

	add_action( "redux/extensions/{$opt_name}/before", 'linna_redux_register_custom_extension_loader', 0 );
endif;
