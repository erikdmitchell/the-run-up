<?php
/**
 * Home page - about section
 */
?>

<?php
$home_about_query=new WP_Query(array(
	'nopaging' => true,
	'post_type' => 'homeabout'
));
?>

<?php if ($home_about_query->have_posts()) : ?>

	<?php while ($home_about_query->have_posts()) : $home_about_query->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('blurb col-xs-12 col-sm-6 col-md-4'); ?>>
			<?php	the_title( '<h2>', '</h1>' );	?>

			<?php	the_content(); ?>

		</article><!-- #post-## -->

	<?php endwhile; ?>

	<?php	wp_reset_postdata(); ?>

<?php endif; ?>