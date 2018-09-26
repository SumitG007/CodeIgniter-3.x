<script type="text/javascript">
	function Frmsubmit()
	{
		 //$('#id1').attr('src', 'new/file/link.png');
		document.paylaterform.submit();
	}
	
</script>
<body onLoad="javascript:Frmsubmit();">
<div class="container" style="margin-bottom:30px;">
    
    
     <form name="paylaterform" action = "http://bomaedmonton.org/events/create_order1" method = "post">
       
        <!--<input name = "cancel_return" value = "http://bomaedmonton.org/" type = "hidden">
        <input name = "custom" value = "" type = "hidden">-->
        
		<?php 

			//print_r($events_cart); //exit;
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

		?> 
        <?php //print_r($events_cart); ?>
       <?php /*?> <input type="hidden" name="event_name" value="<?php echo $events_cart[0]->event_name;?>">
        <input type="hidden" name="member_name" value="<?php echo $events_cart[0]->member_name;?>">
        <input type="hidden" name="event_type" value="<?php echo $events_cart[0]->event_type;?>">
        <input type="hidden" name="event_price" value="<?php echo $events_cart[0]->event_price;?>"><?php */?>
       
       <!-- <input type="hidden" name="country" value="Canada" />-->
        <!--<input type="submit" value="PayPal">-->
        </form>
        
           <?php /*?><div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2>Thanks for paying later successfully.</h2>
                    <h3></h3>
                </div>
            </div>
            <hr>
            </div><?php */?>
</div>
