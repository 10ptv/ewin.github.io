<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package furniture_decor
 */

$furniture_decor_preloader = get_theme_mod( 'furniture_decor_header_preloader', false );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
    
    <?php if ( $furniture_decor_preloader ){?>
		<div class="preloader">
	        <div class="load">
	          <div class="loader"></div>
	        </div>
	    </div>
	<?php } ?>
    
    <div class="mobile-nav">
		<button class="toggle-button" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
			<span class="toggle-bar"></span>
			<span class="toggle-bar"></span>
			<span class="toggle-bar"></span>
		</button>
		<div class="mobile-nav-wrap">
			<nav class="main-navigation" id="mobile-navigation"  role="navigation">
				<div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
		            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
		            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'furniture-decor' ); ?>">
		                <?php
		                    wp_nav_menu( array(
		                        'theme_location' => 'primary',
		                        'menu_id'        => 'mobile-primary-menu',
		                        'menu_class'     => 'nav-menu main-menu-modal',
		                    ) );
		                ?>
		            </div>
		        </div>
			</nav>
		</div>
	</div>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'furniture-decor' ); ?></a>
		
		<?php
		/**
		 * furniture_decor_top_header
		 * 
		 * @hooked furniture_decor_top_header - 20
		*/
		do_action( 'furniture_decor_top_header' );

		/**
		 * furniture_decor Header
		 * 
		 * @hooked furniture_decor_header - 20
		*/
		do_action( 'furniture_decor_header' );
		
		echo '<div id="acc-content"><!-- done for accessiblity purpose -->';
			echo '<div class="wrapper">';
			echo '<div class="container home-container">';
			echo '<div id="content" class="site-content">';

			if( is_search() ){ echo '<div class="row">'; }