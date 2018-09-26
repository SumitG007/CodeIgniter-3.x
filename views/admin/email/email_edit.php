<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Events</h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/email">Manage Emails</a></li>
            <li class="active">List of Emails</li>
          </ol>
        </section>

        <!-- Main content -->
              <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/email/update_data">
          <div class="row">
      	   <?php //print_r($eventsitem); ?>
           <div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Edit Email</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  	<?php //print_r($ArrEmailTemplate); ?>
                    <!-- text input -->
                    <div class="form-group">
                     <label>Template Title : </label>
      <input type="text" placeholder="Template Title" class="form-control" name="template_name" value="<?php echo $ArrEmailTemplate[0]['template_name']; ?>">
                      <?php if(form_error('template_name') != ''){ ?><div class="alert-danger"><?php echo form_error('template_name'); ?></div><?php } ?>
                    </div>
                     <input type="hidden" name="template_id" value="<?php echo $ArrEmailTemplate[0]['template_id']; ?>" />
                     <div class="form-group">
                      <label>Primary Template : </label>
                      <select name="primary_template" id="primary_template" class="form-control">
                      <option value=''>--Select--</option>
                      <option value='admin' <?php if ($ArrEmailTemplate[0]['primary_template']  =="admin") {  echo "selected"; } ?>>Administrator</option>
                      <option value='user' <?php if ($ArrEmailTemplate[0]['primary_template']  =="user") {  echo "selected"; } ?>>User</option>
                      
                      </select>
                      <?php echo form_error('primary_template'); ?>
                    </div>
    				
                    <div class="form-group">
                      <label>From Email : </label>
                      <input type="text" placeholder="From Email" class="form-control" name="from_email" value="<?php echo $ArrEmailTemplate[0]['from_email']; ?>">
                      <?php echo form_error('from_email'); ?>
                    </div>
                    <div class="form-group">
                      <label>From Email : </label>
                      <input type="text" placeholder="From Name" class="form-control" name="from_name" value="<?php echo $ArrEmailTemplate[0]['from_name']; ?>">
                      <?php echo form_error('from_name'); ?>
                    </div>
                    <div class="form-group">
                      <label>Reply Email : </label>
                      <input type="text" placeholder="From Name" class="form-control" name="reply_email" value="<?php echo $ArrEmailTemplate[0]['reply_email']; ?>">
                      <?php echo form_error('reply_email'); ?>
                    </div>
                    
                    <div class="form-group">
                    <b><u>Admin Details:</u></b>
                    </div>
                    <div class="form-group">
                      <label>Mail Send To Admin?: </label>
                        <input type="radio" name="admin_email_y_n" value="Y" <?php if ($ArrEmailTemplate[0]['admin_email_y_n']  =="Y") {  echo "checked"; } ?> onClick="displayOption('div_admin_details','y');">Yes
                        <input type="radio" name="admin_email_y_n" value="N" <?php if ($ArrEmailTemplate[0]['admin_email_y_n']  =="N") {  echo "checked"; } ?> onClick="displayOption('div_admin_details','n');">No
                    </div>
                    <div class="form-group div_admin_details">
                      <label>Admin Email Type : </label>
                        <input type="radio" name="admin_email_type" value="to" <?php if ($ArrEmailTemplate[0]['admin_email_type']  =="to") {  echo "checked"; } ?>>To
                        <input type="radio" name="admin_email_type" value="cc" <?php if ($ArrEmailTemplate[0]['admin_email_type']  =="cc") {  echo "checked"; } ?>>CC
                        <input type="radio" name="admin_email_type" value="bcc" <?php if ($ArrEmailTemplate[0]['admin_email_type']  =="bcc") {  echo "checked"; } ?>>BCC
                    </div>
                    <div class="form-group div_admin_details">
                      <label>Admin Emails : </label>
                      <input type="text" placeholder="Emails" class="form-control" name="admin_email" value="<?php echo $ArrEmailTemplate[0]['admin_email']; ?>">
                      <?php echo form_error('admin_email'); ?>
                    </div>
                   
                    
                     <div class="form-group div_admin_details">
                      <label>Admin Email Subject : </label>
                      <input type="text" placeholder="Email Subject" class="form-control" name="admin_email_subject" value="<?php echo $ArrEmailTemplate[0]['admin_email_subject']; ?>">
                      <?php echo form_error('admin_email_subject'); ?>
                    </div>
                    
                    <div class="form-group div_admin_details">
                      <label>Admin Email Description : </label>
                      <textarea placeholder="Admin Email Description" rows="3" class="form-control" id="content" name="admin_email_template" style="float:left;width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $ArrEmailTemplate[0]['admin_email_template']; ?></textarea>
                      <?php echo display_ckeditor($ckeditor); ?>
                      <?php echo form_error('admin_email_template'); ?>
                    </div>
                    
    			</div>
                </div>
    		</div>
    
    
    		<div class="col-md-6">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                   
                    
    				 <div class="form-group div_user_details" >
                    <b><u style="margin-top:10px;">User Details:</u></b>
                    </div>
                    
                    <div class="form-group div_user_details">
                      <label>Mail Send To USer?: </label>
                        <input type="radio" name="user_email_y_n" value="Y" <?php if ($ArrEmailTemplate[0]['user_email_y_n']  =="Y") {  echo "checked"; } ?> onClick="displayOption('div_user_details','y');">Yes
                        <input type="radio" name="user_email_y_n" value="N" <?php if ($ArrEmailTemplate[0]['user_email_y_n']  =="N") {  echo "checked"; } ?> onClick="displayOption('div_user_details','n');">No
                    </div>
                    <div class="form-group div_user_details">
                      <label>User Email Type : </label>
                        <input type="radio" name="user_email_type" value="to" <?php if ($ArrEmailTemplate[0]['user_email_type']  =="to") {  echo "checked"; } ?>>To
                        <input type="radio" name="user_email_type" value="cc" <?php if ($ArrEmailTemplate[0]['user_email_type']  =="cc") {  echo "checked"; } ?>>CC
                        <input type="radio" name="user_email_type" value="bcc" <?php if ($ArrEmailTemplate[0]['user_email_type']  =="bcc") {  echo "checked"; } ?>>BCC
                    </div>
                    <div class="form-group div_user_details">
                      <label>User Email Subject : </label>
                      <input type="text" placeholder="Email Subject" class="form-control" name="user_email_subject" value="<?php echo $ArrEmailTemplate[0]['user_email_subject']; ?>">
                      <?php echo form_error('user_email_subject'); ?>
                    </div>
                    <div class="form-group div_user_details">
                      <label>User Email Description : </label>
                      <textarea placeholder="User Email Description" rows="3" class="form-control" id="content1" name="user_email_template" style="float:left;width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $ArrEmailTemplate[0]['user_email_template']; ?></textarea>
                      <?php echo display_ckeditor($ckeditor1); ?>
                      <?php echo form_error('user_email_template'); ?>
                    </div>
                    <div class="form-group">
                        <label>Is Active : </label>        
                        <div class="checkbox">
                        <label>
                          <input type="radio" name="active" value="1" <?php if ($ArrEmailTemplate[0]['active']  =="1") {  echo "checked"; } ?>>Yes
                        
                        <input type="radio" name="active" value="0" <?php if ($ArrEmailTemplate[0]['active']  =="0") {  echo "checked"; } ?>>No
                        </label>
                        </div>      
                        <?php echo form_error('is_active'); ?> 
                    </div>
    
          
          
          </div>
           </div>
	  		</div>
            </div>
            <div class="row"> 
          	
            	<div class="col-xs-12" style="text-align:center"><button type="submit" class="btn btn-primary">Edit Email</button></div></div>
            
          </form>
        </section><!-- /.content --><!-- /.content --><!-- /.content --><!-- /.content -->
     
	  <script>
function displayOption(divname,val)
{
	if(val=='y')
	{
		$("."+divname).show();
	}
	else
	{
		$("."+divname).hide();
	}	
}
</script>