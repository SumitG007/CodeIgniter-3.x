<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	private $limit = 20;
	function __construct()
	{
		parent::__construct();	
	    if(!$this->session->userdata('logged_in'))
	    {			
	    	 redirect(base_url().'admin/login', 'refresh');
 	    }			
		
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
	}
	
	public function add()
	{
		$data['title'] = 'Test File';
		$data['error'] = "";
		$data['action'] = "Add Record";
	 	$this->load->view('admin/header',$data);
		$this->load->view('admin/test/test',$data);
		$this->load->view('admin/footer');
	}
	public function addrecord()
	{
		$this->form_validation->set_rules('title', 'title', 'required');		
		$this->form_validation->set_rules('subtitle', 'subtitle Titile', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{		
			$this->load->library('upload');				
			$file1 = "";
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config1['upload_path'] = "./images/test/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1;		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
				}
			}	
					
			$file2 = "";
			if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code2 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config2['upload_path'] = "./images/test/";
				$config2['allowed_types'] = '*';
				$config2['max_size']	= '100000';				
				$config2['file_name'] = $code2;		
				$this->upload->initialize($config2);		
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];
				}
			}	
			
			$file3 = "";
			if (!empty($_FILES['userfile3']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code3 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config3['upload_path'] = "./images/test/";
				$config3['allowed_types'] = '*';
				$config3['max_size']	= '100000';				
				$config3['file_name'] = $code3;		
				$this->upload->initialize($config3);		
				if (!$this->upload->do_upload('userfile3'))
				{	
					$error = $this->upload->display_errors();
					$this->add($error);
				}
				else
				{
					$val3 = array('upload_data' => $this->upload->data());				
					$file3 = $val3["upload_data"]["orig_name"];
				}
			}
			
			$data = array(   'title' => $this->input->post('title'),
							 'subtitle' => $this->input->post('subtitle'),
							 'Name1' => $file1,
							 'Name2' => $file2,
							 'Name3' => $file3,					     					     
							);   	
			print_r($data);
			exit;
				
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('admin/test/','refresh');	
		}
	}
	
	
}