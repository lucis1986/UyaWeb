<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data['title'] = ucfirst("主页");
        $this->load->Model("MainPageLink");
        $data["top_links"]=$this->MainPageLink->get_top_nav_enable();
        $data["links"]=$this->MainPageLink->get_nav_enable();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav', $data);
        $this->load->view('templates/content_s',$data);
        $this->load->view('templates/content_e',$data);
        $this->load->view('templates/footer',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */