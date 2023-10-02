<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team Slider
 */
class Sandbox_Team_Slider extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-team-slider';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Team Slider', 'sandbox' );
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
		$repeater = new Repeater();

		$repeater->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'sandbox' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
		);

	    $repeater->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'sandbox' ),
	          	'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Coriss Ambady', 'sandbox' ),
	    	]
	    );

	    $repeater->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'sandbox' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'Financial Analyst', 'sandbox' ),
	    	]
	    );

	    $repeater->add_control(
		    'member_desc',
	      	[
	          	'label' => esc_html__( 'Description', 'sandbox' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => '',
	    	]
	    );

	    $repeater->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'sandbox' ),
			]
		);


		$repeater->add_control(
			'social_share',
			[
				'label' => __( 'Socials', 'sandbox' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sandbox' ),
				'label_off' => __( 'Hide', 'sandbox' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$default_social1_icon = [
			'value' => 'uil-twitter',
			'library' => 'fa-solid',
		];
		$default_social2_icon = [
			'value' => 'uil-facebook-f',
			'library' => 'fa-solid',
		];
		$default_social3_icon = [
			'value' => 'uil-dribbble',
			'library' => 'fa-solid',
		];

        $repeater->add_control(
		    'social1',
	      	[
	          	'label' => esc_html__( 'Icon Social 1', 'sandbox' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => $default_social1_icon,
				'condition' => [
					'social_share' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social1_link',
			[
				'label' => __( 'Link Social 1', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://twitter.com/', 'sandbox' ),
				'condition' => [
					'social_share' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'social1_color',
			[
				'label' => esc_html__( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
			]
		);
		$repeater->add_control(
		    'social2',
	      	[
	          	'label' => esc_html__( 'Icon Social 2', 'sandbox' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => $default_social2_icon,
				'separator' => 'before',
				'condition' => [
					'social_share' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social2_link',
			[
				'label' => __( 'Link Social 2', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://facebook.com/', 'sandbox' ),
				'condition' => [
					'social_share' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'social2_color',
			[
				'label' => esc_html__( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
		    'social3',
	      	[
	          	'label' => esc_html__( 'Icon Social 3', 'sandbox' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => $default_social3_icon,
				'separator' => 'before',
				'condition' => [
					'social_share' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social3_link',
			[
				'label' => __( 'Link Social 3', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://dribbble.com/', 'sandbox' ),
				'condition' => [
					'social_share' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'social3_color',
			[
				'label' => esc_html__( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
		    'ot_teams',
		    [
		        'label'       => esc_html__( 'Teams', 'sandbox' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => true,
		        'default'     => [
		        	[
						'member_name'	  => __( 'Coriss Ambady', 'sandbox' ),
						'member_extra'	  => __( 'Financial Analyst', 'sandbox' ),
						'social1' 		  => $default_social1_icon,
						'social1_link'	  => [
							'url' 	=> '#'
						],
						'social2' 		  => $default_social2_icon,
						'social2_link'	  => [
							'url' 	=> '#'
						],
						'social3' 		  => $default_social3_icon,
						'social3_link'	  => [
							'url' 	=> '#'
						],
		            ],
		            [
						'member_name'	  => __( 'Cory Zamora', 'sandbox' ),
						'member_extra'	  => __( 'Marketing Specialist', 'sandbox' ),
						'social1' 		  => $default_social1_icon,
						'social1_link'	  => [
							'url' 	=> '#'
						],
						'social2' 		  => $default_social2_icon,
						'social2_link'	  => [
							'url' 	=> '#'
						],
						'social3' 		  => $default_social3_icon,
						'social3_link'	  => [
							'url' 	=> '#'
						],
		            ],
		            [
						'member_name'	  => __( 'Barclay Widerski', 'sandbox' ),
						'member_extra'	  => __( 'Sales Specialist', 'sandbox' ),
						'social1' 		  => $default_social1_icon,
						'social1_link'	  => [
							'url' 	=> '#'
						],
						'social2' 		  => $default_social2_icon,
						'social2_link'	  => [
							'url' 	=> '#'
						],
						'social3' 		  => $default_social3_icon,
						'social3_link'	  => [
							'url' 	=> '#'
						],
		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{member_name}}}',
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

		/* Option Slider */

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_control(
			'heading_slider_option',
			[
				'label' => __( 'Slider Option', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides To Show', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'sandbox' ),
				] + $slides_show,
				'default' => ''
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'timeout',
			[
				'label' => __( 'Autoplay Timeout', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'default' => [
					'size' => 7000,
				],
				'condition' => [
					'autoplay' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'slider_spacing',
			[
				'label' => __( 'Slider Spacing <span class="elementor-control-field-description">(Min: 30px)</span>', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'both' => __( 'Arrows and Dots', 'sandbox' ),
					'arrows' => __( 'Arrows', 'sandbox' ),
					'dots' => __( 'Dots', 'sandbox' ),
					'none' => __( 'None', 'sandbox' ),
				],
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
					'{{WRAPPER}} .ot-team__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ot-team__inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		/*Avatar*/
		$this->add_control(
			'heading_photo',
			[
				'label' => __( 'Avatar', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'photo_size',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-team__thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'photo_space',
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
					'{{WRAPPER}} .ot-team__thumb img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_photo',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-team__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		$this->add_responsive_control(
			'job_space',
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
					'{{WRAPPER}} .tjob' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typography',
				'label'    => esc_html__( 'Typography', 'sandbox' ),
				'selector' => '{{WRAPPER}} .tjob',
			]
		);

		/* description */
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'desc_space',
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
					'{{WRAPPER}} .ot-team__info p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Color', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ot-team__info p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'sandbox' ),
				'selector' => '{{WRAPPER}} .ot-team__info p',
			]
		);

		$this->end_controls_section();

		/* Socials */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Socials', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_social_space',
			[
				'label' => esc_html__( 'Spacing', 'sandbox' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_social_size',
			[
				'label' => esc_html__( 'Size', 'sandbox' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_social_color',
			[
				'label'     => esc_html__( 'Color', 'sandbox' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dots_size',
			[
				'label' => __( 'Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'sandbox' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots .owl-dot:not(.active) span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .owl-dots .owl-dot:hover span, {{WRAPPER}} .owl-dots .owl-dot.active span' => 'border-color: {{VALUE}};'
				],
            ]
        );
        $this->add_control(
			'dots_opacity',
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
					'{{WRAPPER}} .owl-dot span' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->end_controls_section();

        // Arrow.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrows', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				]
			]
		);
		
		$this->add_responsive_control(
			'arrow_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bgcolor',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Hover', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bghcolor',
			[
				'label' => __( 'Background Hover', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$showXxl   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showXl    = !empty( $settings['tshow_laptop'] ) ? $settings['tshow_laptop'] : $showXxl;
		$showLg    = !empty( $settings['tshow_tablet_extra'] ) ? $settings['tshow_tablet_extra'] : $showXl;
		$showMd    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showLg;
		$showSm    = !empty( $settings['tshow_mobile_extra'] ) ? $settings['tshow_mobile_extra'] : $showMd;
		$showXs    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showSm;

		$gapXxl      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? ( $settings['slider_spacing']['size'] - 30 ) : 0;
		$gapXl  = isset( $settings['slider_spacing_laptop']['size'] ) && is_numeric( $settings['slider_spacing_laptop']['size'] ) ? ( $settings['slider_spacing_laptop']['size'] - 30 ) : $gapXxl;
		$gapLg  = isset( $settings['slider_spacing_tablet_extra']['size'] ) && is_numeric( $settings['slider_spacing_tablet_extra']['size'] ) ? ( $settings['slider_spacing_tablet_extra']['size'] - 30 ) : $gapXl;
		$gapMd  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? ( $settings['slider_spacing_tablet']['size'] - 30 ) : $gapLg;
		$gapSm  = isset( $settings['slider_spacing_mobile_extra']['size'] ) && is_numeric( $settings['slider_spacing_mobile_extra']['size'] ) ? ( $settings['slider_spacing_mobile_extra']['size'] - 30 ) : $gapMd;
		$gapXs  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? ( $settings['slider_spacing_mobile']['size'] - 30 ) : $gapSm;
		$timeout  = isset( $settings['timeout']['size'] ) ? $settings['timeout']['size'] : 5000;

		$owl_options = [
			'slides_show_desktop'  		 => absint( $showXxl ),
			'slides_show_laptop'  		 => absint( $showXl ),
			'slides_show_tablet_extra'   => absint( $showLg ),
			'slides_show_tablet'   		 => absint( $showMd ),
			'slides_show_mobile_extra'   => absint( $showSm ),
			'slides_show_mobile'   		 => absint( $showXs ),
			'margin_desktop'   	   		 => absint( $gapXxl ),
			'margin_laptop'   	   		 => absint( $gapXl ),
			'margin_tablet_extra'  		 => absint( $gapLg ),
			'margin_tablet'   	   		 => absint( $gapMd ),
			'margin_mobile_extra'   	 => absint( $gapSm ),
			'margin_mobile'   	   		 => absint( $gapXs ),
			'autoplay'      	   		 => $settings['autoplay'] ? $settings['autoplay'] : 'no',
			'autoplay_time_out'    		 => absint( $timeout ),
			'loop'      		   		 => $settings['loop'] ? $settings['loop'] : 'no' ,
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => 'ot-carousel ot-team-carousel',
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);

		$this->add_render_attribute( 'team-box', 'class', 'ot-team with-social' );
		?>

		<div <?php $this->print_render_attribute_string( 'slides' ); ?>>
			<div class="owl-carousel owl-theme">

				<?php
				foreach ( $settings['ot_teams'] as $key => $mem ) : 
				$image_url = Group_Control_Image_Size::get_attachment_image_src( $mem['member_image']['id'], 'member_image_size', $settings );
				if( empty($image_url) ){
					$image_url = Utils::get_placeholder_image_src();
				}
		        $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $mem['member_name'] ) . '">';
				$tname = $mem['member_name'];

				if ( ! empty( $mem['link']['url'] ) ) {
					$this->add_link_attributes( 'm_link' . $key, $mem['link'] );
					$tname = '<a ' .$this->get_render_attribute_string( 'm_link' . $key ). '>' .$tname. '</a>';
				}
				?>
				<div <?php $this->print_render_attribute_string( 'team-box' ); ?>>
					<div class="ot-team__inner">
						<?php if( !empty( $mem['member_image']['url'] ) ){ ?>
						<figure class="ot-team__thumb">
							<?php echo wp_kses_post( $image_html ); ?>
						</figure>
						<?php } ?>
						<div class="ot-team__info">
							<h4 class="tname"><?php echo wp_kses_post( $tname ); ?></h4>
							<div class="tjob mb-2"><?php $this->print_unescaped_setting( 'member_extra', 'ot_teams', $key ); ?></div>
							<?php if ( ! empty( $mem['member_desc'] ) ) { echo '<p class="mb-2">' . wp_kses_post( $mem['member_desc'] ) . '</p>'; } ?>

							<?php if ( $mem['social_share'] == 'yes' ) : ?>
							<div class="team-social">
								<?php if ( ! empty( $mem['social1']['value'] ) ) :
									$this->add_link_attributes( 'social_1' . $key, $mem['social1_link'] );
									if( !empty( $mem['social1_color'] ) ){
										$this->add_render_attribute( 'social_1' . $key, 'style', [
											'color: '. $mem['social1_color']
										] );
									}
								?>
								<a <?php $this->print_render_attribute_string( 'social_1' . $key ); ?>>
									<?php Icons_Manager::render_icon( $mem['social1'], [ 'aria-hidden' => 'true' ] ); ?>
								</a>
								<?php endif; ?>

								<?php if ( ! empty( $mem['social2']['value'] ) ) :
									$this->add_link_attributes( 'social_2' . $key, $mem['social2_link'] );
									if( !empty( $mem['social2_color'] ) ){
										$this->add_render_attribute( 'social_2' . $key, 'style', [
											'color: '. $mem['social2_color']
										] );
									}
								?>
								<a <?php $this->print_render_attribute_string( 'social_2' . $key ); ?>>
									<?php Icons_Manager::render_icon( $mem['social2'], [ 'aria-hidden' => 'true' ] ); ?>
								</a>
								<?php endif; ?>

								<?php if ( ! empty( $mem['social3']['value'] ) ) :
									$this->add_link_attributes( 'social_3' . $key, $mem['social3_link'] );
									if( !empty( $mem['social3_color'] ) ){
										$this->add_render_attribute( 'social_3' . $key, 'style', [
											'color: '. $mem['social3_color']
										] );
									}
								?>
								<a <?php $this->print_render_attribute_string( 'social_3' . $key ); ?>>
									<?php Icons_Manager::render_icon( $mem['social3'], [ 'aria-hidden' => 'true' ] ); ?>
								</a>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<?php endforeach; ?>
			</div>
		</div>
	        
	    <?php
	}

}
// After the Sandbox_Team_Slider class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Team_Slider() );