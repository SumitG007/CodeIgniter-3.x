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
                <?php if($message != ''){ echo "<h2><span style='color:red;'>".$message."</span></h2>"; } 
				//$message = 'Google reCaptcha'; ?>
                    <h2>BOMA Edmonton Membership Application</h2>
                    <p>Password should be minimum 4 and maximum of 8 characters (numbers and special characters are allowed)</p><br/>
                
            
            <?php //print_r($member_data);exit; ?>
             <form method="post" action="<?php echo base_url(); ?>members/change_password" enctype="multipart/form-data">
             
            <div class="row" style="margin-top:50px;">                
                
                <div class="col-md-4 col-sm-12">
                   
                      <fieldset>
                        <input class="form-control" id="inputCompanyName"  type="hidden" name="id" value="<?php echo $member_data->id; ?>">
                  
                        <div class="form-group">
                          <label for="inputEmail" >Password *</label>
                            <input class="form-control" id="member_password" type="password" name="member_password" <?php if(form_error('member_password') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->member_password ; ?>">
                        </div>
                        
                        <div class="form-group">
                          <div>
                            <input type="submit" class="btn btn-primary" value="Change Password" />
                            <?php /*?><button type="reset" class="btn btn-default">Reset Information</button><?php */?>
                            
                          </div>
                     </div>
                        
                      </fieldset>
                </div>
                
                
            </div>
            
            
            
            </form>
            </div>
            </div>
          </div>
 </div>
    <!-- Inner page content Ends -->