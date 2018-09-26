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
                      
                      <?php /*?><div style="margin-bottom:40px;">
                      <h4>List of jobs posted <span class="pull-right"><a class="btn btn-default" href="<?php echo base_url(); ?>members/post_jobs" style="text-decoration:none" >Add New Member</a></span></h4>
                      </div>
                      
                    	<div class="bs-example" data-example-id="striped-table">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  
                                  <th>First Name</th>
                                  <th>Email</th>
                                  <th>Username</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php foreach($jobslist as $item) { 
							  print_r($item);?>  
                                <tr>
                                  
                                  <td><?php echo $item->fullname; ?></td>
                                  <td><?php echo $item->email; ?></td>
                                  <td>@<?php echo $item->username; ?></td>
                                  <td><a href="<?php echo base_url(); ?>members/view_member/<?php echo $item->id; ?>"><button type="button" class="btn btn-primary btn-sm">View</button></a>  <a href="<?php echo base_url(); ?>members/editmember/<?php echo $item->id; ?>"><button type="button" class="btn btn-warning btn-sm">Edit</button></a> <a href="<?php echo base_url(); ?>members/deletemember/<?php echo $item->id; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div><?php */?><!-- /example -->
                          
                       <div style="margin-bottom:40px;">
                      <h4>List of jobs posted <span class="pull-right"><a class="btn btn-default" href="<?php echo base_url(); ?>members/post_jobs" style="text-decoration:none" >Add New Job</a></span></h4>
                      </div>
                      
                    	<div class="bs-example" data-example-id="striped-table">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  
                                  <th>Job Name</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>Email Address</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php foreach($jobslist as $item) {  //print_r($item);exit;?>  
                                <tr>
                                  
                                  <td><?php echo $item->job_name; ?></td>
                                  <td><?php echo $item->start_date; ?></td>
                                  <td><?php echo $item->end_date; ?></td>
                                  <td><?php echo $item->email; ?></td>
                                  <td><?php echo $item->status; ?></td>
                                  <td><a href="<?php echo base_url(); ?>members/editpostjobs/<?php echo $item->jid; ?>"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>  <!--<button type="button" class="btn btn-warning btn-sm">Reopen</button>--> <a href="<?php echo base_url(); ?>members/delete_post_jobs/<?php echo $item->jid; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div><!-- /example -->
                </div>
            </div>
            
            
            
          </div>
 </div>