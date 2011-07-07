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
$item_url = get_input('item_url');
$item_guid = get_input('guid', NULL);


$roles_list = get_input('roles_list');

// Create Sticky form
elgg_make_sticky_form('launchpad-edit-form');

// Check inputs
if (!$title || !$item_url || !$roles_list) {
	register_error(elgg_echo('launchpad:error:requiredfields'));
	forward(REFERER);
}

// New Item
if (!$item_guid) {
	$launchpad_item = new ElggObject();
	$launchpad_item->subtype = 'launchpad_item';
	$launchpad_item->access_id = ACCESS_LOGGED_IN; // @TODO .. what should this be

	// must have a file if a new file upload
	if (empty($_FILES['upload']['name'])) {
		register_error(elgg_echo('launchpad:error:iconrequired'));
		forward(REFERER);
	}

	$icon = new LaunchpadItemIcon();


} else { // Editing
	$launchpad_item = get_entity($item_guid);
	if (!elgg_instanceof($launchpad_item, 'object', 'launchpad_item')) {
		register_error(elgg_echo('launchpad:error:edit'));
		forward(REFERER);
	}

	$icon = new LaunchpadItemIcon($launchpad_item->icon_guid);

	if (!$icon) {
		register_error(elgg_echo('launchpad:error:invalidicon'));
		forward(REFERER);
	}
}

$launchpad_item->title = $title;
$launchpad_item->description = $description;
$launchpad_item->item_url = $item_url;

// we have an icon upload, so process it
if (isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])) {

	$prefix = "launchpad_item_icon/";

	$filestorename = elgg_strtolower(time() . $_FILES['upload']['name']);

	// If we're editing, delete the original
	if ($item_guid) {
		$filename = $icon->getFilenameOnFilestore();
		if (file_exists($filename)) {
			unlink($filename);
		}
	}

	$icon->setFilename($prefix . $filestorename);
	$icon->setMimeType($_FILES['upload']['type']);
	$icon->originalfilename = $_FILES['upload']['name'];
	$icon->title =  $_FILES['upload']['name'];
	$icon->simpletype = file_get_simple_type($_FILES['upload']['type']);
	$icon->access_id = ACCESS_LOGGED_IN; // @TODO .. what should this be

	// Open the file to guarantee the directory exists
	$icon->open("write");
	$icon->close();
	move_uploaded_file($_FILES['upload']['tmp_name'], $icon->getFilenameOnFilestore());

	$icon->save();

	// Set launchpad item icon guid
	$launchpad_item->icon_guid = $icon->guid;
}

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