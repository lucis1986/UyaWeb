<title>UserLogin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="JavaScript">
    function doCheck() {
        var flag=true;
        if (document.frmLogin.username.value == "") {
            alert('请输入你的用户名！');
            flag=false;
        }
        if (document.frmLogin.password.value == "") {
            alert('请输入你的密码！');
            flag=false;
        }
        if (document.frmLogin.yzm.value == "") {
            alert('请输入验证码！');
            flag=false;
        }

        $.ajax({
            method: 'get',
            async: false,
            url: "/login/GetSession",
            success: function (data) {
//                alert(data);
//                alert($("#yzm").val());
                if (data.toLowerCase() != $("#yzm").val().toLowerCase()) {
                    alert("验证码错误");
                    flag= false;
                }
            }
        });
        return flag;
    }
    function test(){
        var t=doCheck();
    }
    function create_code() {
        document.getElementById('code').src = 'VerifyCode.php?' + Math.random() * 10000;
    }
    function create_code2() {
        document.getElementById('Vcode').src = '/login/GetCode';
    }
</script>


<form name="frmLogin" method="post" action="/login/submit" onSubmit="return doCheck()">
    <table border="0" cellpadding="8"  align="center">
        <tr>
            <td colspan="2" align="center" class="alert"></td>
        </tr>
        <tr>
            <td>用户名:</td>
            <td><input name="username" type="text" id="username" class="textinput"/></td>
        </tr>
        <tr>
            <td>密码:</td>
            <td><input name="pwd" type="password" id="password" class="textinput"/></td>
        </tr>
        <tr>
            <td>验证码:</td>
            <td><input name="yzm" type="text" id="yzm" class="textinput"/>

                <img src="/login/GetCode" id="Vcode" onclick="create_code2()"/>
                <img src="/VerifyCode.php" id="code" onclick="create_code()"/>

                <input type="button" id="updatecode" onclick="create_code2()" value="看不清，换一张">


            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">

                <input type="submit" class="btn" value="登陆">&nbsp;&nbsp;
                <input type="reset" class="btn" value="重置">&nbsp;&nbsp;
<!--                <input type="button" class="btn" value="找回密码" onclick="//login//FindPwd" >-->
            </td>
        </tr>
    </table>
</form>
