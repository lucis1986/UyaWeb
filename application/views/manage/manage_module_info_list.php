<td id="right_area">
    <script type="text/javascript">
        $(function () {
            $("#content_list tr").each(function () {
                $(this).mouseenter(function () {
                    $(this).addClass("MouseOver")
                });
                $(this).mouseleave(function () {
                    $(this).removeClass("MouseOver");
                });
                $(this).click(function () {
                    $("#content_list tr").each(function () {
                        if ($(this).hasClass("Selected")) {
                            $(this).removeClass("Selected");
                        }
                    });
                    $(this).addClass("Selected");
                })
            })
        })
    </script>
    <style type="text/css">
        .MouseOver {
            background: #c6ddff;
        }

        .Selected {
            background: rgba(0, 0, 0, 0.20);
        }

        #content_list {
            width: 90%;
            border-collapse: collapse;
            border: 1px solid #9d9d9d;
            margin-top: 10px;
        }

        #content_list td {
            line-height: 25px;
            border: 1px solid #9d9d9d;
            padding: 0 10px;
            white-space: nowrap;
        }

    </style>
    <div style="margin-left: 20px;">
        <div id="edit_panel"><span style="height: 30px;line-height: 30px;">位置：<?= $module->title ?></span><span
                style="display: inline-block;margin-left: 40px;">URL: <a target="_blank"
                                                                         href="/<?= $module->flag ?>/Pages">http://<?= $_SERVER['SERVER_NAME'] ?>
                    :<?= $_SERVER['SERVER_PORT'] ?>/<?= $module->flag ?>/Pages</a></span><input
                style="margin-left: 40px;" type="button" class="menu_button"
                onclick="window.location='/management/add/<?= $module->id ?>'" value="添加"/>
        </div>
        <?php if (count($query) > 0): ?>
            <table id="content_list">
                <thead>
                <tr style="background: #CCCCCC">
                    <td>标题</td>
                    <td>日期</td>
                    <td colspan="3" style="text-align: center">操作</td>
                </tr>
                </thead>
                <?php foreach ($query as $row): ?>
                    <tr>
                        <td style="width: 100%"
                            title="<?= $row->title ?>"><?= mb_strimwidth($row->title, 0, 50, "...", "utf8") ?></td>
                        <td><?php echo date("Y-m-d", strtotime($row->modified)) ?></td>
                        <td><a href="/management/edit/<?= $row->module_id ?>/<?= $row->id ?>">编辑</a></td>
                        <td><a target="_blank" href="/<?= $module->flag ?>/index/<?= $row->id ?>">查看</a></td>
                        <td><a href="/management/delete/<?= $row->module_id ?>/<?= $row->id ?>">删除</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <div style="text-align: center;margin-top: 10px;"><?php echo $this->pagination->create_links(); ?></div>
    </div>
</td>
