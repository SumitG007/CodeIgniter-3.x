<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class News extends CI_Controller {

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
		$this->load->model("newsModel");	
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
	public function index()
	{ 	   
		// load data
		$this->load->model("newsModel");
		$news = $this->newsModel->get_news()->result();
		$data["news"] = $news;
		$data['title'] = 'Add New News';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/news/news',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add()
	{
		$news = $this->newsModel->get_news()->result();
		$data["news"] = $news;
		$data['title'] = 'Add New News';
		$data["ckeditor"] = $this->data['ckeditor'];
		//$data['action'] = site_url('admin/news/addmenu');
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/news/newsAdd', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function addrecord()
	{				
		$this->form_validation->set_rules('title', 'News Title', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{	
			$data = array('news_title' => $this->input->post('title'),
						  'news_desc' => ($this->input->post('content')),
						  'status' => 'active',
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')
							);   	
			
			$id = $this->newsModel->save($data);
			$this->session->set_flashdata("message", "News Added Successfully...");
			redirect('admin/news/','refresh');	
		}
	}
	
	public function edit($id)
	{			
		$this->load->model("newsModel");
		$news_item = $this->newsModel->get_by_id($id)->row();
		$data["newsitem"] = $news_item;
		
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Menu Item';
		$data['action'] = site_url('admin/news/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/news/newsEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('title', 'Enter News Title', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
				$data = array('news_title' => $this->input->post('title'),
						  'news_desc' => ($this->input->post('content')),
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')
							);      
			
			$id = $this->input->post('id');			
			$this->newsModel->update($id,$data);
			$this->session->set_flashdata("message", "News Updated Successfully...");
			redirect('admin/news/','refresh');	
		}				
	}
	
	function deactive($id)
	{
		$news = array('status' => 'inactive');
		$this->newsModel->deactive($id,$news);
	
		redirect('admin/news/','refresh');
	}
	function active($id)
	{
		$news = array('status' => 'active');
		$this->newsModel->active($id,$news);
		redirect('admin/news/','refresh');
	}

	function delete($id)
	{
		$this->load->model("newsModel");
		$this->newsModel->delete($id);
		$this->session->set_flashdata("message", "News Deleted Successfully...");
		redirect('admin/news/','refresh');
	}
	
	function sort_order()
		{			
			// load data
			$this->load->model("newsModel");
			$news = $this->newsModel->get_news()->result();
			
			$i=0; 
			foreach($news as $item) { 
				
				$arr = array('no' => $_POST["txt"][$i]);
				$this->newsModel->update_news($menu[$i]->cid,$arr);
				
			$i++; }
				
			$this->session->set_flashdata("message", "Banner Updated Successfully...");
			redirect('admin/news/','refresh');
			
			
			
		}
	
	
}