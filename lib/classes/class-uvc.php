<?php

class UVC_Viral_Theme_Functions {
	function __construct(){
		add_action('init', array(&$this,'dereg_bootstrap'));
		add_action('apevo_hook_before_content_box', array(&$this,'uvc_header_ad_468x60'));
		add_action('apevo_hook_before_headline', array(&$this,'uvc_feature_top_bar'));
		add_action('apevo_hook_before_headline', array(&$this,'apevo_feature_bar_post_tag'));
		add_action('apevo_hook_before_headline', array(&$this,'uvc_featured_post'));
		add_action('apevo_hook_post_box_bottom', array(&$this,'feature_post_related_by_tags'));
		add_action('apevo_hook_post_box_bottom', array(&$this,'apevo_trending_topics'));
		add_action('apevo_hook_after_teaser_text', array(&$this,'teaser_post_related_by_tags'));
		add_filter( 'get_the_terms', array(&$this,'set_the_terms_in_order') , 10, 4 );
		add_action( 'init', array(&$this,'do_the_terms_in_order') );	
	}

	function dereg_bootstrap(){
		wp_deregister_style( $handle='vsc-bootstrap-frontend-style' );
		wp_dequeue_style( $handle='vsc-bootstrap-frontend-style' );
	}

	function uvc_header_ad_468x60(){
		if ( get_apt_option('display_header_ad') != "Yes" || ! get_apt_option('header_ad_code') ) return false;
		$str = '<div class="uvc_header_ad468x60">';
			$str .= stripslashes(get_apt_option('header_ad_code'));
		$str .= '</div>';
		echo $str;
	}

	function uvc_feature_branding(){

	}

	function uvc_feature_top_bar(){
		$branding_text = get_apt_option('site_branding_text') ? get_apt_option('site_branding_text') : get_bloginfo( 'name' );
		?>
			<div class="uvc_feature_top_bar">
				<h2><a href="<?php bloginfo( 'siteurl' )?>"><?php echo stripslashes($branding_text); ?></a></h2>
			</div>
		<?php
	}

	function uvc_featured_post(){
		global $vsc, $wp_query;
		$option = $vsc['settings']['id'][1]['option'];
		$video_source = get_custom_field('vsource_vsc_video_source');
		if ( !$video_source ) return;
		if ( $video_source == 'youtube' ){
			$height = "343"; $width = "610";
			if ( $option['uvc_theme_override_feature_video_size_with_custom'] == 1 ){
				if ( get_custom_field('vsc_create_post_youtube_cwidth') && get_custom_field('vsc_create_post_youtube_cheight') ) {
					$height = get_custom_field('vsc_create_post_youtube_cheight');
					$width = get_custom_field('vsc_create_post_youtube_cwidth');
				}elseif( get_custom_field('vsc_create_post_youtube_size') ){
					$dim = explode('x', get_custom_field('vsc_create_post_youtube_size'));
					$width = $dim[0]; $height = $dim[1];
				}
			}
			$video_id = get_custom_field('vsource_id');
			$autoplay = get_custom_field('vsc_create_post_youtube_autoplay') == 1 ? '&amp;autoplay=1' : '&amp;autoplay=0';
			if ( $option['global_autoplay'] == 1 && $wp_query->is_single ) $autoplay = '&amp;autoplay=1';
			$controls = get_custom_field('vsc_create_post_youtube_hidecontrols') == 1 ? '&amp;controls=0' : '&amp;controls=1';
			$video = '<center>';
			$video .= "<iframe class='uvc_feature_video_youtube' width='$width' height='$height' src='http://www.youtube.com/embed/$video_id?rel=0$autoplay$controls' frameborder='0' allowfullscreen></iframe>";
			$video .= '</center>';	
		}elseif($video_source == 'self'){
			$height = "343"; $width = "610";
			if ( $option['uvc_theme_override_feature_video_size_with_custom'] == 1 ){
				if ( get_custom_field('vsc_create_post_jw_cwidth') && get_custom_field('vsc_create_post_jw_cheight') ) {
					$height = get_custom_field('vsc_create_post_jw_cheight');
					$width = get_custom_field('vsc_create_post_jw_cwidth');
				}elseif( get_custom_field('vsc_create_post_jw_size') ){
					$dim = explode('x', get_custom_field('vsc_create_post_jw_size'));
					$width = $dim[0]; $height = $dim[1];
				}
			}
			$playerID = substr(number_format(time() * rand(),0,'',''),0,5);
			$thumb_url = get_custom_field('selected_thumbnails') ? get_custom_field('selected_thumbnails') : get_custom_field('vsource_video_thumb_url');
			// $thumb_url = get_custom_field('vsource_video_thumb_url') ? get_custom_field('vsource_video_thumb_url') : '';
			if ( ! get_custom_field('vsource_video_file_url') ) return;
			$video_url = get_custom_field('vsource_video_file_url');
			$autoplay = get_custom_field('vsc_create_post_jw_autoplay') ? 'true' : 'false';
			if ( $option['global_autoplay'] == 1 && $wp_query->is_single ) $autoplay = true;
			$controls = get_custom_field('vsc_create_post_jw_hidecontrols') ? 'false' : 'true';
			$html = "<center><div stye='width:$width;margin:10px auto;' id='jwplayer_$playerID'><center>Loading the player...</center></div></center>";
	 		$js = '<script type="text/javascript">';
	 			$js .= "jwplayer('jwplayer_$playerID').setup({";
	 				$js .= 'file: "'.$video_url.'",';
	 				$js .= "height: $height,";
	 				$js .= 'image: "'.$thumb_url.'",';
	 				$js .= "width: $width,";
	 				$js .= "controls: $controls,";
	 				$js .= "autostart: $autoplay,";
	 				$js .= "stretching: 'exactfit'";
	 			$js .= " });";
	 		$js .= '</script>';
	 		$video = $html.$js;
		}
		echo $video;
	}

	function apevo_feature_bar_post_tag() {
		global $apevo_design;

		if ((is_single() && $apevo_design['tags']['single']['show'] != 'No') || (!is_single() && $apevo_design['tags']['index']['show'] != 'No')) {
			$post_tags = get_the_tags();

			if ($post_tags) {
				echo "\t\t\t\t\t<p class=\"feature_bar_post_tag\"><span class=\"post_tags\">\n";
				$num_tags = count($post_tags);
				$tag_count = 1;

				if ($apevo_design['tags']['nofollow'] == 'No')
					$nofollow = ' nofollow';

				foreach ($post_tags as $tag) {	
					if ($tag_count>1) break;		
					$html_before = "\t\t\t\t\t\t<a title=\"".$tag->name."\" href=\"" . get_tag_link($tag->term_id) . "\" rel=\"tag$nofollow\">";
					$html_after = '</a>';
					
					if ($tag_count < $num_tags)
						$sep = " \n";
					elseif ($tag_count == $num_tags)
						$sep = "\n";
					
					echo $html_before . $tag->name . $html_after . $sep;
					$tag_count++;
				}
				
				echo "\t\t\t\t\t</span></p>\n";
			}
		}
	}

	function apevo_trending_topics(){
		global $wp_query;
		if ( ! $wp_query->is_home && ! $wp_query->is_single ) return;
		$found_tags = $final_tags = $id_records = array();
		// get last 10 posts
		$last_posts = get_posts('numberposts=10');
		// gather tags
		foreach($last_posts as $post)
		  $found_tags = array_merge($found_tags, wp_get_post_tags($post->ID));
		// prepare final tags for the cloud
		foreach($found_tags as $tag){
		  // ignore duplicates
		  if(in_array($tag->term_id, $id_records))
		    continue;
		  // track ids...
		  $id_records[] = $tag->term_id;
		  // generate links
		  $tag->link = get_tag_link($tag);
		  // keep it
		  $final_tags[] = $tag;
		}
		$tag_count = count($final_tags);
		$split_col = ceil($tag_count/4);
		$split_col = $split_col > 5 ? 5 : $split_col;
		echo "<div id='trending_topics'>";
			echo "<h3><span class='title'>".__('Trending Right Now','apevo')."</span></h3>";
			echo "<div class='trending_topics_column'><ul>";
			$count_tags = 0;
			foreach ( $final_tags as $tag ) {
				$count_tags++;
				if ( $count_tags > 20 ) break;
				$elipsis = 	strlen($tag->name) >= 19  ? '...' : '';
				$html_before = "\t\t\t\t\t\t<li><a title=\"".$tag->name."\" href=\"" . get_tag_link($tag->term_id) . "\" rel=\"tag$nofollow\">";
				$html_after = $elipsis.'</a></li>';
				echo $html_before . substr($tag->name, 0, 19) . $html_after;
				// echo "<li>".substr($tag->name, 0, 20)."</li>";
				if ( $count_tags %$split_col == 0 )
				echo "</ul></div><div class='trending_topics_column'><ul>";
			}
			echo "</div>";
		echo "<div style='display:block;width:100%;height:2px;clear:both;'></div>";
		echo "</div>";
	}

	function set_the_terms_in_order ( $terms, $id, $taxonomy ) {
		$terms = wp_cache_get( $id, "{$taxonomy}_relationships_sorted" );
		if ( false === $terms ) {
		$terms = wp_get_object_terms( $id, $taxonomy, array( 'orderby' => 'term_order' ) );
		wp_cache_add($id, $terms, $taxonomy . '_relationships_sorted');
		}
		return $terms;
	}

	function do_the_terms_in_order () {
		global $wp_taxonomies;
		// the following relates to tags, but you can add more lines like this for any taxonomy
		$wp_taxonomies['post_tag']->sort = true;
		$wp_taxonomies['post_tag']->args = array( 'orderby' => 'term_order' );
	}

	function feature_post_related_by_tags(){
		global $wp_query, $post;
		if ( ! $wp_query->is_home & ! $wp_query->is_single ) return;
		$related_text = get_apt_option('related_stories_text') ? get_apt_option('related_stories_text') : 'Related Stories';
		if( has_tag() ) { ?>				
			<?php
			//for use in the loop, list 3 post titles first tag on current post
			$backup = $post;  // backup the current object
			$tags = wp_get_post_tags($post->ID);
			$tagIDs = array();
			if ($tags) {
				$tagcount = count($tags);
				for ($i = 0; $i < $tagcount; $i++) $tagIDs[$i] = $tags[$i]->term_id;
				
				$args=array('tag__in' => $tagIDs, 'post__not_in' => array($post->ID), 'showposts'=>3, 'ignore_sticky_posts'=>1);
				$my_query = new WP_Query($args);

				if( $my_query->have_posts() ) {
					?>
					<div class="feature-related-posts">
						<span class="related-heading"><?php _e(stripslashes($related_text),'apevo'); ?></span>
						<ul>
						<?php
						while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<li>
								<article><?php echo apevo_thumbnail(50,100,$link=1,$nofollow=1,true); ?><h5><span class='text'><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></span></h5></article>
							</li>
						<?php endwhile; ?>
						</ul>
					</div>
				<?php 
				} 
			}
			$post = $backup;  // copy it back
			wp_reset_query(); // to use the original query again
		} 

	}

	function teaser_post_related_by_tags(){
		global $wp_query, $post;
		if ( ! $wp_query->is_home ) return;
		$related_text = get_apt_option('related_stories_text') ? get_apt_option('related_stories_text') : 'Related Stories';
		if( has_tag() ) { ?>				
			<?php
			//for use in the loop, list 3 post titles first tag on current post
			$backup = $post;  // backup the current object
			$tags = wp_get_post_tags($post->ID);
			$tagIDs = array();
			if ($tags) {
				$tagcount = count($tags);
				for ($i = 0; $i < $tagcount; $i++) $tagIDs[$i] = $tags[$i]->term_id;
				
				$args=array('tag__in' => $tagIDs, 'post__not_in' => array($post->ID), 'showposts'=>3, 'ignore_sticky_posts'=>1);
				$my_query = new WP_Query($args);

				if( $my_query->have_posts() ) {
					?>
					<div class="feature-related-posts">
						<span class="related-heading"><?php _e(stripslashes($related_text),'apevo'); ?></span>
						<ul>
						<?php
						while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<li>
								<article><?php echo apevo_thumbnail(35,75,$link=1,$nofollow=1,true,'teaser-related-thumb'); ?><h5><span class='teaser_text'><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></span></h5></article>
							</li>
						<?php endwhile; ?>
						</ul>
					</div>
				<?php 
				} 
			}
			$post = $backup;  // copy it back
			wp_reset_query(); // to use the original query again
		} 

	}

	function feature_post_related_by_tags_original(){
		global $wp_query, $post;
		if ( ! $wp_query->is_home ) return;
		echo $post->ID;
		?>
			<div class="feature-related-posts">
			<ul>
			<?php if( has_tag() ) { ?>
			<?php
			//for use in the loop, list 3 post titles first tag on current post
			$backup = $post;  // backup the current object
			$tags = wp_get_post_tags($post->ID);
			$tagIDs = array();
			if ($tags) {
				$tagcount = count($tags);
				for ($i = 0; $i < $tagcount; $i++) $tagIDs[$i] = $tags[$i]->term_id;
				
				$args=array('tag__in' => $tagIDs, 'post__not_in' => array($post->ID), 'showposts'=>3, 'ignore_sticky_posts'=>1);
				$my_query = new WP_Query($args);

				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<li><article>
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">
						<?php 
						if (has_post_thumbnail()) {
							the_post_thumbnail('relatedpost-thumb', array('class' => 'omc-image-resize'));
						} else {
							echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" alt="no image" />');
						} 
						?>
						</a>
						<h5><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h5>
						</article></li>
					<?php endwhile; ?>
				<?php 
				} else { ?>
					<h4><?php _e('No related posts found!', 'apevo'); ?></h4>
				<?php }
			}

			$post = $backup;  // copy it back
			wp_reset_query(); // to use the original query again
			//Else if the post has no tags...
			} else { 
				$tmp_post = $post;
				$args = array( 'numberposts' => 3 );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) : setup_postdata($post); 
			?>
				<li><article>
					<a href="<?php the_permalink();?>" title="<?php the_title();?>">
						<?php 
						if (has_post_thumbnail()) {
							the_post_thumbnail('relatedpost-thumb', array('class' => 'omc-image-resize'));
						} else {
							echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" alt="no image" />');
						} 
						?>
					</a>
					<h5><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h5>
				</article></li>
			<?php 
				endforeach; 
				$post = $tmp_post; 
			} ?>
			</ul>
			</div>
		<?php
	}

}
$uvc_viral = new UVC_Viral_Theme_Functions();
?>