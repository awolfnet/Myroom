<?php
/**
 * Plugin Name: Linna Demo Importer
 * Description: Install the exact demo content into your WordPress. Get ready in less than 1 minute.
 * Plugin URI: https://elementor.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: Mobius Studio
 * Version: 1.0.0
 * Author URI: https://mobius.studio
 *
 * Text Domain: linna-demo-importer
 *
 * @package Linna Demo Importer
 * @category Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'LINNA_DEMO_IMPORTER_VERSION', '1.0.0' );
define( 'LINNA_DEMO_IMPORTER__FILE__', __FILE__ );
define( 'LINNA_DEMO_IMPORTER_PLUGIN_BASE', plugin_basename( LINNA_DEMO_IMPORTER__FILE__ ) );
define( 'LINNA_DEMO_IMPORTER_PATH', plugin_dir_path( LINNA_DEMO_IMPORTER__FILE__ ) );
define( 'LINNA_DEMO_IMPORTER_URL', plugins_url( '/', LINNA_DEMO_IMPORTER__FILE__ ) );
define( 'LINNA_DEMO_IMPORTER_ASSETS_URL', LINNA_DEMO_IMPORTER_URL . 'interface/' );

/**
 * Class Linna_Demo_Importer
 */
class Linna_Demo_Importer {

	/**
	 * Demo content information api.
	 *
	 * @var string
	 */
	public static $remote_url = 'https://mobius-266420.firebaseapp.com/demo-content/%s';

	/**
	 * - Add plugin to admin menu.
	 * - Enqueue scripts when on plugin page.
	 * - Register WP Ajax translations function.
	 * - Register WP Ajax host_tests function.
	 * - Register WP Ajax media_download function.
	 * - Register WP Ajax sql_download function.
	 * - Update script tags for module loading and defering.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_demo_importer' ) );

		// Enqueue custom required css and javascripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'demo_importer_enqueue_scripts' ), 10, 1 );

		// Html content of plugin with special wp_ajax_ prefix.
		add_action( 'wp_ajax_translations', array( $this, 'translations' ), 10, 0 );

		// Html content of plugin with special wp_ajax_ prefix.
		add_action( 'wp_ajax_host_tests', array( $this, 'host_tests' ), 10, 0 );

		// Html content of plugin with special wp_ajax_ prefix.
		add_action( 'wp_ajax_media_download', array( $this, 'media_download' ), 10, 0 );

		// Html content of plugin with special wp_ajax_ prefix.
		add_action( 'wp_ajax_sql_download', array( $this, 'sql_download' ), 10, 0 );

		add_filter( 'script_loader_tag', array( $this, 'modernize_interface_script_tags' ), 10, 3 );
	}

	/**
	 * Add demo importer to admin menu under Apperance.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function add_demo_importer() {
		add_menu_page(
			esc_html__( 'Linna Demo Importer', 'linna-demo-importer' ),
			esc_html__( 'Linna Demo Importer', 'linna-demo-importer' ),
			'administrator',
			'linna-demo-importer',
			array( $this, 'demo_importer_page' ),
			'dashicons-update-alt',
		);
	}

	/**
	 * Update plugin related script tags with module loading and defering.
	 *
	 * @param string $tag Whole script tag.
	 * @param string $handle Registered handle name.
	 * @param string $src Source.
	 *
	 * @return string
	 */
	public function modernize_interface_script_tags( $tag, $handle, $src ) {
		if ( false !== strpos( $handle, 'linna-importer-' ) && false !== strpos( $handle, '-es2015' ) ) {
			$tag = str_replace( ' src', ' type="module" src', $tag );
		} elseif ( false !== strpos( $handle, 'linna-importer-' ) && false !== strpos( $handle, '-es5' ) ) {
			$tag = str_replace( ' src', ' nomodule defer src', $tag );
		}

		return $tag;
	}

	/**
	 * Make sure to load script files only on plugins page.
	 * MS_DEV can only be defined by plugin owner to work on uncompiled code.
	 * Development and production files differs.
	 *
	 * Localize script handles to make ajax_object available.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function demo_importer_enqueue_scripts() {
		if ( isset( $_GET['page'] ) && 'linna-demo-importer' === $_GET['page'] && wp_verify_nonce( sanitize_key( wp_create_nonce() ) ) ) {
			if ( ! defined( 'MS_DEV' ) || ( defined( 'MS_DEV' ) && ! MS_DEV ) ) {
				wp_enqueue_style( 'linna-importer-app-style', LINNA_DEMO_IMPORTER_ASSETS_URL . 'styles.css', array(), LINNA_DEMO_IMPORTER_VERSION );

				wp_enqueue_script( 'linna-importer-app-runtime-es2015', LINNA_DEMO_IMPORTER_ASSETS_URL . 'runtime-es2015.js', null, LINNA_DEMO_IMPORTER_VERSION, true );
				wp_enqueue_script( 'linna-importer-app-polyfills-es2015', LINNA_DEMO_IMPORTER_ASSETS_URL . 'polyfills-es2015.js', null, LINNA_DEMO_IMPORTER_VERSION, true );
				wp_enqueue_script( 'linna-importer-app-main-es2015', LINNA_DEMO_IMPORTER_ASSETS_URL . 'main-es2015.js', null, LINNA_DEMO_IMPORTER_VERSION, true );

				wp_enqueue_script( 'linna-importer-app-runtime-es5', LINNA_DEMO_IMPORTER_ASSETS_URL . 'runtime-es5.js', null, LINNA_DEMO_IMPORTER_VERSION, true );
				wp_enqueue_script( 'linna-importer-app-polyfills-es5', LINNA_DEMO_IMPORTER_ASSETS_URL . 'polyfills-es5.js', null, LINNA_DEMO_IMPORTER_VERSION, true );
				wp_enqueue_script( 'linna-importer-app-main-es5', LINNA_DEMO_IMPORTER_ASSETS_URL . 'main-es5.js', null, LINNA_DEMO_IMPORTER_VERSION, true );

				wp_localize_script( 'linna-importer-app-main-es2015', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				wp_localize_script( 'linna-importer-app-main-es5', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

			} elseif ( defined( 'MS_DEV' ) && MS_DEV ) {

				wp_enqueue_script( 'linna-importer-app-runtime', LINNA_DEMO_IMPORTER_ASSETS_URL . 'runtime.js', null, LINNA_DEMO_IMPORTER_VERSION, true );
				wp_enqueue_script( 'linna-importer-app-polyfills', LINNA_DEMO_IMPORTER_ASSETS_URL . 'polyfills.js', null, LINNA_DEMO_IMPORTER_VERSION, true );

				wp_register_script( 'linna-importer-app-main', LINNA_DEMO_IMPORTER_ASSETS_URL . 'main.js', null, LINNA_DEMO_IMPORTER_VERSION, true );

				wp_enqueue_script( 'linna-importer-app-vendor', LINNA_DEMO_IMPORTER_ASSETS_URL . 'vendor.js', null, LINNA_DEMO_IMPORTER_VERSION, true );
				wp_enqueue_script( 'linna-importer-app-styles-js', LINNA_DEMO_IMPORTER_ASSETS_URL . 'styles.js', null, LINNA_DEMO_IMPORTER_VERSION, true );

				wp_enqueue_script( 'linna-importer-app-main' );

				wp_localize_script( 'linna-importer-app-main', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
			}
		}
	}

	/**
	 * Layout of this page.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function demo_importer_page() {
		echo ' <app-root></app-root> ';
	}

	/**
	 * Localization of interface.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function translations() {
		if ( wp_verify_nonce( sanitize_key( wp_create_nonce() ) ) && current_user_can( 'administrator' ) ) {

			$translations = array(
				'Linna Demo Content Importer'        => __( 'Linna Demo Content Importer', 'linna-demo-importer' ),
				'Checking Hosting Capabilities'      => __( 'Checking Hosting Capabilities', 'linna-demo-importer' ),
				'Please Wait...'                     => __( 'Please Wait...', 'linna-demo-importer' ),
				'Success. You may proceed...'        => __( 'Success. You may proceed...', 'linna-demo-importer' ),
				'Please follow other options to import demo...' => __(
					'Please follow other options to import demo...',
					'linna-demo-importer'
				),
				'This process is mandatory in order to make sure a successful import.' => __(
					'This process is mandatory in order to make sure a successful import.',
					'linna-demo-importer'
				),
				'Can WordPress get available demos from remote server ?' => __(
					'Can WordPress get available demos from remote server ?',
					'linna-demo-importer'
				),
				'(Yes)'                              => __( '(Yes)', 'linna-demo-importer' ),
				'(Good)'                             => __( '(Good)', 'linna-demo-importer' ),
				'Can WordPress read files ?'         => __( 'Can WordPress read files ?', 'linna-demo-importer' ),
				'No.'                                => __( 'No.', 'linna-demo-importer' ),
				'Can WordPress create directories ?' => __(
					'Can WordPress create directories ?',
					'linna-demo-importer'
				),
				'Can WordPress copy files ?'         => __( 'Can WordPress copy files ?', 'linna-demo-importer' ),
				'Can WordPress read and write into database ?' => __(
					'Can WordPress read and write into database ?',
					'linna-demo-importer'
				),
				/* translators: %1$s: <code> tag start. %2$s: </code> tag end. %3$s: <strong> tag start. %4$s: </strong> tag end */
				'Minimum required <code>max_execution_time</code> is <strong>360</strong>.' => sprintf(
					__( 'Minimum required %1$smax_execution_time%2$s is %3$s360%4$s.' ),
					'<code>',
					'</code>',
					'<strong>',
					'</strong>'
				),
				/* translators: %1$s: <code> tag start. %2$s: </code> tag end. %3$s: <strong> tag start. %4$s: </strong> tag end */
				'Minimum required <code>memory_limit</code> is <strong>128M</strong>.' => sprintf(
					__( 'Minimum required %1$smemory_limit%2$s is %3$s128M%4$s.' ),
					'<code>',
					'</code>',
					'<strong>',
					'</strong>'
				),
				/* translators: %1$s: <code> tag start. %2$s: </code> tag end. %3$s: <strong> tag start. %4$s: </strong> tag end */
				'Minimum required <code>post_max_size</code> is <strong>8M</strong>.' => sprintf(
					__( 'Minimum required %1$spost_max_size%2$s is %3$s8M%4$s.' ),
					'<code>',
					'</code>',
					'<strong>',
					'</strong>'
				),
				/* translators: %1$s: <code> tag start. %2$s: </code> tag end. %3$s: <strong> tag start. %4$s: </strong> tag end */
				'Minimum required <code>upload_max_filesize</code> is <strong>2M</strong>.' => sprintf(
					__( 'Minimum required %1$supload_max_filesize%2$s is %3$s2M%4$s.' ),
					'<code>',
					'</code>',
					'<strong>',
					'</strong>'
				),
				/* translators: %1$s: <a> tag start. %2$s: </a> tag end */
				'For questions, requests please contact us from our <a href=https://themeforest.net/user/mobiusstudio target=_blank>ThemeForest profile</a>.' => sprintf(
					__( 'For questions, requests please contact us from our %1$sThemeForest profile%2$s.' ),
					'<a href=https://themeforest.net/user/mobiusstudio target=_blank>',
					'</a>'
				),
				'Next'                               => __( 'Next', 'linna-demo-importer' ),
				'Select a Demo'                      => __( 'Select a Demo', 'linna-demo-importer' ),
				'Demo Contents'                      => __( 'Demo Contents', 'linna-demo-importer' ),
				'Please choose a demo content from below to import.' => __(
					'Please choose a demo content from below to import.',
					'linna-demo-importer'
				),
				'INSTALL/IMPORT'                     => __( 'INSTALL/IMPORT', 'linna-demo-importer' ),
				'Back'                               => __( 'Back', 'linna-demo-importer' ),
				'Importing'                          => __( 'Importing', 'linna-demo-importer' ),
				'Importing...'                       => __( 'Importing...', 'linna-demo-importer' ),
				'Please do not close or refresh this page until importing is done.' => __(
					'Please do not close or refresh this page until importing is done.',
					'linna-demo-importer'
				),
				'Assets download status'             => __( 'Assets download status', 'linna-demo-importer' ),
				'Posts, pages, wigets, options...'   => __( 'Posts, pages, wigets, options...', 'linna-demo-importer' ),
				'Done'                               => __( 'Done', 'linna-demo-importer' ),
				'Congratulations!'                   => __( 'Congratulations!', 'linna-demo-importer' ),
				'Your theme is ready to use.'        => __( 'Your theme is ready to use.', 'linna-demo-importer' ),
				'And do not forget to rate us'       => __( 'And do not forget to rate us', 'linna-demo-importer' ),
				'This process will remove every post, page, option from this WordPress and replace with chosen demo content data. Are you sure to continue ?' => __(
					'This process will remove every post, page, option from this WordPress and replace with chosen demo content data. Are you sure to continue ?',
					'linna-demo-importer'
				),
				'I understand and accept. Continue.' => __(
					'I understand and accept. Continue.',
					'linna-demo-importer'
				),
				'No Thanks'                          => __( 'No Thanks', 'linna-demo-importer' ),
				'Import'                             => __( 'Import', 'linna-demo-importer' ),
				'Please Read Carefully'              => __( 'Please Read Carefully', 'linna-demo-importer' ),
			);

			echo wp_json_encode( $translations );

		} else {
			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'Please make sure you are logged in as administrator.', 'linna-demo-importer' ) ) );
		}

		wp_die();
	}

	/**
	 * Test host settings before allowing user to import.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function host_tests() {
		// webhosting permission and capability check.
		if (
			wp_verify_nonce( sanitize_key( wp_create_nonce() ) ) &&
			current_user_can( 'administrator' )
		) {
			$function_name = filter_input( INPUT_POST, 'function_name', FILTER_SANITIZE_STRING );
			if ( isset( $_POST['function_name'] ) && ! empty( $_POST['function_name'] ) && method_exists( $this, $function_name ) ) {
				$this->$function_name();
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'Please make sure you are logged in as administrator.', 'linna-demo-importer' ) ) );
		}

		wp_die();
	}

	/**
	 * Download the url posted and move it in uploads folder.
	 * If url already downloaded before, skip.
	 */
	public function media_download() {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		if ( wp_verify_nonce( sanitize_key( wp_create_nonce() ) ) && current_user_can( 'administrator' ) ) {
			$url = filter_input( INPUT_POST, 'url', FILTER_SANITIZE_URL );
			if ( isset( $url ) && ! empty( $url ) ) {

				$new_path = $wp_filesystem->abspath() . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
				$new_file = $this->basename_remove_query_string( $url );

				if ( ! file_exists( $new_path . $new_file ) ) {
					$download = download_url( $url );

					if ( is_wp_error( $download ) ) {
						http_response_code( 401 );
						echo wp_json_encode(
							array(
								'message' => sprintf(
									__( 'An error occured while downloading a media file.', 'linna-demo-importer' ),
								),
							)
						);
					} else {
						// $new_path = $wp_filesystem->abspath() . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->basename_remove_query_string( $url );

						$wp_filesystem->move( $download, $new_path . $new_file );
					}
				}

				if ( 'zip' === pathinfo( $new_file, PATHINFO_EXTENSION ) && file_exists( $new_path . $new_file ) ) {
					unzip_file( $new_path . $new_file, $new_path );
				}
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'Please make sure you are logged in as administrator.', 'linna-demo-importer' ) ) );
		}

		wp_die();
	}

	/**
	 * Download options, zip and imp files if urls are available
	 * options contains theme options, widgets, menus, plugin options.
	 * imp contains posts, categories pages, taxonomies.
	 * zip contains imp in zip file.
	 */
	public function sql_download() {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		if ( wp_verify_nonce( sanitize_key( wp_create_nonce() ) ) && current_user_can( 'administrator' ) ) {
			$failures = [
				'options' => true,
				'zip'     => true,
				'imp'     => true,
			];

			$destination      = wp_upload_dir();
			$destination_path = $destination['path'];
			$new_path         = $destination_path . DIRECTORY_SEPARATOR;

			foreach ( $failures as $type => $error_status ) {
				// try importing from.
				$file = filter_input( INPUT_POST, $type, FILTER_SANITIZE_URL );

				if ( isset( $file ) && ! empty( $file ) ) {
					$failures[ $type ] = false;

					$download = download_url( $file );

					if ( is_wp_error( $download ) ) {
						$failures[ $type ] = true;
					} else {

						if ( 'zip' === $type ) {
							$unzipfile = unzip_file( $download, $destination_path );

							if ( ! $unzipfile ) {
								$failures[ $type ] = true;
							}
						} else {
							$wp_filesystem->move( $download, $new_path . $this->basename_remove_query_string( $file ) );
						}

						// remove downloaded file.
						$wp_filesystem->delete( $download );
					}
				}

				// if current array is successful then skip rest.
				if ( false === $failures[ $type ] && 'options' !== $type ) {
					$this->import_db( $new_path );
					break;
				}
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'Please make sure you are logged in as administrator.', 'linna-demo-importer' ) ) );
		}

		wp_die();
	}

	/**
	 * Import sql and options.
	 * Clean up files when complete.
	 *
	 * @param string $sql_file_full_path Folder path of downloaded sql files.
	 */
	protected function import_db( $sql_file_full_path ) {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$data_file    = $sql_file_full_path . 'data.imp';
		$options_file = $sql_file_full_path . 'data.options';

		// clear tables.
		global $wpdb;
		// phpcs:disable
		$wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'postmeta' );
		$wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'posts' );
		$wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'term_relationships' );
		$wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'term_taxonomy' );
		$wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'terms' );
		// phpcs:enable

		// read SQL dump and process each statement.
		$sql_data = $wp_filesystem->get_contents( $data_file );
		$sql      = explode( '<linna_sep>', $sql_data );

		foreach ( $sql as $statement ) {

			if ( ! empty( $statement ) ) {

				// also replace all our sample paths to the user's actual path.
				$this->rename_site_urls( $statement );

				// replace default wp prefix to user's choice if it's not the default one.
				if ( strstr( $statement, 'wp_comments' ) && 'wp_' !== $wpdb->prefix ) {
					$statement = str_replace( 'wp_comments', $wpdb->prefix . 'comments', $statement );
				}

				if ( strstr( $statement, 'wp_postmeta' ) ) {
					if ( 'wp_' !== $wpdb->prefix ) {
						$statement = str_replace( 'wp_postmeta', $wpdb->prefix . 'postmeta', $statement );
					}
				}

				if ( strstr( $statement, 'wp_posts' ) ) {
					if ( 'wp_' !== $wpdb->prefix ) {
						$statement = str_replace( 'wp_posts', $wpdb->prefix . 'posts', $statement );
					}
				}

				if ( strstr( $statement, 'wp_term_relationships' ) && 'wp_' !== $wpdb->prefix ) {
					$statement = str_replace( 'wp_term_relationships', $wpdb->prefix . 'term_relationships', $statement );
				}

				if ( strstr( $statement, 'wp_term_taxonomy' ) && 'wp_' !== $wpdb->prefix ) {
					$statement = str_replace( 'wp_term_taxonomy', $wpdb->prefix . 'term_taxonomy', $statement );
				}

				if ( strstr( $statement, 'wp_terms' ) && 'wp_' !== $wpdb->prefix ) {
					$statement = str_replace( 'wp_terms', $wpdb->prefix . 'terms', $statement );
				}

				// phpcs:disable
				$wpdb->query( $statement ); // db call ok; no-cache ok.
				// phpcs:enable
			}
		}

		$wp_filesystem->delete( $data_file );

		$options_file_data = $wp_filesystem->get_contents( $options_file );
		if ( ! empty( $options_file_data ) ) {

			// also replace all our sample paths to the user's actual path.
			$this->rename_site_urls( $options_file_data );

			preg_match_all( '/[\d]+, \'(.*?)\', \'(.*?)\', \'[yesno]+\'/i', $options_file_data, $option_matches );

			if ( isset( $option_matches[1] ) ) {
				foreach ( $option_matches[1] as $key => $option_match ) {
					if ( is_serialized( $option_matches[2][ $key ] ) ) {
						$option_matches[2][ $key ] = wp_unslash( $option_matches[2][ $key ] );

						$option_matches[2][ $key ] = preg_replace_callback(
							'/s:([0-9]+):\"(.*?)\";/',
							function ( $matches ) {
								return 's:' . strlen( $matches[2] ) . ':"' . $matches[2] . '";';     },
							$option_matches[2][ $key ]
						);
					}

					update_option( $option_match, maybe_unserialize( $option_matches[2][ $key ] ) );
				}
			}
		}

		$wp_filesystem->delete( $options_file );
	}

	protected function rename_site_urls( &$content ) {
		$current_url         = get_site_url();
		$current_escaped_url = str_replace( '/', '\\\\/', get_site_url() );

		$content = str_replace( 'http://linna.devel', $current_url, $content );
		$content = str_replace( 'http:\\/\\/linna.devel', $current_escaped_url, $content );
	}

	/**
	 * Ajax call function for interface.
	 * Checks if WordPress filesystem can read contents of a file.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_wp_filesystem_read() {
		if ( '1' !== ini_get( 'allow_url_fopen' ) && 'On' !== ini_get( 'allow_url_fopen' ) ) {

			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'The allow_url_fopen setting is turned off in the PHP ini! Please contact your hosting provider with this error.', 'linna-demo-importer' ) ) );

		} else {
			// can we read a file with wp filesystem?
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}

			if ( ! $wp_filesystem->get_contents( LINNA_DEMO_IMPORTER_URL . 'pixel.jpg' ) ) {

				http_response_code( 401 );
				echo wp_json_encode( array( 'message' => esc_html__( 'Importer couldn\'t read the test file. Does it have the permission to read ?', 'linna-demo-importer' ) ) );

			}
		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks if WordPress filesystem can create folder in uploads directory.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_wp_filesystem_create_dir() {
		// can we read a file with wp filesystem?
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$uploads_dir = $wp_filesystem->abspath() . '/wp-content/uploads';
		if ( ! $wp_filesystem->is_dir( $uploads_dir ) ) {
			if ( ! $wp_filesystem->mkdir( $uploads_dir ) ) {

				http_response_code( 401 );
				echo wp_json_encode( array( 'message' => esc_html__( 'Importer couldn\'t create a directory!', 'linna-demo-importer' ) ) );

			}
		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks if WordPress filesystem can copy a file.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_wp_filesystem_copy() {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		if ( ! $wp_filesystem->copy( LINNA_DEMO_IMPORTER_PATH . 'pixel.jpg', $wp_filesystem->abspath() . '/wp-content/uploads/linna-demo-importer-copy-test.jpg' ) ) {

			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'Importer couldn\'t copy a file!', 'linna-demo-importer' ) ) );

		} else {

			$wp_filesystem->delete( $wp_filesystem->abspath() . '/wp-content/uploads/linna-demo-importer-copy-test.jpg' );

		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks if this script can run a direct sql query.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_db_rw() {
		global $wpdb;
		// phpcs:disable
		if ( ! $wpdb->query( 'CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix . 'testing (id mediumint(9) NOT NULL AUTO_INCREMENT, test varchar(255), UNIQUE KEY id (id))' ) ) {

			http_response_code( 401 );
			echo wp_json_encode( array( 'message' => esc_html__( 'Importer is not allowed to write MySQL database!', 'linna-demo-importer' ) ) );

		} else {

			if ( ! $wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'testing' ) ) {

				http_response_code( 401 );
				echo wp_json_encode( array( 'message' => esc_html__( 'Importer is not allowed to write MySQL database!', 'linna-demo-importer' ) ) );

			}
		}
		// phpcs:enable
	}

	/**
	 * Ajax call function for interface.
	 * Checks if php setting max_execution_time is enough.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_max_execution_time() {
		$ini_get_test_result = $this->ini_get_tester();

		if ( true === $ini_get_test_result ) {
			$current = (int) ini_get( 'max_execution_time' );

			if ( empty( $current ) ) {
				http_response_code( 401 );
				/* translators: %s: php setting name. */
				echo wp_json_encode( array( 'message' => sprintf( __( 'Please make sure <code>%s</code> is 360 or more.', 'linna-demo-importer' ), 'ini_get' ) ) );

				return;
			}

			if ( - 1 !== $current && 360 > $current ) {
				if ( false === set_time_limit( 360 ) ) {
					http_response_code( 401 );
					/* translators: %s: php function. */
					echo wp_json_encode( array( 'message' => sprintf( __( '<code>%s</code> is not working. Please contact your hosting provider.', 'linna-demo-importer' ), 'set_time_limit' ) ) );

					return;
				}
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( $ini_get_test_result );
		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks if php setting memory_limit is enough.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_memory_limit() {
		$ini_get_test_result = $this->ini_get_tester();

		if ( true === $ini_get_test_result ) {
			$requirement_name         = 'memory_limit';
			$requirement_in_shorthand = '128M';
			$requirement_in_bytes     = wp_convert_hr_to_bytes( $requirement_in_shorthand ); // 128 mega bytes in bytes.
			$current                  = wp_convert_hr_to_bytes( ini_get( $requirement_name ) );

			if ( empty( $current ) ) {
				http_response_code( 401 );
				echo wp_json_encode(
					array(
						'message' => sprintf(
							/* translators: %1$s: php setting name. %2$s: shorthand memory like 64K, 128M, 256G etc. */
							__( 'Php <code>%1$s</code> must be at least %2$s. Please contact your hosting provider.', 'linna-demo-importer' ),
							$requirement_name,
							$requirement_in_shorthand
						),
					)
				);

				return;
			}

			if ( - 1 !== $current && $current < $requirement_in_bytes ) {
				if ( false === wp_raise_memory_limit( $requirement_in_shorthand ) ) {
					http_response_code( 401 );
					echo wp_json_encode(
						array(
							'message' => sprintf(
								/* translators: %1$s: php setting name. %2$s: shorthand memory like 64K, 128M, 256G etc. */
								__( 'Php <code>%1$s</code> must be at least %2$s. Please contact your hosting provider.', 'linna-demo-importer' ),
								$requirement_name,
								$requirement_in_shorthand
							),
						)
					);

					return;
				}
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( $ini_get_test_result );
		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks if php setting post_max_size is enough.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_post_max_size() {
		$ini_get_test_result = $this->ini_get_tester();

		if ( true === $ini_get_test_result ) {
			$requirement_name         = 'post_max_size';
			$requirement_in_shorthand = '8M';
			$requirement_in_bytes     = wp_convert_hr_to_bytes( $requirement_in_shorthand ); // 32 mega bytes in bytes.
			$current                  = wp_convert_hr_to_bytes( ini_get( $requirement_name ) );

			if ( empty( $current ) ) {
				http_response_code( 401 );
				echo wp_json_encode(
					array(
						'message' => sprintf(
							/* translators: %1$s: php setting name. %2$s: shorthand memory like 64K, 128M, 256G etc. */
							__( 'Php <code>%1$s</code> must be at least %2$s. Please contact your hosting provider.', 'linna-demo-importer' ),
							$requirement_name,
							$requirement_in_shorthand
						),
					)
				);

				return;
			}

			if ( - 1 !== $current && $current < $requirement_in_bytes ) {
				http_response_code( 401 );
				echo wp_json_encode(
					array(
						'message' => sprintf(
							/* translators: %1$s: php setting name. %2$s: shorthand memory like 64K, 128M, 256G etc. */
							__( 'Php <code>%1$s</code> must be at least %2$s. Please contact your hosting provider.', 'linna-demo-importer' ),
							$requirement_name,
							$requirement_in_shorthand
						),
					)
				);

				return;
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( $ini_get_test_result );
		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks if php setting upload_max_filesize is enough.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_upload_max_filesize() {
		$ini_get_test_result = $this->ini_get_tester();

		if ( true === $ini_get_test_result ) {
			$requirement_name         = 'upload_max_filesize';
			$requirement_in_shorthand = '2M';
			$requirement_in_bytes     = wp_convert_hr_to_bytes( $requirement_in_shorthand ); // 32 mega bytes in bytes.
			$current                  = wp_convert_hr_to_bytes( ini_get( $requirement_name ) );

			if ( empty( $current ) ) {
				http_response_code( 401 );
				echo wp_json_encode(
					array(
						'message' => sprintf(
							/* translators: %1$s: php setting name. %2$s: shorthand memory like 64K, 128M, 256G etc. */
							__( 'Php <code>%1$s</code> must be at least %2$s. Please contact your hosting provider.', 'linna-demo-importer' ),
							$requirement_name,
							$requirement_in_shorthand
						),
					)
				);

				return;
			}
			if ( - 1 !== $current && $current < $requirement_in_bytes ) {
				http_response_code( 401 );
				echo wp_json_encode(
					array(
						'message' => sprintf(
							/* translators: %1$s: php setting name. %2$s: shorthand memory like 64K, 128M, 256G etc. */
							__( 'Php <code>%1$s</code> must be at least %2$s. Please contact your hosting provider.', 'linna-demo-importer' ),
							$requirement_name,
							$requirement_in_shorthand
						),
					)
				);

				return;
			}
		} else {
			http_response_code( 401 );
			echo wp_json_encode( $ini_get_test_result );
		}
	}

	/**
	 * Ajax call function for interface.
	 * Checks and returns demo information from remote.
	 *
	 * Not directly called.
	 * Called dynamically from self::host_tests() function.
	 */
	protected function host_check_wp_remote_get() {
		$remote = wp_safe_remote_get( sprintf( self::$remote_url, 'linna-wp' ) );
		if ( is_wp_error( $remote ) ) {
			http_response_code( 401 );
			echo wp_json_encode(
				array(
					'message' => sprintf(
						__(
							'An error occured while making an HTTP GET request to the remote server. Please refresh the page. If this error persist, contact your hosting provider to enable cURL to make request secure endpoints.',
							'linna-demo-importer'
						),
					),
				)
			);

			return;
		} else {
			$body = wp_remote_retrieve_body( $remote );
			echo wp_json_encode(
				array(
					'message' => sprintf(
						__( 'Actually successfull, see body.', 'linna-demo-importer' ),
					),
					'body'    => $body,
				)
			);
		}
	}

	/**
	 * Checks if ini_get is available.
	 */
	protected function ini_get_tester() {
		if ( ! function_exists( 'ini_get' ) ) {
			/* translators: %s: php setting name. */
			return array( 'message' => sprintf( __( 'Please contact your hosting provider to enable <code>%s</code>.', 'linna-demo-importer' ), 'ini_get' ) );
		}

		return true;
	}

	/**
	 * Extract actual file name from url.
	 *
	 * @param string $url Long url pointing to a file. Usually containing query string.
	 *
	 * @return string File name with extension.
	 */
	protected function basename_remove_query_string( $url ) {
		$basename = basename( $url );

		if ( false !== strpos( $basename, '?' ) ) {
			$basename = explode( '?', $basename );
			$basename = $basename[0];
		}

		return $basename;
	}
}

// instantiate plugin's class.
$GLOBALS['Linna_Demo_Importer'] = new Linna_Demo_Importer();
