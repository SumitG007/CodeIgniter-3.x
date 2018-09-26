<div class="container" style="margin-bottom:30px;">
	<div class="page-header">
		<ol class="breadcrumb">
	        <?php echo $breadcrumb; ?>
	    </ol>
	<div class="row" style="margin-top:30px;">
	<div class="col-md-8 col-sm-12">
		<div class="panel panel-default">
			<?php
			foreach($home as $item)
			{?>
			<div class="content">	
				<h2><a href=""><?php echo $item->title;?></a></h2>
			</div>	
			<div class="panel-img">
				<img src="<?php echo base_url(); ?>images/<?php echo $item->image; ?>" class="img-responsive" />
			</div>
			<div class="panel-body content">
				
				<?php echo $item->content;?>
			</div>
			<div class="panel-footer">
				<div class="post-meta">
					<i class="fa fa-calendar"><?php echo date('d M Y', strtotime($item->published_at));?></i>
				</div>
			</div>
			<?php }?>
		</div>
		<div class="panel">
			<div class="comment-count"><?php echo count($comments);?> Comment</div>
			<?php if ($comments) {
					foreach($comments as $comment)
					{
			?>
					<div class="content">
						<div class="comment-name"><?php echo $comment->name;?>  <span class="comment-date"><?php echo $comment->created_at;?></span></div>
						<div class="comment-content"><?php echo nl2br($comment->content);?></div>
					</div>
			<?php }} else {?>
				<p>No Comments To Display</p>
			<?php }?>
		</div>
		<h3>Add Comment</h3>
		<?php echo form_open('posts/addcommment/'.$home[0]->id)?>
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control"></textarea>
			</div>
			<input type="hidden" name="slug" value=<?php echo $home[0]->slug;?>>
			<button class="btn btn-primary" type="submit" style='margin-bottom: 10px;'>Submit</button>
		</form>	
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

        if(height > 400)
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