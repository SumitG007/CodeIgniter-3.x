<div class="container">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            <?php if($message != ''){ ?>
             <div class="row">
             	<div class="col-md-12">
                      <p><?php echo "<span class='btn btn-danger btn-xs'>".$message."</span>";  ?></p>
                </div>
             </div>
             <?php } ?>
             
            <div class="row" style="margin-top:10px; margin-bottom:30px;">
                
                <div class="col-md-12 col-sm-12">
                      
                      <div style="margin-bottom:30px;">
                      <h4>Post Your Job Here. For non-members it is 150.00 + GST charge for 3 months </h4>
                      </div>
                      <form name="frmmember" method="post" action="<?php echo base_url(); ?>pages/save_post_jobs" >                      
                      
                      <div class="col-md-6 col-sm-12">
                      <fieldset>
                        <div class="form-group">
                          <label for="inputCompanyName" >Job Name *</label>
                            <input class="form-control" id="inputCompanyName"  name="txtjob_name"  type="text" <?php if(form_error('txtjob_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtjob_name')?>">
                            <?php if(form_error('txtjob_name')){ echo "<span style='color:red; font-size:12px;'>Please enter a job title.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Enter Start Date *</label>
                            <div class="form-group">
                                <div class='input-group date' >
                                    <input class="form-control" name="txtstart_date" id='start_date' type="text" <?php if(form_error('txtstart_date') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtstart_date')?>" />
                                    <?php if(form_error('txtstart_date')){ echo "<span style='color:red; font-size:12px;'>Please enter start date.</span>"; } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                         </div>
                          <div class="form-group">
                          	<label for="inputAddress" >Enter End Date *</label>
                            <div class="form-group">
                                <div class='input-group date' >
                                    <input class="form-control" name="txtend_date" id='end_date' type="text" <?php if(form_error('txtend_date') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtend_date')?>" />
                                    <?php if(form_error('txtend_date')){ echo "<span style='color:red; font-size:12px;'>Please enter end date.</span>"; } ?>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Email Address *</label>
                            <input class="form-control" id="inputEmail" name="txtemail"  type="text" <?php if(form_error('txtemail') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtemail')?>">
                            <?php /*?><?php if(form_error('txtemail')){ echo "<span style='color:red; font-size:12px;'>Please enter another email.</span>"; } ?><?php */?>
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
                        </fieldset>
                      </div>
                      
                      <div class="col-md-6 col-sm-12">
                      	<fieldset>
                        <div class="form-group">
                          <label for="inputEmail" >Phone Number *</label>
                            <input class="form-control" id="inputEmail" name="txtcontact"  type="text" <?php if(form_error('txtcontact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtcontact')?>">
                            <?php if(form_error('txtcontact')){ echo "<span style='color:red; font-size:12px;'>Please enter phone number.</span>"; } ?>
                        </div>
                        
                      	 <div class="form-group">
                          <label for="inputAddress" >Job Description *</label>
                            <textarea class="form-control" rows="15" cols="10" name="txtjob_details" <?php if(form_error('txtjob_details') != ''){ ?>style="border:1px solid red;"<?php } ?>> <?php echo set_value('txtjob_details')?></textarea>
                            <?php echo display_ckeditor($ckeditor); if(form_error('txtjob_details')){ echo "<span style='color:red; font-size:12px;'>Please enter job description.</span>"; }  ?> 
                         </div>
                        </fieldset>
                      </div>
				
                	  <div class="col-md-12 col-sm-12">
                      
                      		<div class="form-group" style="margin-top:20px;">
                                <input type="submit" class="btn btn-primary" value="Submit Job" />
                                
                            </div>
                      
                      </div>
                      
                	</form>
                    
                	</div>
            </div>
            
            
            
          </div>
 </div>