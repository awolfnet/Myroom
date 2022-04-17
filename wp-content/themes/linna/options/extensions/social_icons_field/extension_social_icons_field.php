<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ReduxFramework_extension_social_icons_field' ) ) {


	/**
	 * Main ReduxFramework Social_Icons_Field extension class
	 *
	 * @since       3.1.6
	 */
	class ReduxFramework_extension_social_icons_field {

		/**
		 * Version of the custom extension.
		 *
		 * @var string
		 */
		public static $version = '1.0.0';

		/**
		 * Extension name.
		 *
		 * @var string
		 */
		public $ext_name = 'Social Icons';

		/**
		 * Set the minimum required version of Redux here (optional).
		 * Leave blank to require no minimum version.
		 * This allows you to specify a minimum required version of Redux in the event
		 * you do not want to support older versions.
		 *
		 * @var string
		 */
		public $min_redux_version = '3.0.0';

		/**
		 * Contains args for extension
		 *
		 * @var array
		 */
		protected $parent;

		/**
		 * Full url of the extension.
		 *
		 * @var string|void
		 */
		public $extension_url;

		/**
		 * Full dir of the extension.
		 *
		 * @var string
		 */
		public $extension_dir;

		/**
		 * Current class instance.
		 *
		 * @var ReduxFramework_extension_social_icons_field
		 */
		public static $the_instance;

		/**
		 * Field name/id.
		 *
		 * @var string
		 */
		private $field_name;

		/**
		 * ReduxFramework_extension_social_icons_field constructor.
		 *
		 * @param array $parent Contains args for extension.
		 */
		public function __construct( $parent ) {

			$this->parent = $parent;

			if ( is_admin() && ! $this->is_minimum_version() ) {
				return;
			}

			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}

			$this->field_name = 'social_icons_field';

			self::$the_instance = $this;

			add_filter(
				'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name,
				array(
					&$this,
					'overload_field_path',
				)
			); // Adds the local field.

		}

		/**
		 * Class instance.
		 *
		 * @return ReduxFramework_extension_social_icons_field
		 */
		public function get_instance() {
			return self::$the_instance;
		}

		/**
		 * Forces the use of the embedded field path vs what the core typically would use.
		 *
		 * @return string
		 */
		public function overload_field_path() {
			return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
		}

		/**
		 * Check extensions minimum redux framework version requirement,
		 * compare with the installed redux framework version.
		 *
		 * @return bool
		 */
		private function is_minimum_version() {
			$redux_ver = ReduxFramework::$_version;

			if ( '' !== $this->min_redux_version ) {
				if ( version_compare( $redux_ver, $this->min_redux_version ) < 0 ) {
					$msg = '<strong>' . esc_html__( 'The', 'linna' ) . ' ' . $this->ext_name . ' ' . esc_html__( 'extension requires', 'linna' ) . ' Redux Framework ' . esc_html__( 'version', 'linna' ) . ' ' . $this->min_redux_version . ' ' . esc_html__( 'or higher.', 'linna' ) . '</strong>&nbsp;&nbsp;' . esc_html__( 'You are currently running', 'linna' ) . ' Redux Framework ' . esc_html__( 'version', 'linna' ) . ' ' . $redux_ver . '.<br/><br/>' . esc_html__( 'This field will not render in your option panel, and featuress of this extension will not be available until the latest version of', 'linna' ) . ' Redux Framework ' . esc_html__( 'has been installed.', 'linna' );

					$data = array(
						'parent'  => $this->parent,
						'type'    => 'error',
						'msg'     => $msg,
						'id'      => $this->ext_name . '_notice_' . self::$version,
						'dismiss' => false,
					);

					if ( method_exists( 'Redux_Admin_Notices', 'set_notice' ) ) {
						Redux_Admin_Notices::set_notice( $data );
					} else {
						echo '<div class="error">';
						echo '<p>';
						echo wp_kses(
							$msg,
							array(
								'strong' => array(),
								'br'     => array(),
							)
						);
						echo '</p>';
						echo '</div>';
					}

					return false;
				}
			}

			return true;
		}
	}
}
