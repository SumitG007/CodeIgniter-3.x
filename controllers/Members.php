<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model("siteModel");
		$this->load->model("jobsModel");
		$this->load->model("membersModel");	
		$this->load->model("servicesModel");
		$this->load->model("basiclistModel");
		$this->load->helper(array('form', 'url', 'captcha'));
    	$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		//$this->load->library('curl'); 
		$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'txtjob_details',
			'path'	=>	'editor/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Basic", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'200px'/*,	//Setting a custom height
							
				'filebrowserBrowseUrl'      => base_url().'editor/ckeditor/filemanager/index.html',
                'filebrowserImageBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Flash' */
			), 
			);
	}
	
	
	
	

	public function basic_list() {
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		 
		 $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		   
		   $data["category"] = $this->siteModel->get_category()->result();		 
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		$data["breadcrumb"] = $breadcrumb;
		$data["class"] = "members"; 		 
		$data["title"] = "Company Representative - Dashboard | BOMA Edmonton";
		$data["keywords"] = "Company Representative, BOMA Edmonton";
		$data["desc"] = "Company Representative BOMA Edmonton"; 
	    
	    $this->data['posts'] = $this->basiclistModel->getPosts(); // calling Post model method getPosts()
	    $this->load->view('header',$data);
		$this->load->view('members/basic_list', $this->data); // load the view file , we are passing $data array to view file
		$this->load->view('footer',$data);
	  	
	   }
	}

	
	public function index(){	
		
	   if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $data["category"] = $this->siteModel->get_category()->result();	
		 //$data["memberslist"] = $this->membersModel->get_members_list()->result();
		 $data["jobslist"] = $this->membersModel->get_posted_jobs_list($user["mid"])->result();
		 //$data["services"] = $this->servicesmodel->get_services_list();
		 //print_r($data["services"]);exit;
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "members"; 		 
		 $data["title"] = "Company Representative - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "Company Representative, BOMA Edmonton";
		 $data["desc"] = "Company Representative BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/dashboard',$data);
		 $this->load->view('footer',$data);	
		 
	   }
		
	}
	
	public function add_member()
	{ 		 
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $data["category"] = $this->siteModel->get_category()->result();		 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "members"; 		 
		 $data["title"] = "Company Representative - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "Company Representative, BOMA Edmonton";
		 $data["desc"] = "Company Representative BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/addmember',$data);
		 $this->load->view('footer',$data);	
		 
	   }
	}
	
	public function login()
	{ 		 
		 if($this->session->userdata('logged_in_site'))
	   	 {
		 redirect(base_url().'members/index', 'refresh');
	   	 }
		 $data["category"] = $this->siteModel->get_category()->result();
		 		 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/registration>Membership </a></li><li class="active">Member Login</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "members"; 		 
		 $data["title"] = "Company Representative/Members Login";
		 $data["keywords"] = "Company Representative/Members Login";
		 $data["desc"] = "Company Representative/Members Login";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/login',$data);
		 $this->load->view('footer',$data);	
	}
	
	
	public function email_check($email){
		$email_count = $this->membersModel->check_email($email);
		if($email_count == 0){
			$this->form_validation->set_message('email_check', 'The %s field already available');
			return FALSE;
		}else{ 
			return TRUE;
		}		
	}
	
	public function username_check($username){
		$username_count = $this->membersModel->check_username($username);
		if ($username_count > 0){
			$this->form_validation->set_message('username_check', 'The %s field already available');
			return FALSE;
		}else{ return TRUE; }		
	}
	
	public function logindo(){
		   $this->form_validation->set_rules('txtusername1', 'Username', 'trim|required|valid_email|callback_email_check');
		   $this->form_validation->set_rules('txtpassword1', 'Password', 'trim|required|callback_check_user');		
		   if($this->form_validation->run() == FALSE){				
				 $this->login();
		   }else{		
		   		$this->session->set_flashdata("message", "Login successfully");	 
				
				redirect(base_url().'members/index','refresh');
		   }
	}
	
	public function check_email2(){
	      $email = trim($this->input->post('txtemail'));	 
		  		  
	      $result = $this->membersModel->forgot_pass($email);
		  if(isset($result) && $result > 0){
		  		     foreach($result as $row){					
					 $sess_array = array();
					 $sess_array = array(
					   'mid' => $row->id,
					   'company_name' => $row->company_name,
				       'company_representative' => $row->company_representative,
					   'company_email' => $row->company_email,
					   'membership_type' => $row->membership_type,
					   'createdon' => $row->createdon,
					   'member_username' => $row->member_username						
					 );									 			   
					 //$this->session->set_userdata('logged_in_site', $sess_array);	
					 					 					 	
				 }
				 $this->form_validation->set_message('check_email2', 'Mail Sent');
				 $this->forgot_password();
				 return true;
				 
				// return FALSE;
				 
		   } else {
			  
			  $this->form_validation->set_message('check_email2', 'Invalid Email');
			  return FALSE;
		   }
	 }
	
	
	/*public function forgot_password(){
		   $this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email|callback_check_email2');
		   if($this->form_validation->run() == FALSE){				
				 $this->forgot_pass1();
		   }else{
			    
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$member = $this->membersModel->get_member_data($_POST['txtemail'])->row();
				//print_r($member);exit;
				$email_from = "customerservice@boma.ca";
				$examil_to = $member->company_email;		
				$data['email_to'] = $examil_to;		 	
				$data['name'] = $member->company_representative;
				$data['email'] = $examil_to;
				$data['password'] = $member->member_password;
				//$data['fees'] = $member->membership_fees;
				$this->email->from($email_from, "BOMA Edmonton");
				$this->email->to($examil_to); 
				$this->email->subject('BOMA Edmonton Member Application');
				$this->email->message($this->load->view("members/email_forgot_password",$data,true));
				$this->email->send();
		
				//Ensure that a session exists (just in case)
				
		   		//$this->session->set_flashdata("message","Password mailed successfully");
				//$this->set_flashdata->add('Yay it works','valid');
				//$this->form_validation->set_message("message","Password mailed successfully");
				
				//var_dump($this->session->flashdata('message'));
				//$data['message'] = 'Password mailed successfully';
				redirect(base_url().'members/forgot_password','refresh');
				//$this->session->set_flashdata("message", "Password mailed successfully.");
				

		   }
	}*/
	
	public function forgot_password()
	{ 		 
		 /*if($this->session->userdata('logged_in_site'))
	   	 {
		 	redirect(base_url().'members/index');
	   	 }else{*/
		 $data["category"] = $this->siteModel->get_category()->result();
		 		 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/registration>Membership </a></li><li class="active">Member Login</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "members"; 		 
		 $data["title"] = "Company Representative/Members Login";
		 $data["keywords"] = "Company Representative/Members Login";
		 $data["desc"] = "Company Representative/Members Login";  
		 
		// if(isset($_POST['txtemail']) && $_POST['txtemail'] != '')
		// {
		   $this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
		   if($this->form_validation->run() != FALSE){				
				 
				$result = $this->membersModel->forgot_pass($_POST['txtemail']);
			    if( $result-> num_rows() == 1 )
				{
					/*$this->load->library('email');
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$member = $this->membersModel->get_member_data($_POST['txtemail'])->row();
					//print_r($member);exit;
					$email_from = "customerservice@boma.ca";
					$examil_to = $member->company_email;		
					$data['email_to'] = $examil_to;		 	
					$data['name'] = $member->company_representative;
					$data['email'] = $examil_to;
					$data['password'] = $member->member_password;
					//$data['fees'] = $member->membership_fees;
					$this->email->from($email_from, "BOMA Edmonton");
					$this->email->to($examil_to); 
					$this->email->subject('BOMA Edmonton Member Application');
					$this->email->message($this->load->view("members/email_forgot_password",$data,true));
					$this->email->send();*/
					
					////////////////////////////////////////// SEND MAIL START ////////////////////////////////////////////////////
				$this->load->helper('mail_helper');
				$template_id = 2;
				$ArrTemplate = get_mail_template($template_id);
				//print_r($ArrTemplate );exit;
				$primary_template = $ArrTemplate['primary_template'];
				$member = $this->membersModel->get_member_data($_POST['txtemail'])->row();
				//print_r($member);
				#Assign default value
				$ArrCustomer = array();
	
				if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
				{
					
					$arr_replace = array('##name##','##email##','##password##');
					$arr_replace_with = array($member->company_representative, $_POST['txtemail'],$member->member_password);
					$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
					$subject = $ArrTemplate['user_email_subject'];
					
					#End
					sendMail($_POST['txtemail'],$member->company_representative,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
				}
			
			
			/////////////////////////////////////////// SEND MAIL END 
			
					//Ensure that a session exists (just in case)
					
					//$this->session->set_flashdata("message","Password mailed successfully");
					//$this->set_flashdata->add('Yay it works','valid');
					$data['error'] = "Your request has been proccessed successfully. Please check your email.";
					
					//var_dump($this->session->flashdata('message'));
					//$data['message'] = 'Password mailed successfully';
					//redirect(base_url().'members/forgot_password','refresh');
					//$this->session->set_flashdata("message", "Password mailed successfully.");
				
		  
			   }else{
					$data['error'] = "Please enter valid email address and try again.";
			   }
		  // }
		 }
		 $this->load->view('header',$data);
		 $this->load->view('members/forgot_password',$data);
		 $this->load->view('footer',$data);
		//}
	}
	
	public function logout(){
		
		if($this->session->unset_userdata('logged_in_site'))
		{ $this->session->unset_userdata('logged_in_site'); }	
							
		$this->session->sess_destroy();		
		$this->session->set_flashdata("message", "logout successfully");
		redirect(base_url().'members/login','refresh');
	}
	
	public function check_user($password){
	      $email = trim($this->input->post('txtusername1'));	 
		  		  
	      $result = $this->membersModel->login($email, $password);
		  if($result){
		  		     foreach($result as $row){					
					 $sess_array = array();
					 $sess_array = array(
					   'mid' => $row->id,
					   'company_name' => $row->company_name,
				       'company_representative' => $row->company_representative,
					   'company_email' => $row->company_email,
					   'membership_type' => $row->membership_type,
					   'createdon' => $row->createdon,
					   'member_username' => $row->member_username						
					 );									 			   
					 $this->session->set_userdata('logged_in_site', $sess_array);	
					 					 					 	
				 }
				 
				 return TRUE;
				 
		   } else {
			  
			  $this->form_validation->set_message('check_user', 'Invalid Username or Password');
			  return FALSE;
		   }
	 }
	
	
		
	public function registration()
	{ 		 
		 if($this->session->userdata('logged_in_site'))
	   	 {
		 redirect(base_url().'members/index', 'refresh');
	   	 }
			 
		 $data["category"] = $this->siteModel->get_category()->result();
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/registration>Membership</a></li><li class="active">Online Member Registration</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data['message'] = $this->session->flashdata('message');
		 $data["class"] = "members"; 		 
		 $data["title"] = "BOMA Edmonton Membership Application";
		 $data["keywords"] = "BOMA Edmonton Membership Application";
		 $data["desc"] = "BOMA Edmonton Membership Application";  
		 $this->load->view('header',$data);
		 $this->load->view('members/registration',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function isEmailExist($email) {
		$this->load->library('form_validation');
		$this->load->model('user');
		$is_exist = $this->membersModel->isEmailExist($email);
	
		if ($is_exist) {
			$this->form_validation->set_message(
				'isEmailExist', 'Email address is already exist.'
			);    
			return false;
		} else {
			return true;
		}
	}
	
	public function isserviceSelect1($sid1) {
		$this->load->library('form_validation');
		$this->load->model('user');
		$is_exist = $this->membersModel->isserviceSelect1($sid1);
	
		if ($is_exist) {
			$this->form_validation->set_message(
				'isserviceSelect1', 'Service is already select please select another service.'
			);    
			return false;
		} else {
			return true;
		}
		/*if($first_field == $second_field && $first_field == $third_field)
		{
			$this->form_validation->set_message(
				'isserviceSelect1', 'Service is already select please select another service.'
			);
			return false;
		}else {
			return true;
		}*/
	}
	
	public function isserviceSelect2($first_field,$third_field) {

		if($first_field == $second_field || $first_field == $third_field)
		{
			$this->form_validation->set_message('isserviceSelect2', 'Service is already select please select another service.');
			return false;
		}else {
			return true;
		}
	}
	
	/*public function isserviceSelect3($sid3) {
		$this->load->library('form_validation');
		$this->load->model('user');
		$is_exist = $this->membersModel->isserviceSelect3($sid3);
	
		if ($is_exist) {
			$this->form_validation->set_message(
				'isserviceSelect3', 'Service is already select please select another service.'
			);    
			return false;
		} else {
			return true;
		}
	}*/
	
	
	public function save_member()
	{	
			
		//print_r($_POST); exit;
		 //if(!$this->session->userdata('logged_in_site'))
	   	 //{
		// redirect(base_url().'members/registration', 'refresh');
	   	// }else{
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');	
		$this->form_validation->set_rules('company_address', 'Address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');
		$this->form_validation->set_rules('province', 'Province', 'required');
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'required|min_length[4]|max_length[11]');
		$this->form_validation->set_rules('company_representative', 'Company Representative', 'required');	
		$this->form_validation->set_rules('company_telephone', 'Company Telephone', 'required');
		$this->form_validation->set_rules('company_email', 'Company Email', 'required|valid_email|is_unique[tbl_members.company_email]');
		$this->form_validation->set_rules('memType', 'Membership Type', 'required');
		$this->form_validation->set_rules('membership_fees', 'Membership Fee', 'required');
		$this->form_validation->set_rules('company_desc', 'Company Description', 'required');	
		$this->form_validation->set_rules('reference1', 'Reference', 'required');
		$this->form_validation->set_rules('reference1_company', 'Company Name ', 'required');	
		$this->form_validation->set_rules('reference1_contact', 'Contact Information', 'required');
		$this->form_validation->set_rules('reference2', 'Reference', 'required');
		$this->form_validation->set_rules('reference2_company', 'Company Name ', 'required');	
		$this->form_validation->set_rules('reference2_contact', 'Contact Information', 'required');
		$this->form_validation->set_rules('reference3', 'Reference', 'required');
		$this->form_validation->set_rules('reference3_company', 'Company Name ', 'required');	
		$this->form_validation->set_rules('reference3_contact', 'Contact Information', 'required');	
		$this->form_validation->set_rules('service1', 'Select service', 'required');
		/*$this->form_validation->set_rules('service2', 'Select service', 'required|is_natural_no_zero|callback_isserviceSelect2['.$this->input->post('service1'),$this->input->post('service3').']');
		$this->form_validation->set_rules('service3', 'Select service', 'required|callback_isserviceSelect3[tbl_members.service3]');*/
		//$this->form_validation->set_rules('comp_logo', 'Profile Image', 'required|callback_image_upload');
		$this->form_validation->set_rules('g-recaptcha-response','Captcha','required');
		
		//print_r($_POST); exit; 
		 // if($_FILES['comp_logo']['error'] == 0){
			 if(isset($_FILES) && $_FILES["comp_logo"]["name"] !=""){
				//upload and update the file
				$config['upload_path'] = 'images/company/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '3000';
				$config['max_width']  = '1000';
				$config['max_height']  = '3000';
				$config['file_name']  = $code;
				//$config['max_size']	= '100';// in KB
			
				$this->load->library('upload', $config);
			
				if ( ! $this->upload->do_upload('comp_logo'))
				{
					$this->session->set_flashdata('message', $this->upload->display_errors('', ''));
					//redirect('profile');
				}
				else
				{
					//Image Resizing
					
					$val = array('upload_data' => $this->upload->data());
					$image = $val["upload_data"]["orig_name"];
					
					//create thumbnail
					 
					$image_data = $this->upload->data(); //get image data
					$config['source_image'] = $image_data['full_path'];
					$config['new_image'] = 'images/company/thumbs/';
					$config['maintain_ratio'] = true;
					$config['width'] = 150;
					$config['height'] = 150;
			
					$this->load->library('image_lib', $config);
					//$this->image_lib->resize();
					
					if ( ! $this->image_lib->resize()){
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
			
					
					//redirect('profile');
				}
		  }
	
		if(isset($_POST['g-recaptcha-response']))
		$captcha=$_POST['g-recaptcha-response'];
		
		if(!empty($captcha))
		{
			$errMsg= '';
			$google_url="https://www.google.com/recaptcha/api/siteverify";
			$secret='6LdwNRYTAAAAAGjQ9HfFJK_vrK0-duC1fTp8xTPh';
			$ip=$_SERVER['REMOTE_ADDR'];
			$captchaurl=$google_url."?secret=".$secret."&response=".$captcha."&remoteip=".$ip;
			
			$curl_init = curl_init();
			curl_setopt($curl_init, CURLOPT_URL, $captchaurl);
			curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_init, CURLOPT_TIMEOUT, 10);
			$results = curl_exec($curl_init);
			curl_close($curl_init);
			
			$results= json_decode($results, true);
			if($results['success']){
				$errMsg="Valid reCAPTCHA code. You are human.";
			}else{
				$errMsg="Invalid reCAPTCHA code.";
			}
		}else{
			$errMsg="Please re-enter your reCAPTCHA.";
		}
		
        //$this->load->view('index_index',$data);
		
		if ($this->form_validation->run() == false)
		{
			$this->registration();
			//redirect(base_url().'members/registration', 'refresh');
		}	
		else
		{	
			if(isset($this->upload->file_name))
			{
				$data['image_name'] = $this->membersModel->insert_images($this->upload->data());
				$img = $data['image_name']['filename'];
			}else{
				$img = '';
			}
			$date = date("Y-m-d");
			$data = array('company_name' => $this->input->post('company_name'),
						  'company_address' => ($this->input->post('company_address')),
						  'city_name' => $this->input->post('city_name'),
						  'province' => $this->input->post('province'),
						  'postal_code' => $this->input->post('postal_code'),
						  'company_representative' => $this->input->post('company_representative'),
						  'professional_designations' => $this->input->post('professional_designations'),
						  'company_title' => $this->input->post('company_title'),
						  'company_telephone' => $this->input->post('company_telephone'),
						  'company_email' => $this->input->post('company_email'),
						  'company_website' => $this->input->post('company_website'),
						  /*'additional_members' => $this->input->post('additional_members'),*/
						  'sponsor_boma_member' => $this->input->post('sponsor_boma_member'),
						  'membership_type' => $this->input->post('memType'),
						  'membership_fees' => $this->input->post('membership_fees'),
						  'company_desc' => $this->input->post('company_desc'),
						  'reference1' => $this->input->post('reference1'),
						  'reference1_company' => $this->input->post('reference1_company'),
						  'reference1_contact' => $this->input->post('reference1_contact'),
						  'reference2' => $this->input->post('reference2'),
						  'reference2_company' => $this->input->post('reference2_company'),
						  'reference2_contact' => $this->input->post('reference2_contact'),
						  'reference3' => $this->input->post('reference3'),
						  'reference3_company' => $this->input->post('reference3_company'),
						  'reference3_contact' => $this->input->post('reference3_contact'),
						  'status' => 'create_user',
						  'createdon' => $date,
						  'service1' => $this->input->post('service1'),
						  'service2' => $this->input->post('service2'),
						  'service3' => $this->input->post('service3'),
						  'comp_logo' => $img,
						);
			//print_r($data);//exit;
			$id = $this->membersModel->save($data);
			$this->session->set_flashdata("message", "Application Form Submitted Successfully...!");
			
			
			
			$membership_fees = '';
			if($this->input->post('memType') == 'principal')
			{
				if($this->input->post('membership_fees') == 882.00)
				{
					$membership_fees = $this->input->post('membership_fees')."  -  0-150,000 sq ft";
				}elseif($this->input->post('membership_fees') == 1061.00){
					$membership_fees = $this->input->post('membership_fees')."  -  150,000-500,000 sq ft";
				}elseif($this->input->post('membership_fees') == 1475.00){
					$membership_fees = $this->input->post('membership_fees')."  -  500,000+ sq ft";
				}else{
					$membership_fees = $this->input->post('membership_fees')."  -  Principal Territorial";
				}
			}else{
				    $membership_fees = 	$this->input->post('membership_fees');
			}
			
			$service1 = $this->membersModel->list_service1($this->input->post('service1'));
			$service2 = $this->membersModel->list_service2($this->input->post('service2'));
			$service3 = $this->membersModel->list_service3($this->input->post('service3'));
			
			//print_r($service1);exit;
			//echo $membership_fees;exit;
			////////////////////////////////////////// SEND MAIL START ////////////////////////////////////////////////////
			$this->load->helper('mail_helper');
			$template_id = 1;
			$ArrTemplate = get_mail_template($template_id);
			//print_r($ArrTemplate );exit;
			$primary_template = $ArrTemplate['primary_template'];

			#Assign default value
			$ArrCustomer = array();

			# get & set CC & BCC emails details
			//$ArrCCEmail = get_ccbcc_emails('cc',$ArrTemplate,array('admin_email'=>$ArrTemplate['admin_email']),$ArrCustomer);
			//$ArrBCCEmail = get_ccbcc_emails('bcc',$ArrTemplate,array('admin_email'=>$ArrTemplate['admin_email']),$ArrCustomer);
			
			if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
			{
				//$link = base_url().'/controller_login/customer_activation/'.$insert_id.'/'.$customer_activation_code;
				$arr_replace = array('##customer_name##' );
				$arr_replace_with = array($this->input->post('company_representative'));
				$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['user_email_subject'];
				
				#End
				sendMail($this->input->post('company_email'),$this->input->post('company_representative'),$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			
						  
			
			if(count($ArrTemplate)>0 && $ArrTemplate['admin_email_y_n']=='Y' && $ArrTemplate['admin_email_type']=='to') #Send mail to Administrator
			{
				$arr_replace = array('##admin_name##', '##company_name##', '##company_representative##','##company_email##', '##company_website##','##phone_number##','##address##','##city##','##postal_code##','##province##','##designation##','##membership_type##','##fees##','##description##', '##sponsor_boma_member##','##reference1##','##reference1_company##','##reference1_contact##','##reference2##','##reference2_company##','##reference2_contact##','##reference3##','##reference3_company##', '##reference3_contact##','##service1##','##service2##','##service3##');
				$arr_replace_with = array('Administrator', $this->input->post('company_name'), $this->input->post('company_representative'),$this->input->post('company_email'),$this->input->post('company_website'),$this->input->post('company_telephone'),$this->input->post('company_address'), $this->input->post('city_name'), $this->input->post('postal_code'),  $this->input->post('province'), $this->input->post('professional_designations'), $this->input->post('memType'),  ""."$".$membership_fees,$this->input->post('company_desc'), $this->input->post('sponsor_boma_member'), $this->input->post('reference1'), $this->input->post('reference1_company'), $this->input->post('reference1_contact'), $this->input->post('reference2'), $this->input->post('reference2_company'), $this->input->post('reference2_contact'),  $this->input->post('reference3'), $this->input->post('reference3_company'), $this->input->post('reference3_contact'), $service1[0]['service_name'], $service2[0]['service_name'], $service3[0]['service_name']); 
				
				$message = get_mail_body($ArrTemplate['admin_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['admin_email_subject'];
				
				
				
				sendMail($ArrTemplate['admin_email'],'Administrator',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			/////////////////////////////////////////// SEND MAIL END 
		
			redirect(base_url().'members/registration','refresh');	
			
		 }
	}
	
	public function change_password()
	{
		 /*if(!$this->session->userdata('logged_in_site'))
	   	 {
		 redirect(base_url().'members/index', 'refresh');
	   	 }else{*/
			 
		 $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $data["member_data"] = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["category"] = $this->siteModel->get_category()->result();
		 		 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/registration>Membership</a></li><li class="active">Online Account Information</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data['message'] = $this->session->flashdata('message');
		 $data["class"] = "members"; 		 
		 $data["title"] = "BOMA Edmonton Membership Application";
		 $data["keywords"] = "BOMA Edmonton Membership Application";
		 $data["desc"] = "BOMA Edmonton Membership Application";  
		 
		 $this->form_validation->set_rules('member_password', 'Password', 'required|min_length[4]|max_length[8]');
		 if($this->form_validation->run() != FALSE){				
			$data = array('member_password' => $this->input->post('member_password'));
			$member_id = $this->input->post('id');
			$this->membersModel->update_member_data($member_id,$data);
			$this->session->set_flashdata("message", "Password Updated Successfully...!");
			redirect(base_url().'members/change_password','refresh');													   
		 }
		 $this->load->view('header',$data);
		 $this->load->view('members/change_password',$data);
		 $this->load->view('footer',$data);	
		 //}
	}
	
	public function edit_account_information()
	{ 		 
		  if(!$this->session->userdata('logged_in_site'))
	   	 {
		 redirect(base_url().'members/index', 'refresh');
	   	 }else{
			 
		 $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $data["member_data"] = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["category"] = $this->siteModel->get_category()->result();
		 		 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/registration>Membership</a></li><li class="active">Online Account Information</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data['message'] = $this->session->flashdata('message');
		 $data["class"] = "members"; 		 
		 $data["title"] = "BOMA Edmonton Membership Application";
		 $data["keywords"] = "BOMA Edmonton Membership Application";
		 $data["desc"] = "BOMA Edmonton Membership Application";  
		 $this->load->view('header',$data);
		 $this->load->view('members/account_information',$data);
		 $this->load->view('footer',$data);	
		 }
	}
	
	
	
	public function update_account_information()
	{				
		//print_r($_POST);exit;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');	
		$this->form_validation->set_rules('company_address', 'Address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');	
		$this->form_validation->set_rules('province', 'Province', 'required');
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'required|min_length[4]|max_length[11]');
		$this->form_validation->set_rules('company_representative', 'Company Representative', 'required');	
		$this->form_validation->set_rules('company_email', 'Company Email', 'required|valid_email');
		//$this->form_validation->set_rules('member_password', 'Password', 'required|min_length[12]|max_length[12]');
		/*$this->form_validation->set_rules('memType', 'Membership Type', 'required');*/
		$this->form_validation->set_rules('company_desc', 'Company Description', 'required');	
		$this->form_validation->set_rules('reference1', 'Reference', 'required');
		$this->form_validation->set_rules('reference1_company', 'Company Name ', 'required');	
		$this->form_validation->set_rules('reference1_contact', 'Contact Information', 'required');
		$this->form_validation->set_rules('reference2', 'Reference', 'required');
		$this->form_validation->set_rules('reference2_company', 'Company Name ', 'required');	
		$this->form_validation->set_rules('reference2_contact', 'Contact Information', 'required');
		$this->form_validation->set_rules('reference3', 'Reference', 'required');
		$this->form_validation->set_rules('reference3_company', 'Company Name ', 'required');	
		$this->form_validation->set_rules('reference3_contact', 'Contact Information', 'required');	
		$this->form_validation->set_rules('service1', 'Service1', 'required');
		$this->form_validation->set_rules('service2', 'Service2', 'required');
		$this->form_validation->set_rules('service3', 'Service3', 'required');
		
				  
		if (isset($_FILES['comp_logo']) && is_uploaded_file($_FILES['comp_logo']['tmp_name'])) // if file is selected
		{
				$config['upload_path'] = 'images/company/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				//$config['max_size']	= '100';// in KB
			
				$this->load->library('upload', $config);
			
				if ( ! $this->upload->do_upload('comp_logo'))
				{
					$this->session->set_flashdata('message', $this->upload->display_errors('', ''));
					//redirect('profile');
				}
				else
				{
					//Image Resizing
					$val = array('upload_data' => $this->upload->data());
					$image = $val["upload_data"]["orig_name"];
					
					//create thumbnail
					 
					$image_data = $this->upload->data(); //get image data
					$config['source_image'] = $image_data['full_path'];
					$config['new_image'] = 'images/company/thumbs/';
					$config['maintain_ratio'] = true;
					$config['width'] = 150;
					$config['height'] = 150;
			
					$this->load->library('image_lib', $config);
					//$this->image_lib->resize();
					
					if ( ! $this->image_lib->resize()){
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
			
					

					//redirect('profile');
				}
				$data['image_name'] = $this->membersModel->insert_images($this->upload->data());
		}
		else // new file is not uploaded
		{
				$data['image_name']['filename'] =  $this->input->post('prod_cur_img') ;
		}

		//print_r($_POST);exit;
		if ($this->form_validation->run() == false)
		{
			$this->edit_account_information();
		}	
		else
		{
			// echo "hii";//exit;
			//$data['image_name'] = $this->membersModel->insert_images($this->upload->data());
			$date = date("Y-m-d");
			$data = array('company_name' => $this->input->post('company_name'),
						  'company_address' => $this->input->post('company_address'),
						  'city_name' => $this->input->post('city_name'),
						  'province' => $this->input->post('province'),
						  'postal_code' => $this->input->post('postal_code'),
						  'company_representative' => $this->input->post('company_representative'),
						  'professional_designations' => $this->input->post('professional_designations'),
						  'company_title' => $this->input->post('company_title'),
						  'company_telephone' => $this->input->post('company_telephone'),
						  'company_email' => $this->input->post('company_email'),
						 /* 'member_password' => $this->input->post('member_password'),*/
						  'company_website' => $this->input->post('company_website'),
						  'additional_members' => $this->input->post('additional_members'),
						  'sponsor_boma_member' => $this->input->post('sponsor_boma_member'),
						  'service1' => $this->input->post('service1'),
						  'service2' => $this->input->post('service2'),
						  'service3' => $this->input->post('service3'),
						  'company_desc' => $this->input->post('company_desc'),
						  'reference1' => $this->input->post('reference1'),
						  'reference1_company' => $this->input->post('reference1_company'),
						  'reference1_contact' => $this->input->post('reference1_contact'),
						  'reference2' => $this->input->post('reference2'),
						  'reference2_company' => $this->input->post('reference2_company'),
						  'reference2_contact' => $this->input->post('reference2_contact'),
						  'reference3' => $this->input->post('reference3'),
						  'reference3_company' => $this->input->post('reference3_company'),
						  'reference3_contact' => $this->input->post('reference3_contact'),
						  'createdon' => $date,
						  'comp_logo' => $data['image_name']['filename'],
						);
			//print_r($data);exit;
			$member_id = $this->input->post('id');
			$this->membersModel->update_member_data($member_id,$data);
			$this->session->set_flashdata("message", "Account Information Updated Successfully...!");
			redirect(base_url().'members/edit_account_information','refresh');	
			
			/*$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			//$member = $this->membersModel->get_member_data($_POST['txtemail'])->row();
			//print_r($member);exit;
			$email_from = "customerservice@boma.ca";
			$examil_to = $this->input->post('company_email');		
			$data['email_to'] = $examil_to;			
			$data['name'] = $this->input->post('company_representative');
			$data['fees'] = $this->input->post('membership_fees');
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton Member Application');
			$this->email->message($this->load->view("members/email_new_user",$data,true));
			$this->email->send();*/
		
			
		}
	}
	
	public function recaptcha($str='')
	{
		$google_url="https://www.google.com/recaptcha/api/siteverify";
		//$secret='6LdKJBYTAAAAADH6Z71ygyZR3dpNjz0HDD1JiAgL';
		$secret='6LeRhykTAAAAAAGsIUCZv-tAD6JxWLjTpQvpD9gY';		
		$ip=$_SERVER['REMOTE_ADDR'];
		$url=$google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$res = curl_exec($curl);
		curl_close($curl);
		$res= json_decode($res, true);
		//reCaptcha success check
		if($res['success'])
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('recaptcha', 'The reCAPTCHA field is telling me that you are a robot. Shall we give it another try?');
			return FALSE;
		}
	}
  
	public function save_new_member()
	{				
		$this->form_validation->set_rules('txtname', 'Name', 'required');	
		$this->form_validation->set_rules('txtusername', 'Username', 'required');
		$this->form_validation->set_rules('txtpassword', 'Password', 'required');	
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txtaddress', 'Address', 'required');	
		$this->form_validation->set_rules('txtcity', 'City', 'required');	
		$this->form_validation->set_rules('txtpostal', 'Postal Code', 'required|min_length[5]|max_length[7]');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add_member();
		}	
		else
		{	
			$date = date("Y-m-d");
			$data = array('cid' => $this->input->post('cid'),
						  'fullname' => ($this->input->post('txtname')),
						  'username' => $this->input->post('txtusername'),
						  'password' => $this->input->post('txtpassword'),
						  'telephone' => $this->input->post('txttelephone'),
						  'email' => $this->input->post('txtemail'),
						  'address' => $this->input->post('txtaddress'),
						  'city' => $this->input->post('txtcity'),
						  'postalcode' => $this->input->post('txtpostal'),
						  'designations' => $this->input->post('txtdesignations'),
						  'createdon' => $date
							);   	
			
			$id = $this->membersModel->save_members($data);
			$this->session->set_flashdata("message", "Member Created Successfully...!");
			redirect(base_url().'members/index','refresh');	
		}
	}
	
	public function editmember($id)
	{		
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		$user = $this->session->userdata('logged_in_site'); 
		$member = $this->membersModel->get_by_id($user["mid"])->row();
		$data["member"] = $member;
		$company_member = $this->membersModel->get_by_comp_id($id)->row();
		$data["company_member"] = $company_member;
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data["category"] = $this->siteModel->get_category()->result();		 
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		$data["breadcrumb"] = $breadcrumb;
		
		$data["class"] = "members"; 		 
		$data["title"] = "Company Representative - Dashboard | BOMA Edmonton";
		$data["keywords"] = "Company Representative, BOMA Edmonton";
		$data["desc"] = "Company Representative BOMA Edmonton";  		
		$this->load->view('header',$data);
		$this->load->view('members/editmember',$data);
		$this->load->view('footer',$data);	
		 
	   }
	   	
	}
	public function updatemember()
	{
		$this->form_validation->set_rules('txtname', 'Name', 'required');	
		$this->form_validation->set_rules('txtusername', 'Username', 'required');
		$this->form_validation->set_rules('txtpassword', 'Password', 'required');	
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txtaddress', 'Address', 'required');	
		$this->form_validation->set_rules('txtcity', 'City', 'required');	
		$this->form_validation->set_rules('txtpostal', 'Postal Code', 'required|min_length[5]|max_length[7]|numeric');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editmember($this->input->post('id'));
		}	
		else
		{	
			//print_r($_POST);exit;
			$date = date("Y-m-d");
			$data = array('cid' => $this->input->post('cid'),
						  'fullname' => ($this->input->post('txtname')),
						  'username' => $this->input->post('txtusername'),
						  'password' => $this->input->post('txtpassword'),
						  'telephone' => $this->input->post('txttelephone'),
						  'email' => $this->input->post('txtemail'),
						  'address' => $this->input->post('txtaddress'),
						  'city' => $this->input->post('txtcity'),
						  'postalcode' => $this->input->post('txtpostal'),
						  'designations' => $this->input->post('txtdesignations'),
						  'createdon' => $date
						);  
			//print_r($data);exit;  	
			$id = $this->input->post('id');	
			$this->membersModel->update_members($id,$data);
			$this->session->set_flashdata("message", "Member Updated Successfully...!");
			redirect(base_url().'members/index','refresh');	
		}				
	}
	
	function deletemember($id)
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }else{
		$this->load->model("membersModel");
		$this->membersModel->delete_member($id);
		$this->session->set_flashdata("message", "events Deleted Successfully...");
		redirect(base_url().'members/index','refresh');
	   }
	}
	
	public function view_member($id)
	{		
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		$user = $this->session->userdata('logged_in_site'); 
		$member = $this->membersModel->get_by_id($user["mid"])->row();
		$data["member"] = $member;
		$company_member = $this->membersModel->get_by_comp_id($id)->row();
		$data["company_member"] = $company_member;
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data["category"] = $this->siteModel->get_category()->result();		 
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		$data["breadcrumb"] = $breadcrumb;
		
		$data["class"] = "members"; 		 
		$data["title"] = "Company Representative - Dashboard | BOMA Edmonton";
		$data["keywords"] = "Company Representative, BOMA Edmonton";
		$data["desc"] = "Company Representative BOMA Edmonton";  		
		$this->load->view('header',$data);
		$this->load->view('members/view_member',$data);
		$this->load->view('footer',$data);	
		 
	   }
	   	
	}
	
	public function view_jobs(){	
		
	   if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $this->membersModel->delete_cuurentdate_job();
		 $data["member"] = $member;
		 $data["category"] = $this->siteModel->get_category()->result();	
		 $data["jobslist"] = $this->membersModel->get_posted_jobs_list($user["mid"])->result();	 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "members"; 		 
		 $data["title"] = "View Posted Jobs - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "View Posted Jobs, BOMA Edmonton";
		 $data["desc"] = "View Posted Jobs - BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/viewjobs',$data);
		 $this->load->view('footer',$data);	
		 
	   }
		
	}
	
	public function post_jobs()
	{ 		 
		 if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $data["category"] = $this->siteModel->get_category()->result();		 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data["ckeditor"] = $this->data['ckeditor'];
		 $data["class"] = "members"; 		 
		 $data["title"] = "Add New Job - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "Add New Job, BOMA Edmonton";
		 $data["desc"] = "Add New Job - BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/postjobs',$data);
		 $this->load->view('footer',$data);	
		 
	   }
	}
	
	public function save_post_jobs()
	{				
		$this->form_validation->set_rules('txtjob_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('txtstart_date', 'Start Date', 'required');
		$this->form_validation->set_rules('txtend_date', 'End Date', 'required');	
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
		/*$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('name', 'Contact Name', 'required');*/
		$this->form_validation->set_rules('txtcontact', 'Contact', 'required');	
		$this->form_validation->set_rules('txtjob_details', 'Job Details', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->post_jobs();
		}	
		else
		{	
			//print_r($_POST);
			$user = $this->session->userdata('logged_in_site');
			$member = $this->membersModel->get_by_id($user["mid"])->row();
			$name = $member->company_representative;
			$admin_user = $this->membersModel->get_by_admin_id()->row();
			//print_r($admin_user);exit;
			//$name = $admin_user->first_name;
			$user_email = $admin_user->email;
			//$job = $this->jobsModel->get_by_job_id($user["mid"])->row();
			/*$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			
			$email_from = "customerservice@boma.ca";
			$examil_to = $user_email;		
			$data['email_to'] = $user_email;			
			$data['name'] = $name;	
			//$data['fees'] = $member->membership_fees;
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton Job Post Application');
			$this->email->message($this->load->view("members/email_post_job_member",$data,true));
			$this->email->send();*/
			
			////////////////////////////////////////// SEND MAIL START ////////////////////////////////////////////////////
			$this->load->helper('mail_helper');
			$template_id = 3;
			$ArrTemplate = get_mail_template($template_id);
			//print_r($ArrTem3plate );exit;
			$primary_template = $ArrTemplate['primary_template'];

			#Assign default value
			$ArrCustomer = array();

			# get & set CC & BCC emails details
			//$ArrCCEmail = get_ccbcc_emails('cc',$ArrTemplate,array('admin_email'=>$ArrTemplate['admin_email']),$ArrCustomer);
			//$ArrBCCEmail = get_ccbcc_emails('bcc',$ArrTemplate,array('admin_email'=>$ArrTemplate['admin_email']),$ArrCustomer);
			
			$start_date_time = explode(" ", $this->input->post('txtstart_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('txtend_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$start_date_new = $start_date[2]."-".$start_date[1]."-".$start_date[0];
			$end_date_new = $end_date[2]."-".$end_date[1]."-".$end_date[0];
			if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
			{
				//$link = base_url().'/controller_login/customer_activation/'.$insert_id.'/'.$customer_activation_code;
				$arr_replace = array('##name##','##job_name##', '##start_date##', '##end_date##', '##email##',  '##company_name##','##address##','##contact_name##','##phone_number##');
				$arr_replace_with = array($member->company_representative, $this->input->post('txtjob_name'), $start_date_new, $end_date_new,$this->input->post('txtemail'), $this->input->post('company_name'), $this->input->post('address'), $member->company_representative, $this->input->post('txtcontact'));
				$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['user_email_subject'];
				
				#End
				sendMail($member->company_email,$member->company_representative,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			
			if(count($ArrTemplate)>0 && $ArrTemplate['admin_email_y_n']=='Y' && $ArrTemplate['admin_email_type']=='to') #Send mail to Administrator
			{
				$arr_replace = array('##admin_name##','##job_name##', '##start_date##', '##end_date##', '##email##',  '##company_name##','##address##','##contact_name##','##phone_number##');
				$arr_replace_with = array('Administrator',$this->input->post('txtjob_name'), $start_date_new, $end_date_new,$this->input->post('txtemail'), $this->input->post('company_name'), $this->input->post('address'), $member->company_representative, $this->input->post('txtcontact'));
				
				$message = get_mail_body($ArrTemplate['admin_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['admin_email_subject'];
				
				
				
				sendMail($ArrTemplate['admin_email'],'Administrator',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			/////////////////////////////////////////// SEND MAIL END 
			
			
			$start_date_time = explode(" ", $this->input->post('txtstart_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('txtend_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array('mid' => $this->input->post('cid'),
						  'job_name' => ($this->input->post('txtjob_name')),
						  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
						  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
						  'email' => $this->input->post('txtemail'),
						  'company_name' => $this->input->post('company_name'),
						  'address' => $this->input->post('address'),
						  //'name' => $this->input->post('name'),
						  'contact' => $this->input->post('txtcontact'),
						  'job_details' => $this->input->post('txtjob_details'),
						  'postedby' => 'member',
						  'createdon' => date("Y-m-d"),
						  'status' => 'pending'
							);   	
			//print_r($data);exit;
			$id = $this->membersModel->save_post_jobs($data);
			$this->session->set_flashdata("message", "Job Posted Successfully...!");
			redirect(base_url().'members/view_jobs','refresh');	
		}
	}
	
	public function editpostjobs($id)
	{		
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		$user = $this->session->userdata('logged_in_site'); 
		$member = $this->membersModel->get_by_id($user["mid"])->row();
		$data["member"] = $member;
		$job = $this->membersModel->get_by_job_id($id)->row();
		$data["job"] = $job;
		//print_r($data["job"]);exit;
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data["category"] = $this->siteModel->get_category()->result();		 
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		$data["breadcrumb"] = $breadcrumb;
		
		$data["class"] = "members"; 		 
		$data["title"] = "Company Representative - Dashboard | BOMA Edmonton";
		$data["keywords"] = "Company Representative, BOMA Edmonton";
		$data["desc"] = "Company Representative BOMA Edmonton";  		
		$this->load->view('header',$data);
		$this->load->view('members/edit_postjobs',$data);
		$this->load->view('footer',$data);	
		 
	   }
	   	
	}
	public function updatepostjobs()
	{
		$this->form_validation->set_rules('txtjob_name', 'Job Name', 'required');	
		$this->form_validation->set_rules('txtstart_date', 'Start Date', 'required');
		$this->form_validation->set_rules('txtend_date', 'End Date', 'required');	
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txtcontact', 'Contact', 'required');	
		$this->form_validation->set_rules('txtjob_details', 'Description', 'required');	
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editpostjobs($this->input->post('id'));
		}	
		else
		{	
			//print_r($_POST);exit;
			$start_date = date("Y-m-d",strtotime($this->input->post('txtstart_date')));
			$end_date = date("Y-m-d",strtotime($this->input->post('txtend_date')));
			$data = array('mid' => $this->input->post('mid'),
						  'job_name' => ($this->input->post('txtjob_name')),
						  'start_date' => $start_date,
						  'end_date' => $end_date,
						  'email' => $this->input->post('txtemail'),
						  'contact' => $this->input->post('txtcontact'),
						  'job_details' => $this->input->post('txtjob_details'),
						  'postedby' => 'member',
						  'createdon' => date("Y-m-d"),
						  'status' => 'pending',
					);   	
		 	
			$id = $this->input->post('id');	
			$this->membersModel->update_jobs($id,$data);
			$this->session->set_flashdata("message", "Job Updated Successfully...!");
			redirect(base_url().'members/view_jobs','refresh');	
		}				
	}
	
	function delete_post_jobs($id)
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }else{
		$this->load->model("membersModel");
		$this->membersModel->delete_post_job($id);
		$this->session->set_flashdata("message", "events Deleted Successfully...");
		redirect(base_url().'members/view_jobs','refresh');
	   }
	}
	
	public function services()
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
	   	if ($this->input->post('submit') === 'Search')
        {
			echo "hello".$this->input->post('search');
		}
			 $user = $this->session->userdata('logged_in_site');
			 $member = $this->membersModel->get_by_id($user["mid"])->row();
			 $data["member"] = $member;
			 $data["category"] = $this->siteModel->get_category()->result();		 
			 $data["services"] = $this->membersModel->get_services_list();
			 $data["service1"] = $this->membersModel->get_service1();	
			 /*$data["service5"] = $this->membersModel->get_service5();
			 $data["service3"] = $this->membersModel->get_service3();
			 $data["service4"] = $this->membersModel->get_service4();*/	 
			 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Services </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
			 $data["breadcrumb"] = $breadcrumb;
			 
			 $data["class"] = "services"; 		 
			 $data["title"] = "services - Dashboard | BOMA Edmonton";
			 $data["keywords"] = "services, BOMA Edmonton";
			 $data["desc"] = "services - BOMA Edmonton";  
					 
			 $this->load->view('header',$data);
			 $this->load->view('members/services',$data);
			 $this->load->view('footer',$data);	
	   }	
		
	}
	public function search_services()
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $alpha = $this->uri->segment(3);
		 //echo $alpha();
		 $data["category"] = $this->siteModel->get_category()->result();	
		 $data["services"] = $this->membersModel->get_services_list();	 
		 $data["search_services"] = $this->membersModel->search_services($alpha);
		 //print_r($data["search_searvices"]);
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Services </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "services"; 		 
		 $data["title"] = "services - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "services, BOMA Edmonton";
		 $data["desc"] = "services - BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/services',$data);
		 $this->load->view('footer',$data);	
	   }
	}
	public function services_listing()
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 $data["member"] = $member;
		 $service_id = $this->uri->segment(3);
		 //echo $alpha();
		 $data["category"] = $this->siteModel->get_category()->result();	
		 $data["services"] = $this->membersModel->get_services_list();	 
		 $data["service_details"] = $this->membersModel->service_details($service_id);
		 //print_r($data["search_searvices"]);
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Services </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "services"; 		 
		 $data["title"] = "services - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "services, BOMA Edmonton";
		 $data["desc"] = "services - BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/services_details',$data);
		 $this->load->view('footer',$data);	
	   }
	}
	
	public function view_events(){	
		
	   if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else { 
	   
         $user = $this->session->userdata('logged_in_site');
		 $member = $this->membersModel->get_by_id($user["mid"])->row();
		 //$this->membersModel->delete_cuurentdate_job();
		 $data["member"] = $member;
		 $data["category"] = $this->siteModel->get_category()->result();	
		 $data["events_data"] = $this->membersModel->get_booking_event_list($user["mid"]);	 
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'members/>Membership </a></li><li class="active">Company Representative - '.$member->company_representative.'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 
		 $data["class"] = "members"; 		 
		 $data["title"] = "View Events - Dashboard | BOMA Edmonton";
		 $data["keywords"] = "View Events, BOMA Edmonton";
		 $data["desc"] = "View Events - BOMA Edmonton";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('members/view_events',$data);
		 $this->load->view('footer',$data);	
		 
	   }
		
	}
	
	
	
		
}