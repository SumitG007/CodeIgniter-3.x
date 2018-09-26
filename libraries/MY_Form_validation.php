<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

	/*function is_unique($str, $value){       
	  list($table, $column) = explode('.', $value, 2);    
	  $query = $this->CI->db->query("SELECT COUNT(*) AS count FROM $table WHERE $column = '$str'");
	  $row = $query->row();
	   if($row->count > 0){  $this->set_message('is_unique', 'The email address already in use. Please enter another valid email id.'); return FALSE; }  return TRUE;
	}*/

	 public function is_unique($str, $field) {
        $field_ar = explode('.', $field);
        $query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
        if ($query->num_rows() === 0) {
			 $this->set_message('is_unique', 'The email address already in use. Please enter another valid email id.');
            return TRUE;
        }

        return FALSE;
    }
	
	public function url_exists($url){                                   
        $url_data = parse_url($url); // scheme, host, port, path, query
        if(!@fsockopen($url_data['host'], isset($url_data['port']) ? $url_data['port'] : 80)){
            $this->set_message('url_exists', 'The URL you entered is not accessible.');
            return FALSE;
        }               
         
        return TRUE;
    } 
	
	function is_unique1($str, $value){       
	  list($table, $column) = explode('.', $value, 2);    
	  $query = $this->CI->db->query("SELECT COUNT(*) AS count FROM $table WHERE $column = '$str'");
	  $row = $query->row();
	   if($row->count > 0){  $this->set_message('is_unique', 'The services already in use. Please enter another services.'); return FALSE; }  return TRUE;
	}

	
}
?>