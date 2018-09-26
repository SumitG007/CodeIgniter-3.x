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
          <h1>Home Board</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/Board">Home Board</a></li>
            <li class="active">Add New Member</li>
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
                  <h3 class="box-title">Add New Member</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."admin/board/addbanner"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                  <div class="box-body">
                  	<div class="form-group">
                      <label for="exampleInputEmail1">Member Content</label>
                      <textarea class="form-control" rows="3" id="content" name="content" placeholder="Add Content"></textarea>
	         		  <?php echo display_ckeditor($ckeditor); ?><?php if(form_error('content') != ''){ ?><div class="alert-danger"><?php echo form_error('content'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Member Status</label>
                      <!--select type="text" class="form-control" name="status" value="<?php echo set_value('subtitle')?>" /!-->
					  <select type="text" class="form-control" name="status" value="" />
							<option value='director'>director</option>
							<option value='staff'>staff</option>
					  </select>
                      <?php if(form_error('status') != ''){ ?><span class="btn btn-danger btn-xs"><?php echo form_error('status'); ?></span><?php } ?>
                    </div>
									
					
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Image</label>
                      <input type="file" name="userfile" id="userfile" size="20"  class="form-control" />
                      <span class="btn btn-danger btn-xs"></span>
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