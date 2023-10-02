<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Accordions 
 */
class Ronmi_Accordions2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-accordions-wicon';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Accordions With Icon', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-accordion';
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
				'label' => __( 'Accordions', 'sandbox' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'acc_title',
			[
				'label' => __( 'Title & Content', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'sandbox' ),
				'placeholder' => __( 'Accordion Title', 'sandbox' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'acc_content',
			[
				'label' => __( 'Content', 'sandbox' ),
				'default' => __( 'Accordion Content', 'sandbox' ),
				'placeholder' => __( 'Accordion Content', 'sandbox' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'icon_title',
			[
				'label' => __( 'Icon Title', 'sandbox' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'ot_accs',
			[
				'label' => __( 'Accordion Items', 'sandbox' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'acc_title' => __( 'Accordion #1', 'sandbox' ),
						'acc_content' => __( 'We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'sandbox' ),
						'icon_title'	=> [
							'value' => 'fas fa-star',
							'library' => 'fa-solid',
						]
					],
					[
						'acc_title' => __( 'Accordion #2', 'sandbox' ),
						'acc_content' => __( 'We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'sandbox' ),
						'icon_title'	=> [
							'value' => 'fas fa-star',
							'library' => 'fa-solid',
						]
					],
				],
				'title_field' => '{{{ acc_title }}}',
			]
		);
		
		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'h5',
			]
		);
		$this->add_control(
			'default_active',
			[
				'label'   => esc_html__( 'Default Active', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'item_active',
			[
				'label' => esc_html__( 'Item Active', 'sandbox' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'default_active' => 'yes'
				]
			]
		);
		
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Accordions', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'bg_acc',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_acc_active',
			[
				'label' => __( 'Background Active', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item.current' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'acc_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Icon
		$this->start_controls_section(
			'style_icon',
			[
				'label' => __( 'Icon', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'icon_title_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_title_size',
			[
				'label' => __( 'Size', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-acc-item__icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'style_title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item:not(.current) .ot-acc-item__title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color Active', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item.current .ot-acc-item__title, 
					 {{WRAPPER}} .ot-acc-item:hover .ot-acc-item__title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-acc-item__title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'style_content',
			[
				'label' => __( 'Content', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc__content-inner' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .acc__content-inner',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acc__content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrapper', 'class', [ 'ot-accordions-wrapper' ] );
		?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $settings['ot_accs'] ) : foreach ( $settings['ot_accs'] as $key => $accs ) { 
				$tab_count = $key + 1;
				$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $key );
				$this->add_render_attribute( $tab_title_setting_key, [
					'class' => [ 'ot-acc-item__title', 'flex-middle' ],
					'data-tab' => $tab_count,
					'role' => 'tab',
					'data-default' => $key + 1 == $settings['item_active'] ? 'yes' : ''
				] );
			?>
			<div class="ot-acc-item with-icon">
				<<?php echo $settings['header_size']; ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?> >

					<?php if ( ! empty( $accs['icon_title']['value'] ) ) : ?>
					<span class="ot-acc-item__icon"><?php Icons_Manager::render_icon( $accs['icon_title'], [ 'aria-hidden' => 'true' ] ); ?></span>
					<?php endif; ?>

					<?php echo $accs['acc_title']; ?> 

				</<?php echo $settings['header_size']; ?>>
				<div class="ot-acc-item__content">
					<div class="acc__content-inner"><?php echo $accs['acc_content']; ?></div>
				</div>
			</div>
			<?php } endif; ?>
	    </div>

	    <?php
	}

}
// After the Ronmi_Accordions2 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Ronmi_Accordions2() );