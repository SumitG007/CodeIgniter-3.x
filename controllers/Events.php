<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model("siteModel");
		$this->load->model("eventsModel");
		$this->load->model("membersModel");
		$this->load->helper(array('form', 'url','ckeditor'));
    	$this->load->library('form_validation');
		//$this->load->library('cart');	
	}
	public function index()
	{    
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
		 
		 
		  /**/
		 /*$user = $this->session->userdata('logged_in_site');
		 $this->eventsModel->events_left_seated1($user['mid']);
		 $this->siteModel->clear_cart_data_1($user['mid']);
		 */
		 /**/
		 
		 $data["event"] = $this->siteModel->get_all_events();		 
		 $data["title"] = "BOMA Edmonton";
		 $data["keywords"] = "BOMA Edmonton";
		 $data["desc"] = "";
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active"><a href='.base_url().'events/index/>Event Registrations </a></li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data["class"] = "events"; 	 
		 $this->load->model("homeModel");
		 $banner = $this->homeModel->get_homebanner()->result();
		// $this->eventsModel->delete_cuurentdate_event();
    	 $data["banner"] = $banner;
		 $this->load->view('header',$data);
		 $this->load->view('events_registrations',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function event_details()
	{
		$this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
		 $id = $this->uri->segment(3);
		 $data["event_details"] = $this->siteModel->get_event_details($id)->result();
	
		 $data["event_name"] = $this->siteModel->get_event_name($id);
		 //print_r($data["event_name"]);exit;
		 $data["title"] = "BOMA Edmonton";
		 $data["keywords"] = "BOMA Edmonton";
		 $data["desc"] = "";
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">'.$data["event_name"].'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data["class"] = "events"; 	 
		 
		 $this->load->model("homeModel");
		 $banner = $this->homeModel->get_homebanner()->result();

    	 $data["banner"] = $banner;
		 $this->load->view('header',$data);
		 $this->load->view('events_detail',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function event_nonmember_register()
	{
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
		 
		 //print_r($data["event_detais"]);exit;
		 $data["title"] = "BOMA Edmonton";
		 $data["keywords"] = "BOMA Edmonton";
		 $data["desc"] = "";
		 $breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">Event nonmember</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data["class"] = "events"; 	 
		 
		 $this->load->model("homeModel");
		 $banner = $this->homeModel->get_homebanner()->result();

    	 $data["banner"] = $banner;
		 $this->load->view('header',$data);
		 $this->load->view('event_nonmember_registration',$data);
		 $this->load->view('footer',$data);	
	}
	
	public function event_member_register()
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		 $this->load->model("siteModel");
		 $data["category"] = $this->siteModel->get_category()->result();
		 $id = $this->uri->segment(3);
		 $data["event_detail"] = $this->siteModel->get_event_details($id)->result();
		 $data["event_name"] = $this->siteModel->get_event_name($id);
		 //print_r($data["event_detail"]);exit;
		 $data["title"] = "BOMA Edmonton";
		 $data["keywords"] = "BOMA Edmonton";
		 $data["desc"] = "";
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">'.$data["event_name"].'</li>';
		 $data["breadcrumb"] = $breadcrumb;
		 $data["class"] = "events";  	 
		 
		 $this->load->model("homeModel");
		 $banner = $this->homeModel->get_homebanner()->result();

    	 $data["banner"] = $banner;
		 $this->load->view('header',$data);
		 $this->load->view('events_member_registration',$data);
		 $this->load->view('footer',$data);	
	   }
	}
	
	public function events_individual()
	{
		//print_r($_POST);
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
			/*$id = $this->input->post('event_id');
			if($this->input->post('member_register') == 'individual')
			{
				$this->load->model("siteModel");
				$data["category"] = $this->siteModel->get_category()->result();
				$data["events_individual"] = $this->siteModel->get_event_details($id)->result();
				$data["event_name"] = $this->siteModel->get_event_name($id);
				$data["title"] = "BOMA Edmonton";
				$data["keywords"] = "BOMA Edmonton";
				$data["desc"] = "";
				$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">'.$data["event_name"].'</li>';
				$data["breadcrumb"] = $breadcrumb;
				$data['member_type'] = $this->input->post('member_register');
				$data["class"] = "events"; 
				$this->load->view('header',$data);
				$this->load->view('events_register_individual',$data);
				$this->load->view('footer',$data);	
			}else{
				$this->load->model("siteModel");
				$data["category"] = $this->siteModel->get_category()->result();
				$data["events_group"] = $this->siteModel->get_event_details($id)->result();
				$data["event_name"] = $this->siteModel->get_event_name($id);
				$user_data = $this->session->userdata('logged_in_site');
				$data["event_member_name"] = $this->siteModel->get_event_member_name($user_data['mid'])->result();
				//print_r($data["event_member_name"]);exit;
				$data["title"] = "BOMA Edmonton";
				$data["keywords"] = "BOMA Edmonton";
				$data["desc"] = "";
				$data['member_type'] = $this->input->post('member_register');
				$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">'.$data["event_name"].'</li>';
				$data["breadcrumb"] = $breadcrumb;
				$data["class"] = "events"; 
				$this->load->view('header',$data);
				$this->load->view('events_register_group',$data);
				$this->load->view('footer',$data);	
			}*/
		}
	   }
	}
	
	public function events_list_members()
	{
		//print_r($_POST);
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			$this->form_validation->set_rules('member_name[]', 'Member Name', 'required');
			
			if ($this->form_validation->run() == false)
			{
				$this->index();
			}	
			else
			{
				 
				//$cart_id = $this->eventsModel->get_event_id($user_data['mid']);
				$sess_event_id = array(
					'event_id'=> $_POST['event_id'],
				);
				// print_r($sess_event_id);exit;
				$this->session->set_userdata('logged_in_site2',$sess_event_id);
				
				$sess_event_register_id = array(
					'event_register_id'=> $_POST['event_register_id'],
					'event_member_name'=> $_POST['member_name'],
					'company_member_name'=> $_POST['company_member_name'],
					'event_id' => $_POST['event_id'],
					);
				// print_r($sess_event_id);exit;
				$this->session->set_userdata('logged_in_site3',$sess_event_register_id);
			
				
				
				$member_register = $this->input->post('member_register');

				$event_id = $this->input->post('event_id');
				
				$event_price = number_format($this->input->post('event_price'),2);
				
				$event_register_id = $this->input->post('event_register_id');
				
				$member_id = $this->input->post('member_id');
				
				$member_name = $this->input->post('member_name');
				
				$company_member_name = $this->input->post('company_member_name');
				
				$data_count = count($_POST);
				//$data = array();
				//$i1 = 0;
				for ($i=0; $i<count($_POST['member_name']); $i++) {
				
					//print_r($_POST['member_name']);
					$data = array(
					  'event_member_name' =>  $_POST['member_name'][$i],
					  'event_company_name' =>  $company_member_name[$i],
					  'event_id' => $event_id,
					  'member_id' => $member_id,
					  'event_register_id' => $event_register_id,
					  /*'event_seat_booked' => $_POST['event_seat_booked'],*/
					  'event_price' => $event_price,
					
					);
					//$i1++;	
					//echo "<pre>";
					//print_r($data);
					$this->eventsModel->save_event_member($data);
					
				};//exit;

				$this->session->set_flashdata("message", "Event Member Added Successfully...!");
				redirect(base_url().'events/event_member_list/'.$_POST['event_id'],'refresh');
			}
		}
	   }
	}
	
	public function event_member_list($id)
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }
	   else {
		  //echo $id;exit;
		$this->load->model("siteModel");
		$data["category"] = $this->siteModel->get_category()->result();
		$data["title"] = "BOMA Edmonton";
		$data["keywords"] = "BOMA Edmonton";
		$data["desc"] = "";
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active"><a href='.base_url().'events/index/>Event Registrations </a></li>';
		$data['id'] = $id;
		$data["breadcrumb"] = $breadcrumb;
		$data["class"] = "events";  	
		$user_data = $this->session->userdata('logged_in_site');
		$event_data = $this->session->userdata('logged_in_site3');
		//print_r($event_data);exit;
		$data['event_member_list'] = $this->eventsModel->get_event_member_details($user_data['mid'],$event_data['event_register_id'])->result();
		$data["events_register"] = $this->siteModel->get_event_details($id)->result();
		$this->load->view('header',$data);
		$this->load->view('event_list_member',$data);
		$this->load->view('footer',$data);	
		   
	   }
		
	}
	
	public function event_delete_member($id,$event_id)
	{
		/*if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }else{*/
		$id1 = $this->input->post('event_id');
		//echo $id;
		$this->load->model("eventsModel");
		$this->eventsModel->delete_event_member($id);
		//$this->session->set_flashdata("message", "events Deleted Successfully...");
		redirect(base_url().'events/event_member_register/'.$event_id);
	   //}
	}
	
	
	/*public function add_event_member()
	{
		//print_r($_POST);exit;
		/*$this->load->library('form_validation');
		if(!$this->session->userdata('logged_in_site'))
	    {
			redirect(base_url().'members/login', 'refresh');
	    }else{
			$this->form_validation->set_rules('event_member_name', 'Member Name', 'required');	
			$this->form_validation->set_rules('event_company_name', 'Company Name', 'required');
			
			if ($this->form_validation->run() == false)
			{
				$this->index();
			}	
			else
			{
	
				$data = array(
					  'event_member_name' => $this->input->post('event_member_name'),
					  'event_company_name' => $this->input->post('event_company_name'),
					  'event_id' => $this->input->post('event_id'),
					  'member_id' => $this->input->post('member_id'),
				);
				//print_r($data);exit;
				$id = $this->eventsModel->save_event_member($data);
				$this->session->set_flashdata("message", "Event Member Added Successfully...!");
				redirect(base_url().'events/events_individual','refresh');	
			}
	    }
	}*/
	
	public function event_checkout()
	{
		//echo $_POST['member_type'];exit;
		//print_r($_POST);exit;
		if(!$this->session->userdata('logged_in_site'))
	    {
			redirect(base_url().'members/login', 'refresh');
	    }else {
				$user_data = $this->session->userdata('logged_in_site');
				//print_r($user_data);//exit;
				$this->load->model("siteModel");
				$data["category"] = $this->siteModel->get_category()->result();
				if(isset($user_data['mid']))
				$data["events_cart"] = $this->siteModel->get_event_cart_details($user_data['mid'])->result();
				//echo $data["events_cart"][0]->event_id;exit;
				//print_r($data["events_cart"]);exit;
				$event_data = $this->session->userdata('logged_in_site2');
				if(isset($event_data['event_id']))
				{
				$data["events_register"] = $this->siteModel->get_event_details($event_data['event_id'])->result();
				$data["event_name"] = $this->siteModel->get_event_name($event_data['event_id']);
				}
				$data["title"] = "BOMA Edmonton";
				$data["keywords"] = "BOMA Edmonton";
				$data["desc"] = "";
				//$data['member_type'] = $_POST['member_type'];
				if(isset($data["event_name"]))
				$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">'.$data["event_name"].'</li>';
				if(isset($breadcrumb))
				$data["breadcrumb"] = $breadcrumb;
				$data["class"] = "events"; 
				$this->load->view('header',$data);
				$this->load->view('events_register_checkout',$data);
				$this->load->view('footer',$data);	
			}
	}
	
	public function order_number_check($order_number){
		$order_number = $this->eventsModel->check_purchase_number($order_number);
		if ($order_number > 0){
			$this->form_validation->set_message('order_number_check', 'The %s field already available');
			return FALSE;
		}else{ return TRUE; }		
	}
	
	
	public function add_to_cart()
	{
		//print_r($_POST);exit;
		
		//$data["member"] = $member;
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        	{
				//$id = $this->uri->segment(3);
				
			  //$this->form_validation->set_rules('event_purchase_order_number', 'Order Purchase Number', 'trim|required|callback_order_number_check');
			//echo "sddsad";exit;
		  // if($this->form_validation->run() == FALSE){				
				// $this->event_member_list($this->input->post('event_id'));
		   //}else{		
		   
				$member_id = $this->input->post('member_id');
				//echo $member_id;
				
				//print_r($car_id);exit;
				//$sess_array = array();
				
				//$this->session->set_userdata($sess_array);
				//$event_id = $this->session->userdata('logged_in_site1');
				//print_r($event_id);	
				$GST = number_format($this->input->post('event_GST'),2);
				$event_price = number_format($this->input->post('event_price'),2);
				//echo $GST;exit;
				$user = $this->session->userdata('logged_in_site');
				
				/**/
				/*$count_cart = $this->siteModel->get_event_cart_details($user['mid'])->result();
				if(count($count_cart) > 0)
					$this->siteModel->clear_cart_data_1($user["mid"]);
				*/
				/**/
				
				$member = $this->membersModel->get_by_id($user["mid"])->row();
				$data = array(
					  'event_id' => $this->input->post('event_id'),
					  'member_id' => $this->input->post('member_id'),
					  'event_register_id' => $this->input->post('event_register_id'),
					  'event_name' => $this->input->post('event_name'),
					  'member_name' => $member->company_representative,
					  'event_price' => $event_price,
					  'event_GST' => $GST,
					  'event_purchase_order_number' => $this->input->post('event_purchase_order_number'),
					  'event_seat_booked' => $this->input->post('event_seat_booked'),
				);
				//print_r($data);//exit;
				$this->eventsModel->save_event_checkout($data);
				
				/**/
				$total_items = $this->eventsModel->get_by_id($data['event_id'])->result();
				$event_seats = 0; 
				$event_seats = $event_seats + $data['event_seat_booked'];
				$total_left_seats = $total_items[0]->left_seats - $event_seats;
				$this->siteModel->update_left_seats($total_left_seats,$data['event_id']);
				/**/
				
				//$this->eventsModel->delete_event_member_list($this->input->post('event_id'),$this->input->post('member_id'));
			}
		redirect(base_url().'events/event_checkout','refresh');
		//}
	}
	
	public function pay_now()
	{
		if(!$this->session->userdata('logged_in_site'))
		{
			redirect(base_url().'members/login', 'refresh');
		}
		else {
			
			//$id = $this->uri->segment('3');
			$user_data = $this->session->userdata('logged_in_site');
			$cart_id = $this->eventsModel->get_event_id($user_data['mid']);
			$sess_cart_id = array(
					'id'=> $cart_id,
			);
			//print_r($sess_cart_id);exit;
			$this->session->set_userdata('logged_in_site1',$sess_cart_id);
			
			$user_data1 = $this->session->userdata('logged_in_site1');
			//print_r($user_data1);exit;
			$this->load->model("siteModel");
			$data["category"] = $this->siteModel->get_category()->result();
			$data["events_cart"] = $this->siteModel->get_event_cart_details($user_data['mid'])->result();
		
			//$data["event_name"] = $this->siteModel->get_event_name($id);
			$data["title"] = "BOMA Edmonton";
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active">Event Registrations</li>';
			$data["breadcrumb"] = $breadcrumb;
			$data["class"] = "events"; 
			
			$this->load->view('header',$data);
			$this->load->view('event_pay_now',$data);
			$this->load->view('footer',$data);	
		}
	}
	
	
	public function pay_later()
	{
		if(!$this->session->userdata('logged_in_site'))
		{
			redirect(base_url().'members/login', 'refresh');
		}
		else {
			
			$user_data = $this->session->userdata('logged_in_site');
			$cart_id = $this->eventsModel->get_event_id($user_data['mid']);
			$sess_cart_id = array(
					'id'=> $cart_id,
			);
			//print_r($sess_cart_id);exit;
			$this->session->set_userdata('logged_in_site1',$sess_cart_id);
			
			$user_data1 = $this->session->userdata('logged_in_site1');
			//print_r($user_data1);exit;
			$this->load->model("siteModel");
			$data["category"] = $this->siteModel->get_category()->result();
			$data["events_cart"] = $this->siteModel->get_event_cart_details($user_data['mid'])->result();
		
			//$data["event_name"] = $this->siteModel->get_event_name($id);
			$data["title"] = "BOMA Edmonton";
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active">Event Registrations</li>';
			$data["breadcrumb"] = $breadcrumb;
			$data["class"] = "events"; 
			
			$this->load->view('header',$data);
			$this->load->view('events_pay_later',$data);
			$this->load->view('footer',$data);	
			
		}
	}
	
	/*public function pay_later($id)
	{
		
		$user_data = $this->session->userdata('logged_in_site');
		$cart_id = $this->eventsModel->get_event_id($user_data['mid']);
		$sess_cart_id = array(
				'id'=> $cart_id,
		);
		//print_r($sess_cart_id);exit;
		$this->session->set_userdata('logged_in_site1',$sess_cart_id);
		
		$user_data1 = $this->session->userdata('logged_in_site1');
		//print_r($user_data1);exit;
		$this->load->model("siteModel");
		$data["category"] = $this->siteModel->get_category()->result();
		$data["events_cart"] = $this->siteModel->get_event_cart_details($user_data['mid'])->result();
		//$data["event_name"] = $this->siteModel->get_event_name($id);
		$data["title"] = "BOMA Edmonton";
		$data["keywords"] = "BOMA Edmonton";
		$data["desc"] = "";
		$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active">Event Registrations </li>';
		$data["breadcrumb"] = $breadcrumb;
		$data["class"] = "events"; 
		
		/* insert data in temporary data
		
		$user_data = $this->session->userdata('logged_in_site');
		//print_r($user_data); 
		$cart_pay_later_details = $this->session->userdata('logged_in_site1');
		
		for($i=0;$i<count($cart_pay_later_details['id']);$i++){
			if(isset($cart_pay_later_details['id'][$i]) && isset($user_data['mid']))
			{
				
				$data["events_pay_later_details"] = $this->siteModel->get_event_pay_later_details($user_data['mid'],$cart_pay_later_details['id'][$i]);
				
				$this->siteModel->clear_cart_data($user_data['mid'],$cart_pay_later_details['id'][$i]);
				//print_r($test);
							
			}
		}
		//echo $id;exit;
		$total_paylater_event = $this->eventsModel->total_paylater_booked1($id);
	  // print_r($total_paylater_event);
	  // echo "<br/>";
	   $total_order_event = $this->eventsModel->total_orderevent_booked1($id);
				   
		//$seat_lefts = $this->siteModel->get_event_seat_booked($id);
		//print_r($seat_lefts);exit;
		$total_items = $this->eventsModel->get_by_id($id)->result();
		
		//echo "<br/>";
		/*$event_seats = 0; 
		for($i=0;$i<count($seat_lefts);$i++){
			$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
		}
			//echo  $seat_lefts[0]['event_seat_booked'];
			//print_r($event_seats);exit;
		
		print_r($total_left_seats);exit;
		
		if($id == $total_order_event['event_id'] && $id == $total_paylater_event['event_id']){
						
						$total_seat_booked =  $total_order_event['event_seat_booked'] +  $total_paylater_event['event_seat_booked'];
						$total_left_seats = $total_items[0]->total_seats - $total_seat_booked;
						//echo $total_left_seats;exit; 
						$this->siteModel->update_left_seats($total_left_seats,$id);
					?>
                    
                    <?php }elseif(isset($total_order_event) && $id == $total_order_event['event_id']){
                    	$total_left_seats = $total_items[0]->total_seats - $total_order_event['event_seat_booked'];
						//echo $total_left_seats;exit; 
						$this->siteModel->update_left_seats($total_left_seats,$id);
					?>
				   		
                    <?php }else{
						
						$total_left_seats = $total_items[0]->total_seats - $total_paylater_event['event_seat_booked'];
						//echo $total_left_seats;exit; 
						$this->siteModel->update_left_seats($total_left_seats,$id);
		}
		

		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$member = $this->membersModel->get_by_id($user_data["mid"])->row();
		//print_r($member);exit;
		$email_from = "customerservice@boma.ca";
		$examil_to = $member->company_email;		
		$data['email_to'] = $examil_to;			
		$data['name'] = $member->company_representative;	
		//$data['fees'] = $member->membership_fees;
		$this->email->from($email_from, "BOMA Edmonton");
		$this->email->to($examil_to); 
		$this->email->subject('BOMA Edmonton Event Application');
		$this->email->message($this->load->view("email_pay_later",$data,true));
		$this->email->send();
		
		$this->load->view('header',$data);
		$this->load->view('events_pay_later',$data);
		$this->load->view('footer',$data);
	}*/
	
	function delete_event_cart($id)
	{
		if(!$this->session->userdata('logged_in_site'))
	   {
		 redirect(base_url().'members/login', 'refresh');
	   }else{
		//$id1 = $this->input->post('event_id');
		$this->load->model("eventsModel");
		
		/**/
		$this->eventsModel->events_left_seated1();
		/**/
		
		$this->eventsModel->delete_event_cart($id);
		$this->session->set_flashdata("message", "events Deleted Successfully...");
		redirect(base_url());
	   }
	}
	
	public function event_tickets()
	{
		if(!$this->session->userdata('logged_in_site'))
		{
			redirect(base_url().'members/login', 'refresh');
		}
		else {
			$this->load->model("siteModel");
			$data["category"] = $this->siteModel->get_category()->result();
			$data["events_cart"] = $this->siteModel->get_event_cart_details($user_data['mid'])->result();
		
			//$data["event_name"] = $this->siteModel->get_event_name($id);
			$data["title"] = "BOMA Edmonton";
			$data["keywords"] = "BOMA Edmonton";
			$data["desc"] = "";
			//$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li class="active">Event Registrations</li>';
			//$data["breadcrumb"] = $breadcrumb;
			$data["class"] = "events"; 
			$this->load->view('header',$data);
			$this->load->view('event_tickets');
			$this->load->view('footer');	
		}
	}
	public function events_booked_record()
	{
		$order_event = $this->siteModel->get_event_order_details_1($_GET['member_id']);
		echo $order_event;
	}
	public function payNotify()
	{
		
		$post_arr = $_POST;
	        $req = 'cmd=_notify-validate';
	        foreach ($post_arr as $key => $value) 
		{
	            $value = urlencode(stripslashes($value));
	            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
	            $req .= "&$key=$value";
	        }
	        // post back to PayPal system to validate
	        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	        $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
	        if (!$fp) 
			{
	            // HTTP ERROR
	        }
		else
		{
	            fputs ($fp, $header . $req);
	            while (!feof($fp))
			{
	                ////mail('atiftariq80@gmail.com','Step 9','Step 9');
	                $res = fgets($fp, 1024);
	                if (true || strcmp($res, "VERIFIED") == 0)
			{
				$items=$_POST['item_number_1'];
				$item_array=explode("#",$items);
				foreach($item_array as $val)
				{
					$event_data=array("event_payment_status"=>"Yes");
					$this->eventsModel->update_order_event_1($val,$event_data);
			
				}
				
				
				$event_data=$this->eventsModel->get_by_id_order($item_array[1])->row();
				
				if(isset($event_data->event_id))
				{
					$seat_lefts = $this->siteModel->get_event_seats($event_data->event_id);
					$total_items = $this->eventsModel->get_by_id($event_data->event_id)->result();
					
					$event_seats = 0; 
					for($i=0; $i < count($seat_lefts);$i++)
					{  
						$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
					}
					$total_left_seats = $total_items[0]->total_seats - $event_seats;
					$this->siteModel->update_left_seats($total_left_seats,$event_data->event_id);
				}


				matt.pringle@gmail.com
				
						
	                }
	            }
	            
	    $this->load->helper('mail_helper');
		$template_id = 8;
		$ArrTemplate = get_mail_template($template_id);
		//print_r($ArrTemplate );exit;
		$primary_template = $ArrTemplate['primary_template'];
		$member = $this->membersModel->get_by_id($event_data->user_id)->row();
		$order_event = $this->eventsModel->get_by_event_id($event_data->user_id, $event_data->event_id,$event_data->event_register_id)->row();
		 //print_r($order_event);
		$event_details = $this->eventsModel->get_by_event_data($order_event->event_id)->row();
		//print_r($event_details);//exit;
		//$get_member_name = implode("<br/> ", $new_data['event_member_name']);
		//$get_member_comp_name = implode("<br/> ", $new_data['company_member_name']);
		
		$new_data = $this->eventsModel->get_order_submember_email1($event_data->event_id,$event_data->event_register_id, $event_data->user_id);	
		for($i=0; $i<count($new_data['event_member_name']); $i++) 
		{
			$get_member_name_list[] = $new_data['event_member_name'][$i]." - ".$new_data['event_company_name'][$i]."<br/>";
			
			//return get_member_name_list;
			//print_r($get_member_name_list);
		}
		//print_r($get_member_name_list);//exit;
		
		$member_data = implode(" ",$get_member_name_list);
		#Assign default value
		$ArrCustomer = array();
		
		$order_total_price = $order_event->order_price + $order_event->order_GST;
		
		if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
		{
			//$link = base_url().'/controller_login/customer_activation/'.$insert_id.'/'.$customer_activation_code;
			$arr_replace = array('##name##','##customer_name##','##customer_email##','##customer_company##','##event_name##','##event_seat_booked##','##event_date##','##order_created_date##','##purhcase_order##','##event_member_name##', '##sub_total##','##GST##','##total##');
			
			$arr_replace_with = array($member->company_representative, $member->company_representative, $member->company_email, $member->company_name, $event_details->event_name, $order_event->event_seat_booked, date('d-m-Y',strtotime($event_details->start_date)), date('d-m-Y',strtotime($order_event->order_created_date)), $order_event->order_purchase_number, $member_data, number_format($order_event->order_price,2) , $order_event->order_GST, number_format($order_total_price,2) );
			
			$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
			$subject = $ArrTemplate['user_email_subject'];
			
			#End
			sendMail($member->company_email,$member->company_representative,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
		}
		
		if(count($ArrTemplate)>0 && $ArrTemplate['admin_email_y_n']=='Y' && $ArrTemplate['admin_email_type']=='to') #Send mail to Administrator
		{
			$arr_replace = array('##admin_name##','##customer_name##','##customer_email##','##customer_company##','##event_name##','##event_seat_booked##','##event_date##','##order_created_date##','##purhcase_order##','##event_member_name##', '##sub_total##','##GST##','##total##');
			
			$arr_replace_with = array('Administrator',$member->company_representative, $member->company_email, $member->company_name, $event_details->event_name, $order_event->event_seat_booked, date('d-m-Y',strtotime($event_details->start_date)), date('d-m-Y',strtotime($order_event->order_created_date)), $order_event->order_purchase_number, $member_data, number_format($order_event->order_price,2) , $order_event->order_GST, number_format($order_total_price,2));
			
			$message = get_mail_body($ArrTemplate['admin_email_template'],$arr_replace, $arr_replace_with);
			$subject = $ArrTemplate['admin_email_subject'];
			
			
			
			sendMail($ArrTemplate['admin_email'],'Administrator',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
		}
	
	        }	
	
	}

	public function event_thanks()
	{
		$data["title"] = "BOMA Edmonton";
		$data["keywords"] = "BOMA Edmonton";
		$data["desc"] = "";
		$data["class"] = "events";
		$this->load->view('header',$data);
		$this->load->view('event_thanks',$data);
		$this->load->view('footer',$data);

	}
	
	
	public function create_order1()
	{
		
		$user_data = $this->session->userdata('logged_in_site');
		//print_r($user_data); 
		$cart_details = $this->session->userdata('logged_in_site1');
		//print_r($cart_details);exit;
		$event_data = $this->session->userdata('logged_in_site2');		
		//print_r($event_data);//exit;
		$new_data = $this->session->userdata('logged_in_site3');		
		//print_r($new_data);
		$this->load->model("siteModel");
		$data["category"] = $this->siteModel->get_category()->result();
		for($i=0; $i < count($cart_details['id']);$i++){ 
			if(isset($cart_details['id'][$i]) && isset($user_data['mid'])) 
			{
				
				$data["events_order"] = $this->siteModel->get_event_order_details1($user_data['mid'],$cart_details['id'][$i]);
				$this->siteModel->clear_cart_data($user_data['mid'],$cart_details['id'][$i]);
				//print_r($test);
							
			}
		}
		//print_r($data["events_order"]);exit;
		//$data["event_name"] = $this->siteModel->get_event_name($id);
		$data["title"] = "BOMA Edmonton";
		$data["keywords"] = "BOMA Edmonton";
		$data["desc"] = "";
		/*$breadcrumb = '<li><a href='.base_url().'>Home</a></li><li><a href='.base_url().'events/index/>Event Registrations </a></li><li class="active">'.$data["event_name"].'</li>';
		$data["breadcrumb"] = $breadcrumb;*/
		$data["class"] = "events"; 
		
		/*if(isset($event_data['event_id']))
		{
			$seat_lefts = $this->siteModel->get_event_seats($event_data['event_id']);
			//print_r($seat_lefts);exit;
			$total_items = $this->eventsModel->get_by_id($event_data['event_id'])->result();
			
			//echo "<br/>";
			$event_seats = 0; 
			for($i=0; $i < count($seat_lefts);$i++){  
				$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
			}

			$total_left_seats = $total_items[0]->total_seats - $event_seats;
			$this->siteModel->update_left_seats($total_left_seats,$event_data['event_id']);
		}*/
		//print_r($event_data);
		$this->load->view('header',$data);
		$this->load->view('event_pay_later_thanks',$data);
		$this->load->view('footer',$data);	
		
				
		////////////////////////////////////////// SEND MAIL START ////////////////////////////////////////////////////
		if(isset($_POST['event_id']))
		{
		$this->load->helper('mail_helper');
		$template_id = 9;
		$ArrTemplate = get_mail_template($template_id);
		//print_r($ArrTemplate );exit;
		$primary_template = $ArrTemplate['primary_template'];
		
		$member = $this->membersModel->get_by_id($_POST["member_id"])->row();
		//$order_event = $this->eventsModel->get_by_event_id($user_data["mid"], $new_data['event_id'], $new_data['event_register_id'])->row();
		$order_event = $this->eventsModel->get_by_event_id($_POST["member_id"], $_POST['event_id'], $_POST['event_register_id'])->row();
		//print_r($order_event);//exit;
		
		$event_details = $this->eventsModel->get_by_event_data1($_POST['event_id'])->row();
		$order_total_price = $order_event->order_price + $order_event->order_GST;
		//$get_member_name = implode("<br/> ", $new_data['event_member_name']);
		//$get_member_comp_name1 = implode("<br/> ", $new_data['company_member_name']);
		//$get_member_name_list = array();
		$ne_data = $this->eventsModel->get_order_submember_email1($_POST['event_id'],$_POST['event_register_id'], $_POST["member_id"]);
		for($i=0; $i<count($ne_data['event_member_name']); $i++) 
		{
			$get_member_name_list[] = $ne_data['event_member_name'][$i]." - ".$ne_data['event_company_name'][$i]."<br/>";
			
			//return get_member_name_list;
			//print_r($get_member_name_list);
		}
		/*for($i=0; $i<count($new_data['event_member_name']); $i++) 
		{
			$get_member_name_list[] = $new_data['event_member_name'][$i]." - ".$new_data['company_member_name'][$i]."<br/>";
			
			//return get_member_name_list;
			//print_r($get_member_name_list);
		}*/
		
		//print_r($get_member_name_list);//exit;
		
		$member_data = implode(" ",$get_member_name_list);
		#Assign default value
		$ArrCustomer = array();

		
		
		if(count($ArrTemplate)>0 && $ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']=='to') #Send mail to Customer
		{
			//$link = base_url().'/controller_login/customer_activation/'.$insert_id.'/'.$customer_activation_code;
			$arr_replace = array('##name##','##customer_name##','##customer_email##','##customer_company##','##event_name##','##event_seat_booked##','##event_date##','##order_created_date##','##purhcase_order##','##event_member_name##', '##sub_total##','##GST##','##total##');
			
			$arr_replace_with = array($member->company_representative, $member->company_representative,  $member->company_email, $member->company_name, $event_details->event_name, $order_event->event_seat_booked, date('d-m-Y',strtotime($event_details->start_date)), date('d-m-Y',strtotime($order_event->order_created_date)), $order_event->order_purchase_number, $member_data,  number_format($order_event->order_price,2), $order_event->order_GST, number_format($order_total_price,2));
			
			$message = get_mail_body($ArrTemplate['user_email_template'],$arr_replace, $arr_replace_with);
			$subject = $ArrTemplate['user_email_subject'];
			
			#End
			sendMail($member->company_email,$member->company_representative,$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
		}
		
		if(count($ArrTemplate)>0 && $ArrTemplate['admin_email_y_n']=='Y' && $ArrTemplate['admin_email_type']=='to') #Send mail to Administrator
		{
			$arr_replace = array('##admin_name##','##customer_name##','##customer_email##','##customer_company##','##event_name##', '##event_seat_booked##', '##event_date##','##order_created_date##','##purhcase_order##','##event_member_name##','##sub_total##','##GST##','##total##');
			
			$arr_replace_with = array('Administrator', $member->company_representative, $member->company_email, $member->company_name, $event_details->event_name, $order_event->event_seat_booked, date('d-m-Y',strtotime($event_details->start_date)), date('d-m-Y',strtotime($order_event->order_created_date)), $order_event->order_purchase_number, $member_data,  number_format($order_event->order_price,2), $order_event->order_GST, number_format($order_total_price,2));
			
			
			$message = get_mail_body($ArrTemplate['admin_email_template'],$arr_replace, $arr_replace_with);
			$subject = $ArrTemplate['admin_email_subject'];
			
			
			
			sendMail($ArrTemplate['admin_email'],'Administrator',$ArrTemplate['from_email'],$ArrTemplate['from_name'],$subject,$message);
		}
		}
		/////////////////////////////////////////// SEND MAIL END 
		
		
	}
	
	public function events_check_seat_booked()
	{
		// print_r($_POST);
		$left_event_seats = $this->eventsModel->check_event_seat($_POST['event_left_seat']);
		//print_r($left_event_seats);
		if($left_event_seats['left_seats'] != 0)
		{
			echo '1';	
		}else{
			echo '0';
			$this->eventsModel->clear_cart_data1($_POST['event_id']);
		}
		//print_r($left_event_seats);
	}
	
	/**/
	public function events_left_seated1()
	{
		
		$user = $this->session->userdata('logged_in_site');
	
		$this->eventsModel->events_left_seated1($user['mid']);
		$count_cart = $this->siteModel->get_event_cart_details($user['mid'])->result();
		if(count($count_cart) > 0)
			$this->siteModel->clear_cart_data_1($user["mid"]);
	
	}
	/**/
	
	
}