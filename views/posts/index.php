<div class="container" style="margin-bottom:30px;">
	<div class="page-header">
		<ol class="breadcrumb">
	        <?php echo $breadcrumb; ?>
	    </ol>
    <div class="row" style="margin-top:30px;">
		<div class="col-md-8 col-sm-12">
		<?php
			header("allow-file-access-from-files: none");
			$count = count($home);
			if($count >0)
			{
				foreach($home as $item)
				{
				?>	
					<div class="panel panel-default">
						<div class="content">	
							<h2><a href="<?php echo base_url(); ?>posts/view/<?php echo $item->slug?>"><?php echo $item->title;?></a></h2>
						</div>
						<div class="panel-img">
							<img src="<?php echo base_url(); ?>images/<?php echo $item->image; ?>" />
						</div>
						<div class="panel-body content">
							<?php echo word_limiter($item->content,30);?>
						</div>
						<div class="panel-footer">
							<div class="post-meta">
								<i class="fa fa-calendar"><?php echo date('d M Y', strtotime($item->published_at));?></i>
								<a class="btn btn-default btn-primary" href="<?php echo base_url(); ?>posts/view/<?php echo $item->slug?>">Read More</a>
							</div>
						</div>
					</div>		
				<?php
				}?>
				<ul class="pagination pagination-sm no-margin list-inline">
	                <?php echo $pagination; ?>
	            </ul>
			<?php }	
		?>
		</div>
<script>
	$(document).ready(function() {
   $('.panel-img img').each(function()
   {
   		var width = $(this).width();
   		var height = $(this).height();
   		
   		 var mr = 800/400;
   		var ir = width/height;
        console.log(ir);

        if( height > 400)
        {
        	var w = 400*ir;
            
            $(this).height(400);
            $(this).width(400*ir);
            $(this).parent().attr('style',  'margin:auto');
            $(this).parent().width(400*ir);
        }
        
   });
	});
</script>