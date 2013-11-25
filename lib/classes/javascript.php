<?php
/**
 * class apevo_javascript
 *
 * @package Thesis
 * @since 1.7
 */
if (function_exists('get_apt_option')) {	
	
	$apevo_scripts['insertTrackingCode'] = get_apt_option( 'insert_tracking_code' );
	$apevo_scripts['adTrackingCode'] = get_apt_option( 'ad_tracking_code' );
	$apevo_scripts['siteTrackingCode'] = get_apt_option( 'ad_tracking_code' );	
} 
 
class apevo_javascript {
	var $libs = array(
		'jquery' => array(
			'name' => 'jQuery',
			'url' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
			'info_url' => 'http://jquery.com/'
		),
		'jquery_ui' => array(
			'name' => 'jQuery UI',
			'url' => 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js',
			'info_url' => 'http://jqueryui.com/'
		),
		'prototype' => array(
			'name' => 'Prototype',
			'url' => 'http://ajax.googleapis.com/ajax/libs/prototype/1.6.1.0/prototype.js',
			'info_url' => 'http://www.prototypejs.org/'
		),
		'scriptaculous' => array(
			'name' => 'script.aculo.us',
			'url' => 'http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.3/scriptaculous.js',
			'info_url' => 'http://script.aculo.us/'
		),
		'mootools' => array(
			'name' => 'MooTools',
			'url' => 'http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js',
			'info_url' => 'http://mootools.net/'
		),
		'dojo' => array(
			'name' => 'Dojo',
			'url' => 'http://ajax.googleapis.com/ajax/libs/dojo/1.4.1/dojo/dojo.xd.js',
			'info_url' => 'http://dojotoolkit.org/'
		),
		'yui' => array(
			'name' => 'Yahoo! User Interface (YUI)',
			'url' => 'http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/yuiloader/yuiloader-min.js',
			'info_url' => 'http://developer.yahoo.com/yui/'
		),
		'ext' => array(
			'name' => 'Ext Core',
			'url' => 'http://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js',
			'info_url' => 'http://www.extjs.com/products/extcore/'
		),
		'chrome' => array(
			'name' => 'Chrome Frame',
			'url' => 'http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js',
			'info_url' => 'http://code.google.com/chrome/chromeframe/'
		)
	);

	function output_scripts() {
		$javascript = new apevo_javascript;
		global $apevo_scripts, $apevo_site, $apevo_design, $wp_query;
		$design_scripts = ($apevo_design->javascript['scripts']) ? $apevo_design->javascript['scripts'] . "\n" : '';
		$user_scripts = ($apevo_site->javascript['scripts']) ? $apevo_site->javascript['scripts'] : '';

		if ($wp_query->is_home || is_front_page()) {
			if (get_option('show_on_front') == 'page') $page_id = (is_front_page()) ? get_option('page_on_front') : get_option('page_for_posts');
			$libs = ($page_id) ? get_post_meta($page_id, 'apevo_javascript_libs', true) : $apevo_design->home['javascript']['libs'];
			$page_scripts = ($page_id) ? get_post_meta($page_id, 'apevo_javascript_scripts', true) : $apevo_design->home['javascript']['scripts'];
		}
		elseif ($wp_query->is_page || $wp_query->is_single) { #wp
			global $post; #wp
			$libs = get_post_meta($post->ID, 'apevo_javascript_libs', true);
			$page_scripts = get_post_meta($post->ID, 'apevo_javascript_scripts', true);
		}

		if (is_array($apevo_design->javascript['libs'])) {
			foreach ($apevo_design->javascript['libs'] as $lib_name => $include) {
				if ((isset($libs[$lib_name]) && $libs[$lib_name]) || (!isset($libs[$lib_name]) && $include))
					$output[$lib_name] = '<script type="text/javascript" src="' . $javascript->libs[$lib_name]['url'] . '"></script>';
			}
			if ($output) echo implode("\n", $output) . "\n";
		}

		$scripts = ($page_scripts) ? "$design_scripts$page_scripts\n$user_scripts" : "$design_scripts$user_scripts";
		if ($scripts != '') echo stripslashes($scripts) . "\n";

		
		if ($wp_query->is_single && get_post_meta($post->ID,'dont-use-lightbox', true) == '' && get_post_meta($post->ID,'training-video-embed', true) !='') {
		?>
			<script type="text/javascript">
		    
		      jQuery.noConflict();
		    
		      jQuery(function(){
		    
		            jQuery.fn.getTitle = function() {
		          var arr = jQuery("a.fancybox");
		          jQuery.each(arr, function() {
		            var title = jQuery(this).children("img").attr("title");
		            jQuery(this).attr('title',title);
		          })
		        }
		    
		        // Supported file extensions
		        var thumbnails = 'a:has(img)[href$=".bmp"],a:has(img)[href$=".gif"],a:has(img)[href$=".jpg"],a:has(img)[href$=".jpeg"],a:has(img)[href$=".png"],a:has(img)[href$=".BMP"],a:has(img)[href$=".GIF"],a:has(img)[href$=".JPG"],a:has(img)[href$=".JPEG"],a:has(img)[href$=".PNG"]';
		    
		      
		        jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();
		    
		          jQuery("a.fancybox").fancybox({
		          'imageScale': true,
		          'padding': 10,
		          'zoomOpacity': true,
		          'zoomSpeedIn': 500,
		          'zoomSpeedOut': 500,
		          'zoomSpeedChange': 300,
		          'overlayShow': true,
		          'overlayColor': "#666666",
		          'overlayOpacity': 0.3,
		          'enableEscapeButton': true,
		          'showCloseButton': true,
		          'hideOnOverlayClick': false,
		          'hideOnContentClick': false,
		          'frameWidth':  <?php get_custom_field('training-video-width', TRUE); ?>,
		          'frameHeight': <?php get_custom_field('training-video-height', TRUE); ?>,
		          'callbackOnStart': null,
		          'callbackOnShow': null,
		          'callbackOnClose': null,
		          'centerOnScroll': true
		        });
		    
		    })
		    
		    </script>
		<?php
		}
		
		if ($wp_query->is_single && get_post_meta($post->ID,'activate-targeted-exit', true) == '1') {
			$targetedexitmessageslashed = addslashes(get_custom_field('targeted-exit-message',false));
    		$authorityexitscripturl = plugins_url().'/authorityproengine/library/scripts/authorityexit.php';?>
        	<!-- Authority Exit Script Begin -->
        	<script language="javascript">
        	var authorityexittext = '<?php echo $targetedexitmessageslashed ?>';
        	var authorityexiturl = '<?php get_custom_field('targeted-exit-url',true); ?>';
        	</script>
        	<script language="javascript" src="<?php echo $authorityexitscripturl ?>"></script>
        	<!-- Authority Exit Script End -->
		<?php
		}elseif (is_active_sidebar( 'footer-scripts-area' )){		
			dynamic_sidebar( 'footer-scripts-area' );
		}
		
		if($apevo_scripts['insertTrackingCode'] == 'Yes') { ?><?php echo stripslashes($apevo_scripts['adTrackingCode']); ?><?php }
	}
}