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
* Class that contains all hooked methods
**/
abstract class post_count_requirement_hook
{
	/**
	* Register all hooks
	* @author Erik Frèrejean
	**/
	static public function register(&$phpbb_hook)
	{
		$phpbb_hook->register('phpbb_user_session_handler', 'post_count_requirement_hook::post_count_requirements_init');
		$phpbb_hook->register(array('template', 'display'), 'post_count_requirement_hook::post_count_requirements_pages');
	}

	/**
	* A hook that is used to initialise the Post Count Requirements core
	* @author Erik Frèrejean
	**/
	static public function post_count_requirements_init(&$hook)
	{
		if (!class_exists('post_count_requirements_core'))
		{
			global $phpbb_root_path, $phpEx;

			require ($phpbb_root_path . 'includes/mods/post_count_requirements/post_count_requirements_core.' . $phpEx);
			post_count_requirements_core::init();
		}
	}

	/**
	* A hook that checks auth for pages
	**/
	static public function post_count_requirements_pages(&$hook)
	{
		global $db, $user, $phpbb_root_path, $phpEx;

		if (!empty($user->page['page_dir']))
		{
			return;
		}

		// Do not load on install, because columns are not set yet
		if ($user->page['page_name'] != 'post_count_requirements_install.php')
		{
			// Is user allowed to bypass the post count requirements?
			$post_count_requirement_bypass = false;

			$sql = 'SELECT * 
				FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g 
				WHERE ug.user_id = ' . $user->data['user_id'] . ' AND ug.group_id = g.group_id';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				if ($row['group_bypass_post_req'] == 1)
				{
					$post_count_requirement_bypass = true;
				}
			}
			$db->sql_freeresult($result);
		}
		global $forum_id;

		// Does the user have the required post count to post in this forum?
		$forum_id = intval($forum_id);
		$sql = 'SELECT f.*
			FROM ' . FORUMS_TABLE . ' f
			WHERE f.forum_id = ' . $forum_id;
		$result = $db->sql_query($sql);
		$forum_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// Page specific cases
		switch ($user->page['page_name'])
		{
			case 'posting.' . $phpEx:
				if (post_count_requirements_core::check_post_count_requirement($forum_id, 'post') == false && $post_count_requirement_bypass == false)
				{
					$remaining_posts = ($forum_data['forum_postcount_post'] - $user->data['user_posts']);
					$posts_var_1 = ($forum_data['forum_postcount_post'] == 1) ? $user->lang['POSTREQ_POST'] : $user->lang['POSTREQ_POSTS'];
					$posts_var_2 = ($remaining_posts == 1) ? $user->lang['POSTREQ_POST'] : $user->lang['POSTREQ_POSTS'];
					$access_error = sprintf($user->lang['POSTREQ_NOACCESS_POST'], $forum_data['forum_postcount_post'], $posts_var_1);
					if ($user->data['user_id'] != ANONYMOUS)
					{
						$needed_posts = "<br /><br />" . sprintf($user->lang['POSTREQ_NOACCESS_MORE'], $remaining_posts, $posts_var_2);
					}
					else
					{
						$needed_posts = '';
					}

					trigger_error($access_error . $needed_posts);
				}
			break;

			case 'viewforum.' . $phpEx:
			case 'viewtopic.' . $phpEx:
				if (post_count_requirements_core::check_post_count_requirement($forum_id, 'view') == false && $post_count_requirement_bypass == false)
				{
					$remaining_posts = ($forum_data['forum_postcount_view'] - $user->data['user_posts']);
					$posts_var_1 = ($forum_data['forum_postcount_view'] == 1) ? $user->lang['POSTREQ_POST'] : $user->lang['POSTREQ_POSTS'];
					$posts_var_2 = ($remaining_posts == 1) ? $user->lang['POSTREQ_POST'] : $user->lang['POSTREQ_POSTS'];
					$access_error = sprintf($user->lang['POSTREQ_NOACCESS_VIEW'], $forum_data['forum_postcount_view'], $posts_var_1);
					if ($user->data['user_id'] != ANONYMOUS)
					{
						$needed_posts = "<br /><br />" . sprintf($user->lang['POSTREQ_NOACCESS_MORE'], $remaining_posts, $posts_var_2);
					}
					else
					{
						$needed_posts = '';
					}

					trigger_error($access_error . $needed_posts);
				}
			break;
		}
	}
}

post_count_requirement_hook::register($phpbb_hook);

?>