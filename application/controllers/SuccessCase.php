<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-14
 * Time: 上午10:09
 */
class SuccessCase extends CI_Controller
{
    function DCS()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/success_case_dcs');
        $this->load->view('vekada/foot');
    }
    function SCAD()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/success_case_scad');
        $this->load->view('vekada/foot');
    }
    function ESD()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/success_case_esd');
        $this->load->view('vekada/foot');
    }
    function FAndD()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/success_case_f_and_d');
        $this->load->view('vekada/foot');
    }
}