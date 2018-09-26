<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Company Representative - Approved Jobs</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/jobs/Approved">Manage Approved Jobs</a></li>
            <li class="active">List of Approved Jobs</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Jobs</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
               
                 <table class="table table-hover">
                    <tr>
                      <th>No.</th>
                      <th>Company Name</th>
                      <th>Company Representative</th>
                      <th>Job Title</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Job Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
					<tr>
                    <?php
					 $i=1; foreach($viewdata as $item) { 
					 $this->load->model("membersModel");	
					 $member = $this->membersModel->get_by_id($item->mid)->row();
					 ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $member->company_name; ?></td>
                      <td><?php echo $member->company_representative; ?></td>
                      <td><?php echo $item->job_name; ?></td>				  
                      <td><?php echo $item->start_date; ?></td>
					  <td><?php echo $item->end_date; ?></td>
                      <td><a href="#" data-toggle="modal" data-target="#myModal">View Job Description</a></td>
                      <td>
                      <?php if($item->status == "renewal") { ?><span class="label label-danger">Renewal</span>
                      <?php } else if($item->status == "approved") { ?><span class="label label-success">Active</span>
                      <?php } else if($item->status == "inactive") { ?><span class="label label-danger">In-Active</span>
                      <?php } ?>
                      </td>
					  <th>
					  <?php if($item->status == "approved") { ?>
                      <a href="<?php echo base_url(); ?>admin/jobs/disable/<?php echo $item->jid; ?>"><span class="label label-primary">Disable ?</span></a>
                      <?php } else if($item->status == "inactive") { ?>
                      <a href="<?php echo base_url(); ?>admin/jobs/enable/<?php echo $item->jid; ?>"><span class="label label-success">Enable ?</span></a>
                      <?php } ?>
                       &nbsp;<a href="<?php echo base_url(); ?>admin/jobs/edit_member_approved_jobs/<?php echo $item->jid; ?>"><span class="label label-warning">Edit</span></a>
                       &nbsp;<a href="<?php echo base_url(); ?>admin/jobs/del_approved_jobs/<?php echo $item->jid; ?>/approved" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>  
                      
                    </tr>
                    <?php $i++; } ?>
                    <tr><td colspan="9">
                  	<ul class="pagination">
					<?php echo $pagination; ?>  
                    </ul>
                    </td></tr>
                  
                  </table>
                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>