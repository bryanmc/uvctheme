<?php
if (function_exists('get_apt_option')) {
  $apevo_design['columns'] = get_apt_option( 'number_of_columns' );
 }

function apevo_sidebars() {
	echo "\t\t<div id=\"sidebars\">\n";
	apevo_hook_before_sidebars(); #hook
	apevo_build_sidebars();
	apevo_hook_after_sidebars(); #hook
	echo "\t\t</div>\n";
}

function apevo_build_sidebars() {
	global $apevo_design;
	if ($apevo_design['columns'] == 2)
		apevo_get_sidebar(1);
	else
		apevo_get_sidebar();
}

/*function apevo_build_sidebars() {
	global $apevo_design;

	#dropped:: if (apevo_show_multimedia_box())
		#dropped:: apevo_multimedia_box();

	if ($apevo_design['columns'] == 3 && $apevo_design->layout['order'] == 'invert')
		apevo_get_sidebar(2);
	elseif ($apevo_design['columns'] == 3 || $apevo_design['columns'] == 1 || $_GET['template']) {
		apevo_get_sidebar();
		apevo_get_sidebar(2);
	}
	else
		apevo_get_sidebar();
}*/

function apevo_get_sidebar($sidebar = 1) {
	echo "\t\t\t<div id=\"sidebar_$sidebar\" class=\"sidebar\">\n";
	echo "\t\t\t\t<ul class=\"sidebar_list\">\n";

	if ($sidebar == 1)
		apevo_sidebar_1();
	elseif ($sidebar == 2)
		apevo_sidebar_2();

	echo "\t\t\t\t</ul>\n";
	echo "\t\t\t</div>\n";
}

function apevo_sidebar_1() {
	apevo_hook_before_sidebar_1(); #hook
	//apevo_default_widget();
	sidebar_1_widgets();
	apevo_hook_after_sidebar_1(); #hook
}

function apevo_sidebar_2() {
	apevo_hook_before_sidebar_2(); #hook
	apevo_default_widget(2);
	apevo_hook_after_sidebar_2(); #hook
}