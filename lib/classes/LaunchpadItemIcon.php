<?php
/**
 * TGS Launchpad 
 * LaunchpadItemIcon extends the ElggFile class, mostly to just have a custom subtype
 *
 * @package TGSLaunchpad
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

class LaunchpadItemIcon extends ElggFile {
	protected function  initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "launchpad_item_icon";
	}

	public function __construct($guid = null) {
		parent::__construct($guid);
	}
}
