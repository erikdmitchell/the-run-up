<?php

add_image_size('home-blog-thumb', 330, 178, true);
/**
 * theme_enqueue_styles function.
 *
 * @access public
 * @return void
 */
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	//wp_enqueue_style('ccc-style', get_stylesheet());
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * get_upcoming_rides function.
 *
 * @access public
 * @return void
 */
function get_upcoming_rides() {
	$html=null;
	$args=array(
		'posts_per_page' => -1,
		'meta_key' => '_event_date',
		'post_type' => 'page',
		'post_parent' => 2,
	);
	$posts=get_posts($args);

	if (!count($posts))
		return false;

	// custom sort by date //
	usort($posts, function ($a, $b) {
		return strcmp(strtotime(get_post_meta($a->ID, '_event_date', true)),strtotime(get_post_meta($b->ID, '_event_date', true)));
	});

	$html.='<div class="upcoming-rides">';
		$html.='<h3>Upcoming Rides</h3>';
		$html.='<ul class="upcoming-rides-list">';
			foreach ($posts as $post) :
				$html.='<li id="post-'.$post->ID.'"><span class="date">'.date('D, M. j',strtotime(get_post_meta($post->ID, '_event_date', true))).'</span> - <a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
			endforeach;
		$html.='</ul>';
	$html.='</div>';

	return $html;
}

function get_blog_posts_home() {
	$html=null;
	$args=array(
		'posts_per_page' => 3
	);
	$posts=get_posts($args);

	if (!count($posts))
		return false;

	$html.='<h3>Recent Blog Posts</h3>';
	$html.='<ul class="three-col">';
		foreach ($posts as $post) :
			$html.='<li class="col" id="post-'.$post->ID.'">';
				$html.='<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'home-blog-thumb').'</a>';
				$html.='<h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>';
				$html.=pippin_excerpt_by_id($post->ID, 30, '', ' <a href="'.get_permalink($post->ID).'">...more &raquo;</a>');
			$html.='</li>';
		endforeach;
	$html.='</ul>';

	return $html;
}

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
function pippin_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .') {

	if(is_int($post)) {
		// get the post object of the passed ID
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}

	if(has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}

	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);
	$the_excerpt .= $extra;

	return apply_filters('the_content', $the_excerpt);
}
?>