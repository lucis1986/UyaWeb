<td id="right_area">
<style type="text/css">
    .form_area div {
        margin-bottom: 2em;
    }

    .form_area div label {
        width: 80px;
        display: inline-block;
    }

    .form_area div input {
        width: 500px;
    }

    .browser {
        display: inline-block;
        width: 100px;
        border: 1px solid #8a8a8a;
        background: #ccc;
        text-align: center;
        cursor: pointer;
        color: #838383;
    }

    #doc_table {
        width: 100%;
        border-collapse: collapse;
        height: 700px;
    }

    #doc_table td {
        border: 1px solid #CCCCCC;

    }

    .doc_list {
        width: 90%;
        border-collapse: collapse;
        margin: 20px;
    }

    .doc_list {
        border: 1px solid #CCCCCC;

    }

    .doc_list td {
        padding: 0 10px;
        white-space: nowrap;
        line-height: 25px;
    }
</style>
<link rel="stylesheet" href="/plugins/ztree/css/zTreeStyle/zTreeStyle.css"/>

<style type="text/css">
    .ztree li span.button.folder_ico_open {
        background: url('/plugins/ztree/css/zTreeStyle/img/folder/2.png');
    }

    .ztree li span.button.folder_ico_close {
        background: url('/plugins/ztree/css/zTreeStyle/img/folder/2.png');
    }

    .ztree li span.button.folder_ico_docu {
        background: url('../../../plugins/ztree/css/zTreeStyle/img/folder/2.png');
    }

</style>


<table id="doc_table">
    <tr>
        <td style="border-left: none;border-top: none; vertical-align: top;">
            <div id="tree_op_panel"
                 style="height: 40px;line-height: 40px; vertical-align:middle; visibility: hidden">
                <input style="margin-left: 6px;" class="menu_button" type="button" value="添加根节点"
                       onclick="show_add_panel('upload')"/><input class="menu_button" type="button" value="添加子节点"
                                                                  onclick="
                                                                    var node=get_selected_node();
                                                                    if(node){
                                                                        show_add_panel(node.path);
                                                                    }else{
                                                                        alert('请先选择父结点');
                                                                    }
                                                                  "/>
            </div>
            <div style="overflow: auto;height: 659px; position: relative">
                <ul style="width: 200px; " id="doc_tree" class="ztree">
                </ul>
            </div>
        </td>
        <td style="border-top: none;width: 100%;vertical-align: top">
            <div class="fieldset flash" id="fsUploadProgress1">
                <span class="legend">Large File Upload Site</span>
            </div>
            <div>
            <span id="spanButtonPlaceholder1"></span><input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
            <br />
            </div>
            <div id="doc_files"></div>
        </td>
    </tr>
</table>
<form id="download_form" target="_blank" method="post" action="/Services/Download">
    <input type="hidden" name="path"/>
    <input type="hidden" name="name"/>
</form>
<div id="mask"
     style="background: black;position: fixed; opacity: 0.3; top:0;left:0;display: none; width:9999px;height: 9999px;z-index: 999">
</div>
<div id="module_op_panel"
     style="width: 300px;height:400px;background: white;position: fixed; display: none;z-index: 999">
    <div style="position: relative; height: 30px; background: #ccc;text-align: left">
        <label id="module_op_title" style="line-height: 30px;height: 30px;margin-left: 10px;"></label>

        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="dialog_close()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <div id="module_op">
            <div class="form_block">
                <span>标题</span>
                <input id="title" name="title" type="text" style="width: 120px"/>
            </div>
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;"
                   onclick="add_node()" value="提交">
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="取消"
                   onclick="dialog_close()">
        </div>
    </div>
</div>
<div id="delete_confirm_panel"
     style="width: 300px;height:300px;background: white;position: fixed; display: none;z-index: 999">
    <div style="position: relative; height: 30px; background: #ccc;text-align: left">
        <label style="line-height: 30px;height: 30px;margin-left: 10px;">确认删除</label>

        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="dialog_close()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <form method="post" action="/Services/DeleteInfoModule">
            <input type="hidden" name="module_ids"/>
            <input type="submit" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="确定">
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="取消"
                   onclick="dialog_close()">
        </form>
    </div>

</div>
<script type="text/javascript" src="/plugins/ztree/js/jquery.ztree.all-3.5.js"></script>

<script type="text/javascript" src="/plugins/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/plugins/SWFUpload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="/plugins/SWFUpload/js/fileprogress.js"></script>
<script type="text/javascript" src="/plugins/SWFUpload/js/handlers.js"></script>
<script type="text/javascript">
    var path="";
    var upload1;
    var zTreeObj,
        setting = {
            view: {
                selectedMulti: false
            },
            async: {
                enable: true,
                url: "/Services/GetNodes"
            },
            callback: {
                onAsyncSuccess: zTreeOnAsyncSuccess,
                onClick: zTreeOnClick
            }

        }
    function zTreeOnAsyncSuccess(event, treeId, treeNode, msg) {
        $('#tree_op_panel').css('visibility', 'visible')
    }

    function zTreeOnClick(event, treeId, treeNode) {
        var select_path = treeNode.path;
        $("#doc_files").html("loading...");
        $.ajax({
            method: 'post',
            url: "/Services/GetPathFiles",
            data: {
                path: select_path
            },
            dataType: 'json',
            success: function (files_data) {
                $("#doc_files").empty();
                var html_str = "";
                if (files_data.length > 0) {
                    html_str += "<table class='doc_list'>"
                    for (var i = 0; i < files_data.length; i++) {
                        html_str += "<tr>";
                        html_str += "<td style='width: 100%'>";
                        html_str += files_data[i].text;
                        html_str += "</td>";
                        html_str += "<td>";
                        html_str += "<a href='#' onclick='file_download(this)'>下载</a>";
                        html_str += "<input type='hidden' name='name' value='" + files_data[i].text + "'/>";
                        html_str += "<input type='hidden' name='path' value='" + files_data[i].path + "'/>";
                        html_str += "</td>";
                    }
                    html_str += "</table>"
                }
                $("#doc_files").append(html_str);
            },

            error: function () {
                alert("error");
            }
        })

    }

    $(function () {
        div_center("module_op_panel");
        div_center("delete_confirm_panel");
        onWindowResize.add(function () {
            div_center("module_op_panel");
            div_center("delete_confirm_panel");
        });
        zTreeObj = $.fn.zTree.init($("#doc_tree"), setting);

        upload_set()
    });
    function upload_set(){
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
    function file_download(item) {
        var name = $(item).parent().find("input[name='name']").val();
        var path = $(item).parent().find("input[name='path']").val();
        $("#download_form input[name='name']").val(name);
        $("#download_form input[name='path']").val(path);
        $("#download_form").submit();
    }
    function show_add_panel(path) {
        this.path=path;
        $('#module_op_panel').css('display', "block");
        $('#mask').css('display', 'block');
        $('#module_op_title').text("添加根结点");
    }
    function add_node() {

        var title = $("input[name='title']").val();
        $.ajax({
            method: "POST",
            async: false,
            url: "/Services/AddDocNode",
            data: {
                "path": path,
                "title": title
            },
            success: function (d) {
                if (d != false) {
                    var treeObj = $.fn.zTree.getZTreeObj("doc_tree");
                    var newNode = {"name": title, "iconSkin": "folder","path":d};
                    treeObj.addNodes(path=="upload"?null:get_selected_node(), newNode);
                } else {
                    alert("error");
                }
                dialog_close();
            },
            error: function () {
                alert("error");
            }
        });

    }
    function get_selected_node(){
        var treeObj = $.fn.zTree.getZTreeObj("doc_tree");
        var nodes = treeObj.getSelectedNodes();
        if(nodes.length>0){
            return nodes[0];
        }else{
            return false;
        }
    }
    function dialog_close() {
        $('#module_op_panel').css('display', "none");
        $('#delete_confirm_panel').css('display', "none");
        $('#mask').css('display', 'none');
    }
</script>
</td>
