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
        $this->load->view('manage/manage_foot.php');
    }

    public function  MainPage($id = 1)
    {
        $data["current_top_nav"] = "MainPage";
        $data["current_left_nav"] = $id;
        $this->load->view('manage/manage_head.php', $data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_main_page_left.php');

        switch ($id) {
            case 1:
                $this->load->Model('MainPageLink');
                $data["result"] = $this->MainPageLink->get_top_nav();
                $data["action"] = "/Services/SaveTopLink";
                $this->load->view('manage/manage_main_page_nav_edit.php', $data);
                break;
            case 2:
                $this->load->Model('MainPageLink');
                $data["result"] = $this->MainPageLink->get_nav();
                $data["action"] = "/Services/SaveLink";
                $this->load->view('manage/manage_main_page_nav_edit.php', $data);
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
        $this->load->view('manage/manage_foot.php');
    }

    public function Module($id = null)
    {
        $this->load->model("Type");
        $data['types'] = $this->Type->get_all();
        if (!isset($id)) {
            $query_id = $this->Type->get_min_id();
            if (!empty($query_id)) {
                $id = $query_id->id;
            }
        }
        $data["current_top_nav"] = "Module";
        $data["current_left_nav"] = $id;
        $type_item = $this->Type->get_from_id($id);
        $type = $type_item->flag;

        $method="Load".ucfirst($type);

        if(method_exists($this,$method)){
            call_user_func_array(array($this,$method),array(&$data));
        }

        $this->load->view('manage/manage_head.php', $data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_module_left.php');
        $this->load->view("manage/manage_module_" . $type);
        $this->load->view('manage/manage_foot.php');
    }

    private function  LoadInfo(&$data)
    {
        $this->load->model('InfoModule');
        $data["result"] = $this->InfoModule->get_all();
        $data["templates"] = $this->InfoModule->get_templates();


    }

    private function  LoadProduct(&$data)
    {
        $this->load->model('ProductModel');
        $data["result"]= $this->ProductModel->get_all();

    }

    private function LoadCase(&$data)
    {
        $page_num=isset($this->uri->segments[4])?$this->uri->segments[4]:1;
//        $this->load->model('ProductCaseModel');
//        $data["result"]= $this->ProductCaseModel->get_all();//
        $this->load->library('pagination');
        $config["base_url"] = "/Management/Module/2";
        $config['per_page'] =15;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['first_link'] = '首页';
        $config['last_link'] = '末页';
        $start_item_num = $config['per_page'] * ($page_num - 1);
        $this->load->model('ProductCaseModel');
        $config["total_rows"]= $this->ProductCaseModel->get_num();
//        $config['total_rows'] = $this->InfoModel->get_num();
        $data['result'] = $this->ProductCaseModel->get_items_by_start_num($start_item_num, 15);
//        $data['title'] = $this->module_title;
//        $data['block_title'] = $this->module_title;
        $this->pagination->initialize($config);

    }


    public function SinglePage($id = 1)
    {
        $data["current_top_nav"] = "SinglePage";
        $data["current_left_nav"] = $id;
        $this->load->view('manage/manage_head.php', $data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_module_left.php');
        switch ($id) {
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
        $this->load->view('manage/manage_foot.php');
    }

    public function Authority($id = 1)
    {
        $data["current_top_nav"] = "Authority";
        $data["current_left_nav"] = $id;
        $this->load->view('manage/manage_head.php', $data);
        $this->load->view('manage/manage_top.php');
        $this->load->view('manage/manage_module_left.php');
        switch ($id) {
            case 1:
                $this->load->view('manage/manage_main_page_content3.php');
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
        $this->load->view('manage/manage_foot.php');
    }

    public function edit($module_id = null, $id = null)
    {

        if (isset($id) && isset($module_id)) {
            $this->load->model("InfoModule");
            $query_type = $this->InfoModule->get_module_type($module_id);
            $module = $this->InfoModule->get_from_id($module_id);
            if (count($query_type) > 0 && !empty($module)) {
                $model = ucfirst(strtolower($query_type[0]->flag)) . "Model";
                $this->load->model($model);
                $this->$model->module_id = $module_id;
                $query = $this->$model->get_from_id($id);

                if (count($query) > 0) {
                    $data["query"] = $query[0];
                    $data["pre_url"] = $_SERVER["HTTP_REFERER"];
//                    $this->load->view('manage_head.php', $data);
//                    $this->load->view('manage_left_nav.php', $data);
//                    $this->load->view('manage_content.php', $data);
//                    $this->load->view('manage/manage_foot.php', $data);
                    $data["types"] = $this->GetTypes();
                    $data["current_top_nav"] = "Module";
                    $data["current_left_nav"] = $query_type[0]->id;
                    $data["module"] = $module;
                    $this->load->view('manage/manage_head', $data);
                    $this->load->view('manage/manage_top');
                    $this->load->view('manage/manage_module_left');
                    $this->load->view('manage/manage_module_info_edit');
                    $this->load->view('manage/manage_foot');
                }

            }
        }
    }

    private function GetTypes()
    {
        $this->load->model("Type");
        return $this->Type->get_all();
    }

    public function delete($module_id = null, $id = null)
    {
        if (isset($id) && isset($module_id)) {
            $this->load->model("InfoModule");
            $query = $this->InfoModule->get_module_type($module_id);
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
            $this->load->model("InfoModule");
            $query = $this->InfoModule->get_module_type($module_id);
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
            $this->load->model("InfoModule");
            $query = $this->InfoModule->get_module_type($module_id);
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
        $data["pre_url"] = "/management/ModuleManage/" . $module_id;
        $data["module_id"] = $module_id;
        $this->load->model("InfoModule");
        $query = $this->InfoModule->get_module_type($module_id);
        $module = $this->InfoModule->get_from_id($module_id);
        if (count($query) > 0 && !empty($module)) {
//            $this->load->view('manage_head.php', $data);
//            $this->load->view('manage_left_nav.php', $data);
//            $this->load->view('manage_add.php', $data);
//            $this->load->view('manage/manage_foot.php', $data);
            $data["types"] = $this->GetTypes();
            $data["current_top_nav"] = "Module";
            $data["current_left_nav"] = $query[0]->id;
            $data["module"] = $module;
            $this->load->view('manage/manage_head', $data);
            $this->load->view('manage/manage_top');
            $this->load->view('manage/manage_module_left');
            $this->load->view('manage/manage_module_info_add', $data);
            $this->load->view('manage/manage_foot');
        }

    }


    public function ModuleManage($module_id = null, $page_num = 1)
    {
        $this->load->model("InfoModule");
        $query_type = $this->InfoModule->get_module_type($module_id);
        $query_module = $this->InfoModule->get_from_id($module_id);

        if (count($query_type) > 0 && count($query_module) > 0) {
            $model = ucfirst($query_type[0]->flag) . "Model";
            $this->load->model($model);
            $this->$model->module_id = $module_id;
            $this->load->library('pagination');
            $config["base_url"] = "/management/modulemanage/" . $module_id . "/";
            $config['uri_segment'] = 4;
            $config['per_page'] = 15;
            $config['num_links'] = 5;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<p>';
            $config['full_tag_close'] = '</p>';

            $config['first_link'] = '首页';
            $config['last_link'] = '末页';
            $config['prev_link'] = '上一页';
            $config['next_link'] = '下一页';

            $config['total_rows'] = $this->$model->get_num();
            $start_item_num = $config['per_page'] * ($page_num - 1);
            $data['query'] = $this->$model->get_items_by_start_num($start_item_num, 15);
            $data["module"] = $query_module;
            $data["types"] = $this->GetTypes();
            $data["current_top_nav"] = "Module";
            $data["current_left_nav"] = $query_type[0]->id;
            $this->pagination->initialize($config);
//            $this->load->view('manage_head.php', $data);
//            $this->load->view('manage_left_nav.php', $data);
//            $this->load->view('manage_list.php', $data);
//            $this->load->view('manage/manage_foot.php', $data);
            $this->load->view('manage/manage_head', $data);
            $this->load->view('manage/manage_top');
            $this->load->view('manage/manage_module_left');
            $this->load->view('manage/manage_module_info_list');
            $this->load->view('manage/manage_foot');


        }
    }

   /* public function AddProduct(){
        $this->load->Model("Type");
        $product_type=$this->Type->get_from_flag("product");
        if(empty($product_type)){
           exit();
        }
        $data["types"] = $this->GetTypes();
        $data["current_top_nav"] = "Module";
        $data["current_left_nav"] =$product_type->id;
        $this->load->view('manage/manage_head', $data);
        $this->load->view('manage/manage_top');
        $this->load->view('manage/manage_module_left');

        $this->load->view('manage/manage_foot');
    }*/

} 