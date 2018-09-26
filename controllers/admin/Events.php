<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

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
		$this->load->model("eventsModel");
		$this->load->model("membersModel");
		$this->load->model("siteModel");
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		$this->load->model("eventsModel");
		$events = $this->eventsModel->get_events()->result();
		$data["events"] = $events;
		$data['title'] = 'Add New Event';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/events/events',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function event_archive()
	{ 	   
		$this->load->model("eventsModel");
		$event_archive = $this->eventsModel->get_event_archive()->result();
		$data["event_archive"] = $event_archive ;
		$data['title'] = 'Event Archive';
		$data['message'] = $this->session->flashdata('message');	
		$this->load->view('admin/header');
		$this->load->view('admin/events/events_archieve',$data);
		$this->load->view('admin/footer');		
		
	}
	
	public function add()
	{
		
		$Events = $this->eventsModel->get_events()->result();
		$data["Events"] = $Events;
		$data['title'] = 'Add New Event';
		$data['action'] = site_url('admin/events/addevents');
	
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/events/eventsAdd', $data);
		$this->load->view('admin/footer');
	
	}

	public function view_registration($id)
	{
		$this->load->model("eventsModel");
		$events = $this->eventsModel->get_event_order_list()->result();
		//print_r($events);exit;
		$data["events"] = $events;
		$data["event_id"] = $id;
		//$data["event_pay_laters"] = $this->eventsModel->get_event_pay_id()->result();
		$data['title'] = 'Event Registations';
		$data['message'] = $this->session->flashdata('message'); 
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/events/view_registration', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function view_registration1($id=0)
	{
		$this->load->model("eventsModel");
		$events = $this->eventsModel->get_event_order_list()->result();
		//print_r($events);exit;
		$data["events"] = $events;
		$data["event_id"] = $id;
		//$data["event_pay_laters"] = $this->eventsModel->get_event_pay_id()->result();
		$data['title'] = 'Event Registations';
		$data['message'] = $this->session->flashdata('message'); 
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/events/view_registration1', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function event_list_sub_members($event_id,$user_id)
	{
		$this->load->model("eventsModel");
		$events_sub_members = $this->eventsModel->get_event_sub_member_list($event_id,$user_id)->result();
		//print_r($events);exit;
		$data["events_sub_members"] = $events_sub_members;
		//$data["event_pay_laters"] = $this->eventsModel->get_event_pay_id()->result();
		$data['title'] = 'Event Registations';
		$data['message'] = $this->session->flashdata('message'); 
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/events/event_list_sub_member', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function confirm_registration($id,$seat_booked,$cartid)
	{
		$this->load->model("eventsModel");
		$this->load->library('email');
		
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$event_details = $this->eventsModel->get_event_data($id)->row();
		
		//$total_items = $this->eventsModel->get_by_id($id)->row();
		//echo $total_items->total_seats;
		//print_r($total_items);exit;
		//echo "<br/>";
		
		if(isset($event_details->user_id))
		{
			$member = $this->membersModel->get_member_data_id($event_details->user_id)->row();
			//print_r($member);exit;
			$email_from = "customerservice@boma.ca";
			$examil_to = $member->company_email;		
			$data['email_to'] = $examil_to;			
			$data['name'] = $member->company_representative;
			
			//$data['fees'] = $member->membership_fees;
			$this->email->from($email_from, "BOMA Edmonton");
			$this->email->to($examil_to); 
			$this->email->subject('BOMA Edmonton Member Application');
			$this->email->message($this->load->view("admin/events/email_get_payment",$data,true));
			$this->email->send();
		}
		$this->eventsModel->get_event_order_details($id,$cartid);
		$this->eventsModel->clear_pay_later_data($id,$cartid);
		
		/*$seat_lefts = $this->siteModel->get_event_seats($id);
		//print_r($seat_lefts);exit;
		$event_seats = 0; 
		for($i=0;$i<count($seat_lefts);$i++){
			$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
		}
		//print_r($event_seats);exit;
		$total_left_seats = $total_items->total_seats - $event_seats;
		//print_r($total_left_seats);exit;
		$this->siteModel->update_left_seats($total_left_seats,$id);*/
		//print_r($events);exit;
		//$data["events"] = $events;
		$data['title'] = 'Event Registations';
		$data['message'] = $this->session->flashdata('message');
		
		redirect(base_url().'admin/events/events','refresh');
	}
	
	public function confirm_delete_events()
	{
		//print_r($_POST);exit;
		$event_id = $this->input->post('event_id');
		$member_id = $this->input->post('member_id');
		$event_reg_id = $this->input->post('event_reg_id');
		$event_price = $this->input->post('event_price');
		$checked_event_member_id = $this->input->post('event_register_id');
		
		for($i=0;$i<count($checked_event_member_id);$i++)
		{	//print_r($checked_event_member_id);
			$ID = $checked_event_member_id[$i];
			//print_r($ID);
			$this->eventsModel->delete_event_sub_member($event_id,$ID);
			
			
		}
		$total_checked_event_members =  count($checked_event_member_id);
		$totalorder_items = $this->eventsModel->get_event_order_members($event_id,$member_id,$event_reg_id)->row();
		//print_r($totalorder_items);exit;
		if(isset($totalorder_items))
		{
			if($total_checked_event_members == $totalorder_items->event_seat_booked)
			{
				$this->eventsModel->delete_event_order_list($event_reg_id, $event_id, $member_id);
				$total_items = $this->eventsModel->get_by_id($event_id)->row();
			
				//print_r($event_seats);exit;
				$total_left_seats = $total_items->left_seats + count($checked_event_member_id);
				//print_r($total_left_seats);exit;
				$this->siteModel->update_left_seats($total_left_seats,$event_id);
			}else{
				$total_left_seats = $totalorder_items->event_seat_booked - $total_checked_event_members;
				//print_r($totalorder_items);exit;
				//echo $total_left_seats;
				//echo $total_left_seats * $event_price;
				$event_data = array(
					'order_price' => $total_left_seats * $event_price,
					'event_seat_booked' => $total_left_seats,
				 );
				$this->eventsModel->update_order_event($event_reg_id, $event_data);
				$total_items = $this->eventsModel->get_by_id($event_id)->row();
			
				//print_r($event_seats);exit;
				$total_left_seats = $total_items->left_seats + count($checked_event_member_id);
				//print_r($total_left_seats);exit;
				$this->siteModel->update_left_seats($total_left_seats,$event_id);
			}
		}
			redirect(base_url().'admin/events','refresh');
	}
	
	public function confirm_delete_events_paylater($id,$seat_booked,$cartid)
	{
		$this->eventsModel->delete_event_paylater_items($id,$seat_booked,$cartid);
		
		$total_items = $this->eventsModel->get_by_id($id)->row();
		
		//print_r($event_seats);exit;
		$total_left_seats = $total_items->left_seats + $seat_booked;
		//print_r($total_left_seats);exit;
		$this->siteModel->update_left_seats($total_left_seats,$id);
		redirect(base_url().'admin/events/events','refresh');
	}
	
	public function view_events()
	{
		$events = $this->eventsModel->get_events()->result();
		$data["events"] = $events;
		$data['title'] = 'Add New events';
		$data['ckeditor'] = $this->data['ckeditor'];
		$data['action'] = site_url('admin/events/addevents');
		
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/events/view_events', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function check_equal_less($second_field,$first_field)
	{
		if ($second_field > $first_field)
		{
			$this->form_validation->set_message('check_equal_less', 'Please Enter number of members less than seats.');
			return false;       
		}
		else
		{
			return true;
		}
	}
	
	public function addrecord()
	{	
		//print_r($_POST);exit;
		$this->form_validation->set_rules('event_name', 'Events Title', 'required');	
		$this->form_validation->set_rules('event_location', 'Event Location', 'required');	
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('event_close_date', 'Event Close Date', 'required');
		//$this->form_validation->set_rules('end_date', 'End Date', 'required');	
		$this->form_validation->set_rules('timing', 'Timing', 'required');
		$this->form_validation->set_rules('event_price', 'Event Price', 'required');	
		$this->form_validation->set_rules('seats', 'Total Seats', 'required|numeric|is_natural');	
		$this->form_validation->set_rules('num_of_members', 'No. of Members', 'required|numeric|is_natural_no_zero|callback_check_equal_less['.$this->input->post('seats').']');
		$this->form_validation->set_rules('event_desc', 'Event Description', 'required');
		
		//print_r($_FILES);exit;
		$config['upload_path'] = 'images/events/';		
		// set the filter image types
		$config['allowed_types'] = 'image/gif|image/jpeg|image/png';			
		//load the upload library
		$this->load->library('upload', $config);    
		$this->upload->initialize($config);			
		$this->upload->set_allowed_types('*');		
		$data['upload_data'] = '';
		//print_r($this->upload->data());
		//if not successful, set the error message
		if (!$this->upload->do_upload('event_image')) {
			$data = array('msg' => $this->upload->display_errors());

		} else { //else, set the success message
			$data = array('msg' => "Upload success!");
			$data['upload_data'] = $this->upload->data();
		}
		//print_r($this->upload->data());exit;
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{	
			
			$data['image_name'] = $this->eventsModel->insert_images($this->upload->data());
			$timing = explode("-",$this->input->post('timing'));
			//print_r($timing);exit;
			$start_date = date("Y-m-d",strtotime($this->input->post('start_date')));
			$event_close_date = date("Y-m-d",strtotime($this->input->post('event_close_date')));
			//$end_date = date("Y-m-d",strtotime($this->input->post('end_date')));
			$event_price = number_format($this->input->post('event_price'),2);
			$data = array(
			  'event_name' => $this->input->post('event_name'),
			  'event_location' => $this->input->post('event_location'),
			  'start_date' => $start_date,
			  'event_close_date' => $event_close_date,
			  'start_time' => $timing[0],
			  'end_time' => $timing[1],
			  'event_price' => $event_price,
			  'total_seats' => $this->input->post('seats'),
			  'left_seats' => $this->input->post('seats'),
			  'event_image' => $data['image_name']['filename'],
			  'num_of_members' => $this->input->post('num_of_members'),
			  'event_desc' => $this->input->post('event_desc'),
			  'status' => 'active',
			  'event_payonline_status' => $this->input->post('event_payonline_status'),
			  'event_paylater_status' => $this->input->post('event_paylater_status'),
			);   
			$id = $this->eventsModel->save($data);
			$this->session->set_flashdata("message", "events Added Successfully...");
			redirect('admin/events/','refresh');	
		}
	}
	
	public function add_events_sub_member($event_id=0)
	{
		
		//$Events = $this->eventsModel->get_events($event_id)->result();
		//$data["Events"] = $Events;
		$data['members'] = $this->membersModel->get_paged_list_approved1()->result();
		$data["Events"] = $this->siteModel->get_event_details($event_id)->result();
		$data['title'] = 'Add New Event Sub-member';
		$data['action'] = site_url('admin/events/addevents');
	
		// load view
		$this->load->view('admin/header');
		$this->load->view('admin/events/eventsSubMember', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function event_numberof_members()
	{
		//print_r($_POST);exit;	
		$total_order_event = $this->eventsModel->total_orderevent_booked($this->input->post('event_id'),$this->input->post('member_id'));
		//print_r($total_order_event);exit;
		$order_details = '';
		if(isset($total_order_event) && $total_order_event > 0)
		{
			$events = $this->siteModel->get_event_details($this->input->post('event_id'))->result();
			foreach($events as $item)
			{
						 //$total_order_event = $this->eventsModel->total_orderevent_booked($item->id,$user_data['mid']);
						//if(isset($total_order_event) && $user_data['mid'] == $total_order_event['user_id']){
			  
				
				$member_seat_booked = $item->num_of_members - $total_order_event['event_seat_booked'];
				//if($item->left_seats < $item->num_of_members)
				if(isset($member_seat_booked) && $member_seat_booked > 0)
				{
					
					//for($j=1;$j<=$member_seat_booked;$j++)
					//{ 
						$order_details .= $member_seat_booked; //echo $i;
					//}
					//$this->output->set_output(json_encode($order_details));
					// echo json_encode($order_details);
				}else{ 
					 //for($i=1;$i<=$item->left_seats;$i++)				  
					 //{  
							$order_details .= 0; 
					 //}
					// $this->output->set_output(json_encode($order_details));
					
				}
						
			echo json_encode($order_details);
			
			}
		}
	}
	
	public function edit($id)
	{			
		$this->load->model("eventsModel");
		$eventsitem = $this->eventsModel->get_by_id($id)->row();
		$data["eventsitem"] = $eventsitem;
		
		//$data["ckeditor"] = $this->data['ckeditor'];
		$data['title'] = 'Edit events Item';
		$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/events/eventEdit',$data);
		$this->load->view('admin/footer');
		
		
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('event_name', 'Events Title', 'required');	
		$this->form_validation->set_rules('event_location', 'Event Location', 'required');	
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('event_close_date', 'Evemt Close Date', 'required');
		//$this->form_validation->set_rules('end_date', 'End Date', 'required');	
		$this->form_validation->set_rules('event_price', 'Event Price', 'required');	
		$this->form_validation->set_rules('seats', 'Total Seats', 'required|numeric|is_natural');	
		$this->form_validation->set_rules('num_of_members', 'No. of Members', 'required|numeric|is_natural_no_zero|callback_check_equal_less['.$this->input->post('seats').']');
		$this->form_validation->set_rules('event_desc', 'Event Description', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$left_order_seat_booked = $this->eventsModel->get_order_event_seat_booked($this->input->post('id'));
			//print_r($left_order_seat_booked);
			$left_pay_seat_booked = $this->eventsModel->get_pay_event_seat_booked($this->input->post('id'));
			//print_r($left_pay_seat_booked);
			$total_seat_booked = $left_order_seat_booked[0]['total_seats'] + $left_pay_seat_booked[0]['total'];
			//print_r($total_seat_booked);exit;
			$total_left_seat_booked =  $this->input->post('seats') - $total_seat_booked;
			//print_r($total_left_seat_booked);exit;
			$start_date = date("Y-m-d",strtotime($this->input->post('start_date')));
			$event_close_date = date("Y-m-d",strtotime($this->input->post('event_close_date')));
			$timing = explode("-",$this->input->post('timing'));
			//$end_date = date("Y-m-d",strtotime($this->input->post('end_date')));
			$data = array(
			  'event_name' => $this->input->post('event_name'),
			  'event_location' => $this->input->post('event_location'),
			  'start_date' => $start_date,
			  'event_close_date' => $event_close_date,
			  'start_time' => $timing[0],
			  'end_time' => $timing[1],
			  'event_price' => $this->input->post('event_price'),
			  'total_seats' => $this->input->post('seats'),
			  'left_seats' => $total_left_seat_booked,
			  'num_of_members' => $this->input->post('num_of_members'),
			  'event_desc' => $this->input->post('event_desc'),
			  'status' => 'active',
			  'event_payonline_status' => $this->input->post('event_payonline_status'),
			  'event_paylater_status' => $this->input->post('event_paylater_status'),
			);        
			
			$id = $this->input->post('id');			
			$this->eventsModel->update($id,$data);
			$this->session->set_flashdata("message", "events Updated Successfully...");
			redirect('admin/events/','refresh');	
		}				
	}
	
	function deactive($cid)
	{
		$events = array('status' => 'inactive');
		$this->eventsModel->deactive($cid,$events);
	
		redirect('admin/events/','refresh');
	}
	function active($cid)
	{
		$events = array('status' => 'active');
		$this->eventsModel->active($cid,$events);
		redirect('admin/events/','refresh');
	}

	function delete($id)
	{
		$this->load->model("eventsModel");
		$this->eventsModel->delete($id);
		$this->session->set_flashdata("message", "events Deleted Successfully...");
		redirect('admin/events/','refresh');
	}
	
	function sort_order()
	{			
		// load data
		$this->load->model("eventsModel");
		$events = $this->eventsModel->get_events()->result();
		
		$i=0; 
		foreach($events as $item) { 
			
			$arr = array('no' => $_POST["txt"][$i]);
			$this->eventsModel->update_events($events[$i]->cid,$arr);
			
		$i++; }
			
		$this->session->set_flashdata("message", "Banner Updated Successfully...");
		redirect('admin/events/','refresh');
		
		
	}
	
	public function addsubmemberrecord()
	{
		//print_r($_POST);exit;
		######## Add event sub members #########
		foreach($_POST['member_name'] as $value) {
			$data1 = $value;
			
			$data = array(
			  'event_member_name' =>  $data1,
			  'event_id' => $_POST['event_id'],
			  'member_id' => $_POST['member_id'],
			  'event_register_id' => $_POST['event_register_id'],
			  'event_price' => $_POST['event_price'],
			);
			
		 $sub_member_id = $this->eventsModel->save_event_member($data);
		}
		######## End event sub members #########
		
		######## Add event carts #########
		$member = $this->membersModel->get_by_id($this->input->post("member_id"))->row();
		
		$cart_data = array(
			  'event_id' => $this->input->post('event_id'),
			  'member_id' => $this->input->post('member_id'),
			  'event_register_id' => $this->input->post('event_register_id'),
			  'event_name' => $this->input->post('event_name'),
			  'member_name' => $member->company_representative,
			  'event_price' => $this->input->post('event_price') * count($this->input->post('seat_booked')),
			  'event_seat_booked' => count($this->input->post('seat_booked')),
		);
		//print_r($cart_data);exit;
		$cart_id = $this->eventsModel->save_event_checkout($cart_data);
		######## End event carts #########
		
		$cart_details = $this->eventsModel->get_event_cart_data($this->input->post('event_id'),$this->input->post('member_id'),$this->input->post('event_register_id'))->result();
		
		//print_r($cart_details);exit;
		
		for($i=0;$i<count($cart_details);$i++){ 
			if(isset($cart_details) && isset($_POST['member_id']))
			{
				//print_r($cart_details);exit;
				$events_order = $this->siteModel->get_event_order_details($this->input->post('member_id'),$cart_details[$i]->id);
				//print_r($events_order);exit;
				$this->siteModel->clear_cart_data($this->input->post('member_id'),$cart_details[$i]->id);
				//print_r($test);
				//return $events_order;			
			}
		}
		//print_r($events_order);exit;	
		if(isset($_POST['event_id']) && $_POST['event_id'] > 0)
		{
			$seat_lefts = $this->siteModel->get_event_seats($this->input->post('event_id'));
			//print_r($seat_lefts);exit;
			$total_items = $this->eventsModel->get_by_id($this->input->post('event_id'))->result();
			
			//echo "<br/>";
			$event_seats = 0; 
			for($i=0;$i<count($seat_lefts);$i++){  
				$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
			}

			$total_left_seats = $total_items[0]-> total_seats - $event_seats;
			$this->siteModel->update_left_seats($total_left_seats,$this->input->post('event_id'));
		}
		//$this->session->set_flashdata("message", "Event Member Added Successfully...!");
		redirect(base_url().'admin/events/view_registration/'.$_POST['event_id'],'refresh');
	}
	
	public function view_sub_member_list($event_id,$user_id,$event_register_id)
	{
		$this->load->model("eventsModel");
		$events_sub_members = $this->eventsModel->get_sub_member_list($event_id,$user_id,$event_register_id)->result();
		$data["events_sub_members"] = $events_sub_members;
		
		//$data["ckeditorview"] = $this->data['ckeditor'];
		$data['title'] = 'Events Sub Members';
		//$data['action'] = site_url('admin/events/update/');
		$data['message'] = "";		
		$this->load->view('admin/header');
		$this->load->view('admin/events/view_delete_event_members',$data);
		$this->load->view('admin/footer');
	}
	
}