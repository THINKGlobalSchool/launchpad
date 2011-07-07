<?php
/**
 * TGS Launchpad object view
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */

$full = elgg_extract('full_view', $vars, FALSE);
$launchpad_item = elgg_extract('entity', $vars, FALSE);

if (!$launchpad_item) {
	return TRUE;
}

$tags = elgg_view('output/tags', array('tags' => $launchpad_item->tags));
$date = elgg_view_friendly_time($launchpad_item->time_created);

$metadata = elgg_view_menu('entity', array(
	'entity' => $launchpad_item,
	'handler' => 'launchpad',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

$roles = elgg_view('output/roles', $vars);

$url = elgg_view('output/url', array(
	'value' => $launchpad_item->item_url,
));

if ($full) {
	$body = elgg_view('output/longtext', array(
		'value' => $launchpad_item->description,
	));

	$header = elgg_view_title($launchpad_item->title);

	$params = array(
		'entity' => $launchpad_item,
		'title' => false,
		'subtitle' => $roles,
		'metadata' => $metadata,
		'tags' => $tags,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	$launchpad_item_info = elgg_view_image_block('', $list_body);

	// Icon info
	$icon_label = elgg_echo('launchpad:label:icon');
	$icon = elgg_view('launchpad/icon', array(
		'entity' => $launchpad_item,
		'height' => 80,
		'width' => 80,
	));

	// URL Label
	$url_label = elgg_echo('launchpad:label:url');

	echo <<<HTML
		$header
		$launchpad_item_info
		$body
		<label>$url_label</label><br />
		<p>$url</p>
		<label>$icon_label</label><br />
		$icon
HTML;

} else {
	// brief view
	$subtitle = $url . "<br />" . $roles;

	$params = array(
		'entity' => $launchpad_item,
		'subtitle' => $subtitle,
		'metadata' => $metadata,
		'tags' => $tags,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	$icon = elgg_view('launchpad/icon', array(
		'entity' => $launchpad_item,
		'height' => 40,
		'width' => 40,
	));

	echo elgg_view_image_block($icon, $list_body);
}