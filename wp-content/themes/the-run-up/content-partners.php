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
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );	?>

		<div class="entry-meta">
			<?php	edit_post_link( __( 'Edit', 'mdw-theme' ), '<span class="edit-link"><span class="glyphicon glyphicon-pencil"></span>', '</span>' );	?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php	the_content(); ?>
		<?php echo get_partners(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
