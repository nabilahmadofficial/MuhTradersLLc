<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Compare Pricing Table
 */
class Sandbox_Compare_Pricing_Table extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-compare-table';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Compare Pricing Table', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-table';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		//Content Compare Pricing Table
		$this->start_controls_section(
			'section_general',
			[
				'label' => __('General', 'sandbox')
			]
		);
		$this->add_control(
			'table_count',
			[
				'label'       => __('Plan', 'sandbox'),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 3,
				'min'         => 2,
				'max'         => 5,
				'placeholder' => __('Plan', 'sandbox'),
				'description' => __( 'Min: 2 - Max: 5', 'sandbox' ),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_feature',
			[
				'label' => __('Feature Title', 'sandbox')
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'legend_feature_text',
			[
				'label'       => __('Feature', 'sandbox'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Feature', 'sandbox'),
				'placeholder' => __('Enter your feature', 'sandbox'),
			]
		);

		$this->add_control(
			'features_text',
			[
				'label'      => __('Features', 'sandbox'),
				'type'       => Controls_Manager::REPEATER,
				'show_label' => true,
				'default'    => [
					[
						'legend_feature_text' => __('Adding time manually', 'sandbox'),
					],
					[
						'legend_feature_text' => __('Timeline', 'sandbox'),
					],
					[
						'legend_feature_text' => __('Tracking time', 'sandbox'),
					],
				],
				'fields'     =>  $repeater->get_controls(),
				'title_field' => '{{{ legend_feature_text }}}',
			]
		);
		$this->end_controls_section();

		$this->add_tables();
	}

	function add_tables()
	{

		$repeater = new Repeater();

		$repeater->add_control(
			'table_content_type',
			[
				'label'       => __('Content', 'sandbox'),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'uil uil-check' => [
						'title' => __('Yes', 'sandbox'),
						'icon'  => 'uil uil-check',
					],
					'uil uil-minus' => [
						'title' => __('No', 'sandbox'),
						'icon'  => 'uil uil-minus',
					],
					'text'        => [
						'title' => __('Text', 'sandbox'),
						'icon'  => 'uil uil-font',
					]
				],
				'default'     => 'uil uil-check',
			]
		);
		$repeater->add_control(
			'feature_text',
			[
				'label'       => __('Feature', 'sandbox'),
				'type'        => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default'     => __('Feature', 'sandbox'),
				'condition'   => [
					'table_content_type' => 'text'
				]
			]
		);
		for ($i = 1; $i < 6; $i++) {
			$this->start_controls_section(
				'section_table_' . $i,
				[
					'label'     => __('Plan ' . $i, 'sandbox'),
					'operator'  => '>',
					'condition' => [
						'table_count' => $this->add_condition_value($i),
					]
				]
			);
			$this->add_control(
				'table_title_' . $i,
				[
					'label'       => __('Title', 'sandbox'),
					'type'        => Controls_Manager::TEXT,
					'default'     => __('Digital', 'sandbox'),
				]
			);
			$this->add_control(
				'table_price_' . $i,
				[
					'label'       => __('Price', 'sandbox'),
					'type'        => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default'     => __('$155', 'sandbox'),
				]
			);
			
			$this->add_control(
				'label_link_trial_' . $i,
				[
					'label' => 'Label',
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( 'Choose Plan', 'sandbox' ),
				]
			);

			$this->add_control(
				'link_trial_' . $i,
				[
					'label' => __( 'Link', 'sandbox' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'sandbox' ),
					'default'	=> [
						'url'	=> '#'
					]
				]
			);

			$this->add_control(
				'feature_items_' . $i,
				[
					'label'      => __('Features', 'sandbox'),
					'type'       => Controls_Manager::REPEATER,
					'show_label' => true,
					'default'    => [
						[
							'table_content_type' => 'uil uil-check',
						],
						[
							'table_content_type' => 'uil uil-check',
						],
						[
							'table_content_type' => 'uil uil-minus',
						],
					],
					'fields'     =>  $repeater->get_controls(),
				]
			);


			$this->add_control(
				'override_style_' . $i,
				[
					'label'        => __('Override Style', 'sandbox'),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'no',
					'separator'    => 'before'
				]
			);

			$this->add_control(
				'custom__heading_' . $i,
				[
					'label'     => __('Heading', 'sandbox'),
					'type'      => Controls_Manager::HEADING,
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'heading_text_color_custom_' . $i,
				[
					'label'     => __('Color', 'sandbox'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ot-cpt-table-' . $i . '.ot-cpt-heading' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'heading_text_bg_color_custom_' . $i,
				[
					'label'     => __('Background Color', 'sandbox'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ot-cpt-table-' . $i . '.ot-cpt-heading' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'custom_price_heading_' . $i,
				[
					'label'     => __('Price', 'sandbox'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'custom_price_color_' . $i,
				[
					'label'     => __('Price Color', 'sandbox'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ot-cpt-table-' . $i . ' .ot-cpt-price' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'custom_table_items_' . $i,
				[
					'label'     => __('Features', 'sandbox'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'custom_table_item_color_' . $i,
				[
					'label'     => __('Color', 'sandbox'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . '.ot-cpt-icon-text' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'custom_features_check_color_' . $i,
				[
					'label'     => __('Check Color', 'sandbox'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ot-cpt-wrapper td.ot-cpt-table-' . $i . ' span.ot-flaticon-check-1' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'custom_features_close_color_' . $i,
				[
					'label'     => __('Close Color', 'sandbox'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ot-cpt-wrapper td.ot-cpt-table-' . $i . ' span.ot-flaticon-close' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->add_control(
				'custom_button_heading_' . $i,
				[
					'label'     => __('Button', 'sandbox'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->add_control(
				'btn_trial_custom_text_color' . $i,
				[
					'label' => __( 'Text Color', 'sandbox' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . ' .octf-btn.--price-link-trial' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->add_control(
				'btn_trial_custom_bg' . $i,
				[
					'label' => __( 'Background Color', 'sandbox' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . ' .octf-btn.--price-link-trial' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->add_control(
				'btn_trial_custom_border' . $i,
				[
					'label' => __( 'Border Color', 'sandbox' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . ' .octf-btn.--price-link-trial' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);
			$this->add_control(
				'btn_trial_custom_text_hcolor' . $i,
				[
					'label' => __( 'Text Hover', 'sandbox' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . ' .octf-btn.--price-link-trial:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->add_control(
				'btn_trial_custom_hbg' . $i,
				[
					'label' => __( 'Background Hover', 'sandbox' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . ' .octf-btn.--price-link-trial:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->add_control(
				'btn_trial_custom_hborder' . $i,
				[
					'label' => __( 'Border Hover', 'sandbox' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} td.ot-cpt-table-' . $i . ' .octf-btn.--price-link-trial:hover' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'override_style_' . $i => 'yes',
					]
				]
			);

			$this->end_controls_section();
		}

		//General
		$this->start_controls_section(
			'section_general_style',
			[
				'label' => __('General', 'sandbox'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'odd_color',
			[
				'label'     => __('Odd Row Background Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} tbody > tr:nth-of-type(odd) > *' => '--sandbox-table-accent-bg: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'even_color',
			[
				'label'     => __('Even Row Background Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} tbody > tr:nth-of-type(even) > *' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __('Padding', 'sandbox'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .table > :not(caption) > * > *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'table_border',
				'label'       => __('Border', 'sandbox'),
				'selector'    => '{{WRAPPER}} .table > :not(caption) > * > *',
				'label_block' => true,
			]
		);
		$this->end_controls_section();

		//Header Table
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => __('Plan Title', 'sandbox'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'plan_title_bg_color',
			[
				'label'     => __('Background Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-cpt-header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_plan_title' );

		$this->start_controls_tab(
			'plan_title_title',
			[
				'label' => __( 'Title', 'sandbox' ),
			]
		);
		$this->add_responsive_control(
			'plan_title_space',
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
					'{{WRAPPER}} .ot-cpt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'plan_title_color',
			[
				'label'     => __('Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-cpt-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plan_title_typography',
				'selector' => '{{WRAPPER}} .ot-cpt-title',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'plan_title_price',
			[
				'label' => __( 'Price / Period', 'sandbox' ),
			]
		);
		$this->add_control(
			'plan_price_color',
			[
				'label'     => __('Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-cpt-price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plan_price_typography',
				'selector' => '{{WRAPPER}} .ot-cpt-price',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Feature
		$this->start_controls_section(
			'section_feature_style',
			[
				'label' => __('Feature', 'sandbox'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __('Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .table, 
					 {{WRAPPER}} tbody > tr:nth-of-type(odd) > *' => '--sandbox-table-color: {{VALUE}}; --sandbox-table-striped-color: {{VALUE}} ',
				],
			]
		);
		$this->add_control(
			'features_check_color',
			[
				'label'     => __('Check Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-cpt-icon-text .uil-check' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'features_check_bgcolor',
			[
				'label'     => __('Check Background Color', 'sandbox'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-cpt-icon-text .uil-check' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_text_align',
			[
				'label'     => __('Title Alignment', 'sandbox'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __('Left', 'sandbox'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'sandbox'),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __('Right', 'sandbox'),
						'icon'  => 'eicon-text-align-right',
					]
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ot-cpt-feature' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .table > tbody',
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
				'label' => 'Padding',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

	function add_condition_value($j)
	{
		$value = [];
		for ($i = $j; $i < 6; $i++) {
			$value[] = $i;
		}

		return $value;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('ot-cpt-wrapper', 'class', 'ot-cpt-wrapper table-responsive');

		?>

		<div <?php $this->print_render_attribute_string('ot-cpt-wrapper'); ?>>

			<table class="table table-borderless table-striped text-center">
				<thead>
					<tr class="ot-cpt-header">
						<th class="w-25"></th>

						<?php
						for ($i = 1; $i <= $settings['table_count']; $i++) {
							
							echo '<th class="ot-cpt-heading ot-cpt-table-' . $i . '">';
							echo '<div class="ot-cpt-title h4">' . $settings['table_title_' . $i] . '</div>';
							echo '<div class="ot-cpt-price">' . $settings['table_price_' . $i] . '</div>';
							echo '</th>';
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php

					for ($x = 1; $x <= count($settings['features_text']); $x++) {
						echo '<tr>';
						echo '<td  class="ot-cpt-feature text-left">';
							echo $settings['features_text'][$x - 1]['legend_feature_text'];
						echo '</td>';

						for ($j = 1; $j <= $settings['table_count']; $j++) {
							echo '<td class="ot-cpt-icon-text ot-cpt-table-' . $j . '">';
							if (count($settings['feature_items_' . $j]) >= $x) {
								if ($settings['feature_items_' . $j][$x - 1]['table_content_type'] !== 'text') {
									if ($settings['feature_items_' . $j][$x - 1]['table_content_type'] == 'uil uil-minus') {
										echo '-';
									} else {
										echo '<i class="uil uil-check"></i>';
									}
								} else {
									echo $settings['feature_items_' . $j][$x - 1]['feature_text'];
								}
							} else {
								echo '';
							}
							echo '</td>';
						}
						echo '</tr>';
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th class="w-25"></th>
						<?php 
						for ($j = 1; $j <= $settings['table_count']; $j++) {

							if ( !empty( $settings['link_trial_' . $j]['url'] ) ) {
								$this->add_link_attributes('button_buy_now_' . $j, $settings['link_trial_' . $j]);
							}
							$this->add_render_attribute('button_buy_now_' . $j, 'class', 'octf-btn octf-btn-soft');

							echo '<th class="ot-cpt-btn ot-cpt-table-' . $j . '">';
							if ($settings['label_link_trial_' . $j] !== '') {
								echo '<a ' . $this->get_render_attribute_string('button_buy_now_' . $j) . '>' . $settings['label_link_trial_' . $j] . '</a>';
							}
							echo '</th>';
						}
						?>
					</tr>
				</tfoot>
			</table>
		</div>
	<?php
	}

}
// After the Sandbox_Compare_Pricing_Table class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Compare_Pricing_Table() );