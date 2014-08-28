<td id="right_area">

    <table>
        <tr>

            <td style="width: 100%">
                <div class="op_content">

                    <?php if (count($query) > 0): ?>
                        <table class="content_table">
                            <thead>
                            <tr style="background: #f1f1f1">
                                <td>标题</td>
                                <td>日期</td>
                                <td colspan="4" style="text-align: center">操作</td>
                            </tr>
                            </thead>
                            <?php foreach ($query as $row): ?>
                                <tr>
                                    <td style="width: 100%"
                                        title="<?= $row->title ?>"><?= mb_strimwidth($row->title, 0, 50, "...", "utf8") ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($row->modified)) ?></td>
                                    <td><a href="/productcase/edit/<?= $row->id ?>">编辑</a></td>
                                    <td><a target="_blank" href="/productcase/caseinfo/<?= $row->id ?>">查看</a></td>
                                    <td><a href="/productcase/delete/<?= $row->id ?>">删除</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </table>

</td>
