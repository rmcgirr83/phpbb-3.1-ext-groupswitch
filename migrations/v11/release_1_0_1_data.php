<?php
/**
 *
 * @package phpBB Extension - Group Switches
 * @author RMcGirr83  (Rich McGirr) rmcgirr83@phpbbmodders.net
 * @copyright (c) 2015 phpbbmodders.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbmodders\groupswitches\migrations\v11;

class release_1_0_1_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['groupswitches_version']) && version_compare($this->config['groupswitches_version'], '1.0.1', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbbmodders\groupswitches\migrations\v10\release_1_0_0_data');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('groupswitches_version', '1.0.1')),
		);
	}
}
