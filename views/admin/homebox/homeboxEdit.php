<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Home Content
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/news">Manage News</a></li>
            <li class="active">Edit Menu</li>
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
                  <h3 class="box-title">Edit Home Content</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url(); ?>admin/homebox/updaterecord/"  enctype="multipart/form-data">
                  <div class="box-body">
                  	<?php //print_r($newsitem); ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $homeitem->title; ?>">
                      <?php if(form_error('title') != ''){ ?><div class="alert-danger"><?php echo form_error('title'); ?></div><?php } ?>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Content</label>
                      <textarea class="form-control" rows="3" id="content" name="content" placeholder="Add Content"><?php echo $homeitem->content; ?></textarea>
	         		  <?php echo display_ckeditor($ckeditor); ?><?php if(form_error('content') != ''){ ?><div class="alert-danger"><?php echo form_error('content'); ?></div><?php } ?>
                    </div>
                    
                   <input type="hidden" name="id" value="<?php echo $homeitem->id; ?>" />
                                 
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
            
                                      
                  
                