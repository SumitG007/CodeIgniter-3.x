<?php
error_reporting(0);
Class MembersModel extends CI_Model
{
	
	private $table = 'tbl_members';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
		
	function get_paged_list_pending($limit = 8, $offset = 0)
	{
		$this->db->order_by('company_name','asc');
		$this->db->where('status', 'send_invoice');
		$this->db->or_where('status', 'create_user'); 
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_pending()
	{		
		$this->db->where('status', 'send_invoice');
		$this->db->or_where('status', 'create_user'); 
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_sort($limit = 8, $offset = 0, $val)
	{
		$this->db->order_by('company_name','asc');
		
		$this->db->like('company_name', $val, 'after');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_sort($val)
	{
		
		$this->db->like('company_name', $val, 'after');
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_approved($page,$offset, $searchString)
	{
		
		$this->db->select('*');
		$this->db->from($this->table);
		
		if($searchString!='')
			$this->db->where($searchString, NULL, FALSE);
		$this->db->where('status', 'approved'); 
		$this->db->order_by('id','asc');
		$this->db->limit($page,$offset);
		//echo $this->db->last_query();//exit;
		$query_result = $this->db->get();	
		//echo $this->db->last_query();exit;
		if($query_result->num_rows() > 0) 
		{
			$i = 0;
			foreach ($query_result->result_array() as $row)
			{
				foreach($row as $key=>$val)
				{
					$ArrTemp[$key] = $val; 
				}
				$sdata[$i++] = $ArrTemp;
			}				
			return $sdata;
		} else {
			return false;	
		}
	}
	
	function get_paged_list_approved1()
	{
		$this->db->order_by('company_representative','desc');
		$this->db->where('status !=', 'send_invoice');
		$this->db->where('status !=', 'create_user');
		return $this->db->get($this->table);
	}
	
	function count_all_approved($searchString)
	{	
		/*if($searchString!='')
			$this->db->where($searchString, NULL, FALSE);
		$this->db->where('status', 'approved'); 
		return $this->db->count_all_results($this->table);*/
		
		$this->db->select('*');
		$this->db->from($this->table);
		
		if($searchString!='')
			$this->db->where($searchString, NULL, FALSE);
			
		$this->db->where('status', 'approved');
		$this->db->order_by('id','asc');
		$query_result = $this->db->get();		
		return $query_result->num_rows();
	}
	
	function get_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}
	
	function get_by_admin_id()
	{
		return $this->db->get('tbl_users');
	}
	
	
	
	function get_by_comp_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tbl_company_members');
	}
	
	function delete_member($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_company_members');
		
	}
	
	function get_by_job_id($id)
	{
		$this->db->where('jid', $id);
		return $this->db->get("tbl_jobs");
	}
		
	function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function save_members($data)
	{
		$this->db->insert('tbl_company_members', $data);
		return $this->db->insert_id();
	}	
			
	function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}	
	
	function update_member_data($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		//echo $this->db->last_query();//exit;
	}
	
	function update_members($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_company_members', $data);
	}
	
	function update_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update('tbl_jobs', $data);
	}
	
	function send_invoice($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}	
	
	function create_user($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}	

	
	function change_pass($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}	
		
	function delete($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete($this->table);			
	}
	
	function delete_post_job($id)
	{		
		$this->db->where('jid', $id);
		$this->db->delete("tbl_jobs");			
	}
	function disable_member($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	
	function enable_member($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	
	function check_username($username)
	{
		$sql = "SELECT Id FROM tbl_members where Email = '".$username."'";		
		$query = $this->db->query($sql);
		return $query->num_rows();
	}	
	
	function check_email($email)
	{
		$sql = "SELECT Id FROM tbl_members where company_email = '".$email."'";		
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function check_email1($email)
	{
		$sql = "SELECT Id FROM tbl_members where company_email = '".$email."'";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function isEmailExist($email) {
		$this->db->select('id');
		$this->db->where('company_email', $email);
		$query = $this->db->get('tbl_members');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function isserviceSelect1($sid1) {
		$this->db->select('*');
		$this->db->where('service1', $sid1);
		$query = $this->db->get('tbl_members');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function isserviceSelect2($sid2) {
		$this->db->select('*');
		//$where = array();
		$this->db->where('service2', $sid2 );
		$query = $this->db->get('tbl_members');
		
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function isserviceSelect3($sid3) {
		$this->db->select('*');
		$this->db->where('service2', $sid3);
		$query = $this->db->get('tbl_members');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function login($email,$password)
		{
			if($email && $password != "")
			{
				$this -> db -> select('id,company_name,company_representative,company_email,membership_type,member_username,status,createdon');
				$this -> db -> from('tbl_members');
				$this -> db -> where('company_email = '."'".$email."'");
				$this -> db -> where('member_password = '."'".$password."'");		
				$this -> db -> where("status = 'approved'");		
				$this -> db -> limit(1);
				
				$query = $this -> db -> get();
								
				if($query -> num_rows() == 1)
				{
					return $query->result();
				}
				else
				{
					return false;
				}
			}
		}
		#Get login details for forgot password functionality 
		public function forgot_pass($email)
		{
				$this -> db -> select('*');
				$this -> db -> from('tbl_members');
				$this -> db -> where('company_email = '."'".$email."'");
				$this -> db -> where("status = 'approved'");		
				$this -> db -> limit(1);
				
				$query = $this -> db -> get();
				return $query;					
	
		}
		
		
	
		
	function get_members_list()
	{
		$this->db->order_by('fullname','asc');
		return $this->db->get('tbl_company_members');
	}
	
	function get_submembers_list($id)
	{
		$this->db->order_by('fullname','asc');
		$this->db->where('cid', $id);
		return $this->db->get('tbl_company_members');
	}
	
	function save_post_jobs($data)
	{
		$this->db->insert('tbl_jobs', $data);
		//echo $this->db->last_query();exit;
		return $this->db->insert_id();
	}
	
		
	function get_posted_jobs_list($id)
	{
		$this->db->order_by('jid','asc');
		$this->db->where('mid', $id);
		return $this->db->get(' tbl_jobs');
	}
	
	function get_service_name($id)
	{
		$this->db->where('sid', $id);
		return $this->db->get('tbl_services');
	}
	
	function get_services_list()
	{	$this->db->select("sid,service_name");
		$this->db->from('tbl_services');
		$this->db->order_by('service_name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		{
			return $query->result_array();
		}			
	}
	function get_service1()
	{
		$this->db->select("sid,service_name");
		$this->db->from('tbl_services');
		$this->db->order_by('service_name','asc');
		//$this->db->limit(0,9);
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		{
			return $query->result_array();
		}			
	}
	
	public function list_service1($sid1)
	{
		$this->db->select("service_name");
		$this->db->from('tbl_services');
		$this->db->where('sid',$sid1);
		$query = $this->db->get();
		//print_r($query->result_array());exit;
		if($query->num_rows() > 0) 
		{
			return $query->result_array();
		}		
	}
	
	public function list_service2($sid2)
	{
		$this->db->select("service_name");
		$this->db->from('tbl_services');
		$this->db->where('sid',$sid2);
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		{
			return $query->result_array();
		}		
	}
	
	public function list_service3($sid3)
	{
		$this->db->select("*");
		$this->db->from('tbl_services');
		$this->db->where('sid',$sid3);
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}		
	}
	
	
	function search_services($keyword)
	{
		$searchString = '';
		$this->db->select('sid,service_name');
		$this->db->from('tbl_services');
		$searchString .= " (service_name LIKE '".$keyword."%')";
		$this->db->where($searchString, NULL, FALSE);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0) 
		{
		return $query->result_array();
		}	
	}
	
	function service_details($service_id)
	{
		$this->db->select("*");
		$this->db->from('tbl_members');
		$this->db->order_by('company_name','asc');
		$this->db->where('service1',$service_id);
		$this->db->or_where('service2',$service_id);
		$this->db->or_where('service3',$service_id);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0) 
		{
			return $query->result_array();
		}		
	}
	
	function insert_images($upload_data = array()){
		//print_r();
      $data = array(
          'filename' => $upload_data['file_name'],
          'fullpath' => $upload_data['full_path']
      );
	  return $data;
	}
	function delete_cuurentdate_job()
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
			$this->db->where('end_date', $date);
			$this->db->delete('tbl_jobs');
		}
	}
	
	function get_member_data($email)
	{
		$this->db->where('company_email', $email);
		return $this->db->get($this->table);
	}
	
	function get_member_data_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}
	
	function get_booking_event_list($id)
	{
		//$this->db->order_by('jid','asc');
		$this->db->select("*");
		$this->db->from('tbl_order_event');
		$this->db->where('tbl_order_event.user_id', $id);
		//$this->db->join("tbl_event_pay_later","tbl_event_pay_later.event_id = tbl_order_event.event_id","join");
		//$this->db->or_where('tbl_event_pay_later.user_id', $id);
		$query = $this->db->get();
		 //echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	function member_job_details($id)
	{
		$this->db->where('mid', $id);
		return $this->db->get('tbl_jobs');
	}
	
	/*function upload_attachment_file($field_name,$user_id)
	{
		/* create folders start 
		$message_folder_path = "images/company/".$user_id."/";;
		if(!is_dir($message_folder_path))
		{
		  mkdir($message_folder_path,0755,TRUE);
		}
		/* FILE UPLOAD 
		$config['upload_path'] = $message_folder_path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name']  = time(); //rename file 

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($field_name))
		{
			$data = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
	
		/* FILE UPLOAD END 
		return $data;
	}*/
}
?>