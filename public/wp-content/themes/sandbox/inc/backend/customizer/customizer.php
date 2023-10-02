<?php
/**
 * Theme customizer
 *
 * @package Sandbox
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sandbox_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function sandbox_get_option( $name ) {
	global $sandbox_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'sandbox', $name );
	} elseif ( ! empty( $sandbox_customize ) ) {
		$value = $sandbox_customize->get_option( $name );
	}

	return apply_filters( 'sandbox_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function sandbox_get_option_default( $name ) {
	global $sandbox_customize;

	if ( empty( $sandbox_customize ) ) {
		return false;
	}

	return $sandbox_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function sandbox_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'sandbox_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function sandbox_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'sandbox',
	);

	$panels = array(
		'general'     => array(
			'priority' => 5,
			'title'    => esc_html__( 'General', 'sandbox' ),
		),
        /* popup form */
        'popup_form'       => array(
            'title'       => esc_html__( 'Popup', 'sandbox' ),
            'priority'    => 11,
        ),
        'portfolio'       => array(
            'title'       => esc_html__( 'Portfolio', 'sandbox' ),
            'priority'    => 11,
            'capability'  => 'edit_theme_options',          
        ),
	);

	$sections = array(
        /* popup */
        'mc_form'       => array(
            'title'       => esc_html__( 'Newsletter', 'sandbox' ),
            'description' => '',
            'priority'    => 11,
            'panel'       => 'popup_form',
            'capability'  => 'edit_theme_options',
        ),
        'user_form'       => array(
            'title'       => esc_html__( 'Login/Register', 'sandbox' ),
            'description' => '',
            'priority'    => 11,
            'panel'       => 'popup_form',
            'capability'  => 'edit_theme_options',
        ),
        /* portfolio */
        'portfolio_page'  => array(
            'title'       => esc_html__( 'Archive Page', 'sandbox' ),
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
            'panel'       => 'portfolio',           
        ),
        'portfolio_post'  => array(
            'title'       => esc_html__( 'Single Page', 'sandbox' ),
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
            'panel'       => 'portfolio',           
        ),
        'preload_section'     => array(
            'title'       => esc_attr__( 'Preloader', 'sandbox' ),
            'description' => '',
            'priority'    => 12,
            'capability'  => 'edit_theme_options',
        ),
		/* typography */
		'typography'           => array(
            'title'       => esc_html__( 'Typography', 'sandbox' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
		/* 404 */
		'error_404'       => array(
            'title'       => esc_html__( '404', 'sandbox' ),
            'description' => '',
            'priority'    => 16,
            'capability'  => 'edit_theme_options',
        ),
        /* color scheme */
        'color_scheme'   => array(
			'title'      => esc_html__( 'Color Scheme', 'sandbox' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		),
		/* js code */
		'script_code'   => array(
			'title'      => esc_html__( 'Google Analytics(Script Code)', 'sandbox' ),
			'priority'   => 210,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
        /* popup user */
        'user_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Popup On/Off', 'sandbox' ),
            'section'     => 'user_form',
            'default'     => 1,
            'priority'    => 1,
        ),
        'login_title'      => array(
            'type'            => 'text',
            'label'           => esc_attr__( 'Login Form', 'sandbox' ),
            'section'         => 'user_form',
            'default'         => esc_html__( 'Welcome Back', 'sandbox' ),
            'priority'        => 1,
        ),
        'login_sub'      => array(
            'type'            => 'text',
            'section'         => 'user_form',
            'default'         => esc_html__( 'Fill your email and password to sign in.', 'sandbox' ),
            'priority'        => 1,
        ),
        'regis_title'      => array(
            'type'            => 'text',
            'label'           => esc_attr__( 'Register Form', 'sandbox' ),
            'section'         => 'user_form',
            'default'         => esc_html__( 'Sign up to Sandbox', 'sandbox' ),
            'priority'        => 1,
        ),
        'regis_sub'      => array(
            'type'            => 'text',
            'section'         => 'user_form',
            'default'         => esc_html__( 'Registration takes less than a minute.', 'sandbox' ),
            'priority'        => 1,
        ),
        /* popup promo */
        'promo_switch'    => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Popup On/Off', 'sandbox' ),
            'section'     => 'mc_form',
            'default'     => 0,
            'priority'    => 1,
        ),
        'popup_img'  => array(
            'type'     => 'image',
            'section'  => 'mc_form',
            'default'  => '',
            'priority' => 1,
            'active_callback' => array(
                array(
                    'setting'  => 'promo_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'popup_title'      => array(
            'type'            => 'text',
            'section'         => 'mc_form',
            'default'         => esc_html__( 'Join the mailing list and get %10 off', 'sandbox' ),
            'priority'        => 1,
            'active_callback' => array(
                array(
                    'setting'  => 'promo_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'popup_des'      => array(
            'type'            => 'textarea',
            'section'         => 'mc_form',
            'default'         => esc_html__( 'Nullam quis risus eget urna mollis ornare vel eu leo. Donec ullamcorper nulla non metus auctor fringilla.', 'sandbox' ),
            'priority'        => 1,
            'active_callback' => array(
                array(
                    'setting'  => 'promo_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'code_form'      => array(
            'type'            => 'text',
            'description'     => esc_html__( 'Shortcode of newsletter. Ex: [mc4wp_form id="927"]', 'sandbox' ),
            'section'         => 'mc_form',
            'default'         => '',
            'priority'        => 1,
            'active_callback' => array(
                array(
                    'setting'  => 'promo_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        /* Portfolio settings */
        'portfolio_archive'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Portfolio Archive', 'sandbox' ),
            'section'     => 'portfolio_page',
            'default'     => 'archive_default',
            'priority'    => 1,
            'description' => esc_html__( 'Select page default for the portfolio archive page.', 'sandbox' ),
            'choices'     => array(
                'archive_default' => esc_attr__( 'Archive page default', 'sandbox' ),
                'archive_custom' => esc_attr__( 'Archive page custom', 'sandbox' ),
            ),
        ),
        'archive_page_custom'     => array(
            'type'        => 'dropdown-pages',  
            'label'       => esc_attr__( 'Select Page', 'sandbox' ), 
            'description' => esc_attr__( 'Choose a custom page for archive portfolio page.', 'sandbox' ), 
            'section'     => 'portfolio_page', 
            'default'     => '', 
            'priority'    => 2,         
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_custom',
                ),
            ),
        ),
        'portfolio_column'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Portfolio Columns', 'sandbox' ),
            'section'     => 'portfolio_page',
            'default'     => '3cl',
            'priority'    => 3,
            'description' => esc_html__( 'Select default column for the portfolio page.', 'sandbox' ),
            'choices'     => array(
                '2cl' => esc_attr__( '2 Column', 'sandbox' ),
                '3cl' => esc_attr__( '3 Column', 'sandbox' ),
                '4cl' => esc_attr__( '4 Column', 'sandbox' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_default',
                ),
            ),
        ),
        'portfolio_style'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Hover Style', 'sandbox' ),
            'section'     => 'portfolio_page',
            'default'     => 'style-1',
            'priority'    => 4,
            'description' => esc_html__( 'Select default style for the portfolio page.', 'sandbox' ),
            'choices'     => array(
                'style-1' => esc_attr__( 'Background Solid', 'sandbox' ),
                'style-2' => esc_attr__( 'Under Image', 'sandbox' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_default',
                ),
            ),
        ),
        'portfolio_posts_per_page' => array(
            'type'        => 'number',
            'section'     => 'portfolio_page',
            'priority'    => 5,
            'label'       => esc_html__( 'Posts per page', 'sandbox' ),          
            'description' => esc_html__( 'Change Posts Per Page for Portfolio Archive, Taxonomy.', 'sandbox' ),
            'default'     => '6',
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_default',
                ),
            ),
        ),
        'pf_nav'          => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Projects Navigation On/Off', 'sandbox' ),
            'section'     => 'portfolio_post',
            'default'     => 1,
            'priority'    => 7,
        ),
        'pf_social_share_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Social Share On/Off', 'sandbox' ),
            'section'     => 'portfolio_post',
            'default'     => 1,
            'priority'    => 7,
        ),

        /* preload */
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'sandbox' ),
            'section'     => 'preload_section',
            'default'     => 0,
            'priority'    => 10,
        ),
        'preload_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color', 'sandbox' ),
            'section'  => 'preload_section',
            'priority' => 14,
            'output'    => array(
                array(
                    'element'  => '.page-loader:before',
                    'property' => 'border-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'sandbox' ),
            'section'  => 'preload_section',
            'output'    => array(
                array(
                    'element'  => '.page-loader',
                    'property' => 'background'
                ),
            ),
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
		/* typography */
        'typography_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Typography Customize?', 'sandbox' ),
            'section'     => 'typography',
            'default'     => 0,
            'priority'    => 1,
        ),
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 2,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => 'regular',
                'font-size'      => '16px',
                'line-height'    => '1.875',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#555555',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'body, p',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading1_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 3,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => '400',
                'font-size'      => '48px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h1, .h1, .elementor-widget-heading h1.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading2_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 4,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => '400',
                'font-size'      => '42px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h2, .h2, .elementor-widget-heading h2.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading3_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 5,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => '400',
                'font-size'      => '36px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h3, .h3, .elementor-widget-heading h3.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading4_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 6,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => '400',
                'font-size'      => '30px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h4, .h4, .elementor-widget-heading h4.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading5_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 7,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => '400',
                'font-size'      => '24px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h5, .h5, .elementor-widget-heading h5.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading6_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'sandbox' ),
            'section'  => 'typography',
            'priority' => 8,
            'default'  => array(
                'font-family'    => 'Manrope',
                'variant'        => '400',
                'font-size'      => '20px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'h6',
            ),
            'output'      => array(
                array(
                    'element' => 'h6, .h6, .elementor-widget-heading h6.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

		/* 404 */
		'custom_404'      => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Customize?', 'sandbox' ),
            'section'     => 'error_404',
			'default'     => 0,
			'priority'    => 3,
		),
		'page_404'   	  => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'sandbox' ), 
	 		'description' => esc_attr__( 'Choose a template in pages.', 'sandbox' ), 
	 		'section'     => 'error_404', 
	 		'default'     => '', 
			 'priority'    => 3,
			 'active_callback' => array(
				array(
					'setting'  => 'custom_404',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		/*color scheme*/
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'sandbox' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'sandbox' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
        ),

        /*google atlantic*/
        'js_code'  => array(
            'type'        => 'code',
            'label'       => esc_html__( 'Code', 'sandbox' ),
            'section'     => 'script_code',
            'choices'     => [
				'language' => 'js',
			],
            'priority'    => 3,
        ),
		
	);
	$settings['panels']   = apply_filters( 'sandbox_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'sandbox_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'sandbox_customize_fields', $fields );

	return $settings;
}

$sandbox_customize = new Sandbox_Customize( sandbox_customize_settings() );

require get_template_directory() . '/inc/backend/customizer/customizer-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-page-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-footer.php';
require get_template_directory() . '/inc/backend/customizer/customizer-blog.php';
