<td id="right_area">
<style type="text/css" xmlns="http://www.w3.org/1999/html">
    #module_content {
        list-style: none;
    }

    ul#module_content li {
        float: left;
        margin-right: 20px;
        margin-top: 20px;

    }

    ul#module_content li a {
        width: 200px;
        height: 200px;
        line-height: 200px;
        display: block;
        border: 1px solid blue;
        text-align: center;
    }

    .form_block {
        width: 200px;
        margin-top: 20px;
        margin-left: 20px;
    }
</style>
<div style="margin-left: 20px;">
    <div id="edit_panel"><input type="button" class="menu_button"
                                onclick="show_add_panel()" value="添加"/><input
            type="button" class="menu_button" onclick="edit(this)" value="编辑"/></div>

    <div>
        <ul id="module_content" style="float: left">
            <?php foreach ($result as $row): ?>
                <li style="position: relative;">
                    <a title="<?= $row->flag ?>"
                       href="/Management/ModuleManage/<?= $row->id ?>"><?= $row->title ?></a>
                    <input type="hidden" name="module_id" value="<?= $row->id ?>"/>
                </li>
            <?php endforeach; ?>
        </ul>
        <div style="clear: both"></div>
    </div>
</div>
<div id="mask" style="background: black;position: fixed; opacity: 0.3; top:0;left:0;display: none; width:9999px;height: 9999px;z-index: 999">
</div>
<div id="module_op_panel" style="width: 300px;height:400px;background: white;position: fixed; display: none;z-index: 999">
    <div style="position: relative; height: 30px; background: #ccc;text-align: left">
        <label id="module_op_title" style="line-height: 30px;height: 30px;margin-left: 10px;"></label>
        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="dialog_close()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <form id="module_op" method="post" onsubmit="return check_module()">
            <div class="form_block">
                <span>标题</span>
                <input id="title" name="title" type="text" style="width: 120px"/>
            </div>
            <!-- <div id="title_empty" class="form_block" style="color: #ff0000">标题不能为空</div>-->
            <div class="form_block">
                <span>标识</span>
                <input id="flag" name="flag" type="text" style="width: 120px"/>
            </div>
            <div class="form_block">
                <span>模板</span>
                <select id="template" name="template">
                    <?php foreach($templates as $row):?>
                        <option title="<?=$row->description?>" value="<?=$row->id?>"><?=$row->title?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form_block" style="border: 1px solid #ccc;">
                <p id="template_description"></p>
            </div>

            <!--<div class="form_block" style="color: #ff0000">标识不能为空</div>
            <div class="form_block" style="color: #ff0000">标识只能为英文字母</div>
            <div class="form_block" style="color: #ff0000">标识已存在</div>-->

            <input name="param" type="hidden" value=""/> <!--后台中需要额外接收的参数-->
            <input type="submit" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="提交">
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="取消"
                   onclick="dialog_close()">
        </form>
    </div>
</div>
<div id="delete_confirm_panel" style="width: 300px;height:300px;background: white;position: fixed; display: none;z-index: 999">
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
<script>
    var except_self = false;
    $(function(){
        div_center("module_op_panel");
        div_center("delete_confirm_panel");
        onWindowResize.add(function () {
            div_center("module_op_panel");
            div_center("delete_confirm_panel");
        });
        $('select[name="template"]').change(function(){
            $('#template_description').html($(this).find("option:selected").attr('title'));
        })
    })
    function show_add_panel() {
        except_self = false;
        $('#module_op').attr('action', "/Services/CreateInfoModule");
        $('input[name="title"]').val("");
        $('input[name="flag"]').val("");
        var first_select= $('select[name="template"] option').first();
        $('select[name="template"]').val(first_select.val());
        $('#template_description').html(first_select.attr('title'))

        $('#module_op_panel').css('display', "block");
        $('#mask').css('display', 'block');
        $('#module_op_title').text("添加信息发布");
    }
    function show_edit_panel(item){
        except_self = true;
        var module_id = $(item).parent().find('input[name="module_id"]').val();
        $('#module_op').attr('action', '/Services/UpdateInfoModule/' + module_id);
        $.ajax({
            method: 'GET',
            async: false,
            url: "/Services/GetModule/" + module_id,
            dataType: 'json',
            success: function (data) {
                $('input[name="title"]').val(data['title']);
                $('input[name="flag"]').val(data['flag']);
                var select=$('select[name="template"]');
                select.val(data['template_id']);
                $('#template_description').html(select.find('option:selected').attr('title'));
                self_flag = data['flag'];
            },
            error: function (e) {
                alert("发生错误！");
                return;
            }
        });
        $('#module_op_panel').css('display', "block");
        $('#mask').css('display', 'block');
    }
    function edit(item){
        $(item).val("取消");
        $(item).attr('onclick', 'cancel(this)');
        $(item).after('<input type="button" class="menu_button" onclick="pre_remove()" value="删除所选"/>');
        $("#module_content li").each(function () {
            $(this).append("<input type='checkbox' style='position: absolute;top: 5px;right: 5px;width: 30px;height: 30px;'/>")
            $(this).append("<input type='button' onclick='show_edit_panel(this)' style='position: absolute;top: 5px;right: 45px;width: 40px;height: 30px;' value='编辑'/>")
        })
    }
    function cancel(item) {
        $(item).val("编辑");
        $(item).attr('onclick', 'edit(this)');
        $(item).next().remove();
        $("#module_content li").each(function () {
            $(this).find("input[type='checkbox']").remove();
            $(this).find("input[type='button']").remove();
        })
    }
    function pre_remove() {
        var remove_ids = [];
        $("#module_content li:has(input:checked)").find("input[name='module_id']").each(function () {
            remove_ids.push($(this).val());
        });
        if (remove_ids.length > 0) {
            $("input[name='module_ids']").val(remove_ids);
            $("#delete_confirm_panel").show();
            $("#mask").show();
        } else {
            alert("所选为空！")
        }

    }
    function dialog_close() {
        $('#module_op_panel').css('display', "none");
        $('#delete_confirm_panel').css('display', "none");
        $('#mask').css('display', 'none');
    }
    function check_module() {
        var flag = true;
        $.ajax({
            method: 'GET',
            async: false,
            url: "/Services/GetInfoModuleFlagNames",
            dataType: 'json',
            success: function (data) {
                var flag_name = $('#flag').val();
                if (except_self) {
                    data.splice(data.indexOf(self_flag), 1)
                }
                if (data.indexOf(flag_name) >= 0) {
                    alert("已存在对应标识！");
                    flag = false;
                }
            },
            error: function (e) {
                alert("发生错误！");
                flag = false;
            }
        });
        return flag;
    }
</script>
</td>



