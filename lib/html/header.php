<?php
if (function_exists('get_apt_option')) {
	$apevo_design['removeBlogHeader'] = get_apt_option( 'remove_blog_header' );
	$apevo_design['headerAdCode'] = get_apt_option('header_ad_code');
	$apevo_design['siteLogoType'] = get_apt_option('site_logo_type');
}

function apevo_header_area() {
	apevo_hook_before_header();
	apevo_header();
	apevo_hook_after_header();
}

function apevo_header() {
	return false; #uvc_change
	global $apevo_design;
	if (is_single() && get_custom_field('hide-the-header') || $apevo_design['removeBlogHeader']) {}else{
		echo "\t<div id=\"header\">\n";
		apevo_hook_header();
		echo "\t</div>\n";
	}
}

function apevo_default_header() {
	apevo_hook_before_title();
	apevo_title_and_tagline();
	apevo_hook_after_title();
}

function header_ad_468x60(){
	global $apevo_design;
	$str = '<div class="ad468x60">';
		$str .= stripslashes($apevo_design['headerAdCode']);
	$str .= '</div>';
	
	if($apevo_design['displayHeaderAd']=="Yes" && $apevo_design['siteLogoType']!="Image")
		echo $str;
}