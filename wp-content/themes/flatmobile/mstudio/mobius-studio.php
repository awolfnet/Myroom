<?php
if (!defined('ABSPATH')) die('-1');

require get_template_directory() . '/mstudio/tgm/tgm-init.php';

require get_template_directory() . '/mstudio/meta-boxes.php';

require get_template_directory() . '/mstudio/customizer.php';


/**
 * mstudio Class
 *
 * Contains Theme Essential Functions
 */
class flatmobile{

	function __construct() {
		add_action('widgets_init', array($this, "flatmobile_widgets_init"), 0);
	}

	function flatmobile_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__('[FlatMobile] Blog Sidebar', 'flatmobile'),
				'id'            => 'flatmobile-blog-sidebar',
				'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'flatmobile'),
				'before_widget' => '<aside id="%1$s" class="tc-blog-sidebar-box widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('[FlatMobile] Before Menu', 'flatmobile'),
				'id'            => 'flatmobile-before-menu',
				'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'flatmobile'),
				'before_widget' => '<aside id="%1$s" class="tc-blog-sidebar-box widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('[FlatMobile] After Menu', 'flatmobile'),
				'id'            => 'flatmobile-after-menu',
				'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'flatmobile'),
				'before_widget' => '<aside id="%1$s" class="tc-blog-sidebar-box widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('[FlatMobile] Right Panel', 'flatmobile'),
				'id'            => 'flatmobile-right-panel',
				'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'flatmobile'),
				'before_widget' => '<aside id="%1$s" class="tc-blog-sidebar-box widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}

	public static function option($config_id, $setting_id, $default = ''){
		$config = get_option($config_id);
		$setting = '';
		if( isset( $config[$setting_id] ) ){
			$setting = $config[$setting_id];
		}else{
			$setting = $default;
		}

		return $setting;
	}

	public static function meta( $id, $arg = '' ){
		$meta = '';
		if( function_exists( 'rwmb_meta' ) ):
			if( '' != $arg ){
				$meta = rwmb_meta( $id, $arg );
			}else{
				$meta = rwmb_meta( $id );
			}
		endif;
		return $meta;
	}

	/**
	 * Teplate Tags
	 *
	 * @function postThumbnail
	 * @function getPostFormat
	 * @function getPostDate
	 * @function getPostAuthor
	 * @function getPostCategories
	 * @function getPostTags
	 * @function getPostAttachmentLink
	 * @function getPostLeaveCommentLink
	 */
	public static function postThumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		$type = self::meta( 'flatmobile_type' );
		if( ( empty($type) || 'none' == $type ) && has_post_thumbnail() ){

			if( is_singular() ){
				wp_enqueue_script('swipebox');
				$attachment_images = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
				$attachment_image = $attachment_images[0];

				echo '<a class="post-thumbnail preview swipebox" href="'.$attachment_image.'" aria-hidden="true">';
				the_post_thumbnail( 'flatmobile-blog-thumb', array( 'alt' => get_the_title() ) );
				echo '</a>';
			}else{
				echo '<a class="post-thumbnail preview" href="'.get_the_permalink().'" aria-hidden="true">';
				the_post_thumbnail( 'flatmobile-blog-thumb', array( 'alt' => get_the_title() ) );
				echo '</a>';
			}

		}else if( 'oembed' == $type ){

			global $wp_embed;
			$embed_shortcode = self::meta( 'flatmobile_oembed' );
			echo '<div class="embed-responsive preview">'.$embed_shortcode.'</div>';

		}else if( 'images' == $type ){
			wp_enqueue_script('owlcarousel');

			$images = self::meta( 'flatmobile_slider_images', 'type=plupload_image' );
			$post_gallery_unique_id = uniqid('post-');

			echo '<div class="tc-slider preview">';

			foreach( $images as $image ){
				if( is_singular() ){
					wp_enqueue_script('swipebox');

					$thumbed = flatmobile::nova_resize_thumbnail($image["full_url"],array("width" => 486, "height" => 283));
					if( !empty($thumbed) ){
						echo '<a href="'.$image["full_url"].'" class="item swipebox" rel="'.$post_gallery_unique_id.'"><img src="'.$thumbed["url"].'" alt="'.get_the_title().'" /></a>';
					}
				}else{
					$thumbed = flatmobile::nova_resize_thumbnail($image["full_url"],array("width" => 486, "height" => 283));
					if( !empty($thumbed) ){
						echo '<a href="'.get_the_permalink().'" class="item"><img src="'.$thumbed["url"].'" alt="'.get_the_title().'" /></a>';
					}
				}

			}
			echo '</div>';

		}
	}

	public static function getPostFormat(){
		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
					sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'flatmobile' ) ),
					esc_url( get_post_format_link( $format ) ),
					get_post_format_string( $format )
			);
		}
	}

	public static function getPostDate(){
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			}

			$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
			);

			printf( '<span class="posted-on"><span class="">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
					_x( 'on', 'Used before publish date.', 'flatmobile' ),
					esc_url( get_permalink() ),
					$time_string
			);
		}
	}

	public static function getPostAuthor(){
		if ( 'post' == get_post_type() ) {
			printf( '<span class="byline"><span class="author vcard"><span class="">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
					_x( 'by', 'Used before post author name.', 'flatmobile' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
			);
		}
	}

	public static function getPostCategories(){
		$categories_list = '';
		if ( 'post' == get_post_type() || 'testimonials' == get_post_type() || 'portfolio' == get_post_type() ) {
			if( 'post' == get_post_type() ):
				$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'flatmobile' ) );
			endif;

			if( 'post' != get_post_type() ):
				$categories_list = get_the_term_list(get_the_ID(), get_post_type().'_categories');
				$categories_list = str_replace('a><a','a>, <a',$categories_list);
			endif;

			if ( !empty($categories_list) ) {
				printf( '<span class="cat-links"><span class="">%1$s </span>%2$s</span>',
						_x( 'in', 'Used before category names.', 'flatmobile' ),
						$categories_list
				);
			}
		}
	}

	public static function getPostTags(){
		if ( 'post' == get_post_type() ) {
			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'flatmobile' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links"><span class="">%1$s </span>%2$s</span>',
						_x( 'Tags', 'Used before tag names.', 'flatmobile' ),
						$tags_list
				);
			}
		}
	}

	public static function getPostAttachmentLink(){
		if ( is_attachment() && wp_attachment_is_image() ) {
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();

			printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
					_x( 'Full size', 'Used before full size attachment link.', 'flatmobile' ),
					esc_url( wp_get_attachment_url() ),
					$metadata['width'],
					$metadata['height']
			);
		}
	}

	public static function getPostLeaveCommentLink(){
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			global $allowedtags;
			comments_popup_link( sprintf( wp_kses( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'flatmobile' ), $allowedtags), get_the_title() ) );
			echo '</span>';
		}
	}

	private function flatmobile_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'flatmobile_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
					'fields'     => 'ids',
					'hide_empty' => 1,

				// We only need to know if there is more than one category.
					'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'flatmobile_categories', $all_the_cool_cats );
		}

		//if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so flatmobile_categorized_blog should return true.
		return true;
		/*} else {
			// This blog has only 1 category so flatmobile_categorized_blog should return false.
			return false;
		}*/
	}

	public static function nova_resize_thumbnail( $attach_id, $size = '', $retina = false ) {

		if ( ! $attach_id ) {
			return;
		}

		// Check retina support
		$retina_support = false;

		// Check if image size is custom or defined
		$is_intermediate = false;

		// Size is an array
		$int_size = isset( $size['size'] ) ? $size['size'] : '';
		$width    = isset( $size['width'] ) ? $size['width'] : '';
		$height   = isset( $size['height'] ) ? $size['height'] : '';
		$crop     = isset( $size['crop'] ) ? $size['crop'] : 'center-center';

		// Check if size is intermediate or not
		if ( $int_size ) {
			$is_intermediate = true;
		}

		// Sanitize dimensions
		$width  = intval( $width );
		$height = intval( $height );
		$crop   = is_array( $crop ) ? implode( '-', $crop ) : $crop;

		if ( !is_numeric( $attach_id ) ){
			$attach_id = attachment_url_to_postid($attach_id);
		}

		// Get attachment data
		$src  = wp_get_attachment_image_src( $attach_id, 'full' );
		$path = get_attached_file( $attach_id );

		if ( empty( $path ) ) {
			return;
		}

		// Get attachment details
		$info         = pathinfo( $path );
		$extension    = '.' . $info['extension'];
		$path_no_ext  = $info['dirname'] . '/' . $info['filename'];

		// Array of valid crop locations
		$crop_locations = array(
			'left-top',
			'right-top',
			'center-top',
			'left-center',
			'right-center',
			'center-center',
			'left-bottom',
			'right-bottom',
			'center-bottom',
		);

		// Define crop suffix if custom crop is set and valid
		$crop_suffix = ( is_string( $crop ) && array_key_exists( $crop, $crop_locations ) ) ? $crop : '';

		// Turn crop value into array
		$crop_array = $crop_suffix ? explode( '-', $crop ) : $crop;

		// Calculate output dimensions after resize
		$cropped_dims = image_resize_dimensions( $src[1], $src[2], $width, $height, $crop_array );

		// Target image size dims
		$dst_w = isset( $cropped_dims[4] ) ? $cropped_dims[4] : '';
		$dst_h = isset( $cropped_dims[5] ) ? $cropped_dims[5] : '';

		// Suffix width and height values
		$s_width  = $width ? $width : $dst_w;
		$s_height = $height ? $height : $dst_h;

		// Define suffix
		if ( $retina ) {
			$suffix = $s_width / 2 . 'x' . $s_height / 2;
		} else {
			$suffix = $s_width . 'x' . $s_height;
		}
		$suffix = $crop_suffix ? $suffix . '-' . $crop_suffix : $suffix;
		$suffix = $retina ? $suffix . '@2x' : $suffix;

		// Define custom intermediate_size based on suffix
		$int_size = $int_size ? $int_size : 'nova_' . $suffix;

		// If current image size is smaller or equal to target size return full image
		if ( empty( $cropped_dims )
			|| $dst_w > $src[1]
			|| $dst_h > $src[2]
			|| ( $dst_w == $src[1] && $dst_h == $src[2] )
		) {

			if ( $retina ) return; // don't return original for retina images

			return array(
				'url'    => $src[0],
				'width'  => $src[1],
				'height' => $src[2],
			);

		}

		// Retina can't be cropped to exactly 2x
		if ( $retina && ( $dst_w !== $width || $dst_h !== $height ) ) {
			return;
		}

		// Get cropped path
		$cropped_path = $path_no_ext . '-' . $suffix . $extension;

		// Return chached image
		// And try and generate retina if not created already
		if ( file_exists( $cropped_path ) ) {

			$new_path = str_replace( basename( $src[0] ), basename( $cropped_path ), $src[0] );

			if ( ! $retina && $retina_support ) {
				$retina_dims = array(
					'width'  => $dst_w*2,
					'height' => $dst_h*2,
					'crop'   => $crop
				);
				$retina_src = self::nova_resize_thumbnail( $attach_id, $retina_dims, true );
			}

			return array(
				'url'    => $new_path,
				'width'  => $dst_w,
				'height' => $dst_h,
				'retina' => ! empty( $retina_src['url'] ) ? $retina_src['url'] : '',
			);

		}

		// Crop image
		$editor = wp_get_image_editor( $path );

		if ( ! is_wp_error( $editor ) && ! is_wp_error( $editor->resize( $width, $height, $crop_array ) ) ) {

			// Get resized file
			$new_path = $editor->generate_filename( $suffix );
			$editor   = $editor->save( $new_path );

			// Set new image url from resized image
			if ( ! is_wp_error( $editor ) ) {

				// Cropped image
				$cropped_img = str_replace( basename( $src[0] ), basename( $new_path ), $src[0] );

				// Generate retina version
				if ( ! $retina && $retina_support ) {
					$retina_dims = array(
						'width'  => $dst_w*2,
						'height' => $dst_h*2,
						'crop'   => $crop
					);
					$retina_src = self::nova_resize_thumbnail( $attach_id, $retina_dims, true );
				}

				// Get thumbnail meta
				$meta = wp_get_attachment_metadata( $attach_id );

				// Update meta
				if ( is_array( $meta ) ) {

					$meta['sizes'] = isset( $meta['sizes'] ) ? $meta['sizes'] : array();

					if ( ! array_key_exists( $int_size, $meta['sizes'] )
						|| ( $dst_w != $meta['sizes'][$int_size]['width'] || $dst_h != $meta['sizes'][$int_size]['height'] )
					) {

						// Check correct mime type
						$mime_type = wp_check_filetype( $cropped_img );
						$mime_type = isset( $mime_type['type'] ) ? $mime_type['type'] : '';

						// Cropped image file name
						$dst_filename = $info['filename'] . '-' . $suffix . $extension;

						// Add cropped image to image meta
						$meta['sizes'][$int_size] = array(
							'file'      => $dst_filename,
							'width'     => $dst_w,
							'height'    => $dst_h,
							'mime-type' => $mime_type,
							'nova-wp'   => true,
						);

						// Update meta
						update_post_meta( $attach_id, '_wp_attachment_metadata', $meta );

					}

				}

				// Return cropped image
				return array(
					'url'               => $cropped_img,
					'width'             => $dst_w,
					'height'            => $dst_h,
					'retina'            => ! empty( $retina_src['url'] ) ? $retina_src['url'] : '',
					'intermediate_size' => $int_size,
				);

			}

		}

		// Couldn't dynamically create image so return original
		else {

			return array(
				'url'    => $src[0],
				'width'  => $src[1],
				'height' => $src[2],
			);

		}

	}
}

new flatmobile();

/**
 * Load CF7 When Necessary
 *
 */
add_action( 'wp', 'cf7unloaded_deregister_contact_form');
if( ! function_exists('cf7unloaded_deregister_contact_form') ):
	function cf7unloaded_deregister_contact_form() {
		global $post;
		if ( is_object($post) && ! has_shortcode( $post->post_content, 'contact-form-7' ) ) {
			remove_action('wp_enqueue_scripts', 'wpcf7_do_enqueue_scripts');
		}
	}
endif;

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
/*add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
	//remove generator meta tag
	//remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}
}*/


add_action('wp_head', 'flatmobile_head_tags', 0);
function flatmobile_head_tags(){
	if( 'on' == flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_capable', 'on') ): ?>
		<meta name="apple-mobile-web-app-capable" content="yes">

		<meta name="apple-mobile-web-app-status-bar-style"
		      content="<?php echo esc_attr( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_status_bar', 'black') ) ?>">

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_retina_portrait') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_retina_portrait') ) ?>"
			      media="(device-width: 768px) and (device-height: 1024px)
		                 and (-webkit-device-pixel-ratio: 2)
		                 and (orientation: portrait)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_retina_landscape') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_retina_landscape') ) ?>"
			      media="(device-width: 768px) and (device-height: 1024px)
		                 and (-webkit-device-pixel-ratio: 2)
		                 and (orientation: landscape)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_portrait') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_portrait') ) ?>"
			      media="(device-width: 768px) and (device-height: 1024px)
		                 and (-webkit-device-pixel-ratio: 1)
		                 and (orientation: portrait)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_landscape') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_ipad_landscape') ) ?>"
			      media="(device-width: 768px) and (device-height: 1024px)
		                 and (-webkit-device-pixel-ratio: 1)
		                 and (orientation: landscape)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_plus_portrait') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_plus_portrait') ) ?>"
			      media="(device-width: 414px) and (device-height: 736px)
		                 and (-webkit-device-pixel-ratio: 3)
		                 and (orientation: portrait)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_plus_landscape') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_plus_landscape') ) ?>"
			      media="(device-width: 414px) and (device-height: 736px)
		                 and (-webkit-device-pixel-ratio: 3)
		                 and (orientation: landscape)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_portrait') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_portrait') ) ?>"
			      media="(device-width: 375px) and (device-height: 667px)
		                 and (-webkit-device-pixel-ratio: 2)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_landscape') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_6_landscape') ) ?>"
			      media="(device-width: 320px) and (device-height: 568px)
		                 and (-webkit-device-pixel-ratio: 2)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_retina_5_and_lower') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_retina_5_and_lower') ) ?>"
			      media="(device-width: 320px) and (device-height: 480px)
		                 and (-webkit-device-pixel-ratio: 2)"
			      rel="apple-touch-startup-image">
		<?php endif; ?>

		<?php if( '' != flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_5_and_lower') ): ?>
			<link href="<?php echo esc_url( flatmobile::option('flatmobile_web_app', 'flatmobile_web_app_iphone_5_and_lower') ) ?>"
			      media="(device-width: 320px) and (device-height: 480px)
		                 and (-webkit-device-pixel-ratio: 1)"
			      rel="apple-touch-startup-image">
		<?php endif;
	endif; ?>

	<?php
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if ( '' != flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_16_16' ) ) {
			?>
			<link rel="icon" type="image/png" href="<?php echo esc_url( flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_16_16' ) ) ?>"
			      sizes="16x16"><?php }
		if ( '' != flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_32_32' ) ) {
			?>
			<link rel="icon" type="image/png" href="<?php echo esc_url( flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_32_32' ) ) ?>"
			      sizes="16x16"><?php }
		if ( '' != flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_96_96' ) ) {
			?>
			<link rel="icon" type="image/png" href="<?php echo esc_url( flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_96_96' ) ) ?>"
			      sizes="16x16"><?php }
		if ( '' != flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_192_192' ) ) {
			?>
			<link rel="icon" type="image/png" href="<?php echo esc_url( flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_192_192' ) ) ?>"
			      sizes="16x16"><?php }
		if ( '' != flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_194_194' ) ) {
			?>
			<link rel="icon" type="image/png" href="<?php echo esc_url( flatmobile::option( 'flatmobile_favicons', 'flatmobile_favicons_194_194' ) ) ?>"
			      sizes="16x16"><?php }

		$apple_touch_icons            = array();
		$apple_touch_icons['57x57']   = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_57x57' );
		$apple_touch_icons['60x60']   = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_60x60' );
		$apple_touch_icons['72x72']   = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_72x72' );
		$apple_touch_icons['76x76']   = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_76x76' );
		$apple_touch_icons['114x114'] = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_114x114' );
		$apple_touch_icons['120x120'] = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_120x120' );
		$apple_touch_icons['144x144'] = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_144x144' );
		$apple_touch_icons['152x152'] = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_152x152' );
		$apple_touch_icons['180x180'] = flatmobile::option( 'flatmobile_favicons', 'flatmobile_apple_touch_180x180' );

		foreach ( $apple_touch_icons as $k => $apple_touch_icon ):
			if ( ! empty( $apple_touch_icon ) ):
				?>
				<link rel="apple-touch-icon" sizes="<?php echo esc_attr( $k ); ?>" href="<?php echo esc_url( $apple_touch_icon ); ?>"><?php
			endif;
		endforeach;
	}

}
