<?php

// Define directory constants
define('APEVO_LIB', TEMPLATEPATH . '/lib');
#define('APEVO_ADMIN', APEVO_LIB . '/admin');
define('APEVO_CLASSES', APEVO_LIB . '/classes');
define('APEVO_FUNCTIONS', APEVO_LIB . '/functions');
define('APEVO_CSS', APEVO_LIB . '/css');
define('APEVO_HTML', APEVO_LIB . '/html');
define('APEVO_SCRIPTS', APEVO_LIB . '/scripts');
define('APEVO_IMAGES', APEVO_LIB . '/images');
define('APEVO_CUSTOM', TEMPLATEPATH . '/custom');

// Define folder constants
define('APEVO_CSS_FOLDER', get_bloginfo('template_url') . '/lib/css'); #wp
define('APEVO_SCRIPTS_FOLDER', get_bloginfo('template_url') . '/lib/scripts'); #wp
define('APEVO_IMAGES_FOLDER', get_bloginfo('template_url') . '/lib/images'); #wp

if (file_exists(APEVO_CUSTOM)) {
	define('APEVO_CUSTOM_FOLDER', get_bloginfo('template_url') . '/custom'); #wp
	define('APEVO_LAYOUT_CSS', APEVO_CUSTOM . '/layout.css');
	define('APEVO_ROTATOR', APEVO_CUSTOM . '/rotator');
	define('APEVO_ROTATOR_FOLDER', APEVO_CUSTOM_FOLDER . '/rotator');
}
elseif (file_exists(TEMPLATEPATH . '/custom-sample')) {
	define('APEVO_SAMPLE_FOLDER', get_bloginfo('template_url') . '/custom-sample'); #wp
	define('APEVO_LAYOUT_CSS', TEMPLATEPATH . '/custom-sample/layout.css');
	define('APEVO_ROTATOR', TEMPLATEPATH . '/custom-sample/rotator');
	define('APEVO_ROTATOR_FOLDER', APEVO_SAMPLE_FOLDER . '/rotator');
}

// Load classes
require_once(APEVO_CLASSES . '/head.php');
require_once(APEVO_CLASSES . '/loop.php');
require_once(APEVO_CLASSES . '/javascript.php');
require_once(APEVO_CLASSES . '/class-uvc.php');

// Load function files
require_once(APEVO_FUNCTIONS . '/launch.php');
require_once(APEVO_FUNCTIONS . '/helpers.php');
require_once(APEVO_FUNCTIONS . '/document.php');
require_once(APEVO_FUNCTIONS . '/nav_menu.php');
require_once(APEVO_FUNCTIONS . '/content.php');
require_once(APEVO_FUNCTIONS . '/teasers.php');
require_once(APEVO_FUNCTIONS . '/widgets.php');
require_once(APEVO_FUNCTIONS . '/post_images.php');
require_once(APEVO_FUNCTIONS . '/custom_fields.php');
require_once(APEVO_FUNCTIONS . '/theme_options.php');
require_once(APEVO_FUNCTIONS . '/uvc-widgets/top-posts-lists.php');
require_once(APEVO_FUNCTIONS . '/uvc-widgets/recent-posts-lists.php');
require_once(APEVO_FUNCTIONS . '/uvc-launch.php');

// Load HTML frameworks
require_once(APEVO_HTML . '/header.php');
require_once(APEVO_HTML . '/frameworks.php');
require_once(APEVO_HTML . '/content_box.php');
require_once(APEVO_HTML . '/sidebars.php');
require_once(APEVO_HTML . '/templates.php');
require_once(APEVO_HTML . '/hooks.php');
require_once(APEVO_HTML . '/footer.php');

// Include the user's custom_functions file, but only if it exists
if (file_exists(APEVO_CUSTOM . '/custom_functions.php'))
	include_once(APEVO_CUSTOM . '/custom_functions.php');


?>