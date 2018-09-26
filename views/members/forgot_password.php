<div class="container">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
             <?php echo $breadcrumb; ?>
            </ol>
            <div class="row">
                <div class="col-md-12 col-sm-12">
  
               
		
                </div>
            </div>
			
            <div class="flash-message-success" style="display:none;color:#f00;">Password mailed successfully</div>
            <div class="row" style="margin-top:10px; margin-bottom:30px;">
                <form  id="form1"method="post" action="<?php echo base_url(); ?>members/forgot_password">
                
                 <div class="col-md-6 col-sm-6">
                 	
                    <h2>Company Representative Login</h2>
                    <?php if(validation_errors() != '')  { ?>
							<div style="color:#F00;"> <?php echo validation_errors(); ?> </div>
					<?php }elseif(isset($error)){ ?>
							<div style="color:#F00;"> <?php echo $error; ?> </div> 
					<?php }else{ ?>
                    		<p>Please enter your Email below.</p>
                    <?php } ?>
                     <?php  ?>
                    <fieldset style="margin-top:15px">
                        <div class="form-group">
                          <label for="inputCompanyName" >Email *</label>
                            <input class="form-control" id="txtemail" name="txtemail"  type="text" style="width:80%" <?php if(form_error('txtemail') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtemail')?>" />
                            
                        </div>
                                                
                    	<div class="form-group" style="margin-top:20px;">
                          <div>
                            <input type="submit" id="submit" class="btn btn-primary" value="Submit"  />
                          </div>
                     </div>
                      </fieldset>
                </div>
                 </form> 
                  
            </div>
            
            
            
          </div>
 </div>
    <!-- Inner page content Ends -->
    
    <script type="text/javascript">
	
	$(document).ready(function() {
		/*var email = $("#txtemail").val();
		$("#submit").click(function(){
			if(email != ''){
	  // fade out flash 'success' messages
			   $('.flash-message-success').show();
			   return false;
			}
	  //$('.flash-message-success').delay(1000).hide('highlight', {color: '#66cc66'}, 1500);
	});*/
	});
	
	</script>