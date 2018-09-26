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
          <div class="row">
           
           
           
           <div class="col-md-4">		
              <!-- general form elements disabled -->
              <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Company Details</h3>
                </div><!-- /.box-header -->
              		<div class="box-body">
                    
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Company Name:</label>
                      <?php echo $company->company_name; ?>
                    </div>
                    <div class="form-group">
                      <label>Address:</label>
                      <?php echo $company->company_address; ?>
                    </div>
                    <div class="form-group">
                      <label>City:</label>
                      <?php echo $company->city_name; ?>
                    </div>
                    <div class="form-group">
                      <label>Postal Code</label>
                      <?php echo $company->postal_code; ?>
                    </div>
                    <div class="form-group">
                      <label>Company Representative:</label>
                      <?php echo $company->company_representative; ?>
                    </div>
                    <div class="form-group">
                      <label>Professional Designations:</label>
                      <?php echo $company->professional_designations; ?>
                    </div>
                    <div class="form-group">
                      <label>Title:</label>
                      <?php echo $company->company_title; ?>
                    </div>
                    <div class="form-group">
                      <label>Telephone:</label>
                      <?php echo $company->company_telephone; ?>
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <?php echo $company->company_email; ?>
                    </div>
                    <div class="form-group">
                      <label>Website</label>
                      <?php echo $company->company_website; ?>
                    </div>
                    </form>
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
                    
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Reference 1: </label>
                      <?php echo $company->reference1; ?>
                    </div>
                    <div class="form-group">
                      <label>Company Name:</label>
                      <?php echo $company->reference1_company; ?>
                    </div>
                    <div class="form-group">
                      <label>Contact Information:</label>
                      <?php echo $company->reference1_contact; ?>
                    </div>
                    <div class="form-group">
                      <label>Reference 2: </label>
                      <?php echo $company->reference2; ?>
                    </div>
                    <div class="form-group">
                      <label>Company Name:</label>
                      <?php echo $company->reference2_company; ?>
                    </div>
                    <div class="form-group">
                      <label>Contact Information:</label>
                      <?php echo $company->reference2_contact; ?>
                    </div>
                    <div class="form-group">
                      <label>Reference 3: </label>
                     <?php echo $company->reference3; ?>
                    </div>
                    <div class="form-group">
                      <label>Company Name:</label>
                      <?php echo $company->reference3_company; ?>
                    </div>
                    <div class="form-group">
                      <label>Contact Information:</label>
                      <?php echo $company->reference3_contact; ?>
                    </div>
                    </form>
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
                    
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Additional Members:</label>
                      <?php echo $company->additional_members; ?>
                    </div>
                    <div class="form-group">
                      <label>Sponsor BOMA Member:</label>
                      <?php echo $company->sponsor_boma_member; ?>
                    </div>
                    <div class="form-group">
                      <label>Membership Type:</label>
                      <?php echo ucfirst($company->membership_type); ?>
                    </div>
                    <div class="form-group">
                      <label>Membership Fee:</label>
                      <?php echo $company->membership_fees; ?>
                    </div>
                    <div class="form-group">
                      <label>Company Description:</label>
                       <?php echo $company->company_desc; ?>
                    </div>
                    
                    <div class="form-group">
                      <label>Services 1: </label>
                      <?php 
					  foreach ($services as $items){
						  if($company->service1 == $items['sid'])
						  {
					  		echo $items['service_name']; 
						  }
					  }?>
                    </div>
                    
                    <div class="form-group">
                      <label>Services 2: </label>
                       <?php foreach ($services as $items){
						  if($company->service2 == $items['sid'])
						  {
					  		echo $items['service_name']; 
						  }
					  } ?>
                    </div>
                    
                    <div class="form-group">
                      <label>Services 3: </label>
                       <?php foreach ($services as $items){
						  if($company->service3 == $items['sid'])
						  {
					  		echo $items['service_name']; 
						  }
					  } ?>
                    </div>
                    
                    </form>
                    </div>
              </div>
              
              </div>
          </div>
        </section><!-- /.content -->
      </div>