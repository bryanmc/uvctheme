<?php

/*---------------------------------------------------------------------------------------
	AP DYNAMIC STYLING
-----------------------------------------------------------------------------------------*/

function ap_dynamic_stylesheet() {
  $content .= '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/lib/css/dynamic.php?type='.$ptype.'&hpn='.$hidePostNav.'&col='.$singlecol.'" />';
  return $content;
}