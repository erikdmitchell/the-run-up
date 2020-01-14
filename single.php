<?php get_header(); ?>


<div class="main-image">
    <?php tru_post_thumbnail( 'single' ); ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                    
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php	the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                
                        <div class="entry-meta">
                            <?php the_time( 'F j, Y' ); ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->
                
                    <div class="entry-content">
                        <?php
                            the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'the-run-up' ) );
                            wp_link_pages(
                                array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'the-run-up' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                )
                            );
                        ?>
                    </div><!-- .entry-content -->
                                                         
                    <footer class="container entry-meta">
                        <?php if ( has_tag() ) : ?>
                            <div class="row tags-list">
                                <div class="tags-title">Tags</div>
                                
                                <?php the_tags( '<div class="tag-links">', ' ', '</div>' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( tru_has_categories( 1 ) ) : ?>
                            <div class="row categories-list">
                                <div class="categories-title">Categories</div>
                            
                                <div class="categories-link">
                                    <?php tru_post_categories( ' ', 1 ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </footer>
                    
                    <div class="single-post-sidebar">
                        <?php dynamic_sidebar( 'single-post' ); ?>
                    </div> 
                    
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>
                </article><!-- #post-## -->
                                
            <?php endwhile; ?>
        </div>
    </div>
</div><!-- .container -->

<?php
get_footer();
