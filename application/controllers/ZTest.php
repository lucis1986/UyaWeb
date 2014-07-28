<?php
/**
 * Created by PhpStorm.
 * User: zly
 * Date: 14-7-28
 * Time: 上午11:51
 */

class ZTest extends MY_Controller {

    function __construct()
    {
        $this->check=true;
        parent::__construct();
    }
    function index(){
        $id="19,62,63";
        $this->load->model("Module");
        $this->Module->delete_entry($id);

        $this->load->helper('url');
        redirect($_SERVER["HTTP_REFERER"]);
    }
} 