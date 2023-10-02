<?php
use Elementor\Controls_Stack;
use Elementor\Controls_Manager;
use Elementor\Element_Column;
use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ot_Sandbox_Effect extends Module {

	public function __construct() {

		$this->add_actions();
	}

	public function get_name() {
		return 'sandbox-effect';
	}

	/**
	 * @param $element
	 */
	public function register_controls( $element ) {

		$element->start_controls_section(
			'sandbox_ani_effect',
			[
				'label' => __( 'Sandbox Effects', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'sandbox_ani_name',
			[
				'label'     => __( 'Animation Name', 'sandbox' ),
				'type'      => Controls_Manager::SELECT2,
				'default'   => '',
				'label_block' => true,
				'render_type' => 'template',
				'options'   => [
					''					=> __( 'Default', 'sandbox' ),
					'sbFadeIn'          => __( 'Fade In', 'sandbox' ),
					'sbSlideInLeft'     => __( 'Slide In Left', 'sandbox' ),
					'sbSlideInRight'    => __( 'Slide In Right', 'sandbox' ),
					'sbSlideInDown'     => __( 'Slide In Down', 'sandbox' ),
					'sbSlideInUp'       => __( 'Slide In Up', 'sandbox' ),
					'sbZoomIn'          => __( 'Zoom In', 'sandbox' ),
					'sbZoomOut'         => __( 'Zoom Out', 'sandbox' ),
					'sbRotateIn'    	=> __( 'Rotate In', 'sandbox' ),
					'sbBounceIn'   		=> __( 'Bounce In', 'sandbox' ),
					'sbBounceInLeft' 	=> __( 'Bounce In Left', 'sandbox' ),
					'sbBounceInRight' 	=> __( 'Bounce In Right', 'sandbox' ),
					'sbBounceInDown' 	=> __( 'Bounce In Down', 'sandbox' ),
					'sbBounceInUp' 		=> __( 'Bounce In Up', 'sandbox' ),
					'sbFlipInX' 		=> __( 'Flip In X', 'sandbox' ),
					'sbFlipInY' 		=> __( 'Flip In Y', 'sandbox' ),
				],
			]
		);
		$element->add_control(
			'sandbox_ani_duration',
			[
				'label'     => __( 'Animation Duration (ms)', 'sandbox' ),
				'type'      => Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 50,
				'default' => 700,
				'condition' => [
					'sandbox_ani_name!'     => '',
				],
			]
		);

		$element->add_control(
			'sandbox_ani_delay',
			[
				'label'     => __( 'Animation Delay (ms)', 'sandbox' ),
				'type'      => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 50,
				'default' => 300,
				'condition' => [
					'sandbox_ani_name!'     => '',
				],

			]
		);

		$element->end_controls_section();
	}

	/**
	 * Render Sandbox Effects output on the frontend.
	 *
	 * Written in PHP and used to collect cursor settings and add it as an element attribute.
	 *
	 * @access public
	 * @param object $element for current element.
	 */
	public function before_render( $element ) {
		$data = $element->get_data();

		$type = $data['elType'];

		$settings = $element->get_settings_for_display();

		if ( 'widget' === $type && ! empty( $settings['sandbox_ani_name'] ) ) {
			
			$element->add_render_attribute( '_wrapper', 'data-cue', $settings['sandbox_ani_name'] );
			if( !empty($settings['sandbox_ani_duration']) ){
				$element->add_render_attribute( '_wrapper', 'data-duration', $settings['sandbox_ani_duration'] );
			}
			if( !empty($settings['sandbox_ani_delay']) ){
				$element->add_render_attribute( '_wrapper', 'data-delay', $settings['sandbox_ani_delay'] );
			}
		}
	}

	protected function add_actions() {
		// Creates Sandbox Effects tab at the end of advanced tab.
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register_controls' ], 10 );
		// Insert data before widget rendering.
		add_action( 'elementor/frontend/widget/before_render', [ $this, 'before_render' ] );
	}
}

new Ot_Sandbox_Effect();
