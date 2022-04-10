<?php
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since FlatMobile 1.0
 */
function flatmobile_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'flatmobile_javascript_detection', 0 );

if ( ! function_exists( 'flatmobile_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since FlatMobile 1.0
	 */
	function flatmobile_setup() {
		load_theme_textdomain( 'flatmobile', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'woocommerce' );

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
		 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_image_size( 'flatmobile-blog-thumb', 486, 283, true );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 825, 510, true );

		register_sidebar(array('id' => 'sidebar-1'));

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'flatmobile' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
				'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
				'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		) );
	}
endif; // flatmobile_setup
add_action( 'after_setup_theme', 'flatmobile_setup' );


/**
 * Enqueue scripts and styles.
 *
 * @since FlatMobile 1.0
 */
function flatmobile_scripts() {
	/**
	 * Register and Enqueue Styles
	 */
	wp_enqueue_style( 'flatmobile-essentials', get_template_directory_uri() . '/css/essentials.css', false, '' );
	wp_enqueue_style( 'flatmobile-my-app', get_template_directory_uri() . '/css/my-app.css', false, '' );
	wp_enqueue_style( 'flatmobile-style', get_stylesheet_uri(), array(), uniqid() );


	/**
	 * Register and Enqueue Scripts
	 */
	wp_register_script( 'jflickrfeed', get_template_directory_uri() . '/js/lib/jflickrfeed.js', false, '', true );
	wp_register_script( 'swipebox', get_template_directory_uri() . '/js/lib/swipebox.js', false, '', true );
	wp_register_script( 'owlcarousel', get_template_directory_uri() . '/js/lib/owlcarousel.js', false, '', true );
	wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/js/lib/fastclick.js', false, '', true );
	wp_enqueue_script( 'isInViewport', get_template_directory_uri() . '/js/lib/isInViewport.js', false, '', true );
	wp_enqueue_script( 'legitRipple', get_template_directory_uri() . '/js/lib/ripple.js', false, '1.1.0', true );
	wp_enqueue_script( 'flatmobile-main', get_template_directory_uri() . '/js/app/main.js', array('jquery','fastclick'), '', true );
}
add_action( 'wp_enqueue_scripts', 'flatmobile_scripts' );

require get_template_directory() . '/mstudio/mobius-studio.php';



/**
 * Custom CSS and JS
 *
 *
 * @since flatmobile 1.1
 */
function flatmobile_custom_css() {
	if( '' != get_theme_mod('flatmobile_custom_code_css') ):
		echo '<style>';
		echo esc_html( get_theme_mod('flatmobile_custom_code_css') );
		echo '</style>';
	endif;
}
add_action( 'wp_head', 'flatmobile_custom_css');

function flatmobile_custom_js() {
	echo '<script type="text/javascript" id="ms-custom-js">';
	if( '' != get_theme_mod('flatmobile_custom_code_js') ):
		echo get_theme_mod('flatmobile_custom_code_js');
	endif;
	echo '</script>';
}
add_action( 'wp_footer', 'flatmobile_custom_js');
