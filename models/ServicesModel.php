<?php
	class ServicesModel extends CI_Model
	{
	
		private $tbl_services = 'tbl_services';
	
		function Services()
		{  
			// Call the Model constructor  
			parent::CI_Model();  
		}	
	
		function get_services()
		{	$this->db->order_by('service_name','asc');
			$res = $this->db->get('tbl_services');
			return $res;			
		}
	
		function count_all()
		{
			return $this->db->count_all($this->tbl_services);
		}
		
		function get_services_list($char)
		{	$this->db->order_by('service_name','asc');
			$this->db->like('service_name', $char, 'after');
			$res = $this->db->get('tbl_services');
			return $res;			
		}
		
		/*function check_service_name($service_name)
		{
			$this->db->select('*');
			$this->db->from('tbl_services');
			$this->db->where('service_name',$service_name);
			$query = $this->db->get();
			//echo $this->db->last_query();//exit;
			if($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}*/
			
		function get_services_name()
		{	$this->db->select("sid,service_name");
			$this->db->from('tbl_services');
			$this->db->order_by('service_name','asc');
			$query = $this->db->get();
			if($query->num_rows() > 0) 
			{
				return $query->result_array();
			}			
		}
	
		function get_by_id($id)
		{
			$this->db->where('sid', $id);
			return $this->db->get($this->tbl_services);
		}
	
		function save($services)
		{
			$this->db->insert($this->tbl_services, $services);
			return $this->db->insert_id();
		}
	
		function update($id, $services)
		{
			$this->db->where('sid', $id);
			$this->db->update($this->tbl_services, $services);
		}
		
	
		function delete($id)
		{
			$this->db->where('sid', $id);
			$this->db->delete($this->tbl_services);
			
		}
		

	}
?>