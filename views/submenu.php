<div class="container" style="margin-bottom:30px;">
    
           <div class="page-header">
            <!-- BreadCrumb Starts -->
            <ol class="breadcrumb">
              <?php echo $breadcrum; ?>
            </ol>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2><?php echo $menu->scname; ?></h2>
                    <?php echo $menu->content; ?>
                    <br>
			<div class="row">
			<?php
				foreach($director as $item)
				{
					echo "<div class='col-sm-6 col-md-3' style='margin-bottom:0px; min-height:500px;'>
						<div class='thumbnail'>
							<img alt='' src=".base_url()."/images/".$item->image." style='height:181px; width:200px'>
							<div class='caption'>
							".$item->content."
							</div>
						</div>
					</div>";
				}
			?>
			</div>
			<?php if(count($status)>0) {?>
				<h3><strong>Staff</strong></h3>
				<p>&nbsp;</p>
			<?php }?>
			<div class="row">
			<?php
				foreach($status as $item)
				{
					echo "<div class='col-sm-6 col-md-3' style='margin-bottom:0px; min-height:500px;'>
						<div class='thumbnail'>
							<img alt='' src=".base_url()."/images/".$item->image." style='height:181px; width:200px'>
							<div class='caption'>
							".$item->content."
							</div>
						</div>
					</div>";
				}
			?>
			</div>
                </div>
            </div>
            
            
          </div>
    </div>