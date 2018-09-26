<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Menus</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>courses">Manage Courses</a></li>
            <li class="active">List of Courses</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/courses/addrecord">
          <div class="row">
           
           
           
         <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Add New Course</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Coures Name *</label>
                      <input type="text" class="form-control" name="course_name" value="<?php echo set_value('course_name')?>"/>
                      <?php if(form_error('course_name') != ''){ ?><div class="alert-danger"><?php echo form_error('course_name'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Location *</label>
                      <input type="text" class="form-control" name="course_location" value="<?php echo set_value('course_location')?>" />
                       <?php if(form_error('course_location') != ''){ ?><div class="alert-danger"><?php echo form_error('course_location'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Category *</label>
                      <select class="form-control" name="course_category">
                      	<option>Select Category</option>
                        <option value="1">RPF</option>
                        <option value="2">FMA</option>
                      </select>
                       <?php if(form_error('course_category') != ''){ ?><div class="alert-danger"><?php echo form_error('course_category'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Start Date *</label>
                       <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="start_date" value="<?php echo set_value('start_date')?>"/>
                                    <?php if(form_error('start_date') != ''){ ?><div class="alert-danger"><?php echo form_error('start_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                      
                    </div>
                    <div class="form-group">
                      <label>End Date *</label>
                      <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" name="end_date" value="<?php echo set_value('end_date')?>" />
                                    <?php if(form_error('end_date') != ''){ ?><div class="alert-danger"><?php echo form_error('end_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                    </div>
                    
                    </form>
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
                    
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Time  *</label>
                      <input type="text" class="form-control" name="timing"  value=""/>
                      
                    </div>
                    <div class="form-group">
                      <label>Price *</label>
                      <input type="text" class="form-control" name="course_price" value="<?php echo set_value('course_price')?>"/>
                       <?php if(form_error('course_price') != ''){ ?><div class="alert-danger"><?php echo form_error('course_price'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Instructors *</label>
                      <input type="text" class="form-control" name="instructors" value="<?php echo set_value('instructors')?>" />
                       <?php if(form_error('instructors') != ''){ ?><div class="alert-danger"><?php echo form_error('instructors'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Designation *</label>
                      <input type="text" class="form-control" name="designations" value="<?php echo set_value('designations')?>" />
                       <?php if(form_error('designations') != ''){ ?><div class="alert-danger"><?php echo form_error('designations'); ?></div><?php } ?>
                    </div>
                    </form>
                    </div>
              </div>
              
              </div>
              
              
          </div>
          
          <div class="row">
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" class="btn btn-primary">Add New Course</button></div>
          
          </div>
          </form>
        </section><!-- /.content -->
      </div>