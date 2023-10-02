<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sandbox
 */

/** Add body class by filter **/
add_filter( 'body_class', 'sandbox_body_class_names', 999 );
function sandbox_body_class_names( $classes ) {
	
	$theme = wp_get_theme();
	if( is_child_theme() ) { $theme = wp_get_theme()->parent(); }

  	$classes[] = 'sandbox-theme-ver-'.$theme->version;

  	$classes[] = 'wordpress-version-'.get_bloginfo( 'version' );

  	return $classes;
}

/**
 *  Add specific CSS class to header
 */
function sandbox_header_class() {

	$header_classes  = '';

	if ( sandbox_get_option('header_fixed') != false ){
		$header_classes  = 'header-overlay';
	}
	if ( function_exists('rwmb_meta') ) {
		if( rwmb_meta('is_trans') == 'yes'){
			$header_classes  = 'header-overlay';
		}elseif( rwmb_meta('is_trans') == 'no'){
			$header_classes = '';
		}
		if( is_singular('ot_portfolio') ){
            $pheader_trans = rwmb_meta('pheader_is_trans');
            if( !empty( $pheader_trans ) ){
            	$header_classes  = 'header-overlay';
            }else{
            	$header_classes = '';
            }
        }
	}
	
    echo $header_classes;
}

function sandbox_post_header_class() {

	$p_header_classes = '';

	if ( sandbox_get_option('sheader_fixed') != false ){
		$p_header_classes = 'header-overlay';
	}
	
    echo $p_header_classes;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sandbox_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'sandbox_pingback_header' );

//Get layout post & page.
if ( ! function_exists( 'sandbox_get_layout' ) ) :
	function sandbox_get_layout() {
		// Get layout.
		if( is_page() && !is_home() && function_exists( 'rwmb_meta' ) ) {
			$page_layout = rwmb_meta('page_layout');
		}elseif( is_single() ){
			$page_layout = sandbox_get_option( 'single_post_layout' );
		}else{
			$page_layout = sandbox_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'sandbox_content_columns' ) ) :
	function sandbox_content_columns() {

		$blog_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === sandbox_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === sandbox_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right';
		}else{
			$blog_content_width[] = 'col-lg-10 col-lg-offset-1';
		}

		// return the $classes array
    	echo implode( ' ', $blog_content_width );
	}
endif;

/**
 * Portfolio Columns
 */
if ( ! function_exists( 'sandbox_portfolio_option_class' ) ) :
	function sandbox_portfolio_option_class() {

		$portfolio_option_class = array();

		if( sandbox_get_option('portfolio_column') == "2cl" ){
			$portfolio_option_class[] = 'pf_2_cols';
		}elseif( sandbox_get_option('portfolio_column') == "4cl" ) {
			$portfolio_option_class[] = 'pf_4_cols';
		}elseif( sandbox_get_option('portfolio_column') == "5cl" ) {
			$portfolio_option_class[] = 'pf_5_cols';
		}else{
			$portfolio_option_class[] = '';
		}

		if( sandbox_get_option('portfolio_style') == "style2" ) {
			$portfolio_option_class[] = 'style-2';
		}elseif( sandbox_get_option('portfolio_style') == "style3" ) {
			$portfolio_option_class[] = 'style-3';
		}else{
			$portfolio_option_class[] = 'style-1';
		}

	    // return the $classes array
	    echo implode( ' ', $portfolio_option_class );
	}
endif;

/**
 * Change Posts Per Page for Portfolio Archive.
 * 
 * @param object $query data
 *
 */
function sandbox_change_portfolio_posts_per_page( $query ) {
	$portfolio_ppp = (!empty( sandbox_get_option('portfolio_posts_per_page') ) ? sandbox_get_option('portfolio_posts_per_page') : '6');

	if ( !is_singular() && !is_admin() ) {		
	    if ( $query->is_post_type_archive( 'ot_portfolio' ) || $query->is_tax('portfolio_cat') && ! is_admin() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', $portfolio_ppp );
	    }
	}
    return $query;
}
add_filter( 'pre_get_posts', 'sandbox_change_portfolio_posts_per_page' );

/**
 * Load More Ajax Portfolio
 */
add_action( 'wp_enqueue_scripts', 'sandbox_script_and_styles' );
function sandbox_script_and_styles() {
	global $wp_query;

	// register our main script but do not enqueue it yet
	wp_enqueue_script( 'sandbox_scripts', get_template_directory_uri() . '/js/myloadmore.js', array('jquery'), time() );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'sandbox_scripts', 'sandbox_loadmore_params', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
	) );

 	// wp_enqueue_script( 'sandbox_scripts' );
}

add_action('wp_ajax_loadmore', 'sandbox_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'sandbox_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function sandbox_loadmore_ajax_handler(){
	$offset_items  = ( isset($_POST['offset_items']) ) ? $_POST['offset_items'] : 0;
	$cats     	   = ( isset($_POST['data_cates']) ) ? $_POST['data_cates'] : 0;
	$data_load     = ( isset($_POST['settings']['p_more']) ) ? $_POST['settings']['p_more'] : 3;
	$is_latest	   = '';

	if( $_POST['data_cates'] != '' ){
		$args = array(
			'post_type' 	 => 'ot_portfolio',
			'posts_per_page' => $data_load,
			'offset'         => $offset_items,
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_cat',
					'field' => 'term_id',
					'terms' => explode(",",$cats),
				),
			), 
		);
	}else{
		$args = array(
			'post_type' 	 => 'ot_portfolio',
			'posts_per_page' => $data_load,
			'offset'         => $offset_items,
		);
	}
	$args_temp = array(
		'settings' => $_POST['settings'],
		'id_int'   => $_POST['id_int'],
	);

	$wp_query = new \WP_Query($args);
		while ($wp_query -> have_posts()) : $wp_query -> the_post();
			if( ($offset_items + $data_load) >= ($wp_query->found_posts) ) {
				$is_latest = 'latest';
			};
			$args_temp['is_latest'] = $is_latest;
			if( $_POST['settings']['widget_name'] == 'ot-portfolio-filter' ){
				get_template_part( 'template-parts/content', 'project-filter', $args_temp);
			}else{
				get_template_part( 'template-parts/content', 'project-filter_2', $args_temp);
			}
			
		
		endwhile; wp_reset_postdata();

	die;
}

/**
 * Back-To-Top on Footer
 */
if( !function_exists('sandbox_custom_back_to_top') ) {
    function sandbox_custom_back_to_top() {     
	    if( sandbox_get_option('backtotop') != false ){
	    	echo '<div class="progress-wrap">
				    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
				    </svg>
			  	</div>';
	    }
    }
}
add_action('wp_footer', 'sandbox_custom_back_to_top');

/**
 * Google Analytics
 */
if ( ! function_exists( 'sandbox_hook_javascript' ) ) {
	function sandbox_hook_javascript() {
		if ( sandbox_get_option('js_code') != '' ) { echo sandbox_get_option('js_code'); }
	}
}
add_action('wp_head', 'sandbox_hook_javascript');

/**
 * Preload
 */
if ( ! function_exists( 'sandbox_preload' ) ) {
	function sandbox_preload() {
		if ( sandbox_get_option('preload') != false ) { echo '<div class="page-loader"></div>'; }
	}
}
/**
 * Shortcode Copyright
 * output: [oceanthemes_date time_custom="F j, Y"]
 */
function oceanthemes_date_func( $atts ) {
    $date_format = shortcode_atts( array(
        'time_custom' => 'Y',        
    ), $atts );

    $dt = new DateTime("now");
    $gmt_timestamp = $dt->format("{$date_format['time_custom']}");

    return $gmt_timestamp;
}
add_shortcode( 'oceanthemes_date', 'oceanthemes_date_func' );

/**
 * Contact form 7 remove span
 */
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);      
    return $content;
});