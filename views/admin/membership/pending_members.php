<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>New Registration Pending Applications</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/membership/pending">Manage Pending Applications</a></li>
            <li class="active">List of Pending Applications</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Applications</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <form action="<?php echo base_url(); ?>admin/menu/sort_order/" method="post">
                 <table class="table table-hover">
                    <tr>
                      <th>No.</th>
                      <th>Company Name</th>
                      <th>Company Representative</th>
                      <th>Telephone</th>
                      <th>Email Address</th>
                      <th>Membership Type</th>
                      <th>Membership Fee</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <?php
					 $i=1; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $item->company_name; ?></td>
                      <td><?php echo $item->company_representative; ?></td>
                      <td><?php echo $item->company_telephone; ?></td>				  
                      <td><?php echo $item->company_email; ?></td>
					  <td><?php echo $item->membership_type; ?></td>
                      <td><?php echo $item->membership_fees; ?></td>
                      <td><span class="label label-danger">Un-Paid</span></td>
					  <th>
                      <?php //if($item->status == "send_invoice") { ?>
                     <?php /*?> <a href="<?php echo base_url(); ?>admin/membership/send_invoice/<?php echo $item->id; ?>"><span class="label label-primary">Send Invoice</span></a><?php */?>
                      <?php if($item->status == "create_user") { ?>
                      <a href="<?php echo base_url(); ?>admin/membership/create_user/<?php echo $item->id; ?>"><span class="label label-success">Create User</span></a>
                      <?php } ?>
                       &nbsp;<a href="<?php echo base_url(); ?>admin/membership/view_member/<?php echo $item->id; ?>"><span class="label label-default">View</span></a>   &nbsp; <a href="<?php echo base_url(); ?>admin/membership/edit_member/<?php echo $item->id; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>admin/membership/del_member/<?php echo $item->id; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>  
                      
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