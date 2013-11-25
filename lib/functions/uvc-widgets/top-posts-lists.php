<?php
class UVC_Top_Posts_List_Widget extends WP_Widget {

	public function __construct() {
		// widget actual processes
		parent::__construct(
	 		'uvc_tpl_widget', // Base ID
			'UVC Top Stories List', // Name
			array( 'description' => __( 'Display a list of most recent in category named "Top Posts".', 'apevo' ), ) // Args
		);
	}

 	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Top Stories', 'text_domain' );
		$top_stories_category_name = isset( $instance[ 'top_stories_category_name' ] ) ? $instance[ 'top_stories_category_name' ] : __( 'Top Stories', 'text_domain' );
		$number_posts = isset( $instance[ 'number_posts' ] ) ? $instance[ 'number_posts' ] : 10;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'top_stories_category_name' ); ?>"><?php _e( 'Top Stories Category Name:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'top_stories_category_name' ); ?>" name="<?php echo $this->get_field_name( 'top_stories_category_name' ); ?>" type="text" value="<?php echo esc_attr( $top_stories_category_name ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php _e( 'Number of Posts to Display:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo esc_attr( $number_posts ); ?>" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['top_stories_category_name'] = strip_tags( trim($new_instance['top_stories_category_name']) );
		$instance['number_posts'] = strip_tags( trim($new_instance['number_posts']) );

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$category = apply_filters( 'top_stories_category_name', $instance['top_stories_category_name'] );
		$numberposts = apply_filters( 'number_posts', $instance['number_posts'] );
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		$this->generate_list($category,$numberposts);

		echo $after_widget;
	}

	private function generate_list ( $category='Top Stories', $numberposts = 10 ){
		global $wpdb;
		$tc_id = $wpdb->get_var("SELECT term_ID FROM $wpdb->terms WHERE name='$category'");
		$args = array(
				'post_type' => 'post',
				'cat'		=> $tc_id,
				'showposts' => $numberposts,
			);
		$top_posts = new WP_Query( $args );
		if( $top_posts->have_posts() ) {
			?>
			<ul>
			<?php
			while ($top_posts->have_posts()) : $top_posts->the_post();
			// $post_tags = get_the_tags();
			// print_r($post_tags);
			?>
				<li class="post-<?php echo the_id(); ?>">
					<?php echo apevo_thumbnail(70,100,$link=1,$nofollow=1,true,'sidebar-thumb'); ?>	
					<img class="video-thumb-overlay" src="<?php echo get_bloginfo('template_url'); ?>/lib/images/play-button.png" />				
					<?php
						$post_tags = get_the_tags();
						if ($post_tags) {
							$tag_count = 1;
							foreach ($post_tags as $tag) {	
								if ($tag_count>1) break;		
								$html_before = "\t\t\t\t\t\t<span class=\"post_tags\"><a title=\"".$tag->name."\" href=\"" . get_tag_link($tag->term_id) . "\" rel=\"tag$nofollow\">";
								$html_after = '</a></span>';
								
								if ($tag_count < $num_tags)
									$sep = " \n";
								elseif ($tag_count == $num_tags)
									$sep = "\n";
								
								echo $html_before . $tag->name . $html_after . $sep;
								$tag_count++;
							}
						}						
					?>
					<h4><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h4>
					<div style="width:100%;height:4px;float:left;clear:both;display:block;"></div>
				</li>

			<?php endwhile; ?>
			</ul>
		<?php	
		} else{
			echo "<ul><li>There are no top post to display here yet!</li></ul>";
		}
	}

}
// $uvc_vpl = new UVC_Top_Posts_List_Widget();
// add_action( 'widgets_init', create_function( '', 'register_widget( "uvc_vpl_widget" );' ) );
register_widget( 'UVC_Top_Posts_List_Widget' );