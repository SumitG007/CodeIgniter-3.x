<?php
	class HomeModel extends CI_Model
	{
	
		private $tbl_home = 'homebanner';
		private $tbl_users = 'users';
		private $tbl_page = 'page';
			
		function Home()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
		function get_homebanner()
		{	
			$this->db->order_by('no','asc');
			$res = $this->db->get('homebanner');
			return $res;			
		}
		function get_pagelist()
		{	
			$this->db->order_by('pid','asc');
			$res = $this->db->get('page');
			return $res;			
		}
		function get_page($id)
		{
			$this->db->where('pid', $id);
			return $this->db->get($this->tbl_page);
		}
		function get_paged_list($limit = 8, $offset = 0)
		{
			$this->db->order_by('no','asc');
			return $this->db->get($this->tbl_home, $limit, $offset);
		}
		function count_all()
		{
			return $this->db->count_all($this->tbl_home);
		}
		function get_by_id($id)
		{
			$this->db->where('hid', $id);
			return $this->db->get($this->tbl_home);
		}	
		function save($home)
		{
			$this->db->insert($this->tbl_home, $home);
			return $this->db->insert_id();
		}			
		function update($id, $home)
		{
			$this->db->where('hid', $id);
			$this->db->update($this->tbl_home, $home);
		}		
		function delete($id)
		{
			$this->db->where('hid', $id);
			$this->db->delete($this->tbl_home);
			 //$query = $this->db->delete($this->tbl_home, array('id'=>$id));  
		}		
		function updatepage($id, $home)
		{
			$this->db->where('pid', $id);
			$this->db->update($this->tbl_page, $home);
		}
		function updatepass($id, $pass)
		{
			
			$this->db->where('id', $id);
			$this->db->update($this->tbl_users, $pass);
		}
		
		function update_banner($id, $home)
		{
			$this->db->where('hid', $id);
			$this->db->update($this->tbl_home, $home);
		}
		
		public function get_total_members()
		{
			$this->db->select('*');
			$this->db->from('tbl_members');
			$this->db->where('status','approved');
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		public function get_total_events()
		{
			return $this->db->count_all("tbl_events");
		}
		
		public function get_jobs_non_members()
		{
			$this->db->select('*');
			$this->db->from('tbl_jobs');
			$this->db->where('mid',0);
			$this->db->where('status','approved');
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		public function get_jobs_members()
		{
			$this->db->select('*');
			$this->db->from('tbl_jobs');
			$this->db->where('mid !=',0);
			$this->db->where('status','approved');
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		public function get_pending_members()
		{
			$this->db->select('*');
			$this->db->from('tbl_members');
			$this->db->where('status','create_user');
			$this->db->order_by('id','desc');
			$this->db->limit(10);
			$query = $this->db->get();
			return $query;
		}
		
		public function get_pending_job_members()
		{
			$this->db->select('*');
			$this->db->from('tbl_jobs');
			$this->db->where('status','pending');
			$this->db->where('mid !=',0);
			$this->db->order_by('jid','desc');
			$this->db->limit(10);
			$query = $this->db->get();
			return $query;
		}
		
		public function get_pending_job_nonmembers()
		{
			$this->db->select('*');
			$this->db->from('tbl_jobs');
			$this->db->where('status','pending');
			$this->db->where('mid',0);
			$this->db->order_by('jid','desc');
			$this->db->limit(10);
			$query = $this->db->get();
			return $query;
		}

	}
?>