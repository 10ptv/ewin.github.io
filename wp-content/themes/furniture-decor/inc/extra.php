<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package furniture_decor
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function furniture_decor_body_classes( $classes ) {
  global $post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

	if ( is_multi_author() ) {
		$classes[] = 'group-blog ';
	}

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( furniture_decor_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
    	$classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }

	return $classes;
}
add_filter( 'body_class', 'furniture_decor_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function furniture_decor_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if ( ! function_exists( 'furniture_decor_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function furniture_decor_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'furniture_decor_excerpt_more' );

if( ! function_exists( 'furniture_decor_footer_credit' ) ):
/**
 * Footer Credits
*/

function furniture_decor_footer_credit(){
    $footer_setting = get_theme_mod( 'furniture_decor_footer_setting' );
     if ( $footer_setting ){ 
    $furniture_decor_copyright_text = get_theme_mod( 'furniture_decor_footer_copyright_text' );

    $furniture_decor_text  = '<div class="site-info"><div class="container"><span class="copyright">';
    if( $furniture_decor_copyright_text ){
        $furniture_decor_text .= wp_kses_post( $furniture_decor_copyright_text ); 
    }else{
        $furniture_decor_text .= esc_html__( '&copy; ', 'furniture-decor' ) . date_i18n( esc_html__( 'Y', 'furniture-decor' ) ); 
        $furniture_decor_text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'. esc_html__( '. All Rights Reserved.', 'furniture-decor' );
    }
    $furniture_decor_text .= '</span>';
    $furniture_decor_text .= '<span class="by"> <a href="' . esc_url( 'https://themeignite.com/products/free-furniture-wordpress-theme' ) .'" rel="nofollow" target="_blank">' . FURNITURE_DECOR_THEME_NAME . ' ' . esc_html__( 'By ', 'furniture-decor' ) . '</a>' . '<a href="' . esc_url( 'https://themeignite.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Themeignite', 'furniture-decor' ) . '</a>';

    $furniture_decor_text .= sprintf( esc_html__( ' Powered By %s', 'furniture-decor' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'furniture-decor' ) ) .'" target="_blank">WordPress</a>.' );
    if ( function_exists( 'the_privacy_policy_link' ) ) {
        $furniture_decor_text .= get_the_privacy_policy_link();
    }
    $furniture_decor_text .= '</span></div></div>';
    echo apply_filters( 'furniture_decor_footer_text', $furniture_decor_text );
    }
}
add_action( 'furniture_decor_footer', 'furniture_decor_footer_credit' );
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'furniture_decor_woocommerce_activated' ) ) {
  function furniture_decor_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'furniture_decor_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function furniture_decor_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'furniture-decor' ) : __( 'Name', 'furniture-decor' ) );
    $email    = ( $req ? __( 'Email*', 'furniture-decor' ) : __( 'Email', 'furniture-decor' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'furniture-decor' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'furniture-decor' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'furniture-decor' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'furniture-decor' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'furniture_decor_change_comment_form_default_fields' );

if( ! function_exists( 'furniture_decor_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function furniture_decor_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'furniture-decor' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'furniture-decor' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'furniture_decor_change_comment_form_defaults' );

if( ! function_exists( 'furniture_decor_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function furniture_decor_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'furniture_decor_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function furniture_decor_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $furniture_decor_image_size = furniture_decor_get_image_sizes( $post_thumbnail );
     
    if( $furniture_decor_image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $furniture_decor_image_size['width'] ); ?> <?php echo esc_attr( $furniture_decor_image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $furniture_decor_image_size['width'] ); ?>" height="<?php echo esc_attr( $furniture_decor_image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

function furniture_decor_enqueue_google_fonts() {

    require get_template_directory() . '/inc/wptt-webfont-loader.php';

    wp_enqueue_style(
        'google-fonts-jost',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'furniture_decor_enqueue_google_fonts' );


if( ! function_exists( 'furniture_decor_site_branding' ) ) :
/**
 * Site Branding
*/
function furniture_decor_site_branding(){
    $furniture_decor_header_text = get_theme_mod( 'header_text', 1 );

    ?>
    <div class="site-branding">
        <?php 
        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) the_custom_logo();

        if( $furniture_decor_header_text ){
            if ( is_front_page() ) : ?>
            <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif;
            $furniture_decor_description = get_bloginfo( 'description', 'display' );
            if ( $furniture_decor_description || is_customize_preview() ) : ?>
                <p class="site-description" itemprop="description"><?php echo $furniture_decor_description; ?></p>
                <?php
            endif; 
        } ?>
    </div>
    <?php
}
endif;

if( ! function_exists( 'furniture_decor_navigation' ) ) :
/**
 * Site Navigation
*/
function furniture_decor_navigation(){
    ?>
    <nav class="main-navigation" id="site-navigation"  role="navigation">
        <?php 
        wp_nav_menu( array( 
            'theme_location' => 'primary', 
            'menu_id' => 'primary-menu' 
        ) ); 
        ?>
    </nav>
    <?php
}
endif;


if( ! function_exists( 'furniture_decor_top_header' ) ) :
/**
 * Header Start
*/
function furniture_decor_top_header(){
    $furniture_decor_header_setting  = get_theme_mod( 'furniture_decor_header_Setting',false );
    $furniture_decor_social_icon  = get_theme_mod( 'furniture_decor_social_icon_setting',true );
    $furniture_decor_discount_text1  = get_theme_mod( 'furniture_decor_discount_text1' );
    $furniture_decor_discount_text2  = get_theme_mod( 'furniture_decor_discount_text2' );
    ?>
    <?php if ( $furniture_decor_header_setting ){?>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 align-self-center">
                    <?php if ( $furniture_decor_social_icon ){?>
                        <div class="social-links">
                          <?php 
                            $furniture_decor_social_link1 = get_theme_mod( 'furniture_decor_social_link_1' );
                            $furniture_decor_social_link2 = get_theme_mod( 'furniture_decor_social_link_2' );
                            $furniture_decor_social_link3 = get_theme_mod( 'furniture_decor_social_link_3' );
                            $furniture_decor_social_link4 = get_theme_mod( 'furniture_decor_social_link_4' );

                            if ( ! empty( $furniture_decor_social_link1 ) ) {
                              echo '<a class="social1" href="' . esc_url( $furniture_decor_social_link1 ) . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                            }
                            if ( ! empty( $furniture_decor_social_link2 ) ) {
                              echo '<a class="social2" href="' . esc_url( $furniture_decor_social_link2 ) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
                            } 
                            if ( ! empty( $furniture_decor_social_link3 ) ) {
                              echo '<a class="social3" href="' . esc_url( $furniture_decor_social_link3 ) . '" target="_blank"><i class="fab fa-instagram"></i></a>';
                            }
                            if ( ! empty( $furniture_decor_social_link4 ) ) {
                              echo '<a class="social4" href="' . esc_url( $furniture_decor_social_link4 ) . '" target="_blank"><i class="fab fa-pinterest-p"></i></a>';
                            }
                          ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4 col-md-4 align-self-center">
                    <?php if ( $furniture_decor_discount_text1 ){?>
                        <p><?php echo esc_html( $furniture_decor_discount_text1 );?></p>
                    <?php } ?>
                </div>
                <div class="col-lg-4 col-md-4 align-self-center">
                   <?php if ( $furniture_decor_discount_text2 ){?>
                        <p class="discount2"><?php echo esc_html( $furniture_decor_discount_text2 );?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php
}
endif;
add_action( 'furniture_decor_top_header', 'furniture_decor_top_header', 20 );


if( ! function_exists( 'furniture_decor_header' ) ) :
/**
 * Header Start
*/
function furniture_decor_header(){
    $header_image = get_header_image();
    $furniture_decor_sticky_header = get_theme_mod('furniture_decor_sticky_header');
    ?>
    <div id="page-site-header" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
        <header id="masthead" data-sticky="<?php echo $furniture_decor_sticky_header; ?>" class="site-header header-inner" role="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 align-self-center">
                        <?php furniture_decor_site_branding(); ?>
                    </div>
                    <div class="col-lg-7 col-md-1 align-self-center">
                        <?php furniture_decor_navigation(); ?>
                    </div>
                    <div class="col-lg-1 col-md-12 align-self-center">
                        <?php if(class_exists('woocommerce')){ ?>
                            <div class="product-account">
                                <?php if ( is_user_logged_in() ) { ?>
                                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','furniture-decor'); ?>"><i class="fas fa-user"></i></a>
                                <?php } 
                                else { ?>
                                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','furniture-decor'); ?>"><i class="fas fa-user"></i></a>
                                <?php } ?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-lg-1 col-md-12 align-self-center">
                        <?php if(class_exists('woocommerce')){ ?>
                            <div class="product-cart">
                                <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','furniture-decor' ); ?>"><i class="fas fa-shopping-cart"></i></a>
                                <span class="item-count"> Cart (<?php echo esc_html(wp_kses_data(WC()->cart->get_cart_contents_count())); ?>)</span>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <?php
}
endif;
add_action( 'furniture_decor_header', 'furniture_decor_header', 20 );