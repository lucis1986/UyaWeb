<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-2
 * Time: 上午10:52
 */
class NewsModel extends CI_Model {
    var $Title   = '';
    var $Body = '';
    var $ModifyTime;
    var $Author;

    function __construct()
    {
        parent::__construct();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('news', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // 请阅读下方的备注
        $this->body = $_POST['body'];
        $this->ModifyTime    = time();

        $this->db->insert('news', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->body = $_POST['body'];
        $this->ModifyTime    =  date('y-m-d h:i:s',time());
        $this->db->update('news', $this, array('id' => $_POST['id']));
    }

    function delete_entry()
    {
        $this->db->delete('news', $this, array('id' => $_POST['id']));
    }

} 