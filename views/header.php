<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $desc; ?>">
<meta name="author" content="BOMA Edmonton">
<link rel="icon" href="favicon.ico">

<title><?php echo $title; ?></title>
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.png" />

<!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap-theme.css" rel="stylesheet">
     <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
    <?php /*?><link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.css" /><?php */?>
    <link href="<?php echo base_url(); ?>css/menu.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/datepicker3.css" />
   
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css" media="screen" />


    <script src="<?php echo base_url(); ?>js/ie-emulation-modes-warning.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
<?php ?>

<!-- For tablet and mobile -->
<div class="mobtopbar hidden-md hidden-lg visible-xs visible-sm"><!-- Top bar starts -->
	<div class="container">
    	<div class="col-sm-12" style="text-align:center">
        <p>Follow us on <a href="https://www.instagram.com/bomaedm/" data-toggle="tooltip" title="" data-placement="bottom" target="_blank" data-original-title="Facebook"><i class="fa fa-instagram" style="margin-left:10px;"></i></a> <a href="https://www.linkedin.com/company/boma-edmonton" data-toggle="tooltip" target="_blank" title="" data-placement="bottom" data-original-title="Linked In"><i class="fa fa-linkedin" style="margin-left:10px;"></i></a> <a href="https://twitter.com/bomaedmonton" data-toggle="tooltip" title="" data-placement="bottom" target="_blank" data-original-title="Twitter"><i class="fa fa-twitter" style="margin-left:10px;" ></i></a> </p>
        <p>(780) 428-0419  &nbsp;&nbsp;&nbsp; <a href="mailto:jmensink@bomaedm.ca">Email</a></p>
        <p>
        <?php if(!$this->session->userdata('logged_in_site')) { ?>
            <a href="<?php echo base_url(); ?>members/login/" class="newbtn">LOGIN</a>
            <?php } else { ?>
            <a href="<?php echo base_url(); ?>members/logout" class="newbtn">LOGOUT</a>
            <?php } ?>
            <?php if(!$this->session->userdata('logged_in_site')) { ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>members/registration/" class="newbtn">APPLY</a>
            <?php } else { ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>members/" class="newbtn">ACCOUNT DETAILS</a>
            <?php } ?>
         </p>
        
        </div>
        
    </div>
</div>

<!-- For Big desktop -->
<div class="topbar visible-md visible-lg hidden-xs hidden-sm"><!-- Top bar starts -->
	<div class="container">
    	<div class="col-sm-12 col-md-6"><i class="fa fa-phone"></i> (780) 428-0419  &nbsp;&nbsp;&nbsp;   <i class="fa fa-envelope"></i> jmensink@bomaedm.ca</div>
        <div class="col-sm-12 col-md-6" style=" text-align:right"> Follow us on <a href="https://www.instagram.com/bomaedm/" data-toggle="tooltip" title="" data-placement="bottom" target="_blank" data-original-title="Facebook"><i class="fa fa-instagram" style="margin-left:10px;"></i></a> <a href="https://www.linkedin.com/company/boma-edmonton" data-toggle="tooltip" target="_blank" title="" data-placement="bottom" data-original-title="Linked In"><i class="fa fa-linkedin" style="margin-left:10px;"></i></a> <a href="https://twitter.com/bomaedmonton" data-toggle="tooltip" title="" data-placement="bottom" target="_blank" data-original-title="Twitter"><i class="fa fa-twitter" style="margin-left:10px;" ></i></a> </div>
    </div>
</div>



<div class="headerbox"><!-- Top header starts -->
	<div class="container">
    	<div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 col-sm-12"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.jpg" ></a></div>
            <div class="col-md-6 visible-md visible-lg hidden-xs hidden-sm" style=" text-align:right">
			<?php if(!$this->session->userdata('logged_in_site')) { ?>
            <a href="<?php echo base_url(); ?>members/login/" class="newbtn">LOGIN</a>
            <?php } else { ?>
            <a href="<?php echo base_url(); ?>members/logout" class="newbtn">LOGOUT</a>
            <?php } ?>
            <?php if(!$this->session->userdata('logged_in_site')) { ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>members/registration/" class="newbtn"> Become a BOMA Member</a>
            <?php } else { ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>members/" class="newbtn">ACCOUNT DETAILS</a>
            <?php } ?></div>    
        </div>
        <div class="row">
        	<div class="col-md-12">
            
             <div id='cssmenu' style="background-color:#173582">
                <ul>
                <li <?php if($class == "welcome" ){ ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>">Home</a></li>
                 <?php foreach($category as $item) : ?>
                                <li <?php if($class == $item->cname || $class == strtoupper($item->cname) ){ ?> class="active" <?php } else { ?>class=""<?php } ?>>
                                    <a href="#" class="dropdown-toggle" ><?php echo $item->cname;?></a>
                                    <?php $this->load->model("siteModel");
                                    $subcat = $this->siteModel->get_subcategory_by_id($item->cid)->result(); ?>
                                    <ul>
                                        <?php foreach($subcat as $subitem) : ?>
                                        <li><a href="<?php echo base_url(); ?>pages/subcategory/<?php echo strtolower(str_replace(array(' ','&'), "-",$item->cname));?>/<?php echo strtolower(str_replace(array(' ','&'), "-",$subitem->scname));?>/<?php echo $subitem->scid;?>"><?php echo $subitem->scname;?></a></li>								
                                        <?php endforeach; ?>                                        
                                         <?php if(trim($item->cname) =="News"){?>
                                            <li><a href="<?php echo base_url(); ?>posts">NEWSLETTER</a></li>
                                        <?php }?>
                                    </ul>
                                </li>
                                <?php endforeach; ?> 
                                <li <?php if($class == 'events' ){ ?> class="active" <?php } else { ?>class=""<?php } ?>><a href="<?php echo base_url(); ?>events/index">Events Registration</a></li>
                                
                                <!--<li class="dropdown">
                                    <a href="#" class="dropdown-toggle">Education</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">RPA/FMA Courses</a></li>
                                        <li><a href="#">PD Seminars</a></li>								                                     
                                    </ul>
                                </li>  -->
                                
                               <li <?php if($class == 'jobs' ){ ?> class="active" <?php } else { ?>class=""<?php } ?>>
                                <a href="<?php echo base_url(); ?>pages/jobs">Jobs</a>
                                <?php if(!$this->session->userdata('logged_in_site')) { ?>
                                 <ul>
                                 	<li><a href="<?php echo base_url(); ?>pages/post_jobs">Post Paid Jobs</a></li>
                                 </ul>
                                 <?php } ?>
                                </li>
                                <!--<li><a href="<?php// echo base_url(); ?>members/registration/">Membership</a></li>
                                <li><a href="#">News </a></li>-->
                                
                                <li <?php if($class == "contact") { ?>class="active"<?php } ?> ><a href="<?php echo base_url(); ?>contactus">Contact</a></li>
                </ul>
                </div>
            
            
            </div>
        </div>
    </div>


</div>