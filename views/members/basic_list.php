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
                    <h2>BOMA Edmonton Member</h2>
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
                
             <?php foreach($posts as $post){?>
             <div class="col-md-6 col-sm-12" style="min-height:30px;">             
			<?php echo $post->company_name;?> &nbsp; <span style="font-size:13px; color:#03C"><?php echo $post->company_telephone;?> </span><br />
			</div>
   			  <?php }?>  

               
                
                
            </div>
          </div>
    </div>
    <!-- Inner page content Ends -->
