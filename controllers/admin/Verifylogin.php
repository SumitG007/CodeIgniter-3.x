<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifylogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function index()
 {
   $this->load->library('form_validation');
   $this->load->helper('security');
	
   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     $this->load->view('admin/login_view');
   }
   else
   { 
     redirect(base_url().'admin/welcome', 'refresh');
   }

 }

 function check_database($password)
 {
   
   $email = $this->input->post('email');

   $result = $this->user->login($email, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
		 'role' => $row->role,
         'email' => $row->email,
		 'password' => $row->password,
		 'name' => $row->first_name." ".$row->last_name
       );
	   $this->session->sess_expiration = '28800';
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Please Enter Valid E-mail And Password.');
     return false;
   }
 }
}
?>