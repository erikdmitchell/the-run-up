<?php get_mdw_single_page_header(); ?>

<div class="bg-header"></div>
<section class="content-block home section-1" id="home">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo get_home_content(); ?>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .section -->

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
			<?php echo do_shortcode('[mdw-gmap /]'); ?>
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

<section class="content-block partners section-3" id="partners">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title"><?php echo get_the_title(16); ?></h2>
				<?php echo get_partners(); ?>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .section -->

<?php get_mdw_single_page_footer(); ?>