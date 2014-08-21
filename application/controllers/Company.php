<?php

class Company extends CI_Controller
{
   function Intro(){
       $this->load->view('vekada/head');
       $this->load->view('vekada/company_intro');
       $this->load->view('vekada/foot');
   }
    function Development(){
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_development');
        $this->load->view('vekada/foot');
    }
    function Culture(){
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_culture');
        $this->load->view('vekada/foot');
    }
    function Contact(){
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_contact');
        $this->load->view('vekada/foot');
    }


}