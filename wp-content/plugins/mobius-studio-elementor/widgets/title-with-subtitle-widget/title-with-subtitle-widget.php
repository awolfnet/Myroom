<?php
/**
 * Title with subtitle widget.
 *
 * @package Mobius Studio Elementor
 * @category Mobius Studio Elementor
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Title with subtitle Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Title_With_Subtitle_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Title with subtitle widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'title_with_subtitle';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Title with subtitle widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Title with Subtitle', 'mobius-studio-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Title with subtitle widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-t-letter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Title with subtitle widget belongs to.
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
		return [ 'title', 'subtitle', 'title with subtitle', 'mobius studio' ];
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
			'title'    => array(
				'text'     => __( 'Title', 'mobius-studio-elementor' ),
				'defaults' => array(
					'header_size' => 'h3',
					'title_color' => '#414141',
				),
			),
			'subtitle' => array(
				'text'     => __( 'Subtitle', 'mobius-studio-elementor' ),
				'defaults' => array(
					'header_size' => 'h5',
					'title_color' => '#414141',
				),
			),
		);
	}

	/**
	 * Register Title with subtitle widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

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
						'{{WRAPPER}} .mobius-elementor-heading-' . $suffix => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'typography_' . $suffix,
					'scheme'   => Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mobius-elementor-heading-' . $suffix,
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'text_shadow_' . $suffix,
					'selector' => '{{WRAPPER}} .mobius-elementor-heading-' . $suffix,
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
						'{{WRAPPER}} .mobius-elementor-heading-' . $suffix => 'mix-blend-mode: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_section();

		}
	}

	/**
	 * Render Title with subtitle widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$sizes = $this->get_sizes();

		$title_html = '';
		foreach ( $sizes as $suffix => $size ) {
			if ( '' === $settings[ 'title_' . $suffix ] ) {
				return;
			}

			$this->add_render_attribute( 'title_' . $suffix, 'class', 'mobius-elementor-heading-' . str_replace( '_', '', $suffix ) );

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

		echo '<div class="mobius-studio-bordered-title">';
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
	protected function content_template() {
		?>
		<#
		var title = settings.title_title;
		var subtitle = settings.title_subtitle;

		if ( '' !== settings.link_title.url ) {
		title = '<a href="' + settings.link_title.url + '">' + title + '</a>';
		}

		if ( '' !== settings.link_subtitle.url ) {
		subtitle = '<a href="' + settings.link_subtitle.url + '">' + subtitle + '</a>';
		}

		view.addRenderAttribute( 'title_title', 'class', [ 'mobius-elementor-heading-title', 'elementor-size-' + settings.size_title ] );
		view.addRenderAttribute( 'title_subtitle', 'class', [ 'mobius-elementor-heading-subtitle', 'elementor-size-' + settings.size_subtitle ] );

		view.addInlineEditingAttributes( 'title_title' );
		view.addInlineEditingAttributes( 'title_subtitle' );

		var title_html = '<' + settings.header_size_title  + ' ' + view.getRenderAttributeString( 'title_title' ) + '>' + title + '</' + settings.header_size_title + '>';
		var subtitle_html = '<' + settings.header_size_subtitle  + ' ' + view.getRenderAttributeString( 'title_subtitle' ) + '>' + subtitle + '</' + settings.header_size_subtitle + '>';
		#>
		<div class="mobius-studio-bordered-title">
			<# print(title_html + subtitle_html); #>
		</div>
		<?php
	}

}
