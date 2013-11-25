<?php
/*
Todos:
- Basic thumbnail options
- show on single or not?
- use video thumbnail as thumb if post has video in it
*/

if (function_exists('get_apt_option')) {
   $apevo_design['thumbnails']['show'] = get_apt_option( 'thumbnails_show' );
   $apevo_design['thumbnails']['single']['show'] = get_apt_option( 'thumbnails_single_show' );
   if (get_apt_option( 'feature_thumbnail_width' ))
   	$apevo_design['feature']['thumbnail']['width'] = get_apt_option( 'feature_thumbnail_width' );
   else	
   	$apevo_design['feature']['thumbnail']['width'] = 140;
   if (get_apt_option( 'feature_thumbnail_height' ))
   	$apevo_design['feature']['thumbnail']['height'] = get_apt_option( 'feature_thumbnail_height' );
   else	
   	$apevo_design['feature']['thumbnail']['height'] = 140;	
   $apevo_design['link']['thumbnails'] = get_apt_option( 'link_thumbnails' );
   
}

// Show Front Page Post Thumbnails
function fpp_show_thumb($width = 140, $height = 140, $link) {
	if ($link == 'Yes') { ?>
	<a href="<?php the_permalink() ?>" rel="bookmark"><img class="thumb" src="<?php bloginfo('template_directory'); ?>/includes/timthumb.php?src=<?php tj_get_image($post->ID, 'full'); ?>&amp;h=<?php echo $height; ?>&amp;w=<?php echo $width; ?>&amp;zc=1" alt="<?php the_title(); ?>" /></a>
<?php } else { ?>
	<img class="thumb" src="<?php bloginfo('template_directory'); ?>/includes/timthumb.php?src=<?php tj_get_image($post->ID, 'full'); ?>&amp;h=<?php echo $height; ?>&amp;w=<?php echo $width; ?>&amp;zc=1" alt="<?php the_title(); ?>" />
<?php }
}

// Thumbnails, yo...
function apevo_thumbnail($height=140, $width=140, $link=1, $nofollow=1, $display=true, $class='') {
	global $post;
	if ($nofollow=1)
		$linknofollow = " rel=\"nofollow\"";		
	if ($link!=0)
		$linkstart = "<a href=\"".get_permalink($post->ID)."\" $linknofollow title=\"".get_the_title($post->ID)."\">";
		$linkend = "</a>";		
	if ($class)
		$class = ' '.$class;
	
	$image = get_bloginfo('template_directory').'/lib/images/timthumb.php?src='.apevo_get_image($post->ID, 'full').'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1';
	if ($display==true){
		echo "<div class=\"post-thumb\">";
		apevo_hook_before_post_thumb();
		echo $linkstart;
		echo "<img class=\"thumb$class\" src=\"$image\" width=\"$width\" height=\"$height\" />";
		echo $linkend;
		apevo_hook_after_post_thumb();
		echo "</div>";
	}
}

function apevo_build_thumbnail(){
	global $apevo_design, $wp_query;
	$width = $apevo_design['feature']['thumbnail']['width'];
	$height = $apevo_design['feature']['thumbnail']['height'];
	
	// if ( $apevo_design['thumbnails']['show'] =='No' || ($wp_query->is_single && $apevo_design['thumbnails']['single']['show'] == 'No') || $wp_query->is_page)
	// 	$display=false;
	// else
	// 	$display=true;
	
	if ($wp_query->is_single)
		$link=0;
	else
		$link=1;
		
	apevo_thumbnail($height,$width,$link,1,$display);
}

function apevo_build_teaser_thumbnail(){
	global $apevo_design, $wp_query;
	if ( $apevo_design['thumbnails']['show'] =='No' || ($wp_query->is_single && $apevo_design['thumbnails']['single']['show'] == 'No') || $wp_query->is_page)
		$display=false;
	else
		$display=true;
	
	if ($wp_query->is_single)
		$link=0;
	else
		$link=1;
	
	/*if ($apevo_design['link']['nofollow']['thumbnails'] == 'No' )
		$thumbnofollow=false;
	else
		$thumbnofollow=true;	*/
		
	apevo_thumbnail(170,298,$link,1,$display);
}

function apevo_build_widget_thumbnail($size,$class){
	global $apevo_design, $wp_query;
	if ( $apevo_design['thumbnails']['show'] =='No'/* || ($wp_query->is_single && $apevo_design['thumbnails']['single']['show'] != 'Yes') || $wp_query->is_page*/)
		$display=false;
	else
		$display=true;
	
	if ($apevo_design['link']['thumbnails'] !='Yes')
		$link=0;
	elseif ($wp_query->is_single)
		$link=0;
	else
		$link=1;
	
	apevo_thumbnail($size,$size,$link,1,$display,$class);
}

// Get Image Attachments from Posts
function apevo_get_image($postid=0, $size='full') {
	if ($postid<1) 
	$postid = get_the_ID();
	$thumb = get_post_meta($postid, "thumb", TRUE); // Declare the custom field for the image
	/*
if ($thumb != null or $thumb != '') {
		echo $thumb; 
	}
*/	if (has_post_thumbnail( $postid ) ){
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'single-post-thumbnail' );
		return $thumbnail[0];
	}
	elseif ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => '1',
		'post_mime_type' => 'image', )))
		foreach($images as $image) {
			$thumbnail=wp_get_attachment_image_src($image->ID, $size);
			?>
	<?php return $thumbnail[0]; ?>
	<?php }
		else {
		return get_bloginfo ( 'stylesheet_directory' ).'/lib/images/image-pending.gif';		
	}
}

function apevo_post_image_info($type = 'image') {
	global $post, $apevo_design;

	$image_string = ($type == 'image') ? 'post_image' : 'thumb';
	#mod:: $image_url = get_post_meta(get_the_id(), 'apevo_' . $image_string, true);
	$image_url = get_post_meta(get_the_id(), 'apevo_' . $image_string, true);
	
	$post_image['type'] = $type;

	if ($type == 'thumb' && $image_url != '') {
		$post_image['show'] = true;
		$post_image['url'] = $image_url;
		$post_image['resize'] = false;
	}
	elseif ($type == 'thumb') {
		$image_url = get_post_meta(get_the_id(), 'apevo_post_image', true);

		if ($image_url != '') {
			$post_image['show'] = true;
			$post_image['url'] = $image_url;
			$post_image['resize'] = true;
		}
		else
			$post_image['show'] = false;
	}
	elseif ($image_url != '') {
		$post_image['url'] = $image_url;
		$post_image['resize'] = false;
	}

	if ($type == 'image' && $post_image['url'] != '') {
		$post_image['show'] = ((is_single() && !$apevo_design->image['post']['single']) || (is_archive() && !$apevo_design->image['post']['archives'])) ? false : true;

		if ($post_image['show']) {
			$image_vertical_override = get_post_meta(get_the_id(), 'apevo_post_image_vertical', true);
			$post_image['y'] = ($image_vertical_override) ? $image_vertical_override : $apevo_design->image['post']['y'];
			$image_horizontal_override = get_post_meta(get_the_id(), 'apevo_post_image_horizontal', true);	
			$post_image['x'] = ($image_horizontal_override != '') ? $image_horizontal_override : $apevo_design->image['post']['x'];
			$frame_override = get_post_meta(get_the_id(), 'apevo_' . $image_string . '_frame', true);
			$post_image['frame'] = ($frame_override != '' && $frame_override != $apevo_design->image['post']['frame']) ? $frame_override : $apevo_design->image['post']['frame'];
		}
	}
	elseif ($type == 'thumb' && $post_image['url'] != '') {
		$thumb_vertical_override = get_post_meta(get_the_id(), 'apevo_thumb_vertical', true);
		$post_image['y'] = ($thumb_vertical_override) ? $thumb_vertical_override : $apevo_design->image['thumb']['y'];
		$image_horizontal_override = get_post_meta(get_the_id(), 'apevo_thumb_horizontal', true);
		$post_image['x'] = ($image_horizontal_override != '') ? $image_horizontal_override : $apevo_design->image['thumb']['x'];
		$frame_override = get_post_meta(get_the_id(), 'apevo_' . $image_string . '_frame', true);
		$post_image['frame'] = ($frame_override != '' && $frame_override != $apevo_design->image['thumb']['frame']) ? $frame_override : $apevo_design->image['thumb']['frame'];
	}
	else
		$post_image['show'] = false;

	if ($post_image['show'] && $post_image['url'] != '') {
		if ($apevo_design->image['fopen'])
			$image_path = $post_image['url'];
		else {
			$local_path = explode($_SERVER['SERVER_NAME'], $post_image['url']);
			$image_path = $_SERVER['DOCUMENT_ROOT'] . $local_path[1];
		}

		$post_image['alt'] = get_post_meta(get_the_id(), 'apevo_' . $image_string . '_alt', true);

		if (@getimagesize($image_path)) {
			$image['class'] = apevo_get_image_classes($post_image);
			$image['attributes'] = apevo_image_attributes($post_image);

			if ($post_image['alt'] != '')
				$image['alt'] = $post_image['alt'];
			elseif ($type == 'thumb')
				$image['alt'] = 'Thumbnail image for ' . get_the_title();
			else
				$image['alt'] = 'Post image for ' . get_the_title();

			if (is_single() || is_page()) {
				$open_link = '';
				$close_link = '';
			}
			else {
				$open_link = '<a class="post_image_link" href="' . get_permalink() . '" title="Permanent link to ' . get_the_title() . '">';
				$close_link = '</a>';
			}

			$post_image['output'] = $open_link . '<img ' . $image['class'] . $image['attributes'] . ' alt="' . $image['alt'] . '" />' . $close_link . "\n";
		}
	}

	return $post_image;
}

function apevo_get_image_classes($post_image) {
	$classes['image'] = ($post_image['type'] == 'image') ? 'post_image' : 'thumb';

	if ($post_image['x'] == 'flush')
		$classes['position'] = 'alignnone';
	elseif ($post_image['x'] == 'left')
		$classes['position'] = 'alignleft';
	elseif ($post_image['x'] == 'right')
		$classes['position'] = 'alignright';
	elseif ($post_image['x'] == 'center')
		$classes['position'] = 'aligncenter';
		
	if ($post_image['y'] == 'after-headline')
		$classes['margin'] = 'remove_bottom_margin';
	
	if ($post_image['frame'] == 'on' || $post_image['frame'] == 1)
		$classes['frame'] = 'frame';
	
	if ($classes)
		return 'class="' . implode(' ', $classes) . '" ';
}

function apevo_image_attributes($post_image) {
	if ($post_image['url']) {
		global $apevo_design;

		if ($post_image['type'] == 'thumb' && $post_image['resize']) {
			$dimensions = array(
				'width' => $apevo_design->image['thumb']['width'],
				'height' => $apevo_design->image['thumb']['height']
			);

			$width_override = get_post_meta(get_the_id(), 'apevo_thumb_width', true);
			$height_override = get_post_meta(get_the_id(), 'apevo_thumb_height', true);

			if ($width_override != '')
				$dimensions['width'] = $width_override;
			if ($height_override != '')
				$dimensions['height'] = $height_override;

			$image['width'] = $dimensions['width'];
			$image['height'] = $dimensions['height'];
			$image['url'] = apevo_SCRIPTS_FOLDER . '/thumb.php?src=' . urlencode($post_image['url']) . '&amp;w=' . $image['width'] . '&amp;h=' . $image['height'] . '&amp;zc=1&amp;q=100';
		}
		else {
			$image['url'] = $post_image['url'];
			$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
			$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
			$image_info = @getimagesize($image_path);

			// If we cannot get the image locally, try for an external URL
			if (!$image_info && $apevo_design->image['fopen'])
				$image_info = @getimagesize($image['url']);

			$image['width'] = $image_info[0];
			$image['height'] = $image_info[1];
		}

		return 'src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '"';
	}
}

function apevo_add_image_to_feed($content) {
	if (is_feed()) {
		$post_image = apevo_post_image_info('image');		
		return '<p>' . $post_image['output'] . '</p>' . $content;
	}
	else
		return $content;
}

function apevo_max_post_image_width($frame = false) {
	global $apevo_design;
	$apevo_css = new apevo_CSS;
	$apevo_css->baselines();
	return ($frame) ? $apevo_design->layout['widths']['content'] - $apevo_css->line_heights['content'] : $apevo_design->layout['widths']['content'];
}