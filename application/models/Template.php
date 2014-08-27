<?php
/**
 * Created by PhpStorm.
 * User: zly
 * Date: 14-8-18
 * Time: 下午3:28
 */
class Template extends CI_Model
{
    var $id;
    var $title;
    var $description;
    var $flag;

    function __construct()
    {
        parent::__construct();
    }


    function get_all()
    {
        $query = $this->db->get('template');
        return $query->result();
    }



    function get_from_id($id){
        $sql = "select  * from  template where id=? ";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    function insert_entry()
    {
        $data = array(
            'title'=> $_POST['title'],
            'description'=>$_POST['description'],
            'flag'=>$_POST['flag']
        );
        $this->db->insert('template', $data);

    }
    function update_entry($id){
        $data=array(
            'title'=> $_POST['title'],
            'description'=>$_POST['description'],
            'flag'=>$_POST['flag']
        );
        $this->db->update('template', $data,array('id'=>$id));
    }

    function delete_entry($id)
    {
        $sql = "delete from template where id=".$id;
        $this->db->query($sql);
    }

}