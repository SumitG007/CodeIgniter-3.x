<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Home Banners</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/home">Home Banners</a></li>
            <li class="active">Edit Banner Information</li>
          </ol>
        </section>
                                                                       
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Banner Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                    <form role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" name="frmaddbanner">
                    <input type="hidden" name="hid" value="<?php echo $home->hid; ?>"  />
                  <div class="box-body">
                  	<div class="form-group">
                      <label for="exampleInputEmail1">Banner Title</label>
                      <input type="text" class="form-control" name="title" value="<?php echo $home->title; ?>" />
                      <?php if(form_error('title') != ''){ ?><span class="btn btn-danger btn-xs"><?php echo form_error('title'); ?></span><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Banner Sub-Title</label>
                      <input type="text" class="form-control" name="subtitle" value="<?php echo $home->subtitle; ?>" />
                      <?php if(form_error('subtitle') != ''){ ?><span class="btn btn-danger btn-xs"><?php echo form_error('subtitle'); ?></span><?php } ?>
                    </div>
                                      
                    <div class="form-group">
                      <?php if($home->img != "") { ?>
                      <p>
                        <label>Current Image :</label>
                        <img src="<?php echo base_url(); ?>images/banners/<?php echo $home->img; ?>" class="text-long" width="150px" />									
                        <div class="hr-line-dashed"></div>
                        <label>Change Image :</label>
                        <span class="btn btn-danger btn-xs">[ * Image size must be - width: 1280px, height:450px   ]</span><?php if($error){ ?><div class="btn btn-danger btn-xs"><?php echo $error;?></div><?php } ?>
                        <input type="hidden" value="<?php echo $home->img; ?>" name="img" />
                      </p>
                      <?php } else { ?>
                      
                      <span class="btn btn-danger btn-xs">[ * Image size must be - width: 1280px, height:450px   ]</span><?php if($error){ ?><div class="btn btn-danger btn-xs"><?php echo $error;?></div><?php } ?>
                      <input type="hidden" value="" name="img" />
                      <?php } ?>
                    
                    <input type="file" name="userfile" size="20"  class="form-control" />
                    </div>              
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