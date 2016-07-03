<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php mdw_theme_post_thumbnail(); ?>
		</div>
	</div>
	<div class="row content">
		<div class="col-md-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content','partners'); ?>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, this page does not exist.','mdw-theme'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>