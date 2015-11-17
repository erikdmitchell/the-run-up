<?php
/**
 * Template Name: Fantasy
**/
?>
<?php get_header(); ?>

<div class="container">
	<div class="row content">
		<div class="col-md-12">
			<?php mdw_theme_post_thumbnail('posts-full-featured'); ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content','fantasy'); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>