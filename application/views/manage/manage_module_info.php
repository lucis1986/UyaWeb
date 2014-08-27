<td id="right_area">
    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="javascript:void(0)" title="添加" class="add_btn op_btn" onclick="show_add_panel()"></a>
                    <a href="javascript:void(0)" title="编辑" class="edit_btn op_btn" onclick="edit(this)"></a>
                </div>
            </td>
            <td style="width: 100%">
                <div>
                    <ul id="entry_list">
                        <?php foreach ($result as $row): ?>
                            <li style="position: relative;">
                                <a class="entry" title="<?= $row->flag ?>"
                                   href="/Management/ModuleManage/<?= $row->id ?>"><?= $row->title ?></a>
                                <input type="hidden" name="entry_id" value="<?= $row->id ?>"/>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div style="clear: both"></div>
                </div>
            </td>
        </tr>
    </table>
    <div class="dialog" id="op_panel">
        <div class="dialog_title_panel">
            <div class="dialog_title" id="op_title">
                标题
            </div>
            <div class="dialog_close" onclick="dialog_close()"></div>
        </div>
        <div class="dialog_content">
            <form id="form_op" method="post" onsubmit="return check_module()">
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
                    <select id="template" class="yai_hei" name="template">
                        <?php foreach ($templates as $row): ?>
                            <option title="<?= $row->description ?>" value="<?= $row->id ?>"><?= $row->title ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form_block" style="border: 1px solid #ccc;">
                    <p id="template_description" style="width: 180px"></p>
                </div>
                <input name="param" type="hidden" value=""/> <!--后台中需要额外接收的参数-->
                <div style="text-align: center">
                    <input type="submit" class="btn1" value="确定">
                    <input type="button" class="btn1" value="取消"
                           onclick="dialog_close()">
                </div>
            </form>
        </div>
    </div>
    <div id="delete_confirm_panel"
         class="dialog">
        <div class="dialog_title_panel">
            <div class="dialog_title">确认删除</div>
            <div class="dialog_close" onclick="dialog_close()">
            </div>
        </div>
        <div class="dialog_content">
            <form method="post" action="/Services/DeleteInfoModule">
                <input type="hidden" name="delete_ids"/>

                <div style="text-align: center">
                    <input type="submit" class="btn1" value="确定">
                    <input type="button" class="btn1" value="取消"
                           onclick="dialog_close()">
                </div>
            </form>
        </div>
    </div>
    <script>
        var except_self = false;
        $(function () {
            $('select[name="template"]').change(function () {
                $('#template_description').html($(this).find("option:selected").attr('title'));
            })
        })
        function show_add_panel() {
            except_self = false;
            $('#form_op').attr('action', "/Services/CreateInfoModule");
            $('input[name="title"]').val("");
            $('input[name="flag"]').val("");
            var first_select = $('select[name="template"] option').first();
            $('select[name="template"]').val(first_select.val());
            $('#template_description').html(first_select.attr('title'))
            $('#op_title').text("添加信息发布");
            dialog_show("#op_panel")
        }
        function show_edit_panel(item) {
            except_self = true;
            var entry_id = $(item).parent().find('input[name="entry_id"]').val();
            $('#form_op').attr('action', '/Services/UpdateInfoModule/' + entry_id);
            $('#op_title').text("编辑信息发布");
            $.ajax({
                method: 'GET',
                async: false,
                url: "/Services/GetModule/" + entry_id,
                dataType: 'json',
                success: function (data) {
                    $('input[name="title"]').val(data['title']);
                    $('input[name="flag"]').val(data['flag']);
                    var select = $('select[name="template"]');
                    select.val(data['template_id']);
                    $('#template_description').html(select.find('option:selected').attr('title'));
                    self_flag = data['flag'];
                },
                error: function (e) {
                    alert("发生错误！");
                    return;
                }
            });
            dialog_show("#op_panel")
        }
        function edit(item) {
            $(item).after('<a href="javascript:void(0)" title="删除" class="remove_btn op_btn" onclick="pre_remove()"></a>');
            $(item).after('<a href="javascript:void(0)" title="取消" class="back_btn op_btn" onclick="cancel(this)"></a>');
            $(item).remove();
            $("#entry_list li").each(function () {
                $(this).append("<input class='extra' type='checkbox'  style='display: none'/>")
                $(this).append("<div class='checkbox extra' onclick='checked_change(this)'></div>")
                $(this).append("<a href='#' class='edit_btn entry_edit extra' onclick='show_edit_panel(this)' value='编辑'/>")
            })
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
        function pre_remove() {
            var remove_ids = [];
            $("#entry_list li:has(input:checked)").find("input[name='entry_id']").each(function () {
                remove_ids.push($(this).val());
            });
            if (remove_ids.length > 0) {
                $("input[name='delete_ids']").val(remove_ids);
                dialog_show("#delete_confirm_panel");
            } else {
                alert("所选为空！")
            }
        }
    </script>
</td>



