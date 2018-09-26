<div class="container">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            
             <div class="row">
             	<div class="col-md-12">
                      <p><strong>Welcome, <?php echo $member->company_representative; ?></strong><br>You are representative of <?php echo $member->company_name; ?>. </p>
                </div>
             </div>
             <hr>
            <div class="row" style="margin-top:10px; margin-bottom:30px;">
                <?php $this->load->view('members/sidebar'); ?>
                <div class="col-md-10 col-sm-12">
                      
                      <div style="margin-bottom:40px;">
                      <h4>Events booking list<span class="pull-right"><?php /*?><a class="btn btn-default" href="<?php echo base_url(); ?>members/post_jobs" style="text-decoration:none" >Add New Job</a><?php */?></span></h4>
                      </div>
                      
                    	<div class="bs-example" data-example-id="striped-table">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  
                                  <th>Event Name</th>
                                  <th>Name</th>
                                  <th>Seat Booked</th>
                                  <th>Price</th>
                                  <?php /*?><th>Status</th>
                                  <th>Actions</th><?php */?>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if(isset($events_data) && $events_data > 0)
							  		{
									   foreach($events_data as $item) {  //print_r($item);exit;?>  
                                <tr>
                                  
                                  <td><?php echo $item['order_eventname']; ?></td>
                                  <td><?php echo $item['name']; ?></td>
                                  <td><?php echo $item['event_seat_booked']; ?></td>
                                  <td><?php echo $item['order_price']; ?></td>
                                  <?php /*?><td><?php echo $item->event_payment_status; ?></td>
                                  <td><a href="<?php echo base_url(); ?>members/editpostjobs/<?php echo $item->jid; ?>"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>  <!--<button type="button" class="btn btn-warning btn-sm">Reopen</button>--> <a href="<?php echo base_url(); ?>members/delete_post_jobs/<?php echo $item->jid; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td><?php */?>
                                </tr>
                              <?php }
									}else{?>
                                    <tr>
                                    <td colspan="3">No Data Availbale...</td>
                                    </tr>
                                    <?php } ?>
                              </tbody>
                            </table>
                          </div><!-- /example -->
                </div>
            </div>
            
            
            
          </div>
 </div>