<td id="right_area">
    <div style=" margin-left: 20px;">
        <span style="height: 30px;line-height: 30px;">位置：<?= $module->title ?>->添加</span><input
            style="margin-left: 20px" type="button"
            class="menu_button"
            onclick="window.location='<?= $pre_url ?>'"
            value="返回"/><input
            type="button" class="menu_button" onclick="GetContents()" value="保存"/>
    </div>

    <div>
        <form id="news_form" method="post" action="/management/save/<?= $module_id ?>">
            <div style="text-align: left;">
                <span
                    style="width: 100px;height:40px;line-height:40px;display: inline-block;text-align: left;text-indent: 20px;">标题</span><input
                    name="title" style="text-align: left;width:800px"
                    type="text" value=""/>
            </div>
            <input type="hidden" name="pre_url" value="<?= $pre_url ?>">
            <input type="hidden" name="author" value=""/>
            <textarea name="body" id="body" rows="10" cols="80">

            </textarea>
        </form>
        <style>
            textarea {
                display: block;
            }
        </style>
        <link rel="stylesheet" href="/plugins/kindeditor/themes/default/default.css"/>
        <script charset="utf-8" src="/plugins/kindeditor/kindeditor-min.js"></script>
        <script charset="utf-8" src="/plugins/kindeditor/lang/zh_CN.js"></script>
        <script>
            var editor;
            KindEditor.ready(function(K) {
                editor = K.create('textarea[name="body"]', {
                    allowFileManager : true,
                    width:'95%',
                    height:'629px'
                });
            });
            function GetContents() {
                $("#body").val(editor.html());
                $('#news_form').submit();
            }
        </script>
    </div>
</td>