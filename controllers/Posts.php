<?php

	class Posts extends CI_Controller
	{
		private $limit = 10;
		function __construct()
		{
			parent::__construct();
			$this->load->model("postModel");
			$this->load->model("tagModel");
			//$this->load->helper('ckeditor');
			$this->load->helper(array('form', 'url','ckeditor','text'));
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
 		
		}
		
		function index($offset = 0)
		{	
			$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// load data
			$this->load->model("postModel");
			$home = $this->postModel->get_paged_list($this->limit, $offset)->result();
			
			$featured_home = $this->postModel->get_paged_list(3)->result();

			$this->load->model("tagModel");
			$active_tags = $this->tagModel->find_active()->result();
			$data["tags"] = $active_tags;

			$active_date = $this->postModel->get_month_date()->result();
			$data["month_home"] = $active_date;

			$this->load->model("siteModel");
		 	$data["category"] = $this->siteModel->get_category()->result();
			$data["home"] = $home;
						

			$data["featured_home"] = $featured_home;
			$data['title'] = 'Blog';
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active"><a href='.base_url().'posts/>NEWSLETTER</a></li>';
			 $data["breadcrumb"] = $breadcrumb;

			$data["class"] = "posts";
			$data['message'] = $this->session->flashdata('message');
			// generate pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('posts/index/');
			$config['total_rows'] = $this->postModel->count_all();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
							
			$this->load->view('header',$data);
		 	$this->load->view('posts/index',$data);
		 	$this->load->view('posts/right_sidebar',$data);
			$this->load->view('footer',$data);
        }
        function tag($slug)
        {
        	$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// load data
			$this->load->model("postModel");
			$home = $this->postModel->get_tags_paged_list($slug,$this->limit, $offset)->result();
			
			$featured_home = $this->postModel->get_paged_list(3)->result();

			$this->load->model("tagModel");
			$active_tags = $this->tagModel->find_active()->result();
			$data["tags"] = $active_tags;

			$active_date = $this->postModel->get_month_date()->result();
			$data["month_home"] = $active_date;


			$this->load->model("siteModel");
		 	$data["category"] = $this->siteModel->get_category()->result();
			$data["home"] = $home;
			
			$data["featured_home"] = $featured_home;

			$data['title'] = 'Blog';
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active"><a href='.base_url().'posts>NEWSLETTER</a></li>';
			 $data["breadcrumb"] = $breadcrumb;
			$data["class"] = "posts";
			$data['message'] = $this->session->flashdata('message');
			// generate pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('posts/index/');
			$config['total_rows'] = $this->postModel->count_all();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
							
			$this->load->view('header',$data);
		 	$this->load->view('posts/index',$data);
		 	$this->load->view('posts/right_sidebar',$data);
			$this->load->view('footer',$data);

        }
        function date($date)
        {
        	$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$uri_segment = 4;
			$offset = $this->uri->segment($uri_segment);
			
			// load data
			$this->load->model("postModel");

			$home = $this->postModel->get_date_paged_list($date,$this->limit, $offset)->result();
			
			$featured_home = $this->postModel->get_paged_list(3)->result();

			$this->load->model("tagModel");
			$active_tags = $this->tagModel->find_active()->result();
			$data["tags"] = $active_tags;

			$this->load->model("siteModel");
		 	$data["category"] = $this->siteModel->get_category()->result();
			$data["home"] = $home;
			
			$data["featured_home"] = $featured_home;

			$active_date = $this->postModel->get_month_date()->result();
			$data["month_home"] = $active_date;


			$data['title'] = 'Blog';
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			$data["class"] = "posts";
			$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active"><a href='.base_url().'posts>NEWSLETTER</a></li>';
			 $data["breadcrumb"] = $breadcrumb;
			$data['message'] = $this->session->flashdata('message');
			// generate pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('posts/index/');
			$config['total_rows'] = $this->postModel->count_all();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
							
			$this->load->view('header',$data);
		 	$this->load->view('posts/index',$data);
		 	$this->load->view('posts/right_sidebar',$data);
			$this->load->view('footer',$data);

        }
        function view($slug)
		{
			$session_data = $this->session->userdata('logged_in');
			$this->load->model("siteModel");
		 	$data["category"] = $this->siteModel->get_category()->result();
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$data['title'] = 'Blog';
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			$data["class"] = "posts";
			$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active"><a href='.base_url().'posts>NEWSLETTER</a></li>';
			$data["breadcrumb"] = $breadcrumb;
			$data['message'] = $this->session->flashdata('message');
			$this->load->model("tagModel");
			$active_tags = $this->tagModel->find_active()->result();
			$data["tags"] = $active_tags;	
			

			$this->load->model("postModel");
			$home = $this->postModel->get_by_slug($slug)->result();
			
			$active_date = $this->postModel->get_month_date()->result();
			$data["month_home"] = $active_date;

			$comments = $this->postModel->get_comments($home[0]->id)->result();

			$featured_home = $this->postModel->get_paged_list(3)->result();
			$data["featured_home"] = $featured_home;
			$data["comments"] = $comments;
			$data["home"] = $home;

			$this->load->view('header',$data);
		 	$this->load->view('posts/view',$data);
		 	$this->load->view('posts/right_sidebar',$data);
			$this->load->view('footer',$data);	
		}       
		
		function add()
		{
			// set common properties
			$session_data = $this->session->userdata('logged_in');
		 	$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$data['title'] = 'Add New Blog Posts';
			$data["ckeditor"] = $this->data['ckeditor'];
			$data['action'] = site_url('posts/addbanner');
			$data['error'] = "";
			$this->load->model("tagModel");
			$tags= $this->tagModel->get_by_status('enable');
			$tag_data =array();
			if($tags->num_rows() >0)
			{
				foreach($tags->result_array() as $row)
				{
					$tag_data[$row['id']] = $row['title'];
				}
			}
			$data['tags'] = $tag_data;
			// load view
			$this->load->view('header',$data);
		 	$this->load->view('posts/add', $data);
			$this->load->view('footer');
			
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
			
				if(isset($_FILES) && $_FILES["userfile"]["name"] !="")
				{
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
						$data['action'] = site_url('posts/addbanner');
						$this->load->view('header',$data);
						$this->load->view('posts/add', $data);
						$this->load->view('footer');
						
					} else {
					
					$val = array('upload_data' => $this->upload->data());
	
					// save data
					$home = array('title' => $this->input->post('title'),'content' => $this->input->post('content'),'status' => $this->input->post('status'),'image' => $val["upload_data"]["orig_name"],'published_at' => date("Y-m-d"),'created_at' => date("Y-m-d H:i:s"),'modified_at' => date("Y-m-d H:i:s"));   
					$this->load->model("postModel");
					$id = $this->postModel->save($home);
					if($this->input->post('tags'))
					{
                		foreach($this->input->post('tags') as $key => $tag)
                		{
                    			$existTag = $this->tagModel->get_by_id($tag)->row_array();
			                    if(!empty($existTag))
			                    {
			                        $post_tag = array(
			                            'post_id' => $id,
			                            'tag_id' => $tag
			                        );
			                        $this->db->insert('tbl_posts_tags',$post_tag);
			                    }
			                    else
			                    {

			                        $newTag = array(
			                            'name' => $tag,
			                            'slug' => url_title($tag,'-',true),
			                            'status' => 'enable'
			                        );

			                        $this->db->insert('tags',$newTag);
			                        $tag_id = $this->db->insert_id();
			                        $post_tag = array(
			                            'post_id' => $id,
			                            'tag_id' => $tag_id
			                        );
			                        $this->db->insert('tbl_posts_tags',$post_tag);
			                    }
                		}
            		}
					$this->session->set_flashdata("message", "Blog Added Successfully...");
					redirect('posts/','refresh');
					}
				
				} else {					
					
					$home = array('title' => $this->input->post('title'),'slug' => url_title($this->input->post('title'),'-',true),'content' => $this->input->post('content'),'status' => $this->input->post('status'),'img' => (""),'published_at' => date("Y-m-d"),'created_at' => date("Y-m-d H:i:s"),'modified_at' => date("Y-m-d H:i:s"));
					//$id = $this->wordModel->save($word);
					$this->load->model("postModel");
					$id = $this->postModel->save($home);
					if($this->input->post('tags'))
					{
                		foreach($this->input->post('tags') as $key => $tag)
                		{
                    			$existTag = $this->tagModel->get_by_id($tag)->row_array();
			                    if(!empty($existTag))
			                    {
			                        $post_tag = array(
			                            'post_id' => $id,
			                            'tag_id' => $tag
			                        );
			                        $this->db->insert('tbl_posts_tags',$post_tag);
			                    }
			                    else
			                    {

			                        $newTag = array(
			                            'name' => $tag,
			                            'slug' => url_title($tag,'-',true),
			                            'status' => 'enable'
			                        );

			                        $this->db->insert('tags',$newTag);
			                        $tag_id = $this->db->insert_id();
			                        $post_tag = array(
			                            'post_id' => $id,
			                            'tag_id' => $tag_id
			                        );
			                        $this->db->insert('tbl_posts_tags',$post_tag);
			                    }
                		}
            		}
					$this->session->set_flashdata("message", "Blog Added Successfully...");
					redirect('posts/','refresh');
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
			$home = $this->postModel->get_by_id($hid)->row();
			
			$data["home"] = $home;
			
			$data["ckeditor"] = $this->data['ckeditor'];
			$data['title'] = 'Edit Blog Detail';
			$data['action'] = site_url('posts/update/');
			$data['error'] = "";

			$this->load->model("tagModel");

			$tags= $this->tagModel->get_by_status('enable');
			$tag_data =array();
			if($tags->num_rows() >0)
			{
				foreach($tags->result_array() as $row)
				{
					$tag_data[$row['id']] = $row['title'];
				}
			}
			$data['tags'] = $tag_data;


			$current_tag = 
			$this->db->select('tag_id')->where(array('post_id' => $hid))->get('tbl_posts_tags')->result_array();

			$tag_ids = array();
	        if(!empty($current_tag))
	        {
	            foreach($current_tag as $cur_tag){
	                $tag_ids[] = $cur_tag['tag_id'];
	            }
	        }

	        $data['tag_ids'] = $tag_ids;
	
			
		 	$this->load->view('header',$data);
		 	$this->load->view('posts/edit',$data);
			$this->load->view('footer');
			
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
				
				if($_REQUEST["img"] == "" && isset($_FILES) && $_FILES["userfile"]["name"] !="")
				{ 
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
						$data['action'] = site_url('posts/update/');
						$this->load->view('header',$data);
						$this->load->view('posts/edit',$data);
						$this->load->view('footer');
						
					} else {
						
						$val = array('upload_data' => $this->upload->data());
						// save data
						
						$id = $this->input->post('hid');
						$home = array('title' => $this->input->post('title'),'slug' => url_title($this->input->post('title'),'-',true),
							'content' => $this->input->post('content'),'status' => $this->input->post('status'),'image' => ($val["upload_data"]["orig_name"]),'modified_at' => date("Y-m-d H:i:s"));
						$this->postModel->update($id,$home);
						
						if($this->input->post('tags'))
						{
							$this->db->where('post_id',$this->input->post('hid'));
		                	$this->db->where_not_in('tag_id',$this->input->post('tags'));
		                	$this->db->delete('tbl_posts_tags');

		            		foreach($this->input->post('tags') as $key => $tag)
		            		{
		                			$existTag = $this->tagModel->get_by_id($tag)->row_array();
				                    if(!empty($existTag))
				                    {
				                    	if($this->db->where(array('post_id' => $this->input->post('hid'), 'tag_id' => $tag))->get('tbl_posts_tags',1)->num_rows() < 1)
				                    	{
					                        $post_tag = array
					                        (
					                            'post_id' => $this->input->post('hid'),
					                            'tag_id' => $tag
					                        );
					                        $this->db->insert('tbl_posts_tags',$post_tag);
				                    	}
				                    }
				                    else
				                    {

				                        $newTag = array(
				                            'name' => $tag,
				                            'slug' => url_title($tag,'-',true),
				                            'status' => 'enable'
				                        );

				                        $this->db->insert('tags',$newTag);
				                        $tag_id = $this->db->insert_id();
				                        $post_tag = array(
				                            'post_id' => $this->input->post('hid'),
				                            'tag_id' => $tag_id
				                        );
				                        $this->db->insert('tbl_posts_tags',$post_tag);
				                    }
		            		}
		        		}						

						redirect('posts/','refresh');
					}
					
				} 
				else if($_REQUEST["img"] != "" && isset($_FILES) && $_FILES["userfile"]["name"] !=""){ 
					
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
						$data['action'] = site_url('posts/update/');
						$this->load->view('header',$data);
						$this->load->view('posts/edit',$data);
						$this->load->view('footer');
						
					} else { 
						
						$val = array('upload_data' => $this->upload->data());
						// save data
						
						$id = $this->input->post('hid');
						$home = array('title' => $this->input->post('title'),'slug' => url_title($this->input->post('title'),'-',true),
							'content' => $this->input->post('content'),'status' => $this->input->post('status'),'image' => ($val["upload_data"]["orig_name"]),'modified_at' => date("Y-m-d H:i:s"));
						$this->postModel->update($id,$home);
						
						if($this->input->post('tags'))
						{
							$this->db->where('post_id',$this->input->post('hid'));
		                	$this->db->where_not_in('tag_id',$this->input->post('tags'));
		                	$this->db->delete('tbl_posts_tags');

		            		foreach($this->input->post('tags') as $key => $tag)
		            		{
		                			$existTag = $this->tagModel->get_by_id($tag)->row_array();
				                    if(!empty($existTag))
				                    {
				                    	if($this->db->where(array('post_id' => $this->input->post('hid'), 'tag_id' => $tag))->get('tbl_posts_tags',1)->num_rows() < 1)
				                    	{
					                        $post_tag = array
					                        (
					                            'post_id' => $this->input->post('hid'),
					                            'tag_id' => $tag
					                        );
					                        $this->db->insert('tbl_posts_tags',$post_tag);
				                    	}
				                    }
				                    else
				                    {

				                        $newTag = array(
				                            'name' => $tag,
				                            'slug' => url_title($tag,'-',true),
				                            'status' => 'enable'
				                        );

				                        $this->db->insert('tags',$newTag);
				                        $tag_id = $this->db->insert_id();
				                        $post_tag = array(
				                            'post_id' => $this->input->post('hid'),
				                            'tag_id' => $tag_id
				                        );
				                        $this->db->insert('tbl_posts_tags',$post_tag);
				                    }
		            		}
		        		}
						redirect('posts/','refresh');
					}
					
				}  
				else
				{ 
				
				// save data
				
				$id = $this->input->post('hid');
				$home = array('title' => $this->input->post('title'),'slug' => url_title($this->input->post('title'),'-',true), 
					'content' => $this->input->post('content'),'status' => $this->input->post('status'),'modified_at' => date("Y-m-d H:i:s"));
				$this->postModel->update($id,$home);
				if($this->input->post('tags'))
				{
					$this->db->where('post_id',$this->input->post('hid'));
                	$this->db->where_not_in('tag_id',$this->input->post('tags'));
                	$this->db->delete('tbl_posts_tags');

            		foreach($this->input->post('tags') as $key => $tag)
            		{
                			$existTag = $this->tagModel->get_by_id($tag)->row_array();
		                    if(!empty($existTag))
		                    {
		                    	if($this->db->where(array('post_id' => $this->input->post('hid'), 'tag_id' => $tag))->get('tbl_posts_tags',1)->num_rows() < 1)
		                    	{
			                        $post_tag = array
			                        (
			                            'post_id' => $this->input->post('hid'),
			                            'tag_id' => $tag
			                        );
			                        $this->db->insert('tbl_posts_tags',$post_tag);
		                    	}
		                    }
		                    else
		                    {

		                        $newTag = array(
		                            'name' => $tag,
		                            'slug' => url_title($tag,'-',true),
		                            'status' => 'enable'
		                        );

		                        $this->db->insert('tags',$newTag);
		                        $tag_id = $this->db->insert_id();
		                        $post_tag = array(
		                            'post_id' => $this->input->post('hid'),
		                            'tag_id' => $tag_id
		                        );
		                        $this->db->insert('tbl_posts_tags',$post_tag);
		                    }
            		}
        		}
				$this->session->set_flashdata("message", "Blog Updated Successfully...");
				redirect('posts/','refresh');
				}

				
				
			}
		}
	
		function delete($id)
		{
			// delete person
			$this->load->model("postModel");
			$this->postModel->delete($id);
			
			// redirect to word list page
			$this->session->set_flashdata("message", "Blog Deleted Successfully...");
			redirect('posts/','refresh');
		}
		function addcommment($hid)
		{
			$this->load->model("postModel");
			$slug = $this->input->post('slug');
			$data['post'] = $this->postModel->get_by_slug($slug)->result();

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');

			$this->form_validation->set_rules('content', 'Content', 'required');


			if($this->form_validation->run() === FALSE)
			{
				//$this->load->view('header');
				//$this->load->view('posts/index', $data);
				//$this->load->view('footer');
				redirect('posts/view/'.$slug);
			} 
			else 
			{
				$newComment = array(
		                            'name' => $this->input->post('name'),
		                            'email' => $this->input->post('email'),
		                            'content' =>$this->input->post('content'),
		                            'post_id' => $hid,
		                            'created_at' => date("Y-m-d H:i:s")
		                        );
				$this->postModel->create_comment($newComment);
				redirect('posts/view/'.$slug);
			}	
		}		
	}
?>