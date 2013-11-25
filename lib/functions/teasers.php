<?php

if (function_exists('get_apt_option')) {
   $apevo_design['body']['content']['features'] = get_apt_option( 'body_content_features' );  
   $apevo_design['display']['content']['archives'] = get_apt_option( 'display_content_archives' );
}

function apevo_is_teaser($post_count) {
	global $apevo_design;
	$features = (isset($apevo_design['body']['content']['features'])) ? $apevo_design['body']['content']['features'] : 1;
	$features = 1;

	if (is_home() && $features >= 0) {
		if ($post_count > $features)
			return true;
		else
			return ($features < get_option('posts_per_page') && get_query_var('paged') > 1) ? true : false;
	}
	elseif (is_archive() || is_search()) {
	 	if ($apevo_design['display']['content']['archives'] == 'Teasers')
			return true;
		elseif ($apevo_design['display']['content']['archives'] == 'Show Full Post Content' || $apevo_design['display']['content']['archives'] == 'Show Excerpts') {
			if ($post_count > $features)
				return true;
			else
				return ($features < get_option('posts_per_page') && get_query_var('paged') > 1) ? true : false;
		}
		else
			return false;
	}
	else
		return false;
}

function apevo_teaser($classes, $post_count = false, $right = false) {
	$classes = 'teaser';
	//$post_image = apevo_post_image_info('thumb');
	if ($right) $classes .= ' teaser_right';

	apevo_hook_before_teaser_box($post_count); #hook
?>
			<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
				<?php apevo_hook_before_teaser_text($post_count); ?>
				<?php apevo_build_teaser($post_count); ?>
				<?php apevo_hook_after_teaser_text($post_count); ?>
			</div>

<?php
	apevo_hook_after_teaser_box($post_count); #hook

	echo $close_box;
}

function apevo_build_teaser($post_count) {
	global $apevo_design;
	apevo_teaser_header_tags();
	apevo_teaser_headline($post_count);
	//echo "<p class=\"headline_meta\">";
	// apevo_byline();
	//apevo_teaser_author($post_count);
	//apevo_teaser_date($post_count);
	//echo " &middot; ";
	//apevo_teaser_comments($post_count);
	//echo "</p>";	
	apevo_teaser_excerpt($post_count);	
	// echo "<p class=\"headline_meta\"><span class=\"post_cats\">";
	// apevo_teaser_category($post_count);
	// echo "</span></p>";
	apevo_teaser_link($post_count);
	echo "<div class=\"teaser_clear\"></div>";
	
	/*if (is_array($apevo_design->teasers['options'])) {
		foreach ($apevo_design->teasers['options'] as $teaser_item => $teaser) {
			if ($teaser['show'])
				call_user_func('apevo_teaser_' . $teaser_item, $post_count, $post_image);
		}
	}*/
}

function apevo_teaser_header_tags() {
	if ( is_archive() ) return false;
	global $apevo_design;

	if ((is_single() && $apevo_design['tags']['single']['show'] != 'No') || (!is_single() && $apevo_design['tags']['index']['show'] != 'No')) {
		$post_tags = get_the_tags();

		if ($post_tags) {
			echo "\t\t\t\t\t<p class=\"teaser_tag_meta\"><span class=\"post_tags\">\n";
			$num_tags = count($post_tags);
			$tag_count = 1;

			if ($apevo_design['tags']['nofollow'] == 'No')
				$nofollow = ' nofollow';

			foreach ($post_tags as $tag) {	
				if ( $tag_count > 1 ) break;		
				$html_before = "\t\t\t\t\t\t<a href=\"" . get_tag_link($tag->term_id) . "\" rel=\"tag$nofollow\">";
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

function apevo_teaser_headline($post_count) {
	apevo_hook_before_teaser_headline($post_count); #hook

	/*dropped:: if ($post_image['show'] && $post_image['y'] == 'before-headline')
		echo $post_image['output'];*/

	echo '<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark" title="Permanent link to ' . get_the_title() . '">' . get_the_title() . "</a></h2>\n";

	/*dropped:: if ($post_image['show'] && $post_image['y'] == 'after-headline')
		echo $post_image['output'];*/

	apevo_hook_after_teaser_headline($post_count); #hook
}

function apevo_teaser_author($post_count) {
	echo '<span class="teaser_author">';
	apevo_author();
	echo "</span>\n";
}

function apevo_teaser_date($post_count) {
	global $apevo_design;
	//$date_formats = apevo_get_date_formats();
	$use_format = ($apevo_design->teasers['date']['format'] == 'custom') ? stripslashes($apevo_design->teasers['date']['custom']) : $date_formats[$apevo_design->teasers['date']['format']];
	echo '<abbr class="teaser_date published" title="' . get_the_time('Y-m-d') . '">' . get_the_time('F j, Y') . "</abbr>\n";
}

function apevo_teaser_category($post_count) {
	$categories = get_the_category();
	echo '<a class="teaser_category" href="' . get_category_link($categories[0]->cat_ID) . '">' . $categories[0]->cat_name . "</a>\n";
}

function apevo_teaser_excerpt($post_count) {
	echo "\t\t\t\t<div class=\"format_teaser entry-content\">\n";

	apevo_hook_before_teaser($post_count); #hook

	/*dropped:: if ($post_image['show'] && $post_image['y'] == 'before-post')
		echo $post_image['output'];*/

	echo "<div class=\"teaser_excerpt\">";
		the_excerpt();
	echo "</div>";
	apevo_hook_after_teaser($post_count); #hook

	echo "\t\t\t\t</div>\n";
}

function apevo_teaser_tags($post_count, $post_image) {
	apevo_post_tags();
}

function apevo_teaser_comments($post_count) {
	if (comments_open() || get_comments_number() > 0) {
		echo '<a class="teaser_comments" href="' . get_permalink() . '#comments" rel="nofollow">';
		echo comments_number(__('<span>0</span> comments', 'thesis'), __('<span>1</span> comment', 'thesis'), __('<span>%</span> comments', 'thesis'));
		echo "</a>\n";
	}
}

function apevo_teaser_link($post_count) {
	echo '<p><a class="teaser_link" href="' . get_permalink() . '" rel="nofollow">' . apevo_teaser_link_text() . "</a></p>\n";
}

function apevo_teaser_link_text($entities = false) {
	global $apevo_design, $apevo_data;
	$link_text = ($apevo_design->teasers['link_text']) ? urldecode($apevo_design->teasers['link_text']) : __('Continue Reading &rarr;', 'thesis');
	return $link_text;
	//return ($entities) ? $apevo_data->o_htmlspecialchars($link_text) : $apevo_data->o_texturize($link_text);
}

function apevo_teaser_edit() {
	edit_post_link(__('edit', 'thesis'), '<span class="edit_post">[', ']</span>');
	echo "\n";
}