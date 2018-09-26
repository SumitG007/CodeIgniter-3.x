<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Services</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>services">Manage Service</a></li>
            <li class="active">List of Services</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Services</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/services/add"> <button class="btn btn-block btn-primary btn-sm">Add New Service</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
               </div>
              </div>
             </div> 
                
                <div class="row">
                <?php 
                    $arr = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"); 
			
					for($i=0; $i<count($arr); $i++) { ?>
                    
                        <div class="col-xs-4">
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title"></h3><?php echo $arr[$i]; ?></h3>     
                            </div><!-- /.box-header -->
                             <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">
                              
                              	<tr>
                                  <th>Service Name</th>
                                  <th>Action</th>
                                </tr>
                                <?php 
                                $this->load->model("servicesModel");
                                $services = $this->servicesModel->get_services_list($arr[$i])->result();
                                if(count($services) >0 ) {
                                foreach($services as $item) { ?>
                                
                                <tr>
                                  <td> <?php echo $item->service_name; ?> </td>
                                  <td><a href="<?php echo base_url(); ?>admin/services/edit/<?php echo $item->sid; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>admin/services/delete/<?php echo $item->sid; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></td>  
                                </tr>   
                                <?php } } ?>         
                                
                              </table>
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                        </div>
                    
                    <?php } ?>
			 </div>

                     
</div>                     