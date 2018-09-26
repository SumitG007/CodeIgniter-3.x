<footer class="main-footer"> <strong> BOMA - Edmonton</strong> </footer>
</div>
<!-- ./wrapper --> 

<!-- jQuery 2.1.3 --> 
<!--<script src="<?php //echo base_url(); ?>admintheme/js/jQuery-2.1.3.min.js"></script> -->
<!-- Bootstrap 3.3.2 JS --> 
<script src="<?php echo base_url(); ?>admintheme/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>admintheme/js/moment-with-locales.js"></script>
<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>admintheme/js/bootstrap-datetimepicker.js"></script><?php */?> 
<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>admintheme/js/bootstrap-datepicker.js"></script><?php */?>
<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!-- FastClick --> 
<script src='<?php echo base_url(); ?>admintheme/js/fastclick.min.js'></script> 
<!-- AdminLTE App --> 
<script src="<?php echo base_url(); ?>admintheme/js/app.min.js" type="text/javascript"></script> 
<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script> 

<!-- SlimScroll 1.3.0 --> 
<script src="<?php echo base_url(); ?>admintheme/js/jquery.slimscroll.min.js" type="text/javascript"></script> 
<!-- ChartJS 1.0.1 -->  
<script src="<?php echo base_url(); ?>admintheme/js/jquery.tablesorter.js" type="text/javascript"></script> 
  <script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("#display").hide();
    });
    $("#show").click(function(){
        $("#display").show();
    });
});
</script>

 <script type="text/javascript">
           /* $(function () {
				var date = new Date();
				date.setDate(date.getDate()-1);
				//var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                //$('#datetimepicker1').datetimepicker();
				 $('#datetimepicker1').datepicker({
					dateFormat: "yy-mm-dd",
					//minDate: new Date(currentYear, currentMonth, currentDate),
					startDate: 0,
					autoclose: true
				});
            });
			$(function () {
                //$('#datetimepicker2').datetimepicker();
				 $('#datetimepicker2').datepicker({
					dateFormat: "yy-mm-dd",
					//minDate: new Date(currentYear, currentMonth, currentDate),
					minDate:0,
					//minDate: new Date(),
					autoclose: true
				});
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
				
				$("#event_close_date").datepicker({
					dateFormat: 'dd-mm-yy',
					minDate: 0
				});
			});
			 
        </script> 
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
    </script>
  </body>
</html>