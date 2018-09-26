<script type="text/javascript">
function check()
{
	var fup1 = document.getElementById('userfile');	
	if(document.getElementById('userfile').value != '')
	{
		var fileName1 = fup1.value;
		var ext1 = fileName1.substring(fileName1.lastIndexOf('.') + 1);
		
		if(ext1 == "jpg" || ext1 == "gif" || ext1 == "png")
		{
			return true;
		}
		else
		{
			alert("Upload Jpg, Gif, Png File only");
			fup1.focus();
			return false;
		}
	}
	else {
		alert("Please Select Image");
			fup1.focus();
			return false;
	}
}
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Home Banners</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/home">Home Banners</a></li>
            <li class="active">Add New Banner</li>
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
                  <h3 class="box-title">Add New Banner</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."admin/home/addbanner"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                  <div class="box-body">
                  	<div class="form-group">
                      <label for="exampleInputEmail1">Banner Title</label>
                      <input type="text" class="form-control" name="title" value="<?php echo set_value('title')?>" />
                      <?php if(form_error('title') != ''){ ?><span class="btn btn-danger btn-xs"><?php echo form_error('title'); ?></span><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Banner Sub-Title</label>
                      <input type="text" class="form-control" name="subtitle" value="<?php echo set_value('subtitle')?>" />
                      <?php if(form_error('subtitle') != ''){ ?><span class="btn btn-danger btn-xs"><?php echo form_error('subtitle'); ?></span><?php } ?>
                    </div>
                                      
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Image</label>
                      <input type="file" name="userfile" id="userfile" size="20"  class="form-control" />
                      <span class="btn btn-danger btn-xs">[ * Image size must be - width: 1280px, height:450px   ]</span>
					  <?php if($error){ ?><div class="btn btn-danger btn-xs"><?php echo $error;?></div><?php } ?>
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