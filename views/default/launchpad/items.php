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

elgg_load_css('elgg.launchpad');
elgg_load_js('elgg.launchpad');
elgg_load_js('jquery.tiptip');
elgg_load_css('jquery.tiptip');

$limit = elgg_extract('limit', $vars, 10);
$offset = elgg_extract('offset', $vars, 0);

// Get our user's roles
$roles = get_user_roles(elgg_get_logged_in_user_entity(), 0);

$role_guids = array();

// Get role guids for elgg_list_entities..
foreach($roles as $role) {
	$role_guids[] = $role->guid;
}

$dbprefix = elgg_get_config('dbprefix');

$items = elgg_get_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'launchpad_item',
	'limit' => $limit,
	'offset' => $offset,
	'metadata_names' => 'roles',
	'metadata_values' => $role_guids,
	'joins' => array(
		"JOIN {$dbprefix}objects_entity oe ON e.guid = oe.guid"
	),
	'order_by' => 'oe.title',
	'limit' => 0,
));

echo "<div class='launchpad-items'>";

foreach($items as $item) {
	echo elgg_view('launchpad/item', array('item' => $item));
}

echo "</div>";