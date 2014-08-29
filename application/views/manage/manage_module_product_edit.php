<td id="right_area">
<form id="submit_form" method="post" action="/ManageProduct/SaveEdit">
    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="<?= $pre_url ?>" title="返回" class="back_btn op_btn"></a>
                    <a href="javascript:void(0)" onclick="save()" title="保存" class="save_btn op_btn"></a>
                </div>
            </td>
            <td style="width: 100%">
                <div class="op_content">
                    <div class="location">位置：产品展示 -> 编辑</div>
                    <input type="hidden" name="id" value="<?= $query->id ?>"/>
                    <div style="text-align: left; margin-bottom: 20px;">
                        <span class="yai_hei size1 color1">标题</span>
                        <input name="title" style="text-align: left;width:800px" type="text" value="<?= $query->title ?>"/>
                    </div>
                    <input type="hidden" name="author" value=""/>
                    <textarea name="body" id="body" rows="10" cols="80">
                        <?= $query->body ?>
                    </textarea>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="javascript:void(0)" onclick="show_add_panel()" title="添加" class="add_btn op_btn"></a>
                </div>
            </td>
            <td style="width: 100%">
                <div class="op_content">
                    <div class="op_title">产品案例</div>
                    <table id="case" class="content_table">
                        <?php if (isset($query2) && count($query2) > 0): ?>
                            <?php for ($i = 0; $i < count($query2); $i++): ?>
                                <tr id="case_tr<?=$i?>">
                                    <td style='width: 100%' id="case_title_<?=$i?>"><?= $query2[$i]->title ?></td>
                                    <td>
                                        <a href='#' onclick='show_edit_panel(<?=$i?>)'>编辑</a>
                                        <input type='hidden' name='case[<?=$i?>][]' value="<?=$query2[$i]->id?>"/>
                                        <input type='hidden' name='case[<?=$i?>][]' value="<?=rawurlencode($query2[$i]->title)?>"/>
                                        <input type="hidden" name='case[<?=$i?>][]' value="<?=rawurlencode($query2[$i]->body)?>"/>
                                    </td>
                                    <td>
                                        <a href='#' onclick='pre_remove(<?=$i?>)'>删除</a>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <input name="remove_case_ids" type="hidden"/>
</form>
<div class="dialog" id="op_panel">
    <div class="dialog_title_panel">
        <div class="dialog_title" id="op_title">
            标题
        </div>
        <div class="dialog_close" onclick="dialog_close()"></div>
    </div>
    <div class="dialog_content">
        <div class="form_block">
            <span>标题</span>
            <input id="case_title" name="case_title" type="text" style="width: 400px"/>
        </div>
        <textarea name="case_body" id="case_body">
        </textarea>
        <input type="hidden" name="op_type" value=""/>
        <input type="hidden" name="edit_index" value="">

        <div style="text-align: center">
            <input class="btn1" type="button" style="margin-top: 20px;"
                   onclick="op_case()" value="确定">
            <input class="btn1" type="button" style="margin-left: 20px;margin-top: 20px;" value="取消"
                   onclick="dialog_close()">
        </div>
    </div>
</div>
<div id="delete_confirm_panel" class="dialog">
    <div class="dialog_title_panel">
        <div class="dialog_title">确认删除</div>
        <div class="dialog_close" onclick="dialog_close()">
        </div>
    </div>
    <div class="dialog_content">
        <input type="hidden" id="deleted_index"/>
        <div style="text-align: center">
            <input type="button" class="btn1" value="确定" onclick="delete_case()">
            <input type="button" class="btn1" value="取消"
                   onclick="dialog_close()">
        </div>
    </div>
</div>
<style type="text/css">
    .op_content {
        _height: auto !important;
        min-height: 0 !important;
    }
</style>


<!------------------------------>

<link rel="stylesheet" href="/plugins/kindeditor/themes/default/default.css"/>
<script charset="utf-8" src="/plugins/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugins/kindeditor/lang/zh_CN.js"></script>
<script>
    var editor;
    var case_editor;
    var remove_case_ids = [];
    KindEditor.ready(function (K) {
        editor = K.create('textarea[name="body"]', {
            allowFileManager: true,
            width: '95%',
            height: '280px'
        });
        case_editor = KindEditor.create('textarea[name="case_body"]', {
            allowFileManager: true,
            width: '800px',
            height: '400px'
        });
        dialog_center(".dialog");
    });
    function save() {
        $("#body").val(editor.html());
        $("input[name='remove_case_ids']").val(remove_case_ids);
        $('#submit_form').submit();
    }
    function show_add_panel() {
        case_editor.html('');
        $("input[name='case_title']").val("");
        $("input[name='op_type']").val("add");
        $('#op_title').text("添加案例");
        dialog_show("op_panel",rs_case_editor);
    }
    function show_edit_panel(index) {
        var items = $("input[name='case[" + index + "][]']");
        $('input[name="case_title"]').val(decodeURIComponent(items.eq(1).val()));
        case_editor.html(decodeURIComponent(items.eq(2).val()));
        $("input[name='op_type']").val("edit");
        $("input[name='edit_index']").val(index);
        $('#op_title').text("编辑案例");
        dialog_show("op_panel",rs_case_editor);
    }
    function rs_case_editor(){
        case_editor.resize('800px', '400px');
    }
    function op_case() {
        var type = $("input[name='op_type']").val();
        switch (type) {
            case "add":
                add_case();
                break;
            case "edit":
                edit_case();
                break;
        }
    }
    function add_case() {
        var num = get_case_index();
        var html_str = "";
        var title = $('input[name="case_title"]').val();
        var body = case_editor.html();
        html_str += "<tr id='case_tr" + get_case_index() + "'>";
        html_str += "<td  style='width: 100%' id='case_title_" + get_case_index() + "'>";
        html_str += title
        html_str += "</td>";
        html_str += "<td>";
        html_str += "<a href='#' onclick='show_edit_panel" + "(" + get_case_index() + ")" + "'>编辑</a>";
        html_str += "<input type='hidden' name='case[" + get_case_index() + "][]'/>";
        html_str += "<input type='hidden' value='"+encodeURIComponent(title)+"' name='case[" + get_case_index() + "][]'/>";
        html_str += "<input type='hidden' value='"+encodeURIComponent(body)+"' name='case[" + get_case_index() + "][]'/>";
        html_str += "</td>";
        html_str += "<td>";
        html_str += "<a href='#' onclick='pre_remove" + "(" + get_case_index() + ")" + "'>删除</a>";
        html_str += "</td>";
        $("#case").append(html_str);
        dialog_close();
    }
    function edit_case() {
        var index = $("input[name='edit_index']").val();
        var items = $("input[name='case[" + index + "][]']");
        var title = $('input[name="case_title"]').val();
        var body = case_editor.html();
        $('#case_title_'+index).html(title);
        items.eq(1).val(encodeURIComponent(title));
        items.eq(2).val(encodeURIComponent(body));
        dialog_close();
    }
    function delete_case() {
        var index = $('#deleted_index').val();
        var item = $('#case_tr' + index + '');
        var remove_id= $("input[name='case[" + index + "][]']").eq(0).val();
        if(!(remove_id==="")){
            remove_case_ids.push(remove_id)
        }
        item.remove();
        dialog_close();
    }
    function pre_remove(index) {
        $('#deleted_index').val(index);
        dialog_show("delete_confirm_panel");
    }
    function get_case_index() {
        var tr_count = $('#case tr').length;
        return tr_count + 1;
    }

</script>
</td>
