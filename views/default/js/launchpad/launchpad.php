<?php
/**
 * TGS Launchpad JS library
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 */
?>
//<script>
elgg.provide('elgg.launchpad');

// Init function
elgg.launchpad.init = function() {
	$('.launchpad-tooltip').tipTip({
		delay           : 0,
		defaultPosition : 'top',
		fadeIn          : 25,
		fadeOut         : 300,
		edgeOffset      : -5,
		keepAlive       : true,
	});

	$('.launchpad-item').hover(function() {
		$(this).toggleClass('launchpad-item-hover');
	});
}

elgg.register_hook_handler('init', 'system', elgg.launchpad.init);
//</script>