/*
Template Name: Ubold - Responsive Bootstrap 5 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: File uploads init js
*/

import 'dropzone/dist/min/dropzone.min.js';
Dropzone.autoDiscover = false;


// Dropzone
// Dropzone Initialization
!function ($) {
    "use strict";

    var FileUpload = function () {
        this.$body = $("body");
    };

    FileUpload.prototype.init = function () {
        // Disable auto discovery of Dropzone
        Dropzone.autoDiscover = false;

        $('[data-plugin="dropzone"]').each(function () {
            var actionUrl = $(this).attr('action');
            var previewContainer = $(this).data('previewsContainer');

            // Set Dropzone options
            var opts = {
                url: actionUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
                },
                // Handle the response from the controller
                success: function(file, response) {
                    // If the response contains errors, handle them
                    if (response.errors) {
                        // Remove any existing files
                        this.removeAllFiles(true);

                        // Loop through errors and display them
                        response.errors.forEach(function(error) {
                            // You can display the errors however you want, for now, console log
                            console.log(error);
                        });

                        // Optionally, you can show these errors on the UI
                        alert('Validation failed: ' + response.errors.join(', '));
                    } else {
                        // If the upload was successful, you can handle the response here
                        console.log('File uploaded successfully:', response);
                    }
                },

                // Handle file removal
                removedfile: function(file) {
                    let fileName = file.name;

                    // Send DELETE request to backend to delete the file
                    $.ajax({
                        url: '/file-upload/' + fileName, // Use the correct URL for file deletion
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function(response) {
                            console.log('File deleted successfully:', response);
                        },
                        error: function(response) {
                            console.log('Error in deletion:', response);
                        }
                    });
                },

                // Handle errors from the server (e.g., file too large, invalid type, etc.)
                error: function(file, response) {
                    // You can customize how errors are handled here
                    var errorMessage = (response.message) ? response.message : 'File upload error';
                    $(file.previewElement).find('.dz-error-message').text(errorMessage);
                },

                // Optionally, show success messages or handle preview templates
                previewTemplate: $(this).data("uploadPreviewTemplate") ? $(this).data("uploadPreviewTemplate").html() : '',
                previewsContainer: $(this).data('previewsContainer') ? $(this).data('previewsContainer') : '',
            };

            // Initialize Dropzone
            $(this).dropzone(opts);
        });
    };

    $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload;

}(window.jQuery);

// Initializing FileUpload
(function ($) {
    "use strict";
    $.FileUpload.init();
})(window.jQuery);
