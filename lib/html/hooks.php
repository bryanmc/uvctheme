<?php
/**
 * Contains all hook wrappers.
 */

function apevo_hook_before_html() {
	do_action('apevo_hook_before_html');
}

function apevo_hook_after_html() {
	do_action('apevo_hook_after_html');
}

function apevo_hook_before_header() {
	do_action('apevo_hook_before_header');
}

function apevo_hook_before_header_page_area() {
	do_action('apevo_hook_before_header_page_area');
}

function apevo_hook_after_header() {
	do_action('apevo_hook_after_header');
}

function apevo_hook_header() {
	do_action('apevo_hook_header');
}

function apevo_hook_before_primary_nav_menu() {
	do_action('apevo_hook_before_primary_nav_menu');
}

function apevo_hook_after_primary_nav_menu() {
	do_action('apevo_hook_after_primary_nav_menu');
}

function apevo_hook_before_secondary_nav_menu() {
	do_action('apevo_hook_before_secondary_nav_menu');
}

function apevo_hook_after_secondary_nav_menu() {
	do_action('apevo_hook_after_secondary_nav_menu');
}

function apevo_hook_before_title() {
	do_action('apevo_hook_before_title');
}

function apevo_hook_after_title() {
	do_action('apevo_hook_after_title');
}

function apevo_hook_first_nav_item() {
	do_action('apevo_hook_first_nav_item');
}

function apevo_hook_last_nav_item() {
	do_action('apevo_hook_last_nav_item');
}

function apevo_hook_first_secondary_nav_item() {
	do_action('apevo_hook_first_secondary_nav_item');
}

function apevo_hook_last_secondary_nav_item() {
	do_action('apevo_hook_last_secondary_nav_item');
}

function apevo_hook_before_content_box() {
	do_action('apevo_hook_before_content_box');
}

function apevo_hook_after_content_box() {
	do_action('apevo_hook_after_content_box');
}

function apevo_hook_content_box_top() {
	do_action('apevo_hook_content_box_top');
}

function apevo_hook_content_box_bottom() {
	do_action('apevo_hook_content_box_bottom');
}

function apevo_hook_before_content() {
	do_action('apevo_hook_before_content');
}

function apevo_hook_after_content() {
	do_action('apevo_hook_after_content');
}

function apevo_hook_before_content_area() {
	do_action('apevo_hook_before_content_area');
}

function apevo_hook_after_content_area() {
	do_action('apevo_hook_after_content_area');
}

function apevo_hook_feature_box() {
	do_action('apevo_hook_feature_box');
}

function apevo_hook_before_post_box($post_count = false) {
	do_action('apevo_hook_before_post_box', $post_count);
}

function apevo_hook_after_post_box($post_count = false) {
	do_action('apevo_hook_after_post_box', $post_count);
}

function apevo_hook_post_box_top($post_count = false) {
	do_action('apevo_hook_post_box_top', $post_count);
}

function apevo_hook_post_box_bottom($post_count = false) {
	do_action('apevo_hook_post_box_bottom', $post_count);
}

function apevo_hook_before_post_thumb() {
	do_action('apevo_hook_before_post_thumb');
}

function apevo_hook_after_post_thumb() {
	do_action('apevo_hook_after_post_thumb');
}

function apevo_hook_before_teaser_text($post_count = false) {
	do_action('apevo_hook_before_teaser_text', $post_count);
}

function apevo_hook_after_teaser_text($post_count = false) {
	do_action('apevo_hook_after_teaser_text', $post_count);
}

function apevo_hook_before_teasers_box($post_count = false) {
	do_action('apevo_hook_before_teasers_box', $post_count);
}

function apevo_hook_after_teasers_box($post_count = false) {
	do_action('apevo_hook_after_teasers_box', $post_count);
}

function apevo_hook_before_post($post_count = false) {
	do_action('apevo_hook_before_post', $post_count);
}

function apevo_hook_after_post($post_count = false) {
	do_action('apevo_hook_after_post', $post_count);
}

function apevo_hook_before_teaser_box($post_count = false) {
	do_action('apevo_hook_before_teaser_box', $post_count);
}

function apevo_hook_after_teaser_box($post_count = false) {
	do_action('apevo_hook_after_teaser_box', $post_count);
}

function apevo_hook_before_teaser($post_count = false) {
	do_action('apevo_hook_before_teaser', $post_count);
}

function apevo_hook_after_teaser($post_count = false) {
	do_action('apevo_hook_after_teaser', $post_count);
}

function apevo_hook_before_headline($post_count = false) {
	do_action('apevo_hook_before_headline', $post_count);
}

function apevo_hook_after_headline($post_count = false) {
	do_action('apevo_hook_after_headline', $post_count);
}

function apevo_hook_before_teaser_headline($post_count = false) {
	do_action('apevo_hook_before_teaser_headline', $post_count);
}

function apevo_hook_after_teaser_headline($post_count = false) {
	do_action('apevo_hook_after_teaser_headline', $post_count);
}

function apevo_hook_byline_item($post_count = false) {
	do_action('apevo_hook_byline_item', $post_count);
}

function apevo_hook_before_comment_meta() {
	do_action('apevo_hook_before_comment_meta');
}

function apevo_hook_after_comment_meta() {
	do_action('apevo_hook_after_comment_meta');
}

function apevo_hook_after_comment() {
	do_action('apevo_hook_after_comment');
}

function apevo_hook_after_comments() {
	do_action('apevo_hook_after_comments');
}

function apevo_hook_comment_form_top() {
	do_action('apevo_hook_comment_form_top');
}

function apevo_hook_comment_field() {
	do_action('apevo_hook_comment_field');
}

function apevo_hook_after_comment_box() {
	do_action('apevo_hook_after_comment_box');
}

function apevo_hook_comment_form_bottom() {
	do_action('apevo_hook_comment_form_bottom');
}

function apevo_hook_archives_template() {
	do_action('apevo_hook_archives_template');
}

function apevo_hook_custom_template() {
	do_action('apevo_hook_custom_template');
}

function apevo_hook_faux_admin() {
	do_action('apevo_hook_faux_admin');
}

function apevo_hook_404_title() {
	do_action('apevo_hook_404_title');
}

function apevo_hook_404_content() {
	do_action('apevo_hook_404_content');
}

function apevo_hook_before_sidebars() {
	do_action('apevo_hook_before_sidebars');
}

function apevo_hook_after_sidebars() {
	do_action('apevo_hook_after_sidebars');
}

function apevo_hook_multimedia_box() {
	do_action('apevo_hook_multimedia_box');
}

function apevo_hook_after_multimedia_box() {
	do_action('apevo_hook_after_multimedia_box');
}

function apevo_hook_before_sidebar_1() {
	do_action('apevo_hook_before_sidebar_1');
}

function apevo_hook_after_sidebar_1() {
	do_action('apevo_hook_after_sidebar_1');
}

function apevo_hook_before_sidebar_2() {
	do_action('apevo_hook_before_sidebar_2');
}

function apevo_hook_after_sidebar_2() {
	do_action('apevo_hook_after_sidebar_2');
}

function apevo_hook_before_footer() {
	do_action('apevo_hook_before_footer');
}

function apevo_hook_after_footer() {
	do_action('apevo_hook_after_footer');
}

function apevo_hook_footer() {
	do_action('apevo_hook_footer');
}