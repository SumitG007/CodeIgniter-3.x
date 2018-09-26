<style type="text/css">

.bs-example {
	position: relative;
	margin: 100px;
}
.typeahead, .tt-query, .tt-hint {
	width:100%;
}
.twitter-typeahead {
	width: 100%;
}
.tt-hint {
	color: #fff;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 5px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Search Members of a particular Company</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>admin/membership/approved/">Manage Approved Members</a></li>
      <li class="active">Sub Members</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
          
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                	<form name="frmsearch" method="post" action="<?php echo base_url(); ?>admin/membership/view_sub_members" >
						<div class="input-group input-group-sm">
                            <input type="text" class="typeahead form-control" autocomplete="off" spellcheck="false" name="searchmember" >
                            <span class="input-group-btn">
                              <input type="submit" class="btn btn-info btn-flat" value="Go!" />
                            </span>
                          </div><!-- /input-group -->
                     </form>     
                </div><!-- /.box-header -->
                <!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
          
          
          
        </section><!-- /.content -->
  <!-- /.content --> 
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('input.typeahead').typeahead({
            name: 'accounts',
            local: [<?php foreach($company as $item) { ?> '<?php echo $item->company_name." ~ ".$item->id; ?>', <?php } ?>]
        });
    });  
    </script> 
