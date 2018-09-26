<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Events</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events/">Manage Events</a></li>
            <li class="active">List of Events</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Events</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/events/add"> <button class="btn btn-block btn-primary btn-sm">Add New Event</button></a>
                      
                    </div>
                  </div>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Event Name</th>
                      <th>Location</th>
                      <th>Start Date</th>
                      <!--<th>End Date</th>-->
                      <th>Time</th>
                      <th>Price</th>
                      <th>Total Seats</th>
                      <th>Seats Left</th>
                      <!--<th>Descriptions</th>-->
                      <th>Action</th>
                    </tr>
                    <?php 
					if(count($events) >0 ) {
							foreach($events as $item) {
					?>
                            <tr>
                              <td><?php echo $item->event_name; ?></td>
                              <td><?php echo $item->event_location; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($item->start_date)); ?></td>				  
                              <?php /*?><td><?php echo date('d-m-Y',strtotime($item->end_date)); ?></td><?php */?>
                              <td><?php if(isset($item->start_time) && isset($item->end_time)){ echo $item->start_time." - ".$item->end_time; } ?></td>
                              <td><?php echo $item->event_price; ?></td>
                              <td><?php echo $item->total_seats; ?></td>  
                              <td><?php echo $item->left_seats; ?></td>  
                              <!--<td><a href="#" data-toggle="modal" data-target="#myModal"><?php //echo $item->event_desc	; ?></a></td>  -->
                              
                              <td><a href="<?php echo base_url(); ?>admin/events/view_registration/<?php echo $item->id; ?>"><span class="label label-warning">View Registrations</span></a>&nbsp; <a href="<?php echo base_url(); ?>admin/events/edit/<?php echo $item->id; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>admin/events/delete/<?php echo $item->id; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a> </td>  
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