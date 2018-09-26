<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model("siteModel");
		$this->load->model("eventsModel");
		$this->load->model("newsModel");
		$this->load->model("homeBoxModel");
		$this->load->helper(array('form', 'url','ckeditor'));
		
	}
	
	public function index()
	{    
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
		 
		 /**/
		 /*if($this->session->userdata('logged_in_site'))
		 {
		 	$user = $this->session->userdata('logged_in_site');
		 	$this->eventsModel->events_left_seated1($user['mid']);
		 	$this->siteModel->clear_cart_data_1($user['mid']);
		 }*/
		 /**/
		 
		 $data["event"] = $this->siteModel->get_all_events();	
		 $data["news"] = $this->newsModel->get_news_data()->result();
		 $data["home_items"] = $this->homeBoxModel->get_home_content()->result();
		 $data["title"] = "BOMA Edmonton";
		 $data["keywords"] = "BOMA Edmonton";
		 $data["desc"] = "";
		 $data["breadcrum"] = ""; 
		 $data["class"] = "welcome"; 	 
		 
		 $this->load->model("homeModel");
		 $banner = $this->homeModel->get_homebanner()->result();

    	 $data["banner"] = $banner;
		 $this->eventsModel->delete_cuurentdate_event();
		 $this->load->view('header',$data);
		 $this->load->view('welcome_message',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function news_details($id){
		 
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();    	 
		
		 $news = $this->newsModel->get_by_id($id)->row();
		 $data["news"] = $news;		 
		 $news_item = $this->newsModel->get_by_id($id)->row();	 
		 
		 $breadcrum = '<li><a href='.base_url().'>Home</a></li><li class="active">'.$news_item->news_title.'</li>';
		 $data["breadcrum"] = $breadcrum;
		 
		 $data["title"] = 'News of BOMA';
		 $data["keywords"] = 'News of BOMA';
		 $data["desc"] = 'News of BOMA'; 
		 $data["class"] = 'News of BOMA'; 
		 $this->load->view('header',$data);
		 $this->load->view('news_details',$data);
		 $this->load->view('footer',$data);		
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */