<?php
function header_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'sandbox',
	);

	$sections = array(
        'main_header'     => array(
            'title'       => esc_html__( 'Header', 'sandbox' ),
            'description' => '',
            'priority'    => 8,
            'capability'  => 'edit_theme_options',
        ),
	);

	$fields = array(
		/* header settings */
		'header_layout'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'sandbox' ), 
	 		'description' => esc_attr__( 'Choose the header on desktop.', 'sandbox' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 3,
	 		'placeholder' => esc_attr__( 'Select a header', 'sandbox' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'header_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent?', 'sandbox' ),
	 		'description' => esc_attr__( 'Enable when your header is transparent.', 'sandbox' ), 
            'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 4,
        ),
        'header_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'sandbox' ), 
	 		'description' => esc_attr__( 'Choose the header on mobile.', 'sandbox' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 5,
	 		'placeholder' => esc_attr__( 'Select a header', 'sandbox' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
        ),
        'is_sidepanel'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel for all site?', 'sandbox' ),
			'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 6,
			'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
            ),
        ), 
        'sidepanel_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Side Panel', 'sandbox' ), 
	 		'description' => esc_attr__( 'Choose the side panel on header.', 'sandbox' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 6,
	 		'placeholder' => esc_attr__( 'Select a panel', 'sandbox' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
                array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
            ),
		),
		'panel_left'     => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel On Left', 'sandbox' ),
            'section'     => 'main_header',
			'default'     => '0',
			'priority'    => 7,
			'active_callback' => array(
                array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
                array(
					'setting'  => 'sidepanel_layout',
					'operator' => '!=',
					'value'    => '',
				),
            ),
		),		
		
	);

	$settings['sections'] = apply_filters( 'sandbox_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'sandbox_customize_fields', $fields );

	return $settings;
}

$sandbox_customize = new Sandbox_Customize( header_customize_settings() );