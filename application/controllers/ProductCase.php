<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-14
 * Time: 上午10:09
 */
class ProductCase extends CI_Controller
{
    function Index($id=null){
        $this->load->model("ProductCaseModel");
        $data["query"]=$this->ProductCaseModel->get_from_id($id);
        if (!empty($data["query"])) {
            $data["title"]=$data["query"]->title;
            $product_id=$data["query"]->product_id;
            $this->load->Model("ProductModel");
            $data["product"]= $this->ProductModel->get_from_id($product_id);
            $data["query2"]=$this->ProductCaseModel->get_from_product_id_except_self($product_id,$id);
            load_template($this, "product_case_template", $data);
        }
    }
}