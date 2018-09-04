<?php
/**
 * Template Name: TRU Coming Soon
**/
?>
<?php get_header(); ?>

<div class="jumbotron home">
	<div class="container">
		<div class="title">Fantasy Cyclocross Cycling</div>

		<div class="slogan">Create the Ultimate Cyclocross Cycling Team</div>
	</div>
</div>

<div class="container-fluid newsletter">
	<div class="container">
		<div class="row section-title">
			<div class="col-12">
				Sign Up Today
			</div>
		</div>
		<div class="row section-details">
			<div class="col-8 offset-2">
				<div class="section-content">
					The evolution of Fantasy Cyclocross continues this fall. We are adding new features to make gameplay more interactive and fun. We are rebuilding things from the ground up. Join our mailing list for exclusive previews, information and get ready for the season.
				</div>
			</div>
		</div>
		<div class="row form">
			<div class="col-4 offset-4">
				<?php echo do_shortcode('[mc4wp_form id="263"]'); ?>
			</div>
			<div class="col-12">
				<p>
					Check us out on Twitter <a href="https://twitter.com/TheRunUpCX">@therunupcx</a> for even more.
				</p>
			</div>
		</div>
	</div>
</div>

<div class="container how-to-play">
	<div class="row justify-content-md-center">
		<div class="col-md-12 title">
			How to Play
		</div>
		
		<div class="icons-wrapper">
    		<div class="col-12 col-md-2 step-1">
                <i class="material-icons">create</i>
    			<div class="text">Sign up for Free</div>
    		</div>
    		<div class="col-md-3 d-none d-md-block arrow">
                <i class="material-icons">chevron_right</i>
    		</div>
    		<div class="col-12 col-md-2 step-2">
                <i class="material-icons">people</i>
    			<div class="text">Select riders for your team</div>
    		</div>
    		<div class="col-md-3 d-none d-md-block arrow">
    			<i class="material-icons">chevron_right</i>
    		</div>
    		<div class="col-12 col-md-2 step-3">
    			<i class="material-icons">mood</i>
    			<div class="text">Win and brag to your friends</div>
    		</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer();