<?php

if (function_exists('get_apt_option')) {
	$apevo_design['removePoweredBy'] = get_apt_option( 'remove_powered_by' );
	$apevo_design['poweredByAffLink'] = get_apt_option( 'replace_poweredby_afflink' );
	$apevo_design['footerLinksHTML'] = get_apt_option( 'footer_links_html' );
}

/**
 * Call footer elements.
 */
function apevo_footer_area() {
	apevo_hook_before_footer();
	apevo_footer();
	apevo_hook_after_footer();
}

/**
 * Display primary footer content.
 */
function apevo_footer() {
	echo "\t<div id=\"footer\">\n";
	apevo_hook_footer();
	//apevo_admin_link();
	apevo_footer_links();
	//wp_footer();
	echo "\t</div>\n";
}

function apevo_footer_links() {
global $apevo_design;
if ( class_exists("WarriorMember") ) {
	$powered_by_name = 'Warrior Press';
	$powered_by_link = 'http://warriorpress.com';
}else{
	$powered_by_name = 'Ultimate Video Curator';
	$powered_by_link = 'http://ultimatevideocurator.com';
}
	echo "\t<div id=\"footer_links\">\n";
		echo "\t<div class=\"left\">\n";
			//echo " &copy; ".the_time('Y');" <a href=\"".get_bloginfo('siteurl')."\">".get_option('mc_seomainkey')."</a>."._e('All rights reserved', 'authoritypro')."";?>
			&copy; <?php the_time('Y'); ?> <a href="<?php bloginfo('siteurl'); ?>"><?php echo get_option('mc_seomainkey'); ?></a> - <?php _e('All rights reserved.', 'authoritypro'); ?>
			<?php
		echo "\t</div>\n";
		echo "\t<div class=\"right\">\n"; ?>
			<?php if (is_single()){if(get_custom_field('media-seo-mainkey',false) != '') {?><a href="<?php the_permalink();?>" title="<?php get_custom_field('media-seo-mainkey',true);?>"><?php get_custom_field('media-seo-mainkey',true);?></a><?php }};?>
<?php if ($apevo_design['removePoweredBy']){}else{ _e(' Proudly Powered by ', 'authoritypro'); if ($apevo_design['poweredByAffLink']) {?><a href="<?php echo $apevo_design['poweredByAffLink']; ?>"><?php echo $powered_by_name; ?></a><?php }else{?><a href="<?php echo $powered_by_link; ?>"><?php _e($powered_by_name, 'authoritypro'); ?></a>	<?php } /*pb aff link*/?><br style="padding:0 0 7px 0" /><?php } ?>
<?php if ($apevo_design['footerLinksHTML']) echo '<div id="htmlfooterlinks">'.stripslashes($apevo_design['footerLinksHTML']).'</div>'; ?>
		<?php
		echo "\t</div>\n";
	echo "\t</div>\n";
	
	echo "<div style='clear:both;'></div>";
	
	
}

/**
 * Display default Thesis attribution.
 */
function apevo_attribution() {
	echo "\t\t<p>" . sprintf(__('Get smart with the <a href="%s">Thesis WordPress Theme</a> from DIYthemes.', 'thesis'), 'http://diythemes.com/thesis/') . "</p>\n";
}