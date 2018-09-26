<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My404 extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
				
	}
	
	public function index()
	{    
		$this->output->set_status_header('404'); 
        
        $this->load->view('error_404');//loading in my template 
		 
	}
	
			
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */