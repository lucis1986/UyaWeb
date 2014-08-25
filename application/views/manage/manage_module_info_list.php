<td id="right_area">
    <script type="text/javascript">
        $(function () {

        })
    </script>
    <style type="text/css">


    </style>
    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="/management/add/<?= $module->id ?>" title="添加" class="add_btn op_btn" ></a>
                </div>
            </td>
            <td style="width: 100%">
                <div class="op_content">
                    <div class="location">位置：<a href="/<?= $module->flag ?>/Pages"><?= $module->title ?></a></div>
                    <?php if (count($query) > 0): ?>
                        <table class="content_table">
                            <thead>
                            <tr style="background: #f1f1f1">
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
                </div>
            </td>
        </tr>
    </table>
    <div>
        <div class="pagination" style="text-align: center;margin-top: 10px;"><?php echo $this->pagination->create_links(); ?></div>
    </div>
</td>
