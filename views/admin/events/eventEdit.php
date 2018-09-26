<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Events</h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events">Manage Events</a></li>
            <li class="active">List of Events</li>
          </ol>
        </section>

        <!-- Main content -->
              <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/events/updaterecord">
          <div class="row">
      	   <?php //print_r($eventsitem); ?>
           <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Edit Event</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  	<?php //print_r($eventsitem); ?>
                    <!-- text input -->
                    <div class="form-group">
                      <label>Event Name *</label>
                      <input type="text" class="form-control" name="event_name" value="<?php echo $eventsitem->event_name; ?>"/>
                      <?php if(form_error('event_name') != ''){ ?><div class="alert-danger"><?php echo form_error('event_name'); ?></div><?php } ?>
                    </div>
                     <input type="hidden" name="id" value="<?php echo $eventsitem->id; ?>" />
                    <div class="form-group">
                      <label>Location *</label>
                      <input type="text" class="form-control" name="event_location" value="<?php echo $eventsitem->event_location; ?>" />
                      <?php if(form_error('event_location') != ''){ ?><div class="alert-danger"><?php echo form_error('event_location'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Start Date *</label>
                       <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' name="start_date" id="start_date" class="form-control" value="<?php echo date('d-m-Y',strtotime($eventsitem->start_date)); ?>" />
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
                                    <input type='text' name="end_date" class="form-control" value="<?php echo date('m/d/Y',strtotime($eventsitem->end_date)); ?>" />
                                     <?php if(form_error('end_date') != ''){ ?><div class="alert-danger"><?php echo form_error('end_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                    </div><?php */?>
                    <div class="form-group">
                      <label>Enter Event Timings  * (for eg: 10:00am -  10:00pm)</label>
                      <input type="text" name="timing"  class="form-control" value="<?php echo $eventsitem->start_time." - ".$eventsitem->end_time; ?>"/>
                    </div>
                    <div class="form-group">
                      <label>Price Per Ticket*</label>
                      <input type="text" name="event_price" class="form-control" value="<?php echo $eventsitem->event_price; ?>"/>
                       <?php if(form_error('event_price') != ''){ ?><div class="alert-danger"><?php echo form_error('event_price'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label>Total Number of Seats for entire event *</label>
                      <input type="text" name="seats" class="form-control" value="<?php echo $eventsitem->total_seats; ?>" />
                       <?php if(form_error('seats') != ''){ ?><div class="alert-danger"><?php echo form_error('seats'); ?></div><?php } ?>
                    </div>
                    
                    <div class="form-group">
                      <label>Set Max Limit Per Member *</label>
                      <input type="text" name="num_of_members" id="num_of_members" class="form-control" value="<?php echo $eventsitem->num_of_members; ?>" />
                       <?php if(form_error('num_of_members') != ''){ ?><div class="alert-danger"><?php echo form_error('num_of_members'); ?></div><?php } ?>
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
                      
                      <textarea class="form-control" name="event_desc" rows="20" value=""><?php echo $eventsitem->event_desc; ?></textarea>
                       <?php if(form_error('event_desc') != ''){ ?><div class="alert-danger"><?php echo form_error('event_desc'); ?></div><?php } ?>
                    </div>
                    
                  
                    <div class="form-group">
                      <label>Event Close Date *</label>
                       <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' name="event_close_date" id="event_close_date" class="form-control" value="<?php echo date('d-m-Y',strtotime($eventsitem->event_close_date)); ?>" />
                                     <?php if(form_error('event_close_date') != ''){ ?><div class="alert-danger"><?php echo form_error('event_close_date'); ?></div><?php } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                      
                    </div>
                    
                    <div class="form-group">
                     <input type="hidden" name="event_payonline_status" value="No" />
                      <input type="checkbox" class="form-control" value="Yes" <?php if($eventsitem->event_payonline_status == 'Yes'){echo "checked='checked'"; } ?> name="event_payonline_status" id="event_payonline_status" style="height: 16px;width: 16px; float: left;margin-right: 10px;" /> Pay Online
                    </div>
                    
                    <div class="form-group">
                    <input type="hidden" name="event_paylater_status" value="No" /> 
                      <input type="checkbox" class="form-control" value="Yes" <?php if($eventsitem->event_paylater_status == 'Yes'){echo "checked='checked'"; } ?> name="event_paylater_status" id="	event_paylater_status" style="height: 16px;width: 16px; float: left;margin-right: 10px;" /> Pay Offline
                    </div>
                    
                    </div>
              </div>
              
              </div>
              
          </div>
          
          <div class="row"> 
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" class="btn btn-primary">Edit New Event</button></div>
          
          </div>
          </form>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div>