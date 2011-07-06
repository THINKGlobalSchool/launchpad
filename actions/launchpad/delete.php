<?php
/**
 * TGS Launchpad delete item action
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */

// Get inputs
$guid = get_input('guid');

$launchpad_item = get_entity($guid);

if ($launchpad_item && $launchpad_item->getSubtype() == 'launchpad_item') {
	if ($launchpad_item->delete()) {
		// Success
		system_message(elgg_echo('launchpad:success:delete'));
		forward('');
	} else {
		// Error
		register_error(elgg_echo('launchpad:error:delete'));
		forward('');
	}
}
