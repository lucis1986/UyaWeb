<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-6-30
 * Time: 上午10:04
 */
class Doc extends CI_Controller
{

    var $base_url = "/info/pages";
    var $module_id = 0;
    var $module_title="";

    public function  pages($page_num = 1)
    {
        $this->load->library('pagination');
        $config["base_url"] = $this->base_url;
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '首页';
        $config['last_link'] = '末页';
        $start_item_num = $config['per_page'] * ($page_num - 1);
        $this->load->model('DocModel');
        $this->DocModel->module_id = $this->module_id;
        $config['total_rows'] =$this->DocModel->get_num();
        $data['query'] = $this->DocModel->get_items_by_start_num($start_item_num, 20);
        $data['title'] = $this->module_title;
        $data['block_title'] = $this->module_title;
        $data['class']=$this->uri->segments[1];
        $this->pagination->initialize($config);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/TopNav', $data);
        $this->load->view('templates/ListView', $data);
        $this->load->view('templates/footer', $data);
    }

    public function index($id=null)
    {
        if (isset($id)) {
            $this->load->model('DocModel');
            $this->DocModel->module_id = $this->module_id;
            $item = $this->DocModel->get_from_id($id);
            if ($item) {
                $data['id'] = $item[0]->id;
                $data['title'] = $item[0]->title;
                $data['body'] = $item[0]->body;
                $data['block_title'] = $this->module_title;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/TopNav', $data);
                $this->load->view('templates/ContentView', $data);
                $this->load->view('templates/footer', $data);
            }
        }
    }


    public function edit()
    {
        $id = "";
        if ($this->uri->segment(3)) {
            $id = $this->uri->segment(3);
        }
        if (isset($id) && !empty($id)) {
            $data['query'] = $this->db->query('select * from news where id=' . $id);
            $articles = $data['query']->result();
            if ($articles) {
                $data['id'] = $articles[0]->Id;
                $data['title'] = $articles[0]->Title;
                $data['body'] = $articles[0]->Body;
                $data['block_title'] = "新闻公告";
                $this->load->view('templates/header', $data);
                $this->load->view('templates/TopNav', $data);
                $this->load->view('templates/EditView', $data);
                $this->load->view('templates/footer', $data);
            }
        }
    }

    public function save()
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
            $this->load->model('NewsModel');
            $this->NewsModel->update_entry();
            $this->load->helper('url');
            redirect("../news/index/" . $_POST['id']);
        }
    }
}