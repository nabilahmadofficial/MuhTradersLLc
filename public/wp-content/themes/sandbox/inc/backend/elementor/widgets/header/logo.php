<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Logo
 */
class Sandbox_Logo extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ilogo';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Logo', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-logo';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Logo', 'sandbox' ),
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
					'{{WRAPPER}} .the-logo' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'logo_image',
			 [
				'label' => esc_html__( 'Image', 'sandbox' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri().'/images/logo.png',
				],
			 ]
		);

		$this->add_responsive_control(
			'logo_width',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .the-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'scontent_section',
			[
				'label' => __( 'Scroll Logo', 'sandbox' ),
			]
		);

		$this->add_control(
			'slogo_image',
			 [
				'label' => esc_html__( 'Image', 'sandbox' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			 ]
		);

		$this->end_controls_section();
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			
	    	<div class="the-logo <?php if( $settings['slogo_image']['url'] ) echo 'has-slogo'; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_attr( $settings['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php if( $settings['slogo_image']['url'] ) { ?>
					<img class="slogo" src="<?php echo esc_attr( $settings['slogo_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php } ?>
				</a>			        
		    </div>
		    
	    <?php
	}

}
// After the Sandbox_Logo class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Logo() );