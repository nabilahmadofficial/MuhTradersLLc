<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team 1
 */
class Sandbox_Team extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-team';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Team', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-person';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		/**TAB_CONTENT**/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Member Team', 'sandbox' ),
			]
		);

		$this->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'sandbox' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'member_image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

	    $this->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'sandbox' ),
	          	'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Peter Perish', 'sandbox' ),
	    	]
	    );

	    $this->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'sandbox' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'co-founder of company', 'sandbox' ),
	    	]
	    );

		$this->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'sandbox' ),
			]
		);

		$this->end_controls_section();

		/**TAB_STYLE**/

		$this->start_controls_section(
			'photo_style',
			[
				'label' => esc_html__( 'General', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'team_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'team_border_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-team__inner, 
					 {{WRAPPER}} .shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .ot-team__inner' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_bgcolor',
			[
				'label'     => esc_html__( 'Background', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ot-team__inner' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'shape_bgcolor',
			[
				'label'     => esc_html__( 'Background Shape', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .shape' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_shadow',
				'selector' => '{{WRAPPER}} .ot-team__inner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_style',
			[
				'label' => esc_html__( 'Info Box', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Spacing', 'sandbox' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tname' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tname, {{WRAPPER}} .tname a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__( 'Hover', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tname a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'sandbox' ),
				'selector' => '{{WRAPPER}} .tname',
			]
		);

		/* extra */
		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Extra/Job', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'label'    => esc_html__( 'Typography', 'sandbox' ),
					'selector' => '{{WRAPPER}} p',
				]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'member_image_size', 'member_image' );
		$tname = $settings['member_name'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'm_link', $settings['link'] );
			$tname = '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' .$tname. '</a>';
		}

		$this->add_render_attribute( 'team-box', 'class', 'ot-team position-relative no-social' );
		?>

		<div <?php $this->print_render_attribute_string( 'team-box' ); ?>>
			<div class="shape d-md-block"></div>
			<div class="ot-team__inner position-relative">
				<?php if( $settings['member_image']['url'] ) { ?>
				<figure class="ot-team__thumb">
					<?php echo wp_kses_post( $image_html ); ?>
				</figure>
				<?php } ?>
				<div class="ot-team__info">
					<h4 class="tname"><?php echo wp_kses_post( $tname ); ?></h4>
					<p class="mb-0"><?php $this->print_unescaped_setting( 'member_extra' ) ?></p>
				</div>
			</div>
		</div>
	        
	    <?php
	}

}
// After the Sandbox_Team class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Team() );