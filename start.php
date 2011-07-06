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

function roles_init() {	
	
	// Register and load library
	elgg_register_library('launchpad', elgg_get_plugins_path() . 'launchpad/lib/launchpad.php');
	elgg_load_library('launchpad');
		
	// Register CSS
	$l_css = elgg_get_simplecache_url('css', 'launchpad/css');
	elgg_register_css('elgg.launchpad', $l_css);
		
	// Register JS library
	$l_js = elgg_get_simplecache_url('js', 'launchpad/launchpad');
	elgg_register_js('elgg.launchpad', $l_js);
		
	// Just for testin, put somewhere else
	elgg_load_css('elgg.launchpad');
	elgg_load_js('elgg.launchpad');	
		
	// Add submenus
	elgg_register_event_handler('pagesetup', 'system', 'launchpad_submenus');
						
	// Register URL handler
	elgg_register_entity_url_handler('object', 'launchpad_item', 'launchpad_url');		
					
	// Register actions
	$action_base = elgg_get_plugins_path() . 'launchpad/actions/launchpad';
	elgg_register_action('launchpad/save', "$action_base/save.php", 'admin');
	elgg_register_action('launchpad/delete', "$action_base/delete.php", 'admin');
	
	return true;
}

/**
 * Populates the ->getUrl() method for launchpad_item entities
 *
 * @param ElggRole entity
 * @return string request url
 */
function launchpad_url($entity) {
	return elgg_get_site_url() . 'admin/users/viewrole?guid=' . $entity->guid;
}

/**
 * Setup Launchpad Submenus
 */
function launchpad_submenus() {
	if (elgg_in_context('admin')) {
		elgg_register_admin_menu_item('administer', 'roles', 'users');
	}
}
