<?php
/**
 * TGS Launchpad save form
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */

// Map values
$title = elgg_extract('title', $vars, '');
$guid = elgg_extract('guid', $vars);
$description = elgg_extract('description', $vars, '');
$url = elgg_extract('item_url', $vars, '');


// Check if we've got an entity, if so, we're editing.
if ($guid) {
	$entity_hidden  = elgg_view('input/hidden', array(
		'name' => 'guid',
		'value' => $guid,
	));
	// Grab item to include roles
	$item = get_entity($guid);

	$icon_label = elgg_echo("launchpad:label:replaceicon");
} else {
	$icon_label = elgg_echo("launchpad:label:icon");
}

// Labels/Input
$title_label = elgg_echo('title');
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'value' => $title
));

$description_label = elgg_echo('description');
$description_input = elgg_view('input/longtext', array(
	'name' => 'description',
	'value' => $description
));

$url_label = elgg_echo('launchpad:label:url');
$url_input = elgg_view('input/url', array(
	'name' => 'item_url',
	'value' => $url,
));

$icon_input = elgg_view('input/file', array(
	'name' => 'upload'
));

$submit_input = elgg_view('input/submit', array(
	'name' => 'submit',
	'value' => elgg_echo('save')
));

$roles_input = elgg_view('input/roles', array('value' => $item->roles));

// Build Form Body
$form_body = <<<HTML

<div class='margin_top'>
	<div>
		<label>$title_label</label><br />
        $title_input
	</div><br />
	<div>
		<label>$description_label</label><br />
        $description_input
	</div><br />
	<div>
		<label>$url_label</label><br />
		$url_input
	</div><br />
	<div>
		<label>$icon_label</label>
		$icon_input
	</div><br />
	<div>
		$roles_input
	</div>
	<div class='elgg-foot'>
		$submit_input
		$entity_hidden
	</div>
</div>
HTML;

echo $form_body;
