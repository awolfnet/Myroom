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
 * @author      Dovy Paukstys
 * @version     3.1.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_social_icons_field' ) ) {

	/**
	 * Main ReduxFramework_social_icons_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_social_icons_field {

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
		 * Value of the field.
		 *
		 * @var array
		 */
		private $value;

		/**
		 * Field parameters.
		 *
		 * @var array
		 */
		private $field;

		/**
		 * ReduxFramework_social_icons_field constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function.
		 *
		 * @param array $field Field parameters.
		 * @param array $value Value of the field.
		 * @param array $parent Contains args for extension.
		 */
		public function __construct( $field = array(), $value = array(), $parent = array() ) {

			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;

			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}

			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults    = array(
				'options'          => array(),
				'stylesheet'       => '',
				'output'           => true,
				'enqueue'          => true,
				'enqueue_frontend' => true,
			);
			$this->field = wp_parse_args( $this->field, $defaults );

		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function render() {

			$this->field['mode'] = 'text';

			$options = $this->field['options'];

			$no_sort = false;
			foreach ( $options as $k => $v ) {
				if ( ! isset( $this->value[ $k ] ) ) {

					// A save has previously been done.
					if ( is_array( $this->value ) && array_key_exists( $k, $this->value ) ) {
						$this->value[ $k ] = $v;

						// Missing database entry, meaning no save has yet been done.
					} else {
						$no_sort           = true;
						$this->value[ $k ] = '';
					}
				}
			}

			/**
			 * If missing database entries are found, it means no save has been done,
			 * and therefore no sort should be done.  Set the default array in the same,
			 * order as the options array.  Why?  The sort order is based on the,
			 * saved default array.  If entries are missing, the sort is messed up.
			 */
			if ( true === $no_sort ) {
				$dummy_arr = array();

				foreach ( $options as $k => $v ) {
					$dummy_arr[ $k ] = $this->value[ $k ];
				}
				unset( $this->value );
				$this->value = $dummy_arr;
				unset( $dummy_arr );
			}

			echo wp_kses(
				'<ul id="' . $this->field['id'] . '-list" class="socials-sortable">',
				array(
					'ul' => array(
						'id'    => true,
						'class' => true,
					),
				)
			);

			$default_li = '
			<li class="site-drag-item" data-count="%4$s">
			    <span class="compact drag"><i class="el el-move icon-large"></i></span>
                <div>
                    <a href="#" data-show-icons data-target="' . $this->field['name'] . '[%1$s][icon]" data-chosen="%3$s" class="el el-search icon-large"></a>
                    
                    <span class="site-menu-chosen-icon" data-editby="' . $this->field['name'] . '[%1$s][icon]">%2$s</span>
                    
                    <button type="button" data-remove-item class="el el-remove-sign icon-large"></button>
                    <input type="hidden" class="value-svg" name="' . $this->field['name'] . $this->field['name_suffix'] . '[%1$s][icon]" id="' . $this->field['name'] . '[%1$s][icon]" value="%3$s" />
                    
                    <div class="inputs">
	                    <div class="text-input-wrap">
	                        <span>Link Address</span>
	                        <input type="text" class="regular-text value-href" name="' . $this->field['name'] . $this->field['name_suffix'] . '[%1$s][href]" id="' . $this->field['name'] . '[%1$s][href]" value="%5$s" placeholder="' . __( 'Link Address', 'linna' ) . '">
	                    </div>
	                    
	                    <div class="text-input-wrap">
	                        <span>Background Color</span>
	                        <input type="text" class="regular-text %8$s value-backgroundcolor" name="' . $this->field['name'] . $this->field['name_suffix'] . '[%1$s][backgroundcolor]" id="' . $this->field['name'] . '[%1$s][backgroundcolor]" value="%6$s" placeholder="' . __( 'Background Color', 'linna' ) . '">
	                    </div>
	                    
	                    <div class="text-input-wrap">
	                        <span>Color</span>
	                        <input type="text" class="regular-text %8$s value-color" name="' . $this->field['name'] . $this->field['name_suffix'] . '[%1$s][color]" id="' . $this->field['name'] . '[%1$s][color]" value="%7$s" placeholder="' . __( 'Color', 'linna' ) . '">
	                    </div>
					</div>
                </div>
			</li>';

			foreach ( $this->value as $k => $data ) {
				$icon_value = isset( $data['icon'] ) ? $data['icon'] : '';
				$href_value = isset( $data['href'] ) ? $data['href'] : '';
				$backgroundcolor_value = isset( $data['backgroundcolor'] ) ? $data['backgroundcolor'] : '';
				$color_value = isset( $data['color'] ) ? $data['color'] : '';

				$n = str_replace( '%1$s', $k, $default_li );
				$n = str_replace( '%2$s', $icon_value, $n ); // svg value.
				$n = str_replace( '%3$s', esc_attr( $icon_value ), $n ); // svg value.
				$n = str_replace( '%4$s', $k, $n );

				$n = str_replace( '%5$s', esc_url( $href_value ), $n ); // href value.
				$n = str_replace( '%6$s', esc_attr($backgroundcolor_value), $n ); // href value.
				$n = str_replace( '%7$s', esc_attr($color_value), $n ); // href value.

				$n = str_replace( '%8$s', 'color_field', $n ); // href value.

				echo wp_kses( $n, linna_get_kses_extended_ruleset() );
			}
			echo '</ul>';

			echo '<button type="button" class="sortable-add-new-item">Add New Item</button>';

			echo wp_kses( '<div class="hidden-default-li hidden">' . str_replace( 'name="', 'data-name="', $default_li ) . '</div>', linna_get_kses_extended_ruleset() );
		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function enqueue() {

			add_action( 'admin_enqueue_scripts', array( $this, 'mobius_menu_icons_add_thickbox' ), 10, 0 );

			wp_enqueue_script(
				'redux-field-social-icons-field-js',
				$this->extension_url . 'field_social_icons_field.js',
				array( 'jquery', 'redux-js', 'jquery-ui-sortable' ),
				time(),
				true
			);

			wp_enqueue_style(
				'redux-field-social-icons-field-css',
				$this->extension_url . 'field_social_icons_field.css',
				time(),
				true
			);

			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker');

			wp_localize_script( 'redux-field-social-icons-field-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		}

		/**
		 * Adds thick box within a function, direct enqueue throws warnings.
		 */
		public function mobius_menu_icons_add_thickbox() {
			add_thickbox();
		}

	}
}
