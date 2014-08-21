<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-18
 * Time: 上午9:39
 */
class ProductModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $sql = "select  * from  product where deleted=0";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function  get_from_id($id){
        $sql = "select  * from  product where  deleted=0 and id=?";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    function insert_entry()
    {
        $max_item_id = $this->get_max_id();
        $max_id = (int)$max_item_id->id + 1;
        $this->db->trans_start();
        $product_data = array(
            'id' => $max_id,
            'title' => $_POST['title'],
            'author' => '',
            'modifier' => '',
            'created' => date('Y-m-d H:i:s', time()),
            'modified' => date('Y-m-d H:i:s', time()),
            'body' => $_POST['body']
        );
        $this->db->insert('product', $product_data);
        if (isset($_POST['case']) && !empty($_POST['case'])) {
            $product_cases = $_POST['case'];
            foreach ($product_cases as $product_case) {
                $product_case_data = array(
                    'title' =>rawurldecode($product_case[1]),
                    'author' => '',
                    'modifier' => '',
                    'created' => date('Y-m-d H:i:s', time()),
                    'modified' => date('Y-m-d H:i:s', time()),
                    'body' => rawurldecode($product_case[2]),
                    'product_id'=>$max_id
                );
                $this->db->insert('product_case', $product_case_data);
            }
        }

        $this->db->trans_complete();
    }
    function update_entry()
    {
        $id=$_POST["id"];
        $this->db->trans_start();
        $product_data = array(
            'title' => $_POST['title'],
            'modifier' => '',
            'modified' => date('Y-m-d H:i:s', time()),
            'body' => $_POST['body']
        );
        $this->db->update('product', $product_data,array('id'=>$id));
        if (isset($_POST['case']) && !empty($_POST['case'])) {
            $product_cases = $_POST['case'];
            foreach ($product_cases as $product_case) {
                if(empty( $product_case[0]))
                {
                    $product_case_data = array(
                        'title' => rawurldecode($product_case[1]),
                        'author' => '',
                        'modifier' => '',
                        'created' => date('Y-m-d H:i:s', time()),
                        'modified' => date('Y-m-d H:i:s', time()),
                        'body' => rawurldecode($product_case[2]),
                        'product_id'=>$id
                    );
                    $this->db->insert('product_case', $product_case_data);
                }else{
                    $product_case_data = array(
                        'title' => rawurldecode($product_case[1]),
                        'modifier' => '',
                        'modified' => date('Y-m-d H:i:s', time()),
                        'body' => rawurldecode($product_case[2]),
                    );
                    $this->db->update('product_case', $product_case_data,array('id'=>$product_case[1]));
                }

            }




        }
        $this->db->trans_complete();
    }

    function get_product_case($product_id){
        $sql = "select  * from  product_case where  deleted=0 and product_id=?";
        $query=$this->db->query($sql,array($product_id));
        return $query->result();
    }
    function get_max_id()
    {
        $query = $this->db->query("select max(id) as id from product");
        return $query->row();
    }
} 