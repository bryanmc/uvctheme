<?php
/*
Todos: 
- multi-level navigation	
*/
if (function_exists('get_apt_option')) {
$apevo_design['removeBlogHeader'] = get_apt_option( 'remove_blog_header' );
  $apevo_design['hideHeaderMenus'] = get_apt_option( 'hide_header_menus' );
  $apevo_design['topNavType'] = get_apt_option( 'primary_nav_type' ); 
  $apevo_design['topNavContents'] = get_apt_option( 'primary_nav_contents' ); 
  $apevo_design['disableHomeLink'] = get_apt_option('primary_nav_has_home_link');
  $apevo_design['homeLinkText'] = stripslashes(get_apt_option('primary_nav_custom_home_link_text'));
  $apevo_design['homeLinkNofollow'] = get_apt_option('primary_nav_home_link_nofollow');
  //secondary nav stuff..
  $apevo_design['bottomNavContents'] = get_apt_option( 'secondary_nav_contents' ); 
  $apevo_design['disableSecondaryHomeLink'] = get_apt_option('secondary_nav_has_home_link');
  $apevo_design['homeSecondaryLinkText'] = stripslashes(get_apt_option('secondary_nav_custom_home_link_text'));
  $apevo_design['homeSecondaryLinkNofollow'] = get_apt_option('secondary_nav_home_link_nofollow');
  //action tab stuf...
  $apevo_design['displayHeaderActionTab'] = get_apt_option( 'display_header_action_tab' ); 
  $apevo_design['headerActionTabText'] = stripslashes(get_apt_option( 'header_action_tab_text' )); 
  $apevo_design['headerActionTabLink'] = get_apt_option( 'header_action_tab_link' );
  $apevo_design['headerActionTabNoFollow'] = get_apt_option( 'header_action_tab_link_nofollow' );
}

 
function apevo_nav_menu() {
	global $apevo_design;
	if (function_exists('wp_nav_menu') && $apevo_design['topNavType'] == 'Wordpress') { #wp
		wp_nav_menu('theme_location=primary&fallback_cb=apevo_nav_default'); #wp
		echo "\n";
	}
	else
		apevo_nav_default();
}

function apevo_secondary_nav_menu() {
	global $apevo_design;
	if (function_exists('wp_nav_menu') && $apevo_design['topNavType'] == 'Wordpress') { #wp
		wp_nav_menu('theme_location=primary&fallback_cb=apevo_nav_default'); #wp
		echo "\n";
	}
	else
		apevo_nav_secondary();
}

function apevo_nav_default() {
	global $apevo_design, $wp_query; #wp
	$current['id'] = (!is_archive()) ? $wp_query->queried_object_id : false; #wp
	$home_text = ($apevo_design['homeLinkText']) ? "{$apevo_design['homeLinkText']}" : 'Home';//$apevo_data->o_texturize(apevo_home_link_text(), true);
	$home_nofollow = ($apevo_design['homeLinkNofollow']) ? ' rel="nofollow"' : '';
	
	if ($current['id'] && $wp_query->post->ancestors)
		$current['ancestors'] = $wp_query->post->ancestors;
	
	if (function_exists('wp_nav_menu')) {
      $pagesNav = wp_nav_menu( array( 'theme_location' => 'header-pages', 'echo' => false, 'container' => '', 'items_wrap' => '<ul id="primary_nav" class="%2$s">%3$s</ul>', 'fallback_cb' => '' ) );
    }
    
    if (!$pagesNav) {
    	echo "<div class=\"top\">\n";
    	apevo_hook_before_primary_nav_menu(); #hook
    	echo "<ul id=\"primary_nav\" class=\"menu\">\n";
    	#Feature: Remove Top Navigation, Global and by Post
    	if ($apevo_design['hideHeaderMenus'] == 'Both' || $apevo_design['hideHeaderMenus'] == 'Top' || is_single() && get_custom_field('hide-post-navigation') == 'notopheader' || get_custom_field('hide-post-navigation') == 'notop' && is_single() || is_single() && get_custom_field('hide-the-header') || $apevo_design['removeBlogHeader']) {}else{
	    	apevo_hook_first_nav_item(); #hook
	    	    	
	    	if (!$apevo_design['disableHomeLink'] || $_GET['template']) { #wp
			if (is_front_page()) { #wp
				$current_page = get_query_var('paged'); #wp
				$is_current = ($current_page <= 1) ? ' current' : '';
			}
			else
				$is_current = (is_home() && is_front_page()) ? ' current' : ''; #wp
	
			echo "<li class=\"tab tab-home$is_current\"><a href=\"" . get_bloginfo('url') . "/\"$home_nofollow>$home_text</a></li>\n"; #wp
			}
			
			if ($apevo_design['topNavContents'] =='Pages' || !$apevo_design['topNavContents'])
				wp_list_pages('title_li='); #wp
			
			if ($apevo_design['topNavContents'] =='Categories')
				wp_list_categories('title_li='); #wp
			
			apevo_hook_last_nav_item(); #hook
		}
		echo "</ul>\n";
		apevo_hook_after_primary_nav_menu(); #hook
		echo "</div>\n";
    } else {
    	//echo "<ul class=\"menu\">\n";
    	if ($apevo_design['hideHeaderMenus'] == 'Both' || $apevo_design['hideHeaderMenus'] == 'Top' || is_single() && get_custom_field('hide-post-navigation') == 'notopheader' || get_custom_field('hide-post-navigation') == 'notop' && is_single() || is_single() && get_custom_field('hide-the-header') || $apevo_design['removeBlogHeader']) {}else{
	    	apevo_hook_first_nav_item(); #hook
	    	echo "<div class=\"top\">\n";
	    	apevo_hook_before_primary_nav_menu(); #hook
	    	echo($pagesNav)."\n";
	    	apevo_hook_after_primary_nav_menu(); #hook
	    	echo "</div>\n";
	    	apevo_hook_last_nav_item(); #hook
			//echo "</ul>\n";
		}
    }
}

function apevo_nav_secondary() {
	global $apevo_design, $wp_query; #wp
	$current['id'] = (!is_archive()) ? $wp_query->queried_object_id : false; #wp
	$home_text = ($apevo_design['homeSecondaryLinkText']) ? "{$apevo_design['homeSecondaryLinkText']}" : 'Home';//$apevo_data->o_texturize(apevo_home_link_text(), true);
	$home_nofollow = ($apevo_design['homeSecondaryLinkNofollow']) ? ' rel="nofollow"' : '';
	
	if ($current['id'] && $wp_query->post->ancestors)
		$current['ancestors'] = $wp_query->post->ancestors;
	
	if (function_exists('wp_nav_menu')) {
      $pagesNav = wp_nav_menu( array( 'theme_location' => 'header-cats', 'echo' => false, 'container' => '', 'items_wrap' => '<ul id="secondary_nav" class="%2$s">%3$s</ul>', 'fallback_cb' => '' ) );
    }
    
    if (!$pagesNav) {
	    if ($apevo_design['hideHeaderMenus'] == 'Both' || $apevo_design['hideHeaderMenus'] == 'Bottom' || is_single() && get_custom_field('hide-post-navigation') == 'notopheader' || get_custom_field('hide-post-navigation') == 'noheader' && is_single() || is_single() && get_custom_field('hide-the-header') || $apevo_design['removeBlogHeader']) {}else{
	    	echo "<div class=\"secondary\">\n";
	    	apevo_hook_before_secondary_nav_menu(); #hook
	    	echo "<ul id=\"secondary_nav\" class=\"menu\">\n";
	    	apevo_hook_first_secondary_nav_item(); #hook
	    	
	    	if ($apevo_design['disableSecondaryHomeLink'] || $_GET['template']) { #wp
			if (is_front_page()) { #wp
				$current_page = get_query_var('paged'); #wp
				$is_current = ($current_page <= 1) ? ' current' : '';
			}
			else
				$is_current = (is_home() && is_front_page()) ? ' current' : ''; #wp
	
			echo "<li class=\"tab tab-home$is_current\"><a href=\"" . get_bloginfo('url') . "/\"$home_nofollow>$home_text</a></li>\n"; #wp
			}
			
			if ($apevo_design['bottomNavContents'] =='Pages')
				wp_list_pages('title_li='); #wp
			
			if ($apevo_design['bottomNavContents'] =='Categories' || !$apevo_design['bottomNavContents'])
				wp_list_categories('title_li='); #wp
			
			apevo_hook_last_secondary_nav_item(); #hook
			echo "</ul>\n";
			apevo_hook_after_secondary_nav_menu(); #hook
			echo "</div>\n";
	    }
    } else {
    	//echo "<ul class=\"menu\">\n";
    	if ($apevo_design['hideHeaderMenus'] == 'Both' || $apevo_design['hideHeaderMenus'] == 'Bottom' || is_single() && get_custom_field('hide-post-navigation') == 'notopheader' || get_custom_field('hide-post-navigation') == 'noheader' && is_single() || is_single() && get_custom_field('hide-the-header') || $apevo_design['removeBlogHeader']) {}else{
	    	apevo_hook_first_secondary_nav_item(); #hook
	    	echo "<div class=\"secondary\">\n";
	    	apevo_hook_before_secondary_nav_menu(); #hook
	    	echo($pagesNav)."\n";
	    	apevo_hook_after_secondary_nav_menu(); #hook
	    	echo "</div>\n";
	    	apevo_hook_last_secondary_nav_item(); #hook
			//echo "</ul>\n";
		}
    }
}


function apevo_action_tab() {
	global $apevo_design;	
	$nofollow = ($apevo_design['headerActionTabNoFollow']) ? ' rel="nofollow"' : '';
	if ($apevo_design['displayHeaderActionTab']){
		echo "<div class=\"action_tab\"><ul><li>\n";
		echo "<a $nofollow href=\"{$apevo_design['headerActionTabLink']}\">{$apevo_design['headerActionTabText']}</a>";
		echo "</li></ul></div>\n";
	}	
}