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
                <div class="col-md-5 col-sm-5">
                    <h2>BOMA Edmonton Services Listing</h2>
                    <h3><a href="<?php echo base_url(); ?>members/services">Category Listing</a>&nbsp;&nbsp; <a href="<?php echo base_url(); ?>members/search_services/A">A</a> <a href="<?php echo base_url(); ?>members/search_services/B">B</a> <a href="<?php echo base_url(); ?>members/search_services/C">C</a> <a href="<?php echo base_url(); ?>members/search_services/D">D</a> <a href="<?php echo base_url(); ?>members/search_services/E">E</a> <a href="<?php echo base_url(); ?>members/search_services/F">F</a> <a href="<?php echo base_url(); ?>members/search_services/G">G</a> <a href="<?php echo base_url(); ?>members/search_services/H">H</a> <a href="<?php echo base_url(); ?>members/search_services/I">I</a> <a href="<?php echo base_url(); ?>members/search_services/J">J</a> <a href="<?php echo base_url(); ?>members/search_services/K">K</a> <a href="<?php echo base_url(); ?>members/search_services/L">L</a> <a href="<?php echo base_url(); ?>members/search_services/M">M</a> <a href="<?php echo base_url(); ?>members/search_services/N">N</a> <a href="<?php echo base_url(); ?>members/search_services/O">O</a> <a href="<?php echo base_url(); ?>members/search_services/P">P</a> <a href="<?php echo base_url(); ?>members/search_services/Q">Q</a> <a href="<?php echo base_url(); ?>members/search_services/R">R</a> <a href="<?php echo base_url(); ?>members/search_services/S">S</a> <a href="<?php echo base_url(); ?>members/search_services/T">T</a> <a href="<?php echo base_url(); ?>members/search_services/U">U</a> <a href="<?php echo base_url(); ?>members/search_services/V">V</a> <a href="<?php echo base_url(); ?>members/search_services/W">W</a> <a href="<?php echo base_url(); ?>members/search_services/X">X</a> <a href="<?php echo base_url(); ?>members/search_services/Y">Y</a> <a href="<?php echo base_url(); ?>members/search_services/Z">Z</a> <!--<a href="#">0-9</a>--> </h3>
                </div>
                <form name="form2" id="form2" action="<?php echo base_url(); ?>members/services">
                <?php /*?><div class="col-md-7 col-sm-7" style="margin-top:25px;">
                	
                     <span class="pull-right">Search Keywords:  <input id="inputCompanyName" name="search"  type="text"> 
                     Services:  
                     <select name="field_service" id="field_service" class="spField" style="width: 200px;">
						<option value="">Select Services</option>
						<?php foreach($services as $items){ ?>
                        <option value="<?php echo $items['sid']; ?>">- <?php echo $items['service_name']; ?></option>
                        <?php } ?> 
               
					</select>
                    </span>

					<br>
        
      
                    <span class="pull-right" style="margin-top:25px;">Find entries that have: 
                  
                  
                    <input name="spsearchphrase" id="spsearchphrase_all" value="all" checked="checked" type="radio">
                    <label for="spsearchphrase_all">All words</label>
                    
                    
                    <input name="spsearchphrase" id="spsearchphrase_any" value="any" type="radio">
                    <label for="spsearchphrase_any">Any words</label>
                    
                    
                    <input name="spsearchphrase" id="spsearchphrase_exact" value="exact" type="radio">
                    <label for="spsearchphrase_exact">Exact words</label>
                    
                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                    </span>
					
     
        
                </div><?php */?></form>
            </div>
            <hr>
             <div class="row">
                
                <?php if(isset($service1)){ foreach($service1 as $items){ //print_r($items); 
				$service_count = count($this->membersModel->service_details($items['sid']));
				
				?>
                <div class="col-md-3 col-sm-3">
                        <a href="<?php echo base_url(); ?>members/services_listing/<?php echo $items['sid']; ?>"><?php echo $items['service_name']; ?> </a> [<?php if($service_count > 0){ echo $service_count; }else{ echo 0; } ?>] <br>
                </div>
                  <?php } }?> 
                 
              
            </div>
            <div class="row">
                
                <?php if(isset($search_services)){ foreach($search_services as $items){ 
				//print_r($items); 
					$service_count = count($this->membersModel->service_details($items['sid']));
				
				?>
                <div class="col-md-3 col-sm-3">
                        <a href="<?php echo base_url(); ?>members/services_listing/<?php echo $items['sid']; ?>"><?php echo $items['service_name']; ?> </a> [<?php if($service_count > 0){ echo $service_count; }else{ echo 0; } ?>]<br>
                        </div>
                  <?php } }?> 
                 
                
             </div>
            <?php //if(isset($search_services)){ print_r($search_searvices); } ?>
            
            
            
            
          </div>
    </div>
    <!-- Inner page content Ends -->
 