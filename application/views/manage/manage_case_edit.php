
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script charset="utf-8" src="/plugins/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="/plugins/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>


        <form  id="submit_form1" name="submit_form1" method="post" action="/ProductCase/save/<?= $id ?>">

                <input type="hidden" name="id" value="<?= $id ?>"/><br>
                    <input type="text" name="title" value="<?= $title ?>"/>

              <textarea name="body" id="body" rows="10" cols="80">
                        <?= $body ?>
                    </textarea>
            <input type="text" name="author" value="<?= $author ?>"/><br>
            <input type="text" name="created" value="<?= $created ?>"/><br>
            <a id="a" name="a" onclick="save()" href="#">aa</a>


                <input id="save" name="save" type="button" value="保存" onclick="save()"/>
                <input id="cancel" name="cancel" type="button" value="取消"/>



    <script type="text/javascript">
        var editor;
        KindEditor.ready(function (K) {
            editor = K.create('textarea[name="body"]', {
                allowFileManager: true,
                width: '95%',
                height: '500px'
            });
        });
        function save() {
            alert("dd");
            alert($("#body").text);
            $("#body").val(editor.html());
            $('#submit_form1').submit();
        }
    </script>

        </form>

