<?php
/**
 * Displays fantasy content
 *
 */
?>
<?php
global $post;
$post_slug=$post->post_name;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ($post_slug=='create-team') : ?>
			<?php if (fc_check_if_roster_edit()) : ?>
				<h1 class="entry-title">Edit Roster</h1>
			<?php else : ?>
				<h1 class="entry-title">Add Roster</h1>
			<?php endif; ?>
		<?php else : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' );	?>
		<?php endif; ?>
	</header><!-- .entry-header -->

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

</article><!-- #post-## -->
