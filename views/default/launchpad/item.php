<?php
/**
 * TGS Launchpad Item
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 */

elgg_load_css('elgg.launchpad');
$item = elgg_extract('item', $vars);

$icon = elgg_view('launchpad/icon', array(
	'entity' => $item,
	'height' => 60,
	'width' => 60,
));

$link = elgg_view('output/url', array(
	'href' => $item->item_url,
	'text' => $icon,
	'title' => $item->title,
));


echo <<<HTML
	<span class='launchpad-item launchpad-tooltip' title='{$item->title}'>
		$link
	</span>
HTML;

