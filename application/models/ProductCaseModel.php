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
        $query = $this->db->query("select max(id) as id from product");
        return $query->row();
    }
} 