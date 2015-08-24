<section class="content-block schedule section-2" id="schedule">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title"><?php echo get_the_title(12); ?></h2>
			</div>
		</div>
	</div><!-- .container -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php echo do_shortcode('[mdw-gmap /]'); ?>
			</div>
		</div>
	</div><!-- .container-fluid -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo get_schedule(); ?>
			</div>
		</div>
	</div><!-- .container -->
</section><!-- .section -->