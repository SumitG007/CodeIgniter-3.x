<div class="container" style="margin-bottom:30px;">
    	
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            <?php if(isset($event_details) && $event_details > 0){
			foreach($event_details as $item)
			{ //print_r($item); ?>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                <?php //print_r($item); ?>
                    <h2><?php echo $item->event_name; ?></h2>
                    <h4>Location: <?php echo $item->event_location; ?> </h4>
					<h4>Date and Time: <?php echo date('d M Y',strtotime($item->start_date)); ?>, <?php echo $item->start_time." - ".$item->end_time; ?></h4>
                    <h4><?php if($item->left_seats > 0){ ?> Total Number of Seats Left: <?php echo $item->left_seats; }?></h4>
                </div>
            </div>
            <hr>
             <div class="row">
                <div class="col-md-12 col-sm-12">
                   <p style="padding-bottom:20px;">
                    <!--Company Profile<br>
					Our Employee Advantage<br>-->
                    <?php echo $item->event_desc; ?>
                    </p>
                   <!-- <p>Our Company:CBRE Group, Inc. (NYSE:CBG), a Fortune 500 and S&P 500 company headquartered in Los Angeles, is the world’s largest commercial real estate services and investment firm (in terms of 2014 revenue). The Company has more than 70,000 employees (excluding affiliates), and serves real estate owners, investors and occupiers through more than 400 offices (excluding affiliates) worldwide. CBRE offers strategic advice and execution for property sales and leasing; corporate services; property, facilities and project management; mortgage banking; appraisal and valuation; development services; investment management; and research and consulting.</p>-->
                </div>
               </div>
                <div class="row">
                <div class="col-md-12 col-sm-12">
                
                <?php 
				$dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
				$date1 = $dt->format('Y-m-d H:i:s');// exit;
				//echo $date1."<br/>";//exit;
				$date = explode(" ",$date1);
				//echo $date[0];
				//$event_current_time = '00:00:10'; 
				//echo $item->event_close_date;
				if($item->event_close_date == $date[0] || $item->event_close_date < $date[0]) 
				{ //echo "if"; ?>
				 <p><a href="#" class="soldbtn">PLEASE CALL FOR TICKETS</a></p>
				<?php  
				}else{

					if($item->left_seats > 0){ ?>
                			<?php // echo $item->left_seats; ?>
                      		 <?php if(!$this->session->userdata('logged_in_site')) {  ?>
                      			<!--<p><a href="<?php //echo base_url(); ?>events/event_nonmember_register" class="buybtn">BOOK</a>&nbsp;&nbsp;-->
                      <?php }else{ ?>
                      			<a href="<?php echo base_url(); ?>events/event_member_register/<?php echo $item->id; ?>" class="buybtn">GET TICKETS</a>&nbsp;&nbsp;&nbsp;
                      <?php } ?> <?php if(!$this->session->userdata('logged_in_site')) { ?> <a href="<?php echo base_url(); ?>events/event_nonmember_register/" class="regbtn">GET TICKETS</a> <?php } ?> </p>

                      <?php }else{ ?>
                      		<h2>All seats are booked</h2>
                      		 <p><a href="#" class="soldbtn">TICKETS SOLD OUT</a></p>
                      <?php } 
				}?>
                	
                   <?php /*?> <p><a href="<?php echo base_url(); ?>events/event_nonmember_register"><img src="<?php echo base_url(); ?>images/buyticketbutton.jpg"></a>  <?php if(!$this->session->userdata('logged_in_site')) { ?> <a href="<?php echo base_url(); ?>members/registration/"><img src="<?php echo base_url(); ?>images/registerbutton.jpg"></a> <?php } ?></p><?php */?>
                    
                </div>
            </div>
            <?php }
			}?>
            
            
            
            
          </div>
    </div>