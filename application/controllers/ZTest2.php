<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-4
 * Time: 上午9:10
 */
class ZTest2 extends CI_Controller
{
    public function index()
    {
        $data["s_name"] = "dddddd"; //当前运行脚本所在服务器主机的名字。
        $this->load->view('zttest.php',$data);
    }




} 