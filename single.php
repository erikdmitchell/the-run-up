<?php get_header(); ?>

	<?php
	if (in_category('blog')) :
		get_template_part('content', 'single-blog');	
	else :
		get_template_part('content', 'single');
	endif;	
	?>

<?php get_footer(); ?>