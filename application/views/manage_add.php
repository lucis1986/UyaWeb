<script src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<div  style="margin-left:200px;    min-height: 600px; min-width: 700px; background:#ccc; overflow: auto ">
    <a href="<?=$pre_url?>">返回</a>
    <div
        style="margin: 10px 0;border-top:1px solid #ccc;border-bottom:1px solid #ccc;text-align: center;min-height: 300px;">
        <a href="#" onclick="GetContents()">save</a>

        <div id="test"></div>
        <form id="news_form" method="post" action="/management/save/<?=$module_id?>">
            <div style="text-align: left;">
                <span style="width: 100px;height:40px;line-height:40px;display: inline-block;text-align: center;">标题</span><input name="title" style="text-align: center;width:800px"
                                                                                                                                  type="text" value=""/>
            </div>
            <input type="hidden" name="pre_url" value="<?=$pre_url?>">
            <input type="hidden" name="author" value=""/>
            <textarea name="body" id="body" rows="10" cols="80">

            </textarea>
        </form>

        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('body');
            function GetContents() {
                // Get the editor instance that you want to interact with.
                var editor = CKEDITOR.instances.body;


                $("#body").val(editor.getData());
                $('#news_form').submit();

            }

        </script>
    </div>
</div>
<div style="clear: both;"></div>