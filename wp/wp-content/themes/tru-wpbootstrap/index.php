<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content','blog'); ?>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			<?php endwhile; ?>
			<?php bootstrap_paging_nav(); // Previous/next post navigation. ?>
		</div>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>   