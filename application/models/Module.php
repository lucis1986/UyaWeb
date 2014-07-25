<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class Module extends CI_Model {
    var $title   = '';
    var $type_id;
    var $flag='';
    var $deleted=0;

    function __construct()
    {
        parent::__construct();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('module', 10);
        return $query->result();
    }
    function get_all()
    {
        $query = $this->db->get('module');
        return $query->result();
    }
    function get_from_type_id($type_id){
        $sql = "select * from module where type_id=?";
        $query=$this->db->query($sql,array($type_id));
        return $query->result();
    }

    function  get_module_type($id){
        $sql = "select flag from type where id =(select type_id from module where id=?)";
        $query=$this->db->query($sql,array($id));
        return $query->result();
    }
    function get_from_id($id){
        $sql = "select  * from  module where id=?";
        $query=$this->db->query($sql,array($id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // 请阅读下方的备注
        $this->type_id = $_POST['type'];
        $this->flag=$_POST['flag'];
        $this->db->insert('module', $this);
    }

    function delete_entry()
    {
        $this->db->delete('module', $this, array('id' => $_POST['id']));
    }

} 