<?php 
	 function Is_domain_exists($domain)
	 {
	   if($domain!=''){
	   if(strstr($domain,'http://')=='' && strstr($domain,'https://')=='')
			$domain = "http://".$domain;
	   $domainvals = parse_url ( $domain );
	   $hostName = $domainvals['host'];
	   $hostName=str_replace("www.", '', $hostName)  ;
	   }else{
	   $hostName = '';
	   }
       if(!empty($hostName)) {
     
           $app  ="nslookup -type=A $hostName";

           @exec("nslookup -type=A -timeout=10 " . $hostName , $lookup);
         
                    foreach ($lookup as $line) {
                        if (strstr($line, $hostName)) {
                            return 'Y';
                        }
                    }
           return 'N';
     
         }else{
             return 'N';
         }
    }
	
	
	 function Is_email_exists($email)
	 {

		//require_once('smtp_validateEmail.class.php');

        // an optional sender
        $sender = 'volusion@qetail.com';
        // instantiate the class
        $SMTP_Validator = new SMTP_validateEmail();
        // turn on debugging if you want to view the SMTP transaction
        $SMTP_Validator->debug = false;
        // do the validation
        $results = $SMTP_Validator->validate(array($email), $sender);
        
       // echo "------------test".$email;echo "<pre>jjjj";print_r($results);exit;
        // send email? 
        if ($results[$email]) {
            return 'Y';
        } else {
          return 'N';
        }
	return 'N';

    }
?>