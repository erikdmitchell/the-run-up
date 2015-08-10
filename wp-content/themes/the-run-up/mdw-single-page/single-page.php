<?php
/**
 * Template Name: Coming Soon
**/
?>
<?php get_header(); ?>

	<div class="container coming-soon">
		<div class="coming-soon-inner">
				<h1>TheRunUp.com CX Team</h1>
				<h2>Coming Soon...</h2>
				<ul class="links">
					<li><strong><a href="mailto:erikdmitchell@gmail.com">Sponsorship Opportunities</a></strong></li>
				</ul>
				<?php while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
		</div>
	</div>

<?php get_footer(); ?>