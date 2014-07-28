<?php
/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-24
 * Time: 下午3:57
 */
class GTest extends MY_Controller{
    function __construct()
    {
        $this->check=true;
        parent::__construct();
    }
    function index(){
//        $this->load->model("Type");
//        $data["test"]=$this->Type->get_smallest_id();
//        $t=0;
        echo "sssss";
    }

}