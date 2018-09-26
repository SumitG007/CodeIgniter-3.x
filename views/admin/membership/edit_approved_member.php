<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?php echo $company->company_name; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/membership/approved/">Manage Approved Applications</a></li>
            <li class="active">Company Details</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <form role="form" method="post" action="<?php echo base_url(); ?>admin/membership/approved_updaterecord" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $company->id; ?>"  />
          <div class="row">
          <h3 class="box-title"><?php echo validation_errors(); ?></h3>
          </div>
          <div class="row">
           
           <div class="col-md-4">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Company Details</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                    <?php //print_r($company); ?>
                    <!-- text input -->
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_name; ?>" name="company_name" />
                       <input type="hidden" name="prod_cur_img" value="<?php echo $company->comp_logo; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_address; ?>" name="company_address" />
                    </div>
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" value="<?php echo $company->city_name; ?>" name="city_name" />
                    </div>
                    <div class="form-group">
                          <label for="inputCity" >Province</label>
                            <select class="form-control" id="province" name="province"> 
                            
                           <option value="Alberta" <?php if($company->province == 'Alberta'){ ?> selected="selected" <?php } ?>>Alberta</option>
                            <option value="British Columbia" <?php if($company->province == 'British Columbia'){ ?> selected="selected" <?php } ?>>British Columbia</option>
                            <option value="Manitoba" <?php if($company->province == 'Manitoba'){ ?> selected="selected" <?php } ?>>Manitoba</option>
                            <option value="New Brunswick" <?php if($company->province == 'New Brunswick'){ ?> selected="selected" <?php } ?>>New Brunswick</option>
                            <option value="Newfoundland and Labrador" <?php if($company->province == 'Newfoundland and Labrador'){ ?> selected="selected" <?php } ?>>Newfoundland and Labrador</option>
                            <option value="Nova Scotia" <?php if($company->province == 'Nova Scotia'){ ?> selected="selected" <?php } ?>>Nova Scotia</option>
                            <option value="Ontario" <?php if($company->province == 'Ontario'){ ?> selected="selected" <?php } ?>>Ontario</option>
                            <option value="Prince Edward Island" <?php if($company->province == 'Prince Edward Island'){ ?> selected="selected" <?php } ?>>Prince Edward Island</option>
                            <option value="Quebec" <?php if($company->province == 'Quebec'){ ?> selected="selected" <?php } ?>>Quebec</option>
                            <option value="Saskatchewan" <?php if($company->province == 'Saskatchewan'){ ?> selected="selected" <?php } ?>>Saskatchewan</option>

                            
                            </select>
                        </div>
                    <div class="form-group">
                      <label>Postal Code</label>
                      <input type="text" class="form-control" value="<?php echo $company->postal_code; ?>" name="postal_code" />
                    </div>
                    <div class="form-group">
                      <label>Company Representative</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_representative; ?>" name="company_representative" />
                    </div>
                    <div class="form-group">
                      <label>Professional Designations</label>
                      <input type="text" class="form-control" value="<?php echo $company->professional_designations; ?>" name="professional_designations" />
                    </div>
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_title; ?>" name="company_title" />
                    </div>
                    <div class="form-group">
                      <label>Telephone</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_telephone; ?>" name="company_telephone" />
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_email; ?>" name="company_email" />
                    </div>
                    <div class="form-group">
                      <label>Website</label>
                      <input type="text" class="form-control" value="<?php echo $company->company_website; ?>" name="company_website" /><br />
                            <span style="font-size:13px;">( Please add http://. For eg: http://www.xxxxxxxx.com)</span>
                    </div>
                    
                    </div>
              </div>
              
              </div>
              
              
              
              <div class="col-md-4">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Business References</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  
                    <!-- text input -->
                    <div class="form-group">
                      <label>Reference 1 </label>
                      <input type="text" class="form-control" value="<?php echo $company->reference1; ?>" name="reference1" />
                    </div>
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" class="form-control" value="<?php echo $company->reference1_company; ?>" name="reference1_company" />
                    </div>
                    <div class="form-group">
                      <label>Contact Information</label>
                      <input type="text" class="form-control" value="<?php echo $company->reference1_contact; ?>" name="reference1_contact" />
                    </div>
                    <div class="form-group">
                      <label>Reference 2 </label>
                      <input type="text" class="form-control" value="<?php echo $company->reference2; ?>" name="reference2" />
                    </div>
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" class="form-control" value="<?php echo $company->reference2_company; ?>" name="reference2_company" />
                    </div>
                    <div class="form-group">
                      <label>Contact Information</label>
                      <input type="text" class="form-control" value="<?php echo $company->reference2_contact; ?>" name="reference2_contact" />
                    </div>
                    <div class="form-group">
                      <label>Reference 3 </label>
                     <input type="text" class="form-control" value="<?php echo $company->reference3; ?>" name="reference3" />
                    </div>
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" class="form-control" value="<?php echo $company->reference3_company; ?>" name="reference3_company" />
                    </div>
                    <div class="form-group">
                      <label>Contact Information</label>
                      <input type="text" class="form-control" value="<?php echo $company->reference3_contact; ?>" name="reference3_contact" />
                    </div>
                    
                    <div class="form-group">
                    <input type="hidden" name="company_status" value="No" />
                      <input type="checkbox" class="form-control" value="Yes" <?php if($company->company_status == 'Yes'){echo "checked='checked'"; } ?> name="company_status" id="company_status" style="height: 16px;width: 16px; float: left;margin-right: 10px;" /> Enable Company Url & Logo
                    </div>
                    
                    </div>
              </div>
              
              </div>
              
              
              
              <div class="col-md-4">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Membership Details</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                    <!-- text input -->
                    <?php /*?><div class="form-group">
                      <label>Additional Members</label>
                      <textarea class="form-control" rows="3" name="additional_members"><?php echo $company->additional_members; ?></textarea>
                    </div><?php */?>
                    <div class="form-group">
                      <label>Sponsor BOMA Member</label>
                      <input type="text" class="form-control" value="<?php echo $company->sponsor_boma_member; ?>" name="sponsor_boma_member" />
                    </div>
                    <div class="form-group">
                      <label>Membership Type</label>
                      <input type="text" class="form-control" value="<?php echo ucfirst($company->membership_type); ?>" name="membership_type" />
                    </div>
                    <div class="form-group">
                      <label>Membership Fee</label>
                      <input type="text" class="form-control" value="<?php echo $company->membership_fees; ?>" name="membership_fees" />
                    </div>
                    <div class="form-group">
                      <label>Company Description</label>
                       <textarea class="form-control" rows="3" name="company_desc"><?php echo $company->company_desc; ?></textarea>
                    </div>
                 	
                    <div class="form-group">
                      <label>Services 1</label>
                       <select class="form-control" name="service1">
                            <!--<option value="">Select</option>-->
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>" <?php if($company->service1 == $item['sid']){?> selected="selected" <?php } ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Services 2</label>
                       <select class="form-control" name="service2">
                           <!-- <option value="">Select</option>-->
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>" <?php if($company->service2 == $item['sid']){?> selected="selected" <?php } ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Services 3</label>
                       <select class="form-control" name="service3">
                            <option value="">Select</option>
                            <?php foreach($services as $item) { ?>
                            <option value="<?php echo $item['sid']; ?>"  <?php if($company->service3 == $item['sid']){?> selected="selected" <?php } ?>><?php echo $item['service_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Company Logo</label>
                      <?php if(isset($company->comp_logo)){ ?><img src="<?php echo base_url(); ?>images/company/<?php echo $company->comp_logo; ?>" width="100px" height="100px" /><?php } ?>
                      <input type="file" class="form-control" value="" name="comp_logo" />
                    </div>
                    
                    </div>
              </div>
              
              </div>
          </div>
          <div class="row">
          	
            	<div class="col-xs-12" style="text-align:center"><input type="submit" class="btn btn-primary" value="Edit Company Information" /></div>
          
          </div>
          </form>
        </section><!-- /.content -->
      </div>

<script type="text/javascript">

	/*$('#company_status').click (function(){
	  var thisCheck = $(this);
		//alert(thisCheck);
	  if ( thischeck.is(':checked') ) {
		// Do stuff
		alert "yes";
	  }
	});*/

</script>