<?php

	class Posts extends CI_Controller
	{
		private $limit = 10;
		function __construct()
		{
			parent::__construct();
			$this->load->model("postModel");
			//$this->load->helper('ckeditor');
			$this->load->helper(array('form', 'url','ckeditor'));
			$this->load->library('form_validation');
			$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'editor/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"650px",	//Setting a custom width
				'height' 	=> 	'200px',	//Setting a custom height
							
				'filebrowserBrowseUrl'      => base_url().'editor/ckeditor/filemanager/index.html',
                'filebrowserImageBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'editor/ckeditor/filemanager/index.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'editor/ckeditor/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Flash' 
			), 			
                                        
			//Replacing styles from the "Styles tool"
			'styles' => array(
 
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 	=> 	'Blue',
						'font-weight' 	=> 	'bold'
					)
				)
			)
		);
 		
			if($this->session->userdata('logged_in'))
			   {
					 $session_data = $this->session->userdata('logged_in');
					 $data['email'] = $session_data['email'];
				}
	  	    else
			   {
					 redirect('admin/login', 'refresh');
			   }
		
		}
		
		function index($offset = 0)
		{	
			$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$uri_segment = 4;
			$offset = $this->uri->segment($uri_segment);
			
			// load data
			$this->load->model("postmodel");
			$home = $this->boardmodel->get_paged_list($this->limit, $offset)->result();
			$data["home"] = $home;
			$data['title'] = 'Add New Blog Post';
			$data['message'] = $this->session->flashdata('message');
			// generate pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('admin/posts/index/');
			$config['total_rows'] = $this->boardmodel->count_all();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
							
			$this->load->view('admin/header',$data);
		 	$this->load->view('admin/posts/home',$data);
			$this->load->view('admin/footer',$data);
        }
		
		function add()
		{
			// set common properties
			$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$data['title'] = 'Add New Blog Posts';
			$data["ckeditor"] = $this->data['ckeditor'];
			$data['action'] = site_url('admin/posts/addbanner');
			$data['error'] = "";
			
			// load view
			$this->load->view('admin/header',$data);
		 	$this->load->view('admin/posts/homeAdd', $data);
			$this->load->view('admin/footer');
			
		}
		
		function addbanner()
		{
			
			$this->form_validation->set_rules('content', 'content', 'required');
			$this->form_validation->set_rules('title', 'title', 'required');		
			//$this->form_validation->set_rules('subtitle', 'Banner Sub-Title', 'required');	
			if ($this->form_validation->run() == FALSE)
			{
				
				$this->add();
			}	
			else
			{
			
				if(isset($_FILES) && $_FILES["userfile"]["name"] !=""){
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$code = substr(str_shuffle($alpha_numeric), 0, 8);
				$config['upload_path'] = './images/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '10000';
				//$config['max_width']  = '1500';
				//$config['max_height']  = '550';
				$config['file_name']  = $code;
		
				$this->load->library('upload', $config);
				
					if ( ! $this->upload->do_upload())
					{	
						$data["error"] = $this->upload->display_errors();
						$data['title'] = 'Add New Blog Post';
						$data["ckeditor"] = $this->data['ckeditor'];
						$data['action'] = site_url('admin/posts/addbanner');
						$this->load->view('admin/header',$data);
						$this->load->view('admin/posts/homeAdd', $data);
						$this->load->view('admin/footer');
						
					} else {
					
					$val = array('upload_data' => $this->upload->data());
	
					// save data
					$home = array('title' => $this->input->post('title'),'content' => $this->input->post('content'),'status' => $this->input->post('status'),'image' => ($val["upload_data"]["orig_name"]));   
					$this->load->model("postModel");
					$id = $this->postModel->save($home);
					$this->session->set_flashdata("message", "Blog Added Successfully...");
					redirect('admin/posts/','refresh');
					}
				
				} else {					
					
					$home = array('title' => $this->input->post('title'),'content' => $this->input->post('content'),'status' => $this->input->post('status'),'img' => (""));
					//$id = $this->wordModel->save($word);
					$this->load->model("postModel");
					$id = $this->boardModel->save($home);
					$this->session->set_flashdata("message", "Blog Added Successfully...");
					redirect('admin/posts/','refresh');
				}
			
			}
		}
			
		function edit($hid)
		{	
			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			// load data
			$this->load->model("postModel");
			$home = $this->boardModel->get_by_id($hid)->row();
			
			$data["home"] = $home;
			
			$data["ckeditor"] = $this->data['ckeditor'];
			$data['title'] = 'Edit Blog Detail';
			$data['action'] = site_url('admin/posts/update/');
			$data['error'] = "";
			
		 	$this->load->view('admin/header',$data);
		 	$this->load->view('admin/posts/homeEdit',$data);
			$this->load->view('admin/footer');
			
        }
	
		function update()
		{				
			$this->form_validation->set_rules('content', 'content', 'required');
			$this->form_validation->set_rules('title', 'title', 'required');		
			//$this->form_validation->set_rules('subtitle', 'Banner Sub-Title', 'required');	
			if ($this->form_validation->run() == FALSE)
			{
				$this->edit($this->input->post('hid'));
			}	
			else
			{	
				
				if($_REQUEST["img"] == "" && isset($_FILES) && $_FILES["userfile"]["name"] !=""){ 
					$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
             		$code = substr(str_shuffle($alpha_numeric), 0, 8);
					$config['upload_path'] = './images/';
					$config['allowed_types'] = 'gif|jpg|png';
					//$config['max_size']	= '10000';
					//$config['max_width']  = '1500';
					//$config['max_height']  = '550';
					$config['file_name']  = $code;
					$this->load->library('upload', $config);
			
					if ( ! $this->upload->do_upload())
					{	
						$data["error"] = $this->upload->display_errors();
						$id = $this->input->post('hid');
						$this->load->model("postModel");
						$home = $this->postModel->get_by_id($id)->row();						
						$data["home"] = $home;
						$data['action'] = site_url('admin/posts/update/');
						$this->load->view('admin/header',$data);
						$this->load->view('admin/posts/homeEdit',$data);
						$this->load->view('admin/footer');
						
					} else {
						
						$val = array('upload_data' => $this->upload->data());
						// save data
						
						$id = $this->input->post('hid');
						$home = array('title' => $this->input->post('title'),'content' => $this->input->post('content'),'status' => $this->input->post('status'),'image' => ($val["upload_data"]["orig_name"]));
						$this->postModel->update($id,$home);
					
						redirect('admin/posts/','refresh');
					}
					
				} else if($_REQUEST["img"] != "" && isset($_FILES) && $_FILES["userfile"]["name"] !=""){ 
					
					$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
             		$code = substr(str_shuffle($alpha_numeric), 0, 8);
					$config['upload_path'] = './images/';
					$config['allowed_types'] = 'gif|jpg|png';
					//$config['max_size']	= '10000';
					//$config['max_width']  = '1500';
					//$config['max_height']  = '550';
					//$config['file_name']  = $code;
					$this->load->library('upload', $config);
			
					if ( ! $this->upload->do_upload())
					{	
						$data["error"] = $this->upload->display_errors();
						$id = $this->input->post('hid');
						$this->load->model("postModel");
						$home = $this->postModel->get_by_id($id)->row();						
						$data["home"] = $home;
						$data['action'] = site_url('admin/posts/update/');
						$this->load->view('admin/header',$data);
						$this->load->view('admin/posts/homeEdit',$data);
						$this->load->view('admin/footer');
						
					} else { 
						
						$val = array('upload_data' => $this->upload->data());
						// save data
						
						$id = $this->input->post('hid');
						$home = array('title' => $this->input->post('title'),'content' => $this->input->post('content'),'status' => $this->input->post('status'),'image' => ($val["upload_data"]["orig_name"]));
						$this->postModel->update($id,$home);
					
						redirect('admin/posts/','refresh');
					}
					
				}  else { 
				
				// save data
				
				$id = $this->input->post('hid');
				$home = array('title' => $this->input->post('title'),'content' => $this->input->post('content'),'status' => $this->input->post('status'));
				$this->postModel->update($id,$home);
				$this->session->set_flashdata("message", "Blog Updated Successfully...");
				redirect('admin/posts/','refresh');
				
				}
				
			}
		}
	
		function delete($id)
		{
			// delete person
			$this->load->model("postModel");
			$this->boardModel->delete($id);
			
			// redirect to word list page
			$this->session->set_flashdata("message", "Banner Deleted Successfully...");
			redirect('admin/posts/','refresh');
		}
		
		function sort_order()
		{			
			// load data
			$this->load->model("postmodel");
			$home = $this->boardmodel->get_paged_list($this->limit, 0)->result();
			
			$i=0; 
			foreach($home as $item) { 
				
				$arr = array('no' => $_POST["txt"][$i]);
				$this->postmodel->update_banner($home[$i]->hid,$arr);
				
			$i++; }
				
			$this->session->set_flashdata("message", "Blog Updated Successfully...");
			redirect('admin/posts/','refresh');
			
			
			
		}
		
	}
?>