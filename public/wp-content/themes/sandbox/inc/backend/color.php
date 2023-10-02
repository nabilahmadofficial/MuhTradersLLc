<?php 
//Custom Style Frontend
if(!function_exists('sandbox_color_scheme')){
    function sandbox_color_scheme(){
        $color_scheme = '';

        //Main Color
        if( !empty( sandbox_get_option('main_color') ) && sandbox_get_option('main_color') != '#3f78e0' ){
            $color_scheme = 
            '
            :root {
                --sandbox-color-primary: '.sandbox_get_option('main_color').';
            }
            .octf-btn{
                --sandbox-btn-bg: '.sandbox_get_option('main_color').';
            }

			';
        }

        if(! empty($color_scheme)){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}
    }
}
add_action('wp_head', 'sandbox_color_scheme');