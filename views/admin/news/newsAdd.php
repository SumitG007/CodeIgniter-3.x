<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage News
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/news">Manage News</a></li>
            <li class="active">Add New News</li>
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
                  <h3 class="box-title">Add News</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url(); ?>/admin/news/addrecord"  enctype="multipart/form-data">
                
                  <div class="box-body">
                  	
                    <div class="form-group">
                      <label for="exampleInputEmail1">News Title</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="News Title" value="<?php echo set_value('title')?>">
                      <?php if(form_error('title') != ''){ ?><div class="alert-danger"><?php echo form_error('title'); ?></div><?php } ?>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Content</label>
                      <textarea class="form-control" rows="3" id="content" name="content" placeholder="Add Content"><?php echo set_value('content')?></textarea>
	         		  <?php echo display_ckeditor($ckeditor); ?><?php if(form_error('content') != ''){ ?><div class="alert-danger"><?php echo form_error('content'); ?></div><?php } ?>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">SEO Title</label>
                      <input type="text" class="form-control" id="seotitle" name="seotitle" placeholder="SEO Title" value="">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta - Keywords</label>
                      <textarea name="keywords" id="keywords" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta - Description</label>
                      <textarea name="desc" id="desc" class="form-control" rows="3"></textarea>
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
            
                                      