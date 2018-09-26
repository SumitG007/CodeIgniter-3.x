<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrum; ?>
            </ol>

            
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <h2>Employment Listings</h2>
                </div>
                <div class="col-md-3 col-sm-12">    
                    <nav>
                      <ul class="pagination">
                        <?php echo $pagination; ?>
                      </ul>
                    </nav>
                </div>
            </div>
            
            <div class="row">
            	<table class="table table-hover">
                <thead>
                    <tr>
                      <?php /*?><th>Job ID</th><?php */?>
                      <th>Job Title</th>
                      <th>Company</th>
                      <th>Posting Date</th>
                      <th>End Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  if(empty($viewdata))
				  {
					?>
                    <tr>
                    <td colspan="4">No Jobs Availble.</td>
                    </tr>
                    <?php  
					  
				  }else{
				  		foreach($viewdata as $item) {
				  		$this->load->model("jobsModel");	 
		 				if($item['mid'] != 0 ) { $copmany = $this->jobsModel->get_company_by_id($item['mid'])->row();  }
					   ?>
                    <tr>
                       <?php /*?><td><?php echo $item['jid']; ?></td><?php */?>
                      <td><a href="<?php echo base_url(); ?>pages/view_jobs/<?php echo $item['jid']; ?>"><?php echo $item['job_name']; ?></a></td>
                      <!--<td><?php// if($item['mid'] != 0 ) { echo $copmany->company_name; } else { echo $item['contact']; } ?></td>-->
                      <td><?php  echo $item['company_name'];  ?></td>
                      <td><?php echo $item['start_date']; ?></td>
                       <td><?php echo $item['end_date']; ?></td>
                      <td><a href="<?php echo base_url(); ?>pages/view_jobs/<?php echo $item['jid']; ?>">View Details</a></td>
                    </tr>
                    <?php }
				  }
					?>
                  </tbody>
                </table>
            
            </div>
            
            
          </div>
    </div>