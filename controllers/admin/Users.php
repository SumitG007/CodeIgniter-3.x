<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
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
				 redirect(base_url().'login', 'refresh');
		   }		
		$this->load->model("employeeModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->employeeModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Employees';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."users/index/";
		$config['total_rows'] = $this->employeeModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('users/all',$data);
		$this->load->view('footer');
	}
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Employees';
		$data['action'] = "Add Record";
		$data['roles'] = $this->employeeModel->get_user_role_list()->result();
		
	 	$this->load->view('header',$data);
		$this->load->view('users/add',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{
		$this->form_validation->set_rules('txtrole', 'Role', 'required');		
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');		
		$this->form_validation->set_rules('txtpassword', 'Password', 'required');			
		$this->form_validation->set_rules('txtfname', 'First Name', 'required');	
		$this->form_validation->set_rules('txtlname', 'Last Name', 'required');		
		$this->form_validation->set_rules('txtdob', 'Birth Date', 'required');		
		$this->form_validation->set_rules('txtjoiningdate', 'Joining Date', 'required');		
		$this->form_validation->set_rules('txtdesignation', 'designation', 'required');		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{				
			$this->load->library('upload');				
			$file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config1['upload_path'] = "./images/users/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1;		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					print_r($error);
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file2 = $val1["upload_data"]["orig_name"];
				}
			}
			
			$data = array(   'role' => $this->input->post('txtrole'),
							 'email' => $this->input->post('txtemail'),
							 'password' =>  md5($this->input->post('txtpassword')),						 
							 'first_name' => $this->input->post('txtfname'),
							 'last_name' => $this->input->post('txtlname'),
							 'dob' => $this->input->post('txtdob'),
							 'joining_date' => $this->input->post('txtjoiningdate'),
							 'img' => $file2,
							 'conf_date' => $this->input->post('txtconfdate'),
							 'pri_leave' => $this->input->post('txtprileave'),
							 'sick_leave' => $this->input->post('txtsickleave'),
							 'designation' => $this->input->post('txtdesignation')							     					     
							);   	
			
			$id = $this->employeeModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('users/','refresh');	
		}
	}
	
	public function delete($id)
	{
		$this->employeeModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('users/','refresh');
	}
	
	public function edit($id)
	{			
		$data["editdata"] = $this->employeeModel->get_by_id($id)->row();	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;				
		$data['title'] = 'Employees';
		$data['action'] = "Edit Record";
		$data['roles'] = $this->employeeModel->get_user_role_list()->result();
			
		$this->load->view('header',$data);
		$this->load->view('users/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtrole', 'Role', 'required');		
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');		
		$this->form_validation->set_rules('txtpassword', 'Password', 'required');			
		$this->form_validation->set_rules('txtfname', 'First Name', 'required');	
		$this->form_validation->set_rules('txtlname', 'Last Name', 'required');		
		$this->form_validation->set_rules('txtdob', 'Birth Date', 'required');		
		$this->form_validation->set_rules('txtjoiningdate', 'Joining Date', 'required');		
		$this->form_validation->set_rules('txtdesignation', 'designation', 'required');	
		
		if($this->input->post('txtpassword') == $this->input->post('txthiddenpassword')) {
			$pass = $this->input->post('txtpassword');
		}
		else { $pass = md5($this->input->post('txtpassword')); }
					
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$this->load->library('upload');	
			$file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./images/users/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1;		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file2 = $val1["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file2 = $this->input->post('userfile1old');
			}
				
				
				$data = array(   'role' => $this->input->post('txtrole'),
								 'email' => $this->input->post('txtemail'),
								 'password' => $pass,							 
								 'first_name' => $this->input->post('txtfname'),
								 'last_name' => $this->input->post('txtlname'),
								 'dob' => $this->input->post('txtdob'),
								 'joining_date' => $this->input->post('txtjoiningdate'),
								 'img' => $file2,
								 'conf_date' => $this->input->post('txtconfdate'),
								 'pri_leave' => $this->input->post('txtprileave'),
								 'sick_leave' => $this->input->post('txtsickleave'),
								 'designation' => $this->input->post('txtdesignation')									     					     
								);  	
			
			$id = $this->input->post('id');			
			$this->employeeModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('users/','refresh');	
		}				
	}
}