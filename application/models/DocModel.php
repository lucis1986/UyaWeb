<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class DocModel extends CI_Model {

    var $module_id;
    var $title   = '';
    var $author='';
    var $created;
    var $path="";

    function __construct()
    {
        parent::__construct();
    }
    function get_num(){
        $sql = "select  * from  doc where module_id=?";
        $query = $this->db->query($sql,array($this->module_id));
        return $query->num_rows;
    }
    function get_items_by_start_num($start=0,$num=20){
        $sql = "select  * from doc where  module_id=? order by created desc limit ? , ?";
        $query = $this->db->query($sql,array($this->module_id,$start,$num));
        return $query->result();
    }

    function  get_from_id($id){
        $sql = "select  * from  doc where id=?";
        $query=$this->db->query($sql,array($id));
        return $query->result();
    }
    function get_all()
    {
        $sql = "select  * from  doc ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // 请阅读下方的备注
        $this->author="";
        $this->created=date('y-m-d h:i:s',time());
        $this->path="";
        $this->db->insert('doc', $this);
    }
    function delete_entry()
    {
        $this->db->delete('info', $this, array('id' => $_POST['id']));
    }

} 