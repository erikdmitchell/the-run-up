<?php
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$featured_blog_count = 1;
$right_blog_count = 2;

$featured_blog_query=new WP_Query(array(
	'posts_per_page' => $featured_blog_count,
));

$blog_right_query=new WP_Query(array(
	'posts_per_page' => $right_blog_count,
	'offset' => $featured_blog_count,	
));

$blog_query=new WP_Query(array(
	'posts_per_page' => 4,
	'offset' => $featured_blog_count + $right_blog_count,
));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-blog-landing'); ?>>

	<div class="content container">
		<?php if ($featured_blog_query->have_posts()) : ?>
    		<div class="row">
	    		<?php while ($featured_blog_query->have_posts()) : $featured_blog_query->the_post(); ?>
				
					<div class="col-xs-12 col-sm-7">
    				    <?php get_template_part('template-parts/content-blog-list-post', 'large'); ?>
					</div>
		
            		<div class="col-xs-12 col-sm-5">
                		<?php if ($blog_right_query->have_posts()) : ?>
                            <div class="row">
                	    		<?php while ($blog_right_query->have_posts()) : $blog_right_query->the_post(); ?>

                					<div class="col-12">
                    				    <?php get_template_part('template-parts/content-blog-list-post', 'right'); ?>
                					</div>

                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
            		</div>
		
                <?php endwhile; ?>
    		</div>
        <?php endif; ?>

		<?php if ($blog_query->have_posts()) : ?>
    		<div class="row">
    			<?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
				
					<div class="col-xs-12 col-sm-6">
    				    <?php get_template_part('template-parts/content-blog-list', 'post'); ?>
					</div>
	                			
                <?php endwhile; ?>
    		</div>
        <?php endif; ?>

	
        <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts', $blog_query->max_num_pages ); ?></div>
        <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

	</div>

</article>