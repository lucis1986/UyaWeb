<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class InfoModel extends CI_Model {

    var $module_id;
    function __construct()
    {
        parent::__construct();
    }
    function get_num(){
        $sql = "select  * from  info where module_id=? and deleted=0";
        $query = $this->db->query($sql,array($this->module_id));
        return $query->num_rows;
    }
    function get_items_by_start_num($start=0,$num=20){
        $sql = "select  * from info where  module_id=? and deleted=0 order by modified desc limit ? , ?";
        $query = $this->db->query($sql,array($this->module_id,$start,$num));
        return $query->result();
    }

    function  get_from_id($id){
        $sql = "select  * from  info where module_id=? and deleted=0 and id=?";
        $query=$this->db->query($sql,array($this->module_id,$id));
        return $query->result();
    }
    function get_all()
    {
        $sql = "select  * from  info where module_id=? and deleted=0";
        $query = $this->db->query($sql,array($this->module_id));
        return $query->result();
    }
    function insert_entry()
    {
        $data = array(
            'module_id'=>$this->module_id,
            'title' => $_POST['title'],
            'author'=>'',
            'modifier'=>'',
            'created'=>date('Y-m-d H:i:s',time()),
            'modified'=>date('Y-m-d H:i:s',time()),
            'body'=> $_POST['body']
        );
        $this->db->insert('info', $data);
    }


    function update_entry()
    {
        $data = array(
            'title' => $_POST['title'],
            'modifier'=>'',
            'modified'=>date('Y-m-d H:i:s',time()),
            'body'=> $_POST['body']
        );
        $this->db->update('info', $data, array('id' => $_POST['id']));
    }
    function delete_entry($id=null)
    {

        $data = array(
            'deleted' =>1
        );
        $this->db->update('info', $data, array('id' => $id));

    }

} 