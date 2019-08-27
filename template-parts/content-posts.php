<?php
/**
 * The template for displaying posts list
 *
 * @package WordPress
 * @subpackage the-run-up
 * @since 1.0.0
 */

$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$offset = ( $page - 1 ) * 7;
$blog_query = new WP_Query(
    array(
        'posts_per_page' => 10,
        'offset' => $offset,
        'page' => $page,
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
                
                    <div class="col-12 col-sm-6">
                        <div class="blog-single-thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-single' ); ?></a>
                        </div>
                        
                        <div class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title( '<h2 class="blog-list-post">', '</h2>' ); ?></a>
                        </div>
                        
                        <div class="excerpt">
                            <?php tru_show_excerpt_by_id( get_the_ID(), 30, '', '<a href="' . get_permalink( get_the_ID() ) . '">... read more</a>' ); ?>
                        </div>
                    </div>
                                
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        
        <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts', $blog_query->max_num_pages ); ?></div>
        <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

    </div>

</article>
