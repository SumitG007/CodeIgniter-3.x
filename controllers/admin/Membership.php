<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership extends CI_Controller {
	private $limit = 50;
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

		$this->load->model("membersModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');	
	}
	
	public function index(){	
			
         echo "<h1>Page not found</h1>";exit;		
	}
	
	// Pending Members
	
	public function pending()
	{ 	   
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->membersModel->get_paged_list_pending($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Pending Applications';
						
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."admin/membership/pending/";
		$config['total_rows'] = $this->membersModel->count_all_pending();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/membership/pending_members',$data);
		$this->load->view('admin/footer');		
		
	}	
	
	public function view_member($id)
	{			
		$this->load->model("membersModel");
		$data["company"] = $this->membersModel->get_by_id($id)->row();
		$data["services"] = $this->membersModel->get_services_list();
		$this->load->view('admin/header');
		$this->load->view('admin/membership/view_members',$data);
		$this->load->view('admin/footer');			
		
	}
	
	public function edit_member($id)
	{			
		$this->load->model("membersModel");
		$data["company"] = $this->membersModel->get_by_id($id)->row();
		$data["services"] = $this->membersModel->get_services_list();		
		//print_r($data["company"]);
		$this->load->view('admin/header');
		$this->load->view('admin/membership/edit_members',$data);
		$this->load->view('admin/footer');	
		
		
	}
	
	function image_upload(){
		//$i = 1;
		if($_FILES['comp_logo']['size'] != 0){
			$upload_dir = 'images/company/';
			if (!is_dir($upload_dir)) {
				 mkdir($upload_dir);
			}	
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name']     = 'userimage_'.substr(md5(rand()),0,7);
			$config['overwrite']     = false;
			$config['max_size']	 = '1024';
	
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('comp_logo')){
				$this->form_validation->set_message('image_upload', $this->upload->display_errors());
				return false;
			}	
			else{
				$this->upload_data['file'] =  $this->upload->data();
				return true;
			}	
		}	
		else{
			$this->form_validation->set_message('image_upload', "No file selected");
			return false;
		}
		//$i++;
	}
	
	public function updaterecord()
	{				
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');	
		$this->form_validation->set_rules('company_address', 'Address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');	
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'required|min_length[5]|max_length[11]');
		$this->form_validation->set_rules('company_representative', 'Company Representative', 'required');	
		$this->form_validation->set_rules('company_email', 'Company Email', 'required|valid_email');
		$this->form_validation->set_rules('membership_type', 'Membership Type', 'required');
		$this->form_validation->set_rules('membership_fees', 'Membership Fees', 'required');
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
		$this->form_validation->set_rules('service1', 'Service1 ', 'required');
		$this->form_validation->set_rules('service2', 'Service2 ', 'required');
		$this->form_validation->set_rules('service2', 'Service3 ', 'required');
		//$this->form_validation->set_rules('comp_logo', 'Profile Image', 'callback_image_upload');
		
		if (isset($_FILES['comp_logo']) && is_uploaded_file($_FILES['comp_logo']['tmp_name'])) // if file is selected
		{
				/*$config['upload_path'] = 'images/company/';		// set the filter image types
				$config['allowed_types'] = 'gif|jpg|png'; 		//load the upload library
				$config['max_size']	 = '1024';
				$this->load->library('upload', $config);    
				$this->upload->initialize($config);			
				$this->upload->set_allowed_types('*');		
				$data['upload_data'] = '';
			
				//if not successful, set the error message
				if (!$this->upload->do_upload('comp_logo')) {
					$data = array('msg' => $this->upload->display_errors());
		
				} else { //else, set the success message
					$data = array('msg' => "Upload success!");		  
					$data['upload_data'] = $this->upload->data();	
				}*/
				
				
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
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit_member($this->input->post('id'));
		}	
		else
		{	
			$data = array('company_name' => $this->input->post('company_name'),
						  'company_address' => ($this->input->post('company_address')),
						  'city_name' => $this->input->post('city_name'),
						  'postal_code' => $this->input->post('postal_code'),
						  'company_representative' => $this->input->post('company_representative'),
						  'professional_designations' => $this->input->post('professional_designations'),
						  'company_title' => $this->input->post('company_title'),
						  'company_telephone' => $this->input->post('company_telephone'),
						  'company_email' => $this->input->post('company_email'),
						  'company_website' => $this->input->post('company_website'),
						  'additional_members' => $this->input->post('additional_members'),
						  'sponsor_boma_member' => $this->input->post('sponsor_boma_member'),
						  'membership_type' => $this->input->post('membership_type'),
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
						  'service1' => $this->input->post('service1'),
						  'service2' => $this->input->post('service2'),
						  'service3' => $this->input->post('service3'),
						  'comp_logo' => $data['image_name']['filename'],						  
							);   	
			$id = $this->input->post('id');
			$this->membersModel->update($id, $data);
			$this->session->set_flashdata("message", "Company Details Updated Successfully...!");
			redirect(base_url().'admin/membership/pending/','refresh');	
		}
	}
	
	function send_invoice($id)
	{
		$val = array('status' => 'create_user');
		$this->membersModel->send_invoice($id,$val);
		
		$member = $this->membersModel->get_by_id($id)->row();
				
			$name = $member->company_representative;
			$user_email = $member->company_email;
			$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			
			$email_from = "customerservice@boma.ca";
			$examil_to = $user_email;		
			$data['email_to'] = $user_email;			
			$data['name'] = $name;	
			$data['fees'] = $member->membership_fees;
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton Membership Application');
			$this->email->message($this->load->view("admin/membership/email_invoice",$data,true));
			$this->email->send();
	
		redirect(base_url().'admin/membership/pending/','refresh');
	}
	
	function create_user($id)
	{
		$alpha_numeric1 = '0123456789';
		$alpha_numeric2 = 'abcdefghijklmnopqrstuvwxyz123456789!?#$';
		//$alpha_numeric2 = 'abcdefghijklmnopqrstuvwxyz';
		$username = "BOMA".substr(str_shuffle($alpha_numeric1), 0, 6);
		$password = substr(str_shuffle($alpha_numeric2), 0, 4);
		$date = date("Y-m-d");
		$val = array('status' => 'approved', 'member_username' => $username, 'member_password' => $password, 'conf_date' => $date);
		$this->membersModel->create_user($id,$val);
				
			
				
			/*$name = $member->company_representative;
			$user_email = $member->company_email;
			$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			
			$email_from = "customerservice@boma.ca";
			$examil_to = $user_email;		
			$data['email_to'] = $user_email;			
			$data['name'] = $name;	
			$data['password'] = $password;
			$data['user_email'] = $user_email;
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton - Login Information');
			$this->email->message($this->load->view("admin/membership/email_members",$data,true));	
			$this->email->send();*/
			
			////////////////////////////////////////// SEND MAIL START ////////////////////////////////////////////////////
			$this->load->helper('mail_helper');
			$template_id = 5;
			$ArrTemplate = get_mail_template($template_id);
			$member = $this->membersModel->get_by_id($id)->row();
			//print_r($ArrTemplate );exit;
			$primary_template = $ArrTemplate['primary_template'];
			#Assign default value
			$ArrCustomer = array();

			if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
			{
				
				$arr_replace = array('##name##', '##fees##','##email##','##password##');
				$arr_replace_with = array($member->company_representative, $member->membership_fees, $member->company_email, $member->member_password);
				$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['user_email_subject'];
				
				#End
				sendMail($member->company_email,$member->company_representative,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			
			/* MAIL END */	
	
		redirect(base_url().'admin/membership/pending/','refresh');
	}
	
	function del_member($id)
	{
		$this->load->model("membersModel");
		$this->membersModel->delete($id);
		$this->session->set_flashdata("message", "Company Deleted Successfully...");
		redirect(base_url().'admin/membership/pending/','refresh');
	}
	
	
	// Approved Members
	
	public function approved($page_number=1)
	{ 	 
	
		$searchKeyword = '';
		$member_search = ''; 
		$searchString = '';
		
		#unset session variable
		if($this->uri->segment(3) == '')
		{
			unset($_SESSION['searchKeyword']);
			unset($_SESSION['member_search']); 
		}
		
		#get from post variable
		if($this->input->post('searchSubmit'))
		{
			if($this->input->post('search'))
			{
				$searchKeyword = $this->input->post('search');
				//echo $searchKeyword;exit;
				$_SESSION['searchKeyword'] = $searchKeyword;
			}
			if($this->input->post('member_search'))
			{
				$member_search = $this->input->post('member_search');
				$_SESSION['member_search'] = $member_search;
			}
			 
		}
		
		#get from session variable
		if(isset($_SESSION['searchKeyword']) && $_SESSION['searchKeyword']!='')
		{
			$searchKeyword = $_SESSION['searchKeyword'];
		}
		if(isset($_SESSION['member_search']) && $_SESSION['member_search']!='')
		{
			$member_search = $_SESSION['member_search'];
		}
		
		$searchKeyword = trim($searchKeyword);
		
		#build search string
		$searchString = ''; 
		#build search string
		 
		if($searchKeyword!='')
		{
			$searchString .= " (company_name LIKE '%".$searchKeyword."%'";
			$searchString .= " OR company_representative LIKE '%".$searchKeyword."%'";
			$searchString .= " OR company_email LIKE '%".$searchKeyword."%')";			 
		}
		
		if($member_search!='')
		{
			$searchString .= "OR company_name = '%".$member_search."%'";
			$searchString .= "AND company_representative = '%".$member_search."%'";
			$searchString .= "AND company_email = '%".$member_search."%'";
		}
		
		#pagenation
		$data['searchKeyword'] = $searchKeyword;
	    $data['member_search'] = $member_search;
		
		$uri_segment = 4;
		$page = $this->uri->segment($uri_segment);
		
		
						
		// generate pagination		
		//$this->load->helper('pagination_helper');
		$config= array();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."admin/membership/approved/";
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment'] = 4;
    	$config['display_pages'] = FALSE;
		$config['num_links'] = 50;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['per_page'] = 50;
		$limit = $config['per_page'];
    	$offset = $this->uri->segment(4);
		/*if(empty($page_number)) $page_number = 1;
  		$offset = ($page_number-1) * $config['per_page']; */
	
		$config['total_rows'] = $this->membersModel->count_all_approved($searchString);
		
		$this->pagination->initialize($config);
		//print_r($config);exit;
		$data['page_links'] = $this->pagination->create_links($page_number);
		$data["viewdata"] = $this->membersModel->get_paged_list_approved($config['per_page'], $offset, $searchString);
		$data['page_number'] = $page_number;
		//$data['page_links'] = $this->pagination->create_links();
		//$data['page_number'] = $page_number;
				
		// load data		
		
		$data['title'] = 'Approved Members';
		
		/*$config['total_rows'] = $this->membersModel->count_all_approved();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;*/
		
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/membership/approved_members',$data);
		$this->load->view('admin/footer');		
		
	}
	// Edit member change password'
	function change_passsword($id)
	{
		$alpha_numeric2 = 'abcdefghijklmnopqrstuvwxyz123456789!?#$';
		//$alpha_numeric2 = 'abcdefghijklmnopqrstuvwxyz';
		$password = substr(str_shuffle($alpha_numeric2), 0, 8);
		$val = array('member_password' => $password);
		$this->membersModel->change_pass($id,$val);
				
		$member = $this->membersModel->get_by_id($id)->row();
				
			$name = $member->company_representative;
			$user_email = $member->company_email;
			$username = $member->member_username;
			/*$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			
			$email_from = "customerservice@boma.ca";
			$examil_to = $user_email;		
			$data['email_to'] = $user_email;			
			$data['name'] = $name;	
			$data['email'] = $user_email;
			$data['password'] = $password;
			//$data['username'] = $username;
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton - Login Information');
			$this->email->message($this->load->view("admin/membership/email_change_pass_members",$data,true));	
			$this->email->send();*/
			
			$this->load->helper('mail_helper');
			$template_id = 10;
			$ArrTemplate = get_mail_template($template_id);
			$member = $this->membersModel->get_by_id($id)->row();
			//print_r($ArrTemplate );exit;
			$primary_template = $ArrTemplate['primary_template'];
			#Assign default value
			$ArrCustomer = array();
	
			if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
			{
				
				$arr_replace = array('##name##', '##email##', '##password##');
				$arr_replace_with = array($member->company_representative, $member->company_email, $member->member_password);
				$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['user_email_subject'];
				
				#End
				sendMail($member->company_email,$member->company_representative,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			
			/* MAIL END */	
	
		redirect(base_url().'admin/membership/approved/','refresh');
	}
	public function view_approved_member($id)
	{			
		$this->load->model("membersModel");
		$data["company"] = $this->membersModel->get_by_id($id)->row();
		$data["services"] = $this->membersModel->get_services_list();
		$this->load->view('admin/header');
		$this->load->view('admin/membership/view_approved_members',$data);
		$this->load->view('admin/footer');			
		
	}
	
	public function edit_approved_member($id)
	{			
		$this->load->model("membersModel");
		$data["company"] = $this->membersModel->get_by_id($id)->row();
		$data["services"] = $this->membersModel->get_services_list();
		$this->load->view('admin/header');
		$this->load->view('admin/membership/edit_approved_member',$data);
		$this->load->view('admin/footer');		
	}
	
	public function approved_updaterecord()
	{				
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');	
		$this->form_validation->set_rules('company_address', 'Address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');	
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'required|min_length[5]|max_length[11]');
		$this->form_validation->set_rules('company_representative', 'Company Representative', 'required');	
		$this->form_validation->set_rules('company_email', 'Company Email', 'required|valid_email');
		$this->form_validation->set_rules('membership_type', 'Membership Type', 'required');
		$this->form_validation->set_rules('membership_fees', 'Membership Fees', 'required');
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
		$this->form_validation->set_rules('service1', 'Service1 ', 'required');
		$this->form_validation->set_rules('service2', 'Service2 ', 'required');
		$this->form_validation->set_rules('service2', 'Service3 ', 'required');
		
		if (isset($_FILES['comp_logo']) && is_uploaded_file($_FILES['comp_logo']['tmp_name'])) // if file is selected
		{
				/*$config['upload_path'] = 'images/company/';		// set the filter image types
				$config['allowed_types'] = 'gif|jpg|png'; 		//load the upload library
				$config['max_size']	 = '1024';
				$this->load->library('upload', $config);    
				$this->upload->initialize($config);			
				$this->upload->set_allowed_types('*');		
				$data['upload_data'] = '';
			
				//if not successful, set the error message
				if (!$this->upload->do_upload('comp_logo')) {
					$data = array('msg' => $this->upload->display_errors());
		
				} else { //else, set the success message
					$data = array('msg' => "Upload success!");		  
					$data['upload_data'] = $this->upload->data();	
				}*/
				
				
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
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit_member($this->input->post('id'));
		}	
		else
		{	
			$data = array('company_name' => $this->input->post('company_name'),
						  'company_address' => ($this->input->post('company_address')),
						  'city_name' => $this->input->post('city_name'),
						  'postal_code' => $this->input->post('postal_code'),
						  'company_representative' => $this->input->post('company_representative'),
						  'professional_designations' => $this->input->post('professional_designations'),
						  'company_title' => $this->input->post('company_title'),
						  'company_telephone' => $this->input->post('company_telephone'),
						  'company_email' => $this->input->post('company_email'),
						  'company_website' => $this->input->post('company_website'),
						  'additional_members' => $this->input->post('additional_members'),
						  'sponsor_boma_member' => $this->input->post('sponsor_boma_member'),
						  'membership_type' => $this->input->post('membership_type'),
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
						  'service1' => $this->input->post('service1'),
						  'service2' => $this->input->post('service2'),
						  'service3' => $this->input->post('service3'),
						  'comp_logo' => $data['image_name']['filename'],
						  'company_status' => $this->input->post('company_status'),
							);   	
			//print_r($data);exit;
			
			$id = $this->input->post('id');
			$this->membersModel->update($id, $data);
			$this->session->set_flashdata("message", "Company Details Updated Successfully...!");
			redirect(base_url().'admin/membership/approved/','refresh');	
		}
	}
	
	function del_approved_member($id)
	{
		$this->load->model("membersModel");
		$member_jobs = $this->membersModel->member_job_details($id)->result();

		if(isset($member_jobs[0]->jid) && $member_jobs[0]->jid != '')
		{
			//echo '<script>alert("Please first delete your jobs")';
			$this->session->set_flashdata("message", "Please first delete your jobs...");
			redirect(base_url().'admin/membership/approved/','refresh');
		}else{
			$this->membersModel->delete($id);
			$this->session->set_flashdata("message", "Company Deleted Successfully...");
			redirect(base_url().'admin/membership/approved/','refresh');
		}
	}
	
	function disable($id)
	{
		$val = array('status' => 'inactive');
		$this->membersModel->disable_member($id,$val);

		redirect(base_url().'admin/membership/approved/','refresh');
	}
	
	function enable($id)
	{
		$val = array('status' => 'approved');
		$this->membersModel->enable_member($id,$val);

		redirect(base_url().'admin/membership/approved/','refresh');
	}
	
		public function sub_member()
	{			
		$this->load->model("membersModel");
		$data["company"] = $this->membersModel->get_paged_list_approved(1000, 0)->result();
		$this->load->view('admin/header');
		$this->load->view('admin/membership/sub_members',$data);
		$this->load->view('admin/footer');			
		
	}
	
	public function view_sub_members()
	{			
		if(isset($_POST["searchmember"]) && $_POST["searchmember"] != "" ) {
		$this->load->model("membersModel");
		$val = explode(" ~ ", $_POST["searchmember"]);
		$data["searchkey"] = $val[0];
		$data["submembers"] = $this->membersModel->get_submembers_list($val[1])->result();
		$data["company"] = $this->membersModel->get_paged_list_approved(1000, 0)->result();
		$this->load->view('admin/header');
		$this->load->view('admin/membership/view_sub_members',$data);
		$this->load->view('admin/footer');			
		
		} else {
			$this->sub_member(); 
		}
		
	}
	
}