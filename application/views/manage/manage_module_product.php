<td id="right_area">
    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="/ManageProduct/Add" title="添加" class="add_btn op_btn"></a>
                    <a href="#" title="编辑" class="edit_btn op_btn" onclick="edit(this)"></a>
                </div>
            </td>
            <td style="width: 100%">
                <div>
                    <ul id="entry_list" style="float: left">
                        <?php foreach ($result as $row): ?>
                            <li style="position: relative;">
                                <a class="entry" target="_blank"
                                   href="/Product/Index/<?= $row->id ?>"><?= $row->title ?></a>
                                <input type="hidden" name="entry_id" value="<?= $row->id ?>"/>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div style="clear: both"></div>
                </div>
            </td>
        </tr>
    </table>
    <div id="delete_confirm_panel"
         class="dialog">
        <div class="dialog_title_panel">
            <div class="dialog_title">确认删除</div>
            <div class="dialog_close" onclick="dialog_close()">
            </div>
        </div>
        <div class="dialog_content">
            <form method="post" action="/ManageProduct/Delete">
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
        function edit(item) {
            $(item).removeAttr("onclick");
            $(item).unbind('click').bind('click', function () {
                cancel(item);
            })
            $(item).after('<a href="#" title="删除" class="remove_btn op_btn" onclick="pre_remove()"></a>');
            $("#entry_list li").each(function () {
                var id = $(this).find('input[name="entry_id"]').val();
                $(this).append("<input class='extra' type='checkbox'  style='display: none'/>")
                $(this).append("<div class='checkbox extra' onclick='checked_change(this)'></div>")
                $(this).append("<a class='edit_btn entry_edit extra' href='/ManageProduct/Edit/" + id + "'/></a>")
            })
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



