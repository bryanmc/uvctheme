<?php
/* Todos:
- Author link to archive option
- Nofollow author link to archive
- Admin Edit link
*/
if (function_exists('get_apt_option')) {
  $apevo_design['byline']['author']['show'] = get_apt_option( 'byline_author_show' );
  $apevo_design['post']['show']['authorbox'] = get_apt_option( 'post_show_authorbox' );
  $apevo_design['byline']['page']['author'] = get_apt_option( 'byline_page_author' );
  $apevo_design['byline']['page']['date'] = get_apt_option( 'byline_page_date' );
  $apevo_design['comments']['disable_pages'] = get_apt_option( 'comments_disable_pages' );
  $apevo_design['byline']['num_comments']['show'] = get_apt_option( 'byline_num_comments_show' );
  $apevo_design['byline']['date']['show'] = get_apt_option( 'byline_date_show' );
  $apevo_design['categories']['show'] = get_apt_option( 'categories_show' );
  $apevo_design['tags']['single']['show'] = get_apt_option( 'tags_single_show' );
  $apevo_design['tags']['index']['show'] = get_apt_option( 'tags_index_show' );
  $apevo_design['tags']['nofollow'] = get_apt_option( 'tags_nofollow' );
  $apevo_design['display']['content']['posts'] = get_apt_option( 'display_content_posts' );
  $apevo_design['display']['content']['archives'] = get_apt_option( 'display_content_archives' );
  if (get_apt_option( 'feature_thumbnail_width' ))
   	$apevo_design['feature']['thumbnail']['width'] = get_apt_option( 'feature_thumbnail_width' );
   else	
   	$apevo_design['feature']['thumbnail']['width'] = 140;
  
  if (get_apt_option( 'display_aff_stars' ) != '') { $apevo_design['display']['affiliate']['stars'] = get_apt_option( 'display_aff_stars' ); } else { $apevo_design['display']['affiliate']['stars'] = 'Both'; }
  if (get_apt_option( 'fp_afflink_text' ) != '') { $apevo_design['affiliate']['link']['text'] = get_apt_option( 'fp_afflink_text' ); } else { $apevo_design['affiliate']['link']['text'] = 'Visit Website'; }
  if (get_apt_option( 'open_aff_links' ) == 'New Window') { $apevo_design['open']['affiliate']['links'] = get_apt_option( 'open_aff_links' ); } else { $apevo_design['open']['affiliate']['links'] = ''; }
  $apevo_design['thumbnails']['show'] = get_apt_option( 'thumbnails_show' );
  $apevo_design['thumbnails']['single']['show'] = get_apt_option( 'thumbnails_single_show' );
}

function apevo_post_box($classes = '', $post_count = false) {
	global $wp_query, $post;
	if ($wp_query->is_home)
		$posttypeclass = ' home';
	if ($wp_query->is_single)
		$posttypeclass = ' single';	
	if ($wp_query->is_archive)
		$posttypeclass = ' archive';
	#dropped:: $post_image = apevo_post_image_info('image');

	apevo_hook_before_post_box($post_count);
	echo "\t\t\t<div class=\"" . join(' ', get_post_class($classes)) . $posttypeclass ."\" id=\"post-" . get_the_ID() . "\">\n";
	apevo_hook_post_box_top($post_count);
	if (($wp_query->is_single || $wp_query->is_page) && get_post_meta($post->ID,'hide-post-title', true))
		echo '';
	else
		apevo_headline_area($post_count);
	echo "\t\t\t\t<div class=\"format_text entry-content\">\n";
	apevo_post_content($post_count);
	echo "\t\t\t\t</div>\n";
	apevo_hook_post_box_bottom($post_count);
	echo "\t\t\t<div style=\"clear:both\"></div>";
	echo "\t\t\t</div>\n\n";
	apevo_hook_after_post_box($post_count);
}

function apevo_author_box(){
	global $wp_query, $apevo_design;
	$str = "\t\t\t\t<div id=\"author_box\">\n";
	
		$str .= "\t\t\t\t\t<div id=\"author_avatar\">\n";
			$str .= get_avatar( get_the_author_meta('user_email'), '75', '' );
		$str .= "\t\t\t\t\t</div>\n";
		
		$str .= "\t\t\t\t\t<div id=\"author_content\">\n";
			$str .= "\t\t\t\t\t\t<h3>About ".get_the_author()."</h3>\n";
			$str .= "\t\t\t\t\t\t<p>";
				$str .= get_the_author_meta('description');
			$str .= "\t\t\t\t\t\t</p>";
		$str .= "\t\t\t\t\t</div>\n";
		
	$str .= "\t\t\t\t</div>\n";
	
	if ($wp_query->is_single && $apevo_design['post']['show']['authorbox']=="Yes")
		echo $str;
}

function apevo_headline_area($post_count = false/*, $post_image = false*/) {
global $post, $wp_query;
	if (apply_filters('apevo_show_headline_area', true)) {
?>
				<div class="headline_area">
<?php
	
	apevo_hook_before_headline($post_count);
	apevo_post_tags();
	/*Dropped:: if ($post_image['show'] && $post_image['y'] == 'before-headline')
		echo $post_image['output'];*/

	if (is_404()) {
		echo "\t\t\t\t\t<h1 class='entry-title'>";
		apevo_hook_404_title();
		echo "</h1>\n";
	}
	elseif (is_page()) {
	
		if (!get_post_meta($post->ID,'hide-post-title', true))
			echo (is_front_page()) ? "\t\t\t\t\t<h2 class='entry-title'>" . get_the_title() . "</h2>\n" : "\t\t\t\t\t<h1 class='entry-title'>" . get_the_title() . "</h1>\n";

		/*Dropped:: if ($post_image['show'] && $post_image['y'] == 'after-headline')
			echo $post_image['output'];*/

		apevo_hook_after_headline($post_count);
		//echo apevo_show_byline(); #testing line 95
		if (!get_post_meta($post->ID,'hide-post-title', true))
			apevo_byline();
	}
	else {
		if (is_single()) {
?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
<?php
		}
		else {
?>
					<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<?php
		}
		
		/*dropped:: if ($post_image['show'] && $post_image['y'] == 'after-headline')
			echo $post_image['output'];*/

		apevo_hook_after_headline($post_count);
		apevo_byline($post_count);
		
	}
?>
				</div>
<?php
	}
}

function apevo_show_byline() {
	global $apevo_design;

	if (is_page()) {
		if ($apevo_design['byline']['page']['author'] != 'No' || $apevo_design['byline']['page']['date'] != 'No' || ($apevo_design['byline']['num_comments']['show'] != 'No' && comments_open() && $apevo_design['comments']['disable_pages'] != 'Yes'))
			return true;			
	}
	else {
		if ($apevo_design['byline']['author']['show'] != 'No' || $apevo_design['byline']['date']['show'] != 'No' || ($apevo_design['byline']['num_comments']['show'] != 'No' && (comments_open() || get_comments_number() > 0)))
			return true;
	}
}

function apevo_byline($post_count = false) {
	global $apevo_design, $post, $wp_query;

	if (apevo_show_byline()) {
		if (is_page()) {
			if ($apevo_design['byline']['page']['author'] != 'No')
				$author = 1;
			
			if ($apevo_design['byline']['page']['date'] != 'No' && $apevo_design['byline']['date']['show'] !='No')
				$date = 1;

			if (comments_open() && $apevo_design['byline']['num_comments']['show'] != 'No')
				$show_comments = true;
		}
		else {
			if ($apevo_design['byline']['author']['show'] != 'No')
				$author = 1;
			
			if ($apevo_design['byline']['date']['show'] != 'No')
				$date = 1;
			if (get_post_meta($post->ID,'hide-post-date', true))
				$date = null;

			if ($apevo_design['byline']['num_comments']['show'] != 'No' && (comments_open() || get_comments_number() > 0))
				$show_comments = true;
		}
	}
	elseif ($apevo_design->display['admin']['edit_post'] && is_user_logged_in())
		$edit_link = true;
	elseif ($_GET['template'])
		$author = $date = true;

	if ($author || $date || $show_comments || $edit_link) {
		echo "\t\t\t\t\t<p class=\"headline_meta\">";

		if ($author)
			apevo_author();

		if ($author && $date)
			echo ' ' . __('on', 'apevo') . ' ';

		if ($date)
			echo '<abbr class="published" title="' . get_the_time('Y-m-d') . '">' . get_the_time(get_option('date_format')) . '</abbr>';
		
		if ($show_comments) {
			if ($author || $date)
				$sep = ' &middot; ';

			echo $sep . '<span><a href="' . get_permalink() . '#comments" rel="nofollow">';
			comments_number(__('0 comments', 'apevo'), __('1 comment', 'apevo'), __('% comments', 'apevo'));
			echo '</a></span>';
		}

		apevo_hook_byline_item($post_count);

		if (($author || $date || $show_comments) && $apevo_design->display['admin']['edit_post'])
			edit_post_link(__('edit', 'apevo'), '<span class="edit_post pad_left">[', ']</span>');
		elseif ($apevo_design->display['admin']['edit_post'])
			edit_post_link(__('edit', 'apevo'), '<span class="edit_post">[', ']</span>');

		echo "</p>\n";
	}
}

function apevo_author() {
	global $apevo_design, $user_ID;

	if ($apevo_design->display['byline']['author']['link']) {
		if ($apevo_design->display['byline']['author']['nofollow'])
			$nofollow = ' rel="nofollow"';

		$author = '<a href="' . get_author_posts_url(get_the_author_ID()) . '" class="url fn"' . $nofollow .'>' . get_the_author() . '</a>';
	}
	else {
		$author = get_the_author();
		$fn = ' fn';
	}

	$author = '<span class="author_meta">' .get_avatar( get_the_author_ID(), $size = '16' );
	$author .= '<a href="' . get_author_posts_url(get_the_author_ID()) . '" class="url fn"' . $nofollow .'>' . get_the_author() . '</a></span>';

	echo  "<span class=\"author vcard$fn\">$author</span>";
}

function apevo_post_categories() {
	global $apevo_design;

	if ($apevo_design['categories']['show'] != 'No')
		echo "\t\t\t\t\t<p class=\"headline_meta\">" . __('', 'apevo') . ' <span class="post_cats">' . get_the_category_list('&nbsp;') . "</span></p>\n";//add , in function param to readd commas
}

function apevo_post_tags() {
	global $apevo_design;

	if ((is_single() && $apevo_design['tags']['single']['show'] != 'No') || (!is_single() && $apevo_design['tags']['index']['show'] != 'No')) {
		$post_tags = get_the_tags();

		if ($post_tags) {
			echo "\t\t\t\t\t<p class=\"headline_meta\"><span class=\"post_tags\">\n";
			$num_tags = count($post_tags);
			$tag_count = 1;

			if ($apevo_design['tags']['nofollow'] == 'No')
				$nofollow = ' nofollow';

			foreach ($post_tags as $tag) {			
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

function apevo_post_content($post_count = false) {
	global $wp_query, $post, $apevo_design;

	apevo_hook_before_post($post_count);

	//#Dropped:: if ($post_image['show'] && $post_image['y'] == 'before-post')
		//print_r($post_image); ['output'];

	if ($wp_query->is_page && (get_post_meta($post->ID, '_wp_page_template', true) == 'archives.php'))
		apevo_hook_archives_template();
	elseif ((($wp_query->is_home || $wp_query->is_search) && $apevo_design['display']['content']['posts'] != 'Show Full Post Content') || (($wp_query->is_archive || $wp_query->is_search) && $apevo_design['display']['content']['archives'] != 'Show Full Post Content'))
		the_excerpt();		
	else
		the_content(apevo_read_more_text());

	if ($wp_query->is_single || $wp_query->is_page)
		link_pages('<p><strong>Pages:</strong> ', '</p>', 'number');

	apevo_hook_after_post($post_count);
}

function apevo_read_more_text($entities = false) {
	global $apevo_design, $apevo_data;
	$custom_read_more = strip_tags(stripslashes(get_post_meta(get_the_ID(), 'apevo_readmore', true)));
	#dropped:: $read_more = ($custom_read_more != '') ? $custom_read_more : (($apevo_design->display['posts']['read_more_text']) ? urldecode($apevo_design->display['posts']['read_more_text']) : __('[click to continue&hellip;]', 'apevo'));
	return $read_more = "Read More &raquo;";
	#dropped:: return ($entities) ? $apevo_data->o_htmlspecialchars($read_more) : $apevo_data->o_texturize($read_more);
}

function apevo_post_navigation() {
	global $wp_query;

	if ($wp_query->is_home || $wp_query->is_archive || $wp_query->is_search) {
		if ($wp_query->max_num_pages > 1) {
			$previous = apply_filters('apevo_previous', __('Previous Entries &rarr;', 'apevo'));
			$next = apply_filters('apevo_next', __('&larr; Newer Entries', 'apevo'));
			echo "\t\t\t<div class=\"prev_next\">\n";

			if ($wp_query->query_vars['paged'] <= 1) {
				echo "\t\t\t\t<p class=\"previous\">";
				next_posts_link($previous);
				echo "</p>\n";
			}
			elseif ($wp_query->query_vars['paged'] < $wp_query->max_num_pages) {
				echo "\t\t\t\t<p class=\"previous floated\">";
				next_posts_link($previous);
				echo "</p>\n";

				echo "\t\t\t\t<p class=\"next\">";
				previous_posts_link($next);
				echo "</p>\n";
			}
			elseif ($wp_query->query_vars['paged'] >= $wp_query->max_num_pages) {
				echo "\t\t\t\t<p class=\"next\">";
				previous_posts_link($next);
				echo "</p>\n";
			}
		
			echo "\t\t\t</div>\n\n";
		}
	}
}

function default_skin_previous($previous) {
	return "&larr; $previous";
}

function default_skin_next($next) {
	return "$next &rarr;";
}

function apevo_prev_next_posts() {
	return; #uvc_change
	global $apevo_design;

	if (is_single() && $apevo_design->display['posts']['nav']) {
		$previous = get_previous_post();
		$next = get_next_post();
		$previous_text = apply_filters('apevo_previous_post', __('Previous post: ', 'apevo')); #filter
		$next_text = apply_filters('apevo_next_post', __('Next post: ', 'apevo')); #filter

		if ($previous || $next) {
			echo "\t\t\t\t\t<div class=\"prev_next post_nav\">\n";

			if ($previous) {
				if ($previous && $next)
					$add_class = ' class="previous"';

				echo "\t\t\t\t\t\t<p$add_class>$previous_text";
				previous_post_link('%link', '%title');
				echo "</p>\n";
			}

			if ($next) {
				echo "\t\t\t\t\t\t<p>$next_text";
				next_post_link('%link', '%title');
				echo "</p>\n";
			}

			echo "\t\t\t\t\t</div>\n";
		}
	}
}

function apevo_archive_intro($depth = 3) {
	global $apevo_terms, $wp_query; #wp
	$tab = str_repeat("\t", $depth);
	$output = "$tab<div id=\"archive_intro\">\n";
	
	if ($wp_query->is_category || $wp_query->is_tax || $wp_query->is_tag) { #wp
		$headline = trim(wptexturize(($apevo_terms->terms[$wp_query->queried_object->taxonomy][$wp_query->queried_object->term_id]['headline']) ? stripslashes($apevo_terms->terms[$wp_query->queried_object->taxonomy][$wp_query->queried_object->term_id]['headline']) : $wp_query->queried_object->name)); #wp
		$output .= "$tab\t<h1><span>" . apply_filters('apevo_archive_intro_headline', $headline) . "</span></h1>\n"; #filter
		if ($apevo_terms->terms[$wp_query->queried_object->taxonomy][$wp_query->queried_object->term_id]['content'])
			$output .= "$tab\t<div class=\"format_text\">\n" . apply_filters('apevo_archive_intro_content', $apevo_terms->terms[$wp_query->queried_object->taxonomy][$wp_query->queried_object->term_id]['content']) . "$tab\t</div>\n"; #filter
	}
	elseif ($wp_query->is_author) #wp
		$output .= "$tab\t<h1><span>" . apply_filters('apevo_archive_intro_headline', get_author_name($wp_query->query_vars['author'])) . "</span></h1>\n"; #wp
	elseif ($wp_query->is_day) #wp
		$output .= "$tab\t<h1><span>" . apply_filters('apevo_archive_intro_headline', get_the_time('l, F j, Y')) . "</span></h1>\n"; #wp
	elseif ($wp_query->is_month) #wp
		$output .= "$tab\t<h1><span>" . apply_filters('apevo_archive_intro_headline', get_the_time('F Y')) . "</span></h1>\n"; #wp
	elseif ($wp_query->is_year) #wp
		$output .= "$tab\t<h1><span>" . apply_filters('apevo_archive_intro_headline', get_the_time('Y')) . "</span></h1>\n"; #wp
	elseif ($wp_query->is_search) #wp
		$output .= "$tab\t<h1><span>" . __('Search:', 'apevo') . ' ' . apply_filters('apevo_archive_intro_headline', esc_html($wp_query->query_vars['s'])) . "</span></h1>\n"; #wp

	$output .= "$tab</div>\n";
	
	if (function_exists('catSEOsticky')) {
		if (catSEOsticky(0)!=true) //If
			echo apply_filters('apevo_archive_intro', $output);
	}else{
		echo apply_filters('apevo_archive_intro', $output);
	}
}

/**
 * Handle [caption] and [wp_caption] shortcodes.
 *
 * This function is mostly copy pasta from WP (wp-includes/media.php),
 * but with minor alteration to play more nicely with our styling.
 *
 * The supported attributes for the shortcode are 'id', 'align', 'width', and
 * 'caption'. These are unchanged from WP's default.
 *
 * @since 2.5
 *
 * @param array $attr Attributes attributed to the shortcode.
 * @param string $content Optional. Shortcode content.
 * @return string
 */
function apevo_img_caption_shortcode($attr, $content = null) {
	// Allow this to be overriden.
	$output = apply_filters('apevo_img_caption_shortcode', '', $attr, $content);

	if ($output != '')
		return $output;

	// Get necessary attributes or use the default.
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	// Not enough information to form a caption, so just dump the image.
	if (1 > (int) $width || empty($caption))
		return $content;

	// For unique styling, create an ID.
	if ($id)
		$id = ' id="' . $id . '"';

	// Format our captioned image.
	$output = "<div$id class=\"wp-caption $align\" style=\"width: " . (int) $width . "px\">
	$content
	<p class=\"wp-caption-text\">$caption</p>\n</div>";

	// Return our result.
	return $output;
}

function apevo_feature_affiliate_links(){
	global $apevo_design;
	if ($apevo_design['display']['affiliate']['stars'] == "Affiliate Links" || $apevo_design['display']['affiliate']['stars'] == "Both"){
		if (get_custom_field('affiliate-link', false)) {
		    if ($apevo_design['open']['affiliate']['links'] == 'New Window') { $apevo_design['open']['affiliate']['links'] = '_blank'; } else { $apevo_design['open']['affiliate']['links'] == 'self'; }
			echo '<div class="affiliate_link" style="width:',$apevo_design['feature']['thumbnail']['width'],'px;"><center><p><a target="',$apevo_design['open']['affiliate']['links'],'" href="',get_custom_field('affiliate-link', true),'" rel="nofollow">',$apevo_design['affiliate']['link']['text'],'</a></p></center></div>'; 
		}
	}
}

function apevo_feature_star_rating() {
	global $apevo_design;
	if ($apevo_design['display']['affiliate']['stars'] == "Star Ratings" || $apevo_design['display']['affiliate']['stars'] == "Both" && (get_custom_field('overall-rating-rev') !='' || get_custom_field('overall-rating-pro') !='')){
		if (get_custom_field('overall-rating-rev') !='' || get_custom_field('overall-rating-pro') !='' && $apevo_design['display']['affiliate']['stars'] == "Star Ratings" || $apevo_design['display']['affiliate']['stars'] == "Both"){
        	echo '<div class="star_ratings" style="width:',$apevo_design['feature']['thumbnail']['width'],'px;">';
        	if (get_custom_field('overall-rating-rev', false)) {         		
            	echo '<center><img style="border:0;" title="" src="'; bloginfo('template_directory');
            	echo'/lib/images/icons/stars-classic/';get_custom_field('overall-rating-rev', TRUE); echo'.png?0122-39322" height="22" width="100" border="0" alt="" /></center>';}else { '';}
            if (get_custom_field('overall-rating-pro', false)) { 
            	echo '<center><img style="border:0;" title="" src="'; bloginfo('template_directory');
            	echo '/lib/images/icons/stars-classic/';get_custom_field('overall-rating-pro', TRUE); echo'.png?0122-39322" height="22" width="100" border="0" alt="" /></center>';}else { '';}
            echo '</div>';
        } 
	} 
}

function apevo_links_star_wrapper_open($div='open') {
	global $apevo_design, $wp_query;
	$div = "<div class=\"link_star_wrapper\">\n";
	
	if ($apevo_design['display']['affiliate']['stars'] == "Star Ratings" || $apevo_design['display']['affiliate']['stars'] == "Both" && (get_custom_field('overall-rating-rev') !='' || get_custom_field('overall-rating-pro') !='')){
		if (get_custom_field('overall-rating-rev') !='' || get_custom_field('overall-rating-pro') !='' && $apevo_design['display']['affiliate']['stars'] == "Star Ratings" || $apevo_design['display']['affiliate']['stars'] == "Both")
			$div .= "<p class=\"rating\">Our Rating:</p>";	
	}
	
	if ($apevo_design['display']['affiliate']['stars'] != "None")
		if ( $apevo_design['thumbnails']['show'] =='No' || ($wp_query->is_single && $apevo_design['thumbnails']['single']['show'] == 'No') || $wp_query->is_page  )
			echo $div;
}

function apevo_links_star_wrapper_close($div='close') {
	global $apevo_design, $wp_query;
	$div = "</div>";
	
	if ($apevo_design['display']['affiliate']['stars'] != "None")	
		if ( $apevo_design['thumbnails']['show'] =='No' || ($wp_query->is_single && $apevo_design['thumbnails']['single']['show'] == 'No') || $wp_query->is_page )
			echo $div;
}