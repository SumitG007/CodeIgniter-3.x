<?php

	
	class BasiclistModel extends CI_Model {
		
		function Services()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
 
function getPosts(){
  $this->db->select("company_name, company_telephone");
  $this->db->order_by("company_name", "asc");
  $this->db->from('tbl_members');
  $query = $this->db->get();
  return $query->result();
}
 
}

?>