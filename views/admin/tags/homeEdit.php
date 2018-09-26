<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Tag List</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/tags">Tag List</a></li>
            <li class="active">Edit Tag</li>
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
                  <h3 class="box-title">Edit Tag</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                    <form role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" name="frmaddbanner">
                    <input type="hidden" name="hid" value="<?php echo $home->id; ?>"  />
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFile">Title</label>
                      <input type="TEXT" name="title" id="title" class="form-control" value=<?php echo $home->title?> />
                      <?php if(form_error('title') != ''){ ?><div class="alert-danger"><?php echo form_error('title'); ?></div><?php } ?>
                    </div> 
                  	
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <!--select type="text" class="form-control" name="status" value="<?php echo set_value('subtitle')?>" /!-->
					  <select type="text" class="form-control" name="status" />
							<?php 
								$sel_d =($home->status =='enable')?'selected':'';
								$sel_s =($home->status =='disable')?'selected':'';
							?>
							
							<option value='enable' <?php echo $sel_d?>>enable</option>
							<option value='disable' <?php echo $sel_s?>>disable</option>
					  </select>
                      
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