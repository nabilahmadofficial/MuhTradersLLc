<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Images Slider
 */
class Sandbox_Images_Slider extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-images-slider';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Images Slider', 'sandbox' );
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

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image', 'sandbox' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Name', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'sandbox' ),
			]
		);
		
		$repeater->add_control(
			'image_item',
			[
				'label' => __( 'Image', 'sandbox' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		
		$repeater->add_control(
			'link_to',
			[
				'label' => __( 'Link', 'sandbox' ),
				'type' => Controls_Manager::URL,
			]
		);
		$this->add_control(
		    'images_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		        	[
			        	'title'	  => __( 'Image 1', 'sandbox' ),
						'image_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Image 2', 'sandbox' ),
						'image_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Image 3', 'sandbox' ),
						'image_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_carousel_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		/* Option Slider */

		$this->add_control(
			'heading_option_slider',
			[
				'label' => esc_html__( 'Slider Option', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

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
			'center_mode',
			[
				'label' => __( 'Center Mode', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'image_popup',
			[
				'label' => __( 'Image Gallery', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
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
						'min' => 0,
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

		//Style

		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_vertical_align',
			[
				'label' => __( 'Vertical Align', 'sandbox' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Start', 'sandbox' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'sandbox' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'End', 'sandbox' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'tshow!' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .owl-stage' => 'display: flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .owl-stage >*' => 'flex-shrink: 0;',
				],
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-images-carousel figure img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-images-carousel figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-images-carousel figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .ot-images-carousel figure img',
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
					'{{WRAPPER}} .owl-nav button,
					 {{WRAPPER}} figure .item-link' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .owl-nav button,
					 {{WRAPPER}} figure .item-link' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .owl-nav button:hover,
					 {{WRAPPER}} figure .item-link:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .owl-nav button:hover,
					 {{WRAPPER}} figure .item-link:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['images_slider'] ) ) {
			return;
		}
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
			'center'      		   		 => $settings['center_mode'] ? $settings['center_mode'] : 'no' ,
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
			'arrows_bottom'				 => !empty( $settings['arr_bottom'] ) ? $settings['arr_bottom'] : 'no'
		];

		$id_int = substr( $this->get_id_int(), 0, 3 );

		$this->add_render_attribute(
			'slides', [
				'class'               => 'ot-carousel ot-images-carousel',
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);

		?>
		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
			<div class="owl-carousel owl-theme">

				<?php
				foreach ( $settings['images_slider'] as $key => $item ) {

					$title = $item['title'];
					$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['image_item']['id'], 'image_carousel_size', $settings );

					if ( ! $image_url && isset( $item['image_item']['url'] ) ) {
						$image_url = $item['image_item']['url'];
					}
	            	$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $title ) . '">';
	            	$link_tag = '';
	            	$link = ! empty( $item['link_to']['url'] ) && empty( $settings['image_popup'] );
		            if ( $link ) {
						$this->add_render_attribute( 'link' . $key, 'class', 'item-link' );
						$this->add_link_attributes( 'link' . $key, $item['link_to'] );
						$link_tag = '<a '.$this->get_render_attribute_string('link' . $key).'><i class="uil uil-link"></i>';
					}

					if( !empty( $settings['image_popup'] ) ){
						$this->add_render_attribute( 'link' . $key, 'class', 'item-link' );
						$this->add_render_attribute( 'link' . $key, 'href', $image_url );
						$this->add_render_attribute( 'link' . $key, 'data-glightbox', '' );
						$this->add_render_attribute( 'link' . $key, 'data-gallery', 'gallery-group-' . $id_int );
						$link_tag = '<a '.$this->get_render_attribute_string('link' . $key).'><i class="uil uil-focus-add"></i>';
					}
		            
					$slide_html = '<figure>' . $image_html . $link_tag;

					if( $link || !empty( $settings['image_popup'] ) ){
						$slide_html .= '</a>';
					}

					$slide_html .= '</figure>';

					if( $image_url ){
						$slides[] = $slide_html;
					}
				}
				echo implode( '', $slides );
				?>
			</div>
	    </div>
		<?php 
		
	}

	public function get_keywords() {
		return [ 'slider', 'carousel', 'logo', 'client' ];
	}

}
// After the Sandbox_Images_Slider class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Images_Slider() );