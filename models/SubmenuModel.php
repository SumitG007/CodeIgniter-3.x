<?php
	class SubmenuModel extends CI_Model
	{
	
		private $tbl_subcategory = 'tbl_subcategory';
	
		function Home()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_subcategory($id)
		{			
			$this->db->order_by('no','asc');
			$this->db->where('cid', $id);
			return $this->db->get($this->tbl_subcategory);			
		}
	
		function count_all()
		{
			return $this->db->count_all($this->tbl_subcategory);
		}
	
		function get_by_id($id)
		{
			$this->db->where('scid', $id);
			return $this->db->get($this->tbl_subcategory);
		}
	
		function save($subcategory)
		{
			$this->db->insert($this->tbl_subcategory, $subcategory);
			return $this->db->insert_id();
		}
	
		function update($id, $subcategory)
		{
			$this->db->where('scid', $id);
			$this->db->update($this->tbl_subcategory, $subcategory);
		}
		function deactive($id, $subcategory)
		{
			$this->db->where('scid', $id);
			$this->db->update($this->tbl_subcategory, $subcategory);
		}
		function active($id, $subcategory)
		{
			$this->db->where('scid', $id);
			$this->db->update($this->tbl_subcategory, $subcategory);
		}
	
		function delete($id)
		{
			$this->db->where('scid', $id);
			$this->db->delete($this->tbl_subcategory);
			  
		}
		
		function update_submenu($id, $cat)
		{
			$this->db->where('scid', $id);
			$this->db->update($this->tbl_subcategory, $cat);
		}

	}
?>