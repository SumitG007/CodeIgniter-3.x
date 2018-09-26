        <div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->

            	 <ol class="breadcrumb">
              <?php echo $breadcrumb; ?>
            </ol>
             <div class="row">
             	<div class="col-md-12">
                      <p><strong>Welcome, <?php echo $member->company_representative; ?></strong><br>You are representative of <?php echo $member->company_name; ?>. </p>
                </div>
             </div>
             <hr>
            <div class="row">
             <?php $this->load->view('members/sidebar'); ?>
                <div class="col-md-5 col-sm-12">
                    <h2>BOMA Edmonton Services Listing</h2>
                     <h3><a href="<?php echo base_url(); ?>members/services">Category Listing</a>&nbsp;&nbsp; <a href="<?php echo base_url(); ?>members/search_services/A">A</a> <a href="<?php echo base_url(); ?>members/search_services/B">B</a> <a href="<?php echo base_url(); ?>members/search_services/C">C</a> <a href="<?php echo base_url(); ?>members/search_services/D">D</a> <a href="<?php echo base_url(); ?>members/search_services/E">E</a> <a href="<?php echo base_url(); ?>members/search_services/F">F</a> <a href="<?php echo base_url(); ?>members/search_services/G">G</a> <a href="<?php echo base_url(); ?>members/search_services/H">H</a> <a href="<?php echo base_url(); ?>members/search_services/I">I</a> <a href="<?php echo base_url(); ?>members/search_services/J">J</a> <a href="<?php echo base_url(); ?>members/search_services/K">K</a> <a href="<?php echo base_url(); ?>members/search_services/L">L</a> <a href="<?php echo base_url(); ?>members/search_services/M">M</a> <a href="<?php echo base_url(); ?>members/search_services/N">N</a> <a href="<?php echo base_url(); ?>members/search_services/O">O</a> <a href="<?php echo base_url(); ?>members/search_services/P">P</a> <a href="<?php echo base_url(); ?>members/search_services/Q">Q</a> <a href="<?php echo base_url(); ?>members/search_services/R">R</a> <a href="<?php echo base_url(); ?>members/search_services/S">S</a> <a href="<?php echo base_url(); ?>members/search_services/T">T</a> <a href="<?php echo base_url(); ?>members/search_services/U">U</a> <a href="<?php echo base_url(); ?>members/search_services/V">V</a> <a href="<?php echo base_url(); ?>members/search_services/W">W</a> <a href="<?php echo base_url(); ?>members/search_services/X">X</a> <a href="<?php echo base_url(); ?>members/search_services/Y">Y</a> <a href="<?php echo base_url(); ?>members/search_services/Z">Z</a> <!--<a href="#">0-9</a>--> </h3>
                </div>
                <?php /*?><div class="col-md-7 col-sm-7" style="margin-top:25px;">
                     <span class="pull-right">Search Keywords:  <input id="inputCompanyName"  type="text"> 
                     Services:  
                      <select name="field_service" id="field_service" class="spField" style="width: 200px;">
						<option value="">Select Services</option>
						<?php foreach($services as $items){ ?>
                        <option value="<?php echo $items['sid']; ?>">- <?php echo $items['service_name']; ?></option>
                        <?php } ?> 
               
					</select></span>
						<br>
                        <span class="pull-right" style="margin-top:25px;">Find entries that have: 
                      
                      
                <input name="spsearchphrase" id="spsearchphrase_all" value="all" checked="checked" type="radio">
                <label for="spsearchphrase_all">All words</label>
                <input name="spsearchphrase" id="spsearchphrase_any" value="any" type="radio">
                <label for="spsearchphrase_any">Any words</label>
                <input name="spsearchphrase" id="spsearchphrase_exact" value="exact" type="radio">
                <label for="spsearchphrase_exact">Exact words</label>
                <button type="submit" class="btn btn-primary">Search</button>
                </span>

                </div><?php */?>
            </div>
            <hr>
            
            
             <div class="row">
             
             
             
              <?php //echo "<pre>";print_r($service_details); 
			  
			  	$id = $this->uri->segment('3');
				$this->load->model('membersModel');
				$service_name = $this->membersModel->get_service_name($id)->result();
				
				?>
                <h3><?php echo $service_name[0]->service_name; ?></h3>
                <?php
					if(isset($service_details))
					{
						foreach($service_details as $items)
						{
							//print_r($items);
							
							//print_r($service_name);
				?>
             	
                <div class="col-md-4 col-sm-12" style="min-height:300px;">
               
                           <div class="media">
                              <div class="media-left media-middle">
                              	<?php if($items['comp_logo'] != '' && $items['company_status'] == 'Yes')
								{ ?>
                                <a href="#">
                               		<img  src="<?php echo base_url(); ?>images/company/thumbs/<?php echo $items['comp_logo'] ?>"  >
                                </a>
								<?php }else{ ?>
                                	<img class="media-object" width="150px" height="150px" src="<?php echo base_url(); ?>images/no-img.png">
                                <?php } ?>
                              </div>
                              <div class="media-body">
                                <h4><b><?php echo $items['company_name']; ?></b></h4>
                                <h5 class="media-heading">
                                <strong>Contact Person:</strong> <br /><?php echo $items['company_representative']; ?><br>
                                <strong>Email:</strong> <br /><?php echo $items['company_email']; ?><br><br />
                                Address: <?php echo $items['company_address']; ?><br>
                                City: <?php echo $items['city_name']; ?><br>
                                Postcode: <?php echo $items['postal_code']; ?><br>
                                Phone: <?php echo $items['company_telephone']; ?><br>
                               <?php if($items['company_status'] == 'Yes'){ ?>
                                Website: <a href="<?php echo $items['company_website']; ?>" target="_blank"><?php echo $items['company_website']; ?> </a>
                                <?php } ?>
                                </h5>
                              </div>
                            </div>
                </div>
                
                 <?php }
					} ?>
                
            </div>
          </div>
    </div>
    <!-- Inner page content Ends -->
