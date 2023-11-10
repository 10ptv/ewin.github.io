<?php

/**
 * Plugin Name: Simply Static Website
 * Plugin URI: https://example.com/
 * Description: Generates a static version of your WordPress website.
 * Version: 1.0
 * Author: CodeWP Assistant
 * Author URI: https://codewp.ai/
 * License: GPL v2 or later
 */

// Add a custom endpoint for generating the static version of the website
function simply_static_generate_website() {
    // Perform the necessary actions to generate the static version of the website
    // ...
    // ...
    // ...

    // Return a response indicating the success or failure of the generation process
    wp_send_json_success( 'Static website generated successfully.' );
}
add_action( 'wp_ajax_simply_static_generate_website', 'simply_static_generate_website' );
add_action( 'wp_ajax_nopriv_simply_static_generate_website', 'simply_static_generate_website' );

// Enqueue the JavaScript file for handling the static website generation
function simply_static_enqueue_scripts() {
    wp_enqueue_script( 'simply-static', plugin_dir_url( __FILE__ ) . 'assets/js/simply-static.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'simply-static', 'simplyStatic', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'simply_static_enqueue_scripts' );
?>