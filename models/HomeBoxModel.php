<?php
	class HomeBoxModel extends CI_Model
	{
	
		private $tbl_homecontent = 'tbl_homecontent';
	
		function Menu()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_home_content()
		{	$this->db->order_by('id','asc');
			$res = $this->db->get('tbl_homecontent');
			return $res;			
		}
		
	
		function count_all()
		{
			return $this->db->count_all($this->tbl_homecontent);
		}
	
		function get_by_id($id)
		{
			$this->db->where('id', $id);
			return $this->db->get($this->tbl_homecontent);
		}
	
		function save($category)
		{
			$this->db->insert($this->tbl_homecontent, $category);
			return $this->db->insert_id();
		}
	
		function update($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_homecontent, $data);
		}
		function deactive($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_homecontent, $data);
		}
		function active($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_homecontent, $data);
		}
	
		function delete($id)
		{
			$this->db->where('id', $id);
			$this->db->delete($this->tbl_homecontent);
		}
		
		function update_menu($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->tbl_homecontent, $data);
		}
		
		

	}
?>