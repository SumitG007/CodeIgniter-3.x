<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.html"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content"> 
    <!-- Info boxes --> 
    
    <!-- /.row --> 
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="ion ion-ios-paper-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Total <br />Jobs Posted By Non-Members</span> <span class="info-box-number"><?php echo $job_non_members; ?></span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-red"><i class="ion ion-ios-paper-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Total <br />Jobs Posted By Members</span> <span class="info-box-number"><?php echo $job_members; ?></span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      <!-- /.col --> 
      
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-green"><i class="ion ion-easel"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Total Events</span> <span class="info-box-number"><?php echo $total_events; ?></span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Total Registered Members</span> <span class="info-box-number"><?php echo $total_members; ?></span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    
    <!-- /.row -->
    
    <div class="row"> 
      
      <!-- Members: LATEST ORDERS -->
      <div class="col-md-4">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Registration Applications</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Company Representative</th>
                    <th>Membership Type</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					if(isset($pending_members))
					{
						foreach($pending_members as $item)
						{
							//print_r($item);
				?>
                  <tr>
                    <td><a href="#"><?php echo $item->company_name; ?></a></td>
                    <td><?php echo $item->company_representative; ?></td>
                    <td><?php echo $item->professional_designations; ?></td>
                  </tr>
                 <?php
						}
					}
				 ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"> <a href="<?php echo base_url(); ?>admin/membership/pending" class="btn btn-sm btn-info btn-flat pull-left">View All Pending Applications</a> </div>
          <!-- /.box-footer --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
      
      <!-- Members Jobs: LATEST Pending ORDERS -->
      <div class="col-md-4">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Pending Jobs Approval - Posted By CR</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Company Representative</th>
                    <th>Job Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					if(isset($pending_job_members))
					{
						foreach($pending_job_members as $item)
						{
							$member = $this->membersModel->get_by_id($item->mid)->result();
				?>
                  <tr>
                    <td><?php echo $member[0]->company_name; ?></td>
                    <td><?php echo $member[0]->company_representative; ?></td>
                    <td><?php echo $item->job_name; ?></td>
                  </tr>
                   <?php
						}
					}
				 ?>
                  
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"> <a href="<?php echo base_url(); ?>admin/jobs/pending" class="btn btn-sm btn-info btn-flat pull-left">View All Pending Applications</a> </div>
          <!-- /.box-footer --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
      
      <!--Non Members Jobs: LATEST Pending ORDERS -->
      <div class="col-md-4">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Pending Jobs Approval - Posted By Non-Mem</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                   <!-- <th>Company Name</th>-->
                    <th>Non Member Name</th>
                    <th>Job Name</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					if(isset($pending_job_nonmembers))
					{
						foreach($pending_job_nonmembers as $item1)
						{
							//$member1 = $this->membersModel->get_by_id($item1->mid)->result();
				?>
                  <tr>
                     <?php /*?><td><a href="#"><?php echo $member1[0]->company_name; ?></a></td><?php */?>
                    <td><?php echo $item1->contact; ?></td>
                    <td><?php echo $item1->job_name; ?></td>
                  </tr>
                   <?php
						}
					}
				 ?>
                 
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"> <a href="<?php echo base_url(); ?>admin/jobs/pending_nonmembers" class="btn btn-sm btn-info btn-flat pull-left">View All Pending Applications</a> </div>
          <!-- /.box-footer --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
      
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->