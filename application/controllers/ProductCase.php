<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-14
 * Time: 上午10:09
 */
class ProductCase extends CI_Controller
{
    function Index(){
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_all();
//        if (!empty($data["query"])) {
//            $data["title"]=$data["query"]->title;
//            $product_id=$data["query"]->product_id;
//            $this->load->Model("ProductCaseModel");
//
//            load_template($this, "product_case_template", $data);
//        }
        $this->load->view("/manage/mannage_case_list");
    }

    function CaseInfo($id)
    {
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_from_id($id);
//        if (!empty($data["query"])) {
//            $data["title"]=$data["query"]->title;
//            $data["body"]=$data["query"]->body;
//            $data["created"]=$data["query"]->created;
//            $data["created"]=$data["query"]->created;
//            $product_id=$data["query"]->product_id;
//            $this->load->Model("ProductCaseModel");
//
//            load_template($this, "product_case_template", $data);
//        }
        $this->load->view("/manage/mannage_case_view");
    }


    function Edit($id=null){
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_from_id($id);
        if(!empty($data["query"])){
            $this->load->model("Type");
            $product_type=$this->Type->get_from_flag("product");
            if(empty($product_type)){
                exit();
            }
            $data["types"] = $this->GetTypes();
            $data["current_top_nav"] = "Module";
            $data["current_left_nav"] =$product_type->id;
            $data["pre_url"] = "/management/Module/" . $product_type->id;;
            $this->load->model("ProductCaseModel");
            $data["query2"]=$this->ProductCaseModel->get_from_product_id($id);
            $this->load->view('manage/manage_head', $data);

            $this->load->view('manage/manage_case_edit');

        }

    }



    function SaveAdd(){
        $this->load->model("ProductCaseModel");
        $this->ProductCaseModel->insert_entry();
//        $this->load->helper('url');
//        $this->load->Model("Type");
//        $product_type=$this->Type->get_from_flag("product");
//        redirect("/Management/Module/".$product_type->id);

    }
    function SaveEdit($id){
        $this->load->model("ProductCaseModel");
        $this->ProductCaseModel->update_entry($id);
//        $this->load->helper('url');
//        $this->load->Model("Type");
//        $product_type=$this->Type->get_from_flag("product");
//        redirect("/Management/Module/".$product_type->id);
    }
    function Delete($id){
        $this->load->model("ProductCaseModel");
        $this->ProductCaseModel->delete_entry($id);
//        $this->load->helper('url');
//        $this->load->Model("Type");
//        $product_type=$this->Type->get_from_flag("product");
//        redirect("/Management/Module/".$product_type->id);
    }
}