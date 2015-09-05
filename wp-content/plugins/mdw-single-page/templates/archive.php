<?php get_mdw_single_page_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'mdw-theme' ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'mdw-theme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'mdw-theme' ) ) );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'mdw-theme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'mdw-theme' ) ) );
						else :
							_e( 'Archives', 'mdw-theme' );
						endif;
					?></h1>
				</header><!-- .archive-header -->

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('content'); ?>
				<?php endwhile; ?>

				<?php mdw_theme_paging_nav(); // Previous/next post navigation. ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_mdw_single_page_footer(); ?>