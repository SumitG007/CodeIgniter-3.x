<div class="container">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            
             <div class="row">
             	<div class="col-md-12">
                      <p><strong>Welcome, <?php echo $member->company_representative; ?></strong><br>You are representative of <?php echo $member->company_name; ?>. </p>
                </div>
             </div>
             <hr>
            <div class="row" style="margin-top:10px; margin-bottom:30px;">
                 <?php $this->load->view('members/sidebar'); ?>
                <div class="col-md-10 col-sm-12">
                      
                      <div style="margin-bottom:30px;">
                      <h4>Add New Company Member</h4>
                      </div>
                      
                      <form name="frmmember" method="post" action="<?php echo base_url(); ?>members/save_new_member" >
                      <input type="hidden" name="cid" value="<?php echo $member->id; ?>"  />
                      <div class="col-md-6 col-sm-12">
                      <fieldset>
                        <div class="form-group">
                          <label for="inputCompanyName" >Full Name *</label>
                            <input class="form-control" id="inputCompanyName" name="txtname"  type="text" <?php if(form_error('txtname') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtname')?>">
                            <?php if(form_error('txtname')){ echo "<span style='color:red; font-size:12px;'>Please enter name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                            <!-- For Username availibility box-->
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content" style="padding:10px;">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Status</h4>
                                  </div>
                                  <div class="alert alert-success" role="alert"> Well done! The Username is available. </div>
                                  <div class="alert alert-danger" role="alert"> Warning! Better try again, this username is not available. </div>
                                </div>
                              </div>
                            </div>
                        <label for="inputCompanyName" >Create Username * </label><span class="pull-right"></span>
                        <input class="form-control" id="inputCompanyName" name="txtusername"  type="text" <?php if(form_error('txtusername') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtusername')?>">
                        <?php if(form_error('txtusername')){ echo "<span style='color:red; font-size:12px;'>Please enter username.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Enter New Password *</label><span class="pull-right"><input name="memType" id="generatepass" value="<?php echo substr( str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?"), 0, 12 ); ?>" type="checkbox"> Select Password</span>
                            <input class="form-control" id="inputpassword" name="txtpassword"  type="text" <?php if(form_error('txtpassword') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtpassword')?>">
                            <?php if(form_error('txtpassword')){ echo "<span style='color:red; font-size:12px;'>Please select random password checkbox.</span>"; } ?>
                         </div>
                          <div class="form-group">
                          <label for="inputTelephone" >Telephone</label>
                            <input class="form-control" id="inputTelephone" name="txttelephone" type="text">
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Email Address *</label>
                            <input class="form-control" id="inputEmail" name="txtemail" type="text" <?php if(form_error('txtemail') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtemail')?>">
                            <?php if(form_error('txtemail')){ echo "<span style='color:red; font-size:12px;'>Please enter valid email address.</span>"; } ?>
                        </div>
                        </fieldset>
                      </div>
                      
                      <div class="col-md-6 col-sm-12">
                      	<fieldset>
                      	 <div class="form-group">
                          <label for="inputAddress" >Address *</label>
                            <input class="form-control" id="inputAddress" name="txtaddress"   type="text" <?php if(form_error('txtaddress') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtaddress')?>">
                            <?php if(form_error('txtaddress')){ echo "<span style='color:red; font-size:12px;'>Please enter address.</span>"; } ?>
                         </div>
                        <div class="form-group">
                          <label for="inputCity" >City *</label>
                            <input class="form-control" id="inputCity" name="txtcity"  type="text" <?php if(form_error('txtcity') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtcity')?>">
                            <?php if(form_error('txtcity')){ echo "<span style='color:red; font-size:12px;'>Please enter city name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputPcode" >Postal Code *</label>
                            <input class="form-control" id="inputPcode" name="txtpostal"   type="text" <?php if(form_error('txtpostal') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtpostal')?>">
                            <?php if(form_error('txtpostal')){ echo "<span style='color:red; font-size:12px;'>Please enter postal code.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputProDesg" >Professional Designations</label>
                            <input class="form-control" id="inputProDesg" name="txtdesignations"  type="text">
                        </div>
                        </fieldset>
                      </div>
				
                	  <div class="col-md-12 col-sm-12">
                      
                      		 <div class="form-group" style="margin-top:20px;">
                                <input type="submit" class="btn btn-primary" value="Submit"  />
                                <button type="reset" class="btn btn-default">Cancel</button>
                            </div>
                      
                      </div>
                      
                      </form>
                
                	</div>
            </div>
            
            
            
          </div>
 </div>
