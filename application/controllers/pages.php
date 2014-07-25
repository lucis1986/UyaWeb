<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Saphir
 * Date: 14-5-20
 * Time: 下午3:23
 * To change this template use File | Settings | File Templates.
 */
class Pages extends CI_Controller
{
    public function view($id)
    {

        if ($id != null) {
            $data['title'] = $id;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topnav', $data);
            $this->load->view('templates/view', $data);

            $this->load->view('templates/footer', $data);
        }

    }


}
