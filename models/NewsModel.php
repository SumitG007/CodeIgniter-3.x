<?php
	class NewsModel extends CI_Model
	{
	
		private $tbl_news = 'tbl_news';
	
		function Menu()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_news()
		{	$this->db->order_by('id','desc');
			$res = $this->db->get('tbl_news');
			return $res;			
		}
		
		function get_news_data()
		{	$this->db->order_by('id','desc');
			//$this->db->limit(2);
			$res = $this->db->get('tbl_news');
			return $res;			
		}
		
	
		function count_all()
		{
			return $this->db->count_all($this->tbl_news);
		}
	
		function get_by_id($id)
		{
			$this->db->where('id', $id);
			return $this->db->get($this->tbl_news);
		}
	
		function save($category)
		{
			$this->db->insert($this->tbl_news, $category);
			return $this->db->insert_id();
		}
	
		function update($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_news, $data);
		}
		function deactive($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_news, $data);
		}
		function active($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_news, $data);
		}
	
		function delete($id)
		{
			$this->db->where('id', $id);
			$this->db->delete($this->tbl_news);
		}
		
		function update_menu($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_news, $data);
		}
		
		

	}
?>