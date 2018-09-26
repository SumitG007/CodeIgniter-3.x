<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*////////////////////////////////////////// SEND MAIL //////////////////////////////////////////////*/
if ( ! function_exists('sendMail'))
{
    function sendMail($toEmail,$toName,$fromEmail,$fromName,$subject,$message)
    { 	
		//return;//only for local please remove from live
		$CI =& get_instance();
		// load library 
		$config = Array(
			'protocol' => 'smtp',	
            'smtp_host' => 'ssl://gsf.websitewelcome.com',
        	'smtp_port' => 465,
        	'smtp_user' => 'info@boma.mydatavault.ca',
       		'smtp_pass' => 'boma@1234',
			'mailtype'  => 'html', 
			'crlf'  => '\r\n', 
			'newline'  => '\r\n', 
			'wordwrap'  => TRUE, 
			'starttls'  => FALSE, 
			'charset'   => 'iso-8859-1'
		  
		);
		$CI->load->library('email',$config); 
		$CI->email->initialize($config);
		$CI->email->set_newline("\r\n");
		$CI->email->from($fromEmail, $fromName);
		$CI->email->subject($subject);
		$CI->email->message($message);	
		$CI->email->to($toEmail); 
		/*if($ccEmail!='')
		{
			$CI->email->cc($ccEmail,$ccName);
		}
		if($bccEmail!='')
		{
			$CI->email->bcc($bccEmail,$bccName);
		}*/
		//print_r($CI->email->send());exit;
		$CI->email->send();
		return;
    }   
}
if ( ! function_exists('get_mail_template'))
{
	function get_mail_template($template_id) 
	{
		$CI =& get_instance();
		
		$CI->db->select("*");
		$CI->db->where('template_id', $template_id);		 
		$CI->db->where('active', 0);		 
		$CI->db->from('tblmail_template');
		$query = $CI->db->get();			
		$ArrTempalte = $query->result_array();		
		return $ArrTempalte[0];
	}
}
if ( ! function_exists('get_mail_body'))
{
	function get_mail_body($mail_body,$findstring="",$replacestring="")
	{
		return str_replace($findstring,$replacestring,$mail_body);
	}
}

/*////////////////////////////////////////// CC & BCC EMAIL //////////////////////////////////////////////////////*/
/*if ( ! function_exists('get_ccbcc_emails'))
{
	function get_ccbcc_emails($type="cc",$ArrTemplate=array(),$ArrAdmin=array(),$ArrSS=array(),$ArrCustomer=array(),$ArrTeamMember=array(),$ArrBD=array(),$ArrPMVednor=array())
	{
		
		$email = '';
		$name = '';
		if($ArrTemplate['admin_email_y_n']=='Y' && $ArrTemplate['admin_email_type']==$type && count($ArrAdmin)>0)
		{
			if($email!='')
				$email .= ',';
			if($name!='')
				$name .= ',';
			$email .= $ArrAdmin['admin_email'];
			$name .= 'Administrator';
		}
	
		if($ArrTemplate['user_email_y_n']=='Y' && $ArrTemplate['user_email_type']==$type && count($ArrCustomer)>0)
		{
			if($email!='')
				$email .= ',';
			if($name!='')
				$name .= ',';
			$email .= $ArrCustomer['alternate_email'];
			$name .= $ArrCustomer['login_name'];
		}
		
		$TempArray['email'] = $email;
		$TempArray['name'] = $name;
		//echo "<pre>";print_r($ArrTemplate);
		return $TempArray;
	}
}*/