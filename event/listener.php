<?php
/**
 *
 * @package phpBB Extension - Group Switches
 * @author RMcGirr83  (Rich McGirr) rmcgirr83@phpbbmodders.net
 * @copyright (c) 2015 phpbbmodders.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbmodders\groupswitches\event;

use phpbb\template\template;
use phpbb\user;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/* @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $php_ext;

	public function __construct(template $template, user $user, $root_path, $php_ext)
	{
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header' => 'main',
		);
	}

	public function main($event)
	{
		if (!function_exists('group_memberships'))
		{
			include($this->root_path . 'includes/functions_user.'.$this->php_ext);
		}
		$groups = group_memberships(false,$this->user->data['user_id']);
		if (sizeof($groups))
		{
			foreach ($groups as $grouprec)
			{
				$this->template->assign_vars(array(
					'S_GROUP_' . $grouprec['group_id'] => true
				));
			}
		}
	}
}
