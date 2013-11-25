<?php


// Create shortcode '[postwidget]' for in-content widget
function inner_post_widget($atts) {
    ob_start(); 
    
    inner_post_widget_area();
    $output_string = ob_get_contents(); 
    ob_end_clean(); 
    return $output_string;
}
add_shortcode('postwidget', 'inner_post_widget');

function inner_post_widget_area() {
	global $wp_query;
	if ( is_active_sidebar( 'inner-post-widget-area' ) && ($wp_query->is_single || $wp_query->is_page) ) {
		echo "\t\t\t<div id=\"inner_post_area\" class=\"inner_post_area\">\n";
		echo "\t\t\t\t<ul class=\"widgets_list inner_post_area_list\">\n";
			dynamic_sidebar( 'inner-post-widget-area' );
		echo "\t\t\t\t</ul>\n";
		//echo "\t\t\t<div class=\"widget_content_clear\">\n";echo "\t\t\t</div>\n";
		echo "\t\t\t</div>\n";
	}
}

// Create shortcode '[addvideo]' for in-content video posting
function con_video($atts) {
    ob_start(); 
    if (function_exists('display_indexvideo')) { display_indexvideo(); }  
    //function printvideotexts() { echo 'this is a video'; }
    //printvideotexts();
    $output_string = ob_get_contents(); 
    ob_end_clean(); 
    return $output_string;
}
add_shortcode('addvideo', 'con_video');

// Create shortcode '[addfeed]' for in-content feed display
function con_feed($atts) {
ob_start(); 
smc_feed_display(); 
$output_string = ob_get_contents(); 
ob_end_clean(); 
return $output_string;
}
add_shortcode('addfeed', 'con_feed');

// Create shortcode '[addname]' for in-content feed display
function con_name($atts) {
ob_start(); 
get_custom_field('pro-name', true);
$output_string = ob_get_contents(); 
ob_end_clean(); 
return $output_string;
}
add_shortcode('addname', 'con_name');

# Content Excerpts
function widget_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    // BUG FIX: changed 'the_content' to 'get_the_content' to show unformatted content, and avoid auto-placed feature post videos
    // from being displayed inside excerpts.\
    // Udate: Also fixes bug causing display of full text instead of limited excerpts when previewing a post.
    $content = apply_filters('get_the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = str_replace('[addvideo]', '', $content);
	$content = preg_replace('/\[.*?\]/','',$content);  //Fixed Bug: Raw Shortcode Displaying in Excerpts
    $content = strip_tags($content);

   if ($max_char == 0) {
    echo "";
   }
   else if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo " [...]";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo " [...]";
   }
   else {
      echo "";
      echo $content;
   }
}

function apevo_meta_excerpt_length($length) {
	return (apply_filters('apevo_meta_excerpt_length', 40)); #filter
}

function apevo_get_categories($flip = false) {
	$raw_categories = &get_categories('type=post'); #wp
	if ($raw_categories) {
		foreach ($raw_categories as $category)
			$categories[$category->slug] = $category->cat_ID;
		return ($flip) ? array_flip($categories) : $categories;
	}
}

function apevo_get_tags($flip = false) {
	$raw_tags = &get_tags('taxonomy=post_tag'); #wp
	if ($raw_tags) {
		foreach ($raw_tags as $tag)
			$tags[$tag->slug] = $tag->term_id;
		return ($flip) ? array_flip($tags) : $tags;
	}
}

function apevo_get_author_data($author_id, $field = false) {
	if ($author_id) {
		$author = get_userdata($author_id); #wp
		return ($field && !empty($author->$field)) ? $author->$field : $author;
	}
}