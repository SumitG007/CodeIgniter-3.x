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
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/events/addsubmemberrecord" enctype="multipart/form-data">
          <div class="row">
           
           
      	
           <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Add New Event</h3>
                   	
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  <?php //print_r($Events); ?>
                    <!-- text input -->
                    <div class="form-group">
                      <label>Event Name *</label>
                      <input type="text" class="form-control" name="event_name" value="<?php echo $Events[0]->event_name; ?>" readonly="readonly"/>
                      <?php if(form_error('event_name') != ''){ ?><div class="alert-danger"><?php echo form_error('event_name'); ?></div><?php } ?>
                    </div>
                    
                    
                     <div class="form-group">
                      <label>Company Member Name *</label>
                       <div class="form-group">
                     	<select name="member_id" id="member_id" class="form-control" required>
                     	<option value="">Select</option>
                        <?php if(isset($members)){ foreach($members as $item1)
						{ //print_r($item1); ?>
                        <option value="<?php echo $item1->id; ?>"><?php echo $item1->company_representative; ?></option>
                        <?php } 
						} ?>					
							
                     </select>
                      <?php if(form_error('member_id') != ''){ ?><div class="alert-danger"><?php echo form_error('member_id'); ?></div><?php } ?>
                     </div>
                    </div>
            
                    <p>
                    Please select below number of members going to attend the event.
                    </p>
                   
                   <?php 
				  
					$i =1;
					foreach($Events as $item)
					{
				        ?>
	         
                    <p><select class="form-control" name="member_register" id="member_register" required>
                    <option>Select</option>
                                
                    </select></p>
                            
                  	<?php if(form_error('member_register') != ''){ ?><div class="alert-danger"><?php echo form_error('member_register'); ?></div><?php } ?>
                    				
					<input name="event_id" id="event_id" class="form-control" type="hidden" value="<?php echo $item->id; ?>">
                    <input name="event_price" class="form-control" type="hidden" value="<?php echo $item->event_price; ?>">
                    
                    <?php
					
						
					 // $c = uniqid (rand(), true);
					$alpha_numeric1 = '0123456789';
					$register_id = substr(str_shuffle($alpha_numeric1), 0, 3);
					?>
					
                     <input name="event_register_id" id="event_register_id" class="form-control" type="hidden" value="<?php echo $register_id; ?>">
                     <?php
				}?>
                    
                    </div>   
              </div>
              
              </div>
              
              
              
              <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Event Sub Members</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                 
                    <!-- text input -->
                    <div class="form-group">
                      <p>
                    Please enter below the name of members.
                    </p>
                    <p>
                    <div id="result_data"></div>
                    </p> 
                    </div>
                    
                    
                    </div>
              </div>
              
              </div>
              
          </div>
          
          <div class="row">  
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" id="submit" class="btn btn-primary" >Add New Event Members</button></div>
          </form>
          </div>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
      </div> 
      
 <script type="text/javascript">
	$(document).ready(function(){
		$("#member_id").change(function(){
			//alert("hiii");
			//var formData = {name:"ravi",age:"31"}; //Array 
 			var member_id = $("#member_id").val();
			var formData = 'member_id=' + member_id + '&event_id=' + $("#event_id").val();
			//alert(formData);
			$.ajax({
				url : '<?php echo base_url(); ?>admin/events/evevt_numberof_members/',
				type: 'POST',
				data : formData,
				dataType: 'json',
				success: function(data)
				{
					 $("#member_register").html('');
						if(data > 0 && data != '') {
							$("#member_register").append("<option value=''>Select</option>");
							 //var numberSelected = 1;
							for(var j = 1; j<= data; j++) {
								
								$("#member_register").append("<option value='"+j+"'>"+j+"</option>");
							}
						}else{
							$("#member_register").append("<option value=''>Select</option>");
							$("#member_register").append("<option value='0'>0</option>");
							return false;
						}
					
				}
			});					
		});//
		
		$("#member_register").change(function(){
			var selectedText = $("#member_register").find("option:selected").text();
            var selectedValue = $("#member_register").val();
  			var event_register_id = $("#event_register_id").val();
			 $("#result_data").html('');
				if(selectedValue > 0) {
					 //var numberSelected = 1;
					for(var i = 1; i<= selectedValue; i++) {
						
						$("#result_data").append('<label>Member Name :    </label><input class="form-control" type="text" name="member_name[]" id="member_name" value=""  required="required"/><br/><div id="member_name-error" style="display:none;color:#F00;">Please Enter Url.</div><br/><input class="form-control" type="hidden" name="seat_booked[]" value="" /><input class="form-control" type="hidden" name="event_register_id" id="event_register_id" value="'+event_register_id+'" />');
					//numberSelected++;	
					}
					
					
					/* if (isEmpty(document.getElementById("event_register_id").value))
					{
					  document.getElementById("event_register_id").value = 1;
					}
					else
					{
					  document.getElementById("event_register_id").value++;
					}*/
				}
			});
	});
	
	</script>