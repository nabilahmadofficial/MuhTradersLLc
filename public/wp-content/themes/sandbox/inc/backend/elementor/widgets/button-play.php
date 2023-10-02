<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Button Play
 */
class Sandbox_Button_Play extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-btn-play';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Button Play', 'sandbox' ); 
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-youtube';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Button', 'sandbox' ),
			]
		);

		$this->add_control(
			'vlink',
			[
				'label' => __( 'Video Link', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'sandbox' ),
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Button', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Button
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_size',
			[
				'label' => __( 'Icon Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'sandbox' ),
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Icon Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play,
					 {{WRAPPER}} .octf-btn-play:before,
					 {{WRAPPER}} .octf-btn-play:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .octf-btn-play' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'sandbox' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' => __( 'Hover', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'btn_bg_hcolor',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play:hover,
					 {{WRAPPER}} .octf-btn-play:hover:before,
					 {{WRAPPER}} .octf-btn-play:hover:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .octf-btn-play:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button', 'class', [ 'octf-btn', 'octf-btn-play' ] );

		?>
		<div class="ot-button-wrapper">
	        <a <?php echo $this->get_render_attribute_string( 'button' ); ?> href="<?php echo esc_url( $settings['vlink'] ); ?>" data-glightbox>
	        	<i class="icn-caret-right"></i>
	        </a>
        </div>
	    <?php
	}

}
// After the Sandbox_Button_Play class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Button_Play() );