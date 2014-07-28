
<html>
<head>
    <title>UserLogin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="application/javascript" language="JavaScript">
        function doCheck() {
            session_start();
            if (document.frmLogin.username.value == "") {

                alert('请输入你的用户名！');
                return false;
            }
            if (document.frmLogin.password.value == "") {
                alert('请输入你的密码！');
                return false;
            }
            if (document.frmLogin.yzm.value == "") {
                alert('请输入验证码！');
                return false;
            }
            if ((!isset($_SESSION['verifyCode']))||(document.frmLogin.yzm.value !=$_SESSION['verifyCode'])) {
                alert('验证码错误！');
                return false;
            }
        }
        function create_code(){
            document.getElementByIdx_x('code').src = 'code.php?'+Math.random()*10000;
        }
    </script>
</head>
<body>

<form name="frmLogin" method="post" action="/login/submit" onSubmit="return doCheck();">
    <table border="0" cellpadding="8" width="650" align="center">
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

                <img src="VerifyCode.php" id="code"/><button type="button" onClick="code()">更换</button></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="btn" value="登陆">&nbsp;&nbsp;
                <input type="reset" class="btn" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>