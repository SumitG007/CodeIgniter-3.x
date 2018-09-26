<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submenu extends CI_Controller {

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
		$this->load->model("submenuModel");
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
	public function index($cid)
	{ 	   
		// load data
		$this->load->model("submenuModel");
		$data["submenu"] = $this->submenuModel->get_subcategory($cid)->result();
		$data["menu"] = $this->menuModel->get_by_id($cid)->row();
		$data['title'] = 'Add New Submenu';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/submenu/submenu',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add($cid)
	{
		$data["menu"] = $this->menuModel->get_by_id($cid)->row();
		$data['title'] = 'Add New Submenu';
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['action'] = site_url('admin/menu/addsubmenu');
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/submenu/submenuAdd', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function addrecord()
	{				
		$this->form_validation->set_rules('scname', 'Submenu Title', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->add($this->input->post('cid'));
		}	
		else
		{	
			$data = array('cid' => $this->input->post('cid'),
						  'scname' => $this->input->post('scname'),
						  'content' => ($this->input->post('content')),
						  'status' => 'active',
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')						  						     					     
						);   	
			
			$id = $this->submenuModel->save($data);
			$cid = $this->input->post('cid');
			$this->session->set_flashdata("message", "Submenu Added Successfully...");
			redirect('admin/submenu/index/'.$cid,'refresh');	
		}
	}
	
	public function edit($scid)
	{			
		$this->load->model("submenuModel");
		$submenuitem = $this->submenuModel->get_by_id($scid)->row();
		$data["submenuitem"] = $submenuitem;
		$data["menu"] = $this->menuModel->get_by_id($submenuitem->cid)->row();
		$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit Submenu Item';
		$data['action'] = site_url('admin/submenu/updaterecord/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/submenu/submenuEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('scname', 'Enter Submenu Name', 'required');	
		$this->form_validation->set_rules('content', 'Add Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('scid'));
		}	
		else
		{	
				$data = array('scname' => $this->input->post('scname'),
						  'content' => ($this->input->post('content')),
						  'keywords' => $this->input->post('keywords'),
						  'desc' => $this->input->post('desc'),
						  'seotitle' => $this->input->post('seotitle')						  						     					     
						);     
			
			$id = $this->input->post('scid');	
			$cid = $this->input->post('cid');			
			$this->submenuModel->update($id,$data);
			$this->session->set_flashdata("message", "Submenu Updated Successfully...");
			redirect('admin/submenu/index/'.$cid,'refresh');	
		}				
	}
	
	function deactive($scid,$cid)
	{
		$submenu = array('status' => 'inactive');
		$this->submenuModel->deactive($scid,$submenu);
	
		redirect('admin/submenu/index/'.$cid,'refresh');
	}
	function active($scid,$cid)
	{
		$submenu = array('status' => 'active');
		$this->submenuModel->active($scid,$submenu);
		redirect('admin/submenu/index/'.$cid,'refresh');
	}

	function delete($id,$cid)
	{
		$this->load->model("submenuModel");
		$this->submenuModel->delete($id);
		$this->session->set_flashdata("message", "Submenu Deleted Successfully...");
		redirect('admin/submenu/index/'.$cid,'refresh');
	}
	
	function sort_order($cid)
	{			
		// load data
		$this->load->model("submenuModel");
		$menu = $this->submenuModel->get_subcategory($cid)->result();
		
		$i=0; 
		foreach($menu as $item) { 
			
			$arr = array('no' => $_POST["txt"][$i]);
			$this->submenuModel->update_submenu($menu[$i]->scid,$arr);
			
		$i++; }
			
		$this->session->set_flashdata("message", "Submenu Updated Successfully...");
		redirect('admin/submenu/index/'.$cid,'refresh');		
		
	}
	
}