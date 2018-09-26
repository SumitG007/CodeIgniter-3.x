<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Menus</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>menu">Manage Menu</a></li>
            <li class="active">List of Menus</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Menus</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/menu/add"> <button class="btn btn-block btn-primary btn-sm">Add New Menu</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <form action="<?php echo base_url(); ?>admin/menu/sort_order/" method="post">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Menu Title</th>
                      <th>Submenu</th>
                      
                      <th>Status</th>
                      <th>Action</th>
                      <th>Sort</th>
                    </tr>
                    <?php
					 $val = array();
					 $count = count($menu);
					 $i=1; foreach($menu as $item) { ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $item->cname; ?></td>
                      
                      <td><a href="<?php echo base_url(); ?>admin/submenu/index/<?php echo $item->cid; ?>"><span class="label label-success">View Sub-Menus</span></a></td>
                      
					  <td><span class="label label-primary"><?php if($item->status == "active") { echo "Enable"; } else { echo "Disable"; } ?></span></td>				  
					  <th>
                      <?php if($item->status == "active") { ?><a href="<?php echo base_url(); ?>admin/menu/deactive/<?php echo $item->cid; ?>"><span class="label label-default">Disable ?</span></a> <?php } else { ?><a href="<?php echo base_url(); ?>admin/menu/active/<?php echo $item->cid; ?>" ><span class="label label-success">Enable ?</span></a><?php } ?> &nbsp; <a href="<?php echo base_url(); ?>admin/menu/edit/<?php echo $item->cid; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>admin/menu/delete/<?php echo $item->cid; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a>
                      </th>
                      <th><input type="text" value="<?php echo $item->no; ?>" name="txt[]" style="width:50px;text-align:center" /></th>
                      
                    </tr>
                    <?php $val = $item->cid; $i++; } ?>
                   <tr><th colspan="6"><input type="hidden" name="cnt" value="<?php echo $val; ?>"  />
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