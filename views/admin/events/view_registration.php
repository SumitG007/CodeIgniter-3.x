<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Events</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events">Manage Events</a></li>
            <li class="active">List of Events</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php 
					//print_r($events);
					if(count($events) >0 ) {
					?>
                  <h3 class="box-title"><?php echo $events[0]->order_eventname; ?></h3>
                   <?php
					}else{ ?>
                    <h3 class="box-title">View Events Registrations </h3>
                    <?php } ?>
                     <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/events/add_events_sub_member/<?php if(count($event_id) >0 ) { echo $event_id; } ?>"> <button class="btn btn-block btn-primary btn-sm">Add New Sub Member</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover tablesorter" id="myTable">
                  <thead> 
					<tr> 
                      <th>Company</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Tickets</th>
                      <th>PO#<br>(optional)</th>
                      <th>Booked On</th>
                      <th>Attendees</th>
                      <th>Company</th>
                      <th>Sub-Total</th>
                      <th>GST</th>
                      <th>Total</th>
                     <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody> 
                    <?php
					//print_r($events);
					
					if(isset($events) && $events >0 ) {
						//$event_register_id = $this->eventsModel->get_event_register_id($events[0]->user_id,$events[0]->event_id);
							foreach($events as $item) {
							
							//print_r($item);
							$this->load->model("membersModel");
							$user_name = $this->membersModel->get_by_id($item->user_id)->result();
							//print_r($user_name);
							$member_email = $this->eventsModel->get_member_email($item->user_id)->result();
							
						//print_r($event_register_id);//exit;
							
					//print_r($submember_name);			
					?>
					<tr>
	                  <td><?php echo $user_name[0]->company_name; ?></td>
                      <td><?php echo $item->name; ?></td>
                      <td><?php echo $member_email[0]->company_email; ?></td>
                      
                      
                      <td><?php echo $item->event_seat_booked; ?></td> 
                      <td style=" color:#903;  font-weight:bold; text-transform:uppercase">
                       <?php echo $item->order_purchase_number; ?>
                          <?php //echo $item->order_eventname;
                       /* foreach($submember_name as $row){
							  echo $row."<br/>";
						}*/
						
						/*for($i=0;$i<=count($event_register_id);$i++)
						{
							//print_r($submember_name);
							$submember_name = $this->eventsModel->get_order_submember_email1($event_register_id[$i]);		
							foreach( $submember_name as $row)
							{
								echo $row;	
							}
							
							//echo $submember_name[$i];
						}*/
                          
                          ?>
                          
                      </td>
                      <td><?php $date = date( 'd-m-Y', strtotime($item->order_created_date)); echo $date; ?></td>
                      <td><?php
					  
					  $submember_name =
					   $this->eventsModel->get_order_submember_email1($item->event_id,$item->event_register_id,$item->user_id);
					  //print_r($submember_name);
					  
					  for($i=0;$i<count($submember_name['event_member_name']);$i++)
					  {
						  echo $submember_name['event_member_name'][$i]."<br/>";
					  }
					 // echo "<br/>";
					 ?>
                     </td>
                     <td>
                     <?php
					  for($j=0;$j<count($submember_name['event_company_name']);$j++)
					  {
						  
						  echo $submember_name['event_company_name'][$j]."<br/>";
					  }
					/* foreach( $submember_name as $row)
						{
							//print_r($row);
							echo $row['event_member_name']."<br/>";	
							echo $row['event_company_name']."<br/>";	
						}*/
					  //echo $item->event_register_id; ?></td>
                      <td>$<?php echo $item->order_price; ?> </td>
                      <td>$<?php echo $item->order_GST; ?> </td>
                      <td> <?php $total = $item->order_price + $item->order_GST; echo "$".number_format($total,2); ?> </td>
                     <td style="color:#036; font-size:12px; font-weight:bold; text-transform:uppercase"><?php 
					 	if($item->event_payment_status == 'Yes')
						{	
							echo 'Paid by paypal';
						}elseif($item->event_payment_status == 'No'){
              echo 'Payment Cancelled';
            }else{
							echo 'Payment Cancelled';
						}
					 
					 ?></td>
                    
                      <td>
                              <?php /*?>	<span class="label label-success"> Confirmed Registrations</span>&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url(); ?>admin/events/confirm_delete_events/<?php echo $item->event_id; ?>/<?php echo $item->event_seat_booked; ?>/<?php echo $item->cart_id; ?>"><span class="label label-danger">delete</span></a>	<?php */?>
                                <a href="<?php echo base_url(); ?>admin/events/view_sub_member_list/<?php echo $item->event_id; ?>/<?php echo $item->user_id; ?>/<?php echo $item->event_register_id; ?>"><span class="label label-danger">delete</span></a>	
                              		
                                  
						<?php 
						} ?></td> 
                    </tr>
                      <?php
					}
					?>
					<?php /*?>if(isset($event_pay_laters) && $event_pay_laters >0 ){
		
						foreach($event_pay_laters as $item2){ //print_r($item2);exit;
						
						$member_email = $this->eventsModel->get_member_email($item2->user_id)->result();
							//print_r($event_member_id);
						$submember_name = $this->eventsModel->get_order_submember_email($item2->event_register_id);		
							//print_r($submember_name);
						?>    
                    
                        <tr>
                          <td><?php echo $item2->name; ?></td>
                          <td><?php echo $member_email[0]->company_email; ?></td>
                          <td>
                          <?php
			
							foreach($submember_name as $row){
							  echo $row."<br/>";
							 }
				
						
						  ?>
                          
                          </td>
                          <td><?php echo $item2->order_price; ?> CAD</td>
                          <td><?php echo $item2->event_seat_booked; ?></td> 
                        
                          <td><?php if(isset($item2->event_id)){ ?>
                                        <a href="<?php echo base_url(); ?>admin/events/confirm_registration/<?php echo $item2->event_id; ?>/<?php echo $item2->event_seat_booked; ?>/<?php echo $item2->cart_id; ?>"><span class="label label-danger">Confirmed Registrations</span></a>&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url(); ?>admin/events/confirm_delete_events_paylater/<?php echo $item2->event_id; ?>/<?php echo $item2->event_seat_booked; ?>/<?php echo $item2->cart_id; ?>"><span class="label label-danger">delete</span></a> 
                              <?php } ?></td> 
                        </tr>
                    <?php }
                     } <?php */?>
                          </tbody>    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->           </div>
            
            
            
            
            
          </div>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div>