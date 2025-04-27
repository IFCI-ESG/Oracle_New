/*
Template Name: Ubold - Responsive Bootstrap 5 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: File uploads init js
*/

import 'dropzone/dist/min/dropzone.min.js';
Dropzone.autoDiscover = false;
import 'dropify/dist/js/dropify.min.js';

// Dropzone
!function ($) {
    "use strict";

    var FileUpload = function () {
        this.$body = $("body")
    };

    /* Initializing */
    FileUpload.prototype.init = function () {
        // Disable auto discovery
        Dropzone.autoDiscover = false;

        $('[data-plugin="dropzone"]').each(function () {
            var actionUrl = $(this).attr('action');
            var previewContainer = $(this).data('previewsContainer');

            var opts = { 
                url: actionUrl, 
               // maxFilesize: 5, // Maximum file size in MB
               // acceptedFiles: 'csv/*', // Accept only images
            };

            if (previewContainer) {
                opts['previewsContainer'] = previewContainer;
            }

            var uploadPreviewTemplate = $(this).data("uploadPreviewTemplate");
            if (uploadPreviewTemplate) {
                opts['previewTemplate'] = $(uploadPreviewTemplate).html();
            }

            // Initialize Dropzone
            var dropzoneEl = $(this).dropzone(opts);

            // Add event listeners for error and success handling
            dropzoneEl.on("success", function (file, response) {
                if (response.success) {
                    // Show success message
                    $('<p class="text-success">File uploaded successfully: ' + file.name + '</p>')
                        .appendTo($(previewContainer || '#dropzone-messages'));
                } else {
                    // Show server-side error message
                    $('<p class="text-danger">Error: ' + (response.message || 'An error occurred') + '</p>')
                        .appendTo($(previewContainer || '#dropzone-messages'));
                }
            });

            dropzoneEl.on("error", function (file, response) {
    console.log("Server Response:", response); // Debug response structure

    var errorMessage = typeof response === "string"
        ? response
        : (response.message || "An unknown error occurred");

    console.log("Parsed Error Message:", errorMessage); // Debug parsed error message

    $('<p class="text-danger">Error: ' + errorMessage + '</p>')
        .appendTo($(previewContainer || '#dropzone-messages'));
});

        });
    },

        //init fileupload
        $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload

}(window.jQuery),

//initializing FileUpload
function ($) {
    "use strict";
    $.FileUpload.init()
}(window.jQuery);


// Dropify
if ($('[data-plugins="dropify"]').length > 0) {
    $('[data-plugins="dropify"]').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something went wrong.'
        },
        error: {
            'fileSize': 'The file size is too big (1M max).'
        }
    });

    // Add event listeners for Dropify
    $('[data-plugins="dropify"]').on('dropify.errors', function (event, element) {
        // Show Dropify error message
        $('<p class="text-danger">Error: ' + element.error.fileSize + '</p>')
            .appendTo('#dropify-messages');
    });

    $('[data-plugins="dropify"]').on('dropify.afterClear', function (event, element) {
        // Show message when file is removed
        $('<p class="text-warning">File removed successfully.</p>')
            .appendTo('#dropify-messages');
    });
}




