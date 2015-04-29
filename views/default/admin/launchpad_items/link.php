<?php
/**
 * TGS Launchpad admin link item view
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.com/
 */

elgg_load_css('elgg.launchpad');
elgg_load_js('elgg.launchpad');

$launchpad_item = get_entity(get_input('guid'));

elgg_push_breadcrumb(elgg_echo('admin:launchpad:items'), elgg_get_site_url() . 'admin/launchpad_items/items');

if (elgg_instanceof($launchpad_item, 'object', 'launchpad_item')) {
	$content = elgg_view_entity($launchpad_item, array('full_view' => TRUE));
	elgg_push_breadcrumb($launchpad_item->title, $launchpad_item->getURL());
} else {
	$content = elgg_echo('launchpad:error:notfound');
}

$breadcrumbs = elgg_view('navigation/breadcrumbs');

echo $breadcrumbs . $content;