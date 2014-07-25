<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-21
 * Time: 上午8:43
 */
class Services extends CI_Controller
{
    public function GetModuleFlagNames()
    {
        $this->load->model("Module");
        $flags = array();
        $result = $this->Module->get_all();
        foreach ($result as $item) {
            $flags[] = $item->flag;
        }
        echo json_encode($flags);
    }

    public function SaveTopLink()
    {
        $server_name = $_SERVER['SERVER_NAME']; //当前运行脚本所在服务器主机的名字。
        $sub_from = $_SERVER["HTTP_REFERER"]; //链接到当前页面的前一页面的 URL 地址
        $sub_len = strlen($server_name); //统计服务器的名字长度。
        $check_from = substr($sub_from, 7, $sub_len); //截取提交到前一页面的url，不包含http:://的部分。
        if ($check_from != $server_name) {
            $msg = "数据来源有误！请从本站提交！";
            header("Content-Type: text/html;charset=utf-8");
            echo $msg;
        } else {
            $this->load->Model("MainPageLink");
            foreach ($_POST["link"] as $row) {
                $this->MainPageLink->update_nav($row);
            }
            $this->load->helper('url');
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    public function SaveLink()
    {
        $server_name = $_SERVER['SERVER_NAME']; //当前运行脚本所在服务器主机的名字。
        $sub_from = $_SERVER["HTTP_REFERER"]; //链接到当前页面的前一页面的 URL 地址
        $sub_len = strlen($server_name); //统计服务器的名字长度。
        $check_from = substr($sub_from, 7, $sub_len); //截取提交到前一页面的url，不包含http:://的部分。
        if ($check_from != $server_name) {
            $msg = "数据来源有误！请从本站提交！";
            header("Content-Type: text/html;charset=utf-8");
            echo $msg;
        } else {
            $this->load->Model("MainPageLink");
            foreach ($_POST["link"] as $row) {
                $this->MainPageLink->update_nav($row);
            }
            $this->load->helper('url');
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    private function CreateModule($type_id){
        echo "ssss";
    }

    public function CreateInfoModule(){
        $server_name = $_SERVER['SERVER_NAME']; //当前运行脚本所在服务器主机的名字。
        $sub_from = $_SERVER["HTTP_REFERER"]; //链接到当前页面的前一页面的 URL 地址
        $sub_len = strlen($server_name); //统计服务器的名字长度。
        $check_from = substr($sub_from, 7, $sub_len); //截取提交到前一页面的url，不包含http:://的部分。
        if ($check_from != $server_name) {
            $msg = "数据来源有误！请从本站提交！";
            header("Content-Type: text/html;charset=utf-8");
            echo $msg;
        } else {
            $this->load->Model("Type");
            $result=$this->Type->get_from_flag("info");
            if(!empty($result)){
                $this->CreateModule($result->id);
            }
            $this->load->helper('url');
            redirect("../management/module");
        }
    }
} 