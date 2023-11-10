<?php

/*
Template Name: User Profile Page
*/

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        // Display the post content here

        // Get the user ID
        $user_id = get_current_user_id();

        // Get the user meta fields
        $nickname = get_user_meta($user_id, 'nickname', true);
        $age = get_user_meta($user_id, 'age', true);
        $tall = get_user_meta($user_id, 'tall', true);

        // Display the user profile fields
        echo '<h2>Nickname: ' . $nickname . '</h2>';
        echo '<p>Age: ' . $age . '</p>';
        echo '<p>Tall: ' . $tall . '</p>';
    }
}

get_footer();