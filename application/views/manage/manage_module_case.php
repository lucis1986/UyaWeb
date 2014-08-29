<td id="right_area">

    <table>
        <tr>
            <td>
                <div class="op_panel">
                    <a href="/productcase/edit" title="添加" class="add_btn op_btn" ></a>
                </div>
            </td>
            <td style="width: 100%">
                <div class="op_content">
                    <div class="location">位置：<a href="#">案例库</a></div>
                    <?php if (count($result) > 0): ?>
                        <table class="content_table">
                            <thead>
                            <tr style="background: #f1f1f1">
                                <td>标题</td>
                                <td>日期</td>
                                <td colspan="4" style="text-align: center">操作</td>
                            </tr>
                            </thead>
                            <?php foreach ($result as $row): ?>
                                <tr>
                                    <td style="width: 100%"
                                        title="<?= $row->title ?>"><?= mb_strimwidth($row->title, 0, 50, "...", "utf8") ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($row->modified)) ?></td>
                                    <td><a href="/productcase/edit/<?= $row->id ?>">编辑</a></td>
                                    <td><a href="/productcase/delete/<?= $row->id ?>" onclick="if(!confirm('你确定要进行此操作吗？')) {return false;}">删除</a></td>
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
