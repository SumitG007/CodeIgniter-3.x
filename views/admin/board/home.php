<div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Home Board</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/board">Home Board</a></li>
            <li class="active">List of Member</li>
          </ol>
        </section>
    
<!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Member</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/board/add"> <button class="btn btn-block btn-primary btn-sm">Add New Member</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
				
                <div class="box-body table-responsive no-padding">

                  <div style="height:600px; overflow-x:scroll;">   
                  <form action="<?php echo base_url(); ?>admin/board/sort_order/" method="post">
                  <table class="table table-hover">
                    <tr>
                      <th>Image</th>
                      <!--th>short content</th!-->
                      <th>status</th>
                      <th>Sort</th>
                      <th>Action</th>
                    </tr>
                    <?php
					 $val = array(); $i = 1;
					 $count = count($home);
					 if($count >0){
					 foreach($home as $item) { ?>
                    <tr>
                      <td><?php echo $i;  ?> <img src="<?php echo base_url(); ?>images/<?php echo $item->image; ?>" width="60" style="border: 1px solid #DDD;padding: 5px 7px;" /></td>
                      <!--td><?php echo $item->content;?></td!-->
                      <td><?php echo $item->status;?></td>
                      <th><input type="text" value="<?php echo $item->no; ?>" name="txt[]" style="width:50px;text-align:center" /></th>
					  <th>
                      <a href="<?php echo base_url(); ?>admin/board/edit/<?php echo $item->hid; ?>"><span class="label label-success">Edit</span></a>
                      <a href="<?php echo base_url(); ?>admin/board/delete/<?php echo $item->hid; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span> </a></th>
                      
                    </tr>
                    <?php $val = $item->hid; $i++; } }?>
                   
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
                    <tr><th colspan="5">
					<!--input type="hidden" name="cnt" value="<?php echo $val; ?>"  /!-->
					<input type="hidden" name="cnt" value=""  />
    <input type="hidden" name="allids" value="<?php echo $i-1; ?>"  />
    </th></tr>
                  </table>
                   </div>
                  <input type="submit" name="submit" value="Update Order" class="btn btn-block btn-primary btn-sm pull-right" style="width:150px;" />
                  </form>
                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>