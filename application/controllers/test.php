<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-7-3
 * Time: 下午4:28
 */
class Test extends CI_Controller
{
    public function s()
    {


     /*   if (unlink("application/controllers/test")) {
            echo "The file was deleted successfully.", "n";
        }*/
        $this->load->helper("url");
        $temp=fopen("application/controllers/testc.php","w");
        $txt="<?php
                class TestC extends CI_Controller
                {
                    public function index()
                    {
                        echo 'ssssss';
                    }
                }
            ";
        fwrite($temp, $txt);
        fclose($temp);
        redirect("../testc/index/");
    }


} 