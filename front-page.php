<?php get_header(); ?>
<?php $page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>

<div class="container">
    <div class="row content">
        <?php
        if ( 1 === $page ) :
            get_template_part( 'template-parts/content', 'landing' );
        else :
            get_template_part( 'template-parts/content', 'posts' );
        endif;
        ?>
    </div>
</div><!-- .container -->

<?php
get_footer();
