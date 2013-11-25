<?php
if (function_exists('get_apt_option')) {
  $apevo_design['removePostDates'] = get_apt_option( 'remove_post_dates' ); 
  $apevo_design['fwHeaderImage'] = get_apt_option( 'fw_header_image' );
  $apevo_design['hideHeaderMenus'] = get_apt_option( 'hide_header_menus' );
  $apevo_design['removeBlogHeader'] = get_apt_option( 'remove_blog_header' );
  $apevo_design['siteLogoType'] = get_apt_option( 'site_logo_type' );
  $apevo_design['siteLogoImage'] = get_apt_option( 'site_logo_image' );
  $apevo_design['altHeaderText'] = get_apt_option('alt_header_text');
  $apevo_design['addSiteTagline'] = get_apt_option('add_site_tagline');
  $apevo_design['disableSiteTagline'] = get_apt_option('disable_site_tagline');
  
  $apevo_design['displayHeaderAd'] = get_apt_option( 'display_header_ad' );
  $apevo_design['headerAdCode'] = get_apt_option( 'header_ad_code' );

  $apevo_design['displayHeaderWidgets'] = get_apt_option( 'display_header_widgets' );
  
  if ( $apevo_design['siteLogoType'] ) { $apevo_design['siteLogoType'] == $apevo_design['siteLogoType']; } else { $apevo_design['siteLogoType']=='Text';}
  if ( $apevo_design['siteLogoImage'] ) { $apevo_design['siteLogoImage'] == $apevo_design['siteLogoImage']; } else { $apevo_design['siteLogoImage']=='';}
  
  $apevo_design['textLogoPosition'] = get_apt_option('text_logo_position');
} 

function apevo_content_style_embed(){
	global $post, $wp_query;
	if ($wp_query->is_single && get_post_meta($post->ID,'custom-page-layout', true))
		return "style=\"width:100%;\" ";
}

function apevo_body_classes() {
	#dropped:: global $apevo_site;
	$browser = $_SERVER['HTTP_USER_AGENT'];

	// Enable custom stylesheet
	#dropped:: if ($apevo_site->custom['stylesheet'])
	#dropped:: 	$classes[] = 'custom';
	
	
	// Generate per-page classes
	if (is_page() || is_single()) {
		global $post;
		if (get_custom_field('custom-body-class',false))
			$classes [] = get_custom_field('custom-body-class',false);
		#dropped:: $custom_slug = get_post_meta($post->ID, 'apevo_slug', true);
		#dropped:: $deprecated_custom_slug = get_post_meta($post->ID, apevo_get_custom_field_key('slug'), true);
		
		if (is_page())
			$classes[] = $post->post_name;

		#dropped:: if ($custom_slug)
		#dropped:: 	$classes[] = $custom_slug;
		#dropped:: elseif ($deprecated_custom_slug)
		#dropped:: 	$classes[] = $deprecated_custom_slug;
			
	}
	elseif (is_category()) {
		global $wp_query;
		$classes[] = 'cat_' . $wp_query->query_vars['category_name'];
	}
	elseif (is_tag()) {
		global $wp_query;
		$classes[] = 'tag_' . $wp_query->query_vars['tag'];
	}
	elseif (is_author()) {
		$author = apevo_get_author_data(get_query_var('author'));
		$classes[] = $author->user_nicename;
	}
	elseif (is_day())
		$classes[] = 'daily ' . strtolower(get_the_time('M_d_Y'));
	elseif (is_month())
		$classes[] = 'monthly ' . strtolower(get_the_time('M_Y'));
	elseif (is_year())
		$classes[] = 'year_' . strtolower(get_the_time('Y'));

	$classes = apply_filters('apevo_body_classes', $classes);

	if (is_array($classes))
		$classes = implode(' ', $classes);

	if ($classes)
		return ' class="' . $classes . '"';
}

function apevo_top_title_and_tagline() {
	global $apevo_design, $wp_query;
	
	if ($apevo_design['textLogoPosition']=="Above Primary Navigation") {
		echo "\t\t<div id=\"top_position_logo\">";
		# Logo Text:
		if ($apevo_design['siteLogoType']=='Text' || $apevo_design['siteLogoType']=='') { 
			if (is_home() || is_front_page()) {
				echo "\t\t<h1 id=\"logo\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></h1>\n";
			} else {
				if (is_single && get_custom_field('hide-logo-homelink') == '1')
					echo "\t\t<p id=\"logo\">" . apevo_site_title() . "</p>\n";
				else
					echo "\t\t<p id=\"logo\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></p>\n";
			}
		# Site Tagline:
		if (!$apevo_design['disableSiteTagline'])
			echo "\t\t<p id=\"tagline\">" . apevo_site_tagline() . "</p>\n";	
		}
		
		#Header Logo Image:
		if ($apevo_design['siteLogoType'] == 'Image' && $apevo_design['fwHeaderImage'] == '') {
			if (is_home() || is_front_page()) {
				echo "\t\t<h1 class=\"hide\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></h1>\n";
			} else {
				if (is_single && get_custom_field('hide-logo-homelink') == '1')
					echo "\t\t<p class=\"hide\">" . apevo_site_title() . "</p>\n";
				elseif (get_custom_field('self-optimize-logo') == '1' && is_single())
					echo "\t\t<p class=\"hide\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></p>\n";
				else
					echo "\t\t<p class=\"hide\">" . apevo_site_title() . "</p>\n";
			}
			//echo "<a href=\"" .apevo_site_title_link() ."\"><img id=\"logo\" src=\"{$apevo_design['siteLogoImage']}\" /></a>";
			echo "<img id=\"logo\" src=\"{$apevo_design['siteLogoImage']}?0122-39322\" />";
		}
		
		echo "\t\t</div>";
		
	}//end if for positioning
	
}

function apevo_title_and_tagline() {
	global $apevo_design, $wp_query;
	
	if ($apevo_design['textLogoPosition']!="Above Primary Navigation") {
	
		# Logo Text:
		if ($apevo_design['siteLogoType']=='Text' || $apevo_design['siteLogoType']=='') { 
			if (is_home() || is_front_page()) {
				echo "\t\t<h1 id=\"logo\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></h1>\n";
			} else {
				if (is_single && get_custom_field('hide-logo-homelink') == '1')
					echo "\t\t<p id=\"logo\">" . apevo_site_title() . "</p>\n";
				else
					echo "\t\t<p id=\"logo\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></p>\n";
			}
		# Site Tagline:
		if (!$apevo_design['disableSiteTagline'])
			echo "\t\t<p id=\"tagline\">" . apevo_site_tagline() . "</p>\n";	
		}
		
		#Header Logo Image:
		if ($apevo_design['siteLogoType'] == 'Image' && $apevo_design['fwHeaderImage'] == '') {
			if (is_home() || is_front_page()) {
				echo "\t\t<h1 class=\"hide\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></h1>\n";
			} else {
				if (is_single && get_custom_field('hide-logo-homelink') == '1')
					echo "\t\t<p class=\"hide\">" . apevo_site_title() . "</p>\n";
				elseif (get_custom_field('self-optimize-logo') == '1' && is_single())
					echo "\t\t<p class=\"hide\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></p>\n";
				else
					echo "\t\t<p class=\"hide\">" . apevo_site_title() . "</p>\n";
			}
			//echo "<a href=\"" .apevo_site_title_link() ."\"><img id=\"logo\" src=\"{$apevo_design['siteLogoImage']}\" /></a>";
			echo "<img id=\"logo\" src=\"{$apevo_design['siteLogoImage']}?0122-39322\" />";
		}
	} // end if for positioning...
	
	#Header Full Width Image:
	if ($apevo_design['siteLogoType'] == 'Image' && $apevo_design['fwHeaderImage']) {
		if (is_home() || is_front_page()) {
			echo "\t\t<h1 class=\"hide\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></h1>\n";
		} else {
			if (is_single && get_custom_field('hide-logo-homelink') == '1')
				echo "\t\t<p class=\"hide\">" . apevo_site_title() . "</p>\n";
			elseif (get_custom_field('self-optimize-logo') == '1' && is_single())
				echo "\t\t<p class=\"hide\"><a href=\"" . apevo_site_title_link() . "\">" . apevo_site_title() . "</a></p>\n";
			else
				echo "\t\t<p class=\"hide\">" . apevo_site_title() . "</p>\n";
		}
		//echo "<a href=\"" .apevo_site_title_link() ."\"><img id=\"logo\" src=\"{$apevo_design['fwHeaderImage']}\" /></a>";
		echo "<img id=\"logo\" src=\"{$apevo_design['fwHeaderImage']}?0122-39322\" />";
	}
	
}

function apevo_site_title(){
	global $apevo_design;
	if (get_custom_field('custom-logo-text',false) && is_single()) {
		$output = get_custom_field('custom-logo-text',false);
	} elseif (get_custom_field('self-optimize-logo') == '1' && is_single()) {
		$output = get_custom_field('media-seo-mainkey',false);
	} elseif ($apevo_design['altHeaderText']) {
		$output = $apevo_design['altHeaderText'];
	} elseif (get_option('mc_seomainkey')){
		$output = get_option('mc_seomainkey');
	} else {
		$output = get_bloginfo('name');
	}
	return stripslashes($output);
}

function apevo_site_title_link() {
	global $post;
	if (get_custom_field('custom-logo-link',false) && is_single()) {
		$output = get_custom_field('custom-logo-link',false);
	} elseif (get_custom_field('self-optimize-logo') == '1' && is_single()) {
		$output = get_permalink($post->ID);
	} else {
		$output = get_bloginfo('url');
	}
	return $output;
}

function apevo_site_tagline() {
	global $apevo_design;
	if ($apevo_design['addSiteTagline'])
		$output = $apevo_design['addSiteTagline'];
	else
		$output = get_bloginfo('description');
	
	return stripslashes($output);
}


function apevo_ie_clear($output = true) {
	$ie_clear = "<!--[if lte IE 8]>\n<div id=\"ie_clear\"></div>\n<![endif]-->\n";
	if ($output) echo $ie_clear;
	else return $ie_clear;
}

function apevo_404_title() {
	_e('It\'s Your Move Now, Padre!', 'thesis');
}

function apevo_404_content() {
?>
<p><?php _e('You&#8217;ve reached a page that is no longer here, or never existed in the first place.  Try one of these options below:', 'thesis'); ?></p>
<ul>
	<li><?php _e('Hit the &#8220;back&#8221; button on your browser to go back where you came from', 'thesis'); ?></li>
	<li><?php printf(__('Visit the <a href="%s" rel="nofollow">home page</a>, it&#8217;s pretty awesome there, trust me.', 'thesis'), get_bloginfo('url')); ?></li>
	<li><?php _e('If there&#8217;s a search bar somewhere up there, trying searching for what you were looking for.', 'thesis'); ?></li>
</ul>
<?php	
}

