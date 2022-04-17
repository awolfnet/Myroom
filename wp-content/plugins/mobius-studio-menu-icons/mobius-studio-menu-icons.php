<?php
/**
 * Plugin Name: Mobius Studio Menu Icons
 * Description: Adds svg icon support to your menus.
 * Plugin URL: https://plugins.mobius.studio/linna-wp/mobius-studio-menu-icons.zip
 * Version: 1.0.0
 * Author: Mobius Studio
 * Author URI: https://mobius.studio
 * Contributors: Mobius Studio
 * Text Domain: mobius-studio-menu-icons
 * Domain Path: languages
 *
 * @package Mobius Studio Menu Icons
 * @category Mobius Studio Menu Icons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class mobius_studio_menu_icons {

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 *
	 * @access      public
	 * @return      void
	 * @since       1.0
	 */
	public function __construct() {

		// Add custom menu fields to menu.
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'mobius_studio_menu_icons_add_custom_nav_fields' ) );

		// Save menu custom fields.
		add_action( 'wp_update_nav_menu_item', array( $this, 'mobius_studio_menu_icons_update_custom_nav_fields' ), 10, 3 );

		// Edit menu walker.
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'mobius_studio_menu_icons_edit_walker' ), 10, 2 );

		// Add Thickbox plugin.
		add_action( 'admin_enqueue_scripts', array( $this, 'mobius_studio_menu_icons_add_thickbox' ), 10, 0 );

		// Enqueue custom required css and javascripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'init_ajax_for_icon_list' ), 10, 1 );

		// Html content of plugin with special wp_ajax_ prefix.
		add_action( 'wp_ajax_svg_icon_list', array( $this, 'svg_icon_list' ), 10, 0 );

		// Load front-end functionalities.
		if ( ! is_admin() ) {
			require_once plugin_dir_path( __FILE__ ) . 'front.php';
			Mobius_Studio_Menu_Icons_Front_End::init();
		}

		do_action( 'menu_icons_loaded' );

	} // end constructor

	/**
	 * Enqueue custom required css and javascripts.
	 *
	 * @param       string $hook Current page.
	 * @access      public
	 * @return      void
	 * @since       1.0
	 */
	public function init_ajax_for_icon_list( $hook ) {
		if ( 'nav-menus.php' !== $hook ) {
			// Only applies to dashboard panel.
			return;
		}

		wp_enqueue_style( 'mobius-studio-menu-icons', plugin_dir_url( __FILE__ ) . 'menu-icons.css', array(), '1.0.0' );

		wp_enqueue_script( 'ajax-script', plugin_dir_url( __FILE__ ) . 'admin.js', array( 'jquery' ), '1.0.0', false );

		// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value.
		wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	/**
	 * Html content of plugin.
	 *
	 * @access      public
	 * @return      void
	 * @since       1.0
	 */
	public function svg_icon_list() {
		$chosen_icon = isset( $_POST['icon'] ) ? wp_unslash( $_POST['icon'] ) : '';

		$sprites = [
			'brands',
			'regular',
			'solid',
			'light',
		];

		?>

		<div class="icons-box-content">

			<div class="icons-box-head">
				<div class="icons-box-head-col">
					<label for="site-icon-search">
						<?php esc_html_e( 'Search for icon', 'mobius-studio-menu-icons' ); ?>
					</label>
					<input id="site-icon-search" class="site-icon-search" type="text" />
				</div>

				<div class="icons-box-head-col">
					<div class="chosen-icon">
						<?php if ( ! empty( $chosen_icon ) ) : ?>
							<div class="site-icon-col chosen" data-xlink="<?php echo esc_attr( $chosen_icon ); ?>">
								<button class="site-icon-btn" type="button"><?php echo wp_unslash( $chosen_icon ); ?></button>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="icons-box-head-col">
					<div class="pull-bottom">
						<button type="button" class="site-clear">
							❌ <?php esc_html_e( 'Clear', 'mobius-studio-menu-icons' ); ?>
						</button>
					</div>
				</div>

				<div class="icons-box-head-col">
					<div class="pull-bottom">
						<button type="button" class="site-confirm">
							✔ <?php esc_html_e( 'Done', 'mobius-studio-menu-icons' ); ?>
						</button>
					</div>
				</div>
			</div>

			<div class="icons-box-inner-content">
				<?php
				if ( ! empty( $chosen_icon ) ) {
					preg_match( '/data-title="([a-z\d\-]+)"/s', stripslashes( $chosen_icon ), $chosen_icon );

					if ( ! empty( $chosen_icon[1] ) ) {
						$chosen_icon = $chosen_icon[1];
					}
				}

				foreach ( $sprites as $sprite ) {
					$sprite_file = wp_safe_remote_get( plugin_dir_url( __FILE__ ) . 'svg/' . $sprite . '.svg' );
					if ( is_array( $sprite_file ) ) {
						preg_match_all( '/<symbol([\s\S]*?)<\/symbol>/s', $sprite_file['body'], $r );

						if ( isset( $r[0] ) && ! empty( $r[0] ) ) {
							foreach ( $r[0] as $item ) {

								$item = str_replace( 'symbol', 'svg', $item );
								$item = str_replace( '<svg', '<svg xmlns="http://www.w3.org/2000/svg"', $item );
								$item = str_replace( 'id="', 'data-title="' . $sprite . '-', $item );

								preg_match( '/data-title="([a-z\d\-]+)"/s', $item, $ree );

								?>
								<div class="site-icon-col <?php echo ( $chosen_icon === $ree[1] ? 'chosen' : '' ); ?>" data-xlink="<?php echo esc_attr( $item ); ?>">
									<button class="site-icon-btn" type="button">
										<?php echo $item; ?>
									</button>
								</div>
								<?php
							}
						}
					}
				}
				?>
			</div>
		</div>

		<?php
		wp_die();
	}

	/**
	 * Add Thickbox plugin.
	 *
	 * @access      public
	 * @return      void
	 * @since       1.0
	 */
	public function mobius_studio_menu_icons_add_thickbox() {
		add_thickbox();
	}

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @param       string $menu_item Menu item object.
	 * @access      public
	 * @return      object
	 * @since       1.0
	 */
	public function mobius_studio_menu_icons_add_custom_nav_fields( $menu_item ) {

		$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );

		return $menu_item;

	}

	/**
	 * Save menu custom fields.
	 *
	 * @access      public
	 *
	 * @param integer $menu_id          ID number of menu id.
	 * @param integer $menu_item_db_id  DB id of menu item.
	 * @param array   $args             Args.
	 *
	 * @return      void
	 * @since       1.0
	 */
	public function mobius_studio_menu_icons_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		// Check if element is properly sent.
		if ( isset( $_REQUEST['menu-item-icon'] ) && is_array( $_REQUEST['menu-item-icon'] ) ) {
			$icon_value = $_REQUEST['menu-item-icon'][ $menu_item_db_id ];
			update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
		}

	}

	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 *
	 * @param integer $walker   Walker instance.
	 * @param integer $menu_id  ID number of menu id.
	 *
	 * @return      string
	 * @since       1.0
	 */
	public function mobius_studio_menu_icons_edit_walker( $walker, $menu_id ) {

		return 'Walker_Nav_Menu_Edit_Custom';

	}

}

require_once 'edit_custom_walker.php';
require_once 'custom_walker.php';

// instantiate plugin's class.
$GLOBALS['mobius_studio_menu_icons'] = new mobius_studio_menu_icons();
