<?php
/** header desktop **/
if ( ! function_exists( 'sandbox_header_builder' ) ) {
    function sandbox_header_builder (){
        $header_builder = '';    

        if ( is_page() || is_home() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_fb = rwmb_meta( 'select_header', 'field_type=select_advanced', $wp_query->get_queried_object_id() );
                if ($metabox_fb != '') {
                    $header_builder = $metabox_fb;
                }else{
                    $header_builder = sandbox_get_option('header_layout');
                }
            } 
        }else{
            $header_builder = sandbox_get_option('header_layout');
        }

        if( !$header_builder ) {
            get_template_part('inc/frontend/header/header-default');
        }else{
            echo '<div class="header-desktop">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_builder ); 
            }
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'sandbox_post_header_builder' ) ) {
    function sandbox_post_header_builder (){
        $p_header_builder = '';    

        if ( sandbox_get_option('sheader_layout') ) {
            $p_header_builder = sandbox_get_option('sheader_layout');
        }else{
            $p_header_builder = sandbox_get_option('header_layout');
        }

        if( !$p_header_builder ) {
            get_template_part('inc/frontend/header/header-default');
        }else{
            echo '<div class="header-desktop">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $p_header_builder ); 
            }
            echo '</div>';
        }
    }
}

/** header mobile **/
if ( ! function_exists( 'sandbox_mobile_builder' ) ) {
    function sandbox_mobile_builder (){
        $mobile_builder = '';

        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_hmb = rwmb_meta( 'select_header_mobile', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_hmb != '') {
                    $mobile_builder = $metabox_hmb;
                }else{
                    $mobile_builder = sandbox_get_option('header_mobile');
                }
            } 
        }else{
            $mobile_builder = sandbox_get_option('header_mobile');
        }

        if( !$mobile_builder ) {
            get_template_part('inc/frontend/header/header-mobile');
        }else{
            echo '<div class="header-mobile">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $mobile_builder ); 
            }
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'sandbox_post_mobile_builder' ) ) {
    function sandbox_post_mobile_builder (){
        $p_mobile_builder = '';

        if ( sandbox_get_option('sheader_mobile') ) {
            $p_mobile_builder = sandbox_get_option('sheader_mobile');
        }else{
            $p_mobile_builder = sandbox_get_option('header_mobile');
        }

        if( !$p_mobile_builder ) {
            get_template_part('inc/frontend/header/header-mobile');
        }else{
            echo '<div class="header-mobile">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $p_mobile_builder ); 
            }
            echo '</div>';
        }
    }
}

/** side panel **/
if ( ! function_exists( 'sandbox_sidepanel_builder' ) ) {
    function sandbox_sidepanel_builder (){

        $panel_builder = sandbox_get_option('sidepanel_layout');

        if( !$panel_builder ) {
            return;
        }else{
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $panel_builder ); 
            }
        }
    }
}

/** 404 template **/
if ( ! function_exists( 'sandbox_404_builder' ) ) {
    function sandbox_404_builder (){

        $error_builder = sandbox_get_option('page_404');

        if( !$error_builder ) { ?>
            <div class="error-404 not-found text-center">
                <div class="container">
                    <img class="error-logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404.png" alt="404">
                    <h1><?php esc_html_e( 'Oops! Page Not Found.', 'sandbox' ); ?></h2>
                    <div class="page-content">
                        <p><?php esc_html_e( 'The page you are looking for is not available or has been moved. Try a different page or go to homepage with the button below.', 'sandbox' ); ?></p>
                        <a class="octf-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to Homepage', 'sandbox' ); ?></a>
                    </div>
                </div>
            </div>
        <?php }else{
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $error_builder ); 
            }
        }
    }
}

/** footer **/
if ( ! function_exists( 'sandbox_footer_builder' ) ) {
    function sandbox_footer_builder (){
        $footer_builder = '';    

        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_fb = rwmb_meta( 'select_footer', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_fb != '') {
                    $footer_builder = $metabox_fb;
                }else{
                    $footer_builder = sandbox_get_option('footer_layout');
                }
            } 
        }else{
            $footer_builder = sandbox_get_option('footer_layout');
        }

        if( !$footer_builder ) {
            return;
        }else{
            echo '<footer id="site-footer" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_builder ); 
            }
            echo '</footer>';
        }
    }
}