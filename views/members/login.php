<div class="container">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
             <?php echo $breadcrumb; ?>
            </ol>
            
             
            <div class="row" style="margin-top:10px; margin-bottom:30px;">
                <form method="post" action="<?php echo base_url(); ?>members/logindo">
                
                 <div class="col-md-6 col-sm-6">
                    <h2>Company Representative Login</h2>
                    <?php if(validation_errors() != '')  { ?>
							<div style="color:#F00;"> <?php //echo validation_errors(); ?> </div>
					<?php } else  { ?>
                    		<p>Please enter your email address and password below.</p>
                    <?php } ?>
                    <fieldset style="margin-top:15px">
                        <div class="form-group">
                          <label for="inputCompanyName" >Enter your e-mail address*</label>
                            <input class="form-control" id="txtusername1" name="txtusername1"  type="text" style="width:80%" <?php if(form_error('txtusername1') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('txtusername1')?>">
                            <?php if(form_error('txtusername1')){ echo "<span style='color:red; font-size:12px;'>Please enter valid email address.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Enter your password *</label>
                            <input class="form-control" id="txtpassword1" name="txtpassword1"  type="password" style="width:80%" <?php if(form_error('txtpassword1') != ''){ ?>style="border:1px solid red;"<?php } ?>>
                            <?php if(form_error('txtpassword1')){ echo "<span style='color:red; font-size:12px;'>Please enter correct password.</span>"; } ?>
                         </div>
                         
                          <p> <a href="<?php echo base_url(); ?>members/forgot_password">Forgot Password?</a> </p>    
                     	<div class="form-group" style="margin-top:20px;">
                          <div>
                            <input type="submit" class="btn btn-primary" value="Login Now"  />
                          </div>
                     </div>
                      </fieldset>
                </div>
                 </form> 
               <!--  <form method="post" action="<?php// echo base_url(); ?>members/verify">
                <div class="col-md-6 col-sm-6">
                      <h2>Company Members Login</h2>
                    <p>Please enter your username and password below.</p>
                    <fieldset style="margin-top:15px">
                        <div class="form-group">
                          <label for="inputCompanyName" >Username *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" style="width:80%">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Password *</label>
                            <input class="form-control" id="inputAddress"  type="password" style="width:80%">
                         </div>
                         
                          <p> <a href="#">Forgot Password?</a> </p>    
                     	<div class="form-group" style="margin-top:20px;">
                          <div>
                            <input type="submit" class="btn btn-primary" value="Login Now"   />
                          </div>
                     </div>
                      </fieldset>
                </div>
               </form> -->
            </div>
            
            
            
          </div>
 </div>
    <!-- Inner page content Ends -->