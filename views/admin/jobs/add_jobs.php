<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Jobs</h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/jobs/approved">Manage Approved Jobs</a></li>
            <li class="active">List of Jobs</li>
          </ol>
        </section>

        <!-- Main content -->
              <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/jobs/add_jobs_record">
          <div class="row">
           
           
      	
           <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Add New Job</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  	<?php //print_r($viewdata);//exit; ?>
                    <!-- text input -->
                    <div class="form-group">
                      <label>Job Name *</label>
                      <input type="text" class="form-control" name="job_name"/>
                      <?php if(form_error('job_name') != ''){ ?><div class="alert-danger"><?php echo form_error('job_name'); ?></div><?php } ?>
                    </div>
                    
                    
                    <div class="form-group">
                      <label>Enter Start Date*</label>
                       <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' name="start_date" id="start_date" class="form-control" />
                                    <?php if(form_error('start_date') != ''){ ?><div class="alert-danger"><?php echo form_error('start_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                      
                    </div>
                    <div class="form-group">
                      <label>Enter End Date*</label>
                      <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' name="end_date" id="end_date" class="form-control" />
                                    <?php if(form_error('end_date') != ''){ ?><div class="alert-danger"><?php echo form_error('end_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                    </div>
                    <?php /*?><div class="form-group">
                      <label>Timings  *</label>
                      <input type="text" name="timing"  class="form-control" />
                    </div><?php */?>
                    <div class="form-group">
                      <label>Email Address*</label>
                      <input type="text" name="email" class="form-control" />

                      <?php if(form_error('email') != ''){ ?><div class="alert-danger"><?php echo form_error('email'); ?></div><?php } ?>
                    </div>
                    
                      <div class="form-group">
                          <label for="inputEmail" >Company Name *</label>
                            <input class="form-control" id="inputEmail" name="company_name"  type="text" <?php if(form_error('company_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('company_name')?>">
                            <?php if(form_error('company_name')){ echo "<span style='color:red; font-size:12px;'>Please enter your company name.</span>"; } ?>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputEmail" >Address *</label>
                            <input class="form-control" id="inputEmail" name="address"  type="text" <?php if(form_error('address') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('address')?>">
                            <?php if(form_error('address')){ echo "<span style='color:red; font-size:12px;'>Please enter your address.</span>"; } ?>
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Contact Name *</label>
                            <input class="form-control" id="inputEmail" name="name"  type="text" <?php if(form_error('name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('name')?>">
                            <?php if(form_error('name')){ echo "<span style='color:red; font-size:12px;'>Please enter your contact name.</span>"; } ?>
                      </div>
                    <div class="form-group">
                      <label>Phone number *</label>
                      <input type="text" name="contact" class="form-control"  />
                      <?php if(form_error('contact') != ''){ ?><div class="alert-danger"><?php echo form_error('contact'); ?></div><?php } ?>
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
                      <label>Job Description *</label>
                      <textarea class="form-control" rows="3" id="job_details" name="job_details" placeholder="Add Content"><?php echo set_value('job_details')?></textarea>
	         		  <?php echo display_ckeditor($ckeditor); ?><?php if(form_error('job_details') != ''){ ?><div class="alert-danger"><?php echo form_error('job_details'); ?></div><?php } ?>
                      
                      <!--<textarea class="form-control" name="job_details" rows="16" ></textarea>
                       <?php //if(form_error('job_details') != ''){ ?><div class="alert-danger"><?php //echo form_error('job_details'); ?></div><?php //} ?>-->
                    </div>
                    </div>
              </div>
              
              </div>
              
          </div>
          
          <div class="row">
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" class="btn btn-primary">Add New Jobs</button></div>
          </form>
          </div>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div>