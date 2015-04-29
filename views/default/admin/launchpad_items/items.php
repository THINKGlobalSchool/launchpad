<?php
/**
 * TGS Launchpad admin main
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */

elgg_load_css('elgg.launchpad');
elgg_load_js('elgg.launchpad');
elgg_load_js('jquery.tiptip');
elgg_load_css('jquery.tiptip');

$options = array(
	'type' => 'object',
	'subtype' => 'launchpad_item',
	'limit' => 10,
	'pagination' => TRUE,
	'full_view' => FALSE,
);

$launchpad_items = elgg_list_entities($options);

if (!$launchpad_items) {
	$launchpad_items = elgg_echo('launchpad:label:none');
}

echo "<a href='". elgg_get_site_url() . "admin/launchpad_items/add' class='elgg-button elgg-button-action'>" . elgg_echo('launchpad:label:new') . "</a><div style='clear: both;'></div>";

echo elgg_view_module('inline', elgg_echo('launchpad:label:items'), $launchpad_items);