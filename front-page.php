<?php
/**
 * Template Name: TRU Front Page
**/
?>
<?php get_header(); ?>

<div class="jumbotron home">
	<div class="container">
		<div class="title">Fantasy Cyclocross</div>

		<div class="slogan">Create the Ultimate Cyclocross Team</div>

		<div class="join-now-button">
			<?php if (is_user_logged_in()) : ?>
				<button id="my-team-button" class="my-team button btn-primary">My Team</button>
			<?php else: ?>
				<a href="<?php echo wp_registration_url(); ?>"><button id="join-now-button" class="join-now button btn-primary">Join Now</button></a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="container how-to-play">
	<div class="row">
		<div class="col-md-12 title">
			How to Play
		</div>
		<div class="col-md-2 step-1">
			<i class="fa fa-pencil-square-o icon" aria-hidden="true"></i>
			<div class="text">Sign up for Free</div>
		</div>
		<div class="col-md-3 arrow">
			<i class="fa fa-chevron-right icon" aria-hidden="true"></i>
		</div>
		<div class="col-md-2 step-2">
			<i class="fa fa-users icon" aria-hidden="true"></i>
			<div class="text">Select riders for your team</div>
		</div>
		<div class="col-md-3 arrow">
			<i class="fa fa-chevron-right icon" aria-hidden="true"></i>
		</div>
		<div class="col-md-2 step-3">
			<i class="fa fa-trophy icon" aria-hidden="true"></i>
			<div class="text">Win and brag to your friends</div>
		</div>
	</div>
</div>

<div class="container-fluid home-about">
	<div class="container">
    	
		<div class="row section-title">
			<div class="col">
				<h1>About The Run Up</h1>
			</div>
		</div>
		
		<div class="row justify-content-center">
			<?php get_template_part('template-parts/content-home', 'about'); ?>
		</div>
		
	</div>
</div>

<?php if (have_posts()) : ?>
<!--
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
-->
<?php endif; ?>

<?php get_footer(); ?>