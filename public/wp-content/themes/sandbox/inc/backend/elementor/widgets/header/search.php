<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Search
 */
class Sandbox_Search extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'isearch';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Search', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-search';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox_header' ];
	}

	protected function register_controls() {
		
		/*** Style ***/
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .toggle_search i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_hcolor',
			[
				'label' => __( 'Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .toggle_search i:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggle_search i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style_form_section',
			[
				'label' => __( 'Form', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_form_color',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'#search-panel' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_form_color',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'#search-panel .h-search-form-inner input, #search-panel .h-search-form-inner .search-form:before, #search-panel .h-search-form-inner .search-close' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_overlay_color',
			[
				'label' => __( 'Background Overlay', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.search-active .search-overlay' => 'background: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		/*** scroll ***/
		$this->start_controls_section(
			'style_sicon_section',
			[
				'label' => __( 'Scroll Icon', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'sicon_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_scolor',
			[
				'label' => __( 'Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled i:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<!-- #search-form-open -->
			<div class="h-search-form-field" id="search-panel">
			    <div class="container h-search-form-inner">
			        <?php get_search_form(); ?>
			        <a href="#" class="search-close otbtn-close"><i class="uil uil-times"></i></a>
			    </div>                                  
			</div>

			<div class="site-overlay search-overlay"></div>
	    	<div class="octf-search octf-cta-header hitem">
				<div class="toggle_search octf-cta-icons">
					<i class="uil uil-search"></i>
				</div>
			</div>
		    <!-- #search-form-close -->
	    <?php
	}

}
// After the Sandbox_Search class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Search() );