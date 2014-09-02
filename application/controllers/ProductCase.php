<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-14
 * Time: 上午10:09
 */
class ProductCase extends CI_Controller
{
    var $base_url = "/ProductCase/pages";
    var $id = 0;
    var $title = "";
    public function  pages($page_num = 1)
    {
        $this->load->Model("MainPageLink");
        $data["top_links"] = $this->MainPageLink->get_top_nav_enable();
        $data["links"] = $this->MainPageLink->get_nav_enable();
        $this->load->library('pagination');
        $config["base_url"] = $this->base_url;
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '首页';
        $config['last_link'] = '末页';
        $start_item_num = $config['per_page'] * ($page_num - 1);
        $this->load->model('ProductCaseModel');
        $this->ProductCaseModel->id = $this->id;
        $config['total_rows'] = $this->ProductCaseModel->get_num();
        $data['query'] = $this->ProductCaseModel->get_items_by_start_num($start_item_num, 20);
        $data['title'] = $this->title;
        $data['block_title'] = $this->title;
        $data['class'] = $this->uri->segments[1];
        $this->pagination->initialize($config);

        $this->load->model("ProductCaseModel");
        $query=$this->ProductCaseModel->get_all();
        $this->load->view("/manage/manage_module_case",$query);
      //  load_template($this,"page_template",$data);
    }

    function Index($id=null){
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_from_id($id);
        if (!empty($data["query"])) {
            $data["title"]=$data["query"]->title;
            $product_id=$data["query"]->product_id;
            $this->load->Model("ProductModel");
            $data["product"]=$this->ProductModel->get_from_id($product_id);
            $data["query2"]=$this->ProductCaseModel->get_from_product_id_except_self($product_id,$id);
            load_template($this, "product_case_template", $data);
        }

    }

    function CaseInfo($id)
    {
        $this->load->model("ProductCaseModel");
        $query=$this->ProductCaseModel->get_from_id($id);
        $this->load->view("/manage/manage_case_view",$query);
    }


    function Edit($id=null){
        if($id==null)
        {
            $this->load->model("Type");
            $data["query2"]=$this->Type->get_from_flag("case");

            $this->load->model("ProductModel");
            $data["query3"]=$this->ProductModel->get_all();

                $data["id"]="";
                $data["title"]="";
                $data["body"]="";
                $data["author"]="";
                $data["created"]="";
                $data["product_id"]="";

                $data["types"] = $this->Type->get_all();
                $data["current_top_nav"] = "Module";
                $data["current_left_nav"] = $data["query2"]->id;
                $data["pre_url"]="/Management/Module/".$data["query2"]->id;
                $this->load->view('manage/manage_head',$data);
                $this->load->view('manage/manage_module_left');
                $this->load->view('manage/manage_case_edit');
                $this->load->view('manage/manage_foot');

        }
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_from_id($id);
        $this->load->model("Type");
        $data["query2"]=$this->Type->get_from_flag("case");

        $this->load->model("ProductModel");
        $data["query3"]=$this->ProductModel->get_all();

        if(!empty($data["query"])){
                    $data["id"]=$data["query"]->id;
            $data["title"]=$data["query"]->title;
            $data["body"]=$data["query"]->body;
            $data["author"]=$data["query"]->author;
            $data["created"]=$data["query"]->created;
            $data["product_id"]=$data["query"]->product_id;

            $data["types"] = $this->Type->get_all();
            $data["current_top_nav"] = "Module";
            $data["current_left_nav"] = $data["query2"]->id;
            $data["pre_url"]="/Management/Module/".$data["query2"]->id;
            $this->load->view('manage/manage_head',$data);
            $this->load->view('manage/manage_module_left');
            $this->load->view('manage/manage_case_edit');
            $this->load->view('manage/manage_foot');
        }

    }

    function Save($id){
        $this->load->model("ProductCaseModel");
        if($id==null)
        {
            $this->ProductCaseModel->insert_entry();
        }
        else
        {
            $this->ProductCaseModel->update_entry($id);
        }
        $this->load->model("Type");
        $data["query2"]=$this->Type->get_from_flag("case");
        $this->load->helper('url');
        redirect("/Management/Module/".$data["query2"]->id);

    }
    function Delete($id){
        $this->load->model("ProductCaseModel");
        $this->ProductCaseModel->delete_entry($id);
        $this->load->model("Type");
        $data["query2"]=$this->Type->get_from_flag("case");
        $this->load->helper('url');
        redirect("/Management/Module/".$data["query2"]->id);
    }

    function IsExist($title)
    {
        $this->load->model("ProductCaseModel");
        echo  $this->ProductCaseModel->is_exist($title);
    }
}