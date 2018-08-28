<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php tru_theme_post_thumbnail('single'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php while ( have_posts() ) : the_post(); ?>
					
				<article id="post-<?php the_ID(); ?>" <?php post_class('tru-blog-single'); ?>>
					<header class="entry-header">
						<?php	the_title( '<h1 class="entry-title">', '</h1>' );	?>
				
						<div class="entry-meta">
							<?php the_author(); ?><br />
							<?php the_time('F j, Y'); ?>
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
				
					<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', ' ', '</span></footer>' ); ?>
				</article><!-- #post-## -->

				<?php
				// Previous/next post navigation.
				//koksijde_theme_post_nav();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
								
			<?php endwhile; ?>
		</div>
	</div>
</div><!-- .container -->