<?php
/**
 * Created by PhpStorm.
 * User: zly
 * Date: 14-8-18
 * Time: 下午3:37
 */
class product extends CI_Model
{
    var $id;
    var $title;
    var $author;
    var $modifier;
    var $created;
    var $modified;
    var $body;
    var $deleted=0;

    function __construct()
    {
        parent::__construct();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('product', 10);
        return $query->result();
    }
    function get_all()
    {
        $query = $this->db->get('product');
        return $query->result();
    }


    function get_from_id($id){
        $sql = "select  * from  product where id=? and deleted=0";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    function insert_entry()
    {
        $data = array(
             'title'=> $_POST['title'],
             'author'=>$_POST['author'],
             'created'=>date("Y-m-d H:i:s"),
             'body'=>$_POST['body']
        );
        $this->db->insert('product', $data);

    }
    function update_entry($id){
        $data=array(
            'title'=> $_POST['title'],
            'modifier'=>$_POST['modifier'],
            'modified'=>date("Y-m-d H:i:s"),
            'body'=>$_POST['body']
        );
        $this->db->update('product', $data,array('id'=>$id));
    }

    function delete_entry($id)
    {
        $sql = "update product set deleted=1,modified='".date("Y-m-d H:i:s")."' where id in (".$id.") and deleted=0";
        $this->db->query($sql);
    }

}