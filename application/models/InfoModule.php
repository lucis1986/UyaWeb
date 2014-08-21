<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class InfoModule extends CI_Model {


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
        $sql = "select * from module where deleted=0";
        $query=$this->db->query($sql);
        return $query->result();
    }


    function  get_module_type($id){
        $sql = "select * from type where id =(select type_id from module where id=?)";
        $query=$this->db->query($sql,array($id));
        return $query->result();
    }
    function get_module_template($id){
        $sql = "select flag from template where id =(select template_id from module where id=?)";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }
    function get_from_id($id){
        $sql = "select  * from  module where id=? and deleted=0";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    function get_templates(){
        $sql = "select * from template";
        $query=$this->db->query($sql);
        return $query->result();
    }


    function insert_entry($type_id)
    {
        $data = array(
            'title'=> $_POST['title'],
            'type_id'=>$type_id,
            'flag'=>$_POST['flag'],
            "template_id"=>$_POST['template']
        );
        $this->db->insert('module', $data);

    }
    function update_entry($id){
        $data=array(
            'title'=> $_POST['title'],
            'flag'=>$_POST['flag'],
            "template_id"=>$_POST['template']
        );
        $this->db->update('module', $data,array('id'=>$id));
    }

    function delete_entry()
    {
        $sql = "update module set deleted=1,flag=CONCAT(flag,'___".date('Y-m-d H:i:s',time())."') where id in (".$_POST["module_ids"].") and deleted=0";
        $this->db->query($sql);
    }

} 