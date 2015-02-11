<?php
add_action( 'after_setup_theme','remove_twentyeleven_options', 100 );
function remove_twentyeleven_options() {
	remove_theme_support( 'custom-background' );
	remove_theme_support( 'custom-header' );
}

function list_weeks($season) {
	$html=null;
	
	$args=array(
		'posts_per_page' => -1,
		'category' => '.$season.',
		'orderby' => 'title',
		'order' => 'ASC',
	);

	$weeks=get_posts($args);

	$html.='<ul class="weeks">';
		foreach ($weeks as $week) :
			$html.='<li>';
				$html.='<a href="'.get_permalink($week->ID).'">'.get_the_title($week->ID).'</a>';
			$html.='</li>';
		endforeach;
	$html.='</ul>';
	
	return $html;
}
?>