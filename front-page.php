<?php get_header(); ?>

<div class="container">
    <div class="row content">
        <?php
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
          
            echo $paged;  
        ?>
        <?php get_template_part( 'template-parts/content', 'landing' ); ?>
    </div>
</div><!-- .container -->

<?php
get_footer();
