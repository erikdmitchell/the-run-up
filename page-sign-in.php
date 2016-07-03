<?php
/**
 * Template Name: Sign In
**/
?>
<?php get_header(); ?>

<div class="container">
	<div class="row content">
		<div class="col-md-12">
			<?php koksijde_theme_post_thumbnail(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h2>Sign In</h2>
			<?php echo do_shortcode('[emcl-login-form]'); ?>
		</div>
		<div class="col-md-6">
			<h2>Sign Up</h2>
			<?php echo do_shortcode('[emcl-registration-form]'); ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>