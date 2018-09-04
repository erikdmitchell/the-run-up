<?php
/**
 * Main page template
 *
 * @subpackage the-run-up
 * @since 1.0.0
 */

get_header(); ?>

<div class="container">
	<div class="row content">
		<div class="col-md-12">
			<?php tru_post_thumbnail(); ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('template-parts/', 'content'); ?>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, this page does not exist.', 'the-run-up'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer();
