<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-4
 * Time: 上午9:10
 */
class Management extends CI_Controller
{
    public function index()
    {
        $this->load->view('manage/manage_head.php');
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_start_content.php');
        $this->load->view('foot.php');
    }

    public function  MainPage($id=1)
    {
        $data["current_top_nav"]="MainPage";
        $data["current_left_nav"]=$id;
        $this->load->view('manage/manage_head.php',$data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_main_page_left.php');

        switch($id){
            case 1:
                $this->load->Model('MainPageLink');
                $data["result"]=$this->MainPageLink->get_top_nav();
                $data["action"]="/Services/SaveTopLink";
                $this->load->view('manage/manage_main_page_nav_edit.php',$data);
                break;
            case 2:
                $this->load->Model('MainPageLink');
                $data["result"]=$this->MainPageLink->get_nav();
                $data["action"]="/Services/SaveLink";
                $this->load->view('manage/manage_main_page_nav_edit.php',$data);
                break;
            case 3:
                $this->load->view('manage/manage_main_page_content3.php');
                break;
            case 4:
                $this->load->view('manage/manage_main_page_content4.php');
                break;
            default:
                break;
        }
        $this->load->view('foot.php');
    }

    public function Module($id=null)
    {
        $this->load->model("Type");
        $data['types'] = $this->Type->get_all();
        if(!isset($id)){
            $query_id=$this->Type->get_min_id();
            if(!empty($query_id)){
                $id=$query_id->id;
            }
        }
        if(isset($id)){
            $data["current_top_nav"]="Module";
            $data["current_left_nav"]=$id;
            $type_item=$this->Type->get_from_id($id);
            $type=$type_item->flag;
            $this->load->model('Module');
            $data["result"]= $this->Module->get_from_type_id($id);
            $data['types']=$this->Type->get_all();
            $this->load->view('manage/manage_head.php',$data);
            $this->load->view('manage/manage_top.php');
            $this->load->view('manage/manage_module_left.php');
            $this->load->view("manage/manage_module_".$type);
        }
        $this->load->model('Module');

//        $data['query'] = $this->Module->get_all();
//        $this->load->view('m/manage_head.php', $data);
//        $this->load->view('manage_left_nav.php', $data);
//        $this->load->view('manage_module_list.php', $data);
//        $this->load->view('foot.php', $data);



        $this->load->view('foot.php');

    }

    public function SinglePage($id=1){
        $data["current_top_nav"]="SinglePage";
        $data["current_left_nav"]=$id;
        $this->load->view('manage/manage_head.php',$data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_module_left.php');
        switch($id){
            case 1:
                $this->load->view('manage/manage_main_page_content1.php');
                break;
            case 2:
                $this->load->view('manage/manage_main_page_content2.php');
                break;
            case 3:
                $this->load->view('manage/manage_main_page_content3.php');
                break;
            case 4:
                $this->load->view('manage/manage_main_page_content4.php');
                break;
            default:
                break;
        }
        $this->load->view('foot.php');
    }

    public function Authority($id=1){
        $data["current_top_nav"]="Authority";
        $data["current_left_nav"]=$id;
        $this->load->view('manage/manage_head.php',$data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_module_left.php');
        switch($id){
            case 1:
                $this->load->view('manage/manage_main_page_content1.php');
                break;
            case 2:
                $this->load->view('manage/manage_main_page_content2.php');
                break;
            case 3:
                $this->load->view('manage/manage_main_page_content3.php');
                break;
            case 4:
                $this->load->view('manage/manage_main_page_content4.php');
                break;
            default:
                break;
        }
        $this->load->view('foot.php');
    }
    public function edit($module_id = null, $id = null)
    {

        if (isset($id) && isset($module_id)) {
            $this->load->model("Module");
            $query = $this->Module->get_module_type($module_id);
            if (count($query) > 0) {
                $model = ucfirst(strtolower($query[0]->flag)) . "Model";
                $this->load->model($model);
                $this->$model->module_id = $module_id;
                $query = $this->$model->get_from_id($id);
                if (count($query) > 0) {
                    $data["query"] = $query[0];
                    $data["pre_url"] = $_SERVER["HTTP_REFERER"];
                    $this->load->view('manage_head.php', $data);
                    $this->load->view('manage_left_nav.php', $data);
                    $this->load->view('manage_content.php', $data);
                    $this->load->view('foot.php', $data);
                }

            }
        }
    }

    public function delete($module_id = null, $id = null)
    {
        if (isset($id) && isset($module_id)) {
            $this->load->model("Module");
            $query = $this->Module->get_module_type($module_id);
            if (count($query) > 0) {
                $model = ucfirst(strtolower($query[0]->flag)) . "Model";
                $this->load->model($model);
                $this->$model->module_id = $module_id;
                $this->$model->delete_entry($id);
                $this->load->helper('url');
                redirect("../management/module");
            }
        }
    }

    public function update($module_id = null)
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
            $this->load->model("Module");
            $query = $this->Module->get_module_type($module_id);
            if (count($query) > 0) {
                $model = ucfirst(strtolower($query[0]->flag)) . "Model";
                $this->load->model($model);
                $this->$model->module_id = $module_id;
                $this->$model->update_entry();
                $this->load->helper('url');
                redirect($_POST["pre_url"]);

            }
        }
    }

    public function save($module_id = null)
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
            $this->load->model("Module");
            $query = $this->Module->get_module_type($module_id);
            if (count($query) > 0) {
                $model = ucfirst(strtolower($query[0]->flag)) . "Model";
                $this->load->model($model);
                $this->$model->module_id = $module_id;
                $this->$model->insert_entry();
                $this->load->helper('url');
                redirect($_POST["pre_url"]);

            }
        }
    }

    public function add($module_id = null)
    {
        $data["pre_url"] = "/management/module";
        $data["module_id"] = $module_id;
        $this->load->model("Module");
        $query = $this->Module->get_module_type($module_id);
        if (count($query) > 0) {
            $this->load->view('manage_head.php', $data);
            $this->load->view('manage_left_nav.php', $data);
            $this->load->view('manage_add.php', $data);
            $this->load->view('foot.php', $data);
        }

    }

    public function ModuleManage($module_id = null, $page_num = 1)
    {
        $this->load->model("Module");
        $query_type = $this->Module->get_module_type($module_id);
        $query_module = $this->Module->get_from_id($module_id);

        if (count($query_type) > 0 && count($query_module) > 0) {
            $model = ucfirst($query_type[0]->flag) . "Model";
            $this->load->model($model);
            $this->$model->module_id = $module_id;
            $this->load->library('pagination');
            $config["base_url"] = "/management/modulemanage/" . $module_id . "/";
            $config['uri_segment'] = 4;
            $config['per_page'] = 20;
            $config['num_links'] = 5;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '首页';
            $config['last_link'] = '末页';
            $config['total_rows'] = $this->$model->get_num();
            $start_item_num = $config['per_page'] * ($page_num - 1);
            $data['query'] = $this->$model->get_items_by_start_num($start_item_num, 20);
            $data["module"] = $query_module;
            $data["types"]=$this->GetTypes();
            $data["current_top_nav"]="Module";
            $data["current_left_nav"]=$query_type[0]->id;
            $this->pagination->initialize($config);
//            $this->load->view('manage_head.php', $data);
//            $this->load->view('manage_left_nav.php', $data);
//            $this->load->view('manage_list.php', $data);
//            $this->load->view('foot.php', $data);
            $this->load->view('manage/manage_head',$data);
            $this->load->view('manage/manage_top');
            $this->load->view('manage/manage_module_left');

        }
    }
    private function GetTypes(){
        $this->load->model("Type");
        return $this->Type->get_all();
    }


} 