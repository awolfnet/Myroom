<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Flatmobile for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/mstudio/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'flatmobile_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function flatmobile_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'               => 'Kirki', // The plugin name.
			'slug'               => 'kirki', // The plugin slug (typically the folder name).
			'source'             => 'https://downloads.wordpress.org/plugin/kirki.3.1.0.zip',
			'required'           => true,
			'version'            => '3.1.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'WPBakery Page Builder', // The plugin name.
			'slug'               => 'js_composer', // The plugin slug (typically the folder name).
			'source'             => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Fflatmobile-wp%2Fplugins%2Fjs_composer.6.1.zip?alt=media&token=56d65b1a-a483-4ddf-aba1-1148bff65dcd',
			'required'           => true,
			'version'            => '6.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'FlatMobile VC Extend', // The plugin name.
			'slug'               => 'flatmobile-vc-extend', // The plugin slug (typically the folder name).
			'source'             => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Fflatmobile-wp%2Fplugins%2Fflatmobile-vc-extend.1.3.zip?alt=media&token=04cb43a1-7fda-4128-b74e-571286994203',
			'required'           => true,
			'version'            => '1.3',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'FlatMobile Sidebars', // The plugin name.
			'slug'               => 'flatmobile-sidebars', // The plugin slug (typically the folder name).
			'source'             => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Fflatmobile-wp%2Fplugins%2Fflatmobile-sidebars.1.2.zip?alt=media&token=ee9c8b7b-8b6c-4140-89ac-91c58e883133',
			'required'           => true,
			'version'            => '1.2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'FlatMobile Post Types', // The plugin name.
			'slug'               => 'flatmobile-post-types', // The plugin slug (typically the folder name).
			'source'             => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Fflatmobile-wp%2Fplugins%2Fflatmobile-post-types.1.1.zip?alt=media&token=1c5352e6-8c4a-4a21-a172-d59cb9d31ebb',
			'required'           => true,
			'version'            => '1.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'Revolution Slider', // The plugin name.
			'slug'               => 'revslider', // The plugin slug (typically the folder name).
			'source'             => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Fflatmobile-wp%2Fplugins%2Frevslider.5.3.0.2.zip?alt=media&token=740bd064-2392-4abb-951e-59d3b61a5f9c',
			'required'           => false,
			'version'            => '5.3.0.2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'Meta Box', // The plugin name.
			'slug'               => 'meta-box', // The plugin slug (typically the folder name).
			'source'             => 'https://github.com/rilwis/meta-box/archive/master.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'Contact Form 7', // The plugin name.
			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
			'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.5.1.7.zip',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'Envato Market', // The plugin name.
			'slug'               => 'envato-market', // The plugin slug (typically the folder name).
			'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'WooCommerce', // The plugin name.
			'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
			'source'             => 'http://downloads.wordpress.org/plugin/woocommerce.4.0.1.zip',
			'required'           => false,
			'version'            => '4.0.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'flatmobile',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'flatmobile' ),
			'menu_title'                      => __( 'Install Plugins', 'flatmobile' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'flatmobile' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'flatmobile' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'flatmobile' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'flatmobile'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'flatmobile'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'flatmobile'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'flatmobile'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'flatmobile'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'flatmobile'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'flatmobile'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'flatmobile'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'flatmobile'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'flatmobile' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'flatmobile' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'flatmobile' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'flatmobile' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'flatmobile' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'flatmobile' ),
			'dismiss'                         => __( 'Dismiss this notice', 'flatmobile' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'flatmobile' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'flatmobile' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
