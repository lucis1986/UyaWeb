<style type="text/css">
    #module_content {
        list-style: none;
    }

    ul#module_content li {
        float: left;
        margin: 10px;

    }

    ul#module_content li a {
        width: 200px;
        height: 200px;
        line-height: 200px;
        display: block;
        border: 1px solid blue;
    }

    .form_block {
        width: 200px;
        height: 30px;
    }
</style>
<script type="text/javascript">
    function getClientBounds() {
        var clientWidth;
        var clientHeight;
        var clientScrollWidth;
        var clientScrollHeight;

        clientWidth = document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth : document.body.clientWidth;
        clientHeight = document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight;
        clientScrollWidth = document.compatMode == "CSS1Compat" ? document.documentElement.scrollWidth : document.body.scrollWidth;
        clientScrollHeight = document.compatMode == "CSS1Compat" ? document.documentElement.scrollHeight : document.body.scrollHeight;

        return {width: clientWidth, height: clientHeight};

    }

    /*设置客户端的高和宽*/
    function divcenter() {
        var divId = document.getElementById('mxh');
        var rr = new getClientBounds();

        divId.style.left = (rr.width - 300) / 2 + document.body.scrollLeft;
        divId.style.top = (rr.height - 400) / 2 + document.body.scrollTop;
        var Mask = document.getElementById('mask');

        Mask.style.left = 0;
        Mask.style.top = 0;
        Mask.style.width = 9999;
        Mask.style.height = 9999;
    }
    function tclose() {
        $('#mxh').css('display', "none");
        $('#mask').css('display', 'none');
    }
    function add_new() {
        $('#mxh').css('display', "block");
        $('#mask').css('display', 'block');
    }
    $(function () {
        var t = divcenter();
        onWindowResize.add(function () {
            divcenter();
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
            url: "http://<?=$_SERVER['SERVER_NAME']?>:<?=$_SERVER['SERVER_PORT']?>/Services/GetModuleFlagNames",
            dataType: 'json',
            success: function (data) {
                var flag_name = $('#flag').val();
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

</script>
<div style="margin-left:200px;    min-height: 600px; min-width: 700px; background:#ccc; padding:0">
    <div>
        <a href="#" onclick="add_new()">Add New</a>
    </div>
    <ul id="module_content" style="float: left">
        <?php foreach ($query as $row): ?>
            <li><a href="/Management/ModuleManage/<?= $row->id ?>"><?= $row->title ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
<div id="mask" style="background: black;position: fixed; opacity: 0.3;display: none">

</div>
<div id="mxh" style="width: 300px;height:400px;background: white;position: fixed; display: none;">
    <div style="position: relative; height: 30px; background: #ccc">
        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="tclose()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <form method="post" action="/Management/CreateModule" onsubmit="return check_module()">
            <div class="form_block">
                <span>类型</span>
                <select style="width: 100px;" name="type">

                    <?php foreach ($types as $row): ?>
                        <option value="<?= $row->id ?>"><?= $row->title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form_block">
                <span>标题</span>
                <input id="title" name="title" style="width: 100px"/>

            </div>
            <div id="title_empty" class="form_block" style="color: #ff0000">标题不能为空</div>
            <div class="form_block">
                <span>标识</span>
                <input id="flag" name="flag" style="width: 100px"/>
            </div>
            <div class="form_block" style="color: #ff0000">标识不能为空</div>
            <div class="form_block" style="color: #ff0000">标识只能为英文字母</div>
            <div class="form_block" style="color: #ff0000">标识已存在</div>
            <input type="submit"  value="提交">

        </form>
    </div>
</div>