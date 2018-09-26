<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 error_reporting(0);
class jobs extends CI_Controller {
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

		$this->load->model("jobsModel");
		$this->load->model("membersModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'job_details',
			'path'	=>	'editor/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'200px',	//Setting a custom height
							
				'filebrowserBrowseUrl'      => base_url().'editor/ckeditor/filemanager/index.html',
                'filebrowserImageBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Flash' 
			), 
			);
	}
	
	public function index(){	
			
         echo "<h1>Page not found</h1>";exit;		
	}
	
	// Pending Jobs
	
	public function pending()
	{ 	   
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->jobsModel->get_paged_list_pending($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Pending Applications';
						
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."admin/jobs/pending/";
		$config['total_rows'] = $this->jobsModel->count_all_pending();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/pending_jobs',$data);
		$this->load->view('admin/footer');		
		
	}	
	
	public function pending_nonmembers()
	{ 	   
		$uri_segment = 4;
		$offset = $this->uri->segment(4);
		/*$member = $this->membersModel->get_by_id($offset)->row();
		$data["member"] = $member;
		print_r($data['member']);exit;*/
		// load data		
		$viewdata = $this->jobsModel->get_paged_list_pending_nonmembers($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Pending Applications';
						
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."admin/jobs/pending_nonmembers/";
		$config['total_rows'] = $this->jobsModel->count_all_pending_nonmembers();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/pending_jobs_nonmembers',$data);
		$this->load->view('admin/footer');		
		
	}	
	
	public function view_jobs($id)
	{			
		$this->load->model("jobsModel");
		$data["company"] = $this->jobsModel->get_by_id($id)->row();
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/view_jobs',$data);
		$this->load->view('admin/footer');			
		
	}
	
	function send_invoice1($id)
	{
		$val = array('status' => 'create_user');
		$this->jobsModel->send_invoice($id,$val);
		
		$jobs = $this->jobsModel->get_by_id($id)->row();
			//print_r($jobs);exit;	
			$job_name = $jobs->job_name;
			$user_email = $jobs->email;
			/*$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			
			$email_from = "customerservice@boma.ca";
			$examil_to = $user_email;		
			$data['email_to'] = $user_email;			
			$data['job_name'] = $job_name;	
			//$data['fees'] = $jobs->jobs_fees;
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton jobs Application');
			$this->email->message($this->load->view("admin/jobs/email_invoice",$data,true));
			$this->email->send();*/
			
			////////////////////////////////////////// SEND MAIL START ////////////////////////////////////////////////////
			$this->load->helper('mail_helper');
			$template_id = 7;
			$ArrTemplate = get_mail_template($template_id);
			$member = $this->membersModel->get_by_id($id)->row();
			//print_r($ArrTemplate );exit;
			$primary_template = $ArrTemplate['primary_template'];
			#Assign default value
			$ArrCustomer = array();

			if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
			{
				
				$arr_replace = array('##email##');
				$arr_replace_with = array($user_email);
				$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['user_email_subject'];
				
				#End
				sendMail($user_email,'Non Member',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			
			/* MAIL END */	
	
		redirect(base_url().'admin/jobs/pending/','refresh');
	}
	
	function active_non_memmber($id)
	{
		//$val = array('status' => 'create_user');
		//$this->jobsModel->active($id);
		
		$jobs = $this->jobsModel->get_by_id($id)->row();
		//print_r($jobs);exit;	
		$job_name = $jobs->job_name;
		$user_email = $jobs->email;
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		$email_from = "customerservice@boma.ca";
		$examil_to = $user_email;		
		$data['email_to'] = $user_email;			
		$data['job_name'] = $job_name;	
		//$data['fees'] = $jobs->jobs_fees;
		$this->email->from($email_from, "BOMA Edmonton");
		$this->email->to($examil_to); 
		$this->email->subject('BOMA Edmonton jobs Application');
		$this->email->message($this->load->view("admin/jobs/email_active",$data,true));
		$this->email->send();
			
			/* MAIL END */	
	
		redirect(base_url().'admin/jobs/approved_nonmembers/','refresh');
	}
	
	
	function del_jobs($id,$title)
	{
		$this->load->model("jobsModel");
		$this->jobsModel->delete($id);
		$this->session->set_flashdata("message", "Job Application Deleted Successfully...");
		if($title == 'pending'){
		redirect(base_url().'admin/jobs/pending/','refresh');
		} else if($title == 'pending_nonmembers') { 
		redirect(base_url().'admin/jobs/pending_nonmembers/','refresh');
		}
	}
	
	
	// Approved jobs
	
	public function approved()
	{ 	   
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->jobsModel->get_paged_list_approved($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Approved jobs';
						
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."admin/jobs/approved/";
		$config['total_rows'] = $this->jobsModel->count_all_approved();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/approved_jobs',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function approved_nonmembers()
	{ 	   
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->jobsModel->get_paged_list_approved_nonmembers($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Approved jobs';
						
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."admin/jobs/approved_nonmembers/";
		$config['total_rows'] = $this->jobsModel->count_all_approved_nonmembers();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/approved_nonmembers_jobs',$data);
		$this->load->view('admin/footer');		
		
	}
		
	function del_approved_jobs($id,$title)
	{
		$this->load->model("jobsModel");
		$this->jobsModel->delete($id);
		$this->session->set_flashdata("message", "Job Application Deleted Successfully...");
		if($title == 'approved'){
		redirect(base_url().'admin/jobs/approved/','refresh');
		} else if($title == 'approved_nonmembers') { 
		redirect(base_url().'admin/jobs/approved_nonmembers/','refresh');
		}
	}
	
	function disable($id)
	{
		$val = array('status' => 'inactive');
		$this->jobsModel->disable_jobs($id,$val);

		redirect(base_url().'admin/jobs/approved/','refresh');
	}
	
	function enable($id)
	{
		//echo $id;exit;
		//$user = $this->membersModel->create_user()->result();
		
		$jobs = $this->jobsModel->get_by_id($id)->row();
		//print_r($jobs);
		
		//print_r($jobs);exit;	
		$job_name = $jobs->job_name;
		$user_email = $jobs->email;
		/*$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		$email_from = "customerservice@boma.ca";
		$examil_to = $user_email;		
		$data['email_to'] = $user_email;			
		$data['name'] = $name;	
		//$data['fees'] = $jobs->jobs_fees;
		$this->email->from($email_from, "BOMA Edmonton");
		$this->email->to($examil_to); 
		$this->email->subject('BOMA Edmonton jobs Application');
		$this->email->message($this->load->view("admin/jobs/email_active",$data,true));
		$this->email->send();*/
		
		$this->load->helper('mail_helper');
		$template_id = 6;
		$ArrTemplate = get_mail_template($template_id);
		//$member = $this->membersModel->get_by_id($id)->row();
		$member1 = $this->membersModel->get_by_id($jobs->mid)->row();
		//print_r($member1);//exit;
		$name = $member1->company_representative;
		//print_r($ArrTemplate );exit;
		$primary_template = $ArrTemplate['primary_template'];
		#Assign default value
		$ArrCustomer = array();

		if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
		{
			
			$arr_replace = array('##name##');
			$arr_replace_with = array($name);
			$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
			$subject = $ArrTemplate['user_email_subject'];
			
			#End
			sendMail($user_email,$name,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
		}
		
			
		$val = array('status' => 'approved');
		$this->jobsModel->enable_jobs($id,$val);
	redirect(base_url().'admin/jobs/approved/','refresh');
		
	}
	
	function disable_nonmembers($id)
	{
		$val = array('status' => 'inactive');
		$this->jobsModel->disable_jobs($id,$val);

		redirect(base_url().'admin/jobs/approved_nonmembers/','refresh');
	}
	
	function enable_nonmembers($id)
	{
		$val = array('status' => 'approved');
		$this->jobsModel->enable_jobs($id,$val);

		redirect(base_url().'admin/jobs/approved_nonmembers/','refresh');
	}
	
	public function edit_member_approved_jobs($id)
	{			
		//echo $id;exit;
		$data["viewdata"] = $this->jobsModel->get_job_list_approved($id)->result();
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Jobs';
		//$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";	
		$data["ckeditor"] = $this->data['ckeditor'];
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/edit_approved_jobs',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function update_member_approved_jobs()
	{
		$this->form_validation->set_rules('job_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('job_details', 'Job Description', 'required');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		//$this->form_validation->set_rules('name', 'Contact Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$start_date_time = explode(" ", $this->input->post('start_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('end_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array(
			  'job_name' => $this->input->post('job_name'),
			  'job_details' => $this->input->post('job_details'),
			  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
			  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
			  'email' => $this->input->post('email'),
			  'company_name' => $this->input->post('company_name'),
			  'address' => $this->input->post('address'),
			  'name' => $this->input->post('name'),
			  'contact' => $this->input->post('contact'),
			  'job_details' => $this->input->post('job_details'),
			  'createdon' => date("Y-m-d"),
			);        
			
			$id = $this->input->post('id');			
			$this->jobsModel->update_approval_jobs($id,$data);
			$this->session->set_flashdata("message", "Jobs Updated Successfully...");
			redirect('admin/jobs/approved','refresh');	
		}				
	}
	
	public function edit_nonmember_approved_jobs($id)
	{			
		//echo $id;exit;
		$data["approved_data"] = $this->jobsModel->get_nonmember_job_list_approved($id)->result();
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Jobs';
		//$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";	
		$data["ckeditor"] = $this->data['ckeditor'];
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/edit_nonmember_approved_jobs',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function update_nonmember_approved_jobs()
	{
		$this->form_validation->set_rules('job_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('job_details', 'Job Description', 'required');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		//$this->form_validation->set_rules('name', 'Contact Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$start_date_time = explode(" ", $this->input->post('start_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('end_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array(
			  'job_name' => $this->input->post('job_name'),
			  'job_details' => $this->input->post('job_details'),
			  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
			  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
			  'email' => $this->input->post('email'),
			  'company_name' => $this->input->post('company_name'),
			  'address' => $this->input->post('address'),
			  'name' => $this->input->post('name'),
			  'contact' => $this->input->post('contact'),
			  'job_details' => $this->input->post('job_details'),
			  'createdon' => date("Y-m-d"),
			);               
			
			$id = $this->input->post('id');			
			$this->jobsModel->update_nonmember_approval_jobs($id,$data);
			$this->session->set_flashdata("message", "Jobs Updated Successfully...");
			redirect('admin/jobs/approved_nonmembers','refresh');	
		}				
	}
	
	public function edit_member_pending_jobs($id)
	{			
		//echo $id;exit;
		$data["pending_data"] = $this->jobsModel->get_member_job_list_pending($id)->result();
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Jobs';
		//$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";		
		$data["ckeditor"] = $this->data['ckeditor'];
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/edit_member_pending_jobs',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function update_member_pending_jobs()
	{
		$this->form_validation->set_rules('job_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('job_details', 'Job Description', 'required');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		//$this->form_validation->set_rules('name', 'Contact Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$start_date_time = explode(" ", $this->input->post('start_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('end_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array(
			  'job_name' => $this->input->post('job_name'),
			  'job_details' => $this->input->post('job_details'),
			  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
			  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
			  'email' => $this->input->post('email'),
              'company_name' => $this->input->post('company_name'),
			  'address' => $this->input->post('address'),
			  'name' => $this->input->post('name'),
			  'contact' => $this->input->post('contact'),
			  'job_details' => $this->input->post('job_details'),
			  'createdon' => date("Y-m-d"),
			);         
			
			$id = $this->input->post('id');			
			$this->jobsModel->update_member_pending_jobs($id,$data);
			$this->session->set_flashdata("message", "Jobs Updated Successfully...");
			redirect('admin/jobs/pending','refresh');	
		}				
	}
	
	public function edit_nonmember_pending_jobs($id)
	{			
		//echo $id;exit;
		$data["pending_data1"] = $this->jobsModel->get_nonmember_job_list_pending($id)->result();
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Jobs';
		//$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";	
		$data["ckeditor"] = $this->data['ckeditor'];
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/edit_nonmember_pending_jobs',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function update_nonmember_pending_jobs()
	{
		$this->form_validation->set_rules('job_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('job_details', 'Job Description', 'required');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		//$this->form_validation->set_rules('name', 'Contact Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$start_date_time = explode(" ", $this->input->post('start_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('end_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array(
			  'job_name' => $this->input->post('job_name'),
			  'job_details' => $this->input->post('job_details'),
			  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
			  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
			  'email' => $this->input->post('email'),
			  'company_name' => $this->input->post('company_name'),
			  'address' => $this->input->post('address'),
			  'name' => $this->input->post('name'),
			  'contact' => $this->input->post('contact'),
			  'job_details' => $this->input->post('job_details'),
			  'createdon' => date("Y-m-d"),
			);        
			
			$id = $this->input->post('id');			
			$this->jobsModel->update_nonmember_pending_jobs($id,$data);
			$this->session->set_flashdata("message", "Jobs Updated Successfully...");
			redirect('admin/jobs/pending_nonmembers','refresh');	
		}				
	}
	
	public function add_jobs()
	{			
		//echo $id;exit;
		//$data["pending_data1"] = $this->jobsModel->get_nonmember_job_list_pending($id)->result();
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Add Jobs';
		//$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";		
		$data["ckeditor"] = $this->data['ckeditor'];
		$this->load->view('admin/header');
		$this->load->view('admin/jobs/add_jobs',$data);
		$this->load->view('admin/footer');
		
		
		
	}
	
	public function add_jobs_record()
	{
		//print_r($_POST);//exit;
		$this->form_validation->set_rules('job_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');	
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('name', 'Contact Name', 'required');
		$this->form_validation->set_rules('contact', 'Contact', 'required');	
		$this->form_validation->set_rules('job_details', 'Job Description', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add_jobs();
		}	
		else
		{	
			//print_r($_POST);
			$start_date_time = explode(" ", $this->input->post('start_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('end_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array(
			  'job_name' => $this->input->post('job_name'),
			  'job_details' => $this->input->post('job_details'),
			  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
			  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
			  'email' => $this->input->post('email'),
			  'company_name' => $this->input->post('company_name'),
			  'address' => $this->input->post('address'),
			  'name' => $this->input->post('name'),
			  'contact' => $this->input->post('contact'),
			  'job_details' => $this->input->post('job_details'),
			  'postedby' => 'guest',
			  'createdon' => date("Y-m-d"),
			  'status' => 'pending'
			);        
			
			//$id = $this->input->post('id');			
			$this->jobsModel->insert_jobs($data);
			$this->session->set_flashdata("message", "Jobs Updated Successfully...");
			redirect('admin/jobs/pending_nonmembers','refresh');	
		}				
	}
}