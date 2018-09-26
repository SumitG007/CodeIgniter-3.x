<style>
.countdown_timer_notification 
{
    background-color: #FFF9D0;
    border: 1px solid #FFE661;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    padding: 15px 0 11px 21px;
    color: #555;
    margin-bottom: 15px;
	height:56px;
}
.countdown_timer_notification div {
    float: left;
    font-size: 30px;
    line-height: 28px;
    margin-top: 3px;
}
.countdown_timer_notification p {
    float: left;
    margin-left: 16px;
    line-height: 15px;
    margin-top: 2px;
}
</style>
<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php if(isset($breadcrumb)) echo $breadcrumb; ?>
            </ol>
            <div class="row">
             <?php if(isset($events_register)){ foreach($events_register as $item){ ?>
                <div class="col-md-12 col-sm-12">
                    <h2><?php echo $item->event_name; ?></h2>
                    <h4>Location: <?php echo $item->event_location; ?> </h4>
					<h4>Date and Time: <?php echo date('d M Y',strtotime($item->start_date)); ?>, <?php echo $item->start_time." - ".$item->end_time; ?></h4>
                </div>
             <?php } } ?>
            </div>
            <hr>
       
             <div class="row">
             <div class="col-md-12 col-sm-12">
             <h3 style="margin-bottom:30px;"> Check Out</h3>
             </div>
             <form method="post">
                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive">
                    
                      <table class="table">
                      	<thead>
                        	<th>Event Name</th>
                            <th>Name</th>
                            <th>Total Price</th>
                            <th>Purchase Order Number</th>
                            <th>Action</th>
                        </thead>
                        <?php if(isset($events_cart)){ foreach($events_cart as $item1){ 
						//print_r($item1);
						$user_data = $this->session->userdata('logged_in_site');
						$eventid = $item1->event_id;
						?>
                        <input type="hidden" name="event_id" id="event_id" value="<?php echo $eventid; ?>"  />
                        <tr>
                        	<td> <?php echo $item1->event_name; ?> <?php /*?>(<?php echo date('d M Y',strtotime($item->start_date)); ?>)<?php */?> </td>
                            <td><?php echo $item1->member_name; ?></td>
                            <td> <?php
                                        $total_price = $item1->event_price; //echo $total_price;
                                        $tax_value = $item1->event_GST; //echo $tax_value;
                                    $total_event_price = $total_price + $tax_value; 
                                    echo number_format($total_event_price,2); ?> CAD </td>							
                            <td><?php echo $item1->event_purchase_order_number; ?></td>	
                            
                            <td><a href="<?php echo base_url(); ?>events/delete_event_cart/<?php echo $item1->member_id; ?>"><img src="<?php echo base_url(); ?>/images/remove.jpg" width='20' height='20'></a></td> 
                            
                        </tr>
                        <?php } }?>
                        
                        
                      </table>
                      
                    </div>
                    <?php
						$this->load->model('eventsModel');
						$get_event_status = $this->eventsModel->get_pay_status($eventid)->result();
						
					?>
                    <input type="hidden" name="event_left_seat" id="event_left_seat" value="<?php echo $get_event_status[0]->left_seats; ?>"  />
                    <!--div class="countdown_timer_notification clrfix" style="font-weight: normal;">
						<div id="time_left"></div>
						<p>Please complete registration within <span id="time_limit"></span> minutes.<br>
						After <span id="time_limit2"></span> minutes, the reservation we're holding will be released to others.</p>
		   </div!-->
                    <p> <?php
					if(count($get_event_status[0]->left_seats) > 0){
						if(isset($item1->id) && $item1->id != ''){  
						if($get_event_status[0]->event_payonline_status == 'Yes'){?> 
                        	<a href="<?php echo base_url(); ?>events/pay_now" id="pay_now"> <button type="button" class="btn btn-primary" >Pay Now</button></a><?php } ?>&nbsp; <?php if($get_event_status[0]->event_paylater_status == 'Yes'){ ?> <a id="pay_later"><button type="button" class="btn btn-primary" >Pay Later</button></a> <?php } 
						}
					}else{
						
						if($get_event_status[0]->left_seats == 0)
				   		{
							$this->eventsModel->clear_cart_data1($eventid);
					?>
                    <p style="text-align:left"><a href="<?php echo base_url(); ?>events/event_tickets" class="soldbtn">TICKETS SOLD OUT</a></p>
                   <?php  } 
					}
				   ?>
                   </p>
                    <p style="text-align:left;color:#F00000; font-weight:bold; font-size:20px;">Note: PayPal will redirect you back to our website do not close any windows</p>
                </div>
                </form>
            </div>
            
            
            
            
          </div>
    </div>
    
 <script type="text/javascript">
 	/*var orderTimeControl = {
            limit: 60,
            left: 60,
            now: new Date(),
            endTime: ''
        },
        gUpdateCountdownTimeoutId = null; //This global variable is a hack for #7215. Sorry

    orderTimeControl.endTime = new Date(orderTimeControl.now.getTime() + orderTimeControl.left*1000);
	function displayTime(field, numSeconds) {
        var timeMinutes = parseInt(numSeconds / 60, 10),
            timeSeconds = parseInt(numSeconds - timeMinutes*60, 10);

        if (timeSeconds < 10) {
            timeLabel   = timeMinutes + ":0" + timeSeconds + " ";
        } else {
            timeLabel   = timeMinutes + ":" + timeSeconds + " ";
        }

        document.getElementById(field).innerHTML = timeLabel;
    }

    displayTime("time_limit", orderTimeControl.limit);
    displayTime("time_limit2", orderTimeControl.limit);
    displayTime("time_left", orderTimeControl.left);


    /*function updateCountdown()
	{
        var now = new Date();

        if (now < orderTimeControl.endTime) {
            displayTime("time_left", (orderTimeControl.endTime - now)/1000);
            gUpdateCountdownTimeoutId = window.setTimeout("updateCountdown();", 1000);
        }
	else
	{
	    	var event_seat_booked = $("#event_seat_booked").val();
		var event_id = $("#event_id").val();
	
		$.ajax
		({
			async: false,
			type:"get",
			url: "<?php echo base_url(); ?>events/events_left_seated1",
			data: 'event_id='+ event_id +"&event_seat_booked="+event_seat_booked,
			success: function(data)
			{
				//alert(data);		
			}
		});		
           	window.location.href = '<?php echo base_url();?>';
        }
    }*/

    //gUpdateCountdownTimeoutId = window.setTimeout("updateCountdown();", 1000);
//$(document).ready(function(){
	/*setTimeout(function(){
   window.location.reload(1);
}, 5000);*/
	//window.location.reload(1);
					//   alert("hi");
	$("#pay_later").click(function(){
		var event_id = $("#event_id").val();
		var event_left_seat = $("#event_left_seat").val();
		//alert(event_left_seat);
		//window.location.reload();
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>events/events_check_seat_booked",
			data: 'event_left_seat='+ event_left_seat + '&event_id='+ event_id,
			//dataType: "json",
			success: function(result) {
				//alert(result);
				
				if(result == 0)
				{
					window.location.reload();
					<?php //$this->eventsModel->clear_cart_data1($eventid); ?>
				}else{
					window.location.href='<?php echo base_url(); ?>events/pay_later/'+event_id;
				}
			}
	
		});
	});
	
	
//});
 </script>