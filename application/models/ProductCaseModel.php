<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-18
 * Time: 上午9:39
 */
class ProductCaseModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $sql = "select  * from  product_case where deleted=0";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function  get_from_id($id)
    {
        $sql = "select  * from  product_case where  deleted=0 and id=?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    function  get_from_product_id($product_id)
    {
        $sql = "select  * from  product_case where  deleted=0 and product_id=?";
        $query = $this->db->query($sql, array($product_id));
        return $query->result();
    }

    function get_from_product_id_except_self($product_id, $id)
    {
        $sql = "select  * from  product_case where  deleted=0 and product_id=? and id !=?";
        $query = $this->db->query($sql, array($product_id,$id));
        return $query->result();
    }

    function get_max_id()
    {
        $query = $this->db->query("select max(id) as id from product_case");
        return $query->row();
    }


    function insert_entry()
    {
        $data = array(

            'title'=> $_POST['title'],
            'author'=>$_POST['author'],
            'created'=>date("Y-m-d H:i:s"),
            'body'=>$_POST['body'],


        );
        $this->db->insert('product_case', $data);

    }

    function update_entry($id){
        $data=array(
            'title'=> $_POST['title'],
            'author'=>$_POST['author'],
            'modified'=>date("Y-m-d H:i:s"),
            'body'=>$_POST['body']


        );
        $this->db->update('product_case', $data,array('id'=>$id));
    }

    function delete_entry($id)
    {
        $sql = "update product_case set deleted=1,modified='".date("Y-m-d H:i:s")."' where id in (".$id.") and deleted=0";
        $this->db->query($sql);
    }
} 