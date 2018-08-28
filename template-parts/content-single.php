<div class="container">
	<div class="row">
		<div class="col-12">
			<?php tru_post_thumbnail('single'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                	<header class="entry-header">
                		<?php	the_title( '<h1 class="entry-title">', '</h1>' );	?>
                
                		<div class="entry-meta">
                			<?php tru_theme_posted_on(); ?>
                		</div><!-- .entry-meta -->
                	</header><!-- .entry-header -->
                
                	<div class="entry-content">
                		<?php
                			the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'koksijde' ) );
                			wp_link_pages( array(
                				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'koksijde' ) . '</span>',
                				'after'       => '</div>',
                				'link_before' => '<span>',
                				'link_after'  => '</span>',
                			) );
                		?>
                	</div><!-- .entry-content -->
                
                	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
                </article><!-- #post-## -->
            <?php endwhile; ?>
		</div>
	</div>
</div><!-- .container -->