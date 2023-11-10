<?php

function download_video($url) {
    // Generate a unique file name
    $file_name = 'video_' . time() . '.' . pathinfo($url, PATHINFO_EXTENSION);

    // Retrieve the video file from the URL
    $response = wp_remote_get($url);

    // Check if the request was successful
    if (is_wp_error($response)) {
        return false;
    }

    // Get the video file contents
    $video_data = wp_remote_retrieve_body($response);

    // Save the video file to the server
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['path'] . '/' . $file_name;

    if (file_put_contents($file_path, $video_data)) {
        return $file_name;
    } else {
        return false;
    }
}