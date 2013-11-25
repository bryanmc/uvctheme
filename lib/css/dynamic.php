<?php
include ('../../../../../wp-load.php');
header('Content-type: text/css');
$pageType = $_GET["type"];
$pageType = urldecode($pageType);
?>

<?php 
if (get_apt_option('deactivate_styling_options')) {}else{ ?>

/*             ############  Theme Body  ############### 
------------------------------------------------------------------------------*/

<?php
if (get_apt_option('blog_wrapper_border_color') && get_apt_option('blog_wrapper_border_width')) { ?>

/* Custom Border Color */
<?php
if (get_apt_option('blog_wrapper_border_width')) {
	$borderwidth = str_replace('px','',get_apt_option('blog_wrapper_border_width'));
}else{
	$borderwidth = 2;
}
?>
#header_area .top ul.menu {
	border-top: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
	border-left: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
	border-right: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
}
#header_area .page {
	border-left: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
	border-right: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
}
#content_area .page {
	border-left: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
	border-right: <?php echo $borderwidth; ?>px solid <?php echo get_apt_option('blog_wrapper_border_color') ?>;
}
<?php } ?>

/* Added Border Effects */

<?php 
#Add/Remove Selected H3 effects to the menu...
if (get_apt_option('blog_wrapper_border_effects')){ 
$blogwrapperbordereffects = explode(",", get_apt_option('blog_wrapper_border_effects'));
	if (in_array('Drop Shadow Style 1',$blogwrapperbordereffects)) { ?>
		#header_area .top ul.menu {
			-moz-box-shadow: 0 0 35px #888;
			-webkit-box-shadow: 0 0 35px #888;
			box-shadow: 0 0 35px #888;
		}
	<?php } ?>
<?php } ?>


/* Single Column Layout */
<?php
if (get_apt_option('number_of_columns') == 1 || (($pageType=='single' || $pageType=='page') && $_GET['col']=='fullwidth')) { ?>
#content {
	width: 99%;
}
#sidebars {
	display:none;
}
	<?php if (get_apt_option('single_col_width')) { ?>
		.full_width .page { width: <?php echo get_apt_option('single_col_width'); ?>px; }
		img#logo { max-width: <?php echo get_apt_option('single_col_width'); ?>px; }
		#header_area .top ul.menu { width: <?php echo get_apt_option('single_col_width'); ?>px; }
		#header_area .secondary ul.menu { width: <?php echo get_apt_option('single_col_width'); ?>px; }
		#top_position_logo {width: <?php echo get_apt_option('single_col_width'); ?>px;}
	<?php } ?>
<?php } ?>


/* Sidebar Positioning */
<?php
if (get_apt_option('sidebar_position') == 'Left') { ?>
#sidebars {
	margin-left: 10px;
}
<?php } ?>
<?php
if ($pageType == 'single' && get_apt_option('sidebar_position_single') == 'Left') { ?>
#sidebars {
	margin-left: 10px;
}
<?php } ?>
<?php
if ($pageType == 'single' && get_apt_option('sidebar_position_single') == 'Right') { ?>
#sidebars {
	margin-left: 0px;
}
<?php } ?>

/* Color Scheming */
<?php
if (get_apt_option('scheme_plc')) { ?>
	.action_tab ul li {background: <?php echo get_apt_option('scheme_plc'); ?>;}
	/*#header_area .top ul.menu li ul li:hover a {background: <?php //echo get_apt_option('scheme_plc'); ?>;} */
	#header_area .top ul.menu li ul li.current a, #header_area .top ul.menu li ul li.current_page_item a, #header_area .top ul.menu li ul li.current-cat a {background: <?php echo get_apt_option('scheme_plc'); ?>;}
	#header_area .top ul.menu li.current, #header_area .top ul.menu li.current_page_item, #header_area .top ul.menu li.current-cat {background: <?php echo get_apt_option('scheme_plc'); ?>;}
	.entry-content a, #author_box a {color:<?php echo get_apt_option('scheme_plc'); ?>;}
	.teasers_box h2.entry-title a:hover {color:<?php echo get_apt_option('scheme_plc'); ?>;}
	.teasers_box p.headline_meta span.post_cats a {background: <?php echo get_apt_option('scheme_plc'); ?>;}
	#content .post .headline_area h2.entry-title a:hover {color:<?php echo get_apt_option('scheme_plc'); ?>;}
	.headline_area p.headline_meta span.post_cats a {color:#fff;background: <?php echo get_apt_option('scheme_plc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.widget ul li a:hover {color: <?php echo get_apt_option('scheme_plc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.ap_widget ul li a:hover {color: <?php echo get_apt_option('scheme_plc'); ?>;}
	.reply a{background:none repeat scroll 0 0 <?php echo get_apt_option('scheme_plc'); ?>;}
	li.widget a {color: <?php echo get_apt_option('scheme_plc'); ?>;}
	li.widget ul li a:hover {color: <?php echo get_apt_option('scheme_plc'); ?>;} 
	li.ap_widget a {color: <?php echo get_apt_option('scheme_plc'); ?>;}
	li.ap_widget h3.style1_light span {background: <?php echo get_apt_option('scheme_plc'); ?>;}
	li.ap_widget ul li .affiliate_link {background:<?php echo get_apt_option('scheme_plc'); ?>;}
	li.prorev_stars_widget ul li .style1_light {background: <?php echo get_apt_option('scheme_plc'); ?>;}	
	#footer_area {border-top: 5px solid <?php echo get_apt_option('scheme_plc'); ?>;}
	/* UVC Viral Theme: Headline */
	.headline_area p.headline_meta span.post_tags a {color:<?php echo get_apt_option('scheme_plc'); ?>;}
	/* UVC Viral Theme: Byline */
	.headline_area .headline_meta span.author_meta a {color:<?php echo get_apt_option('scheme_plc'); ?>;}
	/* UVC Viral Theme: Teasers */
	p.teaser_tag_meta{border-color:<?php echo get_apt_option('scheme_plc'); ?>;}
	p.teaser_tag_meta span.post_tags a {color:<?php echo get_apt_option('scheme_plc'); ?>;}
	/* UVC Viral Theme: Related Posts */
	.feature-related-posts ul li a:hover {color: <?php echo get_apt_option('scheme_plc'); ?>;}
	/* UVC Viral Sidebar Post Tags */
	#sidebars .sidebar ul.sidebar_list li.widget span.post_tags a {color: <?php echo get_apt_option('scheme_plc'); ?>;}
	/* UVC Viral Trending Topics */
	#trending_topics h3{border-color:<?php echo get_apt_option('scheme_plc'); ?>;}
	#trending_topics h3 span.title,.trending_topics_column a {color:<?php echo get_apt_option('scheme_plc'); ?>;}
<?php } ?>

<?php
if (get_apt_option('scheme_sdc')) { ?>	
	#header_area .top ul.menu {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#header_area .top ul.menu li ul li a {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#header_area .secondary ul.menu li ul li a {display: block;color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	/*#header_area .secondary ul.menu li ul li:hover a {color: <?php //echo get_apt_option('scheme_sdc'); ?>;}*/
	#header_area .secondary ul.menu li ul li.current a, #header_area .secondary ul.menu li ul li.current_page_item a, #header_area .secondary ul.menu li ul li.current-cat a {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#header_area .secondary ul.menu li.current, #header_area .secondary ul.menu li.current_page_item, #header_area .secondary ul.menu li.current-cat {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#header_area .secondary ul.menu li.current ul li a, #header_area .secondary ul.menu li.current_page_item ul li a, #header_area .secondary ul.menu li.current-cat ul li a {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#header_area .secondary ul.menu li a {display: block;color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#header h1#logo a, #header h1#logo a:visited, #header h1#logo:hover, #header p#logo a, #header p#logo a:visited, #header p#logo:hover {color:<?php echo get_apt_option('scheme_sdc'); ?>;} 
	#header p#tagline {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	#top_position_logo h1#logo a, #top_position_logo h1#logo a:visited, #top_position_logo h1#logo:hover, #top_position_logo p#logo a, #top_position_logo p#logo a:visited, #top_position_logo p#logo:hover {color:<?php echo get_apt_option('scheme_sdc'); ?>;} 
	#top_position_logo p#tagline {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	.entry-content a:hover, #author_box a:hover {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	.prev_next p.next a {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	.prev_next p.previous a {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	.post_box .affiliate_link {float: left;clear:left;background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	.format_text p a.more-link {clear: both;color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	.teasers_box h2.entry-title a, .headline_area h2.entry-title a:visited {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	.teasers_box p.headline_meta a {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	.teasers_box p a.teaser_link {clear: both;color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	.headline_area h2.entry-title a, .headline_area h2.entry-title a:visited {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	.headline_area p.headline_meta a {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	#sidebars h3 span {background-color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.widget ul li a {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.ap_widget ul li a {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, #sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, #sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, #sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {background-color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#archive_intro h1 {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	.comment-author{color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	.comment-meta{color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	form#commentform input[type=text]{color:<?php echo get_apt_option('scheme_sdc'); ?>!important;}
	form#commentform input[type=submit]{color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	form#commentform textarea{color:<?php echo get_apt_option('scheme_sdc'); ?>!important;}
	.comment-author a,.comment-meta a{color:<?php echo get_apt_option('scheme_sdc'); ?>}
	#footer_area ul.widgets_list li.widget h3 span {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#footer_area ul.widgets_list li.ap_widget h3.downward_tab_right{color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#footer_area ul.widgets_list li.ap_widget h3.downward_tab_right span {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#footer_links a {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	li.widget a:hover {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	li.widget h3 span {background-color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	li.widget ul li a {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	li.ap_widget a:hover {color: <?php echo get_apt_option('scheme_sdc'); ?>;}
	li.ap_widget h3.style1_dark span {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	li.prorev_stars_widget ul li .affiliate_link {background: <?php echo get_apt_option('scheme_sdc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.prorev_stars_widget ul li .affiliate_link {background: <?php echo get_apt_option('scheme_sdc'); ?>;}	
	#footer_area ul.widgets_list li.ap_widget h3.style1_light span, #footer_area ul.widgets_list li.ap_widget h3.style1_dark span, #footer_area ul.widgets_list li.ap_widget h3.downward_tab span, #footer_area ul.widgets_list li.ap_widget h3.downward_tab_right span {color:<?php echo get_apt_option('scheme_sdc'); ?>;}
	/* UVC Viral Theme: Branding */
	.uvc_feature_top_bar{background: <?php echo get_apt_option('scheme_sdc'); ?>;}
<?php } ?>

<?php
if (get_apt_option('scheme_slc')) { ?>
	#header_area .top {background-color: <?php echo get_apt_option('scheme_slc'); ?>;}
	#footer_area {background: <?php echo get_apt_option('scheme_slc'); ?>;}
	#footer_area .page {background: <?php echo get_apt_option('scheme_slc'); ?>;}
	#header_area .top ul.menu li.current, #header_area .top ul.menu li.current_page_item, #header_area .top ul.menu li.current-cat {border-left:0px solid <?php echo get_apt_option('scheme_slc'); ?>;}
	.prev_next p.next a {border: 2px solid <?php echo get_apt_option('scheme_slc'); ?>;}
	.prev_next p.previous a {border: 2px solid <?php echo get_apt_option('scheme_slc'); ?>}
	.post_box .affiliate_link {border:2px solid <?php echo get_apt_option('scheme_slc'); ?>;}
	/*.teasers_box p.headline_meta span.post_cats a {border: 2px solid <?php echo get_apt_option('scheme_slc'); ?>;}
	.headline_area p.headline_meta span.post_cats a {border: 2px solid <?php echo get_apt_option('scheme_slc'); ?>;}*/
	#sidebars h3 {background: <?php echo get_apt_option('scheme_slc'); ?>;}
	#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light, #sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark  {background: <?php echo get_apt_option('scheme_slc'); ?>;}
	li.widget h3 {background: <?php echo get_apt_option('scheme_slc'); ?>;}
	li.ap_widget h3.style1_light {border-bottom: 1px solid <?php echo get_apt_option('scheme_slc'); ?>;background:<?php echo get_apt_option('scheme_slc'); ?>;}
	li.ap_widget h3.style1_light span {border: 2px solid <?php echo get_apt_option('scheme_slc'); ?>;}
	li.ap_widget h3.style1_dark {border-bottom: 1px solid <?php echo get_apt_option('scheme_slc'); ?>;}
	li.ap_widget h3.style1_dark {background: <?php echo get_apt_option('scheme_slc'); ?>;}
	li.ap_widget h3.style1_dark span {border: 2px solid <?php echo get_apt_option('scheme_slc'); ?>;}
<?php } ?>


/* Custom Overwrites - UVC */

<?php if ( get_apt_option('branding_bg_color') ) { ?> 
.uvc_feature_top_bar{background: <?php echo get_apt_option('branding_bg_color'); ?>;}
<?php } ?>

<?php if ( get_apt_option('branding_text_color') ) { ?> 
.uvc_feature_top_bar h2 a{color: <?php echo get_apt_option('branding_text_color'); ?>;}
p.feature_bar_post_tag span.post_tags a{color: <?php echo get_apt_option('branding_text_color'); ?>;}
<?php } ?>
<?php if ( get_apt_option('branding_text_font') ) { ?> 
.uvc_feature_top_bar h2 a{font-family: <?php echo get_font_list(get_apt_option('branding_text_font'),false); ?>,helvetica,arial,sans-serif;}
<?php } ?>

<?php if ( get_apt_option('site_branding_type') == 'Image' && get_apt_option('site_branding_image') ) { ?> 
.uvc_feature_top_bar h2 a {width:300px;display:block;}
.uvc_feature_top_bar h2 { text-indent:-999px;background:url('<?php echo get_apt_option('site_branding_image'); ?>') no-repeat;}
<?php } ?>

/* Custom Background Color - Overwrite Color Scheme */

<?php 

if (get_apt_option('bg_color') && !get_apt_option('custom_bg_image')) { ?> 
body {
    background: <?php echo get_apt_option('bg_color'); ?>;
}
.full_width .page {
	padding: 0px;
}
/*#content {
	width: 67%;
	margin-left: 10px;
}*/
#content_area {
	background: transparent;
} 
#header_area {
	background: transparent;
}
#header_area .top {
	background: transparent;
}
#header_area .page {
	background: #fff;	
}
.full_width .page {
	background: transparent;	
}
<?php } ?>

/* Custom Background Image - Overwrite BG Color */

<?php 

if (get_apt_option('custom_bg_image')) { ?> 
body {
    background: url("<?php echo get_apt_option('custom_bg_image'); ?>") <?php if (get_apt_option('bg_repeat') == 'None') { ?>no-repeat<?php } elseif (get_apt_option('bg_repeat') == 'Horizontally') { ?>repeat-x<?php } elseif (get_apt_option('bg_repeat') == 'Vertically') { ?>repeat-y<?php } elseif (get_apt_option('bg_repeat') == 'Both') { ?>repeat<?php }else{echo'no-repeat';} ?> <?php if (get_apt_option('scrolling_bg_image') == 'Yes') { ?>fixed<?php }else{} ?> top center <?php if (get_apt_option('bg_color') != '') { ?> <?php echo get_apt_option('bg_color'); ?><?php } ?>;
}
.full_width .page {
	padding: 0px;
}
/*#content {
width: 67%;
margin-left: 10px;
}*/
#content_area {
	background: transparent;
} 
#header_area {
	background: transparent;
}
#header_area .top {
	background: transparent;
	border:0px;
}
#header_area .page {
	background: #fff;	
}
.full_width .page {
	background: transparent;	
}
<?php } ?>




/* ================================================================
	Custom Primary Navigation Menu Colors 
===================================================================*/
<?php 
#Set the background color of the nav menu
if (get_apt_option('pnav_bg_color')) { ?> 
#header_area .top ul.menu {	background: <?php echo get_apt_option('pnav_bg_color'); ?>;}
<?php } ?>
<?php 
#Set primary nav background image...
if (get_apt_option('pnav_bg_image')) { ?>
#header_area .top ul.menu {
    background: url("<?php echo get_apt_option('pnav_bg_image'); ?>") repeat top left;
}
<?php } ?>
<?php 
#Set the link color for inactive nav links...
if (get_apt_option('pnav_links_color')) { ?>
#header_area .top ul.menu li a {
	color: <?php echo get_apt_option('pnav_links_color'); ?>;
}
<?php } ?>
<?php 
#Set the active link background color...
if (get_apt_option('pnav_active_link_bg_color')) { ?> 
#header_area .top ul.menu li ul li.current a, #header_area .top ul.menu li ul li.current_page_item a, #header_area .top ul.menu li ul li.current-cat a {background: <?php echo get_apt_option('pnav_active_link_bg_color'); ?>;}
#header_area .top ul.menu li.current, #header_area .top ul.menu li.current_page_item, #header_area .top ul.menu li.current-cat {background: <?php echo get_apt_option('pnav_active_link_bg_color'); ?>;}
<?php } ?>
<?php 
#Sets the link color to sdc or #444 if a transparent active link background color...
if (get_apt_option('pnav_active_link_bg_color')=='transparent') { 
	$activelinkcolor = get_apt_option('scheme_sdc');
	if (!$activelinkcolor)
		$activelinkcolor = "#444";
?>
#header_area .top ul.menu li ul li.current a, #header_area .top ul.menu li ul li.current_page_item a, #header_area .top ul.menu li ul li.current-cat a {color: <?php echo $activelinkcolor; ?>;}
<?php } ?>
<?php 
#Set the link color of active link (for contrasting with active link background)...
if (get_apt_option('pnav_active_link_color')) { 
$activelinkcolor = get_apt_option('scheme_sdc');
	if (!$activelinkcolor)
		$activelinkcolor = "#444";
?>
#header_area .top ul.menu li.current a, #header_area .top ul.menu li.current_page_item a, #header_area .top ul.menu li.current-cat a {color:<?php echo get_apt_option('pnav_active_link_color'); ?>;}
#header_area .top ul.menu li.page_item ul.children li.page_item a {color:<?php echo $activelinkcolor; ?>;}
#header_area .top ul.menu li.page_item ul.children li.current_page_item a, #header_area .top ul.menu li.page_item ul.children li.current-cat a {
color: <?php echo get_apt_option('pnav_active_link_color'); ?>;}
#header_area .top ul.menu li ul li.current a, #header_area .top ul.menu li ul li.current_page_item a, #header_area .top ul.menu li ul li.current-cat a {color: <?php echo get_apt_option('pnav_active_link_color'); ?>;}
<?php } ?>

<?php 
#Add Selected effects to the menu...
if (get_apt_option('pnav_menu_effects')){ 
$pnaveffects = explode(",", get_apt_option('pnav_menu_effects'));
	if (in_array('Box Shadow',$pnaveffects)) { ?>
		#header_area .top ul.menu {-moz-box-shadow: inset 0 0 20px rgba(0,0,0,0.25);-webkit-box-shadow: inset 0 0 20px rgba(0,0,0,0.25);box-shadow: inset 0 0 20px rgba(0,0,0,0.25);}
	<?php } ?>
<?php } ?>


/* ================================================================
	Custom Secondary Navigation Menu Colors 
===================================================================*/
<?php 
#Set the background color of the nav menu
if (get_apt_option('snav_bg_color')) { ?> 
#header_area .secondary ul.menu {background: <?php echo get_apt_option('snav_bg_color'); ?>;}
<?php } ?>

<?php 
#Set background image...
if (get_apt_option('snav_bg_image')) { ?>
#header_area .secondary ul.menu {
    background: url("<?php echo get_apt_option('snav_bg_image'); ?>") repeat top left;
}
<?php } ?>

<?php 
#Set the link color for inactive nav links...
if (get_apt_option('snav_links_color')) { ?>
#header_area .secondary ul.menu li a {
	color: <?php echo get_apt_option('snav_links_color'); ?>;
}
<?php } ?>

<?php 
#Set the active link background color...
if (get_apt_option('snav_active_link_bg_color')) { ?> 
#header_area .secondary ul.menu li ul li.current a, #header_area .secondary ul.menu li ul li.current_page_item a, #header_area .secondary ul.menu li ul li.current-cat a {background: <?php echo get_apt_option('snav_active_link_bg_color'); ?>;}
#header_area .secondary ul.menu li.current, #header_area .secondary ul.menu li.current_page_item, #header_area .secondary ul.menu li.current-cat {background: <?php echo get_apt_option('snav_active_link_bg_color'); ?>;}
<?php } ?>

<?php 
#Sets the link color to sdc or #444 if a transparent active link background color...
if (get_apt_option('snav_active_link_bg_color')=='transparent') { 
	$activelinkcolor = get_apt_option('scheme_sdc');
	if (!$activelinkcolor)
		$activelinkcolor = "#444";
?>
#header_area .secondary ul.menu li ul li.current a, #header_area .secondary ul.menu li ul li.current_page_item a, #header_area .secondary ul.menu li ul li.current-cat a {color: <?php echo $activelinkcolor; ?>;}
<?php } ?>

<?php 
#Set the link color of active link (for contrasting with active link background)...
if (get_apt_option('snav_active_link_color')) { 
$activelinkcolor = get_apt_option('scheme_sdc');
	if (!$activelinkcolor)
		$activelinkcolor = "#444";
?>
#header_area .secondary ul.menu li.current a, #header_area .secondary ul.menu li.current_page_item a, #header_area .secondary ul.menu li.current-cat a {color:<?php echo get_apt_option('snav_active_link_color'); ?>;}
#header_area .secondary ul.menu li.page_item ul.children li.page_item a {color:<?php echo $activelinkcolor; ?>;}
#header_area .secondary ul.menu li.page_item ul.children li.current_page_item a, #header_area .secondary ul.menu li.page_item ul.children li.current-cat a {
color: <?php echo get_apt_option('snav_active_link_color'); ?>;}
#header_area .secondary ul.menu li ul li.current a, #header_area .secondary ul.menu li ul li.current_page_item a, #header_area .secondary ul.menu li ul li.current-cat a {color: <?php echo get_apt_option('snav_active_link_color'); ?>;}
<?php } ?>

<?php 
#Add Selected effects to the menu...
if (get_apt_option('snav_menu_effects')){ 
$snaveffects = explode(",", get_apt_option('snav_menu_effects'));
	if (in_array('Box Shadow',$snaveffects)) { ?>
		#header_area .secondary ul.menu {-moz-box-shadow: inset 0 0 20px rgba(0,0,0,0.25);-webkit-box-shadow: inset 0 0 20px rgba(0,0,0,0.25);box-shadow: inset 0 0 20px rgba(0,0,0,0.25);}
	<?php } ?>
<?php } ?>

<?php 
#Set height of primary nav to zero if hidden globally or per post...
if (get_apt_option('hide_header_menus') == 'Both' || get_apt_option('hide_header_menus') == 'Top' || $pageType == 'single' && $_GET['hpn'] == 'notopheader' || $_GET['hpn'] == 'notop' && $pageType == 'single') { ?>
#header_area .top ul.menu {
	height: 0;
}
<?php } ?>

/* ================================================================
	Custom Border Effects
===================================================================*/

<?php 
#Add/Remove Selected H3 effects to the menu...
if (get_apt_option('blog_wrapper_border_effects')){ 
$blogwrapperbordereffects = explode(",", get_apt_option('blog_wrapper_border_effects'));
	if (in_array('Drop Shadow Style 1',$blogwrapperbordereffects)) { ?>
		#header_area .top ul.menu {
			-moz-box-shadow: 0 0 35px #888;
			-webkit-box-shadow: 0 0 35px #888;
			box-shadow: 0 0 35px #888;
		}
		#header_area .page {
			-moz-box-shadow: 0 10px 35px #888;
			-webkit-box-shadow: 0 10px 35px #888;
			box-shadow: 0 10px 35px #888;
		}
		#content_area .page {
			-moz-box-shadow: 0 20px 35px #888;
			-webkit-box-shadow: 0 20px 35px #888;
			box-shadow: 0 20px 35px #888;
		}
		#header_area .secondary ul.menu {
			position: relative;
		}
	<?php } ?>
	<?php if (in_array('Drop Shadow Style 2',$blogwrapperbordereffects)) { ?>
		#header_area .top ul.menu {
			-moz-box-shadow: 0 0 15px 7px #888;
			-webkit-box-shadow: 0 0 5px 5px#888;
			box-shadow: 0 0 15px 7px #888;
		}
		#header_area .page {
			-moz-box-shadow: 0 10px 15px 7px #888;
			-webkit-box-shadow: 0 10px 15px 7px #888;
			box-shadow: 0 10px 15px 7px #888;
		}
		#content_area .page {
			-moz-box-shadow: 0px 18px 15px 7px #888;
			-webkit-box-shadow: 0px 18px 15px 7px #888;
			box-shadow: 0px 18px 15px 7px #888;
		}
		#header_area .secondary ul.menu {
			position: relative;
		}
	<?php } ?>
	<?php if (in_array('Round Top Border Corners',$blogwrapperbordereffects)) { ?>
			#header_area .top ul.menu {
				-webkit-border-radius: 4px 4px 0 0;-moz-border-radius: 4px 4px 0 0;border-radius: 4px 4px 0 0;
			}
	<?php } ?>
<?php } ?>



/* ================================================================
	Site Header, Logo & Tagline Colors 
===================================================================*/

<?php 
#Set some extra padding on the header if using a text logo...
if (get_apt_option('site_logo_type') != 'Image') { ?>
#header {
	margin-bottom: 0px;
}
<?php } ?>

<?php 
#Set some extra bottom padding on the logo text if not using tagline...
if (get_apt_option('disable_site_tagline')) { ?>
#header h1#logo, #header p#logo, #top_position_logo h1#logo, #top_position_logo p#logo {
	padding: 25px 0 25px 10px;
}
<?php } ?>

<?php 
#Set logo text area background color...
if (get_apt_option('ltext_bg_color')) { ?>
#header {
	background: <?php echo get_apt_option('ltext_bg_color'); ?>;
}
<?php } ?>

<?php 
#Set logo text color...
if (get_apt_option('logo_text_color')) { ?>
#header h1#logo a, #header h1#logo a:visited, #header h1#logo:hover, #header p#logo a, #header p#logo a:visited, #header p#logo:hover {
	color: <?php echo get_apt_option('logo_text_color'); ?>;
}
#top_position_logo h1#logo a, #top_position_logo h1#logo a:visited, #top_position_logo h1#logo:hover, #top_position_logo p#logo a, #top_position_logo p#logo a:visited, #top_position_logo p#logo:hover {
	color: <?php echo get_apt_option('logo_text_color'); ?>;
}
<?php } ?>

<?php 
#Set tagline text color...
if (get_apt_option('tagline_color')) { ?>
#header p#tagline, #top_position_logo p#tagline {
	color: <?php echo get_apt_option('tagline_color'); ?>;
}
<?php } ?>

<?php 
#Set logo text area background image...
if (get_apt_option('ltext_bg_image')) { ?>
#header {
    background: url("<?php echo get_apt_option('ltext_bg_image'); ?>") repeat top left;
}
<?php } ?>

/* ================================================================
	Site Content Styling
===================================================================*/
<?php 
#Set post title link color...
if (get_apt_option('post_title_link_color')) { ?>
.headline_area h2.entry-title a, .headline_area h2.entry-title a:visited,.teasers_box h2.entry-title a, .headline_area h2.entry-title a:visited  {
	color: <?php echo get_apt_option('post_title_link_color'); ?>;
}
<?php } ?>

<?php 
#Set post title link hover color...
if (get_apt_option('post_title_link_hover_color')) { ?>
#content .post .headline_area h2.entry-title a:hover,.teasers_box h2.entry-title a:hover  {
	color: <?php echo get_apt_option('post_title_link_hover_color'); ?>;
}
<?php } ?>

<?php 
#Set in content link color...
if (get_apt_option('in_post_link_color')) { ?>
.entry-content a {
	color: <?php echo get_apt_option('in_post_link_color'); ?>;
}
<?php } ?>

<?php 
#Set in content link hover color...
if (get_apt_option('in_post_link_hover_color')) { ?>
.entry-content a:hover {
	color: <?php echo get_apt_option('in_post_link_hover_color'); ?>;
}
<?php } ?>

<?php 
#Set post title non-link color...
if (get_apt_option('post_h1_color')) { ?>
.headline_area h2.entry-title, .headline_area h1.entry-title, .format_text h1 {
	color: <?php echo get_apt_option('post_h1_color'); ?>;
}
<?php } ?>

<?php 
#Set post subtitle h2 color...
if (get_apt_option('post_h2_color')) { ?>
.format_text h2 {
	color: <?php echo get_apt_option('post_h2_color'); ?>;
}
<?php } ?>

<?php 
#Set post subtitle h3 color...
if (get_apt_option('post_h3_color')) { ?>
.format_text h3 {
	color: <?php echo get_apt_option('post_h3_color'); ?>;
}
<?php } ?>

<?php 
#Set post subtitle h4 color...
if (get_apt_option('post_h4_color')) { ?>
.format_text h4 {
	color: <?php echo get_apt_option('post_h4_color'); ?>;
}
<?php } ?>

<?php 
#Set background color of category lists...
if (get_apt_option('category_bg_color')) { ?>
.headline_area p.headline_meta span.post_cats a, .teasers_box p.headline_meta span.post_cats a {
	background: <?php echo get_apt_option('category_bg_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of category lists...
if (get_apt_option('category_text_color')) { ?>
.headline_area p.headline_meta span.post_cats a, .teasers_box p.headline_meta span.post_cats a {
	color: <?php echo get_apt_option('category_text_color'); ?>;
}
<?php } ?>

<?php 
#Set background color of read more link...
if (get_apt_option('readmore_bg_color')) { ?>
.format_text p a.more-link,.teasers_box p a.teaser_link {
	background: <?php echo get_apt_option('readmore_bg_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of read more link...
if (get_apt_option('readmore_text_color')) { ?>
.format_text p a.more-link,.teasers_box p a.teaser_link {
	color: <?php echo get_apt_option('readmore_text_color'); ?>;
}
<?php } ?>

/* ================================================================
	Site Widgets Styling
===================================================================*/

<?php 
#Set text color of sidebar widget links...
if (get_apt_option('sidebar_widget_links_color')) { ?>
#sidebars  a, #sidebars .sidebar ul.sidebar_list li.ap_widget ul li a, #sidebars .sidebar ul.sidebar_list li.widget ul li a {
	color: <?php echo get_apt_option('sidebar_widget_links_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of sidebar widget links hover...
if (get_apt_option('sidebar_widget_links_hover')) { ?>
#sidebars a:hover, #sidebars .sidebar ul.sidebar_list li.ap_widget ul li a:hover, #sidebars .sidebar ul.sidebar_list li.widget ul li a:hover {
	color: <?php echo get_apt_option('sidebar_widget_links_hover'); ?>;
}
<?php } ?>


<?php 
#Set text color of footer area links...
if (get_apt_option('footer_area_links_color')) { ?>
#footer_area a, #footer_area ul li.ap_widget ul li a, #footer_area ul li.widget ul li a, #footer_links a {
	color: <?php echo get_apt_option('footer_area_links_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of sidebar widget links hover...
if (get_apt_option('footer_area_links_hover')) { ?>
#footer_area a:hover, #footer_area ul li.ap_widget ul li a:hover, #footer_area ul li.widget ul li a:hover, #footer_links a:hover {
	color: <?php echo get_apt_option('footer_area_links_hover'); ?>;
}
<?php } ?>

<?php 
#Set text color of content widget area links...
if (get_apt_option('content_widgets_links_color')) { ?>
#content li.ap_widget a {
	color: <?php echo get_apt_option('content_widgets_links_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of content widget links hover...
if (get_apt_option('content_widgets_links_hover')) { ?>
#content li.ap_widget a:hover {
	color: <?php echo get_apt_option('content_widgets_links_hover'); ?>;
}
<?php } ?>


<?php 
#Set text color of header widget area links...
if (get_apt_option('header_widget_links_color')) { ?>
#header_area a, #header_area ul li.ap_widget ul li a, #header_area ul li.widget ul li a {
	color: <?php echo get_apt_option('header_widget_links_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of header widget links hover...
if (get_apt_option('header_widget_links_hover_color')) { ?>
#header_area a:hover, #header_area ul li.ap_widget ul li a:hover, #header_area ul li.widget ul li a:hover {
	color: <?php echo get_apt_option('header_widget_links_hover_color'); ?>;
}
<?php } ?>


<?php 
#Set background color of widget affiliate link...
if (get_apt_option('widget_afflink_bg_color')) { ?>
li.ap_widget ul li .affiliate_link {
	background: <?php echo get_apt_option('widget_afflink_bg_color'); ?>;
}
<?php } ?>

<?php 
#Set text color of widget affiliate link...
if (get_apt_option('widget_afflink_text_color')) { ?>
li.ap_widget ul li .affiliate_link a, li.ap_widget ul li .affiliate_link a:hover, #sidebars .sidebar ul.sidebar_list li.ap_widget ul li .affiliate_link a,#sidebars .sidebar ul.sidebar_list li.ap_widget ul li .affiliate_link a:hover, #footer_area ul.widgets_list li.ap_widget ul li .affiliate_link a, #footer_area ul.widgets_list li.ap_widget ul li .affiliate_link a:hover, #content ul.widgets_list li.ap_widget ul li .affiliate_link a, #content ul.widgets_list li.ap_widget ul li .affiliate_link a:hover, #header_area ul.widgets_list li.ap_widget ul li .affiliate_link a, #header_area ul.widgets_list li.ap_widget ul li .affiliate_link a:hover {
	color: <?php echo get_apt_option('widget_afflink_text_color'); ?>;
}
<?php } ?>

<?php 
#Set background color of sidebar h3 elements...
if (get_apt_option('sidebar_h3_text_bg_color')) { ?>
h3.apstyle span,
#sidebars h3.apstyle span,
#sidebars h3 span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit span,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {
	background-color: <?php echo get_apt_option('sidebar_h3_text_bg_color'); ?>;
	<?php if (get_apt_option('sidebar_h3_text_bg_color')=='transparent' || get_apt_option('sidebar_h3_text_bg_color')=='Transparent') {
		?>
		-moz-box-shadow: inset 0 0 10px rgba(0,0,0,0.75);
		-webkit-box-shadow: inset 0 0 0px rgba(0,0,0,0.75);
		box-shadow: inset 0 0 0px rgba(0,0,0,0.75);
		text-shadow: #999 0 0;
	<?php } ?>
}
<?php } ?>

<?php 
#Set text color of sidebar h3 elements....
if (get_apt_option('sidebar_h3_text_color')) { ?>
h3.apstyle span,
#sidebars h3.apstyle span,
#sidebars h3 span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit span,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {
	color: <?php echo get_apt_option('sidebar_h3_text_color'); ?>;
}
<?php } ?>

<?php 
#Set full background color of sidebar h3 elements...
if (get_apt_option('sidebar_h3_full_bg_color')) { ?>
h3.apstyle,
#sidebars h3.apstyle,
#sidebars .sidebar ul.sidebar_list li.widget h3,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right  {
	background-color: <?php echo get_apt_option('sidebar_h3_full_bg_color'); ?>;
}
<?php } ?> 

<?php 
#Set sidebar h3 background image...
if (get_apt_option('sidebar_h3_full_bg_image')) { ?>
h3.apstyle,
#sidebars h3.apstyle,
#sidebars .sidebar ul.sidebar_list li.widget h3,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light, 
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab,
#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right {
    background: url("<?php echo get_apt_option('sidebar_h3_full_bg_image'); ?>") repeat top left;
}
<?php } ?>

<?php 
#Add/Remove Selected H3 effects to the menu...
if (get_apt_option('sidebar_h3_effects')){ 
$h3sidebeffects = explode(",", get_apt_option('sidebar_h3_effects'));
	if (in_array('Add H3 Full Box Shadow',$h3sidebeffects)) { ?>
		h3.apstyle,
		#sidebars h3.apstyle,
		#sidebars .sidebar ul.sidebar_list li.widget h3,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right {
			-moz-box-shadow: inset 0 0 20px rgba(0,0,0,0.25);-webkit-box-shadow: inset 0 0 20px rgba(0,0,0,0.25);box-shadow: inset 0 0 20px rgba(0,0,0,0.25);
		}
	<?php } ?>
	<?php if (in_array('Add H3 Rounded Corners',$h3sidebeffects)) { ?>
		h3.apstyle,
		#sidebars h3.apstyle,
		#sidebars .sidebar ul.sidebar_list li.widget h3,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right {
			-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;
		}
		h3.apstyle,
		#sidebars h3.apstyle,
		#sidebars h3 span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit span,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {
			-webkit-border-radius: 4px 0 0 4px;-moz-border-radius: 4px 0 0 4px;border-radius: 4px 0 0 4px;
		}
	<?php } ?>
	<?php if (in_array('Remove H3 Text Box Shadow',$h3sidebeffects)) { ?>
		h3.apstyle,
		#sidebars h3.apstyle span,
		#sidebars h3 span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit span,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {
			-moz-box-shadow: inset 0 0 10px rgba(0,0,0,0.75);-webkit-box-shadow: inset 0 0 0px rgba(0,0,0,0.75);	box-shadow: inset 0 0 0px rgba(0,0,0,0.75);
		}
	<?php } ?>
	<?php if (in_array('Remove H3 Text Drop Shadow',$h3sidebeffects)) { ?>
		h3.apstyle,
		#sidebars h3.apstyle span,
		#sidebars h3 span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit span,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {
			text-shadow: #999 0 0;
		}
	<?php } ?>
	<?php if (get_apt_option('h3_cufon_font')) { ?>
		h3.apstyle,
		#sidebars h3.apstyle span,
		#sidebars h3 span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.inherit span,
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_light span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.style1_dark span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab span, 
		#sidebars .sidebar ul.sidebar_list li.ap_widget h3.downward_tab_right span {
			padding: 5px 11px 7px 10px;
		}
	<?php } ?>
<?php } ?>

/* ================================================================
	Fonts & Sizes 
===================================================================*/

<?php if (get_apt_option('core_font')=='MS Sans Serif' || get_apt_option('core_font')=='Arial Black') { ?>
	#header_area .secondary ul.menu li a {padding: 8px 8px 8px 8px;}
<?php } ?>

<?php 
#Set core font...
if (get_apt_option('core_font')) { ?>
body {
	font-family: <?php get_font_list(get_apt_option('core_font'),1); ?>;
}
<?php } ?>

<?php 
#Set home/archive feature post title font size (default for single post)...
if (get_apt_option('harch_feature_post_title_size')) { ?>
.headline_area h2.entry-title, .headline_area h1.entry-title {
	font-size: <?php create_em(get_apt_option('harch_feature_post_title_size'),1); ?>;
}
<?php } 
#Set home/archive feature post title font (default for: single post, teaser box)...
if (get_apt_option('harch_feature_post_title_font')) { ?>
.headline_area h2.entry-title, .headline_area h1.entry-title, .teasers_box h2.entry-title {
	font-family: <?php get_font_list(get_apt_option('harch_feature_post_title_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('single_post_title_size')) { ?>
.headline_area h1.entry-title {
	font-size: <?php create_em(get_apt_option('single_post_title_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('single_post_title_font')) { ?>
.headline_area h1.entry-title {
	font-family: <?php get_font_list(get_apt_option('single_post_title_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('teaser_post_title_size')) { ?>
.teasers_box h2.entry-title {
	font-size: <?php create_em(get_apt_option('teaser_post_title_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('teaser_post_title_font')) { ?>
.teasers_box h2.entry-title {
	font-family: <?php get_font_list(get_apt_option('teaser_post_title_font'),1); ?>;
}
<?php } ?>

<?php 
#Set site content font size...
if (get_apt_option('site_content_size')) { ?>
.format_text p, .format_text ul, .format_text ol, .format_text strike, .format_text table {
	font-size: <?php create_em(get_apt_option('site_content_size'),1); ?>;
	line-height: <?php create_em(get_apt_option('site_content_size'),1); ?>;
}
.teasers_box p, .teasers_box ul, .teasers_box ol {
	font-size: <?php create_em((get_apt_option('site_content_size')-2),1); ?>;
	line-height: <?php create_em((get_apt_option('site_content_size')+1),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('site_content_font')) { ?>
.format_text p, .format_text ul, .format_text ol, .format_text strike, .format_text table, .teasers_box p, .teasers_box ul, .teasers_box ol  {
	font-family: <?php get_font_list(get_apt_option('site_content_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('post_h2_size')) { ?>
.format_text h2 {
	font-size: <?php create_em(get_apt_option('post_h2_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('post_h2_font')) { ?>
.format_text h2 {
	font-family: <?php get_font_list(get_apt_option('post_h2_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('post_h3_size')) { ?>
.format_text h3 {
	font-size: <?php create_em(get_apt_option('post_h3_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('post_h3_font')) { ?>
.format_text h3 {
	font-family: <?php get_font_list(get_apt_option('post_h3_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('logo_text_size')) { ?>
#header h1#logo, #header p#logo, #top_position_logo h1#logo, #top_position_logo p#logo {
	font-size: <?php create_em(get_apt_option('logo_text_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('logo_text_font')) { ?>
#header h1#logo, #header p#logo, #top_position_logo h1#logo, #top_position_logo p#logo {
	font-family: <?php get_font_list(get_apt_option('logo_text_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('site_tagline_size')) { ?>
#header p#tagline, #top_position_logo p#tagline {
	font-size: <?php create_em(get_apt_option('site_tagline_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('site_tagline_font')) { ?>
#header p#tagline, #top_position_logo p#tagline {
	font-family: <?php get_font_list(get_apt_option('site_tagline_font'),1); ?>;
}
<?php } ?>

<?php 
#Set single post title font size...
if (get_apt_option('sidebar_size')) { ?>
#sidebars {
	font-size: <?php create_em(get_apt_option('sidebar_size'),1); ?>;
}
<?php } 
#Set single post title font...
if (get_apt_option('sidebar_font')) { ?>
#sidebars {
	font-family: <?php get_font_list(get_apt_option('sidebar_font'),1); ?>;
}
<?php } ?>


<?php } //deactivate styling options ?>

<?php  
function get_font_list($font,$display){
	// $fontlist = "'droid serif',arial,helvetica,sans-serif";
	if ($font=='Arimo')
		$fontlist = "arimo,arial,helvetica,sans-serif";
	if ($font=='Droid Serif')
		$fontlist = "'droid serif',arial,helvetica,sans-serif";
	if ($font=='Source Sans Pro')
		$fontlist = "'source sans pro',arial,helvetica,sans-serif";
	if ($font=='Lilita One')
		$fontlist = "'lilita one',arial,helvetica,sans-serif";
	if ($font=='Brawler')
		$fontlist = "brawler,arial,helvetica,sans-serif";
	if ($font=='Headland One')
		$fontlist = "'headland one',arial,helvetica,sans-serif";
	if ($font=='Droid Sans')
		$fontlist = "'droid sans',arial,helvetica,sans-serif";
	if ($font=='News Cycle')
		$fontlist = "'news cycle',arial,helvetica,sans-serif";
	if ($font=='PT Sans Narrow')
		$fontlist = "'pt sans narrow',arial,helvetica,sans-serif";
	if ($font=='Ropa Sans')
		$fontlist = "'ropa sans',arial,helvetica,sans-serif";
	if ($font=='Cabin')
		$fontlist = "cabin,arial,helvetica,sans-serif";
	if ($font=='Cabin Condensed')
		$fontlist = "'cabin condensed',arial,helvetica,sans-serif";
	if ($font=='Corben')
		$fontlist = "corben,arial,helvetica,sans-serif";
	if ($font=='Anton')
		$fontlist = "anton,arial,helvetica,sans-serif";
	if ($font=='Rockitt')
		$fontlist = "rokkitt,arial,helvetica,sans-serif";
	if ($font=='Covered by Your Grace')
		$fontlist = "'covered by your grace',arial,helvetica,sans-serif";
	if ($font=='Open Sans')
		$fontlist = "'open sans',arial,helvetica,sans-serif";
	if ($font=='Open Sans Condensed')
		$fontlist = "'open sans condensed',arial,helvetica,sans-serif";
	if ($font=='Oswald')
		$fontlist = "oswald,arial,helvetica,sans-serif";

	if ($font=='Arial')
		$fontlist = "arial,helvetica,sans-serif";
	if ($font=='Arial Black')
		$fontlist = "'arial black',gadget,sans-serif";
	if ($font=='Comic Sans MS')
		$fontlist = "'comics sans ms',cursive,sans-serif";
	if ($font=='Courier New')
		$fontlist = "'courier new',monospace,helvetica,sans-serif";
	if ($font=='Georgia')
		$fontlist = 'georgia,serif,helvetica,sans-serif';
	if ($font=='Helvetica')
		$fontlist = 'helvetica,\'helvetica neue\',sans-serif';
	if ($font=='Helvetica Neue')
		$fontlist = '\'helvetica neue\',helvetica,sans-serif';
	if ($font=='Impact')
		$fontlist = 'impact,charcoal,helvetica,sans-serif';
	if ($font=='Lucida Console')
		$fontlist = "'lucida console',monaco,monospace,helvetica,sans-serif";
	if ($font=='Lucida Sans Unicode')
		$fontlist = "'lucida sans unicode','lucida grande',helvetica,sans-serif";
	if ($font=='Palatino Linotype')
		$fontlist = "'palatino linotype','book antiqua',helvetica,sans-serif";
	if ($font=='Tahoma')
		$fontlist = "tahoma,geneva,helvetica,sans-serif";
	if ($font=='Times New Roman')
		$fontlist = "'times new roman',times,serif,helvetica,sans-serif";
	if ($font=='Trebuchet MS')
		$fontlist = "'trebuchet ms',helvetica,sans-serif";
	if ($font=='Verdana')
		$fontlist = "verdana,geneva,helvetica,sans-serif";
	if ($font=='MS Sans Serif')
		$fontlist = "'ms sans serif',geneva,helvetica,sans-serif";
	
	if ($display==1) {
		echo $fontlist;
	}else{ return $fontlist; }

}

function create_em($size,$display){
	$em = ($size*.1);
	if ($display==1) {
		echo $em.'em';
	}else{ return $em.'em';}
	 
}

?>

<?php
#Set single post title font...
if (get_apt_option('custom_global_css')) { echo get_apt_option('custom_global_css'); } 
?>