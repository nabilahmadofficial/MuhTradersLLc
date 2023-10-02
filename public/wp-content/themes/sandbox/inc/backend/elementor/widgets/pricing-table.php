<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Pricing Table
 */
class Sandbox_Pricing_Table extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-pricing-table';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Pricing Table', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-price-table';
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
				'label' => __( 'Title & Price', 'sandbox' ),
			]
		);

		$this->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				]
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View Icon', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'sandbox' ),
					'stacked' => __( 'Stacked', 'sandbox' ),
				],
				'default' => 'default',
				'prefix_class' => 'ot-view-',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Digital', 'sandbox' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'heading_tag',
			[
				'label' => __( 'Title HTML Tag', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h4',
				'condition'	=> [
					'title!'	=> ''
				]
			]
		);

		$this->add_control(
			'currency_symbol',
			[
				'label' => __( 'Currency Symbol', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'sandbox' ),
					'dollar' => '&#36; ' . _x( 'Dollar', 'Currency', 'sandbox' ),
					'euro' => '&#128; ' . _x( 'Euro', 'Currency', 'sandbox' ),
					'baht' => '&#3647; ' . _x( 'Baht', 'Currency', 'sandbox' ),
					'franc' => '&#8355; ' . _x( 'Franc', 'Currency', 'sandbox' ),
					'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency', 'sandbox' ),
					'krona' => 'kr ' . _x( 'Krona', 'Currency', 'sandbox' ),
					'lira' => '&#8356; ' . _x( 'Lira', 'Currency', 'sandbox' ),
					'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency', 'sandbox' ),
					'peso' => '&#8369; ' . _x( 'Peso', 'Currency', 'sandbox' ),
					'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency', 'sandbox' ),
					'real' => 'R$ ' . _x( 'Real', 'Currency', 'sandbox' ),
					'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency', 'sandbox' ),
					'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency', 'sandbox' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency', 'sandbox' ),
					'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency', 'sandbox' ),
					'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency', 'sandbox' ),
					'won' => '&#8361; ' . _x( 'Won', 'Currency', 'sandbox' ),
					'custom' => __( 'Custom', 'sandbox' ),
				],
				'default' => 'dollar',
			]
		);
		$this->add_control(
			'currency_symbol_custom',
			[
				'label' => __( 'Custom Symbol', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'currency_symbol' => 'custom',
				],
			]
		);

		$this->start_controls_tabs( 'prices_period' );
		$this->start_controls_tab(
			'tab_period_1',
			[
				'label' => __( 'Period 1', 'sandbox' ),
			]
		);
		$this->add_control(
			'price_period_1',
			[
				'label' => __( 'Price', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '15', 'sandbox' ),
			]
		);
		$this->add_control(
			'period_1',
			[
				'label'       => __( 'Period', 'sandbox' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '/m', 'sandbox' ),
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_period_2',
			[
				'label' => __( 'Period 2', 'sandbox' ),
			]
		);
		$this->add_control(
			'price_period_2',
			[
				'label' => __( 'Price', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '155', 'sandbox' ),
			]
		);
		$this->add_control(
			'period_2',
			[
				'label'       => __( 'Period', 'sandbox' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '/y', 'sandbox' ),
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			[
				'label' => __( 'Features', 'sandbox' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_features_text',
			[
				'label' => __( 'Text', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'List Item', 'sandbox' ),
			]
		);

		$default_icon = [
			'value' => 'uil uil-check',
			'library' => 'fa-solid',
		];

		$repeater->add_control(
			'selected_item_icon',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default' => $default_icon,
			]
		);

		$repeater->add_control(
			'item_icon_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'item_icon_bgcolor',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} li{{CURRENT_ITEM}} i, 
					 {{WRAPPER}} li{{CURRENT_ITEM}} svg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'features_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_features_text' => __( 'List Item #1', 'sandbox' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_features_text' => __( 'List Item #2', 'sandbox' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_features_text' => __( 'List Item #3', 'sandbox' ),
						'selected_item_icon' => $default_icon,
					],
				],
				'title_field' => '{{{ item_features_text }}}',
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer',
			[
				'label' => __( 'Button', 'sandbox' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Choose Plan', 'sandbox' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => __( 'Link', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'sandbox' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_table_section',
			[
				'label' => __( 'Table Box', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
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
				'default' => 'center',
				'toggle'  => false,
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table' => 'text-align: {{VALUE}};',
				],
				'render_type' => 'template',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'prices_border',
				'selector' => '{{WRAPPER}} .ot-pricing-table',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'prices_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'prices_shadow',
				'selector' => '{{WRAPPER}} .ot-pricing-table',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		//Icon
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'conditions'	=>[
					'relation' => 'or',
					'terms' => [
				        [
				            'name' => 'icon_font[value]',
				            'operator' => '!=',
				            'value' => ''
				        ]
				    ]
				]
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'conditions'	=>[
					'relation' => 'or',
					'terms' => [
				        [
				            'name' => 'icon_font[value]',
				            'operator' => '!=',
				            'value' => ''
				        ]
				    ]
				]
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions'	=>[
					'relation' => 'or',
					'terms' => [
				        [
				            'name' => 'icon_font[value]',
				            'operator' => '!=',
				            'value' => ''
				        ]
				    ]
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ot-pricing-table__icon svg,
					 {{WRAPPER}} .ot-pricing-table__icon svg .lineal-fill' => 'fill: {{VALUE}};'
				],
				'condition'	=>[
					'icon_font[value]!'	=> ''
				],
			]
		);

		$this->add_control(
			'icon_bgcolor',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__icon' => 'background-color: {{VALUE}};',
				],
				'conditions'	=>[
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'and',
							'terms' => [
								[
						            'name' => 'icon_font[value]',
						            'operator' => '!=',
						            'value' => ''
						        ],
						        [
						            'name' => 'icon_view',
						            'operator' => '==',
						            'value' => 'stacked'
						        ],
							]
						]
				    ]
				]
			]
		);
		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'conditions'	=>[
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'and',
							'terms' => [
						        [
						            'name' => 'icon_font[value]',
						            'operator' => '!=',
						            'value' => ''
						        ],
						        [
						            'name' => 'icon_view',
						            'operator' => '==',
						            'value' => 'stacked'
						        ],
							]
						]
				    ]
				]
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions'	=>[
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'and',
							'terms' => [
								[
						            'name' => 'icon_font[value]',
						            'operator' => '!=',
						            'value' => ''
						        ],
						        [
						            'name' => 'icon_view',
						            'operator' => '==',
						            'value' => 'stacked'
						        ],
							]
						]
				    ]
				],
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'condition'	=>[
					'title!'	=> ''
				]
			]
		);
		$this->add_control(
			'title_reverse',
			[
				'label'   => esc_html__( 'Reverse Title/Price', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'render_type' => 'template',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>[
					'title!'	=> ''
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__title' => 'color: {{VALUE}};',
				],
				'condition'	=>[
					'title!'	=> ''
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table__title',
				'condition'	=>[
					'title!'	=> ''
				],
			]
		);

		//Price
		$this->add_control(
			'heading_price',
			[
				'label' => __( 'Price', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'price_space',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__prices' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__prices' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table__prices, {{WRAPPER}} .price-value',
			]
		);
		
		//Features
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Features', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'features_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-features-item + .pricing-features-item' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ficon_size',
			[
				'label' => __( 'Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_icon_color',
			[
				'label' => __( 'Icon Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} i' => 'color: {{VALUE}};',
					'{{WRAPPER}} svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'features_icon_bgcolor',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-icon-list-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'features_color',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-features-text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'features_typography',
				'selector' => '{{WRAPPER}} .pricing-features-text',
			]
		);

		$this->end_controls_section();

		//Button
		$this->start_controls_section(
			'btn_style_section',
			[
				'label' => __( 'Button', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'label' => __( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .octf-btn',
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
			'button_text_color',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} .octf-btn',
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
			'hover_color',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'btn_bg_hover_color',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow_hover',
				'selector' => '{{WRAPPER}} .octf-btn:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'dollar' => '&#36;',
			'euro' => '&#128;',
			'franc' => '&#8355;',
			'pound' => '&#163;',
			'ruble' => '&#8381;',
			'shekel' => '&#8362;',
			'baht' => '&#3647;',
			'yen' => '&#165;',
			'won' => '&#8361;',
			'guilder' => '&fnof;',
			'peso' => '&#8369;',
			'peseta' => '&#8359',
			'lira' => '&#8356;',
			'rupee' => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real' => 'R$',
			'krona' => 'kr',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$symbol = '';

		if ( ! empty( $settings['currency_symbol'] ) ) {
			if ( 'custom' !== $settings['currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}

		$heading_tag = $settings['heading_tag'];
		$this->add_render_attribute( 'title', 'class', 'ot-pricing-table__title' );

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'button_detail', $settings['btn_link'] );
		}
		$this->add_render_attribute( 'button_detail', 'class', 'octf-btn octf-btn-primary' );
		$class_reverse = empty( $settings['title_reverse'] ) ? 'flex-column' : 'flex-column-reverse';
		?>

		<div class="ot-pricing-table">
			<div class="ot-pricing-table__inner">

				<?php if( !empty( $settings['icon_font']['value'] ) ) : ?>
					<div class="ot-pricing-table__icon"> 
						<?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>

				<div class="dflex <?php echo esc_attr( $class_reverse ) ?>">
					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<<?php Utils::print_validated_html_tag( $settings['heading_tag'] );?> <?php $this->print_render_attribute_string( 'title' ); ?>>
						<?php $this->print_unescaped_setting( 'title' ); ?>
						</<?php Utils::print_validated_html_tag( $settings['heading_tag'] ); ?>>
					<?php endif; ?>

					<div class="ot-pricing-table__prices">
						<div class="price-inner justify-content-<?php echo $settings['align']; ?> price-show">
							<span class="price-currency"><?php echo $symbol; ?></span>
							<span class="price-value"><?php $this->print_unescaped_setting( 'price_period_1' ); ?></span>
							<span class="price-duration"><?php $this->print_unescaped_setting( 'period_1' ); ?></span>
						</div>
						<div class="price-inner justify-content-<?php echo $settings['align']; ?> price-hide price-hidden">
							<span class="price-currency"><?php echo $symbol; ?></span>
							<span class="price-value"><?php $this->print_unescaped_setting( 'price_period_2' ); ?></span>
							<span class="price-duration"><?php $this->print_unescaped_setting( 'period_2' ); ?></span>
						</div>
					</div>
				</div>
				
				<?php if( !empty($settings['features_list']) ){ ?>
				<ul class="ot-pricing-table__features-list ot-icon-list-wrapper ot-view-stacked unstyle">
					<?php foreach ( $settings['features_list'] as $index => $item ) : 
						$item_key = $index + 1;
						$this->add_render_attribute( [
							$item_key => [
								'class' => [
									'pricing-features-item',
									'ot-icon-list-item',
									'elementor-repeater-item-' . $item['_id'],
								],
							],
						] );
					?>
					<li <?php $this->print_render_attribute_string( $item_key ); ?>>
						<span class="pricing-features-icon ot-icon-list-icon">
						<?php Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
						<span class="pricing-features-text ot-icon-list-text"><?php $this->print_unescaped_setting( 'item_features_text', 'features_list', $index );?></span>
					</li>
					<?php endforeach ?>
				</ul>
				<?php } ?>

				<div class="ot-pricing-table__footer">
					<?php if( !empty($settings['button_text']) ){ ?><a <?php $this->print_render_attribute_string( 'button_detail' );?>><?php $this->print_unescaped_setting( 'button_text' ); ?></a><?php } ?>
				</div>
			</div>
		</div>

	    <?php
	}

}
// After the Sandbox_Pricing_Table class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Pricing_Table() );