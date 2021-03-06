<?php
/**
 * The template for displaying the landing page
 *
 * @package WordPress
 * @subpackage the-run-up
 * @since 1.0.0
 */

$featured_blog_query = new WP_Query(
    array(
        'posts_per_page' => 1,
    )
);

$blog_query = new WP_Query(
    array(
        'posts_per_page' => 6,
        'offset' => 1,
    )
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="content container">
        <?php if ( $featured_blog_query->have_posts() ) : ?>
            <div class="row">
                <?php
                while ( $featured_blog_query->have_posts() ) :
                    $featured_blog_query->the_post();
                    ?>
                
                    <div class="col-12">
                        <div class="list-post-thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-landing' ); ?></a>
                        </div>
                        
                        <div class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>
                        </div>
                        
                        <div class="excerpt">
                            <?php tru_show_excerpt_by_id( get_the_ID(), 60, '', '<a href="' . get_permalink( get_the_ID() ) . '">... read more</a>' ); ?>
                        </div>
                    </div>
                
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if ( $blog_query->have_posts() ) : ?>
            <div class="row">
                <?php
                while ( $blog_query->have_posts() ) :
                    $blog_query->the_post();
                    ?>
                
                    <div class="col-12 col-sm-6">
                        <div class="list-post-thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-single' ); ?></a>
                        </div>
                        
                        <div class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>
                        </div>
                        
                        <div class="excerpt">
                            <?php tru_show_excerpt_by_id( get_the_ID(), 30, '', '<a href="' . get_permalink( get_the_ID() ) . '">... read more</a>' ); ?>
                        </div>
                    </div>
                                
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    
        <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts', $blog_query->max_num_pages ); ?></div>

    </div>

</article>
