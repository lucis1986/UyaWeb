
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/plugins/SWFUpload/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="/plugins/SWFUpload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="/plugins/SWFUpload/js/fileprogress.js"></script>
    <script type="text/javascript" src="/plugins/SWFUpload/js/handlers.js"></script>
    <script type="text/javascript">
        var upload1;

        $(function(){
            tttest();
        })
        function tttest(){
            upload1 = new SWFUpload({
                // Backend Settings
                upload_url: "/upload.php",
                post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},

                // File Upload Settings
                file_size_limit : "102400",	// 100MB
                file_types : "*.*",
                file_types_description : "All Files",
                file_upload_limit : "10",
                file_queue_limit : "0",

                // Event Handler Settings (all my handlers are in the Handler.js file)
                file_dialog_start_handler : fileDialogStart,
                file_queued_handler : fileQueued,
                file_queue_error_handler : fileQueueError,
                file_dialog_complete_handler : fileDialogComplete,
                upload_start_handler : uploadStart,
                upload_progress_handler : uploadProgress,
                upload_error_handler : uploadError,
                upload_success_handler : uploadSuccess,
                upload_complete_handler : uploadComplete,

                // Button Settings
                button_image_url : "/plugins/SWFUpload/img/XPButtonUploadText_61x22.png",
                button_placeholder_id : "spanButtonPlaceholder1",
                button_width: 61,
                button_height: 22,

                // Flash Settings
                flash_url : "/plugins/SWFUpload/swfupload/swfupload.swf",


                custom_settings : {
                    progressTarget : "fsUploadProgress1",
                    cancelButtonId : "btnCancel1"
                },

                // Debug Settings
                debug: false
            });
        }
        /*  window.onload = function() {


         upload2 = new SWFUpload({
         // Backend Settings
         upload_url: "upload.php",
         post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},

         // File Upload Settings
         file_size_limit : "200",	// 200 kb
         file_types : "*.jpg;*.gif;*.png",
         file_types_description : "Image Files",
         file_upload_limit : "10",
         file_queue_limit : "5",

         // Event Handler Settings (all my handlers are in the Handler.js file)
         file_dialog_start_handler : fileDialogStart,
         file_queued_handler : fileQueued,
         file_queue_error_handler : fileQueueError,
         file_dialog_complete_handler : fileDialogComplete,
         upload_start_handler : uploadStart,
         upload_progress_handler : uploadProgress,
         upload_error_handler : uploadError,
         upload_success_handler : uploadSuccess,
         upload_complete_handler : uploadComplete,

         // Button Settings
         button_image_url : "XPButtonUploadText_61x22.png",
         button_placeholder_id : "spanButtonPlaceholder2",
         button_width: 61,
         button_height: 22,

         // Flash Settings
         flash_url : "../swfupload/swfupload.swf",

         swfupload_element_id : "flashUI2",		// Setting from graceful degradation plugin
         degraded_element_id : "degradedUI2",	// Setting from graceful degradation plugin

         custom_settings : {
         progressTarget : "fsUploadProgress2",
         cancelButtonId : "btnCancel2"
         },

         // Debug Settings
         debug: false
         });

         }*/
    </script>
<div>
    <div class="fieldset flash" id="fsUploadProgress1">
        <span class="legend">Large File Upload Site</span>
    </div>
    <div style="padding-left: 5px;">
        <span id="spanButtonPlaceholder1"></span>
        <input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
        <br />
    </div>
</div>