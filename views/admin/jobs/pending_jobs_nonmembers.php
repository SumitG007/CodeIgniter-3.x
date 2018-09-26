<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1> Non Members Pending Job Applications</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/jobs/pending">Manage Pending Job Applications</a></li>
            <li class="active">List of Pending Job Applications</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Pending Jobs</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <form action="<?php echo base_url(); ?>admin/menu/sort_order/" method="post">
                 <table class="table table-hover">
                    <tr>
                      <th>No.</th>
                      <th>Phone Number</th> 
                      <th>Company Name</th>
                      <th>Non Member Name</th>
                      <th>Job Title</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <!--<th>Job Description</th>-->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
					<tr>
                    <?php
					 $i=1; foreach($viewdata as $item) { 
					 
					 ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $item->contact; ?></td>
                      <td><?php echo $item->comany_name; ?></td>
                      <td><?php echo $item->name; ?></td>
                      <td><?php echo $item->job_name; ?></td>
                      <td><?php echo $item->start_date; ?></td>				  
                      <td><?php echo $item->end_date; ?></td>
                      <!--<td><a href="#" data-toggle="modal" data-target="#myModal">View Job Description</a></td>-->
                      <td><span class="label label-danger">Pending</span></td>
					  <th><a href="<?php echo base_url(); ?>admin/jobs/enable_nonmembers/<?php echo $item->jid; ?>"><span class="label label-success">Approve Job ?</span></a>&nbsp;<!-- <a href="<?php// echo base_url(); ?>admin/jobs/send_invoice1/<?php// echo $item->jid; ?>"><span class="label label-primary">Send Invoice</span></a>&nbsp; --><a href="<?php echo base_url(); ?>admin/jobs/edit_nonmember_pending_jobs/<?php echo $item->jid; ?>"><span class="label label-warning">Edit</span></a>&nbsp;<a href="<?php echo base_url(); ?>admin/jobs/del_jobs/<?php echo $item->jid; ?>/pending_nonmembers" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>   
                      
                    </tr>
                    <?php $i++; } ?>
                    <tr><td colspan="9">
                  	<ul class="pagination">
					<?php echo $pagination; ?>  
                    </ul>
                    </td></tr>
                  
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
      