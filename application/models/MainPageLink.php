<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class MainPageLink extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('type', 10);
        return $query->result();
    }
    function get_top_nav()
    {
        $query = $this->db->query('select * from main_page_link where flag=1 order by id');
        return $query->result();
    }

    function get_top_nav_enable()
    {
        $query = $this->db->query('select * from main_page_link where flag=1 and enable=1 order by id');
        return $query->result();
    }

    function get_nav(){
        $query = $this->db->query('select * from main_page_link where flag=2 order by id');
        return $query->result();
    }

    function get_nav_enable(){
        $query = $this->db->query('select * from main_page_link where flag=2 and enable=1 order by id');
        return $query->result();
    }
    function update_nav($row){
        $id=$row[0];
        $data = array(
            'title' => $row[1],
            'link'=>$row[2]
        );
        if(isset($row[3])&&$row[3]==="on"){
            $data["enable"]=true;
        }else{
            $data["enable"]=false;
        }
        $this->db->update('main_page_link', $data, array('id' =>$id));

    }



} 