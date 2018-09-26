<?php
Class JobsModel extends CI_Model
{
	
	private $table = 'tbl_jobs';
			
	function __construct()
	{  	
		parent::__construct(); 
	}
	
	function get_by_job_id($mid)
	{
		$this->db->where('mid', $mid);
		$this->db->where('postedby', 'member');
		return $this->db->get($this->table);
	}
		
	function get_paged_list_pending($limit = 8, $offset = 0)
	{
		$this->db->order_by('jid','asc');
		$this->db->where('status', 'pending');
		$this->db->where('postedby', 'member');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_pending()
	{		
		$this->db->where('status', 'pending');
		$this->db->where('postedby', 'member');
		//$this->db->or_where('status', 'create_user'); 
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_pending_nonmembers($limit = 8, $offset = 0)
	{
		$this->db->order_by('jid','asc');
		$this->db->where('status', 'pending');
		$this->db->where('postedby', 'guest');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_pending_nonmembers()
	{		
		$this->db->where('status', 'pending');
		$this->db->where('postedby', 'guest');
		//$this->db->or_where('status', 'create_user'); 
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_approved($limit = 8, $offset = 0)
	{
		$this->db->order_by('jid','asc');
		$this->db->where('postedby', 'member');
		$this->db->where('status !=', 'pending');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_approved()
	{		
		$this->db->where('postedby', 'member');
		$this->db->where('status !=', 'pending'); 
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_approved_nonmembers($limit = 8, $offset = 0)
	{
		$this->db->order_by('jid','asc');
		$this->db->where('postedby', 'guest');
		$this->db->where('status !=', 'pending');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_approved_nonmembers()
	{		
		$this->db->where('postedby', 'guest');
		$this->db->where('status !=', 'pending'); 
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_approved_all($limit = 8, $offset = 0)
	{
		//$dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
		//$date1 = $dt->format('H:i:s');// exit;
		//echo $date1;//exit;
		$date = date('Y-m-d');
		//echo $date;
		//if($date1 == '00:00:01' && isset($date))
		//{
			$date2 = date('Y-m-d');	
			//echo $date2;exit;
			$this->db->select("*");
			$this->db->from('tbl_jobs');
			$this->db->order_by('jid','asc');
			
			$this->db->where('status', 'approved');
			//$this->db->where('start_date >=', $date);
			$this->db->where('start_date', $date);
			$this->db->or_where('start_date <', $date);
			
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() > 0) 
			{
				return $query->result_array();
			}	
				//echo $this->db->last_query();exit;
		
		//}else{
			/*$date2 = date('Y-m-d');	
			$this->db->select("*");
			$this->db->from('tbl_jobs');
			$this->db->order_by('jid','asc');
			
			$this->db->where('status', 'approved');
			$this->db->where('start_date >=', $date2);
			
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() > 0) 
			{
				return $query->result_array();
			}		*/
			
		//}
	}
	
	function delete_curentdate_jobs()
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
		}else{
			$date = date('Y-m-d');	
			//echo $date;exit;
			$this->db->where('end_date <', $date);
			$this->db->delete('tbl_jobs');
		}
	}
		
	function count_all_approved_all()
	{		
		$this->db->where('status !=', 'pending'); 
		return $this->db->count_all_results($this->table);
	}
	
	function get_by_id($id)
	{
		$this->db->where('jid', $id);
		return $this->db->get($this->table);
	}
		
	function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function save_jobs($data)
	{
		$this->db->insert('tbl_jobs', $data);
		return $this->db->insert_id();
	}	
			
	function update($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
	}	
	
	function send_invoice($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
	}
	
	function active($id)
	{
		$this->db->where('jid', $id);
		return $this->db->get($this->table);
	}	
	
	function create_user($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
	}	
		
	function delete($id)
	{		
		$this->db->where('jid', $id);
		$this->db->delete($this->table);			
	}
	
	function disable_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
	}
	
	function enable_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
	}
	
	function get_company_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tbl_members');
	}
	
	function get_job_list_approved($id)
	{
		//$this->db->order_by('jid','asc');
		$this->db->where('jid', $id);
		$this->db->where('postedby', 'member');
		$this->db->where('status !=', 'pending');
		return $this->db->get($this->table);
		//echo $this->db->last_query();exit;
	}
	
	function update_approval_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
		//echo $this->db->last_query();exit;
	}
	
	function get_nonmember_job_list_approved($id)
	{
		//$this->db->order_by('jid','asc');
		$this->db->where('jid', $id);
		$this->db->where('postedby', 'guest');
		$this->db->where('status !=', 'pending');
		return $this->db->get($this->table);
		//echo $this->db->last_query();exit;
	}
	
	function update_nonmember_approval_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
		//echo $this->db->last_query();exit;
	}
	
	function get_member_job_list_pending($id)
	{
		//$this->db->order_by('jid','asc');
		$this->db->where('jid', $id);
		$this->db->where('postedby', 'member');
		$this->db->where('status', 'pending');
		return $this->db->get($this->table);
		//echo $this->db->last_query();exit;
	}
	
	function update_member_pending_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
		//echo $this->db->last_query();exit;
	}
	
	function get_nonmember_job_list_pending($id)
	{
		//$this->db->order_by('jid','asc');
		$this->db->where('jid', $id);
		$this->db->where('postedby', 'guest');
		$this->db->where('status', 'pending');
		return $this->db->get($this->table);
		//echo $this->db->last_query();exit;
	}
	
	function update_nonmember_pending_jobs($id, $data)
	{
		$this->db->where('jid', $id);
		$this->db->update($this->table, $data);
		//echo $this->db->last_query();exit;
	}
	function insert_jobs($data)
	{
		$this->db->insert('tbl_jobs', $data);
		return $this->db->insert_id();
	}
}
?>