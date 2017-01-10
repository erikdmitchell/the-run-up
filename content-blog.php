<?php
$blog_query=new WP_Query(array(
	'category_name' => 'blog'
));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-blog'); ?>>

	<div class="content container">
		<?php if ($blog_query->have_posts()) : ?>
			<?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
			
				<div class="row">
					<div class="col-xs-12">
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-12">
						<a href="<?php the_permalink(); ?>"><?php the_title('<h2>', '</h2>'); ?></a>
					</div>
				</div>
			
			<?php endwhile; ?>
		<?php else : ?>
			No blog posts found.
		<?php endif; ?>
	</div>

</article>