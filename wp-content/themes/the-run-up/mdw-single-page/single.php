<?php get_mdw_single_page_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php mdw_theme_post_thumbnail('posts-full-featured'); ?>
		</div>
	</div>
	<div class="row content">
		<div class="col-md-12">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					get_template_part('content');

					// Previous/next post navigation.
					mdw_theme_post_nav();
				endwhile;
			?>
		</div>
	</div>
</div><!-- .container -->

<?php get_mdw_single_page_footer(); ?>