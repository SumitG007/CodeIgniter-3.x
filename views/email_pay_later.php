<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BOMA</title>
<link rel="Shortcut Icon" href="<?php echo base_url(); ?>images/gl.ico" type="image/x-icon" />
</head>
<body> 
  <div style="float:none; margin:0 auto;width:600px;">
    	 <!---Header Start--->
    	<div style="float:left;background: #f6f6f6; padding:10px; width:100%;">
        	<div style="float:left;width:580px; background:#fff; padding:10px;">
            	<div style="float:left;"><img src="<?php echo base_url(); ?>images/logo.jpg" /></div>
                
            </div>
            <!---Header End--->
            <div style="float:left; width:580px; background:#fff; margin-top:5px;padding:10px; font-family:Arial, Helvetica, sans-serif;" >
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;"> Dear <?php echo $name; ?>,</p>
            <?php /*?><h1 style="font-size:16px; color:orange; margin:5px 0px;">We are glad to inform you that your payment of $600.00 has been recevied. We acknowledge your payment made through check.</h1><?php */?>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">We are pleased to inform you that we have received your inquiry regarding job posting on our website.<br/> Our team will further evaluate the details and we will be soon sending you email for payment.</p>
           <!-- <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;"><strong>Username : </strong><?php echo "test"; ?></p>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;"><strong>Password : </strong><?php echo $password; ?></p>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">Please use the below link to visit the login page on our website.<br />
            <a href="http://boma.mydatavault.ca/members/login/">http://boma.mydatavault.ca/members/login/</a></p>-->
            
        <form name="paypalform" action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post">
        <input name = "cmd" value = "_cart" type = "hidden">
        <INPUT TYPE="hidden" name="charset" value="utf-8">
        <input name = "rm" value = "2" type = "hidden">
        <input name = "business" value = "info@thenetgurus.com" type = "hidden">
        <!--<input name = "handling_cart" value = "0" type = "hidden">-->
        <input name = "currency_code" value = "CAD" type = "hidden">
        <input name = "return" value = "http://boma.mydatavault.ca/events/create_order1/" type = "hidden">
        <input name = "cbt" value = "Return to Boma Site" type = "hidden">
        <input type="hidden" name="upload" value="1">
        <!--<input name = "cancel_return" value = "http://boma.mydatavault.ca/" type = "hidden">
        <input name = "custom" value = "" type = "hidden">-->
        
		<?php 

			//print_r($events_cart); //exit;
			if(count($events_cart) > 0)
			{
			for($i=0;$i<count($events_cart);$i++) 
			{ 
				$row = $events_cart[$i];
				//print_r($row);
				$cnt=$i+1;
			
				?>
				<input type="hidden" name="item_name_<?php echo $cnt;?>" value="<?php echo $row->event_name;?>" />
				<input type="hidden" name="amount_<?php echo $cnt;?>" value="<?php echo $row->event_price;?>CAD" />
                <input type="hidden" name="qty_<?php echo $cnt;?>" value="1">
				<?php 
			} 
			}else{ ?>
				<input type="hidden" name="item_name" value="Payment Completed" />
           <?php
			}

		?> 
        <?php //print_r($events_cart); ?>
       <?php /*?> <input type="hidden" name="event_name" value="<?php echo $events_cart[0]->event_name;?>">
        <input type="hidden" name="member_name" value="<?php echo $events_cart[0]->member_name;?>">
        <input type="hidden" name="event_type" value="<?php echo $events_cart[0]->event_type;?>">
        <input type="hidden" name="event_price" value="<?php echo $events_cart[0]->event_price;?>"><?php */?>
       
       <!-- <input type="hidden" name="country" value="Canada" />-->
        <input type="submit" value="PayPal">
        
        </form>
        
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">We thank you for sending us your request to post job on our website. </p>
            
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">Thanking You,<br>BOMA Team</p>
          </div>
           <!---Content End--->
          <div style="float:left;width:580px; background:#fff; padding:10px; margin-top:5px;">
               <div style="float:none; margin:0 auto; width: 490px;">
             </div>
          </div>
        </div>
    </div>
 
 
</body>
</html>    