<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Portfolio Carousel
 */
class Sandbox_Portfolio_Slider_2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-portfolio-carousel_2';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Portfolio Carousel 2', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-slider-push';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Portfolio', 'sandbox' ),
			]
		);
		$this->add_control(
			'project_cat',
			[
				'label' => __( 'Select Categories', 'sandbox' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'sandbox' ),
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Portfolio', 'sandbox' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'post_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
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
			'visible_outside',
			[
				'label'   => esc_html__( 'Visible Item Outside', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
				'selectors_dictionary' => [
				    'yes' => 'overflow: visible',
				],
				'selectors' => [
				    '{{WRAPPER}} .owl-carousel .owl-stage-outer' => '{{VALUE}}',
				],
				'render_type' => 'template'
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
				'label' => __( 'Slider Spacing', 'sandbox' ),
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
		$this->add_control(
			'arr_bottom',
			[
				'label'   => esc_html__( 'Arrow Position Bottom', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'visible_outside' => 'yes',
					'navigation' => [ 'arrows', 'both' ]
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .projects-box' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'image_spacing',
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
					'{{WRAPPER}} .projects-thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_control(
			'radius_thumb',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rounded, 
					 {{WRAPPER}} .rounded img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'is_gallery',
			[
				'label'   => esc_html__( 'Is Gallery?', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'is_gallery'   => 'yes'
				]
			]
		);
		$this->add_control(
			'icon_bgcolor',
			[
				'label' => __( 'Icon Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link' => 'background-color: {{VALUE}};',
				],
				'condition'	=> [
					'is_gallery'   => 'yes'
				]
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
			'title_spacing',
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
					'{{WRAPPER}} .post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title .title-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title .title-link:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-title .title-link',
			]
		);

		/* Portfolio Category */
		$this->add_control(
			'heading_cat',
			[
				'label' => __( 'Portfolio Category', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-cates, 
					 {{WRAPPER}} .post-cates a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'cat_hcolor',
			[
				'label' => __( 'Hover', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-cates a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .post-cates',
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
					'{{WRAPPER}} .nav-bottom' => 'top: calc(100% + {{SIZE}}{{UNIT}});',
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

		$gapXxl      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? $settings['slider_spacing']['size'] : 30;
		$gapXl  = isset( $settings['slider_spacing_laptop']['size'] ) && is_numeric( $settings['slider_spacing_laptop']['size'] ) ? $settings['slider_spacing_laptop']['size'] : $gapXxl;
		$gapLg  = isset( $settings['slider_spacing_tablet_extra']['size'] ) && is_numeric( $settings['slider_spacing_tablet_extra']['size'] ) ? $settings['slider_spacing_tablet_extra']['size'] : $gapXl;
		$gapMd  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? $settings['slider_spacing_tablet']['size'] : $gapLg;
		$gapSm  = isset( $settings['slider_spacing_mobile_extra']['size'] ) && is_numeric( $settings['slider_spacing_mobile_extra']['size'] ) ? $settings['slider_spacing_mobile_extra']['size'] : $gapMd;
		$gapXs  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? $settings['slider_spacing_mobile']['size'] : $gapSm;
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
			'arrows_bottom'				 => !empty( $settings['arr_bottom'] ) ? $settings['arr_bottom'] : 'no'
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => 'ot-carousel ot-project-carousel',
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);

		$id_int = substr( $this->get_id_int(), 0, 3 );

		?>
		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
			<div class="owl-carousel owl-theme">
				<?php 
					if( $settings['project_cat'] ){
		                $args = array(	                    
		                    'post_type' => 'ot_portfolio',
		                    'post_status' => 'publish',
		                    'posts_per_page' => $settings['project_num'],
		                    'tax_query' => array(
		                        array(
		                            'taxonomy' => 'portfolio_cat',
		                            'field' => 'slug',
		                            'terms' => $settings['project_cat'],
		                        ),
		                    ),              
		                );
		            }else{
		                $args = array(
		                    'post_type' => 'ot_portfolio',
		                    'post_status' => 'publish',
		                    'posts_per_page' => $settings['project_num'],
		                );
		            }			
					$wp_query = new \WP_Query($args);					
					while ($wp_query -> have_posts()) : $wp_query -> the_post(); 

						get_template_part( 'template-parts/content', 'project-carousel_2', array(
							'settings' => $settings,
							'id_int'   => $id_int
						));

					endwhile; wp_reset_postdata(); 
				?>
			</div>
	    </div>
	    <?php
	}

	public function get_keywords() {
		return [ 'slider', 'carousel', 'project' ];
	}

	protected function select_param_cate_project() {
	  	$category = get_terms( 'portfolio_cat' );
	  	$cat = array();
	  	foreach( $category as $item ) {
	     	if( $item ) {
	        	$cat[$item->slug] = $item->name;
	     	}
	  	}
	  	return $cat;
	}
}
// After the Sandbox_Portfolio_Slider_2 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Portfolio_Slider_2() );