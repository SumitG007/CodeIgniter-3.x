<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $limit = 20;
	function __construct()
	{
		parent::__construct();
			
			$this->load->model('user','',TRUE);
			$this->load->model('homeModel');
			$this->load->model('membersModel');
	}
	
	public function index()
	{ 
		if($this->session->userdata('logged_in'))
	   {
		 $session_data = $this->session->userdata('logged_in');
		 $data['email'] = $session_data['email'];
		 $data['session_data'] = $session_data;
		 
		 $uri_segment = 3;
		 $offset = $this->uri->segment($uri_segment);
		 $data['total_members'] = $this->homeModel->get_total_members();
		 $data['total_events'] = $this->homeModel->get_total_events();
		 $data['job_non_members'] = $this->homeModel->get_jobs_non_members();
		 $data['job_members'] = $this->homeModel->get_jobs_members();
		 $data['pending_members'] = $this->homeModel->get_pending_members()->result();
		 $data['pending_job_members'] = $this->homeModel->get_pending_job_members()->result();
		 $data['pending_job_nonmembers'] = $this->homeModel->get_pending_job_nonmembers()->result();
		 $this->load->view('admin/header',$data);
		 $this->load->view('admin/welcome_message',$data);
		 $this->load->view('admin/footer');
	   }
	   else
	   {
			 redirect('/admin/login', 'refresh');
	   }	
		
	}
	
	function logout()
	 {
	   $this->session->unset_userdata('logged_in');
	   redirect(base_url().'admin/login', 'refresh');
	 }
	 
	 function settings(){
		 
		 $this->load->helper(array('form', 'url'));
		 
		 $session_data = $this->session->userdata('logged_in');
		 $data['email'] = $session_data['email'];
		 $data['password'] = $session_data['password'];
		 
		 $data['title'] = 'Settings';
		 $data['action'] = site_url('welcome/check');
		 $this->load->view('admin/header',$data);
		 $this->load->view('admin/settings',$data);
		 $this->load->view('admin/footer'); 
	 }
	 
	 function check(){
	 
	 	 $this->load->library('form_validation');

	     $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_pass');
		 $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean');
		 
		 if($this->form_validation->run() == FALSE)
	     {
		 	$this->settings();
	     }
	     else
	     {		 	
				$session_data = $this->session->userdata('logged_in');
		        $id = $session_data['id'];
				$pass = array('password' => md5($this->input->post('newpassword')));
				$this->load->model("homeModel");
				$this->homeModel->updatepass($id,$pass);
				redirect('admin/welcome', 'refresh');
	     }
		  		 
	 }
	 
	 function check_pass($password)
 	 {
	 	$session_data = $this->session->userdata('logged_in');
		$username = $session_data['username'];
	    $result = $this->user->login($username, $password);
	 
	    if($result) {		 
		 	return TRUE;
	   	}
	    else
	    {
		 	$this->form_validation->set_message('check_pass', 'Invalid password, Please enter correct password');
		 	return false;
	    }
 	 }
	 	
	
}