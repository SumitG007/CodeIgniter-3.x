<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Manage Events</h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events">Manage Events Sub Members</a></li>
            <li class="active">New Event</li>
          </ol>
        </section>

        <!-- Main content -->
              <section class="content">
          <!-- /.row -->
          <form role="form" name="form1" method="post" action="<?php echo base_url(); ?>admin/events/confirm_delete_events/" enctype="multipart/form-data">
          <div class="row">
           
           
      	
           <div class="col-md-12">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Events Sub Members</h3>
                   	
                </div><!-- /.box-header -->
              		<div class="box-body">
                      <div class="form-group"> 
                      <label>Event Sub-member Name *</label><br/><br/>
                  <?php //print_r($events_sub_members);// exit;
				  	foreach($events_sub_members as $item)
					{
						//print_r($item);
						?>
				  		<input type="hidden" name="event_id" value="<?php echo $item->event_id; ?>"/>
                        
                        <input type="hidden" name="member_id" value="<?php echo $item->member_id; ?>"/>
                        
                        <input type="hidden" name="event_price" value="<?php echo $item->event_price; ?>"/>
                        
                        <input type="hidden" name="event_reg_id" value="<?php echo $item->event_register_id; ?>"/>
                  
                      <input type="checkbox" name="event_register_id[]" id="confirm" value="<?php echo $item->event_member_name; ?>"/>     <?php echo $item->event_member_name; ?><br/>
                     
					  <?php 
				  }?>
                    </div>
                     <div class="form-group"><button type="submit" id="submit" class="btn btn-primary" onclick="checkthebox()" >Delete Event Members</button></div>
                    
                    
                    </div>   
              </div>
              
              </div>
              
           </div>
           </form>
           </section>
 </div>
 
 <script language="JavaScript" type="text/JavaScript">

$('#submit').click(function () {
    if (!$('#confirm').is(':checked')) {
        alert('Please tick the checkbox');
        return false;
    }
});

</script>