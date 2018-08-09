<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-landing'); ?></a>

<div class="title">
	<a href="<?php the_permalink(); ?>"><?php the_title('<h2>', '</h2>'); ?></a>
</div>

<div class="author">
	<?php the_author(); ?>
</div>

<div class="date">
	<?php the_time('F j, Y'); ?>
</div>

<div class="excerpt">
	<?php echo tru_excerpt_by_id(get_the_ID(), 50, '', '<a href="'.get_permalink(get_the_ID()).'">...more</a>'); ?>
</div>