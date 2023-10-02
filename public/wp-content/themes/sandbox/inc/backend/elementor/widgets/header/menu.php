<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu
 */
class Sandbox_Menu extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imenu';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Nav Menu', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu', 'sandbox' ),
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label' => esc_html__( 'Select Menu', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => $menus,
				'default' => array_keys( $menus )[0],
				'save_default' => true,

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
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*** Style ***/
		//menu parents
		$this->start_controls_section(
			'style_menu_section',
			[
				'label' => __( 'Menu Parents', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li > a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_hover_color',
			[
				'label' => __( 'Text Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li > a:hover, 
					 {{WRAPPER}} .main-navigation > ul > li.dropdown > a:hover:after,
					 {{WRAPPER}} .main-navigation > ul > li.menu-item-has-children > a:hover:after,
					 {{WRAPPER}} .main-navigation > ul > li > a.mPS2id-highlight' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .main-navigation ul, {{WRAPPER}} .elementor-icon-list-text',
			]
		);
		$this->add_responsive_control(
			'menu_padding',
			[
				'label' => 'Padding',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .main-navigation > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
	        'is_arrow',
	        [
	            'label'        => __( 'Arrows', 'sandbox' ),
	            'type'         => Controls_Manager::SWITCHER,
	            'default' 	   => 'yes',
	        ]
	    );
	    $this->add_control(
			'arrow_color',
			[
				'label' => __( 'Arrow Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation > ul > li.dropdown > a:after,
					 {{WRAPPER}} .main-navigation > ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				],
				'condition' => [ 
					'is_arrow' => 'yes' 
				],
			]
		);

		$this->end_controls_section();

		//menu child
		$this->start_controls_section(
			'style_smenu_section',
			[
				'label' => __( 'Dropdown Menus', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'smenu_width',
			[
				'label' => __( 'Width', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li ul' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'smenu_top',
			[
				'label' => __( 'Top', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li:hover > ul' => 'transform: translateY({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .main-navigation ul li ul ul' => 'top: calc(-20px - {{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'layout_menu' => 'horizontal'
				]
			]
		);
		$this->add_control(
			'bg_s_color',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_s_color',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul a, 
					 {{WRAPPER}} .main-navigation ul ul > li.menu-item-has-children > a:after,
					 {{WRAPPER}} .main-navigation ul ul > li.dropdown > a:after' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_s_hover_color',
			[
				'label' => __( 'Text Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul a:hover, 
					 {{WRAPPER}} .main-navigation ul ul li.dropdown > a:hover:after,
					 {{WRAPPER}} .main-navigation ul ul li.menu-item-has-children > a:hover:after, 
					 {{WRAPPER}} .elementor-icon-list-text:hover, 
					 {{WRAPPER}} ul li h5' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'smenu_typography',
				'selector' => '{{WRAPPER}} .main-navigation ul ul a, {{WRAPPER}} .elementor-icon-list-text',
			]
		);
		$this->end_controls_section();

		//menu scroll
		$this->start_controls_section(
			'style_scmenu_section',
			[
				'label' => __( 'Menu Scroll', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_sccolor',
			[
				'label' => __( 'Text Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled > ul > li > a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_hover_sccolor',
			[
				'label' => __( 'Text Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled > ul > li > a:hover, 
					 {{WRAPPER}} .scrolled > ul > li.dropdown > a:after,
					 {{WRAPPER}} .scrolled > ul > li.dropdown > a:hover:after
					 {{WRAPPER}} .scrolled > ul > li.menu-item-has-children > a:after, 
					 {{WRAPPER}} .scrolled > ul > li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_menus(){

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
   }

	protected function render() {
		$settings = $this->get_settings_for_display();
		$active_mmenu = in_array('ot_mega-menu/ot_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins')));
		?>
			
	    	<nav id="site-navigation" class="main-navigation hitem <?php if($settings['is_arrow'] != 'yes') echo 'a-none'; ?>">			
				<?php
					wp_nav_menu( array(
						'menu' 			 => $settings['nav_menu'],
						'menu_id'        => 'primary-menu',
						'container'      => 'ul',
						'theme_location' => '__no_such_location',
    					'fallback_cb'    => '__return_empty_string', 
    					'walker'         => $active_mmenu ? new \Ot_Mega_Menu_Walker() : '',
					) );
				?>
			</nav>
			
	    <?php
	}

}
// After the Sandbox_Menu class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Menu() );