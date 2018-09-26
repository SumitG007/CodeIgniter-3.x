<?php
	class PostModel extends CI_Model
	{
	
		private $tbl_home = 'tbl_blog_posts';
		private $tbl_users = 'users';
		private $tbl_page = 'page';
		private $tbl_tag = 'tbl_blog_tags';
		private $tbl_comment = 'tbl_comments';
		private $tbl_post_tags ='tbl_posts_tags';

		function Home()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
		function get_homebanner()
		{	
			$this->db->order_by('id','asc');
			$res = $this->db->get('tbl_blog_posts');
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
		function get_paged_list($limit = 20, $offset = 0)
		{
			$this->db->order_by('id','asc');
			return $this->db->get($this->tbl_home, $limit, $offset);
		}
		function get_tags_paged_list($slug,$limit =20, $offset =0)
		{
			$this->db->select('p.*');
			$this->db->join($this->tbl_home.' '.'p', 'pc.post_id=p.id');
			$this->db->join($this->tbl_tag.' '.'c', 'pc.tag_id=p.id');
			$this->db->where('p.status','enable');
			$this->db->where('c.slug',$slug);
			$this->db->group_by('pc.post_id');
			$this->db->order_by('p.published_at','asc');
			return $this->db->get($this->tbl_post_tags.' '.'pc', $limit,$offset);
		}

		function get_date_paged_list($date,$limit =20, $offset =0)
		{
			$this->db->like('published_at',$date);
			$this->db->order_by('published_at','asc');
			return $this->db->get($this->tbl_home, $limit,$offset);
		}
		function get_month_date()
		{
			$this->db->select('DATE_FORMAT(published_at, "%Y-%m") as month_date, published_at');
			$this->db->group_by('DATE_FORMAT(published_at, "%Y-%m")');
			$this->db->order_by('published_at','DESC');
			return $this->db->get($this->tbl_home);
		}

		function count_all()
		{
			return $this->db->count_all($this->tbl_home);
		}
		function get_by_id($id)
		{
			$this->db->where('id', $id);
			return $this->db->get($this->tbl_home);
		}
		function get_by_status($status)
		{
			$this->db->order_by('id','asc');
			$this->db->where('status', $status);
			return $this->db->get($this->tbl_home);
		}
		function get_by_slug($slug)
		{
			$this->db->order_by('id','asc');
			$this->db->where('slug', $slug);
			return $this->db->get($this->tbl_home);
		}	
		function save($home)
		{
			$this->db->insert($this->tbl_home, $home);
			return $this->db->insert_id();
		}
		function create_comment($home)
		{
			return $this->db->insert($this->tbl_comment, $home);
		}

		function get_comments($post_id)
		{
			$this->db->where('post_id', $post_id);
			return $this->db->get($this->tbl_comment);
		}

		function update($id, $home)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_home, $home);
		}		
		function delete($id)
		{
			$this->db->where('id', $id);
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
			$this->db->where('id', $id);
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