<?php
class SinglePageContent {

	public function __construct() {

	}

	public function generate_content() {
		$html=null;

		if (has_nav_menu('primary')) :
			$menu_id=$this->get_menu_id('primary');
			$menu_items=wp_get_nav_menu_items($menu_id);

			foreach ($menu_items as $item) :
				$html.=$this->get_content_block($item->object_id);
			endforeach;
		endif;

		return $html;
	}

	protected function get_content_block($post_id=0) {
		if (!$post_id)
			return false;

		$html=null;
		$post=get_post($post_id);

		$html.='<section class="content-block '.$post->post_name.'" id="'.$post->post_name.'">';
			$html.='<div class="container">';
				$html.='<div class="row">';
					$html.='<div class="col-md-12">';
						$html.='<h2 class="page-title">'.get_the_title($post->ID).'</h2>';
						$html.=apply_filters('the_content',$post->post_content);
					$html.='</div>';
				$html.='</div><!-- .row -->';
			$html.='</div><!-- .container -->';
		$html.='</section><!-- .section -->';

		return $html;
	}

	protected function get_menu_id($menu_name=false) {
		if (!$menu_name)
			return false;

		$nav_locations=get_nav_menu_locations();

		return $nav_locations[$menu_name];
	}

}
?>