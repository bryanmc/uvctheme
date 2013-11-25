<?php
//Load Theme Options
if (function_exists('get_apt_option')) {
  $apevo_design['framework'] = get_apt_option( 'framework' );
}

function apevo_html_framework() {
	global $apevo_design;
	echo apply_filters('apevo_doctype', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">') . "\n";
?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<?php
	apevo_head::build();
	echo "<body" . apevo_body_classes() . ">\n"; #filter
	apevo_hook_before_html(); #hook
	
	if ($apevo_design['framework'] == 'Page')
		//apevo_framework_page(); 
		apevo_framework_full_width(); #placeholder til later
	elseif ($apevo_design['framework'] == 'Full Width')
		apevo_framework_full_width();		
	else
		//apevo_framework_page();
		apevo_framework_full_width(); #placeholder til later
		
	apevo_ie_clear();
	apevo_javascript::output_scripts();
	apevo_hook_after_html(); #hook
	echo "\n</body>\n</html>";
}

function apevo_framework_full_width() {
	if (apply_filters('apevo_show_header', true)) apevo_wrap_header();
	apevo_wrap_content();
	if (apply_filters('apevo_show_footer', true)) apevo_wrap_footer();
	//$theme_options = get_option('option_tree');print_r($theme_options);
	wp_footer();
}

function apevo_wrap_header() {
	return false; #uvc_change
	echo "<div id=\"header_area\" class=\"full_width\">\n";
	apevo_hook_before_header_page_area(); #hook
	echo "<div class=\"page\">\n";

	apevo_header_area();

	echo "</div>\n";
	echo "</div>\n";
}

function apevo_wrap_content() {
	apevo_hook_before_content_area(); #hook

	echo "<div id=\"content_area\" class=\"full_width\">\n";
	echo "<div class=\"page\">\n";

	apevo_content_area();

	echo "</div>\n";
	echo "</div>\n";

	apevo_hook_after_content_area(); #hook
}

function apevo_wrap_footer() {
	echo "<div id=\"footer_area\" class=\"full_width\">\n";
	echo "<div class=\"page\">\n";
	
	apevo_footer_area();
	
	echo "</div>\n";
	echo "</div>\n";
}