<?php
/**
 * TGS Launchpad
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

elgg_register_event_handler('init', 'system', 'launchpad_init');

function launchpad_init() {

	// Register and load library
	elgg_register_library('launchpad', elgg_get_plugins_path() . 'launchpad/lib/launchpad.php');
	elgg_load_library('launchpad');

	// Register class
	elgg_register_class('LaunchpadItemIcon', elgg_get_plugins_path() . 'launchpad/lib/classes/LaunchpadItemIcon.php');

	// Register CSS
	$l_css = elgg_get_simplecache_url('css', 'launchpad/css');
	elgg_register_css('elgg.launchpad', $l_css);

	// Register JS libraries
	$l_js = elgg_get_simplecache_url('js', 'launchpad/launchpad');
	elgg_register_js('elgg.launchpad', $l_js);

	// Register page handler
	elgg_register_page_handler('launchpad','launchpad_page_handler');

	// Add submenus
	elgg_register_event_handler('pagesetup', 'system', 'launchpad_submenus');

	// Register URL handler
	elgg_register_entity_url_handler('object', 'launchpad_item', 'launchpad_url');

	// Item entity menu hook
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'launchpad_setup_entity_menu', 999);

	// Register actions
	$action_base = elgg_get_plugins_path() . 'launchpad/actions/launchpad';
	elgg_register_action('launchpad/save', "$action_base/save.php", 'admin');
	elgg_register_action('launchpad/delete', "$action_base/delete.php", 'admin');

	// Register one once for subtype
	run_function_once("launchpad_run_once");

	return TRUE;
}

/**
 * Launchpad page handler
 */
function launchpad_page_handler($page) {

	switch($page[0]) {
		case 'thumbnail':
			// Make sure we have a proper guid
			$icon = get_entity($page[1]);

			if (elgg_instanceof($icon, 'object', 'launchpad_item_icon')) {
				// Create a new read file
				$readfile = new ElggFile();
				$readfile->owner_guid = $icon->owner_guid;
				$readfile->setFilename($icon->getFilename());
				$mime = $icon->getMimeType();
				$contents = $readfile->grabFile();

				// caching images for 10 days
				header("Content-type: $mime");
				header('Expires: ' . date('r',time() + 864000));
				header("Pragma: public", true);
				header("Cache-Control: public", true);
				header("Content-Length: " . strlen($contents));

				echo $contents;
				exit;
			}
			break;
		default:
			forward();
			break;
	}

	return TRUE;
}

/**
 * Populates the ->getUrl() method for launchpad_item entities
 *
 * @param ElggObject entity
 * @return string request url
 */
function launchpad_url($entity) {
	return elgg_get_site_url() . 'admin/launchpad/item?guid=' . $entity->guid;
}

/**
 * Setup Launchpad Submenus
 */
function launchpad_submenus() {
	if (elgg_in_context('admin')) {
		elgg_register_admin_menu_item('administer', 'items', 'launchpad');
	}
}

/**
 * Item entity plugin hook
 */
function launchpad_setup_entity_menu($hook, $type, $return, $params) {
	$entity = $params['entity'];

	if (!elgg_instanceof($entity, 'object', 'launchpad_item')) {
		return $return;
	}

	$return = array();

	$options = array(
		'name' => 'edit',
		'text' => elgg_echo('edit'),
		'href' => elgg_get_site_url() . 'admin/launchpad/edit?guid=' . $entity->guid,
		'priority' => 2,
	);
	$return[] = ElggMenuItem::factory($options);

	$options = array(
		'name' => 'delete',
		'text' => elgg_view_icon('delete'),
		'title' => elgg_echo('delete:this'),
		'href' => "action/{$params['handler']}/delete?guid={$entity->getGUID()}",
		'confirm' => elgg_echo('deleteconfirm'),
		'priority' => 3,
	);

	$return[] = ElggMenuItem::factory($options);

	return $return;
}

/**
 * Register entity type objects, subtype launchpad_item_icon as
 * LaunchpadItemIcon
 *
 * @return void
 */
function launchpad_run_once() {
	// Register a class
	add_subtype("object", "launchpad_item_icon", "LaunchpadItemIcon");
}
