<?php
/**
 * Furniture Decor functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package furniture_decor
 */

$furniture_decor_theme_data = wp_get_theme();
if( ! defined( 'FURNITURE_DECOR_THEME_VERSION' ) ) define ( 'FURNITURE_DECOR_THEME_VERSION', $furniture_decor_theme_data->get( 'Version' ) );
if( ! defined( 'FURNITURE_DECOR_THEME_NAME' ) ) define( 'FURNITURE_DECOR_THEME_NAME', $furniture_decor_theme_data->get( 'Name' ) );

if ( ! function_exists( 'furniture_decor_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function furniture_decor_setup() {

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
		'primary' => esc_html__( 'Primary', 'furniture-decor' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'furniture_decor_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	/* Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'furniture_decor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function furniture_decor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'furniture_decor_content_width', 780 );
}
add_action( 'after_setup_theme', 'furniture_decor_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function furniture_decor_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'furniture-decor' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'furniture-decor' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'furniture-decor' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'furniture-decor' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'furniture_decor_widgets_init' );

if( ! function_exists( 'furniture_decor_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function furniture_decor_scripts() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $furniture_decor_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $furniture_decor_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/css/build/bootstrap.css' );
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/build/owl.carousel.css' );

	wp_enqueue_style( 'furniture-decor-style', get_stylesheet_uri(), array(), FURNITURE_DECOR_THEME_VERSION );

	if( furniture_decor_woocommerce_activated() ) 
    wp_enqueue_style( 'furniture-decor-woocommerce-style', get_template_directory_uri(). '/css' . $furniture_decor_build . '/woocommerce' . $furniture_decor_suffix . '.css', array('furniture-decor-style'), FURNITURE_DECOR_THEME_VERSION );
	
  	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $furniture_decor_build . '/all' . $furniture_decor_suffix . '.js', array( 'jquery' ), '6.1.1', true );
  	wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $furniture_decor_build . '/v4-shims' . $furniture_decor_suffix . '.js', array( 'jquery' ), '6.1.1', true );
  	wp_enqueue_script( 'furniture-decor-modal-accessibility', get_template_directory_uri() . '/js' . $furniture_decor_build . '/modal-accessibility' . $furniture_decor_suffix . '.js', array( 'jquery' ), FURNITURE_DECOR_THEME_VERSION, true );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/build/owl.carousel.js', array('jquery'), '2.6.0', true );
	wp_enqueue_script( 'furniture-decor-js', get_template_directory_uri() . '/js/build/custom.js', array('jquery'), FURNITURE_DECOR_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'furniture_decor_scripts' );

if( ! function_exists( 'furniture_decor_admin_scripts' ) ) :
/**
 * Addmin scripts
*/
function furniture_decor_admin_scripts() {
	wp_enqueue_style( 'furniture-decor-admin-style',get_template_directory_uri().'/inc/css/admin.css', FURNITURE_DECOR_THEME_VERSION, 'screen' );
}
endif;
add_action( 'admin_enqueue_scripts', 'furniture_decor_admin_scripts' );

function furniture_decor_customize_enque_js(){
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/inc/js/customizer.js', array('jquery'), '2.6.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'furniture_decor_customize_enque_js', 0 );


if( ! function_exists( 'furniture_decor_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function furniture_decor_block_editor_styles() {
	// Use minified libraries if SCRIPT_DEBUG is false
	$furniture_decor_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
	$furniture_decor_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	
	// Block styles.
	wp_enqueue_style( 'furniture-decor-block-editor-style', get_template_directory_uri() . '/css' . $furniture_decor_build . '/editor-block' . $furniture_decor_suffix . '.css' );
}
endif;
add_action( 'enqueue_block_editor_assets', 'furniture_decor_block_editor_styles' );

//Get Start View Function
function furniture_decor_redirect(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
    	//Redirect Get Start Page url
   		wp_safe_redirect( admin_url("themes.php?page=furniture-decor") );
   	}
}
add_action('after_setup_theme', 'furniture_decor_redirect');

function furniture_decor_sanitize_checkbox( $checked ) {

	return ( ( isset( $checked ) && true === $checked ) ? true : false );

}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extra.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Social Links Widget
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Info Theme
 */
require get_template_directory() . '/inc/info.php';

/**
 * Load plugin for right and no sidebar
 */
if( furniture_decor_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';