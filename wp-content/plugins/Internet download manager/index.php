<?php
/*
Plugin Name: Download Manager
Plugin URI: https://example.com/
Description: Allows users to download files from the internet.
Version: 1.0
Author: CodeWP Assistant
Author URI: https://codewp.ai/
License: GPL v2 or later
*/

// Enqueue the JavaScript file for handling the file downloads
function download_manager_enqueue_scripts() {
    wp_enqueue_script( 'download-manager', plugin_dir_url( __FILE__ ) . 'assets/js/download-manager.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'download_manager_enqueue_scripts' );

// Create a shortcode to display the download button
function download_manager_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'url' => '',
        'title' => 'Download',
    ), $atts );

    return '<button class="download-manager-button" data-url="' . esc_url( $atts['url'] ) . '">' . esc_html( $atts['title'] ) . '</button>';
}
add_shortcode( 'download', 'download_manager_shortcode' );

// Register AJAX action to handle file downloads
add_action( 'wp_ajax_download_file', 'download_file' );
add_action( 'wp_ajax_nopriv_download_file', 'download_file' );

// Function to handle file downloads
function download_file() {
    $url = isset( $_POST['url'] ) ? $_POST['url'] : '';

    if ( empty( $url ) ) {
        wp_send_json_error( 'Invalid file URL.' );
    }

    // Retrieve the file contents from the URL
    $response = wp_remote_get( $url );

    // Check if the request was successful
    if ( is_wp_error( $response ) ) {
        wp_send_json_error( 'Failed to download file.' );
    }

    $file_data = wp_remote_retrieve_body( $response );

    // Generate a unique file name
    $file_name = 'download_' . time();

    // Save the file to the uploads directory
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['path'] . '/' . $file_name;

    if ( file_put_contents( $file_path, $file_data ) ) {
        wp_send_json_success( array(
            'file_url' => $upload_dir['url'] . '/' . $file_name,
        ) );
    } else {
        wp_send_json_error( 'Failed to save file.' );
    }
}
?>