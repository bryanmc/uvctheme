<?php
if (function_exists('get_apt_option')) {
   $apevo_design['hideHeaderMenus'] = get_apt_option( 'hide_header_menus' );
   $apevo_design['removeBlogHeader'] = get_apt_option( 'remove_blog_header' );
}

// Register sidebars and widgets
apevo_register_sidebars();
apevo_register_widgets();

function apevo_register_sidebars() {

	// register_sidebar( array(
	// 	'name' => __( 'Header Widget Area (Full Width)', 'apevo' ),
	// 	'id' => 'header-widget-area',
	// 	'description' => __( 'Located Directly Under the Secondary Nav Menu, Spanning the Full Width of the Header.', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Header Widget Area 1', 'apevo' ),
	// 	'id' => 'header-widget-area1',
	// 	'description' => __( 'Located directly under header widget area full width and spans 25% of the header area', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Header Widget Area 2', 'apevo' ),
	// 	'id' => 'header-widget-area2',
	// 	'description' => __( 'Located directly under header widget area full width and spans 25% of the header area after area 1', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Header Widget Area 3', 'apevo' ),
	// 	'id' => 'header-widget-area3',
	// 	'description' => __( 'Located directly under header widget area full width and spans 25% of the header area after area 2', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Header Widget Area 4', 'apevo' ),
	// 	'id' => 'header-widget-area4',
	// 	'description' => __( 'Located directly under header widget area full width and spans 25% of the header area after area 3', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	    
    register_sidebar(array(
    	'name'			=> 'Sidebar Widget 1',
		'id' => 'sidebar-position-1',
		'description' => __( 'Located in 1st position in the sidebar', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3><span>',
    	'after_title'	=> '</span></h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Sidebar Widget 2',
		'id' => 'sidebar-position-2',
		'description' => __( 'Located in 2nd position in the sidebar', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3><span>',
    	'after_title'	=> '</span></h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Inner Sidebar Left Half',
		'id' => 'sidebar-inner-left',
		'description' => __( 'Left inner sidebar, after sidebar position 2', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3><span>',
    	'after_title'	=> '</span></h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Inner Sidebar Right Half',
		'id' => 'sidebar-inner-right',
		'description' => __( 'Right inner sidebar, after sidebar position 2', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3><span>',
    	'after_title'	=> '</span></h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Sidebar Widget 3',
		'id' => 'sidebar-position-3',
		'description' => __( 'Located in 3rd position in the sidebar', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3><span>',
    	'after_title'	=> '</span></h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Sidebar Widget 4',
		'id' => 'sidebar-position-4',
		'description' => __( 'Located in 4th position in the sidebar', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3><span>',
    	'after_title'	=> '</span></h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Top of Post Area',
		'id' => 'top-post-widget-area',
		'description' => __( 'Located directly above the post and spans the full width of the content/post box', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>',
    	'before_title'	=> '<h3>',
    	'after_title'	=> '</h3>',
    ));
    
    register_sidebar(array(
    	'name'			=> 'Inner Post Area',
		'id' => 'inner-post-widget-area',
		'description' => __( 'Appears anywhere you put the [postwidget] shortcode inside a post or page', 'apevo' ),
        'before_widget'	=> '<li class="widget %2$s" id="%1$s">',
        'after_widget'	=> '</li>	',
    	'before_title'	=> '<h3>',
    	'after_title'	=> '</h3>',
    ));
    
    register_sidebar( array(
		'name' => __( 'Bottom of Posts Area', 'apevo' ),
		'id' => 'bottom-post-widget-area',
		'description' => __( 'Located Directly Under Bottom Of Post', 'apevo' ),
		'before_widget' => '<li class="widget %2$s" id="%1$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
	) );
    
	
	// register_sidebar( array(
	// 	'name' => __( 'Footer Widget Area', 'apevo' ),
	// 	'id' => 'footer-widget-area',
	// 	'description' => __( 'Located in the blog footer area.', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Footer Widget Area 1', 'apevo' ),
	// 	'id' => 'footer-widget-area1',
	// 	'description' => __( 'Located directly under footer widget area full width and spans 25% of the footer area', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Footer Widget Area 2', 'apevo' ),
	// 	'id' => 'footer-widget-area2',
	// 	'description' => __( 'Located directly under footer widget area full width and spans 25% of the footer area after area 1', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	// register_sidebar( array(
	// 	'name' => __( 'Footer Widget Area 3', 'apevo' ),
	// 	'id' => 'footer-widget-area3',
	// 	'description' => __( 'Located directly under footer widget area full width and spans 25% of the footer area after area 2', 'apevo' ),
	// 	'before_widget' => '<li class="widget %2$s" id="%1$s">',
	// 	'after_widget' => '</li>',
	// 	'before_title' => '<h3><span>',
	// 	'after_title' => '</span></h3>',
	// ) );
	
	/*register_sidebar( array(
		'name' => __( 'Footer Widget Area 4', 'apevo' ),
		'id' => 'footer-widget-area4',
		'description' => __( 'Located directly under footer widget area full width and spans 25% of the footer area after area 3', 'apevo' ),
		'before_widget' => '<li class="widget %2$s" id="%1$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
	) );*/
    
	
	
	/*register_sidebars(2,
		array(
			'name' => 'Sidebar %d',
			'before_widget' => '<li class="widget %2$s" id="%1$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);*/
}

function apevo_register_widgets() {
	register_sidebar_widget(__('Search', 'apevo'), 'apevo_widget_search');
	register_widget_control(__('Search', 'apevo'), 'apevo_widget_search_control');
	register_sidebar_widget(__('Subscriptions', 'apevo'), 'apevo_widget_subscriptions');
	register_widget_control(__('Subscriptions', 'apevo'), 'apevo_widget_subscriptions_control');
	register_sidebar_widget(__('Google Custom Search', 'apevo'), 'apevo_widget_google_cse');
	register_widget_control(__('Google Custom Search', 'apevo'), 'apevo_widget_google_cse_control');
	add_action('widgets_init', 'apevo_register_multiple_widgets');
}

//add_action( 'wp_footer', 'show_my_sidebars' );

function show_my_sidebars()
{
    $sw = get_option( 'sidebars_widgets' );
    print '<pre>' . htmlspecialchars( print_r( $sw, TRUE ) ) . '</pre>';
}

/* !Disable the Admin Bar. */
add_filter( 'show_admin_bar', '__return_false' );

function apevo_hide_admin_bar_settings() {
?>
	<style type="text/css">
		.show-admin-bar {
			display: none;
		}
	</style>
<?php
}

function apevo_disable_admin_bar() {
    add_filter( 'show_admin_bar', '__return_false' );
    add_action( 'admin_print_scripts-profile.php',
         'apevo_hide_admin_bar_settings' );
}
add_action( 'init', 'apevo_disable_admin_bar' , 9 );

/* Deconstruct the WordPress header to make way for APEvo pwnage */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/* !languages */
load_theme_textdomain('authoritypro', TEMPLATEPATH.'/languages/');

/* !Do some WP 3 stuff... */
if (function_exists('create_initial_post_types')) create_initial_post_types(); //fix for wp 3.0
if (function_exists('add_custom_background')) add_custom_background();
if (function_exists('add_post_type_support')) add_post_type_support( 'page', 'excerpt' );
add_theme_support( 'post-thumbnails');

/* !Wordpress Nav Menus */
add_action( 'init', 'tj_register_my_menu' );

function tj_register_my_menu() {
   register_nav_menus(
      array(
         'header-pages' => __( 'Primary Menu', 'authoritypro' ),
         'header-cats' => __( 'Secondary Menu', 'authoritypro' )
      )
   );
}

add_action('apevo_hook_before_header_page_area', 'apevo_nav_menu');

//Header Ad...
add_action('apevo_hook_header', 'header_ad_468x60');

add_action('apevo_hook_after_header', 'apevo_secondary_nav_menu');
add_action('apevo_hook_after_header', 'header_widgets_area');
//add_action('apevo_hook_after_header', 'header_widgets_area1');
//add_action('apevo_hook_after_header', 'header_widgets_area2');
//add_action('apevo_hook_after_header', 'header_widgets_area3');
//add_action('apevo_hook_after_header', 'header_widgets_area4');

// Construct the Default APEvo header
add_action('apevo_hook_header', 'apevo_default_header');

// Post hooks
add_action('apevo_hook_after_post', 'apevo_post_tags');
#todo:: add_action('apevo_hook_after_post', 'apevo_comments_link');

// Content hooks
add_action('apevo_hook_post_box_top', 'apevo_build_thumbnail');
add_action('apevo_hook_post_box_top', 'apevo_links_star_wrapper_open');
add_action('apevo_hook_post_box_top', 'apevo_feature_star_rating');
add_action('apevo_hook_post_box_top', 'apevo_feature_affiliate_links');
add_action('apevo_hook_post_box_top', 'apevo_links_star_wrapper_close');

add_action('apevo_hook_before_teaser', 'apevo_build_teaser_thumbnail');
add_action('apevo_hook_after_content', 'apevo_post_navigation');
add_action('apevo_hook_after_content', 'apevo_prev_next_posts');



//Widget Area Hooks
add_action('apevo_hook_before_post_box', 'top_of_post_area_widgets_area');
add_action('apevo_hook_after_post_box', 'bottom_of_post_area_widgets_area');

//Author Box
add_action('apevo_hook_after_post_box', 'apevo_author_box');

add_action('apevo_hook_footer', 'footer_widgets_area');


// Use apevo image captioning
remove_shortcode('wp_caption');
remove_shortcode('caption');
add_shortcode('wp_caption', 'apevo_img_caption_shortcode');
add_shortcode('caption', 'apevo_img_caption_shortcode');

// Add the Top Positioned Logo & Action Tab
add_action('apevo_hook_before_primary_nav_menu', 'apevo_action_tab');
add_action('apevo_hook_before_primary_nav_menu','apevo_top_title_and_tagline');

// Custom page template sample
add_action('apevo_hook_custom_template', 'apevo_custom_template_sample');

// Footer hooks
#todo:: add_action('apevo_hook_footer', 'apevo_attribution');

// 404 page hooks
add_action('apevo_hook_404_title', 'apevo_404_title');
add_action('apevo_hook_404_content', 'apevo_404_content');

// Archives page template hook
add_action('apevo_hook_archives_template', 'apevo_archives_template');



/* !Custom Dashboard Widget... */


function apevo_widget_show_hide(){

echo "
<script type=\"text/javascript\">
jQuery(document).ready(function() {
   jQuery('div#ccw_custom_styling_options').show();
 });
 
 jQuery(document).ready(function($) {
   $('input[id=toggleh1]').click(function(){
		$('div#ccw_custom_styling_options').toggle();
		alert('toggleh1');
	});
   $('#hideh1').click(function(){
     $('div.showhide,h1').hide();
   });
   $('#showh1').click(function(){
     $('div.showhide,h1').show();
   });
   $('#toggleh1').click(function(){
     $('div.showhide,h1').toggle();
   });
 });
</script>
";
}
add_action("admin_head", "apevo_widget_show_hide");

if ( !class_exists("WarriorMember") )
	add_action('wp_dashboard_setup', 'apevo_custom_dashboard_widgets');

    function apevo_custom_dashboard_widgets() {
    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_help_widget', 'Ultimate Video Curator', 'apevo_custom_dashboard_help');
    }

    function apevo_custom_dashboard_help() {
    echo '<p>Welcome to Ultimate Video Curator!  If you need to contact support, you can contact them <a href="mailto:support@ultimatevideocurator.com">here</a>. 
    For all the latest news and training login to the members area: 
    <a href="http://www.fueledpublishing.com/lab" target="_blank">UVC Members Area.</a></p>';
    }