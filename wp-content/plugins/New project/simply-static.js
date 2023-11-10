(function($) {
  $(document).ready(function() {
    // Function to generate the static website
    function generateStaticWebsite() {
      $.ajax({
        url: simplyStatic.ajaxUrl,
        method: 'POST',
        data: {
          action: 'simply_static_generate_website'
        },
        success: function(response) {
          if (response.success) {
            console.log(response.data);
            // Display success message
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

    // Call the generateStaticWebsite function on button click or any event
    $('#generate-static-website-button').on('click', function() {
      generateStaticWebsite();
    });
  });
})(jQuery);