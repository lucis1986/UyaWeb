<?php
/**
 * Created by PhpStorm.
 * User: zly
 * Date: 14-8-18
 * Time: 下午3:49
 */
class product_case extends CI_Model
{
    var $id;
    var $title;
    var $author;
    var $modifier;
    var $created;
    var $modified;
    var $body;
    var $deleted=0;
    var $product_id;

    function __construct()
    {
        parent::__construct();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('product_case', 10);
        return $query->result();
    }
    function get_all()
    {
        $query = $this->db->get('product_case');
        return $query->result();
    }
    function get_from_product_id($product_id){
        $sql = "select * from product_case where $product_id=? and deleted=0";
        $query=$this->db->query($sql,array($product_id));
        return $query->result();
    }

    function get_from_id($id){
        $sql = "select  * from  product_case where id=? and deleted=0";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    function insert_entry($product_id)
    {
        $data = array(

             'title'=> $_POST['title'],
             'author'=>$_POST['author'],
             'created'=>date("Y-m-d H:i:s"),
             'body'=>$_POST['body'],
             '$product_id'=>$product_id

        );
        $this->db->insert('product_case', $data);

    }
    function update_entry($id){
        $data=array(
            'title'=> $_POST['title'],
            //'modifier'=>'',
            'modified'=>date("Y-m-d H:i:s"),
            'body'=>$_POST['body'],

        );
        $this->db->update('product_case', $data,array('id'=>$id));
    }

    function delete_entry($id)
    {
        $sql = "update product_case set deleted=1,modified='".date("Y-m-d H:i:s")."' where id in (".$id.") and deleted=0";
        $this->db->query($sql);
    }
}