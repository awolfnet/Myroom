<?php
/**
 * Timeline Item Widget.
 *
 * @package Mobius Studio Elementor
 * @category Mobius Studio Elementor
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Timeline Item Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Timeline_Item_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Timeline Item widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'timeline_item';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Timeline Item widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Timeline Item', 'mobius-studio-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Timeline Item widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-time-line';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Timeline Item widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'mobius-studio' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'time', 'line', 'timeline', 'time-line', 'mobius studio' ];
	}

	/**
	 * Return the general text nodes in widget.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Sizes.
	 */
	private function get_sizes() {
		return array(
			'title'       => array(
				'text'     => __( 'Title', 'mobius-studio-elementor' ),
				'defaults' => array(
					'header_size' => 'h4',
					'title_color' => '#414141',
				),
			),
			'description' => array(
				'text'     => __( 'Description', 'mobius-studio-elementor' ),
				'defaults' => array(
					'header_size' => 'p',
					'title_color' => '#818181',
				),
			),
		);
	}

	/**
	 * Register Timeline Item widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'mobius-studio-elementor' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'mobius-studio-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'small',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => __( 'Link', 'mobius-studio-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'mobius-studio-elementor' ),
					'file'   => __( 'Media File', 'mobius-studio-elementor' ),
					'custom' => __( 'Custom URL', 'mobius-studio-elementor' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'mobius-studio-elementor' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'mobius-studio-elementor' ),
				'condition'   => [
					'link_to' => 'custom',
				],
				'show_label'  => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label'     => __( 'Lightbox', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => __( 'Default', 'mobius-studio-elementor' ),
					'yes'     => __( 'Yes', 'mobius-studio-elementor' ),
					'no'      => __( 'No', 'mobius-studio-elementor' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'mobius-studio-elementor' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'mobius-studio-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'          => __( 'Width', 'mobius-studio-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
					'size' => 40,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'size_units'     => [ '%', 'px', 'vw' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} img'         => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .image-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label'          => __( 'Max Width', 'mobius-studio-elementor' ) . ' (%)',
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%' ],
				'range'          => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .elementor-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			[
				'label' => __( 'Normal', 'mobius-studio-elementor' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label'     => __( 'Opacity', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => __( 'Hover', 'mobius-studio-elementor' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label'     => __( 'Opacity', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .elementor-image:hover img',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label'     => __( 'Transition Duration', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'mobius-studio-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .elementor-image img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'mobius-studio-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_section();

		$sizes = $this->get_sizes();

		foreach ( $sizes as $suffix => $size ) {
			$this->start_controls_section(
				'content_section' . $suffix,
				[
					'label' => $size['text'],
					'tab'   => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'title_' . $suffix,
				[
					'label'       => __( 'Title', 'mobius-studio-elementor' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your title', 'mobius-studio-elementor' ),
					'default'     => __( 'Add Your', 'mobius-studio-elementor' ) . " {$size['text']} " . __( 'Text Here', 'mobius-studio-elementor' ),
				]
			);

			$this->add_control(
				'link_' . $suffix,
				[
					'label'     => __( 'Link', 'mobius-studio-elementor' ),
					'type'      => Controls_Manager::URL,
					'dynamic'   => [
						'active' => true,
					],
					'default'   => [
						'url' => '',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'size_' . $suffix,
				[
					'label'   => __( 'Size', 'mobius-studio-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' => __( 'Default', 'mobius-studio-elementor' ),
						'small'   => __( 'Small', 'mobius-studio-elementor' ),
						'medium'  => __( 'Medium', 'mobius-studio-elementor' ),
						'large'   => __( 'Large', 'mobius-studio-elementor' ),
						'xl'      => __( 'XL', 'mobius-studio-elementor' ),
						'xxl'     => __( 'XXL', 'mobius-studio-elementor' ),
					],
				]
			);

			$this->add_control(
				'header_size_' . $suffix,
				[
					'label'   => __( 'HTML Tag', 'mobius-studio-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'h1'   => 'H1',
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h4'   => 'H4',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'div'  => 'div',
						'span' => 'span',
						'p'    => 'p',
					],
					'default' => $size['defaults']['header_size'],
				]
			);

			$this->add_responsive_control(
				'align_' . $suffix,
				[
					'label'     => __( 'Alignment', 'mobius-studio-elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [
							'title' => __( 'Left', 'mobius-studio-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'mobius-studio-elementor' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'mobius-studio-elementor' ),
							'icon'  => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'mobius-studio-elementor' ),
							'icon'  => 'eicon-text-align-justify',
						],
					],
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'view_' . $suffix,
				[
					'label'   => __( 'View', 'mobius-studio-elementor' ),
					'type'    => Controls_Manager::HIDDEN,
					'default' => 'traditional',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_title_style_' . $suffix,
				[
					'label' => $size['text'],
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'title_color_' . $suffix,
				[
					'label'     => __( 'Text Color', 'mobius-studio-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => [
						'type'  => Color::get_type(),
						'value' => Color::COLOR_1,
					],
					'default'   => $size['defaults']['title_color'],
					'selectors' => [
						// Stronger selector to avoid section style from overwriting.
						'{{WRAPPER}} .mobius-elementor-timeline-' . $suffix => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'typography_' . $suffix,
					'scheme'   => Typography::TYPOGRAPHY_3,
					'selector' => '{{WRAPPER}} .mobius-elementor-timeline-' . $suffix,
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'text_shadow_' . $suffix,
					'selector' => '{{WRAPPER}} .mobius-elementor-timeline-' . $suffix,
				]
			);

			$this->add_control(
				'blend_mode_' . $suffix,
				[
					'label'     => __( 'Blend Mode', 'mobius-studio-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						''            => __( 'Normal', 'mobius-studio-elementor' ),
						'multiply'    => 'Multiply',
						'screen'      => 'Screen',
						'overlay'     => 'Overlay',
						'darken'      => 'Darken',
						'lighten'     => 'Lighten',
						'color-dodge' => 'Color Dodge',
						'saturation'  => 'Saturation',
						'color'       => 'Color',
						'difference'  => 'Difference',
						'exclusion'   => 'Exclusion',
						'hue'         => 'Hue',
						'luminosity'  => 'Luminosity',
					],
					'selectors' => [
						'{{WRAPPER}} .mobius-elementor-timeline-' . $suffix => 'mix-blend-mode: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_section();

		}
	}

	/**
	 * Render Timeline Item widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$sizes = $this->get_sizes();

		$image_link = $this->get_link_url( $settings );

		$this->add_render_attribute( 'link', 'class', 'elementor-image image-wrap' );

		if ( $image_link ) {
			$this->add_render_attribute( 'link', 'data-elementor-open-lightbox', $settings['open_lightbox'] );

			$this->add_link_attributes( 'link', $image_link );

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute(
					'link',
					[
						'class' => 'elementor-clickable',
					]
				);
			}
		}

		$title_html = '';

		$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings );

		if ( ! empty( $image_html ) ) {
			if ( $image_link ) :
				$title_html .= "<a {$this->get_render_attribute_string( 'link' )}>";
			else :
				$title_html .= "<div class='elementor-image image-wrap'>";
			endif;

				$title_html .= $image_html;

			if ( $image_link ) :
				$title_html .= '</a>';
			else :
				$title_html .= '</div>';
			endif;
		}

		$title_html .= '<div class="contents">';

		foreach ( $sizes as $suffix => $size ) {
			if ( '' === $settings[ 'title_' . $suffix ] ) {
				return;
			}

			$this->add_render_attribute( 'title_' . $suffix, 'class', 'mobius-elementor-timeline-' . str_replace( '_', '', $suffix ) );

			if ( ! empty( $settings[ 'size_' . $suffix ] ) ) {
				$this->add_render_attribute( 'title_' . $suffix, 'class', 'elementor-size-' . $settings[ 'size_' . $suffix ] );
			}

			$this->add_inline_editing_attributes( 'title_' . $suffix );

			$title = $settings[ 'title_' . $suffix ];

			if ( ! empty( $settings[ 'link_' . $suffix ]['url'] ) ) {
				$this->add_render_attribute( 'url_' . $suffix, 'href', $settings[ 'link_' . $suffix ]['url'] );

				if ( $settings[ 'link_' . $suffix ]['is_external'] ) {
					$this->add_render_attribute( 'url_' . $suffix, 'target', '_blank' );
				}

				if ( ! empty( $settings[ 'link_' . $suffix ]['nofollow'] ) ) {
					$this->add_render_attribute( 'url_' . $suffix, 'rel', 'nofollow' );
				}

				$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url_' . $suffix ), $title );
			}

			$title_html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings[ 'header_size_' . $suffix ], $this->get_render_attribute_string( 'title_' . $suffix ), $title );
		}

		$title_html .= '</div>';

		echo '<div class="mobius-studio-timeline-item">';
		echo $title_html;
		echo '</div>';
	}

	/**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<# <?php require_once 'content-template.js'; ?> #>
		<?php
	}

	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings Elementor image setting array object.
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}

}
