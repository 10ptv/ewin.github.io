(function($) {
    $(document).ready(function() {
      // Function to handle file downloads
      function downloadFile(url) {
        $.ajax({
          url: ajaxurl,
          method: 'POST',
          data: {
            action: 'download_file',
            url: url
          },
          success: function(response) {
            if (response.success) {
              console.log(response.data.file_url);
              // Download the file using the generated URL
              window.location.href = response.data.file_url;
            } else {
              console.log(response.data);
              // Display error message
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
            // Display error message
          }
        });
      }
  
      // Handle download button click event
      $('.download-manager-button').on('click', function() {
        var url = $(this).data('url');
        downloadFile(url);
      });
    });
  })(jQuery);