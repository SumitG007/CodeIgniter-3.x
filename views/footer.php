<!-- Footer  starts --> 
	<div class="newcontainer-fluid">
    
        <div class="container"> 
			<div class="row">
            
            	<div class="col-md-2">
                	<img src="<?php echo base_url(); ?>images/bomabottom.jpg"><br><br>
                     EPCOR Tower<br />#870, 10423 - 101 Street<br />
                    Edmonton, AB T5H 0E7<br />
                    T. 780-428-0419<br>
                    F. 780-426-6882<br />
                    jmensink@bomaedm.ca
            </div>
                <div class="col-md-2">
                	<h3>ABOUT BOMA</h3>
                    <ul class="list-unstyled">
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/about-boma/about-membership/5">About Membership</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/about-boma/history-of-boma/4">History of BOMA</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/about-boma/association-info/6">Association Info.</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/about-boma/boma-edmonton-board/7">BOMA Education Board</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                	<h3>EVENTS</h3>
                    <ul class="list-unstyled">
                    <li><a href="<?php echo base_url(); ?>events/index">Event Registration</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/events/non-member-registration/8">Non Member Registration</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/special-events/awards-gala-/10">Awards Gala</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/special-events/christmas-charity-event/11">Christmas Charity Event</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/events/meeting-dates/9">Meeting Dates</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/special-events/golf-classic/12">Golf Classic</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                	<h3>MEMBERSHIP</h3>
                    <ul class="list-unstyled">
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/about-boma/about-membership/5">New Members</a></li>
                    <li><a href="/members/registration/">Membership Application</a></li>

                    </ul>
                </div>
                <div class="col-md-2">
                	<h3>RESOURCES</h3>
                    <ul class="list-unstyled">
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/resources/leasing-guide/1">Leasing Guide</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/subcategory/resources/links---resources/2">Links and Resources</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/jobs">Job Board</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                	<img src="<?php echo base_url(); ?>images/bomabotlogo.jpg">
                </div>
               
            
            </div>        
        </div>
        
    </div>
    
    <div class="botcontainer-fluid" >
        <div class="container" > 
                <div class="row">Copyright © 2015. All Rights Reserved BOMA Edmonton</div>        
        </div>
    </div>
<!-- Footer  ends --> 

<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/moment-with-locales.js"></script>

<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js"></script><?php */?>
<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script><?php */?>
<script src="<?php echo base_url(); ?>js/transition.js"></script>

<script src="<?php echo base_url(); ?>js/tooltip.js"></script>
<script src="<?php echo base_url(); ?>js/ie10-viewport-bug-workaround.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.smartmarquee.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>

<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">

$("input[name='memType']").click(function () {
	 $('#show-me').css('display', ($(this).val() === 'principal') ? 'block':'none');
	$('#allied-show-me').css('display', ($(this).val() === 'allied') ? 'block':'none');
	$('#nfpa-show-me').css('display', ($(this).val() === 'nfpa') ? 'block':'none');
	$('#student-show-me').css('display', ($(this).val() === 'student') ? 'block':'none');
});
$(document).ready(function () 
{
	$('#show-me').css('display', ($(" .member input:checked ").val() === 'principal') ? 'block':'none');
	
	$('#allied-show-me').css('display', ($(" .member input:checked ").val() === 'allied') ? 'block':'none');
	
	$('#nfpa-show-me').css('display', ($(" .member input:checked ").val() === 'nfpa') ? 'block':'none');
	
	$('#student-show-me').css('display', ($(" .member input:checked ").val() === 'student') ? 'block':'none');
	});
//$('input:radio[id=optionsRadios1]').prop('checked', true);
</script>

<script type="text/javascript">
function makeid()
{
    var text = "";
    var possible = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:?";

    for( var i=0; i < 12; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
 $(function () {
        $("#generatepass").click(function () {
            if ($(this).is(":checked")) {
                $("#inputpassword").val(makeid());
            } else {
                $("#inputpassword").val("");
            }
        });
    });
 
</script>
<script type="text/javascript">
			/*
            $(function () {
				/*var date = new Date();
				var currentMonth = date.getMonth();
				var currentDate = date.getDate();
				var currentYear = date.getFullYear();
                $('#datetimepicker1').datepicker({
					dateFormat: "yy-mm-dd",
					//minDate: new Date(currentYear, currentMonth, currentDate),
					minDate: new Date(),
					autoclose: true
				});
				
  				//s$('#datetimepicker2').focus();
				//$('#datetimepicker1').hide();
            });
			$(function () {
                $('#datetimepicker2').datepicker({ 
					dateFormat: "yy-mm-dd",
					minDate: new Date(),
					autoclose: true
				});
				//$('#inputEmail').hide();
            });*/
			
			 /*$(document).mouseup(function (e) {

				$('#datetimepicker1').Close();
				
				$('#datetimepicker2').Close();
		
			});*/
			 
			 $(function () {
				$("#start_date").datepicker({
					dateFormat: 'dd-mm-yy',
					minDate: 0
				});
				$("#end_date").datepicker({
					dateFormat: 'dd-mm-yy',
					minDate: 0
				});
			});
        </script>

<script src="<?php echo base_url(); ?>js/functions.js"></script>

</body>
</html>