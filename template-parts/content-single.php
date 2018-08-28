<div class="container">
	<div class="row">
		<div class="col-12">
			<?php tru_post_thumbnail('single'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part('template-parts/', 'content');
				endwhile;
			?>
		</div>
	</div>
</div><!-- .container -->