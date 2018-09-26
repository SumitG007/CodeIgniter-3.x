<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
         	<div class="row">
             <?php foreach($events_register as $item){ ?>
                <div class="col-md-12 col-sm-12">
                    <h2><?php echo $item->event_name; ?></h2>
                    <h4>Location: <?php echo $item->event_location; ?> </h4>
					<h4>Date and Time: <?php echo date('d M Y',strtotime($item->start_date)); ?>, <?php echo $item->start_time." - ".$item->end_time; ?></span></h4>
                </div>
             <?php } ?>
            </div>
            <hr>
       
             <div class="row">
            
             <form method="post" action="<?php echo base_url(); ?>events/add_to_cart/">
              <input type="hidden" name="event_name" value="<?php echo $item->event_name; ?>" />
              
              <div class="col-md-12 col-sm-12" style="margin-bottom:20px; padding:15px; background-color:#DFEBF4"><strong>Enter Purchase Order # (Optional) </strong> <input type="text" name="event_purchase_order_number"/> </div>
                <div class="col-md-12 col-sm-12">
                 
                    <div class="table-responsive">
                   
                    
                      <table class="table">
                      	<thead>
                        	<th>Member Name</th>
                            
                            <th>Event Member Price</th>
                        </thead>
                        <?php 
						
						if(isset($event_member_list)){ 
						$toal_count = count($event_member_list);
						foreach($event_member_list as $item){ 
							$total_amount = $toal_count * $item->event_price;
              //$event_registerid=$event_registerid."-". $item->event_register_id;
							?>
                            <tr>
                                <td> <?php echo $item->	event_member_name; ?> <?php /*?>(<?php echo date('d M Y',strtotime($item->start_date)); ?>)<?php */?> </td>
                               
                                <td> <?php echo number_format($item->event_price,2); ?> CAD </td>
                                <td></td> 
                            </tr>
                            <input type="hidden" name="event_id" value="<?php echo $item->event_id; ?>" />
                           
                            <input type="hidden" name="member_id" value="<?php echo $item->member_id; ?>" />
                           
                            <input type="hidden" name="event_register_id" value="<?php echo $item->event_register_id; ?>" />
                        <?php }
						}?>
                        
                      </table>
                     
                    </div>
                    </div>
                    <div class="col-md-12 col-sm-12" style="margin-bottom:20px; padding:15px; background-color:#DFEBF4">
                    <?php if(isset($toal_count)){ ?><input type="hidden" name="event_seat_booked" value="<?php echo $toal_count; ?>"  /><?php } ?>
                    <?php if(isset($total_amount)){ ?> <input type="hidden" name="event_price" value="<?php echo $total_amount; ?>"  /><?php } ?>
                   <?php if(isset($total_amount)){ ?> <P><strong>Sub Total Price :</strong>   <?php  echo number_format($total_amount,2); ?>CAD</P><?php } ?><br/>                   
                    <strong>GST(tax) : </strong>  <?php $tax_value = $total_amount*0.05; echo number_format($tax_value,2); ?>				 					<input type="hidden" name="event_GST" value="<?php echo $tax_value; ?>"  />
                                		                                 
                                <p><strong>Total Prices :</strong>  <?php $total_event_price = $total_amount +  $tax_value; echo number_format($total_event_price,2); ?>CAD</p>
                                
                    </div>
                    <div class="col-md-12 col-sm-12"><p> <?php /*?><a href="<?php echo base_url(); ?>events/index"><button type="button" class="btn btn-primary btn-lg">Register Another Event</button></a><?php */?> &nbsp; <a class="btn btn-primary" href="<?php echo base_url(); ?>events/event_delete_member/<?php if(isset($item->event_register_id)){ echo $item->event_register_id; }?>/<?php if(isset($item->event_id)){ echo $item->event_id; } ?>">Delete</a>&nbsp; <button type="submit" class="btn btn-primary" >Next</button></p></div>
                
                
            
             </form>
            </div>
            
            
          </div>
    </div>