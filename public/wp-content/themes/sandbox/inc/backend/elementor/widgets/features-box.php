<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Sandbox Features Box
 */
class Sandbox_Features_Box extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-features-box';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Features Box', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-featured-image';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Features Box', 'sandbox' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Products', 'sandbox' ),
				'label_block' => true,
			]
		);

	    $this->add_control(
	       'features_image',
	        [
	            'label' => esc_html__( 'Photo', 'sandbox' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
	    );

	    $this->add_control(
			'caption_hover',
			[
				'label' => __( 'Caption Hover', 'sandbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'View Detail', 'sandbox' ),
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'features_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'sandbox' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'sandbox' ),
				'default'	=> [
					'url'	=> '#'
				],
			]
		);
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Genaral', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-features-box' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .features-image img' => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-top-right-radius: {{SIZE}}{{UNIT}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .ot-features-box',
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .features-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-content h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .features-content h3',
			]
		);

		// Overlay
		$this->add_control(
			'heading_overlay',
			[
				'label' => __( 'Overlay', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay span.bg' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'caption_color',
			[
				'label' => __( 'Caption Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .overlay h5',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title = $settings['title'];
		$is_link = !empty( $settings['link']['url'] );

		if ( $is_link ) {
			$this->add_link_attributes( 'features-box', $settings['link'] );
		}
		?>

		<div class="ot-features-box card">
			<figure class="features-image card-img-top overlay">
				<?php if( $is_link ){ ?><a <?php $this->print_render_attribute_string( 'features-box' ); ?>><?php } ?>
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'features_image_size', 'features_image' ); ?>
					<span class="bg"></span>
				<?php if( $is_link ){ ?></a><?php } ?>

				<?php if( !empty( $settings['caption_hover'] ) ){ ?> 
				<figcaption>
					<h5 class="from-top mb-0"><?php $this->print_unescaped_setting( 'caption_hover' ); ?></h5>
				</figcaption>
				<?php } ?>
			</figure>
			<?php if( !empty ( $title ) ){ ?>
			<div class="features-content card-body">
				<h3 class="mb-0"><?php $this->print_unescaped_setting( 'title' ); ?></h3>
			</div>
			<?php } ?>
	    </div>

	    <?php
	}

}
// After the Sandbox_Features_Box class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Features_Box() );