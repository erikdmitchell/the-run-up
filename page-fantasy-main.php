<?php
/**
 * Template Name: TRU Fantasy Main
**/
?>
<?php get_header(); ?>

<div class="container">
	<div class="row content">

		<?php koksijde_theme_post_thumbnail(); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('content', 'fantasy-landing'); ?>
		<?php endwhile; endif; ?>

	</div>
</div><!-- .container -->

<?php get_footer(); ?>