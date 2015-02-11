<?php
/**
 * Tag cloud widget class, extended version
 * Version: 1.0.0
 */
class WP_Widget_Tag_Cloud_Extended extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "A cloud of your most used tags, categories, etc.") );
		parent::__construct('tag_cloud_ext', __('Tag Cloud Extended'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$current_taxonomy=$instance['taxonomy'];
;		
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			$title = __('Tags');
		}

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="tagcloud">';

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
		wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy,
			'exclude' => 1 // exclude the Uncategorized cat
		) ) );

		echo "</div>\n";
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = $new_instance['taxonomy'];
		
		return $instance;
	}

	function form( $instance ) {
		$current_taxonomy=$instance['taxonomy'];				
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:') ?></label><br />
			<?php 
			foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;			

				if (in_array($taxonomy,$current_taxonomy)	) :
					$checked='checked="checked"';
				else :
					$checked='';
				endif;				

				echo '<input type="checkbox" name="'.$this->get_field_name('taxonomy').'[]" value="'.esc_attr($taxonomy).'" '.$checked.'>'.$tax->labels->name.'<br />';
			endforeach;
			?>
		</p>
		<?php
	}

/*
	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
*/
}

add_action('widgets_init','mdw_cms_register_widgets');
function mdw_cms_register_widgets() {
	register_widget( 'WP_Widget_Tag_Cloud_Extended' );
}
?>