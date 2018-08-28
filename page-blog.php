<?php
/**
 * Template Name: Blog
**/

get_header(); ?>

<div class="container">
	<div class="row content">
        <?php get_template_part('template-parts/content', 'blog'); ?>
	</div>
</div><!-- .container -->

<?php get_footer();