<?php
/**
 * TGS Launchpad Items
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 */

elgg_load_js('elgg.launchpad');

$limit = elgg_extract('limit', $vars, 10);
$offset = elgg_extract('offset', $vars, 0);

// Get our user's roles
$roles = get_user_roles(elgg_get_logged_in_user_entity(), 0);

$role_guids = array();

// Get role guids for elgg_list_entities..
foreach($roles as $role) {
	$role_guids[] = $role->guid;
}

$items = elgg_get_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'launchpad_item',
	'limit' => $limit,
	'offset' => $offset,
	'metadata_names' => 'roles',
	'metadata_values' => $role_guids,
));

echo "<div class='launchpad-items'>";

foreach($items as $item) {
	echo elgg_view('launchpad/item', array('item' => $item));
}

echo "<div style='clear: both;'></div></div>";