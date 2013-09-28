<?php
/**
*
* @package Post Count Requirements
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

/**
* @ignore
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Class for Post Count Requirements core
**/
abstract class post_count_requirements_core
{
	static public function init()
	{
		global $user;

		$user->add_lang('mods/post_count_requirements');
	}

	static public function check_post_count_requirement($forum_id, $type)
	{
		global $db, $user;
		$sql = 'SELECT f.*
			FROM ' . FORUMS_TABLE . ' f
			WHERE f.forum_id = ' . (int) $forum_id;
		$result = $db->sql_query($sql);
		$forum_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		switch ($type)
		{
			case 'view':
				if ($user->data['user_posts'] < $forum_data['forum_postcount_view'])
				{
					return false;
				}
				else
				{
					return true;
				}
			break;

			case 'post':
				if ($user->data['user_posts'] < $forum_data['forum_postcount_post'])
				{
					return false;
				}
				else
				{
					return true;
				}
			break;
		}
	}
}

?>