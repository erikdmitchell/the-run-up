<?php
class SinglePageContent {

	public function __construct() {

	}

	public function generate_content() {
		$html=null;
		$section=1;

		if (has_nav_menu('primary')) :
			$menu_id=$this->get_menu_id('primary');
			$menu_items=wp_get_nav_menu_items($menu_id);

			foreach ($menu_items as $item) :
				$html.=$this->get_content_block($item->object_id,$section);
				$section++;
			endforeach;
		endif;

		return $html;
	}

	protected function get_content_block($post_id=0,$section=0) {
		if (!$post_id)
			return false;

		$html=null;
		$post=get_post($post_id);

		//if ($template=$this->get_custom_page_template($post_id))
			//return locate_template($template,true,false);

		$html.='<section class="content-block '.$post->post_name.' section-'.$section.'" id="'.$post->post_name.'">';
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

	protected function get_custom_page_template($post_id) {
		global $MDWThemeSinglePage;

		$template_slug=get_page_template_slug($post_id);
		$user_template_folder=get_stylesheet_directory().'/'.$MDWThemeSinglePage->template_folder_override_name;

		if (!$template_slug)
			return false;

		// check for custom user files //
		if (file_exists($user_template_folder.'/'.$template_slug)) :
			$template=$MDWThemeSinglePage->template_folder_override_name.'/'.$template_slug;
			if (locate_template($template))
				return $template;
		endif;

		return false;

	}

}
?>