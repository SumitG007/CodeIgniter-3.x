<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            <?php
			foreach($events_group as $item)
			{	
			$user_data = $this->session->userdata('logged_in_site');
			//print_r($user_data);
			?>
            <form method="post" action="<?php echo base_url(); ?>events/add_to_cart/">
            <input type="hidden" name="member_id" id="" value="<?php echo $user_data['mid']; ?>" /> 
             <input type="hidden" name="event_name" id="" value="<?php echo $item->event_name; ?>" /> 
            <input type="hidden" name="member_name" id="" value="<?php echo $user_data['company_representative']; ?>" /> 
            <input type="hidden" name="event_price" id="" value="<?php echo $item->event_price; ?>" /> 
            <input type="hidden" name="event_type" id="member_type" value="<?php echo $member_type; ?>" />

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2><?php echo $item->event_name; ?></h2>
                    <h3>Location: <?php echo $item->event_location; ?> <span class="pull-right"><?php echo date('d M Y',strtotime($item->start_date)); ?>, <?php echo $item->start_time." - ".$item->end_time; ?></span></h3>
                </div>
            </div>
            <hr>
             <div class="row">
             <p> <?php echo $item->event_desc; ?></p>
                <div class="col-md-6 col-sm-6">
                    <input type="hidden" name="event_id" id="event_id" value="<?php echo $item->id; ?>" />
                    <h3> Your total Registration cost: <?php echo $item->event_price; ?> CAD </h3>
                    <p>Registration Fee:  1 x <?php echo $item->event_price; ?> CAD <!--&nbsp; &nbsp; &nbsp; Tax: 2.15 CAD--></p>
                    <p><a href="<?php echo base_url(); ?>events/event_member_register/<?php echo $item->id; ?>"><input name="" type="button" value="Back"></a> <input name="submit" type="submit" value="Next Step"></p>
                    
                </div>
                <div class="col-md-6 col-sm-6">
                	<h3> Members Information </h3>
                    <p> <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Member</button>
                    
                    <p id="member_data">
                    <?php if(isset($event_member_name)){ 
					foreach($event_member_name as $item1){ //print_r($item1);?>
                    	<?php echo $item1->event_member_name."  -  ".$item1->event_company_name."<br/>"; ?>
                     <?php } 
					 } ?>
                    </p>
                   
                </div>
                
            </div>
            </form>
            <?php } ?>
            
            
          </div>
    </div>
    
    
    
    
    
    
    
    
    
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <?php //if(isset($message)){ echo "<h2><span style='color:red;'>".$message."</span></h2>"; } ?>
        <div class="message" style="display:none;">Event Member Added Successfully...!</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Member</h4>
      </div>
      <form method="post" action="" name="frm1" id="frm1"> 
      <div class="modal-body">
         <div class="form-group">
         <?php $user_data = $this->session->userdata('logged_in_site'); ?>
          <input type="hidden" name="member_id" id="member_id" value="<?php echo $user_data['mid']; ?>" /> 
                          <label for="inputAddress" >Member Name *</label>
                            <input class="form-control" name="event_member_name" id="event_member_name"  type="text" <?php if(form_error('event_member_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('event_member_name'); ?>">
         </div>
         <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" name="event_company_name" id="event_company_name"  type="text" <?php if(form_error('event_company_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('event_company_name'); ?>">
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="add-member" class="btn btn-primary" onclick="SaveMember();">Add Member</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="resultdiv"></div>
<script>
setInterval(function() {
	getChat();
}, 1000);
function SaveMember(){
	//alert("hii");	
	if($("#event_member_name").val() != '')
	{
		var event_member_name = $("#event_member_name").val();
		var event_company_name = $("#event_company_name").val();
		var event_id = $("#event_id").val();
		var member_id = $("#member_id").val();
		$.ajax({
			type:'POST',
			url:'<?php echo base_url(); ?>events/add_event_member',
			data:'event_member_name=' + event_member_name + '&event_company_name=' + event_company_name + '&event_id='+ event_id + '&member_id=' + member_id,
			success:function(data){
				//alert(data);
				$("#frm1")[0].reset();
				$(".message").show();
				$(".message").css("color","red");
				//setInterval(function() {
				//show_data();
				 //$('#myModal').dialog('close');
				/*$('#member_data').append(data);
				$('#member_data').show();*/
			},
		});
		//return false;								
	}else{
		validateForm();
	}
	
	function getChat()
	{
		$.ajax({
			url: "<?php echo base_url(); ?>events/events_individual/",
			type: "POST",
			cache: false,
			data:  'member_id='+ $("#member_id").val(),
			success: function(data) { 
			//alert(data);
				$("#member_data").append(data);
			},
		});			
	}
}
	
function validateForm() {
	var x = document.forms["frm1"]["event_member_name"].value;
	if (x == null || x == "") {
		alert("Member Name must be filled out");
		return false;
	}
}
	
/*var auto_refresh = setInterval(
function()
{
	$('#member_data').refresh().fadeIn("slow");
	$('#member_data').show();
}, 1000);*/
			
</script>
