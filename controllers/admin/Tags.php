<?php

	class Tags extends CI_Controller
	{
		private $limit = 10;
		function __construct()
		{
			parent::__construct();
			$this->load->model("tagModel");
			//$this->load->helper('ckeditor');
			$this->load->library('form_validation');
			                                        
			//Replacing styles from the "Styles tool"
			
		
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
			$this->load->model("tagModel");
			$home = $this->tagModel->get_paged_list($this->limit, $offset)->result();
			$data["home"] = $home;
			$data['title'] = 'Add New Tag Tag';
			$data['message'] = $this->session->flashdata('message');
			// generate pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('admin/tags/index/');
			$config['total_rows'] = $this->tagModel->count_all();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
							
			$this->load->view('admin/header',$data);
		 	$this->load->view('admin/tags/home',$data);
			$this->load->view('admin/footer',$data);
        }
		
		function add()
		{
			// set common properties
			$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$data['title'] = 'Add New Tag tags';
			$data['action'] = site_url('admin/tags/addbanner');
			$data['error'] = "";
			
			// load view
			$this->load->view('admin/header',$data);
		 	$this->load->view('admin/tags/homeAdd', $data);
			$this->load->view('admin/footer');
			
		}
		
		function addbanner()
		{
			
			$this->form_validation->set_rules('title', 'title', 'required');		
			if ($this->form_validation->run() == FALSE)
			{
				
				$this->add();
			}	
			else
			{
			
				$home = array('title' => $this->input->post('title'),'slug' => url_title($this->input->post('title'),'-',true),'status' => $this->input->post('status'));
				$this->load->model("tagModel");
				$id = $this->tagModel->save($home);
				$this->session->set_flashdata("message", "Tags Added Successfully...");
				redirect('admin/tags/','refresh');
				
			
			}
		}
			
		function edit($hid)
		{	
			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			// load data
			$this->load->model("tagModel");
			$home = $this->tagModel->get_by_id($hid)->row();
			
			$data["home"] = $home;
			
			$data['title'] = 'Edit Tag Detail';
			$data['action'] = site_url('admin/tags/update/');
			$data['error'] = "";
			
		 	$this->load->view('admin/header',$data);
		 	$this->load->view('admin/tags/homeEdit',$data);
			$this->load->view('admin/footer');
			
        }
	
		function update()
		{				
			$this->form_validation->set_rules('title', 'title', 'required');		
			if ($this->form_validation->run() == FALSE)
			{
				$this->edit($this->input->post('hid'));
			}	
			else
			{	
				
				$id = $this->input->post('hid');
				$home = array('title' => $this->input->post('title'),'status' => $this->input->post('status'));
				$this->tagModel->update($id,$home);
				$this->session->set_flashdata("message", "Tag Updated Successfully...");
				redirect('admin/tags/','refresh');
				
			}
		}
	
		function delete($id)
		{
			// delete person
			$this->load->model("tagModel");
			$this->tagModel->delete($id);
			
			// redirect to word list page
			$this->session->set_flashdata("message", "Tag Deleted Successfully...");
			redirect('admin/tags/','refresh');
		}
			
	}
?>