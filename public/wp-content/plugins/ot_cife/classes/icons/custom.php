<?php
namespace Ot_Cife;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*--------------------------
*   Class Unicons Icon Manager
* -------------------------*/
class Ot_Cife_Custom_Design_Icon_Manager{

    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {

        // Custom icon filter
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'ot_cife_custom'] );  

    }

	public function ot_cife_custom( $custom_args = array() ) {

	    // Append new icons
	    $custom = array(
			'icn-caret-right',
			'icn-comment-line',
			'icn-external',
			'icn-flower',
			'icn-terminal',
	    );
	    
	    $custom_args['ot_cife-custom'] = array(
	        'name'          => 'ot_cife-custom',
	        'label'         => esc_html__( 'OT - Custom', 'ot_cife' ),
	        'labelIcon'     => 'fas fa-star',
	        'prefix'        => '',
	        'displayPrefix' => '',
	        'url'           => OT_CIFE_ASSETS . 'css/custom.css',
	        'icons'         => $custom,
	        'ver'           => OT_CIFE_VER,
	    );

	    return $custom_args;
	}



}
Ot_Cife_Custom_Design_Icon_Manager::instance();