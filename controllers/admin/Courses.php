<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller { 

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
		$this->load->model("coursesModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		// load data
		$this->load->model("coursesModel");
		$courses = $this->coursesModel->get_courses()->result();
		$data["courses"] = $courses;
		$data['title'] = 'Add New Course';
		$data['message'] = $this->session->flashdata('message');
		$this->load->view('admin/header');
		$this->load->view('admin/courses/courses',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add()
	{
		$Courses = $this->coursesModel->get_courses()->result();
		$data["Courses"] = $Courses;
		$data['title'] = 'Add New Course';
		$data['action'] = site_url('admin/courses/addcourses');
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/courses/coursesAdd', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function addrecord()
	{		
		echo "hiii";
		print_r($_POST);
		$this->form_validation->set_rules('course_name', 'Courses Title', 'required');	
		$this->form_validation->set_rules('course_location', 'Courses Location', 'required');	
		//$this->form_validation->set_rules('course_category', 'Courses Location', 'required');	
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');	
		$this->form_validation->set_rules('end_date', 'End Date', 'required');	
		$this->form_validation->set_rules('course_price', 'Courses Price', 'required');	
		$this->form_validation->set_rules('instructors', 'Instructors', 'required');	
		$this->form_validation->set_rules('designations', 'Designations', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{	
			$start_date = date("Y-m-d",strtotime($this->input->post('start_date')));
			$end_date = date("Y-m-d",strtotime($this->input->post('end_date')));
			$data = array('course_name' => $this->input->post('course_name'),
						  'course_location' => $this->input->post('course_location'),
						  'course_category' => $this->input->post('course_category'),
						  'course_location' => $this->input->post('course_location'),
						  'start_date' => $start_date,
						  'end_date' => $end_date,
						  'course_price' => $this->input->post('course_price'),
						  'instructors' => $this->input->post('instructors'),
						  'designations' => $this->input->post('designations'),
						  'status' => 'active',
							);   	
			
			$id = $this->coursesModel->save($data);
			$this->session->set_flashdata("message", "courses Added Successfully...");
			redirect('admin/courses/','refresh');	
		}
	}
	
	public function edit($cid)
	{			
		$this->load->model("coursesModel");
		$coursesitem = $this->coursesModel->get_by_id($cid)->row();
		$data["coursesitem"] = $coursesitem;
		
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit courses Item';
		$data['action'] = site_url('admin/courses/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/courses/coursesEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('cname', 'Enter courses Name', 'required');	
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
			$this->coursesModel->update($id,$data);
			$this->session->set_flashdata("message", "courses Updated Successfully...");
			redirect('admin/courses/','refresh');	
		}				
	}
	
	function deactive($cid)
	{
		$courses = array('status' => 'inactive');
		$this->coursesModel->deactive($cid,$courses);
	
		redirect('admin/courses/','refresh');
	}
	function active($cid)
	{
		$courses = array('status' => 'active');
		$this->coursesModel->active($cid,$courses);
		redirect('admin/courses/','refresh');
	}

	function delete($id)
	{
		$this->load->model("coursesModel");
		$this->coursesModel->delete($id);
		$this->session->set_flashdata("message", "courses Deleted Successfully...");
		redirect('admin/courses/','refresh');
	}
	
	function sort_order()
		{			
			// load data
			$this->load->model("coursesModel");
			$courses = $this->coursesModel->get_courses()->result();
			
			$i=0; 
			foreach($courses as $item) { 
				
				$arr = array('no' => $_POST["txt"][$i]);
				$this->coursesModel->update_courses($courses[$i]->cid,$arr);
				
			$i++; }
				
			$this->session->set_flashdata("message", "Banner Updated Successfully...");
			redirect('admin/courses/','refresh');
			
			
			
		}
	
	
}