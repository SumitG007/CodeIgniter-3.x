<div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Blogs</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/posts">Blogs</a></li>
            <li class="active">List of Blog</li>
          </ol>
        </section>
    
<!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Blog</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/posts/add"> <button class="btn btn-block btn-primary btn-sm">Add Blog Posts</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
				
                <div class="box-body table-responsive no-padding">
                  <form action="<?php echo base_url(); ?>admin/posts/sort_order/" method="post">
                  <table class="table table-hover">
                    <tr>
                      <th>title</th>
                      <th>Image</th>
                      <!--th>short content</th!-->
                      <th>Published</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <?php
					 $val = array(); $i = 1;
					 $count = count($home);
					 if($count >0){
					 foreach($home as $item) { ?>
                    <tr>
                      <td><?php echo $item->title;?></td>
                      <td>
                        <?php if($item->image) {?>
                          <img src="<?php echo base_url(); ?>images/<?php echo $item->image; ?>" width="60" style="border: 1px solid #DDD;padding: 5px 7px;" />
                        <?php }?>
                       </td>
                      <!--td><?php echo $item->content;?></td!-->
                      <td><?php echo $item->published_at;?></td>
                      <td><span class="label label-primary"><?php if($item->status == "enable") { echo "Enable"; } else { echo "Disable"; } ?></span></td>
                      <th>
                      <a href="<?php echo base_url(); ?>admin/posts/edit/<?php echo $item->id; ?>"><span class="label label-success">Edit</span></a>
                      <a href="<?php echo base_url(); ?>admin/posts/delete/<?php echo $item->id; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span> </a></th>
                      
                    </tr>
                    <?php $val = $item->id; $i++; } }?>
                   
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
   
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>