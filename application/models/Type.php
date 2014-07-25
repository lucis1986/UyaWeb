<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class Type extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('type', 10);
        return $query->result();
    }
    function get_all()
    {
        $query = $this->db->get('type');
        return $query->result();
    }
    function get_min_id(){
        $query = $this->db->query("select min(id) as id from type");
        return $query->row();
    }
    function get_from_id($id){
        $sql = "select  * from  type where id=?";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }
    function get_from_flag($flag){
        $sql = "select  * from  type where flag=?";
        $query=$this->db->query($sql,array($flag));
        return $query->row();
    }



} 