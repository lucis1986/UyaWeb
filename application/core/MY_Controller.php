<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-28
 * Time: 上午9:34
 */
class mController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       $this->test1();

    }
    function test1()
    {
        echo "test";
    }
}
class MY_Controllers extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

            $this->CheckLogin();
    }

    public function CheckLogin()
    {

        if(!isset($_SESSION['uid'])||!isset($_SESSION['ip']))
        {
            $this->load->view('load');
        }
        else
        {
            $username=$_SESSION['uid'];
            $lastip= $_SERVER['REMOTE_ADDR'];
            $sql = "select * from user where uname='$username' and lastip='$lastip'";
            $rs =$this->db->query($sql);
            if ($rs && $rs->num_rows > 0) {
            echo"WELCOME ".$_SESSION['uid'];
            }
            else
            {
                echo $_SESSION['uid'];
                echo $_SESSION['ip'];

                echo "用户在其他地方登陆，如不是本人操作请修改密码";
                $this->load->view('load');
            }
        }

    }



} 