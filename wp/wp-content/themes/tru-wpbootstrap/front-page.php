<?php
/**
 * Template Name: Front Page
**/
?>
<?php get_header(); ?>

	<div class="container-fluid">
		<?php //get_template_part('bootstrap/slider'); ?>
		<?php echo do_shortcode('[bootstrap-slider slider_id="slider" post_type="slides" indicators="false" controls="false"]'); ?>
	</div>

	<div class="container">
		<div class="row">
			<?php echo get_recent_posts_grid(); ?>
		</div><!-- .row -->	
	</div><!-- .container -->
	
<?php get_footer(); ?>      