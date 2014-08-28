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
        $query=$this->ProductCaseModel->get_all();
//        if (!empty($data["query"])) {
//            $data["title"]=$data["query"]->title;
//            $product_id=$data["query"]->product_id;
//            $this->load->Model("ProductCaseModel");
//
//            load_template($this, "product_case_template", $data);
//        }
        $this->load->view("/manage/manage_module_case",$query);
    }

    function CaseInfo($id)
    {
        $this->load->model("ProductCaseModel");
        $query=$this->ProductCaseModel->get_from_id($id);
        $this->load->view("/manage/manage_case_view",$query);
    }


    function Edit($id=null){
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_from_id($id);
        if(!empty($data["query"])){
                    $data["id"]=$data["query"]->id;
            $data["title"]=$data["query"]->title;
            $data["body"]=$data["query"]->body;
            $data["author"]=$data["query"]->author;
            $data["created"]=$data["query"]->created;
            $this->load->view('manage/manage_case_edit',$data);
        }

    }

function aa()
{
    echo "aa";
}

    function Save($id){
        $this->load->model("ProductCaseModel");
        $this->ProductCaseModel->update_entry($id);

        redirect("/Management/Module/2");
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