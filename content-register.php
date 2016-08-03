<?php
/**
 * The template for displaying password content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php
			if ( 'post' == get_post_type() )
				koksijde_theme_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="comments-link"><span class="glyphicon glyphicon-comment"></span><?php comments_popup_link( __( 'Leave a comment', 'koksijde' ), __( '1 Comment', 'koksijde' ), __( '% Comments', 'koksijde' ) ); ?></span>
				<?php
				endif;

				edit_post_link( __( 'Edit', 'koksijde' ), '<span class="edit-link"><span class="glyphicon glyphicon-pencil"></span>', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
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
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
