<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Images Slider
 */
class Image_GlightBox extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ot-image-glightbox';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'OT Image GlightBox', 'sandbox' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'sandbox' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sandbox' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'default' => 'full',
			]
		);

		$this->add_control(
			'cursor_style',
			[
				'label' => esc_html__( 'Cursor', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' 	=> esc_html__( 'Default', 'sandbox' ),
					'none' 	  	=> esc_html__( 'Pointer', 'sandbox' ),
					'custom'  	=> esc_html__( 'Custom Icon', 'sandbox' ),
					'tooltip' 	=> esc_html__( 'Tooltip', 'sandbox' ),
				],
				'default' => 'none',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'sandbox' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sandbox' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sandbox' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sandbox' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [
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
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'sandbox' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'sandbox' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ot-image-glightbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tooltip',
			[
				'label' => esc_html__( 'Tooltip', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'cursor_style' => 'tooltip',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.itooltip-inner h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.itooltip-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tooltip_typography',
				'selector' => '.itooltip-inner h5',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_glightbox',
			[
				'label' => esc_html__( 'Icon GlightBox', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'cursor_style' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-image-glightbox .item-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-image-glightbox .item-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get the caption for current widget.
	 *
	 * @access private
	 * @since 2.3.0
	 * @param $settings
	 *
	 * @return string
	 */
	private function get_figure_class( $settings ) {
		$cursor_class = 'ot-image-glightbox';
		if ( ! empty( $settings['cursor_style'] ) ) {
			switch ( $settings['cursor_style'] ) {
				case 'default':
					$cursor_class .= ' rounded';
					break;
				case 'none':
					$cursor_class .= ' hover-scale';
					break;
				case 'custom':
					$cursor_class .= ' cursor-dark hover-scale';
					break;
				case 'tooltip':
					$cursor_class .= ' ot-tooltip hover-scale';
			}
		}
		return $cursor_class;
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$image_url = $settings['image']['url'];

		if ( empty( $image_url ) ) {
			return;
		}
		
		$this->add_render_attribute( 'link', 'href', $image_url );
		$this->add_render_attribute( 'link', 'data-glightbox', [
			'title: ' . Control_Media::get_image_title( $settings['image'] ) . ';',
			'description: ' . wp_get_attachment_caption( $settings['image']['id'] )
		] );
		$this->add_render_attribute( 'link', 'data-gallery',  $settings['_css_classes'] );

		$this->add_render_attribute( 'figure-wrap', 'class', $this->get_figure_class( $settings ) );
		if( $settings['cursor_style'] == 'tooltip' ){
			$this->add_render_attribute( 'figure-wrap', 'title', [
				'<h5 class="mb-0">' . Control_Media::get_image_title( $settings['image'] ) . '</h5>'
			] );
		}

		?>
		
		<figure <?php $this->print_render_attribute_string('figure-wrap') ?>>
			<?php if( $settings['cursor_style'] == 'default' ){ ?>
				<?php Group_Control_Image_Size::print_attachment_image_html( $settings ); ?>
				<a class="item-link" <?php $this->print_render_attribute_string('link') ?>>
					<i class="uil uil-focus-add"></i>
				</a>
			<?php }else{ ?>
				<a <?php $this->print_render_attribute_string('link') ?>>
					<?php Group_Control_Image_Size::print_attachment_image_html( $settings ); ?>
				</a>
			<?php } ?>
		</figure>

		
		<?php
	}

}
// After the Image_GlightBox class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Image_GlightBox() );