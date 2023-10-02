<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Testimonial Slider
 */
class Sandbox_Testimonials extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-testimonials';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Testimonial', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-testimonial';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'sandbox' ),
			]
		);
		
		$this->add_control(
			'timage',
			[
				'label' => __( 'Avatar', 'sandbox' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'timage_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tcontent',
			[
				'label' => __( 'Content', 'sandbox' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => __( '“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'sandbox' ),
			]
		);

		$this->add_control(
			'tname',
			[
				'label' => __( 'Name', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Coriss Ambady', 'sandbox' ),
			]
		);

		$this->add_control(
			'tjob',
			[
				'label' => __( 'Job', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Financial Analyst', 'sandbox' ),
			]
		);
		$this->add_control(
			'is_rating',
			[
				'label' => esc_html__( 'Is Rating', 'sandbox' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'sandbox' ),
				'label_on' => esc_html__( 'Yes', 'sandbox' ),
			]
		);
		$this->add_control(
			'rating',
			[
				'label' => __( 'Rating <span class="elementor-control-field-description">( 0-5 )</span>', 'sandbox' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5,
				'step' => 1,
				'default' => 5,
				'condition' => [
					'is_rating' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_tgeneral',
			[
				'label' => __( 'General', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_cbox',
			[
				'label' => __( 'Genaral', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'is_icon',
			[
				'label' => esc_html__( 'Is Icon', 'sandbox' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'sandbox' ),
				'label_on' => esc_html__( 'Yes', 'sandbox' ),
				'default' => 'yes'
			]
		);
		$this->add_control(
			'icon_top',
			[
				'label' => esc_html__( 'Icon Top', 'sandbox' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'sandbox' ),
				'label_on' => esc_html__( 'Yes', 'sandbox' ),
				'condition' => [
					'is_icon' => 'yes'
				]
			]
		);
		$this->add_control(
			'testi_align',
			[
				'label' => __( 'Alignment', 'sandbox' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'sandbox' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sandbox' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sandbox' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default'	=> 'left',
				'toggle'	=> false,
				'render_type' => 'template',
			]
		);
		
		$this->add_control(
			'tcontent_bgcolor',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonial-wrap' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tcontent_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonial__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tcontent_border_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonial-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tcontent_box_shadow',
				'selector' => '{{WRAPPER}} .ot-testimonial-wrap',
			]
		);

		$this->end_controls_section();

		/*Content*/
		$this->start_controls_section(
			'style_tcontent',
			[
				'label' => __( 'Content', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing_tcontent',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blockquote-content' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tcontent_color',
			[
				'label' => __( 'Content Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blockquote-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} blockquote',
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'style_timage',
			[
				'label' => __( 'Avatars', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing_img',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blockquote-details img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blockquote-details img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blockquote-details img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'style_info',
			[
				'label' => __( 'Info', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'testi_align_info',
			[
				'label' => __( 'Alignment', 'sandbox' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'sandbox' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sandbox' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sandbox' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blockquote-details' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_name',
			[
				'label' => __( 'Name', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'spacing_name',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tname' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tname' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .tname',
			]
		);

		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Job', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'selector' => '{{WRAPPER}} .tjob',
			]
		);		

		$this->end_controls_section();

	}

	protected function get_class_rating( $rating ) {
		$number_rating = [
			'1' => 'one',
			'2' => 'two',
			'3' => 'three',
			'4' => 'four',
			'5' => 'five',
		];

		return isset( $number_rating[ $rating ] ) ? $number_rating[ $rating ] : 'empty';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'testi-wrap', 'class', [ 'ot-testimonial-wrap card', 'text-'. $settings['testi_align'] ] );
		$this->add_render_attribute( 'blockquote-wrap', 'class', [ 
			!empty( $settings['is_icon'] ) ? 'icon' : '',
			'mb-0',
			'text-'. $settings['testi_align'],
			!empty( $settings['icon_top'] ) ? 'icon-top' : ''
		] );
		?>

		<div <?php $this->print_render_attribute_string('testi-wrap'); ?>>
			<?php 
			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'timage_size', 'timage' );
			?>
			<div class="ot-testimonial__inner card-body">
				<?php if( !empty($settings['is_rating']) ){ ?>
				<span class="ot-ratings mb-3 <?php echo esc_attr( $this->get_class_rating( $settings['rating'] ) ) ?>"></span>
				<?php } ?>
				<blockquote <?php $this->print_render_attribute_string('blockquote-wrap'); ?>>
					<p class="blockquote-content"><?php $this->print_unescaped_setting( 'tcontent' ); ?></p>
					<div class="blockquote-details">
						<?php echo wp_kses_post( $image_html ); ?>
						<div class="info">
							<h5 class="tname mb-1"><?php $this->print_unescaped_setting( 'tname' ); ?></h5>
			        		<?php if( !empty( $settings['tjob'] ) ) { ?><p class="tjob mb-0"><?php $this->print_unescaped_setting( 'tjob' ); ?></p><?php } ?>
						</div>
					</div>
				</blockquote>
        	</div>		
	    </div>

	    <?php
	}

}
// After the Sandbox_Testimonials class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Testimonials() );