<?php
/**
 * Furniture Decor Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package furniture_decor
 */

if( ! function_exists( 'furniture_decor_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function furniture_decor_customize_register( $wp_customize ) {

    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'furniture-decor' );
    }
	
    /* Option list of all post */	
    $furniture_decor_options_posts = array();
    $furniture_decor_options_posts_obj = get_posts('posts_per_page=-1');
    $furniture_decor_options_posts[''] = esc_html__( 'Choose Post', 'furniture-decor' );
    foreach ( $furniture_decor_options_posts_obj as $furniture_decor_posts ) {
    	$furniture_decor_options_posts[$furniture_decor_posts->ID] = $furniture_decor_posts->post_title;
    }
    
    /* Option list of all categories */
    $furniture_decor_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $furniture_decor_option_categories = array();
    $furniture_decor_category_lists = get_categories( $furniture_decor_args );
    $furniture_decor_option_categories[''] = esc_html__( 'Choose Category', 'furniture-decor' );
    foreach( $furniture_decor_category_lists as $furniture_decor_category ){
        $furniture_decor_option_categories[$furniture_decor_category->term_id] = $furniture_decor_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'furniture-decor' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'furniture-decor' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */

     /** Post Settings */
    $wp_customize->add_section(
        'furniture_decor_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'furniture-decor' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'furniture_decor_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'furniture-decor' ),
            'section'     => 'furniture_decor_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'furniture_decor_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'furniture-decor' ),
            'section'     => 'furniture_decor_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'furniture_decor_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'furniture-decor' ),
            'section'     => 'furniture_decor_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'furniture_decor_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'furniture-decor' ),
            'section'     => 'furniture_decor_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Settings Ends */

    /** General Settings */

    $wp_customize->add_section(
        'furniture_decor_general_settings',
        array(
            'title' => esc_html__( 'General Settings', 'furniture-decor' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /** Scroll to top control */
    $wp_customize->add_setting( 
        'furniture_decor_footer_scroll_to_top', 
        array(
            'default' => true ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_footer_scroll_to_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'furniture-decor' ),
            'section'     => 'furniture_decor_general_settings',
            'type'        => 'checkbox',
        )
    );

     /** Preloader control */
    $wp_customize->add_setting( 
        'furniture_decor_header_preloader', 
        array(
            'default' => false ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_header_preloader',
        array(
            'label'       => __( 'Show Preloader', 'furniture-decor' ),
            'section'     => 'furniture_decor_general_settings',
            'type'        => 'checkbox',
        )
    );

    /** Sticky Header control */
    $wp_customize->add_setting( 
        'furniture_decor_sticky_header', 
        array(
            'default' => false,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_sticky_header',
        array(
            'label'       => __( 'Show Sticky Header', 'furniture-decor' ),
            'section'     => 'furniture_decor_general_settings',
            'type'        => 'checkbox',
        )
    );

    /** General Settings Ends */

    /** Header Section Settings */
    $wp_customize->add_section(
        'furniture_decor_header_section_settings',
        array(
            'title' => esc_html__( 'Header Section Settings', 'furniture-decor' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /** Header Section control */
    $wp_customize->add_setting( 
        'furniture_decor_header_Setting', 
        array(
            'default' => false ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_header_Setting',
        array(
            'label'       => __( 'Show Header', 'furniture-decor' ),
            'section'     => 'furniture_decor_header_section_settings',
            'type'        => 'checkbox',
        )
    );


    /** Discount 1 */
    $wp_customize->add_setting(
        'furniture_decor_discount_text1',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_discount_text1',
        array(
            'label' => esc_html__( 'Add Discount Text', 'furniture-decor' ),
            'section' => 'furniture_decor_header_section_settings',
            'type' => 'text',
        )
    );

    /** Discount 2 */
    $wp_customize->add_setting(
        'furniture_decor_discount_text2',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_discount_text2',
        array(
            'label' => esc_html__( 'Add Discount Text', 'furniture-decor' ),
            'section' => 'furniture_decor_header_section_settings',
            'type' => 'text',
        )
    );

   

    /** Header Section Settings End */

    /** Socail Section Settings */
    $wp_customize->add_section(
        'furniture_decor_social_section_settings',
        array(
            'title' => esc_html__( 'Social Media Section Settings', 'furniture-decor' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /** Socail Section control */
    $wp_customize->add_setting( 
        'furniture_decor_social_icon_setting', 
        array(
            'default' => true ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_social_icon_setting',
        array(
            'label'       => __( 'Show Social Icon', 'furniture-decor' ),
            'section'     => 'furniture_decor_social_section_settings',
            'type'        => 'checkbox',
        )
    );

    /**  Social Link 1 */
    $wp_customize->add_setting(
        'furniture_decor_social_link_1',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_social_link_1',
        array(
            'label' => esc_html__( 'Add Facebook Link', 'furniture-decor' ),
            'section' => 'furniture_decor_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 2 */
    $wp_customize->add_setting(
        'furniture_decor_social_link_2',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_social_link_2',
        array(
            'label' => esc_html__( 'Add Twitter Link', 'furniture-decor' ),
            'section' => 'furniture_decor_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 3 */
    $wp_customize->add_setting(
        'furniture_decor_social_link_3',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_social_link_3',
        array(
            'label' => esc_html__( 'Add Instagram Link', 'furniture-decor' ),
            'section' => 'furniture_decor_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 4 */
    $wp_customize->add_setting(
        'furniture_decor_social_link_4',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_social_link_4',
        array(
            'label' => esc_html__( 'Add Pintrest Link', 'furniture-decor' ),
            'section' => 'furniture_decor_social_section_settings',
            'type' => 'url',
        )
    );

    /** Socail Section Settings End */

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'furniture_decor_home_page_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'furniture-decor' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'furniture-decor' ),
        ) 
    );

    /** Slider Section Settings */
    $wp_customize->add_section(
        'furniture_decor_slider_section_settings',
        array(
            'title' => esc_html__( 'Slider Section Settings', 'furniture-decor' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'furniture_decor_home_page_settings',
        )
    );

    /** Slider Section control */
    $wp_customize->add_setting( 
        'furniture_decor_banner_setting', 
        array(
            'default' => true ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_banner_setting',
        array(
            'label'       => __( 'Show Slider', 'furniture-decor' ),
            'section'     => 'furniture_decor_slider_section_settings',
            'type'        => 'checkbox',
        )
    );
    
    $categories = get_categories();
        $cat_posts = array();
            $i = 0;
            $cat_posts[]='Select';
        foreach($categories as $category){
            if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'furniture_decor_blog_slide_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'furniture_decor_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'furniture_decor_blog_slide_category',
        array(
            'type'    => 'select',
            'choices' => $cat_posts,
            'label' => __('Select Category to display Latest Post','furniture-decor'),
            'section' => 'furniture_decor_slider_section_settings',
        )
    );

    /** Category Section Settings */
    $wp_customize->add_section(
        'furniture_decor_shop_section_settings',
        array(
            'title' => esc_html__( 'Shop Category Section Settings', 'furniture-decor' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'furniture_decor_home_page_settings',
        )
    );

    /** Category Section control */
    $wp_customize->add_setting( 
        'furniture_decor_shop_category_setting', 
        array(
            'default' => true ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_shop_category_setting',
        array(
            'label'       => __( 'Show Shop Category', 'furniture-decor' ),
            'section'     => 'furniture_decor_shop_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Section Title
    $wp_customize->add_setting(
        'furniture_decor_section_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'furniture_decor_section_title', 
        array(
            'label'       => __('Section Title', 'furniture-decor'),
            'section'     => 'furniture_decor_shop_section_settings',
            'settings'    => 'furniture_decor_section_title',
            'type'        => 'text'
        )
    );

    // Section Text
    $wp_customize->add_setting(
        'furniture_decor_section_text', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'furniture_decor_section_text', 
        array(
            'label'       => __('Section Text', 'furniture-decor'),
            'section'     => 'furniture_decor_shop_section_settings',
            'settings'    => 'furniture_decor_section_text',
            'type'        => 'text'
        )
    );

    // Section Button Link
    $wp_customize->add_setting(
        'furniture_decor_section_button_link', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'furniture_decor_section_button_link',
        array(
            'label'       => __('Section Button Link', 'furniture-decor'),
            'section'     => 'furniture_decor_shop_section_settings',
            'settings'    => 'furniture_decor_section_button_link',
            'type'        => 'text'
        )
    );
    
    /** Home Page Settings Ends */
    
    /** Footer Section */
    $wp_customize->add_section(
        'furniture_decor_footer_section',
        array(
            'title' => __( 'Footer Settings', 'furniture-decor' ),
            'priority' => 70,
        )
    );

     /** Footer control */
    $wp_customize->add_setting( 
        'furniture_decor_footer_setting', 
        array(
            'default' => true ,
            'sanitize_callback' => 'furniture_decor_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'furniture_decor_footer_setting',
        array(
            'label'       => __( 'Show Footer Copyright', 'furniture-decor' ),
            'section'     => 'furniture_decor_footer_section',
            'type'        => 'checkbox',
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'furniture_decor_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'furniture_decor_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'furniture-decor' ),
            'section' => 'furniture_decor_footer_section',
            'type' => 'text',
        )
    );  

    function furniture_decor_sanitize_choices( $input, $setting ) {
        global $wp_customize; 
        $control = $wp_customize->get_control( $setting->id ); 
        if ( array_key_exists( $input, $control->choices ) ) {
            return $input;
        } else {
            return $setting->default;
        }
    }

}
add_action( 'customize_register', 'furniture_decor_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function furniture_decor_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $furniture_decor_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $furniture_decor_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'furniture_decor_customizer', get_template_directory_uri() . '/js' . $furniture_decor_build . '/customizer' . $furniture_decor_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'furniture_decor_customize_preview_js' );