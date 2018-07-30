<?php
/**
 * Template Name: Blog
**/

get_header(); ?>

<div class="container">
	<div class="row content">

		<?php koksijde_theme_post_thumbnail(); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('template-parts/content', 'blog'); ?>
		<?php endwhile; endif; ?>

	</div>
</div><!-- .container -->

<?php get_footer();