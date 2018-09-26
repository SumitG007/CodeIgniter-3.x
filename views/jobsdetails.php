<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrum; ?>
            </ol>

            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                <?php 
					$this->load->model("jobsModel");	 
		 			if($jobs->mid != 0 ) { $copmany = $this->jobsModel->get_company_by_id($jobs->mid)->row();  }
					?>
                    <h2><?php if($jobs->mid != 0 ) { echo $copmany->company_name; } else { echo $jobs->contact; } ?></h2>
                    <h3><?php echo $jobs->job_name; ?> <span class="pull-right">Posted On: 	<?php echo $jobs->createdon; ?> </span></h3>
                </div>
            </div>
            <hr>
             <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h4>Job Description</h3>
                    <p>
                    
                    
                    <?php echo $jobs->job_details; ?>
                </div>
            </div>
            
            
            
          </div>
    </div>