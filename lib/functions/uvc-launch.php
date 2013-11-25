<?php
//Remove Unwanted Default Stuff
remove_action('apevo_hook_after_header', 'apevo_secondary_nav_menu');
remove_action('apevo_hook_post_box_top', 'apevo_build_thumbnail');
remove_action('apevo_hook_after_post', 'apevo_post_tags');
//Remove the thumbnail for teasers being positioned under the teaser title
remove_action('apevo_hook_before_teaser', 'apevo_build_teaser_thumbnail');
add_action('apevo_hook_after_teaser_headline','apevo_build_teaser_thumbnail');
