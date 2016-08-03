<?php
/**
 * Template Name: Register
**/
?>
<?php get_header(); ?>

<div class="container">
	<div class="row content">
		<div class="col-md-12">
			<?php koksijde_theme_post_thumbnail(); ?>

			<div class="col-md-offset-4 col-md-4">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('content', 'register'); ?>
				<?php endwhile; else: ?>
					<p><?php _e('Sorry, this page does not exist.', 'tru'); ?></p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>