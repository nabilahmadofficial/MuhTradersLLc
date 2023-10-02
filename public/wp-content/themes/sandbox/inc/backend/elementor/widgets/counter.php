<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Counter
 */
class Sandbox_Counter extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-counter';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Counter', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-counter';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Counter', 'sandbox' ),
			]
		);

		$this->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'uil uil-users-alt',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View Icon', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'sandbox' ),
					'stacked' => __( 'Stacked', 'sandbox' ),
				],
				'default' => 'default',
				'prefix_class' => 'ot-view-',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title:', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Downloads', 'sandbox' ),
			]
		);

		$this->add_control(
			'number_counter',
			[
				'label' => __( 'Number:', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '7518', 'sandbox' ),
			]
		);

		$this->add_control(
			'time',
			[
				'label' => __( 'Duration', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2000,
				],
			]
		);
		
		$this->add_control(
			'position',
			[
				'label' => __( 'Number Position', 'sandbox' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sandbox' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'sandbox' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'sandbox' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'ot-position-',
				'toggle' => false,
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'sandbox' ),
					'middle' => __( 'Middle', 'sandbox' ),
					'bottom' => __( 'Bottom', 'sandbox' ),
				],
				'default' => 'top',
				'prefix_class' => 'ot-vertical-align-',
				'condition'	=> [
					'position!' => 'top'
				]
			]
		);

		$this->add_responsive_control(
			'align',
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
				'selectors' => [
					'{{WRAPPER}} .ot-counter-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Style', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-counter__number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-counter__number' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .ot-counter__number',
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'title!' => ''
				]
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-counter__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-counter__title',
				'condition' => [
					'title!' => ''
				]
			]
		);

		//Icon
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.ot-position-right .ot-counter__icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.ot-position-left .ot-counter__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.ot-position-top .ot-counter__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'icon_view',
							'operator' => '!=',
							'value' => 'default',
						]
					],
				],
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'icon_view',
							'operator' => '!=',
							'value' => 'default',
						]
					],
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} svg .lineal-fill,
					 {{WRAPPER}} svg .fill-secondary' => 'fill: currentColor;',
				],
			]
		);
		$this->add_control(
			'icon_bgcolor',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'background-color: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'icon_view',
							'operator' => '!=',
							'value' => 'default',
						]
					],
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$has_icon = false;
		$has_icon = ! empty( $settings['icon'] );
		if ( ! $has_icon && ! empty( $settings['icon_font']['value'] ) ) {
			$has_icon = true;
		}
		$this->add_render_attribute( 'icon_wrapper', 'class', 'ot-counter__icon' );
		if( $settings['position'] != 'top' ){
			$this->add_render_attribute( 'icon_wrapper', 'class', 'flex-gap' );
		}
		
		?>
		<div class="ot-counter-wrapper box-content">

			<?php if ( $has_icon ) : ?>
			<div <?php $this->print_render_attribute_string( 'icon_wrapper' ); ?>>
				<?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
	        </div>
	        <?php endif; ?>
			<div class="ot-counter__content">
				<h3 class="ot-counter__number counter" data-duration= "<?php echo esc_attr( $settings['time']['size'] ); ?>"><?php $this->print_unescaped_setting( 'number_counter' ); ?></h3>
				<p class="ot-counter__title"><?php $this->print_unescaped_setting( 'title' ); ?></p>
			</div>

		</div>
	    <?php
	}

}
// After the Sandbox_Counter class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Counter() );