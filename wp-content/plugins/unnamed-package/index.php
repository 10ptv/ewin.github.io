<?php

/*
Template Name: Custom Home Page
*/

get_header();

$args = array(
    'post_type' => 'video',
    'posts_per_page' => 1 // Adjust the number of videos to show as needed
);

$videos_query = new WP_Query( $args );

if ( $videos_query->have_posts() ) {
    while ( $videos_query->have_posts() ) {
        $videos_query->the_post();
        // Display the video content here
        the_title();
        the_content();
    }
} else {
    // No videos found
}

// Add your AdSense code here

get_footer();