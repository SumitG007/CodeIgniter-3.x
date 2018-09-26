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
                    <p>Edit the Application Form Below</p>
                </div>
            </div>
            <?php //print_r($member_data);exit; ?>
             <form method="post" action="<?php echo base_url(); ?>members/update_account_information" enctype="multipart/form-data">
            <div class="row" style="margin-top:50px;">                
                
                <div class="col-md-4 col-sm-12">
                   
                      <fieldset>
                        <input class="form-control" id="inputCompanyName"  type="hidden" name="id" value="<?php echo $member_data->id; ?>">
                         <input type="hidden" name="prod_cur_img" value="<?php echo $member_data->comp_logo; ?>" />
                        <legend>Company Details</legend>
                        <p style=" height:80px; font-size:14px;"> Please enter company details below (Including Company Name, Company Representative, and Phone Number)</p>
                        <div class="form-group">
                          <label for="inputCompanyName" >Company Name *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="company_name" <?php if(form_error('company_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->company_name; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Address *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="company_address" <?php if(form_error('company_address') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->company_address ; ?>">
                         </div>
                        <div class="form-group">
                          <label for="inputCity" >City *</label>
                            <input class="form-control" id="inputCity" type="text" name="city_name" <?php if(form_error('city_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->city_name ; ?>">
                        </div>
                        
                         <div class="form-group">
                          <label for="inputCity" >Province</label>
                            <select class="form-control" id="province" name="province"> 
                            
                           <option value="Alberta" <?php if($member_data->province == 'Alberta'){ ?> selected="selected" <?php } ?>>Alberta</option>
                            <option value="British Columbia" <?php if($member_data->province == 'British Columbia'){ ?> selected="selected" <?php } ?>>British Columbia</option>
                            <option value="Manitoba" <?php if($member_data->province == 'Manitoba'){ ?> selected="selected" <?php } ?>>Manitoba</option>
                            <option value="New Brunswick" <?php if($member_data->province == 'New Brunswick'){ ?> selected="selected" <?php } ?>>New Brunswick</option>
                            <option value="Newfoundland and Labrador" <?php if($member_data->province == 'Newfoundland and Labrador'){ ?> selected="selected" <?php } ?>>Newfoundland and Labrador</option>
                            <option value="Nova Scotia" <?php if($member_data->province == 'Nova Scotia'){ ?> selected="selected" <?php } ?>>Nova Scotia</option>
                            <option value="Ontario" <?php if($member_data->province == 'Ontario'){ ?> selected="selected" <?php } ?>>Ontario</option>
                            <option value="Prince Edward Island" <?php if($member_data->province == 'Prince Edward Island'){ ?> selected="selected" <?php } ?>>Prince Edward Island</option>
                            <option value="Quebec" <?php if($member_data->province == 'Quebec'){ ?> selected="selected" <?php } ?>>Quebec</option>
                            <option value="Saskatchewan" <?php if($member_data->province == 'Saskatchewan'){ ?> selected="selected" <?php } ?>>Saskatchewan</option>

                            
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputPcode" >Postal Code *</label>
                            <input class="form-control" id="inputPcode"  type="text" name="postal_code" <?php if(form_error('postal_code') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->postal_code ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputCompRep" >Company Representative *</label>
                            <input class="form-control" id="inputCompRep"  type="text" name="company_representative" <?php if(form_error('company_representative') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->company_representative ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputProDesg" >Professional Designations</label>
                            <input class="form-control" id="inputProDesg" type="text" name="professional_designations" value="<?php echo $member_data->professional_designations ; ?>">
                        </div>
                        
                        <div class="form-group">
                          <label for="inputTitle" >Title</label>
                            <input class="form-control" id="inputTitle" type="text" name="company_title" value="<?php echo $member_data->company_title ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputTelephone" >Telephone</label>
                            <input class="form-control" id="inputTelephone" type="text" name="company_telephone" value="<?php echo $member_data->company_telephone ; ?>">
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Email Address *</label>
                            <input class="form-control" id="inputEmail" type="text" name="company_email" <?php if(form_error('company_email') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->company_email ; ?>">
                        </div>
                        <?php /*?><div class="form-group">
                          <label for="inputEmail" >Password *</label>
                            <input class="form-control" id="member_password" type="text" name="member_password" <?php if(form_error('member_password') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->member_password ; ?>">
                        </div><?php */?>
                        <div class="form-group">
                          <label for="inputWeb" >Website</label>
                            <input class="form-control" id="inputWeb" type="text" name="company_website" value="<?php echo $member_data->company_website ; ?>"><br />
                            <span style="font-size:13px;">( Please add http://. For eg: http://www.xxxxxxxx.com)</span>
                        </div>
                      </fieldset>
                </div>
                
                
                
                <div class="col-md-4 col-sm-12">
                      <fieldset>
                        <legend> Membership Details </legend>
                        <p style=" height:80px; font-size:14px;">Enter Other Membership details below. </p>
                        <?php /*?><div class="form-group">
                          <label for="inputCompanyName" >Additional Members</label>
                            <textarea class="form-control" rows="3" id="textArea" name="additional_members"><?php echo $member_data->additional_members ; ?></textarea>
                            <span class="help-block">Please Include a name and email address for each member</span>
                        </div><?php */?>
                        <div class="form-group">
                          <label for="inputAddress" >Sponsor BOMA Member</label>
                            <input class="form-control" id="inputAddress"  type="text" name="sponsor_boma_member" value="<?php echo $member_data->sponsor_boma_member ; ?>">
                         </div>
                        
                        <?php /*?><div class="form-group" style="margin-top:50px; padding:10px; background-color:#f3f6f7;<?php if(form_error('memType') != ''){ ?>border:1px solid red;<?php } ?>">
                          <label for="inputCity" >Select Membership Type *</label>
                            <div class="radio">
                              <label>
                                <input name="memType" id="optionsRadios1" value="principal" type="radio"  <?php echo set_radio('memType','principal'); ?> >
                                Principal: Members who own or manage office or industrial space
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="memType" id="optionsRadios2" value="allied" type="radio" <?php echo set_radio('memType','allied'); ?>>
                                Allied: Members who provide services to a principal member
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="memType" id="optionsRadios1" value="nfpa" type="radio" <?php echo set_radio('memType','nfpa'); ?>>
                                Not For Profit Affiliate: Non Profit organizations associated with BOMA members or services
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="memType" id="optionsRadios2" value="student" type="radio" <?php echo set_radio('memType','student'); ?>>
                                Student: students enrolled in a BOMI or other recognized real estate course but not employed by a company that is a BOMA member or eligible to become a BOMA member
                              </label>
                            </div>
                        </div>
                        
                        
                        <div class="form-group" id='show-me' style='display:none; background-color:#414756; padding:10px; color:#FFF; font-size:12px;'>
                          <label for="inputCity" >Memerbship fee according to Square Footage Managed *</label>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios1" value="882.00"  type="radio" <?php echo set_radio('membership_fees','882.00'); ?>>
                                0-150,000 sq ft - $882.00
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios2" value="1061.00" type="radio" <?php echo set_radio('membership_fees','1061.00'); ?>>
                                150,000-500,000 sq ft - $1061.00
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios1" value="1475.00" type="radio" <?php echo set_radio('membership_fees','1475.00'); ?>>
                                500,000+ sq ft -  $1475.00
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios2" value="562.00" type="radio" <?php echo set_radio('membership_fees','562.00'); ?>>
                                Principal Territorial -  $562.00
                              </label>
                            </div>
                        </div>
                        
                        
                         <div class="form-group" id='allied-show-me' style='display:none; background-color:#414756; padding:10px; color:#FFF; '>
                          
                          <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios3" value="1,444.00" type="radio" <?php echo set_radio('membership_fees','1,444.00'); ?>>
                               Memerbship fee : $1,444.00
                              </label>
                            </div>
                        </div>
                        
                        <div class="form-group" id='nfpa-show-me' style='display:none; background-color:#414756; padding:10px; color:#FFF; '>
                           <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios5" value="1,003.00" type="radio" <?php echo set_radio('membership_fees','1,003.00'); ?>>
                               Memerbship fee : $1,003.00
                              </label>
                           </div>   
                        </div>
                        
                        <div class="form-group" id='student-show-me' style='display:none; background-color:#414756; padding:10px; color:#FFF; '>
                          	<div class="radio">
                              <label>
                               <input name="membership_fees" id="optionsRadios6" value="642.00" type="radio" <?php echo set_radio('membership_fees','642.00'); ?>>
                               Memerbship fee : $642.00
                              </label>
                           </div>
                        </div>
                        <?php */?>
                        
                        
                        
                          <?php
							$this->load->model("servicesModel");
							$services = $this->servicesModel->get_services_name();
							//print_r($services);
						?>
                      <div class="form-group">
                          <label for="inputCity" >Choose Services1 *</label>
                            <select class="form-control" name="service1" <?php if(form_error('service1') != ''){ ?>style="border:1px solid red;"<?php } ?> >
                            
                            <option value="">Select</option>
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>" <?php if($member_data->service1 == $item['sid']){ ?> selected="selected" <?php } ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="inputCity" >Choose Services2 *</label>
                            <select class="form-control" name="service2" <?php if(form_error('service2') != ''){ ?>style="border:1px solid red;"<?php } ?> >
                            <option value="">Select</option>
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>" <?php if($member_data->service2 == $item['sid']){ ?> selected="selected" <?php } ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="inputCity" >Choose Services3 *</label>
                            <select class="form-control" name="service3" <?php if(form_error('service3') != ''){ ?>style="border:1px solid red;"<?php } ?> >
                            <option value="">Select</option>
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>" <?php if($member_data->service3 == $item['sid']){ ?> selected="selected" <?php } ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group" style=" margin-top:30px; ">
                          <label for="textArea" >Company Description *</label>
                            <textarea class="form-control" rows="3" id="textArea" name="company_desc" <?php if(form_error('company_desc') != ''){ ?>style="border:1px solid red;"<?php } ?> ><?php echo $member_data->company_desc ; ?></textarea>
                            Please provide a brief (up to 25 words) description of your firm's activities, specialties, and/or history for inclusion in the BOMA Edmonton Membership Directory
                        </div>
                       
                      </fieldset>
                </div>
                
                
                <div class="col-md-4 col-sm-12">
                      <fieldset>
                        <legend> Business References </legend>
                        <p style="height:80px;  font-size:14px;"> Please List three Business References below along with their contact information (Including Company Name, Contact Name, and Phone Number)</p>
                        <div class="form-group">
                          <label for="inputCompanyName" >Reference 1 *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="reference1" <?php if(form_error('reference1') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference1 ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="reference1_company" <?php if(form_error('reference1_company') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference1_company ; ?>">
                         </div>   
                        <div class="form-group" style="margin-bottom:60px;">
                          <label for="inputCity" >Phone Number *</label>
                            <input class="form-control" id="inputCity" type="text" name="reference1_contact" <?php if(form_error('reference1_contact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference1_contact ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputCompanyName" >Reference 2 *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="reference2" <?php if(form_error('reference2') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference2 ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="reference2_company" <?php if(form_error('reference2_company') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference2_company ; ?>">
                        <div class="form-group" style="margin-bottom:60px;">
                          <label for="inputCity" >Phone Number *</label>
                            <input class="form-control" id="inputCity" type="text" name="reference2_contact" <?php if(form_error('reference2_contact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference2_contact ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputCompanyName" >Reference 3 *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="reference3" <?php if(form_error('reference3') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference3 ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="reference3_company" <?php if(form_error('reference3_company') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference3_company ; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputCity" >Phone Number *</label>
                            <input class="form-control" id="inputCity" type="text" name="reference3_contact" <?php if(form_error('reference3_contact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo $member_data->reference3_contact ; ?>">
                        </div>
                        <?php
							//$this->load->model("servicesmodel");
							//$services = $this->servicesmodel->get_services_name();
							//print_r($services);
						?>
                    
                        
                        <div class="form-group">
                      <label>Company Logo</label>
                      <?php if(isset($member_data->comp_logo) && count($member_data->comp_logo) > 0 ){ ?>
                      		<img src="<?php echo base_url(); ?>images/company/<?php echo $member_data->comp_logo; ?>" width="100px" height="100px" />
					  <?php } ?>
                      <input type="file" class="form-control" value="" name="comp_logo" size="20" />
                            <div><?php //if (isset($success_msg)) { echo $success_msg; } ?></div>
                            
                        </div>
                        
                       
                    
                    <?php /*?><div class="form-group"> 
                         <label>Captcha:</label> 
                        <?php // echo form_error('g-recaptcha-response','<div style="color:red;">','</div>');?>
                        <div class="g-recaptcha" data-sitekey="6LdwNRYTAAAAAJr3t8RowILwOtRiLPYAuhIj7B0p" <?php if(form_error('g-recaptcha-response') != ''){ ?>style="border:1px solid red;"<?php } ?> ></div>
   						
                    </div><?php */?>
                    
                      </fieldset>
                </div>
                
                
            </div>
            
            <div class="row" style="margin-top:40px; margin-bottom:50px;">
            	<div class="col-md-12 col-sm-12">
                	<?php /*?>Please Read the following and Check below if agree to the BOMA Edmonton Membership Terms:
                    <p> In making this application, I agree to abide by the <a href="#">BOMA Edmonton Code of Conduct</a> and by the by-laws of the Association. Upon payment of membership dues and approval by the BOMA Edmonton Board of Directors, I will be entitled to all the rights and privileges as a member of BOMA Edmonton. I further understand that my membership will be cancelled on non-payment of dues.</p>    
                    <p>Please Check one*</p>
                   	 <div class="radio">
                              <label>
                                <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
                                I Agree
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio">
                                I Disagree
                              </label>
                     </div><?php */?>
                     <div class="form-group" style="margin-top:20px;">
                          <div>
                            <input type="submit" class="btn btn-primary" value="Save" />
                            <?php /*?><button type="reset" class="btn btn-default">Reset Information</button><?php */?>
                            
                          </div>
                     </div>
                        
                </div>
            </div>
           
            </form>
            
            
          </div>

    <!-- Inner page content Ends -->