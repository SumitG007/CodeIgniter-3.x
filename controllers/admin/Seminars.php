<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seminars extends CI_Controller {

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
		$this->load->model("seminarsModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		// load data
		$data[''] = "";
		$this->load->view('admin/header');
		$this->load->view('admin/seminars/seminars',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add()
	{
		$data[''] = "";
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/seminars/seminarsAdd', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function add_event()
	{
		$data[''] = "";
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/seminars/seminarsEvent', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function view_registration()
	{
		$data[''] = "";
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/seminars/view_registration', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function view_seminars()
	{
		$seminars = $this->seminarsModel->get_seminars()->result();
		$data["seminars"] = $seminars;
		$data['title'] = 'Add New seminars';
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['action'] = site_url('admin/seminars/addseminars');
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/seminars/view_seminars', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function addrecord()
	{				
		$this->form_validation->set_rules('cname', 'seminars Title', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{	
			$data = array('cname' => $this->input->post('cname'),
						  'content' => ($this->input->post('content')),
						  'status' => 'active',
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')						  						     					     
							);   	
			
			$id = $this->seminarsModel->save($data);
			$this->session->set_flashdata("message", "seminars Added Successfully...");
			redirect('admin/seminars/','refresh');	
		}
	}
	
	public function edit($cid)
	{			
		$this->load->model("seminarsModel");
		$seminarsitem = $this->seminarsModel->get_by_id($cid)->row();
		$data["seminarsitem"] = $seminarsitem;
		
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit seminars Item';
		$data['action'] = site_url('admin/seminars/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/seminars/seminarsEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('cname', 'Enter seminars Name', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
				$data = array('cname' => $this->input->post('cname'),
						  'content' => ($this->input->post('content')),
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')						  						     					     
							);      
			
			$id = $this->input->post('cid');			
			$this->seminarsModel->update($id,$data);
			$this->session->set_flashdata("message", "seminars Updated Successfully...");
			redirect('admin/seminars/','refresh');	
		}				
	}
	
	function deactive($cid)
	{
		$seminars = array('status' => 'inactive');
		$this->seminarsModel->deactive($cid,$seminars);
	
		redirect('admin/seminars/','refresh');
	}
	function active($cid)
	{
		$seminars = array('status' => 'active');
		$this->seminarsModel->active($cid,$seminars);
		redirect('admin/seminars/','refresh');
	}

	function delete($id)
	{
		$this->load->model("seminarsModel");
		$this->seminarsModel->delete($id);
		$this->session->set_flashdata("message", "seminars Deleted Successfully...");
		redirect('admin/seminars/','refresh');
	}
	
	function sort_order()
		{			
			// load data
			$this->load->model("seminarsModel");
			$seminars = $this->seminarsModel->get_seminars()->result();
			
			$i=0; 
			foreach($seminars as $item) { 
				
				$arr = array('no' => $_POST["txt"][$i]);
				$this->seminarsModel->update_seminars($seminars[$i]->cid,$arr);
				
			$i++; }
				
			$this->session->set_flashdata("message", "Banner Updated Successfully...");
			redirect('admin/seminars/','refresh');
			
			
			
		}
	
	
}