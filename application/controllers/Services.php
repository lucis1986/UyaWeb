<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-21
 * Time: 上午8:43
 */
class Services extends CI_Controller
{
    public function GetInfoModuleFlagNames()
    {
        $this->load->model("InfoModule");
        $flags = array();
        $result = $this->InfoModule->get_all();
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

    public function CreateInfoModule()
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
            $this->load->Model("Type");
            $result = $this->Type->get_from_flag("info");
            if (!empty($result)) {
                $this->CreateModule($result->id);
            }
            $this->load->helper('url');
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    private function CreateModule($type_id)
    {
        $this->load->model("InfoModule");
        $this->InfoModule->insert_entry($type_id);
    }

    public function GetModule($id = null)
    {
        $this->load->model("InfoModule");
        $item = $this->InfoModule->get_from_id($id);
        if (!empty($item)) {
            echo json_encode($item);
        }
    }

    public function UpdateInfoModule($id)
    {
        $this->load->model("InfoModule");
        $this->InfoModule->update_entry($id);
        $this->load->helper('url');
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function DeleteInfoModule()
    {
        $this->load->model("InfoModule");
        $this->InfoModule->delete_entry();
        $this->load->helper('url');
        redirect($_SERVER["HTTP_REFERER"]);
    }

    function GetNodes()
    {
        $nodes = $this->GetNodesByPath("upload");
        $t = is_array($nodes);
        echo json_encode($nodes, 2);


    }

    private function GetNodesByPath($path)
    {
        $nodes = array();
        $dir = opendir($path);

        while (($file = readdir($dir)) !== false) {
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;
            if ($file == '.' || $file == '..') {
                continue;
            } else if (is_dir($sub_dir)) {
                $nodes[] = array(
                    "name" => iconv('GB2312', 'UTF-8', $file),
                    "children" => $this->GetNodesByPath($sub_dir),
                    "path" => urlencode($sub_dir),
                    "iconSkin" => "folder"
                );
            }
        }
        return $nodes;
    }

    function GetPathFiles()
    {
        $path = urldecode($_POST["path"]);
        $files = array();
        $dir = opendir($path);

//列出 images 目录中的文件

        while (($file = readdir($dir)) !== false) {
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;
            if ($file == '.' || $file == '..' || is_dir($sub_dir)) {
                continue;
            } else {
                $files[] = array(
                    "text" => iconv('GB2312', 'UTF-8', $file),
                    "path" => urlencode($sub_dir)
                );

            }
        }
        echo json_encode($files);
    }

    function Download()
    {

        $path = urldecode($_POST["path"]);
        $file_name = iconv('UTF-8', 'GB2312', urldecode($_POST["name"]));

        $t = 0;

        if (!file_exists($path)) { //检查文件是否存在
            echo "文件找不到";
            exit;
        } else {
            $file = fopen($path, "r"); // 打开文件
// 输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: " . filesize($path));
            Header("Content-Disposition: attachment; filename=" . $file_name);
// 输出文件内容
            echo fread($file, filesize($path));
            fclose($file);
            exit();


        }
    }

    function Upload(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        session_start();

        // The Demos don't save files


        // In this demo we trigger the uploadError event in SWFUpload by returning a status code other than 200 (which is the default returned by PHP)
        if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            // Usually we'll only get an invalid upload if our PHP.INI upload sizes are smaller than the size of the file we allowed
            // to be uploaded.
            header("HTTP/1.1 500 File Upload Error");
            if (isset($_FILES["Filedata"])) {
                echo $_FILES["Filedata"]["error"];
            }
            exit(0);
        }else{

        }
    }

    function AddDocNode()
    {
        $path = urldecode($_POST["path"]);
        $doc_title=iconv('UTF-8', 'GB2312',$_POST["title"]);
        $dir=$path.DIRECTORY_SEPARATOR.$doc_title;
        if(file_exists($dir)){
            echo false;
        }else{
            $result=  mkdir($dir,0777);
            if($result){
                echo urlencode($dir);
            }else{
                echo false;
            }
        }
    }
} 