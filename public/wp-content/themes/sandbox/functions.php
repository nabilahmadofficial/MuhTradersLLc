<?php
/**
 * Sandbox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sandbox
 */

if ( ! function_exists( 'sandbox_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sandbox_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'sandbox' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sandbox', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'sandbox' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'css/editor-style.css', sandbox_fonts_url() ) );
		
	}
endif;
add_action( 'after_setup_theme', 'sandbox_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sandbox_widgets_init() {
	/* Register the 'primary' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'sandbox' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Add widgets here.', 'sandbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	/* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'sandbox_widgets_init' );

/**
 * Register custom fonts.
 */
if ( ! function_exists( 'sandbox_fonts_url' ) ) :
/**
 * Register Google fonts for Blessing.
 *
 * Create your own sandbox_fonts_url() function to override in a child theme.
 *
 * @since Blessing 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function sandbox_fonts_url() {
	$fonts_url = '';
	$font_families     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto Slab, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Manrope font: on or off', 'sandbox' ) ) {
		$font_families[] = 'Manrope:200,300,400,500,600,700,800';
	}

	if ( $font_families ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Enqueue scripts and styles.
 */
function sandbox_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'sandbox-fonts', sandbox_fonts_url(), array(), null );

	/** Custom fonts icon **/
    wp_enqueue_style( 'sandbox-font-icon', get_template_directory_uri().'/css/font-icon.css');

    /** Custom fonts text **/
    wp_enqueue_style( 'sandbox-font-text', get_template_directory_uri().'/css/font-text.css');

	/** All frontend css files **/ 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.0', 'all');

	/** Plugin addon css **/ 
	wp_enqueue_style( 'sandbox-plugin-css', get_template_directory_uri() . '/css/plugin-addon.css', array(), '4.0', 'all');

	/** Theme stylesheet. **/
	wp_enqueue_style( 'sandbox-style', get_stylesheet_uri() );	

	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'), '20180910',  true );
	wp_enqueue_script( 'sandbox-plugin-script', get_template_directory_uri().'/js/plugin-addon.js', array('jquery'), '20180910',  true );
    wp_enqueue_script( 'sandbox-elementor', get_template_directory_uri() . '/js/elementor.js', array( 'jquery' ), '20180910', true );
	wp_enqueue_script( 'sandbox-elementor-header', get_template_directory_uri() . '/js/elementor-header.js', array('jquery'), '20180910', true );
	wp_enqueue_script( 'sandbox-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '20180910', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sandbox_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/frontend/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/frontend/template-functions.php';

/**
 * Custom Page Header for this theme.
 */
require get_template_directory() . '/inc/frontend/page-header/breadcrumbs.php';
require get_template_directory() . '/inc/frontend/page-header/page-header.php';

/**
 * Functions which add more to backend.
 */
require get_template_directory() . '/inc/backend/admin-functions.php';

/**
 * Custom metabox for this theme.
 */
require get_template_directory() . '/inc/backend/meta-boxes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/customizer/customizer.php';

/**
 * Register the required plugins for this theme.
 */
require get_template_directory() . '/inc/backend/plugin-requires.php';
require get_template_directory() . '/inc/backend/importer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/color.php';

/**
 * Elementor functions.
 */
if ( did_action( 'elementor/loaded' ) ) {

	require get_template_directory() . '/inc/backend/elementor/elementor.php';
	
	/**
	 * OT Custom Widget Elementor Compatible WPML
	 */
	require_once get_template_directory() . '/wpml/wpml-compatible.php';
	
}
require get_template_directory() . '/inc/frontend/builder.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}