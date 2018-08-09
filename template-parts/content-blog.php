<?php
$featured_blog_query=new WP_Query(array(
	'category_name' => 'blog',
	'posts_per_page' => 2,
));

$blog_query=new WP_Query(array(
	'category_name' => 'blog',
	'posts_per_page' => 6,
	'offset' => 2,	
));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-blog-landing'); ?>>

	<div class="content container">
		<?php if ($featured_blog_query->have_posts()) : ?>
    		<div class="row">
	    		<?php while ($featured_blog_query->have_posts()) : $featured_blog_query->the_post(); ?>
				
					<div class="col-xs-12 col-sm-6">
    				    <?php get_template_part('template-parts/content-blog-list', 'post'); ?>
					</div>
		
                    <?php endwhile; ?>
    		</div>
        <?php endif; ?>

		<?php if ($blog_query->have_posts()) : ?>
    		<div class="row">
    			<?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
				
					<div class="col-xs-12 col-sm-6 col-md-4">
    				    <?php get_template_part('template-parts/content-blog-list', 'post'); ?>
					</div>
	                			
                <?php endwhile; ?>
    		</div>
        <?php endif; ?>
	</div>

</article>