<script type="text/javascript">
    var except_self = false;
    var self_flag = "";
    function getClientBounds() {
        var clientWidth;
        var clientHeight;

        clientWidth = document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth : document.body.clientWidth;
        clientHeight = document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight;

        return {width: clientWidth, height: clientHeight};
    }

    /*设置客户端的高和宽*/
    function div_center(id) {
        var divId = document.getElementById(id);
        var rr = new getClientBounds();

        divId.style.left = (rr.width - parseInt(divId.style.width)) / 2 + document.body.scrollLeft + "px";
        divId.style.top = (rr.height - parseInt(divId.style.height)) / 2 + document.body.scrollTop + "px";
        var Mask = document.getElementById('mask');

        Mask.style.left = 0 + "px";
        Mask.style.top = 0 + "px";
        Mask.style.width = 9999 + "px";
        Mask.style.height = 9999 + "px";
    }
    function dialog_close() {
        $('#mxh').css('display', "none");
        $('#dialog_confirm').css('display', "none");
        $('#mask').css('display', 'none');
    }
    function add_module(flag) {
        except_self = false;
        set_option_by_module_type(flag);
        $('#mxh').css('display', "block");
        $('#mask').css('display', 'block');
    }
    function set_option_by_module_type(flag) {
        $('#module_op').attr('action', get_action(flag));
        $('#module_op_title').empty();
        $('#module_op_title').text(get_title(flag));
        switch (flag) {
            case "info":
                break;
            case "doc":
                $("#module_op input[name='param']").val()
                break;
            default :
                break;
        }
    }
    function get_action(flag) {
        var action = "/Services/Create" + flag.replace(/(^|\s+)\w/g, function (s) {
            return s.toUpperCase();
        }) + "Module";
        return action;
    }
    function get_title(flag) {
        var title = "";
        switch (flag) {
            case "info":
                title = "添加信息发布";
                break;
            case "doc":
                title = "添加文档库";
                break;
            default :
                break;
        }
        return title;
    }
    function update_module(item) {
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
                self_flag = data['flag'];
            },
            error: function (e) {
                alert("发生错误！");
                return;
            }
        });
        $('#mxh').css('display', "block");
        $('#mask').css('display', 'block');
    }

    $(function () {
        div_center("mxh");
        div_center("dialog_confirm");
        onWindowResize.add(function () {
            div_center("mxh");
            div_center("dialog_confirm");
        });
    })

    function check_module() {
        var flag = true;
//        var title=$('#title').val();
//        var flag_name=$('#flag').val();
//        if(title==""){
//            $('title_empty').show();
//            flag =false;
//        }
//        if()
        $.ajax({
            method: 'GET',
            async: false,
            url: "/Services/GetModuleFlagNames",
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
    function pre_remove() {
        var remove_ids = [];
        $("#module_content li:has(input:checked)").find("input[name='module_id']").each(function () {
            remove_ids.push($(this).val());
        });
        if (remove_ids.length > 0) {
            $("input[name='module_ids']").val(remove_ids);
            $("#dialog_confirm").show();
            $("#mask").show();
        } else {
            alert("所选为空！")
        }

    }
    function edit(item) {
        alert("sss")
        $(item).val("取消");
        $(item).attr('onclick', 'cancel(this)');
        $(item).after('<input type="button" class="menu_button" onclick="pre_remove()" value="删除所选"/>');
        $("#module_content li").each(function () {
            $(this).append("<input type='checkbox' style='position: absolute;top: 5px;right: 5px;width: 30px;height: 30px;'/>")
            $(this).append("<input type='button' onclick='update_module(this)' style='position: absolute;top: 5px;right: 45px;width: 40px;height: 30px;' value='编辑'/>")
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

</script>
<div id="mask" style="background: black;position: fixed; opacity: 0.3;display: none; width:9999px;height: 9999px;z-index: 999">
</div>
<div id="mxh" style="width: 300px;height:400px;background: white;position: fixed; display: none;z-index: 999">
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
<div id="dialog_confirm" style="width: 300px;height:300px;background: white;position: fixed; display: none;z-index: 999">
    <div style="position: relative; height: 30px; background: #ccc;text-align: left">
        <label style="line-height: 30px;height: 30px;margin-left: 10px;">确认删除</label>

        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="dialog_close()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <form id="module_op" method="post" action="/Services/DeleteInfoModule">
            <input type="hidden" name="module_ids"/>
            <input type="submit" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="确定">
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;" value="取消"
                   onclick="dialog_close()">
        </form>
    </div>

</div>