<?php
/**
 * TGS Launchpad Plugin Settings
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.com/
 * 
 */

$link_title = $vars['entity']->link_title;

if (!$link_title) {
	$link_title = "Links";
}

$link_title_label = elgg_echo('launchpad:label:linktitle');
$link_title_input = elgg_view('input/text', array(
	'name' => 'params[link_title]',
	'value' => $link_title
));

$content = <<<HTML
	<br />
	<div>
		<label>$link_title_label</label><br />
		$link_title_input
	</div>
HTML;

echo $content;