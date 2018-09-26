<?php
	class EventsModel extends CI_Model
	{
	
		private $tbl_events = 'tbl_events';
	
		function Menu()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_events()
		{	$this->db->order_by('id','asc');
			$res = $this->db->get('tbl_events');
			return $res;			
		}
		
		function get_event_archive()
		{	$this->db->order_by('id','asc');
			$res = $this->db->get('tbl_event_archieve');
			return $res;			
		}
		
		function count_all()
		{
			return $this->db->count_all($this->tbl_events);
		}
	
		function get_by_id($id)
		{
			$this->db->where('id', $id);
			return $this->db->get($this->tbl_events);
		}
	
		function save($data)
		{
			$this->db->insert($this->tbl_events,$data);
			//echo $this->db->last_query();exit;
			return $this->db->insert_id();
		}
		
		function save_archieve($data)
		{
			if(isset($data))
			{
				$this->db->insert("tbl_event_archieve",$data);
				//echo $this->db->last_query();exit;
				return $this->db->insert_id();
			}
		}
	
		function save_event_member($data)
		{
			//print_r($data);
			//for($i=0;$i<count($data);$i++)
			//{
			$this->db->insert("tbl_event_member", $data);
			//echo $this->db->last_query();//exit;
			return $this->db->insert_id();
			//}
		}
		
		function get_pay_status($event_id)
		{
			$this->db->where('id', $event_id);
			//echo $this->db->last_query();exit;
			return $this->db->get("tbl_events");
		}
		
	
		function get_event_cart_data($event_id, $member_id, $event_register_id)
		{
			$this->db->where('event_id', $event_id);
			$this->db->where('member_id', $member_id);
			$this->db->where('event_register_id', $event_register_id);
			//$this->db->where('id', $cart_id);
			$this->db->order_by('id','desc');
			return $this->db->get("tbl_events_cart");
		}
		
		function save_event_checkout($data)
		{
			$this->db->insert("tbl_events_cart", $data);
			//echo $this->db->last_query();exit;
			return $this->db->insert_id();
		}
		
		
		function update($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_events, $data);
			//echo $this->db->last_query();exit;
		}
		function deactive($id, $courses)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_events, $courses);
		}
		function active($id, $courses)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_events, $courses);
		}
	
		function delete($id)
		{
			$this->db->where('id', $id);
			$this->db->delete($this->tbl_events);
			
		}
		
		function delete_event_cart($id)
		{
			$this->db->where('id', $id);
			$this->db->delete("tbl_events_cart");
			
		}
		
		function delete_event_member($id)
		{
			$this->db->where('event_register_id', $id);
			$this->db->delete("tbl_event_member");
			
		}
		
		function delete_event_member_list($id,$member_id)
		{
			$this->db->where('event_id', $id);
			$this->db->where('member_id', $member_id);
			$this->db->delete("tbl_event_member");
			
		}
		
		function update_menu($id, $cat)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_events, $cat);
		}
		
		function insert_images($upload_data = array()){
		  $data = array(
			  'filename' => $upload_data['file_name'],
			  'fullpath' => $upload_data['full_path']
		  );
		  return $data;
		}
		
		public function get_event_id($member_id)
		{
			$this->db->select('*');
			$this->db->from('tbl_events_cart');
			$this->db->where('member_id',$member_id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() > 0)
			{
				$value = array();
				foreach($query->result_array() as $row)
				{
					//$event = $query->result_array();  
					$value[] = $row['id'];
				}
				return $value;
		   }
		}
		
		public function get_event_member_details($member_id,$event_register_id)
		{
			$this->db->where('member_id', $member_id);
			$this->db->where('event_register_id', $event_register_id);
			return $this->db->get('tbl_event_member');
			//echo $this->db->last_query();exit;
		}
		
		public function get_event_member_lists($event_id, $event_register_id)
		{
			$this->db->select('*');
			$this->db->from('tbl_event_member');
			//$this->db->where('member_id', $member_id);
			$this->db->where('event_id', $event_id);
			$this->db->where('event_register_id', $event_register_id);
			$this->db->order_by('event_id', 'desc');
			$query = $this->db->get();
			
			return $query->result_array();
			
		}
		
		
		public function get_event_member_details1($event_id,$event_register_id)
		{
			$this->db->where('event_id', $event_id);
			$this->db->where('event_register_id', $event_register_id);
			return $this->db->get('tbl_event_member');
			//echo $this->db->last_query();exit;
		}
		
		public function get_event_order_list()
		{
			$id = $this->uri->segment('4');
			$this->db->select('*');
			$this->db->order_by('name','asc');
			$this->db->from('tbl_order_event');
			$this->db->where('tbl_order_event.event_id', $id);
			//$this->db->where('tbl_order_event.event_payment_status !=','Waiting');
			//$this->db->group_by('tbl_order_event.event_id');
			//$this->db->select('tbl_event_member.event_register_id');
			//$this->db->join('tbl_event_member', 'tbl_event_member.member_id = tbl_order_event.user_id','right');
			//$this->db->group_by('tbl_event_member.event_register_id');
			return $this->db->get();
			echo $this->db->last_query();exit;
			
			/*$this->db->select('*');
			$this->db->from('tbl_order_event');
			$this->db->where('tbl_order_event.event_id', $id);
			//$this->db->group_by('tbl_order_event.event_id');
			//$this->db->order_by('tbl_order_event.event_id','desc');
			//$this->db->select('GROUP as (tbl_event_member.event_register_id)');
			$this->db->join('tbl_event_member', 'tbl_event_member.event_id = tbl_order_event.event_id','left');
			$this->db->where('tbl_event_member.event_id', $id);
			$this->db->group_by('tbl_event_member.event_register_id');
			return $this->db->get();*/
			//echo $this->db->last_query();exit;
			
		}
		
		public function get_order_event_id($id)
		{
			$this->db->where('event_id', $id);
			return $this->db->get("tbl_order_event");
		}
		
		public function get_member_email($id)
		{
			//$id = $this->uri->segment('4');
			$this->db->where('id', $id);
			return $this->db->get("tbl_members");
		}
		public function get_order_submember_email1($event_id,$event_register_id,$user_id)
		{
			//$id = $this->uri->segment('4');
			$this->db->select('*');
			$this->db->from('tbl_event_member');
			$this->db->where('event_register_id', $event_register_id);
			$this->db->where('event_id', $event_id);
			$this->db->where('member_id', $user_id);
			
			//$this->db->group_by('event_register_id');
			$query = $this->db->get();
			//echo $this->db->last_query();///exit;
			$value = array();
			foreach($query->result_array() as $row)
			{
				//echo "Mmber Names==>";
				//print_r($row);
				$value['event_member_name'][] = $row['event_member_name'];
				$value['event_company_name'][] = $row['event_company_name'];
			}
			return $value;
		}
		
		public function get_order_submember_email($event_register_id)
		{
			$id = $this->uri->segment('4');
			$this->db->select('*');
			$this->db->from('tbl_event_member');
			$this->db->where('event_id', $id);
			$this->db->where('event_register_id', $event_register_id);
			$query = $this->db->get();
			$value = '';
			foreach($query->result_array() as $row)
			{
				$value = $row['event_member_name'];
			}
			return $value;
		}
		
		public function get_event_pay_id()
		{
			$id = $this->uri->segment('4');
			$this->db->select('*');
			$this->db->from('tbl_event_pay_later');
			$this->db->where('tbl_event_pay_later.event_id', $id);
			//$this->db->order_by('tbl_event_pay_later.event_id','desc');
			$this->db->join('tbl_event_member', 'tbl_event_member.member_id = tbl_event_pay_later.user_id','left');
			$this->db->group_by('tbl_event_member.event_register_id');
			return $this->db->get();
			
		}
		
		public function get_event_sub_member_list($event_id,$user_id)
		{
			$this->db->select('event_register_id');
			$this->db->from('tbl_event_member');
			$this->db->where('member_id', $user_id);
			$this->db->where('event_id', $event_id);
			$this->db->group_by('event_register_id');
			return $query = $this->db->get();
			
		}
		
		
		public function get_sub_members($event_register_id)
		{
			$this->db->select('event_member_name');
			$this->db->from('tbl_event_member');
			$this->db->where('event_register_id', $event_register_id);
			return $this->db->get();
			
		}
		
		public function clear_pay_later_data($id,$cartid)
		{
			//clear product cart data
			$this->db->where("event_id",$id);
			$this->db->where("cart_id",$cartid);
			$this->db->delete("tbl_event_pay_later");
			//echo $this->db->last_query();exit;
		}
		
		public function get_event_order_details($id,$cartid)
		{
			$this->db->select('*');
			$this->db->from('tbl_event_pay_later');
			$this->db->where('tbl_event_pay_later.event_id',$id);
			$this->db->where('tbl_event_pay_later.cart_id',$cartid);
			$query = $this->db->get();
			// echo $this->db->last_query();exit;
			$pay_later_list_data = $query->result_array();
			//print_r($pay_later_list_data);exit;
			if($query -> num_rows() > 0)
			{
				for($i=0;$i<count($pay_later_list_data);$i++)
				{
				if($pay_later_list_data[$i]['id'] != '')
				{
					$pay_later_data[] = array(
						'order_eventname' => $pay_later_list_data[$i]['event_name'],
						'event_id' => $pay_later_list_data[$i]['event_id'],
						'user_id' => $pay_later_list_data[$i]['user_id'],
						'cart_id' => $pay_later_list_data[$i]['cart_id'],
						'order_price' => $pay_later_list_data[$i]['order_price'],
						'name' => $pay_later_list_data[$i]['name'],
						'event_seat_booked' => $pay_later_list_data[$i]['event_seat_booked'],
						'order_created_date' => date('Y-m-d'),
						'event_payment_status' => 'No',
					);
					//print_r($pay_later_data);
					$insert = $this->db->insert('tbl_order_event', $pay_later_data[$i]);
					
					$order_id = $this->db->insert_id();
					
					$product_counter = 1;
				}/*else{
					$order_data[] = array(
						'order_eventname' => $car_list_data[$i]['event_name'],
						'user_id' => $car_list_data[$i]['member_id'],
						'cart_id' => $car_list_data[$i]['id'],
						'order_price' => $car_list_data[$i]['total'],
						'name' => $car_list_data[$i]['member_name'],
						'order_created_date' => date('Y-m-d'),
					);
					$this->db->where('id', $order_id);
					$update = $this->db->update('tbl_order_event', $order_data[$i]);
					
					$product_counter = 2;
				}*/
				}
				$order_session_id = array(
						'id'=> $order_id,
					);
				$this->session->set_userdata('logged_in_site2',$order_session_id);
			}
		
		}
		function get_event_data($id)
		{
			$this->db->where('event_id', $id);
			return $this->db->get('tbl_event_pay_later');
		}
		
		public function get_event_order_members($event_id,$member_id,$event_register_id)
		{
			$this->db->where('event_id', $event_id);
			$this->db->where('user_id', $member_id);
			$this->db->where('event_register_id', $event_register_id);
			return $this->db->get('tbl_order_event');
		}
		
		public function delete_event_order_items($id,$cartid)
		{
			$this->db->where('event_id', $id);
			$this->db->where('cart_id', $cartid);
			$this->db->delete("tbl_order_event");
			
		}
		
		public function delete_event_sub_member($id,$event_register_id)
		{
			//print_r($event_register_id);exit;
			for($i=0;$i<count($event_register_id);$i++); 
			{
				$this->db->where('event_id', $id);
				$this->db->where('event_member_name', $event_register_id);
				$event_data = $this->db->delete("tbl_event_member");
				//echo $this->db->last_query();
			}
			return $event_data;
			
		}
		
		public function delete_event_paylater_items($id,$seat_booked,$cartid)
		{
			$this->db->where('event_id', $id);
			$this->db->where('cart_id', $cartid);
			$this->db->delete("tbl_event_pay_later");
			
		}
		
		public function get_order_event_seat_booked($event_id)
		{
			$this->db->select("SUM(tbl_order_event.event_seat_booked) as total_seats");
			$this->db->from("tbl_order_event");
			$this->db->where("tbl_order_event.event_id",$event_id);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function get_pay_event_seat_booked($event_id)
		{
			$this->db->select("SUM(tbl_event_pay_later.event_seat_booked) as total");
			$this->db->from("tbl_event_pay_later");
			$this->db->where("tbl_event_pay_later.event_id",$event_id);
			$query = $this->db->get();
			return $query->result_array();
			
		}
		function total_paylater_booked($event_id,$userid)
		{
			$this->db->select("sum(event_seat_booked),user_id");
			$this->db->where('event_id', $event_id);
			$this->db->where('user_id', $userid);
			$this->db->from("tbl_event_pay_later");
			$query = $this->db->get();
			$seat_paylater_booked = array();
			foreach($query->result_array() as $row)
			{
				//print_r($row);
				$seat_paylater_booked['event_seat_booked'] = $row['sum(event_seat_booked)'];	
				$seat_paylater_booked['user_id'] = $row['user_id'];	
			}
			return $seat_paylater_booked;
		}
		
		function total_orderevent_booked($event_id,$userid)
		{
			$this->db->select("sum(event_seat_booked),user_id");
			$this->db->where('event_id', $event_id);
			$this->db->where('user_id', $userid);
			$this->db->from("tbl_order_event");
			$query = $this->db->get();
			$seat_order_booked = array();
			foreach($query->result_array() as $row)
			{
				$seat_order_booked['event_seat_booked'] = $row['sum(event_seat_booked)'];
				$seat_order_booked['user_id'] = $row['user_id'];
			}
			return $seat_order_booked;
		}
		
		
		
		function total_paylater_booked1($event_id)
		{
			$this->db->select("sum(event_seat_booked),event_id");
			$this->db->where('event_id', $event_id);
			$this->db->from("tbl_event_pay_later");
			$query = $this->db->get();
			$seat_paylater_booked = array();
			foreach($query->result_array() as $row)
			{
				//print_r($row);
				$seat_paylater_booked['event_seat_booked'] = $row['sum(event_seat_booked)'];	
				$seat_paylater_booked['event_id'] = $row['event_id'];	
			}
			return $seat_paylater_booked;
		}
		
		function total_orderevent_booked1($event_id)
		{
			$this->db->select("sum(event_seat_booked),event_id");
			$this->db->where('event_id', $event_id);
			$this->db->from("tbl_order_event");
			$query = $this->db->get();
			$seat_order_booked = array();
			foreach($query->result_array() as $row)
			{
				$seat_order_booked['event_seat_booked'] = $row['sum(event_seat_booked)'];
				$seat_order_booked['event_id'] = $row['event_id'];
			}
			return $seat_order_booked;
		}
		
		/*function total_orderevent_booked($event_id,$userid)
		{
			//$this->db->where('event_id', $id);
			//return $this->db->get('tbl_order_event');
			
			$this->db->select("*");
			$this->db->from("tbl_order_event");
			$this->db->where("tbl_order_event.event_id",$event_id);
			$this->db->where("tbl_order_event.user_id",$userid);
			$this->db->select("tbl_event_pay_later.event_seat_booked");
			$this->db->join("tbl_event_pay_later","tbl_event_pay_later.user_id = tbl_order_event.user_id","left");
			$this->db->or_where("tbl_event_pay_later.event_id",$event_id);
			$this->db->or_where("tbl_event_pay_later.user_id",$userid);
			$query = $this->db->get();
			//echo $this->db->last_query();exit; 
			return $query->result_array();
		}*/
		
		function delete_cuurentdate_event()
		{
			//echo $_SERVER['REQUEST_TIME'];
			$dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
			$date1 = $dt->format('H:i:s');// exit;
			//echo $date1;//exit;
			$date = date('Y-m-d');
			if($date1 == '23:59:59' && isset($date))
			{
				$date = date('Y-m-d');	
				//echo $date;exit;
				$this->db->where('start_date', $date);
				$this->db->delete('tbl_events');
			}else{
				$date = date('Y-m-d');	
				//echo $date;exit;
				$this->db->where('start_date <', $date);
				$this->db->delete('tbl_events');
			}
		}
		
		public function get_sub_member_list($event_id,$user_id,$event_register_id)
		{
			$this->db->where('event_id', $event_id);
			$this->db->where('member_id', $user_id);
			$this->db->where('event_register_id', $event_register_id);
			//$this->db->group_by('event_register_id');
			return $this->db->get('tbl_event_member');
		}
		
		public function update_order_event($event_reg_id,$event_data)
		{
			$this->db->where('event_register_id', $event_reg_id);
			$this->db->update('tbl_order_event', $event_data);
			//echo $this->db->last_query();exit;
		}
		
		public function delete_event_order_list($event_reg_id, $event_id, $member_id)
		{
			$this->db->where('event_id', $event_id);
			$this->db->where('event_register_id', $event_reg_id);
			$this->db->where('user_id', $member_id);
			$this->db->delete("tbl_order_event");
			//echo $this->db->last_query();exit;
			
		}
				
		function get_by_event_id($user_id, $event_id,$event_register_id)
		{
			$this->db->where('user_id', $user_id);
			$this->db->where('event_id', $event_id);
			$this->db->where('event_register_id', $event_register_id);
			return $this->db->get("tbl_order_event");
		}
		
		public function get_by_event_data($event_id)
		{
			//echo $event_id;exit;
			$this->db->where('id', $event_id);
			return $this->db->get("tbl_events");
		}
		
		public function get_by_event_data1($event_id)
		{
			//echo $event_id;exit;
			$this->db->where('id', $event_id);
			return $this->db->get("tbl_events");
		}
		
		public function get_by_purchase_order($cart_id)
		{
			$this->db->where('cart_id', $cart_id);
			return $this->db->get("tbl_order_event");
		}
		
		public function check_purchase_number($order_number)
		{
			$sql = "SELECT Id FROM tbl_events_cart where event_purchase_order_number = '".$order_number."'";		
			$query = $this->db->query($sql);
			//echo $this->db->last_query();exit;
			return $query->num_rows();
		}
		public function clear_cart_data1($id)
		{
			$this->db->where('event_id', $id);
			$this->db->delete("tbl_events_cart");
			
		}
		
		public function check_event_seat($seats)
		{
		
			$this->db->select("*");
			$this->db->where('left_seats', $seats);
			$this->db->from("tbl_events");
			$query = $this->db->get();
			$seat_booked = array();
			foreach($query->result_array() as $row)
			{
				$seat_booked['left_seats'] = $row['left_seats'];
			}
			return $seat_booked;
		}
		/*oliver*/
		public function get_by_id_order($id)
		{
			$this->db->where('id', $id);
			return $this->db->get("tbl_order_event");
		}
		public function update_order_event_1($id,$event_data)
		{
			$this->db->where('id', $id);
			$this->db->update('tbl_order_event', $event_data);
			//echo $this->db->last_query();exit;
		}
		/**/
		public function events_left_seated1($member_id)
		{
			//$user = $this->session->userdata('logged_in_site');
			$this->load->model("siteModel");
			$count_cart = $this->siteModel->get_event_cart_details($member_id)->result();
			
			if(count($count_cart) >0)
			{
				foreach($count_cart as $row)
				{
					$total_items = $this->get_by_id($row->event_id)->result();
					$event_seats = 0; 
					$event_seats = $event_seats + $row->event_seat_booked;
					$total_left_seats = $total_items[0]->left_seats + $event_seats;
					$this->siteModel->update_left_seats($total_left_seats,$row->event_id);
				}
			}	
	
		}
		/**/
	}
?>