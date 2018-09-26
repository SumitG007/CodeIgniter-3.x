<script type="text/javascript">
	function Frmsubmit()
	{
		 //$('#id1').attr('src', 'new/file/link.png');

		var success_id = "";
        var member_id = $("#member_id").val();

        $.ajax({
            async: false,
            type:"get",
            url: "<?php echo base_url(); ?>events/events_booked_record",
			data: 'member_id='+ member_id,
            success: function(data)
			{
				success_id = data;
            }
        });
		if(success_id !="")
		{
			$("#item_number").val(success_id);
            //$("#"+form_id+" #cancel_return").val($("#"+form_id+" #cancel_return").val()+"/"+success_id);
			document.paypalform.submit();
        }
		else
		{
            alert('Please retry');
        }

		//document.paypalform.submit();
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
	<!--form name="paypalform" action = "<?php echo base_url(); ?>events/payNotify" method = "post"!-->
        <input name = "cmd" value = "_cart" type = "hidden">
		<INPUT TYPE="hidden" name="charset" value="utf-8">
        <input name = "rm" value = "2" type = "hidden">
        <input name = "business" value = "msackney@bomaedm.ca" type = "hidden">
        <!--<input name = "handling_cart" value = "0" type = "hidden">-->
        <input name = "currency_code" value = "CAD" type = "hidden">
        <input  type="Hidden" name="notify_url" value="<?php echo base_url(); ?>events/payNotify">
        <input name = "return" value = "<?php echo base_url(); ?>events/event_thanks/" type = "hidden">
        <input name = "cbt" value = "Return to Boma Site" type = "hidden">
        <input type="hidden" name="upload" value="1">
        <!--<input name = "cancel_return" value = "http://boma.mydatavault.ca/" type = "hidden">
        <input name = "custom" value = "" type = "hidden">-->
        <input type="hidden" name="item_id" id="item_id" value="" />
        <input type="hidden" name="item_number_1" id="item_number" value="" />
		<?php 

			for($i=0;$i<count($events_cart);$i++) 
			{ 
				$row = $events_cart[$i];
				//print_r($row);
				$cnt=$i+1;
				$total_price = $row->event_price + $row->event_GST;
				//echo $total_price;exit;
				?>
				
				<input type="hidden" name="item_name_<?php echo $cnt;?>" value="<?php echo $row->event_name;?>" />
				<input type="hidden" name="amount_<?php echo $cnt;?>" value="<?php echo $total_price;?>" />
                <input type="hidden" name="qty_<?php echo $cnt;?>" value="1">
				<?php 
			} 

		?> 
        <?php //print_r($events_cart); ?>
       <?php /*?> <input type="hidden" name="event_name" value="<?php echo $events_cart[0]->event_name;?>">
        <input type="hidden" name="member_name" value="<?php echo $events_cart[0]->member_name;?>">
        <input type="hidden" name="event_type" value="<?php echo $events_cart[0]->event_type;?>">
        <input type="hidden" name="event_price" value="<?php echo $events_cart[0]->event_price;?>"><?php */?>
       
	   <input type="hidden" name="member_id" id ="member_id" value="<?php echo $events_cart[0]->member_id;?>">
	   
       <!-- <input type="hidden" name="country" value="Canada" />-->
        <!--<input type="submit" value="PayPal">-->
        </form>
        
		</div>
        </div>
       </div>
        
</body>
</html>
            