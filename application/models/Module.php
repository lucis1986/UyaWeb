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
        $sql = "select * from module where type_id=? and deleted=0";
        $query=$this->db->query($sql,array($type_id));
        return $query->result();
    }

    function  get_module_type($id){
        $sql = "select * from type where id =(select type_id from module where id=?)";
        $query=$this->db->query($sql,array($id));
        return $query->result();
    }
    function get_from_id($id){
        $sql = "select  * from  module where id=? and deleted=0";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    function insert_entry($type_id)
    {
        $data = array(
            'title'=> $_POST['title'],
            'type_id'=>$type_id,
            'flag'=>$_POST['flag']
        );
        $this->db->insert('module', $data);

    }
    function update_entry($id){
        $data=array(
            'title'=> $_POST['title'],
            'flag'=>$_POST['flag']
        );
        $this->db->update('module', $data,array('id'=>$id));
    }

    function delete_entry($id)
    {
        $sql = "update module set deleted=1,flag=CONCAT(flag,'___".date('Y-m-d H:i:s',time())."') where id in (".$id.") and deleted=0";
        $this->db->query($sql);
    }

} 