<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Homebox extends CI_Controller {

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
		$this->load->model("homeBoxModel");	
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
		
	}
	/*public function index()
	{ 	   
		// load data
		$this->load->model("homeBoxModel");
		$news = $this->homeBoxModel->get_news()->result();
		$data["news"] = $news;
		$data['title'] = 'Add New News';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/news/news',$data);
		$this->load->view('admin/footer');		
		
	}*/
	

	
	public function edit($id)
	{			
		$this->load->model("homeboxModel");
		$homeitem = $this->homeboxModel->get_by_id($id)->row();
		$data["homeitem"] = $homeitem;
		
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Home Box Item';
		//$data['action'] = site_url('admin/news/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/homebox/homeboxEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('title', 'Enter Title', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
				$data = array('title' => $this->input->post('title'),
						  'content' => ($this->input->post('content')),
					
							);      
			
			$id = $this->input->post('id');			
			$this->homeBoxModel->update($id,$data);
			$this->session->set_flashdata("message", "Home Content Updated Successfully...");
			redirect('admin/homebox/edit/'.$this->input->post('id'),'refresh');	
		}				
	}
	
	
	
	
}