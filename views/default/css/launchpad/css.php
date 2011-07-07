<?php
/**
 * TGS Launchpad CSS
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */
?>

li.elgg-item {
	border-bottom: 1px solid #ddd;
	margin: 0;
}

li.elgg-item:hover {
	background: #eee;
}

.launchpad-module .elgg-body {
	padding: 2px;
}

.launchpad-items {
	height: 100%;
	width: 100%;
	padding-top: 10px;
	padding-left: 0px;
	padding-right: 0px;
	padding-bottom: 7px;
	text-align: center;
	display: table;

	/* http://www.colorzilla.com/gradient-editor/ */
	background: rgb(255,255,255); /* Old browsers */
	background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(241,241,241,1) 50%, rgba(225,225,225,1) 51%, rgba(246,246,246,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(50%,rgba(241,241,241,1)), color-stop(51%,rgba(225,225,225,1)), color-stop(100%,rgba(246,246,246,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* W3C */
}

.launchpad-item {
	background: #bbb;
	border: 2px solid #bbb;
	padding: 3px;
	margin: 2px;
	display: inline-block;
	height: 80px;
	width: 80px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
}

.launchpad-item:hover {
	background: #fff;
}

/* Don't show BG in widget */
.elgg-widget-content .launchpad-items {
	background: none;
}