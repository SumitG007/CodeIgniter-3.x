<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Jobs</h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/jobs/approved_nonmembers">Manage Member Pending Jobs</a></li>
            <li class="active">List of Jobs</li>
          </ol>
        </section>

        <!-- Main content -->
              <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/jobs/update_member_pending_jobs">
          <div class="row">
           
           
      	
           <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Edit Approved Jobs</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  	<?php //print_r($pending_data);//exit; ?>
                    <!-- text input -->
                    <div class="form-group">
                      <label>Job Name *</label>
                      <input type="text" class="form-control" name="job_name" value="<?php echo $pending_data[0]->job_name; ?>"/>
                      <?php if(form_error('job_name') != ''){ ?><div class="alert-danger"><?php echo form_error('job_name'); ?></div><?php } ?>
                    </div>
                     <input type="hidden" name="id" value="<?php echo $pending_data[0]->jid; ?>" />
                    
                    <div class="form-group">
                      <label>Start Date</label>
                       <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' name="start_date" id="start_date" class="form-control" value="<?php echo date('d-m-Y',strtotime($pending_data[0]->start_date)); ?>" />
                                    <?php /*?> <?php if(form_error('start_date') != ''){ ?><div class="alert-danger"><?php echo form_error('start_date'); ?></div><?php } ?><?php */?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                      
                    </div>
                    <div class="form-group">
                      <label>End Date</label>
                      <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' name="end_date" id="end_date" class="form-control" value="<?php echo date('d-m-Y',strtotime($pending_data[0]->end_date)); ?>" />
                                    <?php /*?> <?php if(form_error('end_date') != ''){ ?><div class="alert-danger"><?php echo form_error('end_date'); ?></div><?php } ?><?php */?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                    </div>
                    <?php /*?><div class="form-group">
                      <label>Timings  *</label>
                      <input type="text" name="timing"  class="form-control" value="<?php echo $pending_data[0]->start_time." - ".$pending_data[0]->end_time; ?>" />
                    </div><?php */?>
                    <div class="form-group">
                      <label>Email *</label>
                      <input type="text" name="email" class="form-control" value="<?php echo $pending_data[0]->email; ?>" />
                      <?php /*?> <?php if(form_error('event_price') != ''){ ?><div class="alert-danger"><?php echo form_error('event_price'); ?></div><?php } ?><?php */?>
                    </div>
                    
                    <div class="form-group">
                          <label for="inputEmail" >Company Name *</label>
                            <input class="form-control" id="inputEmail" name="company_name"  type="text" value="<?php echo $pending_data[0]->company_name; ?>">
                           <?php /*?> <?php if(form_error('company_name')){ echo "<span style='color:red; font-size:12px;'>Please enter your company name.</span>"; } ?><?php */?>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputEmail" >Address *</label>
                            <input class="form-control" id="inputEmail" name="address"  type="text" value="<?php echo $pending_data[0]->address; ?>">
                           <?php /*?> <?php if(form_error('address')){ echo "<span style='color:red; font-size:12px;'>Please enter your address.</span>"; } ?><?php */?>
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Contact Name *</label>
                            <input class="form-control" id="inputEmail" name="name"  type="text" value="<?php echo $pending_data[0]->name; ?>">
                          <?php /*?>  <?php if(form_error('name')){ echo "<span style='color:red; font-size:12px;'>Please enter your contact name.</span>"; } ?><?php */?>
                      </div>
                      
                    <div class="form-group">
                      <label>Phone Number *</label>
                      <input type="text" name="contact" class="form-control" value="<?php echo $pending_data[0]->contact; ?>" />
                      <?php /*?> <?php if(form_error('seats') != ''){ ?><div class="alert-danger"><?php echo form_error('seats'); ?></div><?php } ?><?php */?>
                    </div>
                    
                    </div>
              </div>
              
              </div>
              
              
              
              <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Business References</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                 
                    <!-- text input -->
                    <div class="form-group">
                      <label>Job Description</label>
                      <textarea class="form-control" name="job_details" rows="23" value=""><?php echo $pending_data[0]->job_details; ?></textarea>
                      <?php echo display_ckeditor($ckeditor); ?><?php if(form_error('job_details') != ''){ ?><div class="alert-danger"><?php echo form_error('job_details'); ?></div><?php } ?>
                      
                      <!-- <?php // if(form_error('job_details') != ''){ ?><div class="alert-danger"><?php //echo form_error('job_details'); ?></div><?php// } ?>-->
                    </div>
                    </div>
              </div>
              
              </div>
              
          </div>
          
          <div class="row">
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" class="btn btn-primary">Edit Jobs</button></div>
          </form>
          </div>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div>