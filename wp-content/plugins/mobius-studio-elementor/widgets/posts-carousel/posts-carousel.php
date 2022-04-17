<?php
/**
 * Posts Carousel Widget.
 *
 * @package Mobius Studio Elementor
 * @category Mobius Studio Elementor
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Core\Schemes;
use Elementor\Widget_Base;

/**
 * Elementor Posts Carousel widget.
 *
 * A custom widget, supports blog posts with carousel mode.
 *
 * @since 1.0.0
 */
class Posts_Carousel_Widget extends Widget_Base {

	use Helpers;

	/**
	 * Get widget name.
	 *
	 * Retrieve Posts Carousel widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'posts_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Posts Carousel widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Posts Carousel', 'mobius-studio-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Posts Carousel widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-slider-push';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Posts Carousel widget belongs to.
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
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return [ 'posts', 'carousel', 'slider', 'blog' ];
	}

	/**
	 * Register Posts Carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_carousel_options',
			[
				'label' => __( 'Carousel Options', 'mobius-studio-elementor' ),
			]
		);

		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$categories = get_categories(
			array(
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => false,
			)
		);

		array_walk(
			$categories,
			function ( &$val, &$key ) {
				$key = $val->term_id;
				$val = $val->name;
			}
		);

		$categories = array( 0 => __( 'All', 'mobius-studio-elementor' ) ) + $categories;

		$this->add_control(
			'posts_categories',
			[
				'label'    => __( 'Categories', 'mobius-studio-elementor' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => $categories,
				'default'  => [ 0 ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => __( 'Number of Posts', 'mobius-studio-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 25,
				'step'    => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'              => __( 'Order By', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => [
					'date'  => __( 'Date', 'mobius-studio-elementor' ),
					'title' => __( 'Title', 'mobius-studio-elementor' ),
					'rand'  => __( 'Rand', 'mobius-studio-elementor' ),
				],
				'default'            => 'date',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'order',
			[
				'label'              => __( 'Sort Order', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => [
					'desc' => __( 'Descending', 'mobius-studio-elementor' ),
					'asc'  => __( 'Ascending', 'mobius-studio-elementor' ),
				],
				'default'            => 'desc',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'              => __( 'Slides to Show', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 3,
				'options'            => [
					'' => __( 'Default', 'mobius-studio-elementor' ),
				] + $slides_to_show,
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'              => __( 'Slides to Scroll', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => __( 'Set how many slides are scrolled per swipe.', 'mobius-studio-elementor' ),
				'default'            => 1,
				'options'            => [
					'' => __( 'Default', 'mobius-studio-elementor' ),
				] + $slides_to_show,
				'condition'          => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'image_stretch',
			[
				'label'   => __( 'Image Stretch', 'mobius-studio-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'No', 'mobius-studio-elementor' ),
					'yes' => __( 'Yes', 'mobius-studio-elementor' ),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'              => __( 'Navigation', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => [
					'both'   => __( 'Arrows and Dots', 'mobius-studio-elementor' ),
					'arrows' => __( 'Arrows', 'mobius-studio-elementor' ),
					'dots'   => __( 'Dots', 'mobius-studio-elementor' ),
					'none'   => __( 'None', 'mobius-studio-elementor' ),
				],
				'frontend_available' => true,
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
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'mobius-studio-elementor' ),
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'              => __( 'Pause on Interaction', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => false,
				'options'            => [
					true  => __( 'Yes', 'mobius-studio-elementor' ),
					false => __( 'No', 'mobius-studio-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'              => __( 'Autoplay', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => true,
				'options'            => [
					true  => __( 'Yes', 'mobius-studio-elementor' ),
					false => __( 'No', 'mobius-studio-elementor' ),
				],
				'frontend_available' => true,
				'render_type'        => 'none',
				'separator'          => 'after',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'              => __( 'Autoplay Speed', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 5000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'              => __( 'Infinite Loop', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => true,
				'options'            => [
					true  => __( 'Yes', 'mobius-studio-elementor' ),
					false => __( 'No', 'mobius-studio-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effect',
			[
				'label'              => __( 'Effect', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'slide',
				'options'            => [
					'slide' => __( 'Slide', 'mobius-studio-elementor' ),
					'fade'  => __( 'Fade', 'mobius-studio-elementor' ),
				],
				'condition'          => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label'              => __( 'Animation Speed', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 500,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'direction',
			[
				'label'              => __( 'Direction', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'ltr',
				'options'            => [
					'ltr' => __( 'Left', 'mobius-studio-elementor' ),
					'rtl' => __( 'Right', 'mobius-studio-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'mobius-studio-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label'     => __( 'Arrows', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'        => __( 'Position', 'mobius-studio-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'inside',
				'options'      => [
					'inside'  => __( 'Inside', 'mobius-studio-elementor' ),
					'outside' => __( 'Outside', 'mobius-studio-elementor' ),
				],
				'prefix_class' => 'elementor-arrows-position-',
				'condition'    => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'     => __( 'Size', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Color', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'        => __( 'Position', 'mobius-studio-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'outside',
				'options'      => [
					'outside' => __( 'Outside', 'mobius-studio-elementor' ),
					'inside'  => __( 'Inside', 'mobius-studio-elementor' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition'    => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __( 'Size', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Slide Item', 'mobius-studio-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gallery_vertical_align',
			[
				'label'       => __( 'Vertical Align', 'mobius-studio-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'flex-start' => [
						'title' => __( 'Start', 'mobius-studio-elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center'     => [
						'title' => __( 'Center', 'mobius-studio-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end'   => [
						'title' => __( 'End', 'mobius-studio-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'condition'   => [
					'slides_to_show!' => '1',
				],
				'selectors'   => [
					'{{WRAPPER}} .swiper-wrapper' => 'display: flex; align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label'     => __( 'Spacing', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''       => __( 'Default', 'mobius-studio-elementor' ),
					'custom' => __( 'Custom', 'mobius-studio-elementor' ),
				],
				'default'   => 'custom',
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing_custom',
			[
				'label'              => __( 'Spacing in PX', 'mobius-studio-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 30,
				],
				'tablet_default'     => [
					'size' => 15,
				],
				'mobile_default'     => [
					'size' => 8,
				],
				'show_label'         => false,
				'condition'          => [
					'image_spacing'   => 'custom',
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
				'render_type'        => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .mobius-studio-posts-carousel-wrapper .mobius-studio-posts-carousel .swiper-slide',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'mobius-studio-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'top'    => '3',
					'right'  => '3',
					'bottom' => '3',
					'left'   => '3',
				],
				'selectors'  => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-wrapper .mobius-studio-posts-carousel .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'slide_item',
				'selectors' => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-wrapper .mobius-studio-posts-carousel .swiper-slide' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}} {{COLOR}};',
				],
				'default'   => [
					'horizontal' => 0,
					'vertical'   => 0,
					'blur'       => '3',
					'spread'     => 0,
					'color'      => 'rgba(0,0,0,0.4)',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => __( 'Caption', 'mobius-studio-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'caption_align',
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
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color',
			[
				'label'     => __( 'Text Color', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .mobius-studio-posts-carousel-caption',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'mobius-studio-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_read_more',
			[
				'label' => __( 'Read More Link', 'mobius-studio-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'read_more_align',
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
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-read-more-link' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'read_more_text_color',
			[
				'label'     => __( 'Text Color', 'mobius-studio-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .mobius-studio-posts-carousel-read-more-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'read_more_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .mobius-studio-posts-carousel-read-more-link',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Posts Carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$posts = get_posts(
			array(
				'numberposts'      => $settings['limit'],
				'category'         => implode( ',', $settings['posts_categories'] ),
				'orderby'          => $settings['orderby'],
				'order'            => $settings['order'],
				'post_type'        => 'post',
				'suppress_filters' => true,
			)
		);

		if ( empty( $posts ) ) {
			return;
		}

		$slides = [];

		global $post;
		foreach ( $posts as $post ) {
			setup_postdata( $post );

			$thumbnail = get_the_post_thumbnail();

			if ( function_exists( 'fly_get_attachment_image' ) ) {
				$thumbnail = fly_get_attachment_image( get_post_thumbnail_id(), 'blog_carousel' );
			}

			$read_more = sprintf( '<a href="%s" class="mobius-studio-posts-carousel-read-more-link">%s</a>', get_the_permalink(), __( 'Read More...', 'mobius-studio-elementor' ) );

			$slide_html = '<div class="swiper-slide">';

			$slide_html .= sprintf( '<a href="%s">%s</a>', get_the_permalink(), $thumbnail );

			$slide_html .= sprintf( '<div class="mobius-studio-posts-carousel-caption">%s%s</div>', get_the_title(), $read_more );

			$slide_html .= '</div>';

			$slides[] = $slide_html;

		}
		wp_reset_postdata();

		if ( empty( $slides ) ) {
			return;
		}

		$this->add_render_attribute(
			[
				'carousel'         => [
					'class' => 'mobius-studio-posts-carousel swiper-wrapper',
				],
				'carousel-wrapper' => [
					'class' => 'mobius-studio-posts-carousel-wrapper swiper-container',
					'dir'   => $settings['direction'],
				],
			]
		);

		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ], true ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ], true ) );

		if ( 'yes' === $settings['image_stretch'] ) {
			$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
		}

		$data_options = $this->map_elementor_options_to_swiper_options( $settings );

		$this->add_render_attribute( 'carousel-wrapper', 'data-options', wp_json_encode( $data_options ) );

		$slides_count = count( $posts );

		?>
		<div <?php echo $this->get_render_attribute_string( 'carousel-wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
				<?php echo implode( '', $slides ); ?>
			</div>
			<?php if ( 1 < $slides_count ) : ?>
				<?php if ( $show_dots ) : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>
				<?php if ( $show_arrows ) : ?>
					<div class="elementor-swiper-button elementor-swiper-button-prev">
						<i class="eicon-chevron-left" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Previous', 'mobius-studio-elementor' ); ?></span>
					</div>
					<div class="elementor-swiper-button elementor-swiper-button-next">
						<i class="eicon-chevron-right" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Next', 'mobius-studio-elementor' ); ?></span>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php
	}

}
