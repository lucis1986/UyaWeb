<style type="text/css" xmlns="http://www.w3.org/1999/html">
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
        text-align: center;
    }

    .form_block {
        width: 200px;
        height: 30px;
        margin-top: 20px;
        margin-left: 20px;
    }
    .menu_button{

        padding: 0 10px;
        height: 30px;

    }
</style>
<script type="text/javascript">
    function getClientBounds() {
        var clientWidth;
        var clientHeight;

        clientWidth = document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth : document.body.clientWidth;
        clientHeight = document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight;

        return {width: clientWidth, height: clientHeight};
    }

    /*设置客户端的高和宽*/
    function div_center() {
        var divId = document.getElementById('mxh');
        var rr = new getClientBounds();

        divId.style.left = (rr.width - parseInt(divId.style.width)) / 2 + document.body.scrollLeft;
        divId.style.top = (rr.height - parseInt(divId.style.height)) / 2 + document.body.scrollTop;
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
        var t = div_center();
        onWindowResize.add(function () {
            div_center();
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
    function edit(){
        $("#module_content li").each(function(){
            $(this).append("<input type='checkbox' style='position: absolute;top: 5px;right: 5px;width: 30px;height: 30px;'/>")
            $(this).append("<input type='button' style='position: absolute;top: 5px;right: 45px;width: 40px;height: 30px;' value='编辑'/>")
        })
    }

</script>
<div style="text-align: left;margin-left: 200px">
    <div style="margin-left: 30px; margin-top: 10px;">
        <input type="button" class="menu_button" onclick="add_new()" value="添加"/>
        <input type="button" class="menu_button" onclick="edit()" value="编辑"/>
        <input type="button" class="menu_button" onclick="void(0)" value="删除所选"/>

    </div>
    <div style=" margin-left: 20px;">
        <ul id="module_content" style="float: left">
            <?php foreach ($result as $row): ?>
                <li style="position: relative;"><a href="/Management/ModuleManage/<?= $row->id ?>"><?= $row->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div style="clear: both"></div>
<div id="mask" style="background: black;position: fixed; opacity: 0.3;display: none">

</div>
<div id="mxh" style="width: 300px;height:400px;background: white;position: fixed; display: none;">
    <div style="position: relative; height: 30px; background: #ccc;text-align: left">
        <label style="line-height: 30px;height: 30px;margin-left: 10px;">添加信息发布</label>
        <div
            style="position: absolute; top: 2px; right: 5px; width: 30px; height: 26px; line-height: 26px; font-size: 9pt;cursor: pointer"
            onclick="tclose()">关闭
        </div>
    </div>
    <div style="text-align: left;">
        <form method="post" action="/Service/CreateInfoModule" onsubmit="return check_module()">
            <div class="form_block">
                <span>标题</span>
                <input id="title" name="title" style="width: 100px"/>
            </div>
           <!-- <div id="title_empty" class="form_block" style="color: #ff0000">标题不能为空</div>-->
            <div class="form_block">
                <span>标识</span>
                <input id="flag" name="flag" style="width: 100px"/>
            </div>
            <!--<div class="form_block" style="color: #ff0000">标识不能为空</div>
            <div class="form_block" style="color: #ff0000">标识只能为英文字母</div>
            <div class="form_block" style="color: #ff0000">标识已存在</div>-->
            <input type="submit" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;"  value="提交">
            <input type="button" style="height: 30px;width: 80px;margin-left: 20px;margin-top: 20px;"  value="取消" onclick="tclose()">

        </form>
    </div>
</div>
