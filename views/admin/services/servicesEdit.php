<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Services
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/services">Manage Services</a></li>
            <li class="active">Edit Service</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-9">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Service</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url(); ?>/admin/services/updaterecord"  enctype="multipart/form-data">
                
                  <div class="box-body">
                  	
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Title</label>
                      <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Service Title" value="<?php echo $servicesitem->service_name; ?>">
                      <?php if(form_error('service_name') != ''){ ?><div class="alert-danger"><?php echo form_error('service_name'); ?></div><?php } ?>
                    </div>
                    
                   
                     <input type="hidden" name="sid" value="<?php echo $servicesitem->sid; ?>" />
                                 
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->         

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
            
                                      
                  
                