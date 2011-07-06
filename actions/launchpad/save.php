<?php
/**
 * TGS Launchpad save item action
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */

// Get inputs
$title = get_input('title');
$description = get_input('description');
$item_guid = get_input('item_guid', NULL);

$roles_list = get_input('roles_list');


// Create Sticky form
elgg_make_sticky_form('launchpad-edit-form');

// Check inputs
if (!$title || !$description || !$roles_list) {
	register_error(elgg_echo('launchpad:error:requiredfields'));
	forward(REFERER);
}

// New Item
if (!$item_guid) {
	$launchpad_item = new ElggObject();
	$launchpad_item->subtype = 'launchpad_item';
	$launchpad_item->access_id = ACCESS_LOGGED_IN; // @TODO .. what should this be
} else { // Editing
	$launchpad_item = get_entity($item_guid);
	if (!elgg_instanceof($launchpad_item, 'object', 'launchpad_item')) {
		register_error(elgg_echo('launchpad:error:edit'));
		forward(REFERER);
	}
}

$launchpad_item->title = $title;
$launchpad_item->description = $description;

// Try saving
if (!$launchpad_item->save()) {
	// Error.. say so and forward
	register_error(elgg_echo('launchpad:error:save'));
	forward(REFERER);
}

// Clear Sticky form
elgg_clear_sticky_form('launchpad-edit-form');

system_message(elgg_echo('launchpad:success:save'));
forward(elgg_get_site_url() . 'admin/launchpad/items');