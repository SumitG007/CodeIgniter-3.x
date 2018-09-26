<div class="container">

       <div class="page-header">
    	<!-- BreadCrumb Starts -->
        <ol class="breadcrumb">
         <?php echo $breadcrum; ?>
        </ol>
    	<div class="row">
        	<div class="col-md-12 col-sm-12">
            	<h2>Contact Us</h2>
            </div>
        </div>
        
        
        
        
        <div class="row" style="padding:60px 0">
						<div class="col-md-4">
							<div class="contact-one-top-content">
								<div class="contact-one-icon">
									<i class="fa fa-user"></i>
								</div>
								<div class="contact-icon-content">
									<h5 style="font-weight:bold; color: #0b1c47;">LOCATION</h5>
									<p> EPCOR Tower<br>
                                       #870, 10423 - 101 Street<br />
										Edmonton, AB T5H 0E7
                                        </p>
								</div>
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="contact-one-top-content">
								<div class="contact-one-icon">
									<i class="fa fa-tablet"></i>
								</div>
								<div class="contact-icon-content">
									<h5 style="font-weight:bold; color: #0b1c47;">PHONE</h5>
									
									<p>
										 780-428-0419
									</p>
                                  
								</div>
							</div>
						</div>
						
						<div class="col-md-5">
							<div class="contact-one-top-content">
								<div class="contact-icon-content">
									<h5 style="font-weight:bold; color: #0b1c47;">CONTACT PERSONS</h5>
									
									<p>
                                    	Percy Woods - President & CSO &nbsp;<a href="mailto:pwoods@bomaedm.ca"><i class="fa fa-envelope"></i></a><br />
										 Jeannette Mensink - Coordinator, Events and Member Services &nbsp;<a href="mailto:jmensink@bomaedm.ca"><i class="fa fa-envelope"></i></a>   <br />
                                         Cora - Accounting &nbsp;<a href="mailto:ckrywko@bomaedm.ca"><i class="fa fa-envelope"></i></a>
                                         
									</p>
								</div>
							</div>
						</div>
					</div>
        
        
        
        
        
        <div class="row top-80">
						<div class="col-md-12">
							<div class="text-center" style="margin-bottom:15px;">
								<h4>Write us about your suggestions</h4>
							</div>
						</div>
					</div>
                    
                    
         <div class="row" style="margin-bottom:30px;">
            
            <div class="col-md-12 col-sm-12">
            	<?php echo validation_errors('<p style="color:red;font-weight:bold;font-size:15px;">'); ?>
				<form action="<?php echo base_url(); ?>pages/send" method="post" class="form contactForm1" id="contactForm1" novalidate="novalidate">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Your Name" name="txtname" value="<?php echo set_value('txtname'); ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="txtemail" value="<?php echo set_value('txtemail'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone No</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Phone Number" name="txtphone" value="<?php echo set_value('txtphone'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Questions / Inquiry</label>
                    <textarea name="txtMessage" class="form-control" cols="10" rows="5"  placeholder="Your inquiry"><?php echo set_value('txtMessage'); ?></textarea>
                  </div>
                  
                  <input type="submit" class="btn btn-default" value="Submit"  />
                </form>
          
            </div>
        
        </div>
        
        <div class="row top-80">
						<div class="col-md-12">
							<div class="text-center" style="margin-bottom:15px;">
								<h4>Locate us on map</h4>
							</div>
						</div>
					</div>
        
        <div class="row">
        	<div class="col-md-12 col-sm-12">
            <iframe width="100%" scrolling="no" height="350" frameborder="0" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2370.57566379977!2d-113.4927482!3d53.547490499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53a0224e5dbccd1f%3A0x3c236f113b6066b8!2s10423+101+St+NW+%23870%2C+Epcor+Tower%2C+Edmonton%2C+AB+T5H%2C+Canada!5e0!3m2!1sen!2s!4v1442340719604"></iframe>
            </div>
        </div>
        
        
        
        
       
    </div>
    </div>
    <!-- contact page content Ends -->
			
				