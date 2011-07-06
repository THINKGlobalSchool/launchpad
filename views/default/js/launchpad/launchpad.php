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
	console.log('launchpad loaded');
}

elgg.register_hook_handler('init', 'system', elgg.launchpad.init);
//</script>