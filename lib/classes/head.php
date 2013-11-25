<?php
/**
 * class apevo_head
 *
 * @package APEvo
 * @since 1.0
 */
$theme_options = get_option('option_tree'); 
if (function_exists('get_apt_option')) {
  $removePostDates = get_apt_option( 'remove_post_dates' ); 
  $fwHeaderImage = get_apt_option( 'fw_header_image' );
  $hideHeaderMenus = get_apt_option( 'hide_header_menus' );
  $removeBlogHeader = get_apt_option( 'remove_blog_header' );
  $siteLogoType = get_apt_option( 'site_logo_type' );
  $siteLogoImage = get_apt_option( 'site_logo_image' );
  $altHeaderText = get_apt_option('alt_header_text');
  $addSiteTagline = get_apt_option('add_site_tagline');
  
  $displayHeaderAd = get_apt_option( 'display_header_ad' );
  $headerAdCode = get_apt_option( 'header_ad_code' );

  $displayHeaderWidgets = get_apt_option( 'display_header_widgets' );
  //Cufon Integration
  $activateCufon = get_apt_option( 'activative_cufon_fonts' );
  $stcufon = get_apt_option( 'st_cufon_font');
  $stagcufon = get_apt_option( 'stag_cufon_font');
  $h1cufon = get_apt_option( 'h1_cufon_font' );
  $h2cufon = get_apt_option( 'h2_cufon_font' );
  $h3cufon = get_apt_option( 'h3_cufon_font' );
  
  $harchPostTitleFontCufon = get_apt_option('harch_post_title_font_cufon');
  $harchPostTitleFontNameCufon = get_apt_option('harch_post_title_font_name_cufon');
  $singlePostTitleFontCufon = get_apt_option('single_post_title_font_cufon');
  $singlePostTitleFontNameCufon = get_apt_option('single_post_title_font_name_cufon'); 
  $teaserPostTitleFontCufon = get_apt_option('teaser_post_title_font_cufon');
  $teaserPostTitleFontNameCufon = get_apt_option('teaser_post_title_font_name_cufon'); 
  $siteContentFontCufon = get_apt_option('site_content_font_cufon');
  $siteContentFontNameCufon = get_apt_option('site_content_font_name_cufon');  
  $logoTextFontCufon = get_apt_option('logo_text_font_cufon');
  $logoTextFontNameCufon = get_apt_option('logo_text_font_name_cufon'); 
} 

class apevo_head {
	function build() {
		$head = new apevo_head;
		$head->title();
		$head->robots();
		$head->meta();		
		$head->stylesheets();
		$head->conditional_styles();
		$head->links();
		$head->scripts();
		
		echo "<head " . apply_filters('apevo_head_profile', 'profile="http://gmpg.org/xfn/11"') . ">\n"; #filter
		echo '<meta http-equiv="Content-Type" content="' . get_bloginfo('html_type') . '; charset=' . get_bloginfo('charset') . '" />' . "\n"; #wp
		$head->output();
		wp_head(); #hook #wp
		echo "</head>\n";
		
		#$head->add_ons(); // this is bogus and will disappear once I get this all figured out
	}

	private function check_active_seo_plugins($plugin){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		switch ($plugin) {
			case 'aisop':
				if ( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
				break;				
			case 'yoast':
				if ( is_plugin_active('wordpress-seo/wp-seo.php') ) return true;
				break;
		}
		return false;
	}

	private function check_active_seo_plugin_data($meta,$type='post'){
		global $wp_query, $post;
		setup_postdata($post);
		if ( $meta == 'description' && $type == 'post' ){
			if ( $this->check_active_seo_plugins('aisop') )
				if ( get_post_meta($post->ID, '_aioseop_description',true ) ) return true;
			if ( $this->check_active_seo_plugins('yoast') )
				if ( wpseo_get_value( 'metadesc', $post->ID ) ) return true;
		}
		return false;
	}
	
	function title() {
		global $wp_query;
		//If Yoast...
		if ( $this->check_active_seo_plugins('yoast') ){
			$output = trim(wp_title('',false));
			$title['title'] = "<title>" . apply_filters('apevo_title', $output) . "</title>";
			$this->title = $title;
			return;
		}
		//If AISOP or Nothing...
		if ( $wp_query->is_home || is_front_page() )
			$output = trim(get_bloginfo( 'title' ));
		else
			$output = trim(wp_title('',false));
		$title['title'] = "<title>" . apply_filters('apevo_title', $output) . "</title>"; #filter
		if ($output)
			$this->title = $title;
	}
	
	function robots() {
		if (is_category())
			if (get_option('apseo-noindex-cats') == 1) $robots = '<meta name="robots" content="noindex,follow">\n';
		if (is_tag())
			if (get_option('apseo-noindex-tags') == 1) $robots = '<meta name="robots" content="noindex,follow">\n';
		if (is_month())
			if (get_option('apseo-noindex-archives') == 1) $robots = '<meta name="robots" content="noindex,follow">\n';
		
		if ($title)
			$this->robots = $robots;
	}

	function meta() {
		global $wp_query, $post;
		setup_postdata($post);
		if ( $wp_query->is_home || is_front_page() ) {
			if ( $this->check_active_seo_plugins('aisop') || $this->check_active_seo_plugins('yoast') ) return false;
			$description = get_bloginfo( 'description' );
			$meta['description'] = '<meta name="description" content="' . trim(wptexturize(strip_tags(stripslashes($description)))) . '" />';
		}		
		elseif ($wp_query->is_single || $wp_query->is_page) {
			//If either plugins have descriptions set, or using AISOP (cuz it automatically gets the excerpt so no need to do it), kill...
			if ( $this->check_active_seo_plugin_data('description') || $this->check_active_seo_plugins('aisop') ) return false;
			$excerpt = trim(substr( str_replace('[...]', '', get_the_excerpt()), 0, 160) );
			if ($excerpt){
				$meta['description'] = '<meta name="description" content="' . $excerpt . '" />';
			}
		}
		elseif ($wp_query->is_category || $wp_query->is_tax || $wp_query->is_tag) { #wp
			if ( $this->check_active_seo_plugins('aisop') || $this->check_active_seo_plugins('yoast') ) return false;
			$description = trim(wptexturize($apevo_terms->terms[$wp_query->queried_object->taxonomy][$wp_query->queried_object->term_id]['description'])); #wp
			if ($description)
				$meta['description'] = '<meta name="description" content="' . $description . '" />';			
		}
		if ($meta)
			$this->meta = $meta;
	}
	
	function conditional_styles(){
		global $wp_query, $post;
		if ($wp_query->is_single && get_post_meta($post->ID,'dont-use-lightbox', true) == '' && get_post_meta($post->ID,'training-video-embed', true) !='') {
			$date_modified = filemtime(APEVO_CSS . '/slidepanel/style.css');
			$conditional_styles['lightbox'] = '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/lib/css/jquery.lightbox-0.5.css?'. date('mdy-Gis', $date_modified).'" media="screen" />';
		}
			
		if ($wp_query->is_single && get_post_meta($post->ID,'media-post-type', true) == 'mtresource') {	
			$date_modified = filemtime(APEVO_CSS . '/slidepanel/style.css');	
			$conditional_styles['slider1'] = '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/lib/css/slidepanel/style.css?'. date('mdy-Gis', $date_modified).'" media="screen" />';
			$conditional_styles['slider2'] = '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/lib/css/slidepanel/slide.css?'. date('mdy-Gis', $date_modified).'" media="screen" />';
		}
		if ($wp_query->is_single && (get_post_meta($post->ID,'custom-css-embed', true) || get_post_meta($post->ID,'custom-page-layout', true)) ) {
			$conditional_styles['custom_embed'] = "<style type=\"text/css\" media=\"screen\">\n";
			$conditional_styles['custom_embed'] .= "<!--\n";
		}
		if ($wp_query->is_single && get_post_meta($post->ID,'custom-css-embed', true)) {				
			
			$conditional_styles['custom_embed'] .= get_post_meta($post->ID,'custom-css-embed', true)."\n";
						
		}
		
		if ($wp_query->is_single && get_post_meta($post->ID,'custom-page-layout', true)) {				
			
			$conditional_styles['custom_embed'] .= "#content {width:100%}\n#sidebars{display:none;}\n";
					
		}
		
		if ($wp_query->is_single && (get_post_meta($post->ID,'custom-css-embed', true) || get_post_meta($post->ID,'custom-page-layout', true)) ) {
			$conditional_styles['custom_embed'] .= "\n-->\n";
			$conditional_styles['custom_embed'] .= "</style>";
		}
			
		if ($conditional_styles)
			$this->conditional_styles = $conditional_styles;
	}
	
	function stylesheets() {
		global $apevo_site;

		// Main stylesheet
		// $date_modified = filemtime(TEMPLATEPATH . '/style.css');
		// $styles['core'] = array(
		// 	'url' => get_bloginfo('stylesheet_url') . '?' . date('mdy-Gis', $date_modified), #wp
		// 	'media' => 'screen, projection'
		// );

		$date_modified = filemtime(TEMPLATEPATH . '/uvc-styles.css');
		$styles['core'] = array(
			'url' => get_bloginfo('stylesheet_url') . '?' . date('mdy-Gis', $date_modified), #wp
			'media' => 'screen, projection'
		);

		if (file_exists(APEVO_CUSTOM)) {
			$path = APEVO_CUSTOM;
			$url = APEVO_CUSTOM_FOLDER;
		}
		elseif (file_exists(TEMPLATEPATH . '/custom-sample')) {
			$path = TEMPLATEPATH . '/custom-sample';
			$url = APEVO_SAMPLE_FOLDER;
		}

		$layout_path = "$path/layout.css";
		$uvc_path = TEMPLATEPATH."/uvc-styles.css";
		$custom_path = "$path/custom.css";
		$layout_url = "$url/layout.css";
		$uvc_url = get_bloginfo('template_url')."/uvc-styles.css";
		$custom_url = "$url/custom.css";

		$date_modified = filemtime($layout_path);
		$styles['layout'] = array(
			'url' => $layout_url . '?' . date('mdy-Gis', $date_modified),
			'media' => 'screen, projection'
		);

		$date_modified = filemtime($uvc_path);
		$styles['layout'] = array(
			'url' => $uvc_url . '?' . date('mdy-Gis', $date_modified),
			'media' => 'screen, projection'
		);
		
		// Custom stylesheet, if applicable
		if ($apevo_site->custom['stylesheet']) {
			$date_modified = filemtime($custom_path);
			$styles['custom'] = array(
				'url' => $custom_url . '?' . date('mdy-Gis', $date_modified),
				'media' => 'screen, projection'
			);
		}

		foreach ($styles as $type => $style)
			$stylesheets[$type] = ($type == 'ie') ? sprintf('<!--[if lte IE 8]><link rel="stylesheet" href="%1$s" type="text/css" media="%2$s" /><![endif]-->', $style['url'], $style['media']) : sprintf('<link rel="stylesheet" href="%1$s" type="text/css" media="%2$s" />', $style['url'], $style['media']);
		
		$stylesheets['dynamic'] = ap_dynamic_stylesheet(); //css, dynamic.php
		
		$stylesheets['forum'] = "<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|Lilita+One|Dosis:200,300,400,500,600,700,800|Overlock:400,700,900,400italic,700italic,900italic|Brawler|Droid+Sans:400,700|Droid+Serif:400,700,400italic,700italic|Permanent+Marker|Headland+One|Arvo:400,700,400italic,700italic|Cabin:400,500,600,700,400italic,500italic,600italic,700italic|Neuton:200,300,400,700,800,400italic|News+Cycle:400,700|Coustard:400,900|Maiden+Orange|PT+Sans+Narrow:400,700|Ropa+Sans:400,400italic|Cabin+Condensed:400,500,600,700|Corben:400,700|Arimo:400,700,400italic,700italic|Paytone+One|Simonetta:400,900,400italic,900italic|Concert+One|Magra:400,700|Bitter:400,700,400italic|Waiting+for+the+Sunrise|Kameron:400,700|Anton|Rokkitt:400,700|Russo+One|Copse|Gloria+Hallelujah|Candal|Bevan|Vollkorn:400italic,700italic,400,700|Passion+One:400,700,900|Merriweather:400,900,300,700|Squada+One|Anonymous+Pro:400,700,400italic,700italic|Oswald:400,300,700|Poly:400,400italic|Covered+By+Your+Grace|Rock+Salt|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800|Open+Sans+Condensed:300,700,300italic==1' type='text/css' media='all' />";
		

		if ($stylesheets)
			$this->stylesheets = $stylesheets;
	}
	
	function links() {
		global $apevo_site, $apevo_favicon;

		if ($apevo_favicon->favicon)
			$links['favicon'] = "<link rel=\"shortcut icon\" href=\"$apevo_favicon->favicon\" />"; #todo

		// Canonical URL
		$apevo_site['use-canonical'] = 1; #todo
		if ($apevo_site['use-canonical']) {
			global $wp_query; #wp
			if ($wp_query->is_single || $wp_query->is_page) { #wp
				global $post;
				$url = ($wp_query->is_page && get_option('show_on_front') == 'page' && get_option('page_on_front') == $post->ID) ? trailingslashit(get_permalink()) : get_permalink(); #wp
			}
			elseif ($wp_query->is_author) { #wp
				$author = get_userdata($wp_query->query_vars['author']); #wp
				$url = get_author_link(false, $author->ID, $author->user_nicename); #wp
			}
			elseif ($wp_query->is_category || $wp_query->is_tax || $wp_query->is_tag) #wp
				$url = get_term_link($wp_query->queried_object, $wp_query->queried_object->taxonomy); #wp
			elseif ($wp_query->is_day) #wp
				$url = get_day_link($wp_query->query_vars['year'], $wp_query->query_vars['monthnum'], $wp_query->query_vars['day']); #wp
			elseif ($wp_query->is_month) #wp
				$url = get_month_link($wp_query->query_vars['year'], $wp_query->query_vars['monthnum']); #wp
			elseif ($wp_query->is_year) #wp
				$url = get_year_link($wp_query->query_vars['year']); #wp
			elseif ($wp_query->is_home) #wp
				$url = (get_option('show_on_front') == 'page') ? trailingslashit(get_permalink(get_option('page_for_posts'))) : trailingslashit(get_option('home')); #wp
				
			if ($url) $links['canonical'] = '<link rel="canonical" href="' . $url . '" />';
		}

		$feed_title = get_bloginfo('name') . ' RSS Feed'; #wp
		$xmlrpc = get_bloginfo('pingback_url');
		#later:: $links['alternate'] = '<link rel="alternate" type="application/rss+xml" title="' . $feed_title . '" href="' . apevo_feed_url() . '" />';
		$links['pingback'] = "<link rel=\"pingback\" href=\"$xmlrpc\" />";
		$links['rsd'] = "<link rel=\"EditURI\" type=\"application/rsd+xml\" title=\"RSD\" href=\"{$xmlrpc}?rsd\" />";
		if ($apevo_site->publishing['wlw']) $links['wlw'] = '<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="' . get_bloginfo('wpurl') . '/wp-includes/wlwmanifest.xml" />'; #wp
		$this->links = $links;
	}
	
	function scripts() {
		global $wp_query, $post;
		
		// $sucker_date_modified = filemtime(APEVO_SCRIPTS. '/suckerfish.js');
		// $scripts['suckerfish'] = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"".get_bloginfo('template_directory')."/lib/scripts/suckerfish.js?$sucker_date_modified\"></script>";
		
		if ($wp_query->is_single && $post->comment_status == 'open' || $wp_query->is_page && $post->comment_status == 'open')
			wp_enqueue_script('comment-reply');
		
		$jqueryform_date_modified = filemtime(APEVO_SCRIPTS. '/jquery.form.js');
		//$scripts['jqueryform'] = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"".get_bloginfo('template_directory')."/lib/scripts/jquery.form.js?$jqueryform_date_modified\"></script>";
		if ($wp_query->is_single && get_post_meta($post->ID,'media-post-type',true)=='mtresource') {
			$sliderjquery_date_modified = filemtime(APEVO_SCRIPTS. '/jquery-1.3.2.min.js');
			$sliderjs_date_modified = filemtime(APEVO_SCRIPTS. '/slide.js');
			$scripts['sliderjquery'] = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"".get_bloginfo('template_directory')."/lib/scripts/jquery-1.3.2.min.js?$sliderjquery_date_modified\"></script>";
			$scripts['sliderjs'] = "<script src=\"".get_bloginfo('template_directory')."/lib/scripts/slide.js?$sliderjs_date_modified\" type=\"text/javascript\"></script>";
		}
		if ($wp_query->is_single && get_post_meta($post->ID,'dont-use-lightbox', true) == '' && get_post_meta($post->ID,'training-video-embed', true) !='') {
			$scripts['fancyboxjs'] = "<script type=\"text/javascript\" src=\"".get_bloginfo('template_directory')."/lib/scripts/jquery.fancybox-1.2.6.min.js?ver=1.3.2\"></script>";
		}
		
		if ($scripts)
			$this->scripts = $scripts;
	}
	
	function output() {
		$head_items = array();

		foreach ($this as $item)
			$head_items[] = implode("\n", $item);

		echo implode("\n", $head_items);
		echo "\n";
	}
}