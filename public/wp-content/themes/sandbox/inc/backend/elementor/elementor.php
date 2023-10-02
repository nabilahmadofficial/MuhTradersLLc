<?php
// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/register', 'sandbox_register_elementor_widgets' );
function sandbox_register_elementor_widgets() {

    require_once( get_template_directory() . '/inc/backend/elementor/widgets/widgets.php' );
    require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/widgets.php' );

}

// Add a custom 'category_sandbox' category for to the Elementor element panel so that our theme's widgets have their own category.
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_sandbox',
        [
            'title' => __( 'Sandbox', 'sandbox' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        1 // position
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_sandbox_header',
        [
            'title' => __( 'OT Header', 'sandbox' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        2 // position
    );
});

// Post types with Elementor
function sandbox_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'ot_portfolio', 'ot_header_builders', 'ot_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but portfolio is NOT defined
    else {
        $ot_portfolio       = in_array( 'ot_portfolio', $cpt_support );
        $ot_header_builders = in_array( 'ot_header_builders', $cpt_support );
        $ot_footer_builders = in_array( 'ot_footer_builders', $cpt_support );
        if( !$ot_portfolio ){
            $cpt_support[] = 'ot_portfolio'; //append to array
        }
        if( !$ot_header_builders ){
            $cpt_support[] = 'ot_header_builders'; //append to array
        }
        if( !$ot_footer_builders ){
            $cpt_support[] = 'ot_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'sandbox_add_cpt_support' );

// Upload SVG for Elementor
function sandbox_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'sandbox_unfiltered_files_upload' );

/**
 * Elementor Add News Custom Fonts
 */

add_filter( 'elementor/fonts/groups', function( $font_groups ) {
    $font_groups['sandbox_fonts'] = __( 'Sandbox Fonts', 'sandbox' );
    return $font_groups;
} );

// Filters the fonts used by Elementor to add additional fonts. //
add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
    $additional_fonts['THICCCBOI'] = 'sandbox_fonts';
    $additional_fonts['Space Grotesk Sandbox'] = 'sandbox_fonts';
    return $additional_fonts;
} );

// Header post type
add_action( 'init', 'sandbox_create_header_builder' ); 
function sandbox_create_header_builder() {
    register_post_type( 'ot_header_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Header Builder', 'sandbox' ),
                'singular_name'     => esc_html__( 'Header Builder', 'sandbox' ),
                'add_new'           => esc_html__( 'Add New', 'sandbox' ),
                'add_new_item'      => esc_html__( 'Add New Header', 'sandbox' ),
                'edit'              => esc_html__( 'Edit', 'sandbox' ),
                'edit_item'         => esc_html__( 'Edit Header', 'sandbox' ),
                'all_items'         => esc_html__( 'All Headers', 'sandbox' ),
                'new_item'          => esc_html__( 'New Header', 'sandbox' ),
                'view'              => esc_html__( 'View', 'sandbox' ),
                'view_item'         => esc_html__( 'View Header', 'sandbox' ),
                'search_items'      => esc_html__( 'Search Header', 'sandbox' ),
                'not_found'         => esc_html__( 'No Header found', 'sandbox' ),
                'not_found_in_trash'=> esc_html__( 'No Header found in Trash', 'sandbox' ),
                'parent'            => esc_html__( 'Parent Header', 'sandbox' )
            ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true, /* Required 'true' to work in Edit With Elementor */
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

// Footer post type
add_action( 'init', 'sandbox_create_footer_builder' ); 
function sandbox_create_footer_builder() {
    register_post_type( 'ot_footer_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Footer Builder', 'sandbox' ),
                'singular_name'     => esc_html__( 'Footer Builder', 'sandbox' ),
                'add_new'           => esc_html__( 'Add New', 'sandbox' ),
                'add_new_item'      => esc_html__( 'Add New Footer', 'sandbox' ),
                'edit'              => esc_html__( 'Edit', 'sandbox' ),
                'edit_item'         => esc_html__( 'Edit Footer', 'sandbox' ),
                'all_items'         => esc_html__( 'All Footers', 'sandbox' ),
                'new_item'          => esc_html__( 'New Footer', 'sandbox' ),
                'view'              => esc_html__( 'View', 'sandbox' ),
                'view_item'         => esc_html__( 'View Footer', 'sandbox' ),
                'search_items'      => esc_html__( 'Search Footer Builders', 'sandbox' ),
                'not_found'         => esc_html__( 'No Footer found', 'sandbox' ),
                'not_found_in_trash'=> esc_html__( 'No Footer found in Trash', 'sandbox' ),
                'parent'            => esc_html__( 'Parent Footer', 'sandbox' )
            ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/*Fix Elementor Pro*/
function sandbox_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'sandbox_register_elementor_locations' );

/*** add options to sections ***/
add_action('elementor/element/section/section_structure/after_section_end', function( $section, $args ) {

    /* header options */
    $section->start_controls_section(
        'section_custom_class',
        [
            'label' => __( 'For Header', 'sandbox' ),
            'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $section->add_control(
        'sticky_class',
        [
            'label'        => __( 'Sticky On/Off', 'sandbox' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'is-fixed',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'sticky_background',
        [
            'label'     => __( 'Background Scroll', 'sandbox' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.elementor-section.is-stuck' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );
    $section->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'sticky_shadow',
            'label' => esc_html__( 'Box Shadow', 'sandbox' ),
            'selector' => '{{WRAPPER}}.is-stuck',
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]  
    );
    $section->add_responsive_control(
        'offset_space',
        [
            'label' => __( 'Offset', 'sandbox' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );

    $section->end_controls_section();

}, 10, 2 );

/*** add options to columns ***/
if ( did_action( 'elementor/loaded' ) ) {
    require get_template_directory() . '/inc/backend/elementor/elementor-custom-module.php';
}