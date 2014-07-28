<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-14
 * Time: 下午3:30
 */

class DB_Redirect extends CI_Controller
{
    public function index()
    {
        $module = $this->db->query('select  * from module where deleted=0 and flag="' . $this->uri->segments[1] . '"')->result();
        if (count($module) > 0) {
            $module_id=$module[0]->id;
            $module_title=$module[0]->title;
            $type = $this->db->query('select  * from type where id=' . $module[0]->type_id)->result();
            if (count($type) > 0) {
                $class= $type[0]->flag;
                require(APPPATH."controllers/".$class.".php");
                $ci=new $class();
                $method=$this->uri->segments[2];
                $ci->base_url="/".$this->uri->segments[1]."/".$method;
                $ci->module_id=$module_id;
                $ci->module_title=$module_title;
                $num=!isset($this->uri->segments[3])?1:$this->uri->segments[3];
                call_user_func_array(array(&$ci,$method),array($num));
            }
        }else{
            show_404("");
        }
    }
} 