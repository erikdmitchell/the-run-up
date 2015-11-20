<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search. -- Currently page.php and index.php
 *
 * @package WordPress
 * @subpackage MDW Theme
 * @since MDW Theme 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php	the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php
			if ( 'post' == get_post_type() )
				mdw_theme_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="comments-link"><span class="glyphicon glyphicon-comment"></span><?php comments_popup_link( __( 'Leave a comment', 'mdw-theme' ), __( '1 Comment', 'mdw-theme' ), __( '% Comments', 'mdw-theme' ) ); ?></span>
				<?php
				endif;

				edit_post_link( __( 'Edit', 'mdw-theme' ), '<span class="edit-link"><span class="glyphicon glyphicon-pencil"></span>', '</span>' );
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
			the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'mdw-theme' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mdw-theme' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->