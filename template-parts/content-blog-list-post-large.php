<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-landing-large' ); ?></a>

<div class="title">
    <a href="<?php the_permalink(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>
</div>

<div class="excerpt">
    <?php echo tru_excerpt_by_id( get_the_ID(), 30, '', '<a href="' . get_permalink( get_the_ID() ) . '">...more</a>' ); ?>
</div>
