<?php
function footer_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'sandbox',
	);

	$sections = array(				
        // Footer Customize Panel
	    'footer'         => array(
			'title'      => esc_html__( 'Footer', 'sandbox' ),
			'priority'   => 9,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(		
		/* footer settings */
		'footer_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Footer', 'sandbox' ), 
	 		'description' => esc_attr__( 'Choose a footer for all site here.', 'sandbox' ), 
	 		'section'     => 'footer', 
	 		'default'     => '', 
	 		'priority'    => 1,
	 		'placeholder' => esc_attr__( 'Select a footer', 'sandbox' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_footer_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'backtotop_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'backtotop'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Back To Top On/Off?', 'sandbox' ),
            'section'     => 'footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'color_backtotop' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color', 'sandbox' ),
            'section'  => 'footer',
            'priority' => 5,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '.progress-wrap:after',
                    'property' => 'color',
                ),
                array(
                    'element'  => '.progress-wrap svg.progress-circle path',
                    'property' => 'stroke',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'spacing_backtotop' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Spacing', 'sandbox' ),
            'section'  => 'footer',
            'priority' => 6,
            'default'     => array(
				'bottom'  => '',
				'right' => '',
			),
			'choices'     => array(
				'labels' => array(
					'bottom'  => esc_html__( 'Bottom (Ex: 20px)', 'sandbox' ),
					'right'   => esc_html__( 'Right (Ex: 20px)', 'sandbox' ),
				),
			),
            'output'    => array(
                array(
                    'choice'      => 'bottom',
                    'element'     => '.progress-wrap',
                    'property'    => 'bottom',
                ),
                array(
                    'choice'      => 'right',
                    'element'     => '.progress-wrap',
                    'property'    => 'right',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
	);

	$settings['sections'] = apply_filters( 'sandbox_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'sandbox_customize_fields', $fields );

	return $settings;
}

$sandbox_customize = new Sandbox_Customize( footer_customize_settings() );