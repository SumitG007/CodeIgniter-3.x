<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Approved Members</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/membership/Approved">Manage Approved Applications</a></li>
            <li class="active">List of Approved Applications</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Search Application</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                <form action="<?php echo base_url(); ?>admin/membership/approved/" method="post">
                 <table class="table table-hover">
                    <tr>
                      <th>Enter Search Keyword</th>
                      <th>Select Option</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control" value="<?php echo $searchKeyword;?>" name="search" id="search" required /></td>
                      <td>
                      <select class="form-control" name="member_search" required>
                            <!--<option value="">Select</option>-->
                            <option value=" " <?php if($member_search==' ') { echo 'selected';} ?>>Select Below</option>
                            <option value="Company Name" <?php if($member_search=='Company Name') { echo 'selected';} ?>>Company Name</option>
                            <option value="Member Name" <?php if($member_search=='Member Name') { echo 'selected';} ?>>Member Name</option>
                            <option value="Email Address" <?php if($member_search=='Email Address') { echo 'selected';} ?>>Email Address</option>
                        </select>
                      </td>
                      <td><input class="btn btn-success" name="searchSubmit" type="submit" value="Search" />  <input type="submit" class="btn btn-primary" name="searchReset" id="searchReset" value="Reset"></td>
                    </tr>                  
                  </table>
                  </form>
                </div>
              </div>
            </div>
         </div>
        
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
                      <th>Membership Expiry</th>
                      <th>Password</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <?php
					
					 $i=1; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $item['id']; ?></td>
                      <td><?php echo $item['company_name']; ?></td>
                      <td><?php echo $item['company_representative']; ?></td>
                      <td><?php echo $item['company_telephone']; ?></td>				  
                      <td><?php echo $item['company_email']; ?></td>
					  <td><?php echo $item['membership_type']; ?></td>
                      <td><?php echo date('Y-m-d',strtotime(date($item['conf_date'], mktime()) . " + 365 day")); ?></td>
                      <td><a href="<?php echo base_url(); ?>admin/membership/change_passsword/<?php echo $item['id']; ?>"><span class="label label-warning">Change Password</span></a></td>
                      <td>
                      <?php if($item['status'] == "renewal") { ?><span class="label label-danger">Renewal</span>
                      <?php } else if($item['status'] == "approved") { ?><span class="label label-success">Active</span>
                      <?php } else if($item['status'] == "inactive") { ?><span class="label label-danger">In-Active</span>
                      <?php } ?>
                      </td>
					  <th>
                      <?php if($item['status'] == "approved") { ?>
                      <a href="<?php echo base_url(); ?>admin/membership/disable/<?php echo $item['id']; ?>"><span class="label label-primary">Disable ?</span></a>
                      <?php } else if($item['status'] == "inactive") { ?>
                      <a href="<?php echo base_url(); ?>admin/membership/enable/<?php echo $item['id']; ?>"><span class="label label-success">Enable ?</span></a>
                      <?php } ?>
                       &nbsp;<a href="<?php echo base_url(); ?>admin/membership/view_approved_member/<?php echo $item['id']; ?>"><span class="label label-default">View</span></a>   &nbsp; <a href="<?php echo base_url(); ?>admin/membership/edit_approved_member/<?php echo $item['id']; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>admin/membership/del_approved_member/<?php echo $item['id']; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>  
                      
                    </tr>
                    <?php $i++; } ?>
                    <tr><td colspan="9">
                  <?php /*?>	<ul class="pagination">
					<?php echo $page_links; ?>  
                    </ul><?php */?>
                     <div class="row">
				   <div class="col-sm-5">
                   <?php echo '<div class="pagination" align="center">'.$page_links.'</div>'; ?>
                   </div>
					</div
                    </td></tr>
                  
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>