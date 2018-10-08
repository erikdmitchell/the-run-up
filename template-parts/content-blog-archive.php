<?php
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$blog_query = new WP_Query(
    array(
        'posts_per_page' => 12,
        'offset' => 7,
        'page' => $paged,
    )
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'tru-blog-archive' ); ?>>

    <div class="content container">

        <?php if ( $blog_query->have_posts() ) : ?>
            <div class="row">
                <?php
                while ( $blog_query->have_posts() ) :
                    $blog_query->the_post();
                    ?>
                
                    <div class="col-xs-12 col-md-6">
                        <?php get_template_part( 'template-parts/content-blog-list', 'post' ); ?>
                    </div>
                                
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    
        <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts', $blog_query->max_num_pages ); ?></div>
        <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

    </div>

</article>
