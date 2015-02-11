<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>

	<div id="primary" class="content-area full-width">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


					<div class="entry-content">
						<div class="left-col">
							<?php the_content(); ?>
						</div><!-- .left-col -->
						<div class="right-col">
							<?php echo get_upcoming_rides(); ?>
						</div><!-- .right-col -->
						<?php echo get_blog_posts_home(); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>