<?php
class EmailModel extends CI_Model 
{
	
	private $tbl_events = 'tblmail_template';
	
	function Menu()
	{  
		// Call the Model constructor  
		parent::CI_Model();  
	}	
	
	function get_emails()
	{	$this->db->order_by('template_id','asc');
		$res = $this->db->get('tblmail_template');
		return $res;			
	}
	
	function count_all()
	{
		return $this->db->count_all($this->tblmail_template);
	}
		
	public function update_email_template($template_id,$data)
	{
		$this->db->where('template_id', $template_id);
		$update = $this->db->update('tblmail_template', $data);			
		$report = array();

		if($report !== 0){
			return true;
		}else{
			return false;
		}  
	}
	
	public function get_email_template_by_id($template_id)
    {
		$this->db->select('*');
		$this->db->from('tblmail_template');
		$this->db->where('template_id', $template_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	
	
}