<?php
/**
 * Template Name: Front Page
**/
?>
<?php get_header(); ?>

<?php get_template_part('content','slider'); ?>

<section class="content-block home section-1" id="home">
	<div class="container">
		<?php echo get_home_featured(); ?>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Rider Diaries</h2>
				<?php echo get_home_rider_diaries(); ?>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .section -->
<!--
<section class="content-block schedule section-2" id="schedule">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title"><?php echo get_the_title(12); ?></h2>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<?php echo do_shortcode('[mdw-gmap /]'); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo get_schedule(); ?>
			</div>
		</div>
	</div>
</section>
-->

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

<?php get_footer(); ?>