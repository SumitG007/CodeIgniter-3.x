<?php
	class SiteModel extends CI_Model
	{
	
		private $tbl_category = 'tbl_category';
		private $tbl_subcategory = 'tbl_subcategory';
		private $tbl_page ='tbl_pages';
		private $tbl_events ='tbl_events';
	
		function Site()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}
						
		function get_category()
		{   $this->db->order_by('no','asc');
			$this->db->where('status', "active");
			$res = $this->db->get('tbl_category');
			return $res;			
		}
		
		function get_jobs()
		{   $this->db->order_by('jid','desc');
			$this->db->where('status', "approved");
			$res = $this->db->get('tbl_jobs');
			return $res;			
		}
				
		function get_banner()
		{	$this->db->order_by('hid','desc');
			$res = $this->db->get('homebanner');
			return $res;			
		}
		function get_page($pname)
		{
			$this->db->where('pname', $pname);
			return $this->db->get($this->tbl_page);
		}

		function get_category_by_id($id)
		{
			$this->db->where('cid', $id);
			return $this->db->get($this->tbl_category);
		}

		function get_subcategory_detail($id)
		{
			$this->db->where('scid', $id);
			return $this->db->get($this->tbl_subcategory);
		}	
	
		function get_subcategory_by_id($id)
		{	$this->db->order_by('no','asc');
			$this->db->where('status', "active");
			$this->db->where('cid', $id);
			return $this->db->get($this->tbl_subcategory);
		}
		
		function get_events()
		{   $this->db->order_by('id','desc');
			$this->db->where('status', "active");
			//$this->db->limit(3);
			$res = $this->db->get('tbl_events');
			return $res;		
		}
		
		
	
	
	/*function get_all_events()
	{   
		$dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
		$date1 = $dt->format('H:i:s');// exit;
		//print_r($date1)."<br/>";//exit;
		
		$date = explode(" ",$date1);
		$today_date = date('Y-m-d');
		//echo "<br/>".$today_date;
		
		
		$this->db->select("*");
		$this->db->from('tbl_events');
		$this->db->where('status', 'active');
		$this->db->where('event_close_date', $today_date);
		$query = $this->db->get();
		$event_data = $query->result_array();
		//echo $event_data[0]['event_close_date'];
		if($today_date == $event_data[0]['event_close_date'] && $date1 == "15:09")
		{
			foreach($event_data as $item)
			{
			
				$data = array(
				  'event_id' => $item['event_id'],
				  'event_name' => $item['event_name'],
				  'event_location' => $item['event_location'],
				  'start_date' => $item['start_date'],
				  'event_close_date' => $item['event_close_date'],
				  'start_time' => $item['start_time'],
				  'end_time' => $item['end_time'],
				  'event_price' => $item['event_price'],
				  'total_seats' => $item['total_seats'],
				  'left_seats' => $item['left_seats'],
				  'event_image' =>$item['event_image'],
				  'num_of_members' => $item['num_of_members'],
				  'event_desc' => $item['event_desc'],
				  'status' => 'active',			  
							  
				);
				
			}
			//print_r($data);exit;
			//if(isset($data))
			$this->eventsModel->save_archieve($data);
			
			$this->db->where('event_close_date', $today_date);
			$this->db->delete('tbl_events');
			//return $res;
			
			
	}else{
		
		/*$this->db->select("*");
		$this->db->from('tbl_events');
		//$this->db->order_by('id','desc');
		$this->db->where('status', 'active');
		$this->db->where('event_close_date <', $today_date);
		$query = $this->db->get();
		$event_data = $query->result_array();
		
			foreach($event_data as $item)
			{
			
				//print_r($item);
				$data = array(
				  'event_name' => $item['event_name'],
				  'event_location' => $item['event_location'],
				  'start_date' => $item['start_date'],
				  'event_close_date' => $item['event_close_date'],
				  'start_time' => $item['start_time'],
				  'end_time' => $item['end_time'],
				  'event_price' => $item['event_price'],
				  'total_seats' => $item['total_seats'],
				  'left_seats' => $item['left_seats'],
				  'event_image' =>$item['event_image'],
				  'num_of_members' => $item['num_of_members'],
				  'event_desc' => $item['event_desc'],
				  'status' => 'active',			  
							  
				);
				
			}
			//print_r($data);exit;
			//if(isset($data))
			$this->eventsModel->save_archieve($data);
			
			$this->db->where('event_close_date', $today_date);
			$this->db->delete('tbl_events');
			
			//echo "else";
		//$this->db->select("*");
		//$this->db->from('tbl_events');
		$this->db->order_by('id','desc');
		$this->db->where('status', "active");
		$this->db->where('start_date >=', $date[0]);
		$res = $this->db->get('tbl_events');
		//echo $this->db->last_query();exit;
		return $res->result_array();
		//return $res;
	}
		
		
								}*/

	public function get_all_events()
		{   
			ini_set('date.timezone', 'America/Los_Angeles');
			$dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
			$date1 = $dt->format('Y-m-d H:i:s');// exit;
			//echo $date1."<br/>";//exit;
			
			$date = explode(" ",$date1);
			//print_r($date);
			if(isset($date[0]))
			$this->db->select("*");
			$this->db->from('tbl_events');
			$this->db->where('status', "active");
			$this->db->where('start_date', $date[0]);
			$query = $this->db->get();
			$event_data = $query->result_array();
			//if(isset($event_data[0]['event_close_date']))
			if(isset($event_data[0]['event_close_date']) && $date[0] == $event_data[0]['event_close_date'] &&  $date[1] == "23:59:00" || $date[1] >= "23:59:00")
			{
				foreach($event_data as $item)
				{
					$data = array(
					  'event_id' => $item['id'],
					  'event_name' => $item['event_name'],
					  'event_location' => $item['event_location'],
					  'start_date' => $item['start_date'],
					  'event_close_date' => $item['event_close_date'],
					  'start_time' => $item['start_time'],
					  'end_time' => $item['end_time'],
					  'event_price' => $item['event_price'],
					  'total_seats' => $item['total_seats'],
					  'left_seats' => $item['left_seats'],
					  'event_image' =>$item['event_image'],
					  'num_of_members' => $item['num_of_members'],
					  'event_desc' => $item['event_desc'],
					  'status' => 'active',			  
					);
					
				}
				//print_r($data);//exit;
				//if(isset($data))
				if(isset($data)) $this->eventsModel->save_archieve($data);
				
				$this->db->where('start_date', $date[0]);
				$this->db->delete('tbl_events');
				//return $res;
				
				
		}else{
			//echo "else";
			//$this->db->select("*");
			//$this->db->from('tbl_events');
			$this->db->order_by('id','desc');
			$this->db->where('status', "active");
			$this->db->where('start_date >=', $date[0]);
			$res = $this->db->get('tbl_events');
			//echo $this->db->last_query();exit;
			return $res->result_array();
			//return $res;
			
		}
	}
	
	function get_event_details($id)
	{
		$this->db->where('id',$id);
		$res = $this->db->get('tbl_events');
		return $res;
	}
	
	public function get_event_name($id)
	{
		$this->db->select('event_name');
		$this->db->from('tbl_events');
		$this->db->where('id',$id);
		$query = $this->db->get();
		foreach($query->result_array() as $row)
		{
			//($row);
			$event_name1 = $row['event_name'];
		}
		return $event_name1;
	}
	
	function company_data($user_id)
	{
		//echo $user_id;
		$this->db->where('id', $user_id);
		return $this->db->get("tbl_members");
		
	}
	
	function get_event_member_name($id)
	{
		//echo $user_id;
		$this->db->where('member_id', $id);
		return $this->db->get("tbl_event_member"); 
		
	}
	
		
	/**/
	function get_event_cart_details($id)
	{
		$this->db->where('member_id',$id);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$res = $this->db->get('tbl_events_cart');
		return $res;
	}
	function get_event_cart_details1($id)
	{
		$this->db->where('event_id',$id);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$res = $this->db->get('tbl_events_cart');
		
		//echo $this->db->last_query();
		
		return $res;
	}
	/**/
	
	
	
	
	function get_event_order_details($userid,$id)
	{
		$this->db->select('*');
		//$this->db->select("Sum(event_price) as total");
		$this->db->from('tbl_events_cart');
		$this->db->where('tbl_events_cart.id',$id);
		$this->db->where('tbl_events_cart.member_id',$userid);
		//$this->db->join('tblshop_cart_product', 'tblshop_cart_product.shop_cart_id = tblshop_cart.shop_cart_id', 'right');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$car_list_data = $query->result_array();
		//print_r($car_list_data);exit;
		if($query -> num_rows() > 0)
		{
			for($i=0;$i<count($car_list_data);$i++)
			{
			if($car_list_data[$i]['id'] != '')
			{
				$order_data[] = array(
					'order_eventname' => $car_list_data[$i]['event_name'],
					'event_id' => $car_list_data[$i]['event_id'],
					'user_id' => $car_list_data[$i]['member_id'],
					'event_register_id' => $car_list_data[$i]['event_register_id'],
					'cart_id' => $car_list_data[$i]['id'],
					'order_price' => $car_list_data[$i]['event_price'],
					'order_GST' =>$car_list_data[$i]['event_GST'],
					'order_purchase_number' =>$car_list_data[$i]['event_purchase_order_number'],
					'name' => $car_list_data[$i]['member_name'],
					'event_seat_booked' => $car_list_data[$i]['event_seat_booked'],
					'order_created_date' => date('Y-m-d'),
					'event_payment_status' => 'Yes',
				);
				$insert = $this->db->insert('tbl_order_event', $order_data[$i]);
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
	
	function get_event_order_details1($userid,$id)
	{
		$this->db->select('*');
		//$this->db->select("Sum(event_price) as total");
		$this->db->from('tbl_events_cart');
		$this->db->where('tbl_events_cart.id',$id);
		$this->db->where('tbl_events_cart.member_id',$userid);
		//$this->db->join('tblshop_cart_product', 'tblshop_cart_product.shop_cart_id = tblshop_cart.shop_cart_id', 'right');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$car_list_data = $query->result_array();
		//print_r($car_list_data);exit;
		if($query -> num_rows() > 0)
		{
			for($i=0;$i<count($car_list_data);$i++)
			{
			if($car_list_data[$i]['id'] != '')
			{
				$order_data[] = array(
					'order_eventname' => $car_list_data[$i]['event_name'],
					'event_id' => $car_list_data[$i]['event_id'],
					'user_id' => $car_list_data[$i]['member_id'],
					'event_register_id' => $car_list_data[$i]['event_register_id'],
					'cart_id' => $car_list_data[$i]['id'],
					'order_price' => $car_list_data[$i]['event_price'],
					'order_GST' =>$car_list_data[$i]['event_GST'],
					'order_purchase_number' =>$car_list_data[$i]['event_purchase_order_number'],
					'name' => $car_list_data[$i]['member_name'],
					'event_seat_booked' => $car_list_data[$i]['event_seat_booked'],
					'order_created_date' => date('Y-m-d'),
					'event_payment_status' => 'No',
				);
				$insert = $this->db->insert('tbl_order_event', $order_data[$i]);
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
	
	public function clear_cart_data($user_id,$cart_id)
	{
		//clear product cart data
		$this->db->where("id",$cart_id);
		$this->db->where("member_id",$user_id);
		$this->db->delete("tbl_events_cart");
		//echo $this->db->last_query();exit;
	}
	
	function get_event_pay_later_details($userid,$id)
	{
		$this->db->select('*');
		$this->db->from('tbl_events_cart');
		$this->db->where('tbl_events_cart.id',$id);
		$this->db->where('tbl_events_cart.member_id',$userid);
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
					'event_name' => $pay_later_list_data[$i]['event_name'],
					'event_id' => $pay_later_list_data[$i]['event_id'],
					'user_id' => $pay_later_list_data[$i]['member_id'],
					'cart_id' => $pay_later_list_data[$i]['id'],
					'order_price' => $pay_later_list_data[$i]['event_price'],
					'name' => $pay_later_list_data[$i]['member_name'],
					'event_seat_booked' => $pay_later_list_data[$i]['event_seat_booked'],
					'event_created_date' => date('Y-m-d'),
				);
				$insert = $this->db->insert('tbl_event_pay_later', $pay_later_data[$i]);
				
				$order_id = $this->db->insert_id();
				
				//$product_counter = 1;
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
	
	public function get_event_seats($id)
	{
		$this->db->select('event_seat_booked');
		$this->db->from('tbl_order_event');
		$this->db->where('event_id',$id);
		$query = $this->db->get();
		//print_r($query->result_array());exit;
		return $query->result_array();
		
	}
	
	public function update_left_seats($total_left_seats,$id)
	{
		$data = array('left_seats' => $total_left_seats);
		$this->db->where('id', $id);
		$this->db->update($this->tbl_events, $data);
		//echo $this->db->last_query();exit;
	}
	
	public function get_event_seat_booked($id)
	{
		$this->db->select('event_seat_booked,user_id');
		$this->db->from('tbl_event_pay_later');
		$this->db->where('event_id',$id);
		
		//$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	public function get_event_order_seat_booked($id)
	{
		$this->db->select('event_seat_booked,user_id');
		$this->db->from('tbl_order_event');
		$this->db->where('event_id',$id);
		
		//$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function get_event_order_details_1($userid)
	{
		$this->db->select('*');
		//$this->db->select("Sum(event_price) as total");
		$this->db->from('tbl_events_cart');
		//$this->db->where('tbl_events_cart.id',$id);
		$this->db->where('tbl_events_cart.member_id',$userid);
		//$this->db->join('tblshop_cart_product', 'tblshop_cart_product.shop_cart_id = tblshop_cart.shop_cart_id', 'right');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$car_list_data = $query->result_array();
		//print_r($car_list_data);exit;

		$order_session_id = "";
		if($query -> num_rows() > 0)
		{
			for($i=0;$i<count($car_list_data);$i++)
			{
				if($car_list_data[$i]['id'] != '')
				{
					$order_data[] = array(
						'order_eventname' => $car_list_data[$i]['event_name'],
						'event_id' => $car_list_data[$i]['event_id'],
						'user_id' => $car_list_data[$i]['member_id'],
						'event_register_id' => $car_list_data[$i]['event_register_id'],
						'cart_id' => $car_list_data[$i]['id'],
						'order_price' => $car_list_data[$i]['event_price'],
						'order_GST' =>$car_list_data[$i]['event_GST'],
						'order_purchase_number' =>$car_list_data[$i]['event_purchase_order_number'],
						'name' => $car_list_data[$i]['member_name'],
						'event_seat_booked' => $car_list_data[$i]['event_seat_booked'],
						'order_created_date' => date('Y-m-d'),
						'event_payment_status' => 'Waiting',
					);
					$insert = $this->db->insert('tbl_order_event', $order_data[$i]);
					$order_id = $this->db->insert_id();
					$order_session_id =$order_session_id ."#".$order_id;
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
			/*$order_session_id = array(
					'id'=> $order_id,
				);*/
				//$order_session_id[]= $order_id;
			/**/
			$this->load->model("eventsModel");	
			$this->eventsModel->events_left_seated1($userid);	
			/**/
				
			$this->clear_cart_data_1($userid);
			//$order_session_id =substr($order_session_id,1);
			return $order_session_id;
		}
	
	}
	public function clear_cart_data_1($user_id)
	{
		//clear product cart data
		$this->db->where("member_id",$user_id);
		$this->db->delete("tbl_events_cart");
		//echo $this->db->last_query();exit;
	}
}
?>