<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

	private $limit = 20;
	function __construct()
	{
		parent::__construct();	
	    if($this->session->userdata('logged_in'))
		   {
			 $session_data = $this->session->userdata('logged_in');
			 $data['email'] = $session_data['email'];
			 $data['session_data'] = $session_data;
		   }
		else
		   {
				 redirect(base_url().'admin/login', 'refresh');
		   }		
		$this->load->model("servicesModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		// load data
		$this->load->model("servicesModel");
		$services = $this->servicesModel->get_services()->result();
		$data["services"] = $services;
		$data['title'] = 'Add New Service';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/services/services',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add()
	{
		$Service = $this->servicesModel->get_services()->result();
		$data["Service"] = $Service;
		$data['title'] = 'Add New Service';
		
		$data['action'] = site_url('admin/services/addservices');
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/services/servicesAdd', $data);
		$this->load->view('admin/footer');
	
	}
	/*public function unique_services() {
	  $this->servicesModel->check_service_name($this->input->post('service_name'));
	}*/
	
	public function addrecord()
	{				
		$this->form_validation->set_rules('service_name', 'Service Title', 'required|is_unique[tbl_services.service_name]');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{	
			$data = array('service_name' => $this->input->post('service_name'));   	
			
			$id = $this->servicesModel->save($data);
			$this->session->set_flashdata("message", "Service Added Successfully...");
			redirect('admin/services/','refresh');	
		}
	}
	
	public function edit($sid)
	{			
		$this->load->model("servicesModel");
		$servicesitem = $this->servicesModel->get_by_id($sid)->row();
		$data["servicesitem"] = $servicesitem;
		
		
		$data['title'] = 'Edit Service Item';
		$data['action'] = site_url('admin/services/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/services/servicesEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('service_name', 'Enter Service Name', 'required');	
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
				$data = array('service_name' => $this->input->post('service_name'));      
			
			$id = $this->input->post('sid');			
			$this->servicesModel->update($id,$data);
			$this->session->set_flashdata("message", "Service Updated Successfully...");
			redirect('admin/services/','refresh');	
		}				
	}

	function delete($id)
	{
		$this->load->model("servicesModel");
		$this->servicesModel->delete($id);
		$this->session->set_flashdata("message", "Service Deleted Successfully...");
		redirect('admin/services/','refresh');
	}
	

	
	
}