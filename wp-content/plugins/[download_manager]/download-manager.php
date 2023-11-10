<?php

function add_download_preview_buttons() {
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      // Get the download URL for the file
      $download_url = get_post_meta(get_the_ID(), 'download_url', true);
      // Get the preview URL for the file
      $preview_url = get_post_meta(get_the_ID(), 'preview_url', true);

      // Output the Download button
      if (!empty($download_url)) {
        echo '<a href="' . esc_url($download_url) . '" class="download-button">Download</a>';
      }

      // Output the Preview button
      if (!empty($preview_url)) {
        echo '<a href="' . esc_url($preview_url) . '" class="preview-button">Preview</a>';
      }
    }
  }
}
add_action('archive_template', 'add_download_preview_buttons');