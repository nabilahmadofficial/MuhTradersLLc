<?php
/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function sandbox_register_meta_boxes( $meta_boxes ) {
	
	// Post format's meta box
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__( 'Format Details', 'sandbox' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
                'name'             => esc_html__( 'Background Page Header', 'sandbox' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'class' => 'gallery link image quote video audio standard',
            ),
			array(
				'name'             => esc_html__( 'Image', 'sandbox' ),
				'id'               => 'post_image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
				// Image size that displays in the edit page. Possible sizes small,medium,large,original
    			'image_size'       => 'thumbnail',
			),
			array(
				'name'  			=> esc_html__( 'Gallery', 'sandbox' ),
				'id'    			=> 'post_gallery',
				'type'  			=> 'image_advanced',
				'class' 			=> 'gallery',
				// Image size that displays in the edit page. Possible sizes small,medium,large,original
    			'image_size'       	=> 'thumbnail',
			),			
			array(
				'name'  => esc_html__( 'Audio', 'sandbox' ),
				'id'    => 'post_audio',
				'type'  => 'textarea',
				'cols'  => 120,
				'rows'  => 2,
				'class' => 'audio',
				'desc'  => 'Example: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__( 'ID of Youtube Video', 'sandbox' ),
				'id'    => 'post_video',
				'type'  => 'textarea',
				'cols'  => 120,
				'rows'  => 2,
				'class' => 'video',
				'desc'  => 'Example: j_Y2Gwaj7Gs',
			),
		),
	);

	//Page Layout
	$meta_boxes[] = array(
        'id'       => 'ppheader-settings',
        'title'    => esc_html__( 'Page Layout Settings', 'sandbox' ),
        'pages'    => array( 'page' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'id'        			=> 'page_layout',
                'name'      			=> esc_html__( 'Page Layout', 'sandbox' ),
                'type'      			=> 'image_select',
                'options'   			=> array(
                    'full-content'    	=> get_template_directory_uri() . '/inc/backend/images/full.png',
                    'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
                    'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
                ),
                'std'       			=> 'full-content'
            ),
            array(
                'name'             => esc_html__( 'Login/Register Popup On/Off', 'sandbox' ),
                'id'               => 'user_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'sandbox' ),
                'off_label'        => esc_html__( 'Off', 'sandbox' ),
            ),
            array(
                'name'             => esc_html__( 'Newsletter Popup On/Off', 'sandbox' ),
                'id'               => 'promo_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'sandbox' ),
                'off_label'        => esc_html__( 'Off', 'sandbox' ),
            ),
        ),
	);
    
    //Header/Footer Settings
	$meta_boxes[] = array (
      	'id' 			=> 'select-header-footer',
      	'title' 		=> esc_html__( 'Header/Footer Settings', 'sandbox' ),
      	'pages' 		=> array( 'page' ),
      	'context' 		=> 'normal',
      	'priority' 		=> 'high',
      	'autosave' 		=> false,
      	'fields' 		=>   array (  
        	array(
        		'name' 					=> esc_html__( 'Header Layout', 'sandbox' ),
				'id' 					=> 'select_header',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header', 'sandbox' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array(
                'name'             		=> esc_html__( 'Header Transparent?', 'sandbox' ),
                'id'               		=> 'is_trans',
				'type'             		=> 'select',
				'options'   			=> array(
                    'default'   		=> esc_html__( 'Default', 'sandbox' ),
                    'yes' 				=> esc_html__( 'Yes', 'sandbox' ),
                    'no' 				=> esc_html__( 'No', 'sandbox' ),
                ),
                'std'       			=> 'default'
            ),
			array(
        		'name' 					=> esc_html__( 'Header Mobile Layout', 'sandbox' ),
				'id' 					=> 'select_header_mobile',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header mobile', 'sandbox' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array (
        		'name' 					=> esc_html__( 'Footer Layout', 'sandbox' ),
				'id' 					=> 'select_footer',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_footer_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a footer', 'sandbox' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
        	),
      	),
	);

	/*Portfolio Header Transparent*/
	$meta_boxes[] = array(
        'id'       => 'portfolio-header-is-trans',
        'title'    => esc_html__( 'Header Setting', 'sandbox' ),
        'pages'    => array( 'ot_portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
            	'name'             => esc_html__( 'Header Transparent On/Off', 'sandbox' ),
                'id'        	   => 'pheader_is_trans',
               	'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'sandbox' ),
                'off_label'        => esc_html__( 'Off', 'sandbox' ),
                'std'              => 'on'
            ),
        ),
    );

	// Page Settings
	$meta_boxes[] = array(
		'id'       => 'page-settings',
		'title'    => esc_html__( 'Page Header Settings', 'sandbox' ),
		'pages'    => array( 'page', 'ot_portfolio' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'sandbox' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'sandbox' ),
                'off_label'        => esc_html__( 'Off', 'sandbox' ),
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'sandbox' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            )
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'sandbox_register_meta_boxes' );
