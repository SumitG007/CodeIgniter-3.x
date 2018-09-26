<style>
.fee {display:none; background-color:#414756; padding:10px; color:#FFF; font-size:12px;}
</style>
<div class="container">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                <?php //if (isset($error)) { echo $error; } ?>
                <?php //echo validation_errors('<p class="form_error" style="color:red;">','</p>'); ?>
                <?php if($message != ''){ echo "<h2><span style='color:red;'>".$message."</span></h2>"; } 
				//$message = 'Google reCaptcha'; ?>
                    <h2>Apply Now - BOMA Edmonton Membership Application</h2>
                    <p>Complete the Application Form Below</p>
                </div>
            </div>
            
             <form method="post" action="<?php echo base_url(); ?>members/save_member" enctype="multipart/form-data">
            <div class="row" style="margin-top:50px;">                
                
                <div class="col-md-4 col-sm-12">
                   
                      <fieldset>
                        
                        <legend>Company Details</legend>
                        <p style=" height:80px; font-size:14px;"> Please enter company details below (Including Company Name, Company Representative, and Phone Number)</p>
                        <div class="form-group">
                          <label for="inputCompanyName" >Company Name *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="company_name" <?php if(form_error('company_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('company_name')?>">
                            <?php if(form_error('company_name')){ echo "<span style='color:red; font-size:12px;'>Please enter company name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Address *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="company_address" <?php if(form_error('company_address') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('company_address')?>">
                            <?php if(form_error('company_address')){ echo "<span style='color:red; font-size:12px;'>Please enter company address.</span>"; } ?>
                         </div>
                        <div class="form-group">
                          <label for="inputCity" >City *</label>
                            <input class="form-control" id="inputCity" type="text" name="city_name" <?php if(form_error('city_name') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('city_name')?>">
                            <?php if(form_error('city_name')){ echo "<span style='color:red; font-size:12px;'>Please enter city name.</span>"; } ?>
                        </div>
                         <div class="form-group">
                          <label for="inputCity" >Province *</label>
                            <select class="form-control" id="province" name="province" <?php if(form_error('province') != ''){ ?>style="border:1px solid red;"<?php } ?>> 
                            
                            <option value=" ">Please Select </option>
                            <option value="Alberta" <?php echo set_select('province','Alberta'); ?>>Alberta</option>
                            <option value="British Columbia" <?php echo set_select('province','British Columbia'); ?>>British Columbia</option>
                            <option value="Manitoba" <?php echo set_select('province','Manitoba'); ?>>Manitoba</option>
                            <option value="New Brunswick" <?php echo set_select('province','New Brunswick'); ?>>New Brunswick</option>
                            <option value="Newfoundland and Labrador" <?php echo set_select('province','Newfoundland and Labrador'); ?>>Newfoundland and Labrador</option>
                            <option value="Nova Scotia" <?php echo set_select('province','Nova Scotia'); ?>>Nova Scotia</option>
                            <option value="Ontario" <?php echo set_select('province','Ontario'); ?>>Ontario</option>
                            <option value="Prince Edward Island" <?php echo set_select('province','Prince Edward Island'); ?>>Prince Edward Island</option>
                            <option value="Quebec" <?php echo set_select('province','Quebec'); ?>>Quebec</option>
                            <option value="Saskatchewan" <?php echo set_select('province','Saskatchewan'); ?>>Saskatchewan</option>

                            
                            </select>
                             <?php if(form_error('province')){ echo "<span style='color:red; font-size:12px;'>Please select province.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputPcode" >Postal Code *</label>
                            <input class="form-control" id="inputPcode"  type="text" name="postal_code" <?php if(form_error('postal_code') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('postal_code')?>">
                            <?php if(form_error('postal_code')){ echo "<span style='color:red; font-size:12px;'>Please enter your postal code.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputCompRep" >Company Representative *</label>
                            <input class="form-control" id="inputCompRep"  type="text" name="company_representative" <?php if(form_error('company_representative') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('company_representative')?>">
                            <?php if(form_error('company_representative')){ echo "<span style='color:red; font-size:12px;'>Please enter your full name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputProDesg" >Professional Designations</label>
                            <input class="form-control" id="inputProDesg" type="text" name="professional_designations" value="<?php echo set_value('professional_designations'); ?>">
                        </div>
                        
                        <div class="form-group">
                          <label for="inputTitle" >Title</label>
                            <input class="form-control" id="inputTitle" type="text" name="company_title" value="<?php echo set_value('company_title'); ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputTelephone" >Telephone *</label>
                            <input class="form-control" id="inputTelephone" type="text" name="company_telephone" <?php if(form_error('company_telephone') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('company_telephone')?>">
                            <?php if(form_error('company_telephone')){ echo "<span style='color:red; font-size:12px;'>Please enter contact phone number.</span>"; } ?>
                        </div>
                         <div class="form-group">
                          <label for="inputEmail" >Email Address *</label>
                            <input class="form-control" id="inputEmail" type="text" name="company_email" <?php if(form_error('company_email') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('company_email')?>">
                            <?php if(form_error('company_email')){ echo "<span style='color:red; font-size:12px;'>Please enter email address.</span>"; } ?>
                            <?php //if(isset($message)){ echo "<span style='color:red; font-size:12px;'>".$message".</span>"; } ?>
                            <?php //if($email_check != ''){ echo "<h2><span style='color:red;'>".$email_check."</span></h2>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputWeb" >Website</label>
                            <input class="form-control" id="inputWeb" type="text" name="company_website" value="<?php echo set_value('company_website'); ?>"><br />
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
                            <textarea class="form-control" rows="3" id="textArea" name="additional_members"><?php echo set_value('additional_members');?></textarea>
                            <span class="help-block">Please Include a name and email address for each member</span>
                        </div><?php */?>
                        <div class="form-group">
                          <label for="inputAddress" >Sponsor BOMA Member</label>
                            <input class="form-control" id="inputAddress"  type="text" name="sponsor_boma_member" value="<?php echo set_value('sponsor_boma_member'); ?>">
                         </div>
                        
                        <div class="form-group" style="margin-top:50px; padding:10px; background-color:#f3f6f7;<?php if(form_error('memType') != ''){ ?>border:1px solid red;<?php } ?>">
                        <?php if(form_error('memType')){ echo "<span style='color:red; font-size:12px;'>Please select membership type.</span>"; } ?>
                          <label for="inputCity" >Select Membership Type *</label>
                            <div class="radio member">
                              <label>
                                <input name="memType" id="optionsRadios1" value="principal" type="radio"  <?php echo set_radio('memType','principal'); ?> />
                                Principal: Members who own or manage office or industrial space
                              </label>
                            </div>
                            <div class="radio member">
                              <label>
                                <input name="memType" id="optionsRadios2" value="allied" type="radio" <?php echo set_radio('memType','allied'); ?>>
                                Allied: Members who provide services to a principal member
                              </label>
                            </div>
                            <div class="radio member">
                              <label>
                                <input name="memType" id="optionsRadios1" value="nfpa" type="radio" <?php echo set_radio('memType','nfpa'); ?>>
                                Not For Profit Affiliate: Non Profit organizations associated with BOMA members or services
                              </label>
                            </div>
                            <div class="radio member">
                              <label>
                                <input name="memType" id="optionsRadios2" value="student" type="radio" <?php echo set_radio('memType','student'); ?>>
                                Student: students enrolled in a BOMI or other recognized real estate course but not employed by a company that is a BOMA member or eligible to become a BOMA member
                              </label>
                            </div>
                        </div>
                     
                        
                        <div class="form-group fee" id='show-me' <?php if(form_error('membership_fees') != ''){ ?>style="border:1px solid red;"<?php } ?>>
                        <?php if(form_error('membership_fees')){ echo "<span style='color:red; font-size:12px;'>Please select Membership Fees.</span>"; } ?>
                          <label for="inputCity" >Memerbship fee according to Square Footage Managed *</label>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios1" value="932.00"  type="radio" <?php echo set_radio('membership_fees','932.00'); ?>>
                                0-150,000 sq ft - $932.00
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios2" value="1111.00" type="radio" <?php echo set_radio('membership_fees','1111.00'); ?>>
                                150,000-500,000 sq ft - $1111.00
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios3" value="1525.00" type="radio" <?php echo set_radio('membership_fees','1525.00'); ?>>
                                500,000+ sq ft -  $1525.00
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios4" value="612.00" type="radio" <?php echo set_radio('membership_fees','612.00'); ?>>
                                Principal Territorial -  $612.00
                              </label>
                            </div>
                        </div>
                        
                        
                         <div class="form-group fee" id='allied-show-me'  <?php if(form_error('membership_fees') != ''){ ?>style="border:1px solid red;"<?php } ?>>
                        <?php if(form_error('membership_fees')){ echo "<span style='color:red; font-size:12px;'>Please select Membership Fees.</span>"; } ?>
                          
                          <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios11" value="932.00" type="radio" <?php echo set_radio('membership_fees','932.00'); ?>>
                               Memerbship fee : $932.00
                              </label>
                            </div>
                        </div>
                        
                        <div class="form-group fee" id='nfpa-show-me'  <?php if(form_error('membership_fees') != ''){ ?>style="border:1px solid red;"<?php } ?>>
                        <?php if(form_error('membership_fees')){ echo "<span style='color:red; font-size:12px;'>Please select Membership Fees.</span>"; } ?>
                           <div class="radio">
                              <label>
                                <input name="membership_fees" id="optionsRadios2" value="612.00" type="radio" <?php echo set_radio('membership_fees','612.00'); ?>>
                               Memerbship fee : $612.00
                              </label>
                           </div>   
                        </div>
                        
                        <div class="form-group fee" id='student-show-me' <?php if(form_error('membership_fees') != ''){ ?>style="border:1px solid red;"<?php } ?>>
                        <?php if(form_error('membership_fees')){ echo "<span style='color:red; font-size:12px;'>Please select Membership Fees.</span>"; } ?>
                          	<div class="radio">
                              <label>
                               <input name="membership_fees" id="optionsRadios6" value="129.00" type="radio" <?php echo set_radio('membership_fees','129.00'); ?>>
                               Memerbship fee : $129.00
                              </label>
                           </div>
                        </div>
                         
                        
                        
                        
                        
                        
                        <div class="form-group" style=" margin-top:30px; ">
                          <label for="textArea" >Company Description *</label>
                            <textarea class="form-control" rows="3" id="textArea" name="company_desc" <?php if(form_error('company_desc') != ''){ ?>style="border:1px solid red;"<?php } ?> ><?php echo set_value('company_desc')?></textarea>
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
                            <input class="form-control" id="inputCompanyName"  type="text" name="reference1" <?php if(form_error('reference1') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference1')?>">
                            <?php if(form_error('reference1')){ echo "<span style='color:red; font-size:12px;'>Please enter reference company's member name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="reference1_company" <?php if(form_error('reference1_company') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference1_company')?>">
                             <?php if(form_error('reference1_company')){ echo "<span style='color:red; font-size:12px;'>Please enter reference company's name.</span>"; } ?>
                         </div>   
                        <div class="form-group" style="margin-bottom:60px;">
                          <label for="inputCity" >Phone Number *</label>
                            <input class="form-control" id="inputCity" type="text" name="reference1_contact" <?php if(form_error('reference1_contact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference1_contact')?>">
                            <?php if(form_error('reference1_contact')){ echo "<span style='color:red; font-size:12px;'>Please enter reference member's phone number.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputCompanyName" >Reference 2 *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="reference2" <?php if(form_error('reference2') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference2')?>">
                            <?php if(form_error('reference2')){ echo "<span style='color:red; font-size:12px;'>Please enter reference company's member name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="reference2_company" <?php if(form_error('reference2_company') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference2_company')?>">
                            <?php if(form_error('reference2_company')){ echo "<span style='color:red; font-size:12px;'>Please enter reference company's name.</span>"; } ?>
                        </div>    
                        <div class="form-group" style="margin-bottom:60px;">
                          <label for="inputCity" >Phone Number *</label>
                            <input class="form-control" id="inputCity" type="text" name="reference2_contact" <?php if(form_error('reference2_contact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference2_contact')?>">
                            <?php if(form_error('reference2_contact')){ echo "<span style='color:red; font-size:12px;'>Please enter reference member's phone number.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputCompanyName" >Reference 3 *</label>
                            <input class="form-control" id="inputCompanyName"  type="text" name="reference3" <?php if(form_error('reference3') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference3')?>">
                            <?php if(form_error('reference3')){ echo "<span style='color:red; font-size:12px;'>Please enter reference company's member name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" >Company Name *</label>
                            <input class="form-control" id="inputAddress"  type="text" name="reference3_company" <?php if(form_error('reference3_company') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference3_company')?>">
                            <?php if(form_error('reference3_company')){ echo "<span style='color:red; font-size:12px;'>Please enter reference company's name.</span>"; } ?>
                        </div>
                        <div class="form-group">
                          <label for="inputCity" >Phone Number *</label>
                            <input class="form-control" id="inputCity" type="text" name="reference3_contact" <?php if(form_error('reference3_contact') != ''){ ?>style="border:1px solid red;"<?php } ?> value="<?php echo set_value('reference3_contact')?>">
                            <?php if(form_error('reference3_contact')){ echo "<span style='color:red; font-size:12px;'>Please enter reference member's phone number.</span>"; } ?>
                        </div>
                        <?php
							               $this->load->model("servicesModel");
							               $services = $this->servicesModel->get_services_name();
							          ?>
                        <div class="form-group">
                          <label for="inputService1" >Choose Services1 *</label>
                            <select class="form-control" id="service1" name="service1" <?php if(form_error('service1') != ''){ ?>style="border:1px solid red;"<?php } ?>> 
                            
                            <option value="">Select</option>
                            <?php foreach($services as $item) { 	?>
                            <option value="<?php echo $item['sid']; ?>" <?php echo set_select('service1',$item['sid']); ?>><?php echo $item['service_name']; //echo set_value('service1')?></option>
                            <?php } ?>
                            </select>
                            
                            <?php if(form_error('service1') != ''){ echo "<span style='color:red; font-size:12px;'>Please select type of service.</span>"; } 
							/*
							if(form_error('service1') == form_error('service2')){
									echo "<span style='color:red; font-size:12px;'>Please choose another service.</span>";
							}else if(form_error('service2') == form_error('service3')){
									echo "<span style='color:red; font-size:12px;'>Please choose another service.</span>";	
							}else{
									echo "<span style='color:red; font-size:12px;'>Please choose another service.</span>"; 
							}*/?>
                        </div> 
                        <div class="form-group">
                          <label for="inputService2" >Choose Services2</label>
                            <select class="form-control" id="service2" name="service2" <?php if(form_error('service2') != ''){ ?>style="border:1px solid red;"<?php } ?> >
                           
                            <option value="">Select</option>
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>"  <?php echo set_select('service2',$item['sid']); ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                            </select>
                            
                             <?php //if(form_error('service2') != ''){ echo "<span style='color:red; font-size:12px;'>Please select type of service.</span>"; } 
							 
							//if(form_error('service1') == form_error('service2') && form_error('service2') == form_error('service3') && form_error('service1') == form_error('service3')){ echo "<span style='color:red; font-size:12px;'>Please choose another service.</span>"; }?>
                             
                        </div>
                        <div class="form-group">
                          <label for="inputService3" >Choose Services3</label>
                            <select class="form-control" id="service3" name="service3" <?php if(form_error('service3') != ''){ ?>style="border:1px solid red;"<?php } ?> >
                           
                            <option value="">Select</option>
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>"  <?php echo set_select('service3',$item['sid']); ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                            </select>
                            
                             <?php //if(form_error('service3') != ''){ echo "<span style='color:red; font-size:12px;'>Please select type of service.</span>"; } 
							// if(form_error('service1') == form_error('service2') && form_error('service2') == form_error('service3') && form_error('service1') == form_error('service3')){ echo "<span style='color:red; font-size:12px;'>Please choose another service.</span>"; }?>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputCompLogo" >Company Logo</label>
                            <input class=""  type="file" name="comp_logo" value="" size="20"  onchange="return validateFileExtension(this)" /> <?php /*?><?php if(form_error('comp_logo') != ''){ ?>style="border:1px solid red;"<?php } ?><?php */?>
                             <?php //if(form_error('comp_logo')){ echo "<span style='color:red; font-size:12px;'>Image upload size is larger.</span>"; } ?>
                            
                            
                        </div>
                        
                       
                      <div class="form-group">
					  <?php //echo $image; ?>
                      </div>
                    <div class="form-group"> 
                         <label>Captcha:</label> 
                        <?php echo form_error('g-recaptcha-response','<div style="color:red;">','</div>');?>
                        <div class="g-recaptcha" data-sitekey="6LcWLSAUAAAAABES-jGAlgtkVO8gO8nhcoPqMlN2" <?php if(form_error('g-recaptcha-response') != ''){ ?>style="border:1px solid red;"<?php } ?> ></div>
   						
                    </div>
                    
                      </fieldset>
                </div>
                
                
            </div>
            
            <div class="row" style="margin-top:40px; margin-bottom:50px;">
            	<div class="col-md-12 col-sm-12">
                	Please Read the following and Check below if agree to the BOMA Edmonton Membership Terms:
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
                     </div>
                     <div class="form-group" style="margin-top:20px;">
                          <div>
                            <input type="submit" class="btn btn-primary" value="Submit Application"  />
                            <button type="reset" class="btn btn-default">Reset Information</button>
                            
                          </div>
                     </div>
                        
                </div>
            </div>
            </form>
            
            
          </div>
 </div>
    <!-- Inner page content Ends -->
    
<script type="text/javascript">

function validateFileExtension(fld)
{
    if(!/(\.bmp|\.png|\.gif|\.jpg|\.jpeg)$/i.test(fld.value))
	{
		fld.form.reset();
        fld.setAttribute("style", "border:1px solid red;");
		return false;   
    }
	fld.setAttribute("style", "");
    return true; 
 }

						  
</script>