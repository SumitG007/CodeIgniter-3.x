	<div class="col-md-4 col-sm-12">
		<div class="widget default">
			<div class="widget-title">
				<?php if(count($featured_home) >0)?>
						<h3>Recent Posts</h3>
			</div>
			<div class="list-group">
				<?php 
				$count = count($featured_home);
				if($count >0)
				{
					$i=0;
					foreach($featured_home as $item)
					{
						if($i<3)
						{	
				?>	
				<div class="list-group-item">
					<div class="row-picture">
						<img class="circle" alt="" src="<?php echo base_url(); ?>images/<?php echo $item->image; ?>" />	
					</div>
					<div class="row-title">
						<h4><a href="<?php echo base_url(); ?>posts/view/<?php echo $item->slug?>"><?php echo $item->title;?></a></h4>	
					</div>
					<div class="list-group-separator">
					</div>
				</div>
				<?php }$i++;}}?>
			</div>
			<div class="widget-title">
				<h3>Archive</h3>
			</div>
			<div class="list-group">
				<?php 
				$count = count($month_home);
				if($count >0)
				{
					$i=0;
					foreach($month_home as $item)
					{
						if($i<3)
						{	
				?>	
				<div class="list-group-item">
					<div class="row-date">
						<h4><a href="<?php echo base_url(); ?>posts/date/<?php echo $item->month_date;?>"><?php echo strtoupper(date("M Y", strtotime($item->published_at)));?></a></h4>	
					</div>
					<div class="">
					</div>
				</div>
				<?php }$i++;}}?>
			</div>
		</div>
		<div class="widget">
			<div class="widget-title">
				<h3>Tags</h3>
			</div>
			<div class="widget-content list-menus">
				<?php 
					$ct = count($tags);
					if($ct >0)
					{
						foreach($tags as $tag)
						{
				?>
						<a class="tags" href="<?php echo base_url(); ?>posts/tag/<?php echo $tag->slug?>"><?php echo $tag->title;?></a>
				<?php 	}
					}
				?>
			</div>
		</div>	
	</div>
</div>
</div>
</div>