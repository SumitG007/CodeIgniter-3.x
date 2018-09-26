<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Add New Event</h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events">Manage Events</a></li>
            <li class="active">New Event</li>
          </ol>
        </section>

        <!-- Main content -->
              <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/events/addrecord" enctype="multipart/form-data">
          <div class="row">
           
           
      	
           <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Add New Event</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  
                    <!-- text input -->
                    <div class="form-group">
                      <label>Event Name *</label>
                      <input type="text" class="form-control" name="event_name" value="<?php echo set_value('event_name')?>"/>
                      <?php if(form_error('event_name') != ''){ ?><div class="alert-danger"><?php echo form_error('event_name'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Location *</label>
                      <input type="text" class="form-control" name="event_location" value="<?php echo set_value('event_location')?>" />
                      <?php if(form_error('event_location') != ''){ ?><div class="alert-danger"><?php echo form_error('event_location'); ?></div><?php } ?>
                    </div>
         
                    <div class="form-group">
                      <label>Start Date *</label>
                       <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' name="start_date" id="start_date" class="form-control" value="<?php echo set_value('start_date')?>" />
                                     <?php if(form_error('start_date') != ''){ ?><div class="alert-danger"><?php echo form_error('start_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                      
                    </div>
                    
                   
                    <?php /*?><div class="form-group">
                      <label>End Date *</label>
                      <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' name="end_date" class="form-control" value="<?php echo set_value('end_date')?>" />
                                     <?php if(form_error('end_date') != ''){ ?><div class="alert-danger"><?php echo form_error('end_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                    </div><?php */?>
                    <div class="form-group">
                      <label>Enter Event Timings  * (for eg: 10:00am -  10:00pm)</label>
                      <input type="text"  class="form-control" name="timing" value="<?php echo set_value('timing')?>"/>
					  <?php if(form_error('timing') != ''){ ?><div class="alert-danger"><?php echo form_error('timing'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Price per ticket *</label>
                      <input type="text" name="event_price" class="form-control" value="<?php echo set_value('event_price')?>"/>
                       <?php if(form_error('event_price') != ''){ ?><div class="alert-danger"><?php echo form_error('event_price'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Total Number of Seats for entire event  *</label>
                      <input type="text" name="seats" id="seats" class="form-control" value="<?php echo set_value('seats')?>" />
                       <?php if(form_error('seats') != ''){ ?><div class="alert-danger"><?php echo form_error('seats'); ?></div><?php } ?>
                    </div>
                    
                    <div class="form-group">
                      <label>Event Image *</label>
                      <input type="file" name="event_image" class="form-control" />
                       <?php /*?><?php //if(form_error('seats') != ''){ ?><div class="alert-danger"><?php echo form_error('seats'); ?></div><?php } ?><?php */?>
                    </div>
                    
                    
                    <div class="form-group">
                      <label>Set Max Limit Per Member *</label>
                      <input type="text" name="num_of_members" id="num_of_members" class="form-control" value="<?php echo set_value('num_of_members'); ?>"  />
                      <?php //if($this->form_validation->set_value('num_of_members',0) > $this->form_validation->set_value('seats',0)){ echo '<div class="error">please select number of members less than seats.</div>'; } ?>
                     <?php /*?> <?php if(set_value('seats') < set_value('num_of_members')){ ?><div class="alert-danger"><?php echo "Please enter max member values less than seats."; ?></div> <?php  } ?><?php */?>
                       <?php if(form_error('num_of_members') != ''){ ?><div class="alert-danger"><?php echo form_error('num_of_members'); ?></div><?php }?>
                       <div id="error" style="color:#F00;display:none;">please enter selected members less than seats.</div>
                    </div>
                    
                    </div>   
              </div>
              
              </div>
              
              
              
              <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Event Description</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                 
                    <!-- text input -->
                    <div class="form-group">
                      <textarea class="form-control" name="event_desc" id="event_desc" rows="23" value=""><?php echo set_value('event_desc')?></textarea>
                       <?php if(form_error('event_desc') != ''){ ?><div class="alert-danger"><?php echo form_error('event_desc'); ?></div><?php } ?>
                    </div>
                    
                     <div class="form-group">
                      <label>Event Close Date *</label>
                       <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' name="event_close_date" id="event_close_date" class="form-control" value="<?php echo set_value('event_close_date')?>" />
                                     <?php if(form_error('event_close_date') != ''){ ?><div class="alert-danger"><?php echo form_error('event_close_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                      
                    </div>
                    
                     <div class="form-group">
                     <input type="hidden" name="event_payonline_status" value="No" />
                      <input type="checkbox" class="form-control" value="Yes" name="event_payonline_status" id="event_payonline_status" style="height: 16px;width: 16px; float: left;margin-right: 10px;" /> Pay Online
                    </div>
                    
                    <div class="form-group">
                    <input type="hidden" name="event_paylater_status" value="No" /> 
                      <input type="checkbox" class="form-control" value="Yes" name="event_paylater_status" id="	event_paylater_status" style="height: 16px;width: 16px; float: left;margin-right: 10px;" /> Pay Offline
                    </div>
                    
                    </div>
              </div>
              
              </div>
              
          </div>
          
          <div class="row"> 
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" id="submit" class="btn btn-primary" >Add New Event</button></div>
          </form>
          </div>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div> 
      
  <script type="text/javascript" src="<?php echo base_url(); ?>admintheme/js/jquery.js"></script>     
<script language="javascript" type="text/javascript">
					
/*$(document).ready(function(){
	$("#num_of_members").blur(function(){
		var num_of_members = $('#num_of_members').val();
		var seats = $('#seats').val();
		//hasError = false;
		if (seats <= num_of_members) {
			$("#error").show().fadeIn('slow').delay(3000).fadeOut('slow');
			return false;
		}
		//if(hasError == true) { return false; }
	});
});
*/</script>