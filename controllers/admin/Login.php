<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   
	   $this->load->model('user','',TRUE);
	   
	 }
	
	 function index()
	 {
	   $this->load->view('admin/login_view');
	 }
	 
	 function forgotpass() {
	 
	   $this->load->view('admin/forgotpass');
	 
	 }
	 
	 function emailcheck(){
	 
	 	 $this->load->library('form_validation');

	     $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_email');
		 
		 if($this->form_validation->run() == FALSE)
	     {
		 	$this->forgotpass();
	     }
	     else
	     {
		 		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	            echo $code = substr(str_shuffle($alpha_numeric), 0, 4);
				$email = $this->input->post('email');
				$pass = array('password' => md5($code));
				$this->load->model("homeModel");
				$this->homeModel->updatepassword($email,$pass);
				
				/* Email code start here */
				 
				/* Email code end here */ 
				
				redirect('login/success', 'refresh');
	     }
		  		 
	 }
	 
	 function check_email($email)
 	 {
		$result = $this->user->forgotpassword($email);
	 
	    if($result) {		 
		 	return TRUE;
	   	}
	    else
	    {
		 	$this->form_validation->set_message('check_email', 'Email address not available, Please enter correct Email');
		 	return false;
	    }
 	 }
	 
	 function success()
 	 {
 		$this->load->view('admin/success');
	 }
}

?>