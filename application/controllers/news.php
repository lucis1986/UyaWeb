<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-6-30
 * Time: 上午10:04
 */

class News extends CI_Controller
{
    public function test($id=4){
        echo $id;
    }
    public function  pages(){
        $this->load->library('pagination');
        $config['base_url'] = '/news/pages/';
        $config['total_rows'] = $this->db->get('news')->num_rows;
        $config['per_page'] =20;
        $config['num_links']=5;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '首页';
        $config['last_link'] = '末页';
        $this->pagination->initialize($config);
        $pagenum=$this->uri->segment(3)?$this->uri->segment(3):1;
        $start_item_num=$config['per_page']*($pagenum-1);
        $data['query']=$this->db->query('select  * from news order by ModifyTime desc limit '.$start_item_num.','.$config['per_page']);
        $data['title']="新闻公告";
        $data['blocktitle']="新闻公告";


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav', $data);
        $this->load->view('templates/listview', $data);
        $this->load->view('templates/footer', $data);
    }
    public function index(){
        $newsid="";
        if($this->uri->segment(3)){
            $newsid=$this->uri->segment(3);
        }
        if( isset( $newsid) && !empty( $newsid)){
            $data['query']=$this->db->query('select * from news where id='.$newsid);
            $articles=$data['query']->result();
            if($articles){
                $data['id']=$articles[0]->Id;
                $data['title'] =$articles[0]->Title;
                $data['body']=$articles[0]->Body;
                $data['blocktitle']="新闻公告";
                $this->load->view('templates/header', $data);
                $this->load->view('templates/topnav', $data);
                $this->load->view('templates/contentview', $data);
                $this->load->view('templates/footer', $data);
            }
        }
    }
    public function edit(){
        $newsid="";
        if($this->uri->segment(3)){
            $newsid=$this->uri->segment(3);
        }
        if( isset( $newsid) && !empty( $newsid)){
            $data['query']=$this->db->query('select * from news where id='.$newsid);
            $articles=$data['query']->result();
            if($articles){
                $data['id']=$articles[0]->Id;
                $data['title'] =$articles[0]->Title;
                $data['body']=$articles[0]->Body;
                $data['blocktitle']="新闻公告";
                $this->load->view('templates/header', $data);
                $this->load->view('templates/topnav', $data);
                $this->load->view('templates/editview', $data);
                $this->load->view('templates/footer', $data);
            }
        }
    }
    public  function save(){
        $servername=$_SERVER['SERVER_NAME'];//当前运行脚本所在服务器主机的名字。
        $sub_from=$_SERVER["HTTP_REFERER"];//链接到当前页面的前一页面的 URL 地址
        $sub_len=strlen($servername);//统计服务器的名字长度。
        $checkfrom=substr($sub_from,7,$sub_len);//截取提交到前一页面的url，不包含http:://的部分。
        if($checkfrom!=$servername){
            $msg="数据来源有误！请从本站提交！";
            header("Content-Type: text/html;charset=utf-8");
            echo $msg;
        }else{
            $this->load->model('NewsModel');
            $this->NewsModel->update_entry();
            $this->load->helper('url');
            redirect("../news/index/".$_POST['id']);
        }
    }
}