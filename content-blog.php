<?php
$blog_query=new WP_Query(array(
	'category_name' => 'blog'
));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-blog'); ?>>

	<div class="col-xs-12 col-md-8 main">
		<?php if ($blog_query->have_posts()) : ?>
			<?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
				<?php the_title(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			No blog posts found.
		<?php endif; ?>
	</div>

	<div class="col-xs-12 col-md-4 right">
Sidebar?
	</div>

</article>