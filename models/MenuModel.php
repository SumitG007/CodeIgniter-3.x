<?php
	class MenuModel extends CI_Model
	{
	
		private $tbl_category = 'tbl_category';
		private $tbl_subcategory = 'tbl_subcategory';
	
		function Menu()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_category()
		{	$this->db->order_by('no','asc');
			$res = $this->db->get('tbl_category');
			return $res;			
		}
		function get_subcategory($id)
		{
			
			$this->db->order_by('no','asc');
			$this->db->where('cid', $id);
			return $this->db->get($this->tbl_subcategory);			
		}
	
		function count_all()
		{
			return $this->db->count_all($this->tbl_category);
		}
	
		function get_by_id($id)
		{
			$this->db->where('cid', $id);
			return $this->db->get($this->tbl_category);
		}
	
		function save($category)
		{
			$this->db->insert($this->tbl_category, $category);
			return $this->db->insert_id();
		}
	
		function update($id, $category)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_category, $category);
		}
		function deactive($id, $category)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_category, $category);
		}
		function active($id, $category)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_category, $category);
		}
	
		function delete($id)
		{
			$this->db->where('cid', $id);
			$this->db->delete($this->tbl_category);
			$this->db->where('cid', $id);
			$this->db->delete($this->tbl_subcategory);
			
		}
		
		function update_menu($id, $cat)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_category, $cat);
		}
		
		

	}
?>