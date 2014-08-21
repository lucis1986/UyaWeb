<?php

/**
 * Created by PhpStorm.
 * User: Saphir
 * Date: 14-8-14
 * Time: 上午9:34
 */
class Product extends CI_Controller
{


    public function Index($id = null)
    {
        $this->load->Model("ProductModel");
        $data["query"] = $this->ProductModel->get_from_id($id);
        if (!empty($data["query"])) {
            $data["title"]=$data["query"]->title;
            $this->load->Model("ProductCaseModel");
            $data["query2"]= $this->ProductCaseModel->get_from_product_id($id);
            load_template($this, "product_template", $data);

        }
    }

    public function Clorox()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_clorox');
        $this->load->view('vekada/foot');
    }

    public function ElectrolysisOfCopperAndAluminum()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_electrolysis_of_copper_and_aluminum');
        $this->load->view('vekada/foot');
    }

    public function DomesticSewage()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_domestic_sewage');
        $this->load->view('vekada/foot');
    }

    public function SpecialTechnology()
    {
        $this->load->view('vekada/head');
        $this->load->view('vekada/company_special_technology');
        $this->load->view('vekada/foot');
    }
} 