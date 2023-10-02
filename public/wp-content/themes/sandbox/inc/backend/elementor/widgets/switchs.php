<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Switchs
 */
class Sandbox_Switchs extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-switchs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Switchs', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-call-to-action';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Titles', 'sandbox' ),
			]
		);

		$this->add_control(
			'before_text',
			[
				'label' => __( 'Before', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Monthly', 'sandbox' ),
			]
		);

		$this->add_control(
			'after_text',
			[
				'label' => __( 'After', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Yearly', 'sandbox' ),
			]
		);

		$this->add_control(
			'section_id',
			[
				'label' => __( 'ID link to content section', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'section-id', 'sandbox' ),
			]
		);
		
		$this->end_controls_section();

		//Styling		
		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Switch', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'switch_width',
			[
				'label' => esc_html__( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ot-switchs' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'switch_height',
			[
				'label' => esc_html__( 'Height', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ot-switchs, 
					 {{WRAPPER}} .ot-switch-button,
					 {{WRAPPER}} .ot-switch' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-switch-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'switch_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-switchs' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'before_textcolor',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-switch-button' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'before_dot_color',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-switchs' => 'background-color: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'separator_switchs',
			[
				'label' => __( 'Text', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-switchs-wrap p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .ot-switchs-wrap p',
			]
		);
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="ot-switchs-wrap switcher" data-id="<?php echo esc_attr( $settings['section_id'] );?>">
			<p><?php $this->print_unescaped_setting( 'before_text' ); ?></p>
			<div class="ot-switchs">
				<div class="ot-switch ot-switch-active"></div>
	            <div class="ot-switch"></div>
	            <div class="ot-switch-button bg-primary"></div>
			</div>
			<p><?php $this->print_unescaped_setting( 'after_text' ); ?></p>
		</div>

	    <?php
	}

}
// After the Sandbox_Switchs class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Switchs() );