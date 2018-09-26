<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
             <?php echo $breadcrumb; ?>
            </ol>
            <?php
			 foreach($events_individual as $item)
			 { //print_r($_REQUEST);  
			 $user_data = $this->session->userdata('logged_in_site');
			 //print_r($user_data); ?>
             <form method="post" action="<?php echo base_url(); ?>events/add_to_cart/">
            <input type="hidden" name="member_id" id="" value="<?php echo $user_data['mid']; ?>" /> 
             <input type="hidden" name="event_name" id="" value="<?php echo $item->event_name; ?>" /> 
            <input type="hidden" name="member_name" id="" value="<?php echo $user_data['company_representative']; ?>" /> 
            <input type="hidden" name="event_price" id="" value="<?php echo $item->event_price; ?>" /> 
            <input type="hidden" name="event_type" id="member_type" value="<?php echo $member_type; ?>" />
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2><?php echo $item->event_name; ?></h2>
                    <h3>Location: <?php echo $item->event_location; ?><span class="pull-right"><?php echo date('d M Y',strtotime($item->start_date)); ?>, <?php echo $item->start_time." - ".$item->end_time; ?></span></h3>
                </div>
            </div>
            <hr>
             <div class="row">
             <p> Please check the data below and confirm that everything is correct. If so, click the NEXT button. If not, click the BACK button below and make the necessary corrections.</p>
                <div class="col-md-6 col-sm-6">
                    <input type="hidden" name="event_id" id="event_id" value="<?php echo $item->id; ?>" />
                    <h3> Your total Registration cost: <?php echo $item->event_price; ?> CAD </h3>
                    <p>Registration Fee:  1 x <?php echo $item->event_price; ?> CAD &nbsp; &nbsp; &nbsp; Tax: 2.15 CAD</p>
                    <p><a href="<?php echo base_url(); ?>events/event_member_register/<?php echo $item->id; ?>"><input name="" type="button" value="Back"></a> <input name="submit" type="submit" value="Next Step"></a></p>
                    
                </div>
                <div class="col-md-6 col-sm-6">
                    <p>
                    <?php $user_data = $this->session->userdata('logged_in_site');
					 $id = $user_data['mid'];
					 $set_user_data = $this->siteModel->company_data($id)->result();
					 //print_r($set_user_data);  ?>
                    Name: <?php echo $set_user_data[0]->company_representative; ?><br>                    
                    Organization: <?php echo $set_user_data[0]->company_name; ?><br>                    
                    Address: <?php echo $set_user_data[0]->company_address; ?><br>                    
                    City: <?php echo $set_user_data[0]->city_name; ?><br>                    
                    <?php /*?>Province: <?php echo $set_user_data['company_representative']; ?><br> <?php */?>                   
                    Postal Code: <?php echo $set_user_data[0]->postal_code; ?><br>                    
                    Email: <?php echo $set_user_data[0]->company_email; ?><br> 
                    Website: <?php echo $set_user_data[0]->company_website; ?><br>                    
                    Phone: <?php echo $set_user_data[0]->company_telephone; ?></p>
                </div>
                
            </div>
            </form>
			<?php } ?>
                        
            
          </div>
    </div>