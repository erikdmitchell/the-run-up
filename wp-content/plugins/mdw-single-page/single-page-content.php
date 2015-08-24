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
				$this->get_content_block($item->object_id,$section); // echos the content
				$section++;
			endforeach;
		endif;
	}

	// cannot due a return due to locate_template //
	protected function get_content_block($post_id=0,$section=0) {
		if (!$post_id)
			return false;

		$html=null;
		$post=get_post($post_id);
		$section_classes_default=apply_filters('mdw_single_page_section_classes_default',array('content-block',$post->post_name,'section-'.$section));
		$section_classes=apply_filters("mdw_single_page_section_classes_post-{$post_id}",$section_classes_default);
		$section_container_classes_default=apply_filters('mdw_single_page_section_container_classes_default',array('container'));
		$section_container_classes=apply_filters("mdw_single_page_section_container_classes_default_post-{$post_id}",$section_container_classes_default);

		if ($template=$this->get_custom_page_template($post_id)) :
			locate_template($template,true,false);
		else :
		?>
			<section class="<?php echo implode(' ',$section_classes); ?>" id="<?php echo $post->post_name; ?>">
				<div class="<?php echo implode(' ',$section_container_classes); ?>">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title"><?php echo get_the_title($post->ID); ?></h2>
							<?php
							// check for a custom page template, otherwise load standard content //
							if ($template=$this->get_custom_page_template($post_id)) :
								locate_template($template,true,false);
							else :
								echo apply_filters('the_content',$post->post_content);
							endif;
							?>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->
			</section><!-- .section -->
		<?php
		endif;
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