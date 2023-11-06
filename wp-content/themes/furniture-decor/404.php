<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package furniture_decor
 */

get_header(); ?>
	<main id="main" class="site-main" role="main">
		<div class="error-holder">
			<h1><?php esc_html_e( '404', 'furniture-decor' ); ?></h1>
			<h2><?php esc_html_e( 'Sorry, that page can\'t be found!', 'furniture-decor' ); ?></h2>
			<p class="btn-green mt-3 mb-0">
          		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'furniture-decor' ); ?></a>
            </p>
        </div>
	</main>
	<?php
get_footer();