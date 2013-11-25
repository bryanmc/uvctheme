<?php
if (function_exists('get_apt_option')) {
	$apevo_design['displayFooterWidgets'] = get_apt_option( 'display_footer_widgets' );
	$apevo_design['displayHeaderWidgets'] = get_apt_option( 'display_header_widgets' );
}


function sidebar_1_widgets(){
	if ( is_active_sidebar( 'sidebar-position-1' ) )
		dynamic_sidebar( 'sidebar-position-1' );
	else
		apevo_default_widget(1);
	if ( is_active_sidebar( 'sidebar-position-2' ) )
		dynamic_sidebar( 'sidebar-position-2' );
	if ( is_active_sidebar( 'sidebar-inner-left' ) ){
		echo "<div class=\"left\">";
			dynamic_sidebar( 'sidebar-inner-left' );
		echo "</div>";
	}
	if ( is_active_sidebar( 'sidebar-inner-right' ) ){
		echo "<div class=\"right\">";
			dynamic_sidebar( 'sidebar-inner-right' );
		echo "</div>";
	}
	if ( is_active_sidebar( 'sidebar-position-3' ) )
		dynamic_sidebar( 'sidebar-position-3' );
	if ( is_active_sidebar( 'sidebar-position-4' ) )
		dynamic_sidebar( 'sidebar-position-4' );
}

function header_widgets_area(){
global $apevo_design;
if ($apevo_design['displayHeaderWidgets'] != 'No'){
		echo "\t\t\t<div id=\"header_widget_area\" class=\"header_widget_area\">\n";
		echo "\t\t\t\t<ul class=\"widgets_list header_widget_area_list\">\n";
			header_area_widgets();
		echo "\t\t\t\t</ul>\n";
		echo "<div class=\"widget_content_clear\"></div>";
		echo "\t\t\t</div>\n";
		echo "<div class=\"widget_content_clear\"></div>";
		//1
		echo "\t\t\t<div id=\"header_widget_area1\" class=\"header_widget_area1\">\n";
		echo "\t\t\t\t<ul class=\"widgets_list header_widget_area1_list\">\n";
			header_area1_widgets();
		echo "\t\t\t\t</ul>\n";
		echo "\t\t\t</div>\n";
		//2
		echo "\t\t\t<div id=\"header_widget_area2\" class=\"header_widget_area2\">\n";
		echo "\t\t\t\t<ul class=\"widgets_list header_widget_area2_list\">\n";
			header_area2_widgets();
		echo "\t\t\t\t</ul>\n";
		echo "\t\t\t</div>\n";
		//3
		echo "\t\t\t<div id=\"header_widget_area3\" class=\"header_widget_area3\">\n";
		echo "\t\t\t\t<ul class=\"widgets_list header_widget_area3_list\">\n";
			header_area3_widgets();
		echo "\t\t\t\t</ul>\n";
		echo "\t\t\t</div>\n";
		//4
		echo "\t\t\t<div id=\"header_widget_area4\" class=\"header_widget_area4\">\n";
		echo "\t\t\t\t<ul class=\"widgets_list header_widget_area4_list\">\n";
			header_area4_widgets();
		echo "\t\t\t\t</ul>\n";
		echo "\t\t\t</div>\n";
		echo "<div class=\"widget_content_clear\"></div>";
}
}

function header_area_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'header-widget-area' ) )
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'noheader' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'header-widget-area' );
}

function header_area1_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'header-widget-area1' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'noheader' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'header-widget-area1' );
	}
}

function header_area2_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'header-widget-area2' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'noheader' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'header-widget-area2' );
	}
}

function header_area3_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'header-widget-area3' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'noheader' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'header-widget-area3' );
	}
}

function header_area4_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'header-widget-area4' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'noheader' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'header-widget-area4' );
	}
}

function top_of_post_area_widgets_area(){
	echo "\t\t\t<div id=\"top_of_post_area\" class=\"top_of_post_area\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list top_of_post_area_list\">\n";
		top_of_post_area_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";
}

function top_of_post_area_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'top-post-widget-area' ) && $wp_query->is_single )
		dynamic_sidebar( 'top-post-widget-area' );
}


function bottom_of_post_area_widgets_area(){
	echo "\t\t\t<div id=\"bottom_of_post_area\" class=\"bottom_of_post_area\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list bottom_of_post_area_list\">\n";
		bottom_of_post_area_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";
}

function bottom_of_post_area_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'bottom-post-widget-area' ) && $wp_query->is_single )
		dynamic_sidebar( 'bottom-post-widget-area' );
}

function footer_widgets_area(){
global $apevo_design;
if ($apevo_design['displayFooterWidgets'] != 'No'){
	echo "\t\t\t<div id=\"footer_widget_area\" class=\"footer_widget_area\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list footer_widget_area_list\">\n";
		footer_area_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "<div class=\"widget_content_clear\"></div>";
	echo "\t\t\t</div>\n";
	echo "<div class=\"widget_content_clear\"></div>";
	//1
	echo "\t\t\t<div id=\"footer_widget_area1\" class=\"footer_widget_area1\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list footer_widget_area1_list\">\n";
		footer_area1_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";
	//2
	echo "\t\t\t<div id=\"footer_widget_area2\" class=\"footer_widget_area2\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list footer_widget_area2_list\">\n";
		footer_area2_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";
	//3
	echo "\t\t\t<div id=\"footer_widget_area3\" class=\"footer_widget_area3\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list footer_widget_area3_list\">\n";
		footer_area3_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";
	//4
	/*echo "\t\t\t<div id=\"footer_widget_area4\" class=\"footer_widget_area4\">\n";
	echo "\t\t\t\t<ul class=\"widgets_list footer_widget_area4_list\">\n";
		footer_area4_widgets();
	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";*/
	echo "<div class=\"widget_content_clear\"></div>";
}
}

function footer_area_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'footer-widget-area' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'nofooter' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'footer-widget-area' );
	}
}

function footer_area1_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'footer-widget-area1' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'nofooter' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'footer-widget-area1' );
	}
}

function footer_area2_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'footer-widget-area2' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'nofooter' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'footer-widget-area2' );
	}
}

function footer_area3_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'footer-widget-area3' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'nofooter' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'footer-widget-area3' );
	}
}

function footer_area4_widgets(){
	global $wp_query;
	if ( is_active_sidebar( 'footer-widget-area4' ) ) {
		if ( is_single() && (get_custom_field('hide-post-widgets',false) == 'nofooter' || get_custom_field('hide-post-widgets',false) == 'noheaderfooter') )
			echo '';
		else
			dynamic_sidebar( 'footer-widget-area4' );
	}
}



function apevo_register_multiple_widgets() {
	apevo_widget_recent_entries_register();
}

function apevo_search_form() {
	$field_value = apply_filters('apevo_search_form_value', __('To search, type and hit enter', 'apevo'));
?>
<form method="get" class="search_form" action="<?php bloginfo('home'); ?>/">
	<p>
		<input class="text_input" type="text" value="<?php echo $field_value; ?>" name="s" id="s" onfocus="if (this.value == '<?php echo $field_value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $field_value; ?>';}" />
		<input type="hidden" id="searchsubmit" value="Search" />
	</p>
</form>
<?php	
}

function apevo_widget_search($args) {
	extract($args, EXTR_SKIP);
	$options = get_option('apevo_widget_search');

	echo "$before_widget\n";
	
	if ($options['apevo-search-title'])
		echo $before_title . $options['apevo-search-title'] . $after_title . "\n";
	
	apevo_search_form();
	echo "$after_widget\n";
}

function apevo_widget_search_control() {
	$options = $newoptions = get_option('apevo_widget_search');

	if ($_POST['apevo-search-options-submit'])
		$newoptions['apevo-search-title'] = strip_tags(stripslashes($_POST['apevo-search-title']));

	if ($options != $newoptions) {
		$options = $newoptions;
		update_option('apevo_widget_search', $options);
	}
	
	$title = attribute_escape($options['apevo-search-title']);
?>
		<p>
			<label for="apevo-pages-title"><?php _e('Title:', 'apevo'); ?>
			<input type="text" class="widefat" id="apevo-search-title" name="apevo-search-title" value="<?php echo $title; ?>" /></label>
			<input type="hidden" id="apevo-search-options-submit" name="apevo-search-options-submit" value="1" />
		</p>
<?php
}

function apevo_widget_subscriptions($args) {
	extract($args);
	$options = get_option('apevo_widget_subscriptions');

	if ($options['apevo-subscriptions-rss-text'] != '' || $options['apevo-subscriptions-email'] != '') {
		$list = "<ul>\n";

		if ($options['apevo-subscriptions-rss-text'] != '')
			$list .= "\t<li class=\"sub_rss\"><a href=\"" . apevo_feed_url() . '">' . $options['apevo-subscriptions-rss-text'] . "</a></li>\n";

		if ($options['apevo-subscriptions-email'] != '')
			$list .= "\t<li class=\"sub_email\">" . $options['apevo-subscriptions-email'] . "</li>\n";

		$list .= "</ul>\n";
	}

	echo "$before_widget\n";
	echo $before_title . $options['apevo-subscriptions-title'] . $after_title . "\n";

	if ($options['apevo-subscriptions-description'])
		echo '<p>' . $options['apevo-subscriptions-description'] . "</p>\n";

	echo "$list$after_widget\n";
}

function apevo_widget_subscriptions_control() {
	$options = $newoptions = get_option('apevo_widget_subscriptions');

	if ($_POST['apevo-subscriptions-submit']) {
		$newoptions['apevo-subscriptions-title'] = strip_tags(stripslashes($_POST['apevo-subscriptions-title']));
		$newoptions['apevo-subscriptions-description'] = stripslashes($_POST['apevo-subscriptions-description']);
		$newoptions['apevo-subscriptions-rss-text'] = stripslashes($_POST['apevo-subscriptions-rss-text']);
		$newoptions['apevo-subscriptions-email'] = stripslashes($_POST['apevo-subscriptions-email']);
	}

	if ($options != $newoptions) {
		$options = $newoptions;
		update_option('apevo_widget_subscriptions', $options);
	}

	$title = attribute_escape($options['apevo-subscriptions-title']);
	$description = attribute_escape($options['apevo-subscriptions-description']);
	$rss_text = attribute_escape($options['apevo-subscriptions-rss-text']);
	$email = attribute_escape($options['apevo-subscriptions-email']);
?>
		<p>
			<label for="apevo-subscriptions-title"><?php _e('Title:', 'apevo'); ?>
			<input type="text" class="widefat" id="apevo-subscriptions-title" name="apevo-subscriptions-title" value="<?php echo $title; ?>" /></label>
		</p>
		<p>
			<label for="apevo-subscriptions-description"><?php _e('Describe your subscription options:', 'apevo'); ?></label>
			<textarea class="widefat" rows="8" cols="10" id="apevo-subscriptions-description" name="apevo-subscriptions-description"><?php echo $description; ?></textarea>
		</p>
		<p>
			<label for="apevo-subscriptions-rss-text"><?php _e('<acronym title="Really Simple Syndication">RSS</acronym> link text:', 'apevo'); ?>
			<input type="text" class="widefat" id="apevo-subscriptions-rss-text" name="apevo-subscriptions-rss-text" value="<?php echo $rss_text; ?>" /></label>
		</p>
		<p>
			<label for="apevo-subscriptions-email"><?php _e('Email link and text:', 'apevo'); ?></label>
			<textarea class="widefat" rows="8" cols="10" id="apevo-subscriptions-email" name="apevo-subscriptions-email"><?php echo $email; ?></textarea>
			<input type="hidden" id="apevo-subscriptions-submit" name="apevo-subscriptions-submit" value="1" />
		</p>
<?php
}

function apevo_widget_google_cse($args) {
	extract($args, EXTR_SKIP);
	$options = get_option('apevo_widget_google_cse');

	echo "$before_widget\n";

	if ($options['apevo-google-cse-title'])
		echo $before_title . $options['apevo-google-cse-title'] . $after_title . "\n";

	echo stripslashes($options['apevo-google-cse-code']) . "\n";
	echo "$after_widget\n";
}

function apevo_widget_google_cse_control() {
	$options = $newoptions = get_option('apevo_widget_google_cse');

	if ($_POST['apevo-google-cse-submit']) {
		$newoptions['apevo-google-cse-title'] = strip_tags(stripslashes($_POST['apevo-google-cse-title']));
		$newoptions['apevo-google-cse-code'] = $_POST['apevo-google-cse-code'];
	}

	if ($options != $newoptions) {
		$options = $newoptions;
		update_option('apevo_widget_google_cse', $options);
	}

	$title = attribute_escape($options['apevo-google-cse-title']);
	$code = stripslashes($options['apevo-google-cse-code']);
?>
		<p>
			<label for="apevo-google-cse-title"><?php _e('Title:', 'apevo'); ?>
			<input type="text" class="widefat" id="apevo-google-cse-title" name="apevo-google-cse-title" value="<?php echo $title; ?>" /></label>
		</p>
		<p>
			<label for="apevo-google-cse-code"><?php _e('Google Custom Search code:', 'apevo'); ?></label>
			<textarea class="widefat" rows="8" cols="10" id="apevo-google-cse-code" name="apevo-google-cse-code"><?php echo $code; ?></textarea>
			<input type="hidden" id="apevo-google-cse-submit" name="apevo-google-cse-submit" value="1" />
		</p>
<?php
}

function apevo_widget_recent_entries($args, $widget_args = 1) {
	extract($args, EXTR_SKIP);

	if (is_numeric($widget_args))
		$widget_args = array('number' => $widget_args);

	$widget_args = wp_parse_args($widget_args, array('number' => -1));
	extract($widget_args, EXTR_SKIP);

	$options = get_option('widget_killer_recent_entries');

	if (!isset($options[$number]))
		return;

	if ($options[$number]['category'] != 'all') {
		$category = 'category_name=' . $options[$number]['category'];

		if ($options[$number]['title'] == '') {
			$categories = &get_categories('type=post&orderby=name&hide_empty=0');

			if ($categories) {
				foreach ($categories as $current_category) {
					if ($current_category->slug == $options[$number]['category'])
						$title = $current_category->cat_name;
				}
			}
		}
		else
			$title = $options[$number]['title'];
	}
	elseif ($options[$number]['title'] != '') {
		$category = '';
		$title = $options[$number]['title'];
	}
	else {
		$category = '';
		$title = __('Recent Posts', 'apevo');
	}

	$numposts = $options[$number]['numposts'];
	$comments = $options[$number]['comments'];

	if (is_home() && $category == '' && $options[$number]['title'] == '') {
		global $posts;
		$title = __('More', 'apevo') . " $title";
		$offset = count($posts);
	}
	else
		$offset = 0;

	// HTML output
	$custom_query = query_posts("$category&showposts=$numposts&offset=$offset");

	echo "$before_widget\n";
	echo "$before_title$title$after_title\n";
	echo "<ul>\n";

	if (is_array($custom_query)) {
		foreach ($custom_query as $queried_post) {
			if ($comments) {
				if (!comments_open($queried_post->ID))
					$show_comments = (get_comments_number($queried_post->ID) > 0) ? ' <a href="' . get_permalink($queried_post->ID) . '#comments"><span class="num_comments" title="' . apevo_num_comments(get_comments_number($queried_post->ID)) . ' ' . __('on this post', 'apevo') . '">' . get_comments_number($queried_post->ID) . '</span></a>' : '';
				else
					$show_comments = ' <a href="' . get_permalink($queried_post->ID) . '#comments"><span class="num_comments" title="' . apevo_num_comments(get_comments_number($queried_post->ID)) . ' ' . __('on this post', 'apevo') . '">' . get_comments_number($queried_post->ID) . '</span></a>';
			}
			else
				$show_comments = '';

			echo "\t<li><a href=\"" . get_permalink($queried_post->ID) . '" title="' . __('Click to read', 'apevo') . ' ' . get_the_title($queried_post->ID) . '" rel="bookmark">' . get_the_title($queried_post->ID) . "</a>$show_comments</li>\n";
		}
	}
	
	echo "</ul>\n";
	echo "$after_widget\n";

	unset($custom_query);
	wp_reset_query();
}

function apevo_widget_recent_entries_control($widget_args) {
	global $wp_registered_widgets;
	static $updated = false;

	if (is_numeric($widget_args))
		$widget_args = array('number' => $widget_args);
	
	$widget_args = wp_parse_args($widget_args, array('number' => -1));
	extract($widget_args, EXTR_SKIP);

	$options = get_option('widget_killer_recent_entries');
	
	if (!is_array($options))
		$options = array();

	if (!$updated && !empty($_POST['sidebar'])) {
		$sidebar = (string) $_POST['sidebar'];

		$sidebars_widgets = wp_get_sidebars_widgets();
		
		if (isset($sidebars_widgets[$sidebar]))
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach ((array) $this_sidebar as $_widget_id) {
			if ('apevo_widget_recent_entries' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number'])) {
				$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
				
				if (!in_array("widget_killer_recent_entries-$widget_number", $_POST['widget-id'])) // the widget has been removed.
					unset($options[$widget_number]);
			}
		}

		foreach ((array) $_POST['widget-killer-recent-entries'] as $widget_number => $widget_recent_entries) {				
			$category = $widget_recent_entries['category'];
			$title = strip_tags(stripslashes($widget_recent_entries['title']));
			$numposts = $widget_recent_entries['numposts'];
			$comments = $widget_recent_entries['comments'];
			$options[$widget_number] = compact('category', 'title', 'numposts', 'comments');
		}

		update_option('widget_killer_recent_entries', $options);
		$updated = true;
	}

	if (-1 == $number) {
		$category = 'all';
		$title = '';
		$numposts = 5;
		$comments = false;
		$number = '%i%';
	} 
	else {
		$category = attribute_escape($options[$number]['category']);
		$title = format_to_edit($options[$number]['title']);
		$numposts = format_to_edit($options[$number]['numposts']);
		$comments = format_to_edit($options[$number]['comments']);
	}
?>
		<p>
			<label for="widget-killer-recent-entries-category-<?php echo $number; ?>"><?php _e('Show recent posts from this category:', 'apevo'); ?>
			<select id="widget-killer-recent-entries-category-<?php echo $number; ?>" name="widget-killer-recent-entries[<?php echo $number; ?>][category]" size="1">
				<option value="all"<?php if ($category == 'all' || $category == '') echo ' selected="selected"'; ?>><?php _e('All recent posts', 'apevo'); ?></option>
<?php
			$categories = &get_categories('type=post&orderby=name&hide_empty=0');

			if ($categories) {
				foreach ($categories as $current_category) {
					$selected = ($current_category->slug == $category) ? ' selected="selected"' : '';
					echo '<option value="' . $current_category->slug . '"' . $selected . '>' . $current_category->cat_name . "</option>\n";
				}
			}
?>
			</select></label>
		</p>
		<p>
			<label for="widget-killer-recent-entries-title-<?php echo $number; ?>"><?php _e('Title (optional, defaults to category name):', 'apevo'); ?>
			<input class="widefat" id="widget-killer-recent-entries-title-<?php echo $number; ?>" name="widget-killer-recent-entries[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" /></label>
		</p>
		<p>
			<label for="widget-killer-recent-entries-numposts-<?php echo $number; ?>"><?php _e('Number of posts to show:', 'apevo'); ?>
			<select id="widget-killer-recent-entries-numposts-<?php echo $number; ?>" name="widget-killer-recent-entries[<?php echo $number; ?>][numposts]" size="1">
<?php
			for ($i = 1; $i <= 20; $i++) {
				$selected = ($numposts == $i) ? ' selected="selected"' : '';
				echo "\t\t\t\t<option value=\"$i\"$selected>$i</option>\n";
			}
?>
			</select>
			<input type="hidden" name="widget-killer-recent-entries[<?php echo $number; ?>][submit]" value="1" />
		</p>
		<p>
			<label for="widget-killer-recent-entries-comments-<?php echo $number; ?>"><?php _e('Show number of comments?', 'apevo'); ?>
			<input type="checkbox" id="widget-killer-recent-entries-comments-<?php echo $number; ?>" name="widget-killer-recent-entries[<?php echo $number; ?>][comments]" value="1" /></label>
		</p>
<?php
}

function apevo_widget_recent_entries_register() {
	if (!$options = get_option('widget_killer_recent_entries'))
		$options = array();

	$widget_ops = array('classname' => 'widget_killer_recent_entries', 'description' => __('Show recent posts from any category or your entire site', 'apevo'));
	$control_ops = array('width' => '', 'height' => '', 'id_base' => 'widget_killer_recent_entries');
	$name = __('Killer Recent Entries', 'apevo');
	$id = false;
	
	foreach ((array) array_keys($options) as $o) {
		// Old widgets can have null values for some reason
		if (!isset($options[$o]['category']) || !isset($options[$o]['numposts']))
			continue;
		
		$id = "widget_killer_recent_entries-$o"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, 'apevo_widget_recent_entries', $widget_ops, array('number' => $o));
		wp_register_widget_control($id, $name, 'apevo_widget_recent_entries_control', $control_ops, array('number' => $o));
	}

	// If there are none, we register the widget's existance with a generic template
	if (!$id) {
		wp_register_sidebar_widget('widget_killer_recent_entries-1', $name, 'apevo_widget_recent_entries', $widget_ops, array('number' => -1));
		wp_register_widget_control('widget_killer_recent_entries-1', $name, 'apevo_widget_recent_entries_control', $control_ops, array('number' => -1));
	}
}

function apevo_widget_recent_posts($category_slug = false, $title = 'Recent Entries', $number = 5) {
	$category = ($category_slug) ? 'category_name=' . $category_slug : '';

	if (is_home() && !$category_slug) {
		global $posts;
		$title = "More $title";
		$offset = count($posts);
	}
	else
		$offset = 0;

	$custom_query = new WP_Query("$category&showposts=$number&offset=$offset");

	apevo_output_post_list($category_slug, $title, $custom_query);

	unset($custom_query);
	wp_reset_query();
}

function apevo_output_post_list($category_slug, $title, $query) {
	if ($query->have_posts()) {
?>
						<li class="widget<?php if ($category_slug) echo " widget_$category_slug"; ?>">
							<h3><?php echo $title; ?></h3>
							<ul>
<?php
		while ($query->have_posts()) :
			$query->the_post();
?>
								<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
<?php
		endwhile;
?>
							</ul>
						</li>
<?php
	}
}

function apevo_widget_tag_cloud() {
	if (function_exists('wp_tag_cloud')) {
?>
	<li class="widget tag_cloud">
		<h3>Popular Tags</h3>
<?php wp_tag_cloud('smallest=10&largest=16&number=30'); ?>

	</li>
<?php
	}
}

function apevo_default_widget($sidebar = 1) {
	global $apevo_design;

	if (!is_active_sidebar($sidebar) || $_GET['template']) {
?>
					<li class="widget">
						<div class="widget_box">
							<h3><span><?php _e('Default Widget', 'apevo'); ?></span></h3>
							<p class="remove_bottom_margin"><?php printf(__('This is Sidebar Widget Postion %1$d. There are 3 more positions in the sidebar just like this one, plus 2 that split the sidebar in half vertically.  You can edit the content that appears here and in the other widget positions by visiting your <a href="%2$s">Widgets panel</a> and adding a <em>widget</em> to this or any other of the many widget positions.', 'apevo'), $sidebar, get_bloginfo('wpurl') . '/wp-admin/widgets.php', 'http://diythemes.com/apevo/rtfm/hooks/'); ?></p>
						</div>
					</li>
<?php
	}
}

/*

function apevo_widget_class($params) {
	global $widget_num;

	// Widget class
	$class = array();
	//$class[] = 'widget';

	// Iterated class
	$widget_num++;
	//$class[] = 'widget-' . $widget_num;

	// Alt class
	if ($widget_num % 2) :
		//$class[] = 'insert-odd';
	else :
		//$class[] = 'insert-even';
	endif;
	
	//$class[] = $widget_num;

	// Join the classes in the array
	$class = join(' ', $class);
	
	

	// Interpolate the 'my_widget_class' placeholder
	$params[0]['before_widget'] = str_replace('my_widget_class', $class, $params[0]['before_widget']);
	return $params;
}

add_filter('dynamic_sidebar_params', 'apevo_widget_class');

function wdwp_widgets_init() {
	register_widget('wdwp1_google_search');
	$default_widgets = array ('right-sidebar' => array('wdwp_g_search-2') );

    if ( isset( $_GET['activated'] ) ) {
    	wdwp_defaultwidgets();
  		update_option( 'sidebars_widgets', apply_filters('wdwp_default_widgets',$default_widgets ));
  	}
}

add_action('widgets_init', 'wdwp_widgets_init');

function wdwp_defaultwidgets() {
	do_action( 'wdwp_defaultwidgets' );
}

function wdwp_init_defaultwidgets() {
	update_option( 'wdwpSearch', array( 2 => array( 'result_page' => 'search-results', 'g_pub_id' => 'partner-pub-partner-pub-xxxxxxxxxxxx:xxxxxxxxx' ), '_multiwidget' => 1 ) );
}

add_action( 'wdwp_defaultwidgets', 'wdwp_init_defaultwidgets' );
*/