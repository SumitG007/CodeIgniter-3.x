<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	private $limit = 10;
	function __construct()
	{
		parent::__construct();		
		$this->load->model("siteModel");
		$this->load->model("membersModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');	
		
		$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'txtjob_details',
			'path'	=>	'editor/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'200px'/*,	//Setting a custom height
							
				'filebrowserBrowseUrl'      => base_url().'editor/ckeditor/filemanager/index.html',
                'filebrowserImageBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Flash'*/ 
			), 
			);
	}
	
	public function index(){	
			
         echo "<h1>Page not found</h1>";exit;
		
	}
	public function category($name,$id){
		 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();    	 
		 $data["name"] = $name;
		 		 		 
		 $menu = $this->siteModel->get_category_by_id($id)->row();
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li class="active">'.$menu->cname.'</li>';
		 $data["menu"] = $menu;  
		 $data["title"] = $menu->seotitle;
		 $data["keywords"] = $menu->keywords;
		 $data["desc"] = $menu->desc;	
		 $data["breadcrum"] = $breadcrum;	
		  
         $data["class"] = $menu->cname;
		 $this->load->view('header',$data);
		 $this->load->view('menu',$data);
		 $this->load->view('footer',$data);		
	}
	
	public function subcategory($cname,$name,$id){
		 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();    	 
		 $data["name"] = $name;		 
		 $data["id"] = $id;
		 $menu = $this->siteModel->get_subcategory_detail($id)->row();
		 $data["menu"] = $menu;		 
		 $category = $this->siteModel->get_category_by_id($menu->cid)->row();	 
		 
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'category/'.str_replace(" ","-",strtolower($category->cname)).'/'.$category->cid.'>'.$category->cname.'</a></li><li class="active">'.$menu->scname.'</li>';
		 $data["breadcrum"] = $breadcrum;
		 
		 $data["title"] = $menu->seotitle;
		 $data["keywords"] = $menu->keywords;
		 $data["desc"] = $menu->desc; 
		 $data["class"] = str_replace("-"," ",strtoupper($cname));
		 
		 if($menu->scid =='7')
		 {
			$this->load->model("boardModel");
			$home = $this->boardModel->get_by_status('director')->result();
			$data["director"] = $home;
			$home = $this->boardModel->get_by_status('staff')->result();
			$data["status"] = $home;
			
		 } 	 
		 $this->load->view('header',$data);
		 $this->load->view('submenu',$data);
		 $this->load->view('footer',$data);		
	}
		
	public function page($pname)
	{ 
		 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
    	 
		 $data["name"] = strtoupper($pname);
		 $page = $this->siteModel->get_page(str_replace("-"," ",$pname))->row();
 		 $data["page"] = $page;
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li class="active">'.$page->title.'</li>';
		
		 $data["title"] = $page->seotitle;
		 $data["keywords"] = $page->keywords;
		 $data["desc"] = $page->desc; 
		 $data["breadcrum"] = $breadcrum; 
		 $data["class"] = $pname; 
		 $this->load->view('header',$data);
		 $this->load->view('page',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function contactus($success="")
	{ 		 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();    	 
		 		 
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li class="active">Contact Us</li>';
		 $data["breadcrum"] = $breadcrum;
		 
		 $data["class"] = "contact"; 		 
		 $data["title"] = "Contact Us";
		 $data["keywords"] = "Contact Us";
		 $data["desc"] = "Contact Us";  
				 
		 $this->load->view('header',$data);
		 $this->load->view('contactus',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function success()
	{ 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();    	 
		 		 
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li class="active">Contact Us</li>';
		 $data["breadcrum"] = $breadcrum;
		  		 
		 $data["class"] = "contact"; 		 
		 $data["title"] = "Contact Us";
		 $data["keywords"] = "";
		 $data["desc"] = "";   
		 $this->load->view('header',$data);
		 $this->load->view('success');
		 $this->load->view('footer');	
	}
	
	public function jobs(){
		 
		$this->load->model("siteModel");
		$data["category"] = $this->siteModel->get_category()->result();    
		$this->load->model("jobsModel");
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->jobsModel->get_paged_list_approved_all($this->limit, $offset);
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Approved jobs';
		$this->jobsModel->delete_curentdate_jobs();		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."pages/jobs/";
		$config['total_rows'] = $this->jobsModel->count_all_approved_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();    	 
		 		 		 
		$breadcrum = '<li><a href='.base_url().'>Home</a></li><li class="active">Employment Listings</li>';
		
		$data["title"] = "Employment Listings - Boma";
		$data["keywords"] = "Employment Listings";
		$data["desc"] = "Boma - Employment Listings";	
		$data["breadcrum"] = $breadcrum;	
		
		$data["class"] = "jobs";
		$this->load->view('header',$data);
		$this->load->view('jobs',$data);
		$this->load->view('footer',$data);		
	}
	
	public function view_jobs($id)
	{ 
		 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
    	 $this->load->model("jobsModel");
		 
		 $jobs = $this->jobsModel->get_by_id($id)->row();
 		 $data["jobs"] = $jobs;
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'pages/jobs/>Employment Listings </a></li>';
		 
		 $data["title"] = "Employment Listings - Boma";
		 $data["keywords"] = "Employment Listings";
		 $data["desc"] = "Boma - Employment Listings";	
		 $data["breadcrum"] = $breadcrum;	
		  
         $data["class"] = "jobs";
		 $this->load->view('header',$data);
		 $this->load->view('jobsdetails',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function post_jobs()
	{ 		 
		$user = $this->session->userdata('logged_in_site');
		$data["category"] = $this->siteModel->get_category()->result();		 
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'jobs/>Jobs </a></li><li class="active">Post Paid Jobs</li>';
		$data["breadcrumb"] = $breadcrumb;
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['message'] = $this->session->flashdata('message');
		$data["class"] = "guest"; 		 
		$data["title"] = "Add New Job | BOMA Edmonton";
		$data["keywords"] = "Add New Job, BOMA Edmonton";
		$data["desc"] = "Add New Job - BOMA Edmonton";  
		 
		/*$admin_user = $this->membersModel->get_by_admin_id()->row();
		//$name = $admin_user->first_name;
		$user_email = $admin_user->email;
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		$email_from = "customerservice@boma.ca";
		$examil_to = $user_email;		
		$data['email_to'] = $user_email;			
		//$data['name'] = $name;	
		//$data['fees'] = $member->membership_fees;
		$this->email->from($email_from, "BOMA Edmonton");
		$this->email->to($examil_to); 
		$this->email->subject('BOMA Edmonton Job Post Application');
		$this->email->message($this->load->view("members/email_post_job",$data,true));
		$this->email->send();*/
				 
		 $this->load->view('header',$data);
		 $this->load->view('postjobs',$data);
		 $this->load->view('footer',$data);	
		 
	}
	
	public function save_post_jobs()
	{				
		$this->form_validation->set_rules('txtjob_name', 'Job Title', 'required');	
		$this->form_validation->set_rules('txtstart_date', 'Start Date', 'required');
		$this->form_validation->set_rules('txtend_date', 'End Date', 'required');	
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('name', 'Contact Name', 'required');
		$this->form_validation->set_rules('txtcontact', 'Contact', 'required');	
		$this->form_validation->set_rules('txtjob_details', 'Job Details', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->post_jobs();
		}	
		else
		{	
			$this->load->helper('mail_helper');
			$template_id = 4;
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
				$arr_replace = array('##contact_name##','##job_name##', '##start_date##', '##end_date##', '##email##',  '##company_name##','##address##','##contact_name##','##phone_number##');
				$arr_replace_with = array($this->input->post('name'), $this->input->post('txtjob_name'), $start_date_new, $end_date_new,$this->input->post('txtemail'), $this->input->post('company_name'), $this->input->post('address'),  $this->input->post('name'), $this->input->post('txtcontact'));
				$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['user_email_subject'];
				
				#End
				sendMail($this->input->post('txtemail'),' ',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			
			if(count($ArrTemplate)>0 && $ArrTemplate['admin_email_y_n']=='Y' && $ArrTemplate['admin_email_type']=='to') #Send mail to Administrator
			{
				$arr_replace = array('##admin_name##','##job_name##', '##start_date##', '##end_date##', '##email##',  '##company_name##','##address##','##contact_name##','##phone_number##');
				$arr_replace_with = array('Administrator', $this->input->post('txtjob_name'), $start_date_new, $end_date_new,$this->input->post('txtemail'), $this->input->post('company_name'), $this->input->post('address'),  $this->input->post('name'), $this->input->post('txtcontact'));
				
				$message = get_mail_body($ArrTemplate['admin_email_template'],$arr_replace, $arr_replace_with);
				$subject = $ArrTemplate['admin_email_subject'];
				
				
				
				sendMail($ArrTemplate['admin_email'],'Administrator',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
			}
			/////////////////////////////////////////// SEND MAIL END 
			
			//print_r($_POST);
			$start_date_time = explode(" ", $this->input->post('txtstart_date'));
			$start_date = explode("-", $start_date_time[0]);
			$end_date_time = explode(" ", $this->input->post('txtend_date'));
			$end_date = explode("-", $end_date_time[0]);
			
			$data = array('job_name' => ($this->input->post('txtjob_name')),
						  'start_date' => $start_date[2]."-".$start_date[1]."-".$start_date[0],
						  'end_date' => $end_date[2]."-".$end_date[1]."-".$end_date[0],
						  'email' => $this->input->post('txtemail'),
						  'company_name' => $this->input->post('company_name'),
						  'address' => $this->input->post('address'),
						  'name' => $this->input->post('name'),
						  'contact' => $this->input->post('txtcontact'),
						  'job_details' => $this->input->post('txtjob_details'),
						  'postedby' => 'guest',
						  'createdon' => date("Y-n-d"),
						  'status' => 'pending'
							);   	
			//print_r($data);
			$id = $this->membersModel->save_post_jobs($data);
			
			$this->session->set_flashdata("message", "Job Posted Successfully...!");
			redirect(base_url().'pages/post_jobs','refresh');	
		}
	}
	
	public function send()
	{ 
	  	  
		  $this->load->library('form_validation');
		  // field name, error message, validation rules
		  $this->form_validation->set_rules('txtname', 'Full Name', 'trim|required|min_length[2]');
		  $this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
		  $this->form_validation->set_rules('txtMessage', 'Message', 'trim|required|min_length[10]');
		 			  
			  if($this->form_validation->run() == FALSE)
			  {
			   $this->contactus($success="");
			  }
			  else
			  {
				  $this->load->library('email');
				    $config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
				  
				  $name = $this->input->post("txtname");
				  $email = $this->input->post("txtemail");
				  $txtphone = $this->input->post("txtphone");
				  $txtMessage = $this->input->post("txtMessage");
				  
				  $this->email->from($email, $name);
			$this->email->to('jmensink@bomaedm.ca'); 
			$html = "<p>Boma Team,<br>You have an inquiry. Please find the details below.</p>
			<table width='70%'>
					</tr>
					<tr>
					 <td valign='top'>
					  <label for='first_name'>Name : </label>
					 </td>
					 <td valign='top'>
					  $name
					 </td>
					</tr>					
					<tr>
					 <td valign='top'>
					  <label for='email'>Email Address : </label>
					 </td>
					 <td valign='top'>
					  $email
					 </td>
					</tr>
					<tr>
					 <td valign='top'>
					  <label for='Interest'>Phone : </label>
					 </td>
					 <td valign='top'>
					  $txtphone
					 </td>
					</tr>									
					<tr>
					 <td valign='top'>
					  <label for='Contact'>Message : </label>
					 </td>
					 <td valign='top'>
					 $txtMessage
					 </td>
					</tr>
					</table>";
								
			$this->email->subject('Boma - Inquiry from - '. $name);
			$this->email->message($html);	
			$this->email->send();
			$this->session->set_flashdata("message", "Form Submitted Successfully...");
			redirect('welcome', 'refresh');
			}

	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
