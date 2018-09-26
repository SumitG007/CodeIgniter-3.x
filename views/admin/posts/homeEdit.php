<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Home Board</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/posts">Blog</a></li>
            <li class="active">Edit Blog</li>
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
                  <h3 class="box-title">Edit Blog</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                    <form role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" name="frmaddbanner">
                    <input type="hidden" name="hid" value="<?php echo $home->id; ?>"  />
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFile">Title</label>
                      <input type="text" name="title" id="title" class="form-control" value="<?php echo $home->title;?>" />
                      <?php if(form_error('title') != ''){ ?><div class="alert-danger"><?php echo form_error('title'); ?></div><?php } ?>
                    </div> 
                  	<div class="form-group">
                      <label for="exampleInputEmail1">Content</label>
                      <textarea class="form-control" rows="3" id="content" name="content" placeholder="Add Content"><?php echo $home->content; ?></textarea>
	         		  <?php echo display_ckeditor($ckeditor); ?><?php if(form_error('content') != ''){ ?><div class="alert-danger"><?php echo form_error('content'); ?></div><?php } ?>
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
                      <?php if(form_error('status') != ''){ ?><span class="btn btn-danger btn-xs"><?php echo form_error('status'); ?></span><?php } ?>
                    </div>
                                      
                    <div class="form-group">
                      <?php if($home->image != "") { ?>
                      <p>
                        <label>Current Image :</label>
                        <img src="<?php echo base_url(); ?>images/<?php echo $home->image; ?>" class="text-long" width="150px" />									
                        <div class="hr-line-dashed"></div>
                        <label>Change Image :</label>
                        <span class="btn btn-danger btn-xs"></span><?php if($error){ ?><div class="btn btn-danger btn-xs"><?php echo $error;?></div><?php } ?>
                        <input type="hidden" value="<?php echo $home->image; ?>" name="img" />
                      </p>
                      <?php } else { ?>
                      
                      <span class="btn btn-danger btn-xs"></span><?php if($error){ ?><div class="btn btn-danger btn-xs"><?php echo $error;?></div><?php } ?>
                      <input type="hidden" value="" name="img" />
                      <?php } ?>
                    
                    <input type="file" name="userfile" size="20"  class="form-control" />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tags</label>
                      <!--select type="text" class="form-control" name="status" value="<?php echo set_value('subtitle')?>" /!-->
                      <?php echo form_dropdown('tags[]',$tags,$tag_ids,array('class' => 'form-control','multiple'=>true));?>
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