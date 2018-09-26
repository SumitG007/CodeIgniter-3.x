<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

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
		$this->load->model("emailModel");
		$this->load->model("membersModel");
		$this->load->model("siteModel");
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		$this->load->helper('ckeditor');
			$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'editor/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height
							
				'filebrowserBrowseUrl'      => base_url().'editor/ckeditor/filemanager/index.html',
                'filebrowserImageBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Flash' 
			), 
			
		);	
		
		
		$this->data['ckeditor1'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content1',
			'path'	=>	'editor/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height
							
				'filebrowserBrowseUrl'      => base_url().'editor/ckeditor/filemanager/index.html',
                'filebrowserImageBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Flash' 
			), 
			
		);
	}
	
	/*public function submitForm()
	{
	 	$formSubmit = $this->input->post('submitForm');
		if( $formSubmit == 'Delete' ) // delete button pressed
		{
				$checked_prodid = $this->input->post('delete'); //selected messages	 
				$status = $this->emailnotificationtemplatemodel->delete_checked($checked_prodid);
				if($status == 1)
				{	
					$this->session->set_flashdata('error', 'Membership Deleted Successfully. ');
					redirect('admin/controller_membership');
				}
				else
				{
					$this->session->set_flashdata('error', 'You can not delete this membership');
					redirect('admin/controller_membership');
				}
		}
		else
		{
				for($i=1;$i<=$_POST['tot_cat'];$i++)
				{
					 if(isset($_POST["chk_$i"]))
					 {	
						 $chk = explode("_",$_POST["chk_$i"]);
						  $data = array(
							   'is_active' =>   1
							);
						 $ChngActive = $this->emailnotificationtemplatemodel->update_email_notification_template($chk[0],$data);
					 }						   
					 else
					 {
						   if(isset($_POST["cat_$i"]))
						   { 		 
								  $data = array(
									   'is_active' =>   0
									);
								 $ChngActive = $this->emailnotificationtemplatemodel->update_email_notification_template($_POST["cat_$i"],$data);			 
						 
						   }
							
					 }
				}

				 if($ChngActive == TRUE){
                    $this->session->set_flashdata('error', 'Is Active Status  Updated');
					redirect('admin/controller_membership');
                  }else{
                    $this->session->set_flashdata('error', 'not_updated');
                  }
				
				redirect('admin/controller_membership');
		}
	}*/
	
	public function index()
	{ 	   
		$this->load->model("emailModel");
		$emails = $this->emailModel->get_emails()->result();
		$data["emails"] = $emails;
		//$data['title'] = 'Add New Event';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/email/email_list',$data);
		$this->load->view('admin/footer');		
		
	}

	public function edit($id){
		
		//$id = $this->uri->segment(4);
        $edit_result['ArrEmailTemplate'] = $this->emailModel->get_email_template_by_id($id);
		$edit_result["ckeditor"] = $this->data['ckeditor'];
		$edit_result["ckeditor1"] = $this->data['ckeditor1'];
	   	$this->load->view('admin/header');
		$this->load->view('admin/email/email_edit',$edit_result); 
		$this->load->view('admin/footer');
		
	}
	
	public function update_data()
	{	 

		$template_id = $_POST['template_id'];      
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('template_name', 'template title', 'required');
           // $this->form_validation->set_rules('primary_template', 'primary template', 'required');
            $this->form_validation->set_rules('from_email', 'from email', 'required');
            $this->form_validation->set_rules('from_name', 'from name', 'required');

			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $ArrEmailTemplate_data = array(
                    'template_name' => $this->input->post('template_name'),
                    'from_email' => $this->input->post('from_email'),
                    'primary_template' => $this->input->post('primary_template'),
                    'from_name' => $this->input->post('from_name'),
                    'reply_email' => $this->input->post('reply_email'),
                    'admin_email_y_n' => $this->input->post('admin_email_y_n'),
                    'admin_email_type' => $this->input->post('admin_email_type'),
                    'admin_email' => $this->input->post('admin_email'),
                    'admin_email_subject' => $this->input->post('admin_email_subject'),
                    'admin_email_template' => $this->input->post('admin_email_template'),
                    'user_email_y_n' => $this->input->post('user_email_y_n'),
                    'user_email_type' => $this->input->post('user_email_type'),
                    'user_email_subject' => $this->input->post('user_email_subject'),
                    'user_email_template' => $this->input->post('user_email_template'),
					'active' => $this->input->post('active')
                );
                //if the insert has returned true then we show the flash message
				$this->load->model('admin/emailModel');
                if($this->emailModel->update_email_template($template_id,$ArrEmailTemplate_data) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/email/index');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            }//validation run
        }
	 }
	
	
	 
}