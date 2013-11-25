<?php
/**
 * Display primary HTML structure for content.
 */
if (function_exists('get_apt_option')) {
	$apevo_design['numberColumns'] = get_apt_option( 'number_of_columns' );
	$apevo_design['sidebarPosition'] = get_apt_option( 'sidebar_position' );
	$apevo_design['sidebarPositionSingle'] = get_apt_option( 'sidebar_position_single' );
}

function apevo_content_area() {
	if (is_page()) {
		global $post;
		$page_template = get_post_meta($post->ID, '_wp_page_template', true);
	}

	$add_class = ($page_template == 'no_sidebars.php') ? ' class="no_sidebars"' : '';

	apevo_hook_before_content_box(); #hook
	echo "\t<div id=\"content_box\"$add_class>\n";
	apevo_hook_content_box_top(); #hook

	if ($page_template == 'no_sidebars.php')
		apevo_content_column();
	elseif ($page_template == 'custom_template.php')
		apevo_hook_custom_template(); #hook
	else
		apevo_columns();

	apevo_hook_content_box_bottom(); #hook
	echo "\t<div style=\"clear:both;\"></div>";
	echo "\t</div>\n";
	apevo_hook_after_content_box(); #hook
}

/**
 * Determine basic columnar display.
 */
function apevo_columns() {
	global $apevo_design;

	if ($apevo_design['numberColumns'] == 3 && $apevo_design->layout['order'] == 'invert' && apply_filters('apevo_show_sidebars', true)) #todo
		apevo_wrap_columns();
	else
		apevo_position_sidebar();
}

/**
 * Display first sidebar and content column for three-column layouts.
 */
function apevo_wrap_columns() {
	echo "\t\t<div id=\"column_wrap\">\n";
	apevo_content_column();
	apevo_get_sidebar();
	echo "\t\t</div>\n";
}

/**
 * Display content column and the loop.
 */
function apevo_content_column() {
	echo "\t\t<div ".apevo_content_style_embed()."id=\"content\"" . apevo_content_classes() . ">\n\n";
	apevo_hook_before_content(); #hook
	$loop = new apevo_loop();
	apevo_hook_after_content(); #hook
	echo "\t\t</div>\n\n";
}

function apevo_content_classes() {
	if (have_posts()) {
		if (!is_page())
			$classes[] = 'hfeed';

		if (is_array($classes))
			$classes = implode(' ', $classes);

		if ($classes) {
			$classes = apply_filters('apevo_content_classes', $classes);
			return " class=\"$classes\"";
		}
	}
}

function apevo_position_sidebar() {
	global $apevo_design, $wp_query;
	if (
	#Page is home or archive and main sidebar position is left...
	(
	($wp_query->is_home() || $wp_query->is_archive) && $apevo_design['sidebarPosition'] == 'Left') 
	#Page is single, main sidebar position is left and single sidebar position is not defined...
	|| (($wp_query->is_single || $wp_query->is_page) && $apevo_design['sidebarPosition'] == 'Left' && $apevo_design['sidebarPositionSingle'] == '')
	#Page is single and single sidebar position setting is left...
	|| (($wp_query->is_single || $wp_query->is_page) && $apevo_design['sidebarPositionSingle'] == 'Left')
	) {
		if (apply_filters('apevo_show_sidebars', true)) apevo_sidebars();
		apevo_content_column();
	} else {
		apevo_content_column();
		if (apply_filters('apevo_show_sidebars', true)) apevo_sidebars();
	}
}