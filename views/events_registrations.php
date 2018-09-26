<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            
            
             <!-- Events content starts --> 
			<div class="container">
            <h2>Current Events</h2>
            
            
            
            <div class="row" style="margin-top:30px;">
              
               <?php //print_r($event);
					if(isset($event)){
					foreach($event as $item){ // print_r($item); exit;
					
					/*$seat_lefts = $this->siteModel->get_event_seats($item->id);
					//print_r($seat_lefts);exit;
					//echo "<br/>";
					$event_seats = 0; 
					for($i=0;$i<count($seat_lefts);$i++){
						$event_seats = $event_seats + $seat_lefts[$i]['event_seat_booked']; 
					}
					$total_left_seats = $item->total_seats - $event_seats;
					$this->siteModel->update_left_seats($total_left_seats,$item->id);*/
					?>
				<div class="col-sm-6 col-md-4" style="min-height:540px;">
			   
				  <div class="thumbnail"> <?php if($item['event_image'] != ''){ ?> <img src="<?php echo base_url(); ?>images/events/<?php echo $item['event_image']; ?>" width="342px" height="170px" alt="..."> <?php }else{ ?> <img src="<?php echo base_url(); ?>images/eventthumb.jpg" alt="..."><?php } ?>
					<div class="caption">
					  <h3>
                      <?php if(!$this->session->userdata('logged_in_site')) {  ?>
                      			<a href="<?php echo base_url(); ?>events/event_details/<?php echo $item['id']; ?>"><?php echo $item['event_name']; ?></a>
                      <?php }else{ ?>
                      			<?php if($item['left_seats'] == 0){ ?>
                      				<?php echo $item['event_name']; ?>
                                <?php }else{ ?>
                                	<a href="<?php echo base_url(); ?>events/event_member_register/<?php echo $item['id']; ?>"><?php echo $item['event_name']; ?></a>
                                <?php } ?>
                      <?php } ?>	
                       <span style="font-size:13px; float:right"><?php echo date("d M Y",strtotime($item['start_date'])); ?></span></h3>
                       <p style="font-size:13px; font-weight:bold">
                       
                      Cut off Date : <span style="font-size:13px; float:right"><?php echo date("d M Y",strtotime($item['event_close_date'])); ?></span><br/>
                      Total Seats Left : <span style="font-size:13px; float:right"><?php echo $item['left_seats']; ?></span><br/>
                      Location: <span style="font-size:13px; float:right"><?php echo $item['event_location']; ?></span><br/>
                      Time: <span style="font-size:13px; float:right"> <?php echo $item['start_time']." - ".$item['end_time']; ?></span>
                      </p>
					  <p><?php echo substr( $item['event_desc'], 0, 50); ?><br/><a href="<?php echo base_url(); ?>events/event_details/<?php echo $item['id']; ?>" style="font-size:12px;">Read More...</a></p>
                 <p><h4 style="text-align:center; font-weight:bold; color:$193684">$<?php echo $item['event_price']; ?>CAD</h4></p>
				<?php 
					$dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
					$date1 = $dt->format('Y-m-d H:i:s');// exit;
					//echo $date1."<br/>";//exit;
					$date = explode(" ",$date1);
					//echo $date[0];
					//$event_current_time = '00:00:10'; 
					//echo $item->event_close_date;
					if($item['event_close_date'] == $date[0]  || $item['event_close_date'] < $date[0]) 
					{ //echo "if"; ?>
					   <p style="text-align:center"><a href="#" class="soldbtn">PLEASE CALL FOR TICKETS</a></p>
					<?php  
					}else{
					  //echo "elseif";
					  if($item['left_seats'] > 0){ ?>
                      
						  <?php if(!$this->session->userdata('logged_in_site')) {  ?>
                                    <!-- <p style="text-align:center"><a href="<?php //echo base_url(); ?>events/event_nonmember_register" class="buybtn">GET TICKETS</a>&nbsp;&nbsp;-->
                          <?php }else{ 
						  			?>
                                    <a href="<?php echo base_url(); ?>events/event_member_register/<?php echo $item['id']; ?>" class="buybtn">GET TICKETS</a>&nbsp;&nbsp;&nbsp; 
                          <?php } ?> <?php if(!$this->session->userdata('logged_in_site')) { ?> <a href="<?php echo base_url(); ?>events/event_nonmember_register" class="regbtn">GET TICKETS</a> <?php } ?> </p>
                      		
                 <?php }else{ ?>
                      		 <p style="text-align:left"><a href="<?php echo base_url(); ?>events/event_tickets" class="soldbtn">TICKETS SOLD OUT</a></p>
                 <?php }
				 
					}?>
                      
                      		<?php /*?><p><a href="<?php echo base_url(); ?>events/event_nonmember_register"><img src="<?php echo base_url(); ?>images/buyticketbutton.jpg"></a><br/><?php */?>   
                     
					</div>
				  </div>
				 
				  
				</div>
				 <?php }
					} ?>
              </div>
              
              
        <!--      
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="images/eventthumb.jpg" alt="...">
                  <div class="caption">
                    <h3><a href="#">Luncheon</a> <span style="font-size:13px; float:right">Tuesday, 14 Apr 2015</span></h3>
                     <p>This event is now sold out. Thank yo BOMA Edmonton is proud to announce our luncheon on April 14th where the Kelly Ramsey Tower will be the topic.
                    	<br> 
                   	<a href="#">Read More...</a></p>
                    <p><a href="#"><img src="images/buyticketbutton.jpg"></a> <br> <a href="#"><img src="images/registerbutton.jpg"></a></p>
                  </div>
                </div>
                <div class="thumbbottom">
                	<div class="col-sm-6 col-md-4" style="border-right:1px solid #d4d4d4"><strong>Time:</strong><br> 11:45 am - 01:15 am</div>
                    <div class="col-sm-6 col-md-4" style="border-right:1px solid #d4d4d4"><h4>$43.00<br> CAD</h4></div>
                    <div class="col-sm-6 col-md-4"><strong>Location:</strong><br>Sutton Place Hotel</div>
                </div>
              </div>
              
              
              
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="images/eventthumb.jpg" alt="...">
                  <div class="caption">
                    <h3><a href="#">Luncheon</a> <span style="font-size:13px; float:right">Tuesday, 14 Apr 2015</span></h3>
                     <p>This event is now sold out. Thank yo BOMA Edmonton is proud to announce our luncheon on April 14th where the Kelly Ramsey Tower will be the topic.
                    	<br> 
                   	<a href="#">Read More...</a></p>
                    <p><a href="#"><img src="images/buyticketbutton.jpg"></a> <br> <a href="#"><img src="images/registerbutton.jpg"></a></p>
                  </div>
                </div>
                <div class="thumbbottom">
                	<div class="col-sm-6 col-md-4" style="border-right:1px solid #d4d4d4"><strong>Time:</strong><br> 11:45 am - 01:15 am</div>
                    <div class="col-sm-6 col-md-4" style="border-right:1px solid #d4d4d4"><h4>$43.00<br> CAD</h4></div>
                    <div class="col-sm-6 col-md-4"><strong>Location:</strong><br>Sutton Place Hotel</div>
                </div>
              </div>	
              -->
              
              
              
              
              
              
            </div>
            
</div>
            
            
            
          </div>
    </div>