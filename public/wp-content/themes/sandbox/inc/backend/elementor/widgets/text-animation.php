<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Heading 
 */
class Sandbox_Text_Animation extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-text-animation';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Text Animation', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-animation-text';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'sandbox' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text & Text animation', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Sandbox focuses on', 'sandbox' ),
				'placeholder' => __( 'Enter your text', 'sandbox' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'text_typer',
			[
				'label' => '',
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'customer satisfaction,business needs', 'sandbox' ),
				'placeholder' => __( 'Enter your text animation', 'sandbox' ),
				'show_label' => false,
				'label_block' => true,
			]
		);

		$this->add_control(
			'ani_type',
			[
				'label' => __( 'Animation Type', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'typer' 	   => 'Typer',
					'rotator-fade' => 'Fade',
					'rotator-zoom' => 'Zoom',
				],
				'default' => 'typer',
			]
		);

		$this->add_control(
			'heading_size',
			[
				'label' => __( 'Title HTML Tag', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
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
					]
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Heading', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Subtitle
		$this->add_control(
			'heading_text',
			[
				'label' => __( 'Content', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-text-ani' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-text-ani',
			]
		);

		//Animation
		$this->add_control(
			'heading_typer',
			[
				'label' => __( 'Text Animation', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'ani_type' => 'typer'
				]
			]
		);
		$this->add_control(
			'text_typer_color',
			[
				'label' => __( 'Animation Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-text-ani span, {{WRAPPER}} .ot-text-ani span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'typer_delay',
			[
				'label' => esc_html__( 'Time Delay', 'sandbox' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Min: 100ms (millisecond)', 'sandbox' ),
				'default' => 100,
				'min' => 100,
				'step' => 50,
				'condition' => [
					'ani_type' => 'typer'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'typer-wrapper' => [
				'class' => [
					'ot-text-ani',
					'display-1',
				],
			],
			'typer' => [
				'class' => $settings['ani_type'],
				'data-delay' => $settings['typer_delay'],
				'data-loop' => 'yes' === $settings['loop'] ? 'true' : 'false',
				'data-colors' => $settings['text_typer_color'],
				'data-words' => $settings['text_typer'],
			],
			'rotator' => [
				'class' => $settings['ani_type'],
			],
			'cursor' => [
				'class' => 'cursor',
				'data-owner' => 'typer',
				'data-colors' => $settings['text_typer_color'],
			],
		] );
		
		?>
		<<?php Utils::print_validated_html_tag( $settings['heading_size'] ); ?> <?php $this->print_render_attribute_string( 'typer-wrapper' ); ?>>
			<?php $this->print_unescaped_setting( 'text' ); ?>
			<?php if( 'typer' === $settings['ani_type'] ){ ?>
			<span <?php $this->print_render_attribute_string( 'typer' ); ?>></span><span <?php $this->print_render_attribute_string( 'cursor' ); ?>></span>
			<?php }else{ ?>
				<span <?php $this->print_render_attribute_string( 'rotator' );?>><?php $this->print_unescaped_setting( 'text_typer' ); ?></span>
			<?php } ?>
	    </<?php Utils::print_validated_html_tag( $settings['heading_size'] ); ?>>
	    <?php
	}

}
// After the Sandbox_Text_Animation class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Text_Animation() );