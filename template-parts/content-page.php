<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage the-run-up
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php	the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <div class="entry-meta">
            <?php
            if ( 'post' == get_post_type() ) {
                tru_theme_posted_on();
            }
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    
    <div class="entry-content">
        <?php
            the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'koksijde' ) );
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'koksijde' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )
            );
            ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
