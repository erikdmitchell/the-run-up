<?php
/**
 * The template for displaying category posts
 *
 * @package WordPress
 * @subpackage the-run-up
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row tag-row">
            <div class="col-3">
                <?php tru_post_thumbnail( 'medium' ); ?>
            </div>
            <div class="col-9">
                
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title"><a href="' . get_permalink() . '">', '</a></h1>' ); ?>

                    <div class="entry-meta">
                        <?php
                        if ( 'post' == get_post_type() ) {
                            tru_theme_posted_on();
                        }
                        ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php echo tru_excerpt_by_id( get_the_ID(), 35, '<a><em><strong>', '... <a href="' . get_permalink() . '">read more</a>' ); ?>
                </div><!-- .entry-content -->
            </div>
        </div>
    </div>
</article><!-- #post-## -->
