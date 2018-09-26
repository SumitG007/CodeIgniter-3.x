<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
             <?php echo $breadcrumb; ?>
            </ol>
            <?php 
			$i =1;
			foreach($event_detail as $item)
			{ //print_r($item); ?>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2><?php echo $item->event_name; ?></h2>
                    <h4>Location: <?php echo $item->event_location; ?></h4>
                    <h4>Date and Time: <?php echo date('d M Y',strtotime($item->start_date)); ?>, <?php echo $item->start_time." - ".$item->end_time; ?></h4>
                    <?php /*$seat_lefts = $this->siteModel->get_event_seats($item->id);
							//print_r($seat_lefts);exit;
							//echo "<br/>";
							$event_seats = 0; 
							for($i=0;$i<count($seat_lefts);$i++){
								$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
							}
							$total_left_seats = $item->total_seats - $event_seats;
							$this->siteModel->update_left_seats($total_left_seats,$item->id);*/
							?>
                    <h4>Total Numbers of Seats Left : <?php echo $item->left_seats; ?> </h4>
                </div>
            </div>
            <hr>
            <?php if($item->left_seats > 0){ ?>
             <div class="row">
             <form method="post" action="<?php echo base_url(); ?>events/events_list_members/">
                <div class="col-md-6 col-sm-12">
                   <p>
                    Please select number of members going to attend the event.
                    </p>
                    
                    <?php /*?><p><input name="member_register" type="radio" value="individual">  I am registering as an individual</p>
                    <p><input name="member_register" type="radio" value="group">   I am registering as part of a group</p><?php */?>
                   <?php //echo $item->id; 
				   $user_data = $this->session->userdata('logged_in_site');
				   $total_paylater_event = $this->eventsModel->total_paylater_booked($item->id,$user_data['mid']);
				  // print_r($total_paylater_event);
				  // echo "<br/>";
				   $total_order_event = $this->eventsModel->total_orderevent_booked($item->id,$user_data['mid']);
				  // print_r($total_order_event);;//exit;
					 //echo "<br/>";
					if($user_data['mid'] == $total_order_event['user_id'] && $user_data['mid'] == $total_paylater_event['user_id'])
					{
						
						$total_seat_booked =  $total_order_event['event_seat_booked'] +  $total_paylater_event['event_seat_booked'];
				   		$member_seat_booked = $item->num_of_members - $total_seat_booked;
						//echo $member_seat_booked;
						if($item->left_seats < $item->num_of_members)
                        {
                    ?>
                            <p><select class="form-control" name="member_register" id="member_register">
                            <option>Select</option>
                            <?php for($i=1;$i<=$item->left_seats;$i++){ ?>
                            	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php  }?>                                        	
                        	</select></p>
                    
                   <?php }else{ ?>
                            <p><select class="form-control" name="member_register" id="member_register">
                            <option>Select</option>
                            <?php for($i=1;$i<=$member_seat_booked;$i++){ ?>
                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php  }?>                                        	
                            </select></p>
                    <?php } ?>
					<?php
                    }elseif(isset($total_paylater_event) && $user_data['mid'] == $total_paylater_event['user_id']){
                    	$member_seat_booked = $item->num_of_members - $total_paylater_event['event_seat_booked']; echo 'ok';
						//echo $member_seat_booked; 
                    	if($item->left_seats < $item->num_of_members)
                        {
                    ?>     
                            <p><select class="form-control" name="member_register" id="member_register">
                            <option>Select</option>
                            <?php for($i=1;$i<=$item->left_seats;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php  }?>                                        	
                            </select></p>
                        
                 <?php  }else{ ?>
                            
                            <p><select class="form-control" name="member_register" id="member_register">
                            <option>Select</option>
                            <?php for($i=1;$i<=$member_seat_booked;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php  }?>                                        	
                            </select></p>
                            
                    <?php } ?>
                    
				<?php }elseif(isset($total_order_event) && $user_data['mid'] == $total_order_event['user_id']){
				        
                    	$member_seat_booked = $item->num_of_members - $total_order_event['event_seat_booked'];
						if($item->left_seats < $item->num_of_members)
                        {
                    ?>       
                            <p><select class="form-control" name="member_register" id="member_register">
                            <option>Select</option>
                            <?php for($i=1;$i<=$item->left_seats;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php  }?>                                        	
                            </select></p>
                            
                  <?php  }else{ ?>
                            <p><select class="form-control" name="member_register" id="member_register">
                            <option>Select</option>
                            <?php for($i=1;$i<=$member_seat_booked;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php  }?>                                        	
                            </select></p>
                            
                    <?php } ?>
       
                  <?php }else{  
                               
                               if($item->left_seats < $item->num_of_members){ ?>
                                        <p><?php echo "You book only ".$item->left_seats." seats"; ?></p>
                                        <p><select class="form-control" name="member_register" id="member_register">
                                        <option>Select</option>
                                        <?php for($i=1;$i<=$item->left_seats;$i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php  }?>                                        	
                                        </select></p>
                                     
								<?php }else{ ?>
                                        <p><select class="form-control" name="member_register" id="member_register">
                                        <option>Select</option>
                                        <?php for($i=1;$i<=$item->num_of_members;$i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php  }?>                                        	
                                        </select></p>
								<?php }
								} ?>
                                
                    <p><input name="submit" id="submit" type="submit" class="btn btn-primary" value="Next Step"></p>
                    <input name="event_id" class="form-control" type="hidden" value="<?php echo $item->id; ?>">
                    <input name="event_price" class="form-control" type="hidden" value="<?php echo $item->event_price; ?>">
                    <?php
					
						
					 // $c = uniqid (rand(), true);
					$alpha_numeric1 = '0123456789';
					$register_id = substr(str_shuffle($alpha_numeric1), 0, 3);
					?>
					
                     <input name="event_register_id" id="event_register_id" class="form-control" type="hidden" value="<?php echo $register_id; ?>">
                    
                    <?php $user_data = $this->session->userdata('logged_in_site'); ?>
                    
                    <input name="member_id" class="form-control" type="hidden" value="<?php echo $user_data['mid']; ?>"> 
                    </div>
                    <div class="col-md-6 col-sm-12">
                    <p>
                    Please enter below the name of members.
                    </p>
                    <p>
                    <div id="result_data"></div>
                    </p>
                    
                </div>
                
            
            </form>
          </div>
           <?php 
			}else{ ?>
				
                <div class="container" style="margin-bottom:30px;">
    
                   <div class="page-header">
                   <div class="row">
                        <div class="col-md-12 col-sm-12">
        <h2><strong>All Tickets SOLD OUT!</strong></h2>
        
        <p>We are sorry, but all the tickets have been sold for this event, to get on the waiting list, <br/>
        please e-mail jmensink@bomaedm.ca  </p>
        
           </div>
                    </div>       
                    
                  </div>
            </div>
			<?php }
			} ?>
            <!--<div id="result_data"></div>-->
            
            
          </div>
    </div>
    
    
    <script type="text/javascript">
	$(document).ready(function(){
		$("#member_register").change(function(){
			var selectedText = $("#member_register").find("option:selected").text();
            var selectedValue = $("#member_register").val();
  			var event_register_id = $("#event_register_id").val();
			 $("#result_data").html('');
				if(selectedValue > 0) {
					 //var numberSelected = 1;
					for(var i = 1; i<= selectedValue; i++) {
						
						$("#result_data").append('<div class="col-md-6 col-sm-12"><label >Member Name : </label><input class="form-control" type="text" name="member_name[]" value="" required="required" /></div> <div class="col-md-6 col-sm-12"><label >Company Name :    </label><input class="form-control" type="text" name="company_member_name[]" value="" required="required" /></div><br/><input class="form-control" type="hidden" name="seat_booked[]" value="" /><input class="form-control" type="hidden" name="event_register_id" id="event_register_id" value="'+event_register_id+'" />');
					//numberSelected++;	
					}
					/* if (isEmpty(document.getElementById("event_register_id").value))
					{
					  document.getElementById("event_register_id").value = 1;
					}
					else
					{
					  document.getElementById("event_register_id").value++;
					}*/
				}
			});
	});
	
	</script>