<?php
/**
 * TGS Launchpad Module
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 */

// Get our user's roles
$roles = get_user_roles(elgg_get_logged_in_user_entity(), 0);

$role_guids = array();

// Get role guids for elgg_list_entities..
foreach($roles as $role) {
	$role_guids[] = $role->guid;
}

$content = elgg_list_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'launchpad_item',
	'limit' => 0,
	'pagination' => TRUE,
	'full_view' => FALSE,
	'metadata_names' => 'roles',
	'metadata_values' => $role_guids,
));

echo elgg_view_module('featured', elgg_echo('launchpad'), $content);