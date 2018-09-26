<div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Home Banners</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/home">Home Banners</a></li>
            <li class="active">List of Banners</li>
          </ol>
        </section>
    
<!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Banners</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/home/add"> <button class="btn btn-block btn-primary btn-sm">Add New Banner</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
				
                <div class="box-body table-responsive no-padding">
                  <form action="<?php echo base_url(); ?>admin/home/sort_order/" method="post">
                  <table class="table table-hover">
                    <tr>
                      <th>Image</th>
                      <th>Banner Title</th>
                      <th>Sub title</th>
                      <th>Sort</th>
                      <th>Action</th>
                    </tr>
                    <?php
					 $val = array(); $i = 1;
					 $count = count($home);
					 foreach($home as $item) { ?>
                    <tr>
                      <td><?php echo $i;  ?> <img src="<?php echo base_url(); ?>images/banners/<?php echo $item->img; ?>" width="100px" style="border: 1px solid #DDD;padding: 5px 7px;" /></td>
                      <td><?php echo $item->title;?></td>
                      <td><?php echo $item->subtitle;?></td>
                      <th><input type="text" value="<?php echo $item->no; ?>" name="txt[]" style="width:50px;text-align:center" /></th>
					  <th>
                      <a href="<?php echo base_url(); ?>admin/home/edit/<?php echo $item->hid; ?>"><span class="label label-success">Edit</span></a>
                      <a href="<?php echo base_url(); ?>admin/home/delete/<?php echo $item->hid; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span> </a></th>
                      
                    </tr>
                    <?php $val = $item->hid; $i++; } ?>
                   
                    <tr>
                    <td colspan="7"><div class="box-tools">
                    <div class="input-group">
                      
                      <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <?php echo $pagination; ?>
                    </ul>
                  </div>
                    </div>
                  </div></td>
                    </tr>
                    <tr><th colspan="5"><input type="hidden" name="cnt" value="<?php echo $val; ?>"  />
    <input type="hidden" name="allids" value="<?php echo $i-1; ?>"  />
    <input type="submit" name="submit" value="Update Order" class="btn btn-block btn-primary btn-sm pull-right" style="width:150px;" /></th></tr>
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>