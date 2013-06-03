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

$launchpad_item = elgg_extract('entity', $vars);
$height = elgg_extract('height', $vars);
$width = elgg_extract('width', $vars);

$title = $launchpad_item->title;

$icon = get_entity($launchpad_item->icon_guid);

echo "<img class='launchpad-item-icon' style='height:{$height}px;width:{$width}px;' alt='{$icon->title}' src='" . elgg_get_site_url() . "launchpad/thumbnail/{$icon->guid}' />{$title}";
