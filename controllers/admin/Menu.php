<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

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
		$this->load->model("menuModel");	
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
		$this->load->model("menuModel");
		$menu = $this->menuModel->get_category()->result();
		$data["menu"] = $menu;
		$data['title'] = 'Add New Menu';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/menu/menu',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add()
	{
		$menu = $this->menuModel->get_category()->result();
		$data["menu"] = $menu;
		$data['title'] = 'Add New Menu';
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['action'] = site_url('admin/menu/addmenu');
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/menu/menuAdd', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function addrecord()
	{				
		$this->form_validation->set_rules('cname', 'Menu Title', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{	
			$data = array('cname' => $this->input->post('cname'),
						  'content' => ($this->input->post('content')),
						  'status' => 'active',
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')						  						     					     
							);   	
			
			$id = $this->menuModel->save($data);
			$this->session->set_flashdata("message", "Menu Added Successfully...");
			redirect('admin/menu/','refresh');	
		}
	}
	
	public function edit($cid)
	{			
		$this->load->model("menuModel");
		$menuitem = $this->menuModel->get_by_id($cid)->row();
		$data["menuitem"] = $menuitem;
		
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Menu Item';
		$data['action'] = site_url('admin/menu/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/menu/menuEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('cname', 'Enter Menu Name', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
				$data = array('cname' => $this->input->post('cname'),
						  'content' => ($this->input->post('content')),
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')						  						     					     
							);      
			
			$id = $this->input->post('cid');			
			$this->menuModel->update($id,$data);
			$this->session->set_flashdata("message", "Menu Updated Successfully...");
			redirect('admin/menu/','refresh');	
		}				
	}
	
	function deactive($cid)
	{
		$menu = array('status' => 'inactive');
		$this->menuModel->deactive($cid,$menu);
	
		redirect('admin/menu/','refresh');
	}
	function active($cid)
	{
		$menu = array('status' => 'active');
		$this->menuModel->active($cid,$menu);
		redirect('admin/menu/','refresh');
	}

	function delete($id)
	{
		$this->load->model("menuModel");
		$this->menuModel->delete($id);
		$this->session->set_flashdata("message", "Menu Deleted Successfully...");
		redirect('admin/menu/','refresh');
	}
	
	function sort_order()
		{			
			// load data
			$this->load->model("menuModel");
			$menu = $this->menuModel->get_category()->result();
			
			$i=0; 
			foreach($menu as $item) { 
				
				$arr = array('no' => $_POST["txt"][$i]);
				$this->menuModel->update_menu($menu[$i]->cid,$arr);
				
			$i++; }
				
			$this->session->set_flashdata("message", "Banner Updated Successfully...");
			redirect('admin/menu/','refresh');
			
			
			
		}
	
	
}