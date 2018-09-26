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
                      
                      <div style="margin-bottom:30px;">
                      <h4>Edit Job</h4>
                      </div>
                      <form name="frmmember" method="post" action="<?php echo base_url(); ?>members/updatepostjobs" >
                      <input type="hidden" name="id" value="<?php echo $job->jid; ?>" />
                      <input type="hidden" name="mid" value="<?php echo $job->mid; ?>"  />
                      
                      
                      <div class="col-md-6 col-sm-12">
                      <fieldset>
                        <div class="form-group">
                          <label for="inputCompanyName" >Job Name *</label>
                            <input class="form-control" id="inputCompanyName"  name="txtjob_name"  type="text" <?php if(form_error('txtjob_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $job->job_name ;?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Enter Start Date *</label>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input class="form-control" name="txtstart_date" id="start_date"  type="text" <?php if(form_error('txtstart_date') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo date("d-m-Y",strtotime($job->start_date));?>" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                         </div>
                          <div class="form-group">
                          	<label for="inputAddress" >Enter End Date *</label>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input class="form-control" name="txtend_date" id="end_date"  type="text" <?php if(form_error('txtend_date') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo date("d-m-Y",strtotime($job->end_date)); ?>" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Email Address *</label>
                            <input class="form-control" id="inputEmail" name="txtemail"  type="text" <?php if(form_error('txtemail') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $job->email; ?>"  />
                        </div>
                        <div class="form-group">
                          <label for="inputEmail" >Phone Number *</label>
                            <input class="form-control" id="inputEmail" name="txtcontact"  type="text" <?php if(form_error('txtcontact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $job->contact; ?>" />
                        </div>
                        </fieldset>
                      </div>
                      
                      <div class="col-md-6 col-sm-12">
                      	<fieldset>
                      	 <div class="form-group">
                          <label for="inputAddress" >Job Description *</label>
                            <textarea class="form-control" rows="15" cols="10" name="txtjob_details" <?php if(form_error('txtjob_details') != ''){ ?>style="border:1px solid red;"<?php } ?>><?php echo $job->job_details; ?></textarea>
                         </div>
                        </fieldset>
                      </div>
				
                	  <div class="col-md-12 col-sm-12">
                      
                      		<div class="form-group" style="margin-top:20px;">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                                <button type="reset" class="btn btn-default">Cancel</button>
                            </div>
                      
                      </div>
                      
                	</form>
                    
                	</div>
            </div>
            
            
            
          </div>
 </div>
