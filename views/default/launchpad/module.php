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

elgg_load_css('elgg.launchpad');
elgg_load_js('elgg.launchpad');
elgg_load_js('jquery.tiptip');
elgg_load_css('jquery.tiptip');

$content .= elgg_view('modules/genericmodule', array(
	'view' => 'launchpad/items',
	'view_vars' => array(), 
));

echo elgg_view_module('featured', elgg_echo('launchpad'), $content, array(
	'class' => 'launchpad-module',
));