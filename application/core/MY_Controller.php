<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-28
 * Time: 上午9:34
 */
class MY_Controller extends CI_Controller
{
    var $check = false;

    function __construct()
    {
        parent::__construct();
        if ($this->check) {
            $this->CheckLogin();
        }
    }

    public function CheckLogin()
    {
        echo "ssssttt";
    }
} 