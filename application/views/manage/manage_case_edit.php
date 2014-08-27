<td id="right_area">

    <table>
        <tr>
            <td> <input type="hidden" name="id" value="<?= $query->id ?>"/>
                <input type="text" name="title" value="<?= mb_strimwidth($row->title, 0, 50, "...", "utf8") ?>"/>
                </td>
        </tr>
        <tr>
            <td>    <textarea name="body" id="body" rows="10" cols="80">
                    <?= $row->body ?>
                </textarea></td>
        </tr>
        <tr>
            <td><input type="text" name="author" value="<?= $row->author ?>"/></td>
        </tr>
        <tr>
            <td><input type="text" name="created" value="<?= $row->created ?>"/></td>
        </tr>

        <tr>
            <td>
                <input id="save" name="save" type="button" value="保存" onclick="save()"/>
                <input id="cancel" name="cancel" type="button" value="取消"/>
            </td>
        </tr>

    </table>
    <script>
        var editor;
        KindEditor.ready(function (K) {
            editor = K.create('textarea[name="body"]', {
                allowFileManager: true,
                width: '95%',
                height: '500px'
            });
        });
        function save() {
            $("#body").val(editor.html());
            $('#submit_form').submit();
        }
    </script>
</td>
