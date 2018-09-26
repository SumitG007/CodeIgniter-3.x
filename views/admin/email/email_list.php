<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Emails</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events/">Manage Emails</a></li>
            <li class="active">List of Emails</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Emails</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                    <?php /*?> <a href="<?php echo base_url(); ?>admin/events/add"> <button class="btn btn-block btn-primary btn-sm">Add New Event</button></a><?php */?>
                      
                    </div>
                  </div>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Email Template Title</th>
                      <th>Is Acitve</th>
                      <!--<th>Descriptions</th>-->
                      <th>Action</th>
                    </tr>
                    <?php
					if (empty($emails) ) { //|| empty($username)
					?>
						<tr role="row" class="odd" align="center">
                        	<td colspan="3"><strong>Data Not Available.</strong></td>
                        </tr>
                    <?php
					}else{
					//if(count($emails) >0 ) {
						//$i =1;
						foreach($emails as $item) {
				?>
						<tr>
						  <td><?php echo $item->template_name; ?></td>
						  <td><?php if($item->active == 0){ echo 'Yes'; }else{ echo 'No'; } ?></td>  
						  <!--<td><a href="#" data-toggle="modal" data-target="#myModal"><?php //echo $item->event_desc	; ?></a></td>  -->
						  
						 <td> <a href='<?php echo base_url(); ?>admin/email/edit/<?php echo $item->template_id; ?>' class="btn btn-info">view & edit</a>  
						</tr> 
				 <?php }
					}?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>