<?php
// THIS IS FOR TESTING!!!!! 

$full = elgg_extract('full_view', $vars, FALSE);
$icon = elgg_extract('entity', $vars, FALSE);

if ($full) {
	var_dump($icon);

	if (get_input('delete')) {
		$icon->delete();
	}	
} else {
	echo "<a href='" . elgg_get_site_url() . "view/$icon->guid'>Icon: $icon->title</a>"; 
}

