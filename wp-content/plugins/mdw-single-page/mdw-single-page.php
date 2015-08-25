<?php
/**
 * Plugin Name: Single Page Theme
 * Version: 0.1.2
 * Description: Adds the ability to have a single page theme. Either as a coming soon/landing page or as a full fedged site*.
 * Author: Miller Designworks
 */

class MDWThemeSinglePage {

	public $version='0.1.2';
	public $template_folder_name='templates';
	public $template_folder_override_name='mdw-single-page';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		include_once(plugin_dir_path(__FILE__).'functions.php');
		include_once(plugin_dir_path(__FILE__).'single-page-content.php');

		add_action('admin_enqueue_scripts',array($this,'admin_scripts_styles'));
		//add_action('wp_enqueue_scripts',array($this,'scripts_styles'));
		add_action('wp_enqueue_scripts',array($this,'scripts_styles'));
		add_action('template_include',array($this,'custom_template_override'));

		add_filter('mdw_wp_theme_options_tabs',array($this,'setup_tab'));
		add_filter('mdw_theme_options_default_options',array($this,'add_options'));
		add_filter('mdw_theme_mobile_nav_classes',array($this,'customize_mdw_theme_mobile_nav_classes'));
	}

	/**
	 * admin_scripts_styles function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_scripts_styles() {

	}

	/**
	 * scripts_styles function.
	 *
	 * @access public
	 * @return void
	 */
	public function scripts_styles() {
		wp_enqueue_script('mdw-theme-single-page-scripts',plugins_url('/js/functions.js',__FILE__),array('jquery'));

		wp_enqueue_style('mdw-theme-single-page',plugins_url('/css/single-page.css',__FILE__));
	}

	/**
	 * admin_page function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_page() {
		$MDWWPThemeOptions=new MDWWPThemeOptions();
		$html=null;

		if (isset($_POST['update-single-page-check']) && $_POST['update-single-page-check']) :
			if (!isset($_POST['theme_options']['single_page']['active']))
				$_POST['theme_options']['single_page']['active']=0;

			$MDWWPThemeOptions->update_options();
			echo '<div class="updated mdw-theme-options-updated">Theme Options have been updated.</div>	';
		endif;

		// build form //
		$html.='<form method="post">';

			$html.='<table class="form-table mdw-theme-options">';

				$html.='<tr>';
					$html.='<th scope="row">Activate Single Page</th>';
					$html.='<td>';
						$html.='<input type="checkbox" name="theme_options[single_page][active]" id="activate-single-page" class="" value="1" '.checked($MDWWPThemeOptions->options['single_page']['active'],1,false).' /> Activate Single Page';
					$html.='</td>';
				$html.='</tr>';

			$html.='</table>';

			$html.='<p class="submit"><input type="submit" name="update-single-page-options" id="submit" class="button button-primary" value="Save Changes"></p>';
			$html.='<input type="hidden" name="update-single-page-check" value="true" />';
			$html.='<input type="hidden" name="mdw-theme-options-page" value="single_page" />';

    $html.='</form>';

    echo $html;
	}

	/**
	 * setup_tab function.
	 *
	 * @access public
	 * @param mixed $tabs
	 * @return void
	 */
	public function setup_tab($tabs) {
		$tabs['single_page']=array(
			'name' => 'Single Page',
			'function' => array($this,'admin_page'),
			'order' => 10
		);
		return $tabs;
	}

	/**
	 * add_options function.
	 *
	 * @access public
	 * @param mixed $options
	 * @return void
	 */
	public function add_options($options) {
		$options['single_page']=array(
			'active' => '',
		);

		return $options;
	}

	public function custom_template_override($template) {
		global $post;

		$MDWWPThemeOptions=new MDWWPThemeOptions();

		// check if enabled, if not, bail //
		if (!$MDWWPThemeOptions->options['single_page']['active'])
			return $template;

		$new_template=false;
		$template_arr=explode('/',$template);
		$template_page=end($template_arr);
		//$org_template_filename=get_page_template_slug($post->ID);
		$plugin_template_folder=plugin_dir_path(__FILE__).$this->template_folder_name;
		$user_template_folder=get_stylesheet_directory().'/'.$this->template_folder_override_name;

		//if (WP_DEBUG === true)
			//echo "template: $template_page<br>";

		// check for custom user files //
		if (file_exists($user_template_folder.'/'.$template_page)) :
			$new_template=$user_template_folder.'/'.$template_page;
		elseif (file_exists($plugin_template_folder.'/'.$template_page)) :
			$new_template=$plugin_template_folder.'/'.$template_page;
		else :
			$new_template=$plugin_template_folder.'/single-page.php';
		endif;
//echo "new: $new_template<br>";
		return $new_template;
	}

	// clear the styling (bootstrap) classes //
	public function customize_mdw_theme_mobile_nav_classes($classes) {
		$MDWWPThemeOptions=new MDWWPThemeOptions();
		$bootstrap_clases_to_remove=array('hidden-sm','hidden-md','hidden-lg');

		// check if enabled, if not, bail //
		if (!$MDWWPThemeOptions->options['single_page']['active'])
			return $classes;

		// remove classes we dont like (from array) //
		foreach ($classes as $key => $class) :
			if (in_array($class,$bootstrap_clases_to_remove))
				unset($classes[$key]);
		endforeach;

		return $classes;
	}

}

$MDWThemeSinglePage = new MDWThemeSinglePage();
?>