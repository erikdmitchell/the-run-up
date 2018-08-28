<?php
/**
 * The template for displaying FAQ content
 *
 * @package WordPress
 * @subpackage the-run-up
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );	?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'the-run-up' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
