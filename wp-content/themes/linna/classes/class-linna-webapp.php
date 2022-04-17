<?php
/**
 * Put favicons and web app related tags between head,
 * Create manifest file for browsers with web app information in it.
 * Update manifest file when an option
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

/**
 * This class is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source on its own array key, without adding the
 * both `width` and `height` attributes, since these are added dnamically,
 * before rendering the SVG code.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods.
 *
 * @since 1.0.0
 */
class Linna_WebApp {

	public function __construct() {
		add_action( 'wp_head', array( $this, 'apple_related' ), 0 );
		add_action( 'wp_head', array( $this, 'manifest_related' ), 0 );
		add_action( 'wp_head', array( $this, 'others' ), 0 );
		add_action( 'wp_footer', array( $this, 'register_sw' ), 9 );
		add_action( 'redux/options/linna-theme-options/settings/change', array( $this, 'manifest_related' ), 0 );
	}

	public function apple_related() {
		if ( function_exists( 'linna_option' ) ) {

			foreach ( linna_apple_touch_icons() as $apple_touch_icon ) {
				$icon = linna_option( 'apple-touch-icon-' . $apple_touch_icon, null );
				if ( ! empty( $icon ) && ! empty( $icon['url'] ) ) {
					?>
					<link rel="apple-touch-icon" sizes="<?php echo esc_attr( $apple_touch_icon ); ?>" href="<?php echo esc_url( $icon['url'] ); ?>">
					<?php
				}
			}

			// Web App Enable.
			$web_app_capable = linna_option( 'web-app-capable', '0' );
			if ( '1' === $web_app_capable ) {
				?>
				<meta name="apple-mobile-web-app-capable" content="yes">
				<?php
				$web_app_status_bar_style = linna_option( 'web-app-status-bar-style', 'black' );
				?>
				<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo esc_attr( $web_app_status_bar_style ); ?>">
				<?php
				$web_app_apple_mobile_title = linna_option( 'web-app-apple-mobile-web-app-title', '' );
				?>
				<meta name="apple-mobile-web-app-title" content="<?php echo esc_attr( $web_app_apple_mobile_title ); ?>">
				<?php

				foreach ( linna_startup_screens() as $startup ) {
					$icon = linna_option( 'web-app-size-' . $startup['id'], null );
					if ( ! empty( $icon ) && ! empty( $icon['url'] ) ) {
						?>
						<link rel="apple-touch-startup-image" media="(device-width: <?php echo esc_attr( $startup['device-width'] ); ?>) and (device-height: <?php echo esc_attr( $startup['device-height'] ); ?>) and (-webkit-device-pixel-ratio: <?php echo esc_attr( $startup['device-pixel-ratio'] ); ?>)" href="<?php echo esc_url( $icon['url'] ); ?>">
						<?php
					}
				}
			}
		}
	}

	public function others() {
		if ( function_exists( 'linna_option' ) ) {

			// Web App Enable.
			$web_app_capable = linna_option( 'web-app-capable', '0' );
			if ( '1' === $web_app_capable ) {

				$manifest_options_array = [
					'theme_color' => linna_option( 'web-app-theme-color', '#1e1e1e' ),
				];
				?>
				<meta name="theme-color" content="<?php echo esc_attr( $manifest_options_array['theme_color'] ); ?>">
				<?php

				global $wp_filesystem;
				if ( empty( $wp_filesystem ) ) {
					require_once ABSPATH . '/wp-admin/includes/file.php';
					WP_Filesystem();
				}

				$uploads_dir = $wp_filesystem->abspath() . '/wp-content/uploads';
				if ( $wp_filesystem->is_file( $uploads_dir . '/site.webmanifest' ) ) {
					?>
					<link rel="manifest" href="<?php echo esc_url( wp_get_upload_dir()['baseurl'] ); ?>/site.webmanifest">
					<?php
				}
			}
		}
	}

	public function manifest_related() {
		if ( function_exists( 'linna_option' ) ) {

			// Web App Enable.
			$web_app_capable = linna_option( 'web-app-capable', '0' );
			if ( '1' === $web_app_capable ) {

				$manifest_options_array = [
					'theme_color'      => linna_option( 'web-app-theme-color', '#1e1e1e' ),
					'background_color' => linna_option( 'web-app-background-color', '#1e1e1e' ),
					'name'             => linna_option( 'web-app-application-name', 'Mobius Studio' ),
					'short_name'       => linna_option( 'web-app-application-name-short', 'Mobius Studio' ),
					'display'          => linna_option( 'web-app-display', 'standalone' ),
					'orientation'      => linna_option( 'web-app-orientation', 'portrait' ),
					'start_url'        => get_site_url(),
					'icons'            => [],
				];

				foreach ( linna_chrome_icons() as $chrome_icon ) {
					$icon = linna_option( 'chrome-icon-' . $chrome_icon, null );

					if ( ! empty( $icon ) && ! empty( $icon['url'] ) ) {
						$manifest_options_array['icons'][] = [
							'src'   => $icon['url'],
							'sizes' => $chrome_icon,
							'type'  => 'image/png',
						];
					}
				}

				global $wp_filesystem;
				if ( empty( $wp_filesystem ) ) {
					require_once ABSPATH . '/wp-admin/includes/file.php';
					WP_Filesystem();
				}

				$uploads_dir = $wp_filesystem->abspath() . '/wp-content/uploads';
				if ( ! $wp_filesystem->is_dir( $uploads_dir ) ) {
					if ( ! $wp_filesystem->mkdir( $uploads_dir ) ) {

						return false;

					}
				}

				$wp_filesystem->put_contents( $uploads_dir . '/site.webmanifest', wp_json_encode( $manifest_options_array ) );
			}
		}
		return false;
	}

	public function register_sw() {
		if ( function_exists( 'linna_option' ) ) {

			// Web App Enable.
			$web_app_capable = linna_option( 'web-app-capable', '0' );
			if ( '1' === $web_app_capable ) {
				?>
				<script type="text/javascript">
					if ('serviceWorker' in navigator) {
						navigator.serviceWorker.register('<?php echo esc_url( get_template_directory_uri() ); ?>/js/service-worker.js').then(function(registration) {
							console.log('ServiceWorker registration successful!');
						}).catch(function(err) {
							console.log('ServiceWorker registration failed: ', err);
						});
					}
				</script>
				<?php
			}
		}
		return false;
	}
}


$GLOBALS['Linna_WebApp'] = new Linna_WebApp();
