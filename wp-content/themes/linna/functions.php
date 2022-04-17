<?php
/**
 * Linna functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( ! function_exists( 'linna_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function linna_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Linna, use a find and replace
		 * to change 'linna' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'linna', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'linna' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'linna' ),
					'shortName' => __( 'S', 'linna' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'linna' ),
					'shortName' => __( 'M', 'linna' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'linna' ),
					'shortName' => __( 'L', 'linna' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'linna' ),
					'shortName' => __( 'XL', 'linna' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'linna' ),
					'slug'  => 'primary',
					'color' => linna_hsl_hex(
						'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod(
							'primary_color_hue',
							199
						),
						100,
						33
					),
				),
				array(
					'name'  => __( 'Secondary', 'linna' ),
					'slug'  => 'secondary',
					'color' => linna_hsl_hex(
						'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod(
							'primary_color_hue',
							199
						),
						100,
						23
					),
				),
				array(
					'name'  => __( 'Dark Gray', 'linna' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'linna' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'linna' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add all available post formats.
		add_theme_support(
			'post-formats',
			array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' )
		);
	}
endif;
add_action( 'after_setup_theme', 'linna_setup' );

/**
 * TGM Plugin Activation Class
 */
require_once get_template_directory() . '/classes/class-tgm-plugin-activation.php';

if ( ! function_exists( 'linna_register_required_plugins' ) ) {
	/**
	 * Register essential and optional plugin required by the theme.
	 */
	function linna_register_required_plugins() {
		$plugins = array(
			array(
				'name'             => 'Redux Framework',
				'slug'             => 'redux-framework',
				'required'         => true,
				'force_activation' => true,
			),
			array(
				'name'             => 'Elementor Page Builder',
				'slug'             => 'elementor',
				'required'         => true,
				'force_activation' => true,
			),
			array(
				'name'             => 'Fly Dynamic Image Resizer',
				'slug'             => 'fly-dynamic-image-resizer',
				'required'         => true,
				'force_activation' => true,
			),
			array(
				'name'             => 'WPForms',
				'slug'             => 'wpforms-lite',
				'required'         => false,
				'force_activation' => false,
			),
			array(
				'name'             => 'Mobius Studio Elementor',
				'slug'             => 'mobius-studio-elementor',
				'source'           => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Flinna-wp%2Fplugins%2Fmobius-studio-elementor.zip?alt=media&token=1147c300-a276-4baf-893e-a53f9fdcf095',
				'required'         => true,
				'force_activation' => true,
			),
			array(
				'name'             => 'Mobius Studio Menu Icons',
				'slug'             => 'mobius-studio-menu-icons',
				'source'           => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Flinna-wp%2Fplugins%2Fmobius-studio-menu-icons.zip?alt=media&token=81b9edcc-4dbe-406a-8b29-c0d4f4268fb1',
				'required'         => true,
				'force_activation' => true,
			),
			array(
				'name'             => 'Linna Demo Importer',
				'slug'             => 'linna-demo-importer',
				'source'           => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Flinna-wp%2Fplugins%2Flinna-demo-importer.zip?alt=media&token=27712341-0127-4131-a1f5-37386389591f',
				'required'         => false,
				'force_activation' => false,
			),
			array(
				'name'             => 'Envato Market',
				'slug'             => 'envato-market',
				'source'           => 'https://firebasestorage.googleapis.com/v0/b/mobius-266420.appspot.com/o/themes%2Flinna-wp%2Fplugins%2Fenvato-market.zip?alt=media&token=3e4b2a30-9653-49da-ae28-3a6e92bc566f',
				'required'         => false,
				'force_activation' => false,
			),
			array(
				'name'             => 'WooCommerce',
				'slug'             => 'woocommerce',
				'required'         => false,
				'force_activation' => false,
			),
		);

		$config = array(
			'id'           => 'linna',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );
	}
}

add_action( 'tgmpa_register', 'linna_register_required_plugins' );

if ( ! function_exists( 'linna_icos' ) ) {
	/**
	 * Icon sizes
	 */
	function linna_icos() {
		return array( '16x16' );
	}
}

if ( ! function_exists( 'linna_favicons' ) ) {
	/**
	 * Icon sizes
	 */
	function linna_favicons() {
		return array( '16x16', '32x32' );
	}
}

if ( ! function_exists( 'linna_apple_touch_icons' ) ) {
	/**
	 * Icon sizes
	 */
	function linna_apple_touch_icons() {
		return array( '180x180' );
	}
}

if ( ! function_exists( 'linna_chrome_icons' ) ) {
	/**
	 * Icon sizes
	 */
	function linna_chrome_icons() {
		return array( '192x192', '512x512' );
	}
}

if ( ! function_exists( 'linna_startup_screens' ) ) {
	/**
	 * Icon sizes
	 */
	function linna_startup_screens() {
		return array(
			array(
				'id'                 => 'iphone-x',
				'title'              => __( 'iPhone X (1125px x 2436px)', 'linna' ),
				'device-width'       => '375px',
				'device-height'      => '812px',
				'device-pixel-ratio' => '3',
			),
			array(
				'id'                 => 'iphone-8',
				'title'              => __( 'iPhone 8, 7, 6s, 6 (750px x 1334px)', 'linna' ),
				'device-width'       => '375px',
				'device-height'      => '667px',
				'device-pixel-ratio' => '2',
			),
			array(
				'id'                 => 'iphone-plus',
				'title'              => __( 'iPhone 8 Plus, 7 Plus, 6s Plus, 6 Plus (1242px x 2208px)', 'linna' ),
				'device-width'       => '414px',
				'device-height'      => '736px',
				'device-pixel-ratio' => '3',
			),
			array(
				'id'                 => 'iphone-5',
				'title'              => __( 'iPhone 5 (640px x 1136px)', 'linna' ),
				'device-width'       => '320px',
				'device-height'      => '568px',
				'device-pixel-ratio' => '2',
			),
			array(
				'id'                 => 'ipad-mini-air',
				'title'              => __( 'iPad Mini, Air (1536px x 2048px)', 'linna' ),
				'device-width'       => '768px',
				'device-height'      => '1024px',
				'device-pixel-ratio' => '2',
			),
			array(
				'id'                 => 'ipad-pro-10-5',
				'title'              => __( 'iPad Pro 10.5" (1668px x 2224px)', 'linna' ),
				'device-width'       => '834px',
				'device-height'      => '1112px',
				'device-pixel-ratio' => '2',
			),
			array(
				'id'                 => 'ipad-pro-12-9',
				'title'              => __( 'iPad Pro 12.9" (2048px x 2732px)', 'linna' ),
				'device-width'       => '1024px',
				'device-height'      => '1366px',
				'device-pixel-ratio' => '2',
			),

		);
	}
}

/**
 * Redux option panel
 */
require_once get_template_directory() . '/options/redux.php';

if ( ! function_exists( 'linna_option' ) ) {
	/**
	 * Get option.
	 *
	 * @param string|array $name Redux option id.
	 * @param bool|string  $default Optional default value, if option is not set.
	 *
	 * @return bool|mixed|void|null
	 */
	function linna_option( $name, $default = false ) {
		$options = get_option( 'linna-theme-options' );

		if ( is_array( $name ) ) {
			foreach ( $name as $item ) {
				if ( isset( $options[ $item ] ) ) {
					$options = $options[ $item ];
				} else {
					$options = null;
					break;
				}
			}
		} else {
			if ( isset( $options[ $name ] ) ) {
				$options = $options[ $name ];
			} else {
				$options = null;
			}
		}

		if ( is_null( $options ) && isset( $default ) ) {
			return $default;
		}

		return $options;
	}
}

if ( ! function_exists( '_linna_option' ) ) {
	/**
	 * Echo Option Getter
	 *
	 * @param string|array $name Redux option id.
	 * @param bool|string  $default Optional default value, if option is not set.
	 *
	 * @return bool|mixed|string|void
	 */
	function _linna_option( $name, $default = false ) {
		echo linna_option( $name, $default );
	}
}

if ( ! function_exists( '_linna_option_css_code' ) ) {
	/**
	 * Echo CSS Option
	 *
	 * @param string|array $name Redux option id.
	 * @param bool|string  $default Optional default value, if option is not set.
	 *
	 * @return void
	 */
	function _linna_option_css_code( $name, $default = '' ) {
		$code = linna_option( $name, $default );

		if ( ! empty( $code ) ) {
			?>
			<style type="text/css" id="site-custom-css-<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $code ); ?></style>
			<?php
		}
	}
}

if ( ! function_exists( 'linna_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function linna_widgets_init() {

		register_sidebar(
			array(
				'name'          => __( 'Before Menu', 'linna' ),
				'id'            => 'before-menu-widget-area',
				'description'   => __( 'Add widgets here to appear in above menu in sidebar.', 'linna' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'After Menu', 'linna' ),
				'id'            => 'after-menu-widget-area',
				'description'   => __( 'Add widgets here to appear in below menu in sidebar.', 'linna' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Blog Sidebar', 'linna' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Add widgets here to appear in sidebar..', 'linna' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

	}
}

add_action( 'widgets_init', 'linna_widgets_init' );

if ( ! function_exists( 'linna_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width Content width.
	 */
	function linna_content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'linna_content_width', 640 );
	}
}

add_action( 'after_setup_theme', 'linna_content_width', 0 );

if ( ! function_exists( 'linna_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function linna_scripts() {
		wp_enqueue_style( 'linna-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

		if ( linna_option( 'header-sticky' ) === 'site-position-sticky' ) {
			wp_enqueue_script(
				'stickyfill',
				get_theme_file_uri( '/libs/stickyfill/stickyfill.js' ),
				array(),
				'2.1.0',
				true
			);
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'linna-custom', get_theme_file_uri( '/js/custom.js' ), array(), '1.0.0', true );
	}
}

add_action( 'wp_enqueue_scripts', 'linna_scripts', 999 );

add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11 );

if ( ! function_exists( 'dequeue_woocommerce_cart_fragments' ) ) {
	/**
	 *  Dequeue WC scripts on front page and single post pages.
	 */
	function dequeue_woocommerce_cart_fragments() {
		if ( is_front_page() || is_single() ) {
			wp_dequeue_script( 'wc-cart-fragments' );
		}
	}
}

if ( ! function_exists( 'linna_get_kses_extended_ruleset' ) ) {
	/**
	 * Extend WP_KSES function to support SVG
	 *
	 * @return array
	 */
	function linna_get_kses_extended_ruleset() {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'      => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'        => array( 'fill' => true ),
			'title'    => array( 'title' => true ),
			'path'     => array(
				'id'        => true,
				'd'         => true,
				'fill'      => true,
				'clip-path' => true,
			),
			'defs'     => array(),
			'clippath' => array( 'id' => true ),
			'use'      => array(
				'overflow'   => true,
				'xlink:href' => true,
			),
			'video'    => array(
				'src'      => true,
				'autoplay' => true,
				'controls' => true,
				'loop'     => true,
				'muted'    => true,
				'poster'   => true,
				'preload'  => true,
				'width'    => true,
				'height'   => true,
			),
			'audio'    => array(
				'autoplay' => true,
				'controls' => true,
				'loop'     => true,
				'muted'    => true,
				'preload'  => true,
				'src'      => true,
			),
			'source'   => array(
				'src'    => true,
				'srcset' => true,
				'media'  => true,
				'sizes'  => true,
				'type'   => true,
			),
			'time'     => array(
				'datetime' => true,
				'class'    => true,
			),
			'iframe'   => array(
				'width'           => true,
				'height'          => true,
				'title'           => true,
				'frameborder'     => true,
				'allow'           => true,
				'allowfullscreen' => true,
				'src'             => true,
				'srcdoc'          => true,
				'sandbox'         => true,
				'name'            => true,
			),
			'input'    => array(
				'type'         => true,
				'class'        => true,
				'name'         => true,
				'id'           => true,
				'value'        => true,
				'placeholder'  => true,
				'width'        => true,
				'height'       => true,
				'required'     => true,
				'readonly'     => true,
				'min'          => true,
				'max'          => true,
				'multiple'     => true,
				'maxlength'    => true,
				'disabled'     => true,
				'autofocus'    => true,
				'autocomplete' => true,
				'alt'          => true,
				'data-name'    => true,
			),
		);

		return array_merge( $kses_defaults, $svg_args );
	}
}

if ( function_exists( 'fly_add_image_size' ) ) {
	fly_add_image_size( 'blog_carousel', 500, 584, true );
}

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-linna-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-linna-walker-comment.php';

/**
 * Create webapp related tags.
 */
require get_template_directory() . '/classes/class-linna-webapp.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';
