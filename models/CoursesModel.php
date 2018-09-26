<?php
	class CoursesModel extends CI_Model
	{
	
		private $tbl_courses = 'tbl_courses';
	
		function Menu()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_courses()
		{	$this->db->order_by('course_id','asc');
			$res = $this->db->get('tbl_courses');
			return $res;			
		}
		
		function count_all()
		{
			return $this->db->count_all($this->tbl_courses);
		}
	
		function get_by_id($id)
		{
			$this->db->where('cid', $id);
			return $this->db->get($this->tbl_courses);
		}
	
		function save($data)
		{
			$this->db->insert($this->tbl_courses, $data);
			return $this->db->insert_id();
		}
	
		function update($id, $category)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_courses, $courses);
		}
		function deactive($id, $courses)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_courses, $courses);
		}
		function active($id, $courses)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_courses, $courses);
		}
	
		function delete($id)
		{
			$this->db->where('cid', $id);
			$this->db->delete($this->tbl_courses);
			
		}
		
		function update_menu($id, $cat)
		{
			$this->db->where('cid', $id);
			$this->db->update($this->tbl_courses, $cat);
		}
		
		

	}
?>