<?php
/**
 * TGS Launchpad helper functions
 * 
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.com/
 */

/** CONTENT **/

/** Get launchpad edit/add form **/
function launchpad_get_edit_content($type, $guid = NULL) {
	elgg_push_breadcrumb(elgg_echo('admin:launchpad:items'), elgg_get_site_url() . 'admin/launchpad_items/items');
	if ($type == 'edit') {
		$launchpad_item = get_entity($guid);
		elgg_push_breadcrumb($launchpad_item->title, $launchpad_item->getURL());
		elgg_push_breadcrumb(elgg_echo('edit'));
		if (!elgg_instanceof($launchpad_item, 'object', 'launchpad_item')) {
			forward(REFERER);
		}
	} else {
		elgg_push_breadcrumb(elgg_echo('Add'));
		$launchpad_item = null;
	}

	$body_vars = launchpad_prepare_form_vars($launchpad_item);

	$content = elgg_view('navigation/breadcrumbs');

	// Need enctype for uploading
	$form_vars = array(
		'name' => 'launchpad-edit-form',
		'id' => 'launchpad-edit-form',
		'enctype' => 'multipart/form-data',
	);

	$content .= elgg_view_form('launchpad/save', $form_vars, $body_vars);

	echo $content;
}

/** Get launchpad edit/add form **/
function launchpad_link_get_edit_content($type, $guid = NULL) {
	elgg_push_breadcrumb(elgg_echo('admin:launchpad:links'), elgg_get_site_url() . 'admin/launchpad_items/links');
	if ($type == 'edit') {
		$launchpad_link_item = get_entity($guid);
		elgg_push_breadcrumb($launchpad_link_item->title, $launchpad_link_item->getURL());
		elgg_push_breadcrumb(elgg_echo('edit'));
		if (!elgg_instanceof($launchpad_link_item, 'object', 'launchpad_link_item')) {
			forward(REFERER);
		}
	} else {
		elgg_push_breadcrumb(elgg_echo('Add'));
		$launchpad_link_item = null;
	}

	$body_vars = launchpad_prepare_form_vars($launchpad_link_item);

	$content = elgg_view('navigation/breadcrumbs');

	$form_vars = array(
		'name' => 'launchpad-edit-form',
		'id' => 'launchpad-edit-form',
		'action' => elgg_normalize_url('action/launchpad/save')
	);

	$content .= elgg_view_form('launchpad/save_link', $form_vars, $body_vars);

	echo $content;
}

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $launchpad_item
 * @return array
 */
function launchpad_prepare_form_vars($launchpad_item = null) {
	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'item_url' => '',
		'guid' => NULL,
	);

	if ($launchpad_item) {
		foreach (array_keys($values) as $field) {
			$values[$field] = $launchpad_item->$field;
		}
	}

	if (elgg_is_sticky_form('launchpad-edit-form')) {
		foreach (array_keys($values) as $field) {
			$values[$field] = elgg_get_sticky_value('launchpad-edit-form', $field);
		}
	}

	elgg_clear_sticky_form('launchpad-edit-form');

	return $values;
}

