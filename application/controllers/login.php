<?php
/**
 * Created by PhpStorm.
 * User: zly
 * Date: 14-7-30
 * Time: 上午10:24
 */
class login extends CI_Controller
{
    public function Index()
    {}
    public function submit()
{
    $username = trim($_POST['username']);
    $pwd = md5($_POST['pwd']);

    $errmsg = '';

    if (!empty($username)) {

        $sql = "select * from user where uname='$username' and pwd='$pwd'";
        $rs =$this->db->query($sql);
        if ($rs && $rs->num_rows > 0) {

            $_SESSION['uid'] = $username;
            $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
            $errmsg = "WELCOME". $_SESSION['uid'];
            echo $errmsg;

            // 更新用户登录信息 
            $ip = $_SERVER['REMOTE_ADDR'];
            $sql= "UPDATE user SET logintimes = logintimes + 1,";
            $sql.= "lasttime=now(), lastip='$ip'";
            $sql.= " WHERE uname='$username'";
            $this->db->query($sql);
        } else {
            $errmsg = "WROING USERNAME OR PASSSWORD";
            echo "<script>alert('".$errmsg."')</script>";
            $this->load->view('load');
           // echo $errmsg;
        }
        $this->db->close();

    } else {
        $errmsg = '数据输入不完整';
    }
}

    public  function GetSession(){

        //$_SESSION["code"]="sss";
//        echo $_SESSION["code"];
        echo $_SESSION["Vcode"];
    }

    public function GetCode()
    {

        /**
         * Created by PhpStorm.
         * User: zly
         * Date: 14-7-21
         * Time: 下午4:34
         */
        header("Content-type: image/png");
//创建真彩色白纸
        $im = @imagecreatetruecolor(50, 20) or die("建立图像失败");
//获取背景颜色
        $background_color = imagecolorallocate($im, 255, 255, 255);
//填充背景颜色(这个东西类似油桶)
        imagefill($im,0,0,$background_color);
//获取边框颜色
        $border_color = imagecolorallocate($im,200,200,200);
//画矩形，边框颜色200,200,200
        imagerectangle($im,0,0,49,19,$border_color);
//逐行炫耀背景，全屏用1或0
        for($i=2;$i<18;$i++){
            //获取随机淡色
            $line_color = imagecolorallocate($im,rand(200,255),rand(200,255),rand(200,255));
            //画线
            imageline($im,2,$i,47,$i,$line_color);
        }
//设置字体大小
        $font_size=12;
//设置印上去的文字
        $Str[0] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $Str[1] = "abcdefghijklmnopqrstuvwxyz";
        $Str[2] = "01234567891234567890123456";
//获取第1个随机文字
        $imstr[0]["s"] = $Str[rand(0,2)][rand(0,25)];
        $imstr[0]["x"] = rand(2,5);
        $imstr[0]["y"] = rand(1,4);
//获取第2个随机文字
        $imstr[1]["s"] = $Str[rand(0,2)][rand(0,25)];
        $imstr[1]["x"] = $imstr[0]["x"]+$font_size-1+rand(0,1);
        $imstr[1]["y"] = rand(1,3);
//获取第3个随机文字
        $imstr[2]["s"] = $Str[rand(0,2)][rand(0,25)];
        $imstr[2]["x"] = $imstr[1]["x"]+$font_size-1+rand(0,1);
        $imstr[2]["y"] = rand(1,4);
//获取第4个随机文字
        $imstr[3]["s"] = $Str[rand(0,2)][rand(0,25)];
        $imstr[3]["x"] = $imstr[2]["x"]+$font_size-1+rand(0,1);
        $imstr[3]["y"] = rand(1,3);
        $verifycode="";
//写入随机字串
        for($i=0;$i<4;$i++){
            //获取随机较深颜色
            $text_color = imagecolorallocate($im,rand(50,180),rand(50,180),rand(50,180));
            //画文字
            imagechar($im,$font_size,$imstr[$i]["x"],$imstr[$i]["y"],$imstr[$i]["s"],$text_color);
            $verifycode.=$imstr[$i]["s"];
        }
        $_SESSION['Vcode'] = $verifycode;

//显示图片
        imagepng($im);

//销毁图片
        imagedestroy($im);
    }

    public function  YZFindPwd(){

        $email = stripslashes(trim($_POST['mail']));

        $sql = "select id,username,password from `t_user` where `email`='$email'";
        $query = mysql_query($sql);
        $num = mysql_num_rows($query);
        if($num==0){//该邮箱尚未注册！
            echo 'noreg';
            exit;
        }else{
            $row = mysql_fetch_array($query);
            $getpasstime = time();
            $uid = $row['id'];
            $token = md5($uid.$row['username'].$row['password']);//组合验证码
            $url = "http://www.helloweba.com/demo/resetpass/reset.php?email=".$email."
&token=".$token;//构造URL
            $time = date('Y-m-d H:i');
            $result = sendmail($time,$email,$url);
            if($result==1){//邮件发送成功
                $msg = '系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！';
                //更新数据发送时间
                mysql_query("update `t_user` set `getpasstime`='$getpasstime' where id='$uid '");
            }else{
                $msg = $result;
            }
            echo $msg;
        }

    }

    public  function FindPwd(){

        $config['smtp_host'] = 'smtp.163.com';
        $config['smtp_user'] = 'zhliyan2014@163.com';
        $config['smtp_pass'] = 'abcd1234';
        $config['charset']='utf-8';
        $config['protocol'] = 'smtp';
        $config['smtp_port'] = '25';
        $config['priority']=1;


        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('zhliyan2014@163.com', 'zly');
        $this->email->to('935772804@qq.com');
        $this->email->subject('Helloweba.com - 找回密码');
        $email="";
        $time=time();
        $url="";
            $this->email->message("亲爱的".$email."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码
（按钮24小时内有效）。<br/><a href='".$url."'target='_blank'></a>");

        $this->email->send();

        if($this->email->send())
        {
            echo "SSS";
        }
        else
        {
            echo "FFFF";
        }

    }

    public function UpdatePwd($uid)
    {
        $this->load->view('UpdatePwd.php?',$uid);
    }



}
