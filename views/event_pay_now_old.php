<script type="text/javascript">
	function Frmsubmit()
	{
		 //$('#id1').attr('src', 'new/file/link.png');
		document.paypalform.submit();
	}
	
</script>
<body onLoad="javascript:Frmsubmit();">
<div class="qetail_content_mn">
    <div class="qetail_pagemn" style="width:auto;"> 
      <div class="my_ordermn2">
      <div class="frmmn3">
      
        <h2 class="txt27">Checkout Processing</h2>
        <div>
        <img src="<?php echo base_url() ?>images/loading.gif" />
        </div>
        </div>
	
        
        <form name="paypalform" action = "https://www.paypal.com/cgi-bin/webscr" method = "post">
        <input name = "cmd" value = "_cart" type = "hidden">
        <INPUT TYPE="hidden" name="charset" value="utf-8">
        <input name = "rm" value = "2" type = "hidden">
        <input name = "business" value = "ckrywko@bomaedm.ca" type = "hidden">
        <!--<input name = "handling_cart" value = "0" type = "hidden">-->
        <input name = "currency_code" value = "CAD" type = "hidden">
        <input name = "return" value = "http://bomaedmonton.org/events/create_order/" type = "hidden">
        <input name = "cbt" value = "Return to Boma Site" type = "hidden">
        <input type="hidden" name="upload" value="1">
        <!--<input name = "cancel_return" value = "http://boma.mydatavault.ca/" type = "hidden">
        <input name = "custom" value = "" type = "hidden">-->
        
		<?php 

			//print_r($events_cart); //exit;
			for($i=0;$i<count($events_cart);$i++) 
			{ 
				$row = $events_cart[$i];
				//print_r($row);
				$cnt=$i+1;
				$total_price = $row->event_price + $row->event_GST;
				//echo $total_price;exit;
				?>
				<input type="hidden" name="item_name_<?php echo $cnt;?>" value="<?php echo $row->event_name;?>" />
				<input type="hidden" name="amount_<?php echo $cnt;?>" value="<?php echo $total_price;?>CAD" />
                <input type="hidden" name="qty_<?php echo $cnt;?>" value="1">
				<?php 
			} 

		?> 
        <?php //print_r($events_cart); ?>
       <?php /*?> <input type="hidden" name="event_name" value="<?php echo $events_cart[0]->event_name;?>">
        <input type="hidden" name="member_name" value="<?php echo $events_cart[0]->member_name;?>">
        <input type="hidden" name="event_type" value="<?php echo $events_cart[0]->event_type;?>">
        <input type="hidden" name="event_price" value="<?php echo $events_cart[0]->event_price;?>"><?php */?>
       
       <!-- <input type="hidden" name="country" value="Canada" />-->
        <!--<input type="submit" value="PayPal">-->
        </form>
        
		</div>
        </div>
       </div>
        
</body>
</html>
            