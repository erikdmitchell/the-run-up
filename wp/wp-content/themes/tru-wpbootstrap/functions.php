<?php
add_image_size('post-thumb-home',360,240,true);
add_image_size('post-thumb-blog',740,340,true);
add_image_size('post-thumb-single',1140,520,true);

/**
 *
 */
function get_recent_posts_grid($limit=3) {
	$html=null;
	$args=array(
		'posts_per_page' => $limit,
	);
	$posts=get_posts($args);
	
	if (!count($posts))
		return false;
	
	foreach ($posts as $post) :
		$html.='<div class="col-md-4 blog-post">';
			$html.='<h3><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h3>';
			if (get_the_post_thumbnail($post->ID))
				$html.='<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID,'post-thumb-home').'</a>';
			$html.='<div class="text">';
				$html.=pippin_excerpt_by_id($post->ID,30,'','...<a href="'.get_permalink($post->ID).'">more &raquo;</a>');
			$html.='</div>';
		$html.='</div><!-- .blog-post -->';
	endforeach;
	
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

/**
 *
 */
function get_sponsors_section() {
	$html=null;
	
	if (!get_sponsors_list())
		return false;
		
	$html.='<div class="container-fluid sponsors green-bg">';
		$html.='<div class="container">';
			$html.='<div class="row">';
				$html.='<div class="col-md-12">';
					$html.=get_sponsors_list();
				$html.='</div>';
			$html.='</div>';
		$html.='</div>';
	$html.='</div>';
		
	return $html;
}

/**
 *
 */
function get_sponsors_list() {
	$html=null;
	$args=array(
		'posts_per_page' => -1,
		'post_type' => 'sponsors'
	);
	$posts=get_posts($args);
	
	if (!count($posts))
		return false;
		
	$html.='<ul class="sponsors-list">';
		foreach ($posts as $post) :
			$html.='<li>'.get_the_title($post->ID).'</li>';
		endforeach;
	$html.='</ul>';
	
	return $html;
}
?>