<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-28
 * Time: 上午9:34
 */
class MY_Controller extends CI_Controller
{
    var $check = false;

    function __construct()
    {
        parent::__construct();
        if ($this->check) {
            $this->CheckLogin();
        }
    }

    public function CheckLogin()
    {
        $username = trim($_POST['username']);
        $pwd = md5($_POST['pwd']);
        $errmsg = '';
        if (!empty($username)) {

            $sql = "select * from user where uname='$username' and pwd='$pwd'";
            $rs =$this->db->query($sql);
            if ($rs && $rs->num_rows > 0) {

                $_SESSION['uid'] = $username;
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
                echo $errmsg;
            }
            $this->db->close();

        } else {
            $errmsg = '数据输入不完整';
        }

    }
} 