<div class="container">
	<section class="row" id="impact-dataviz">
		<div class="col-md-12">
			<div class="di_consume <?php echo $info['consume_class']; ?>">
				<img src="/assets/icons/<?php echo $info['consume_image']; ?>" class="img-responsive">
				<div class="text">
					<div class="blue"><?php echo $info['consume_label']; ?></div>
					<div class="consume"><?php echo $info['consume_eql_to']; ?></div>
				</div>
			</div>
		
			<div class="di_manufacture">
				<div class="col-md-12 text-center"><div class="lightblue"><?php echo $info['manufacture_label']; ?></div></div>
				<?php for($i = 1; $i<= $info['manufacture_eql_to']; $i++){ ?>
					<div class="col-md-3 text-center">
						<img src="/assets/icons/<?php echo $info['manufacture_img']; ?>" class="img-responsive">
					</div>
				<?php } ?>
				<div class="col-md-12 text-center">
					<div class="legend">1 <img src="/assets/icons/<?php echo $info['manufacture_img']; ?>"> = <?php echo $info['manufacture_legend']; ?> (approximately)</div>
					
				</div>
			</div>
			
		</div>
	</section>
</div>