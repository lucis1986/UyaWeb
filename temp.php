<div style=" margin-left: 20px;">
    <span style="height: 30px;line-height: 30px;">位置：产品展示->编辑</span><input
        style="margin-left: 20px" type="button"
        class="menu_button"
        onclick="window.location='<?= $pre_url ?>'"
        value="返回"/><input
        type="button" class="menu_button" onclick="save()" value="保存"/>
</div>
<div>
    <form id="news_form" method="post" action="/ManageProduct/SaveEdit">
        <div style="text-align: left;">
                <span
                    style="width: 100px;height:40px;line-height:40px;display: inline-block;text-align: left;text-indent: 20px;">标题</span><input
                name="title" style="text-align: left;width:800px"
                type="text" value="<?= $query->title ?>"/>
        </div>
        <input type="hidden" name="id" value="<?= $query->id ?>"/>
        <input type="hidden" name="author" value=""/>
        <textarea name="body" id="body" rows="10" cols="80">
            <?= $query->body ?>
        </textarea>
        <input type="button" onclick="show_add_panel()" value="添加案例"/>
        <table id="case">
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
        <input type="hidden" name="remove_case_ids"/>
    </form>

</div>
<div id="mask"
     style="background: black;position: fixed; opacity: 0.3; top:0;left:0;display: none; width:9999px;height: 9999px;z-index: 999">
</div>
<div id="op_panel"
     style="width: 800px;height:600px;background: white;position: fixed; display: none;z-index: 999">
    <div style="position: relative; height: 30px; background: #ccc;text-align: left">
        <label id="op_title" style="line-height: 30px;height: 30px;margin-left: 10px;"></label>

        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="dialog_close()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <div id="op">
            <div class="form_block">
                <span>标题</span>
                <input id="case_title" name="case_title" type="text" style="width: 300px"/>

            </div>
            <textarea name="case_body" id="case_body">
            </textarea>
            <input type="hidden" name="op_type" value=""/>
            <input type="hidden" name="edit_index" value="">
            <input id="add_button" type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;"
                   onclick="op_case()" value="确定">
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
        <div>
            <input type="hidden" id="deleted_index"/>
            <input type="button" onclick="delete_case()"
                   style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="确定">
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="取消"
                   onclick="dialog_close()">
        </div>
    </div>

</div>
<style>
    textarea {
        display: block;
    }

    #case {
        margin-left: 20px;
        border-collapse: collapse;
        width: 90%;
    }

    #case td {
        line-height: 25px;
        border: 1px solid #9d9d9d;
        padding: 0 10px;
        white-space: nowrap;

    }
</style>