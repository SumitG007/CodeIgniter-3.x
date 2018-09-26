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
					//if(count($events_sub_members) >0 ) {
					?>
                  <h3 class="box-title"><?php //echo $events[0]->order_eventname; ?></h3>
                   <?php
					//}?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>No.</th>
                      <th>Member Name</th>
                      
                    </tr>
                    <?php
					
					if(isset($events_sub_members) && $events_sub_members > 0 ) {
						
							foreach($events_sub_members as $item1) {
							
							
					?>
					<tr>
	                 <td><?php echo $item1->event_register_id; ?></td> 
                      <td><?php 
					  $event_member_name = $this->eventsModel->get_sub_members($item1->event_register_id)->result();
						//print_r($event_member_name);
					  foreach($event_member_name as $item2)
					  {
						  echo $item2->event_member_name."<br/>";
					  }
					  
					  //echo $item->event_member_name; ?></td> 
                      
                      
                      
                    </tr>
                      <?php
					}
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
                             
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->           </div>
            
            
            
            
            
          </div>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div>