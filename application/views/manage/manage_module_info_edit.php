<td id="right_area">
    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="<?= $pre_url ?>" title="返回" class="back_btn op_btn"></a>
                    <a href="#" onclick="save()" title="保存" class="save_btn op_btn"></a>
                </div>
            </td>
            <td style="width: 100%">
                <div class="op_content">
                    <div class="location">位置：<?= $module->title ?> -> 编辑</div>
                    <form id="news_form" method="post" action="/management/update/<?= $query->module_id ?>">
                        <div style="text-align: left; margin-bottom: 20px;">
                            <span class="yai_hei size1 color1">标题</span>
                            <input name="title" style="text-align: left;width:800px" type="text"
                                   value="<?= $query->title ?>"/>
                        </div>
                        <input type="hidden" name="id" value="<?= $query->id ?>"/>
                        <input type="hidden" name="pre_url" value="<?= $pre_url ?>">
                        <input type="hidden" name="author" value=""/>
                        <textarea name="body" id="body" rows="10" cols="80">
                            <?= $query->body ?>
                        </textarea>
                    </form>
                </div>
            </td>
        </tr>
    </table>
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
        KindEditor.ready(function (K) {
            editor = K.create('textarea[name="body"]', {
                allowFileManager: true,
                extraFileUploadParams: {
                    dir: ""
                },
                width: '95%',
                height: '500px'
            });
        });
        function save() {
            $("#body").val(editor.html());
            $('#news_form').submit();
        }
    </script>

</td>
