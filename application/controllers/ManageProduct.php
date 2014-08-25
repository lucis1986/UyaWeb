<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-18
 * Time: 下午2:12
 */
class ManageProduct extends CI_Controller
{
    function Add(){
        $this->load->Model("Type");
        $product_type=$this->Type->get_from_flag("product");
        if(empty($product_type)){
            exit();
        }
        $data["types"] = $this->GetTypes();
        $data["current_top_nav"] = "Module";
        $data["current_left_nav"] =$product_type->id;
        $data["pre_url"] = "/management/Module/" . $product_type->id;;
        $this->load->view('manage/manage_head', $data);
        $this->load->view('manage/manage_top');
        $this->load->view('manage/manage_module_left');
        $this->load->view('manage/manage_module_product_add');
        $this->load->view('manage/manage_foot');
    }
    function Edit($id=null){
        $this->load->model("ProductModel");
        $data["query"]=$this->ProductModel->get_from_id($id);
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
            $this->load->view('manage/manage_top');
            $this->load->view('manage/manage_module_left');
            $this->load->view('manage/manage_module_product_edit');
            $this->load->view('manage/manage_foot');
        }

    }

    private function GetTypes()
    {
        $this->load->model("Type");
        return $this->Type->get_all();
    }

    function SaveAdd(){
        $this->load->model("ProductModel");
        $this->ProductModel->insert_entry();
        $this->load->helper('url');
        $this->load->Model("Type");
        $product_type=$this->Type->get_from_flag("product");
        redirect("/Management/Module/".$product_type->id);

    }
    function SaveEdit(){
        $this->load->model("ProductModel");
        $this->ProductModel->update_entry();
        $this->load->helper('url');
        $this->load->Model("Type");
        $product_type=$this->Type->get_from_flag("product");
        redirect("/Management/Module/".$product_type->id);
    }
    function Delete(){
        $this->load->model("ProductModel");
        $this->ProductModel->delete_entry();
        $this->load->helper('url');
        $this->load->Model("Type");
        $product_type=$this->Type->get_from_flag("product");
        redirect("/Management/Module/".$product_type->id);
    }
} 