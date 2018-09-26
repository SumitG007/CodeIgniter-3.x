<div class="container"> <!-- Banner starts -->
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="border-top:1px solid #323234;border-bottom:1px solid #323234;height:441px;">
    <ol class="carousel-indicators">
    <?php $i=1; foreach ($banner as $item)  { ?> 
      <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" <?php if($i==1) { ?>class="active"<?php } ?>></li>
    <?php $i++; } ?>
    </ol>
    <div class="carousel-inner" role="listbox">
    <?php $i=1; foreach ($banner as $item)  { ?> 
      <div class="item <?php if($i==1) { ?>active<?php } ?>"> <img src="<?php echo base_url(); ?>images/banners/<?php echo $item->img; ?>" data-toggle="tooltip" title="<?php echo $item->title; ?>" data-original-title="<?php echo $item->subtitle; ?>" > </div>
      <?php $i++; } ?>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
  <!-- Banner ends --> 
</div>

<!-- Events content starts -->
<div class="container">
  <h2>Upcoming Events</h2>
  <div class="row" style="margin-top:30px;">
   <?php 
		if(isset($event)){
		foreach($event as $item){ //print_r($item); ?>
    <div class="col-sm-12 col-md-4" style="min-height:540px;">
   
     <div class="thumbnail"> <?php if($item['event_image'] != ''){ ?> <img src="<?php echo base_url(); ?>images/events/<?php echo $item['event_image']; ?>" width="342px" height="170px" alt="..."> <?php }else{ ?> <img src="<?php echo base_url(); ?>images/eventthumb.jpg" alt="..."><?php } ?>
					<div class="caption" >
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
                      Time: <span style="font-size:13px; float:right"><?php echo $item['start_time']." - ".$item['end_time']; ?></span>
                      </p>
                      
                      
					  <p><?php echo substr( $item['event_desc'], 0, 50); ?> <br /><a href="<?php echo base_url(); ?>events/event_details/<?php echo $item['id']; ?>" style="font-size:12px;">Read More...</a></p>
                      <p><h4 style="text-align:center; font-weight:bold; color:$193684">$<?php echo $item['event_price']; ?> CAD</h4></p>
                  <?php    
                      
                    $dt = new DateTime();  // convert UNIX timestamp to PHP DateTime
					$date1 = $dt->format('Y-m-d H:i:s');// exit;
					//echo $date1."<br/>";//exit;
					$date = explode(" ",$date1);
					//echo $date[0];
					//$event_current_time = '00:00:10'; 
					//echo $item->event_close_date;
					if($item['event_close_date'] == $date[0] || $item['event_close_date'] < $date[0]) 
					{ //echo "if"; ?>
					  <p style="text-align:center"><a href="#" class="soldbtn">PLEASE CALL FOR TICKETS</a></p>
					<?php  
					}else{
						
					      if($item['left_seats'] > 0){ ?>
                      		<?php if(!$this->session->userdata('logged_in_site')) {  ?>
                      			<!--<p style="text-align:center"><a href="<?php //echo base_url(); ?>events/event_nonmember_register" class="buybtn">GET TICKETS</a>&nbsp;&nbsp;-->
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
</div>

<!-- Events content starts -->
<div class="container" style="margin-top:50px; margin-bottom:50px;" >
  <div class="col-md-12">
    <h2>Latest News</h2>
   <?php if(isset($news)){
			foreach($news as $item){ //print_r($item);?>
            
    <div style="margin-bottom:30px;">
      <p> <strong><a href="<?php echo base_url(); ?>welcome/news_details/<?php echo $item->id; ?>"><?php echo strtoupper($item->news_title); ?></a></strong>
       <?php echo substr($item->news_desc,0,100); ?>... <br />
       <a href="<?php echo base_url(); ?>welcome/news_details/<?php echo $item->id; ?>" style="font-size:12px; font-weight:bold"> Read More</a></p>
    </div>
    <?php }
	} ?>
    <!--<div style="margin-bottom:30px;">
      <p> <a href="#">BOMA is MOVING</a><br>
        BOMA Edmonton is moving !! We are moving as of April 25, 2015 to the EPCOR Tower. </p>
      <p><a href="#">Read More >></a></p>
    </div>-->
  </div>
  </div>
  
  <div class="container" style="margin-top:70px; margin-bottom:100px;" >

  <?php if(isset($home_items)){
	  	foreach($home_items as $item){ //print_r($item); ?>

	  <div class="col-md-6">  
    <h2><?php echo $item->title; ?></h2>
   
    <p ><?php echo $item->content; ?></p>
  </div>
  <?php }
  } ?>
  </div>
  
  </div>
 <!-- <div class="col-md-4">
    <h2>e-Energy Training Course</h2>
    <p><kbd>BOMA e-EnergyTraining</kbd> is an energy management course for building operators of commercial and institutional buildings. Delivered online, in a self-learning format, participants learn at their own pace, and have access from remote locations. Registrants will understand basic energy principles, identify energy reduction opportunities, develop strategies and learn how to influence stakeholders to adopt energy savings behavior. The program highlights operational and capital project energy management opportunities.</p>
    <p>To get more information, please check out the link www.bomalearning.com.</p>
  </div>
</div>-->
