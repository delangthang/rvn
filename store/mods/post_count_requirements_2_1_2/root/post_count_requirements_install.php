<?php
/**
 *
 * @author t_backoff (Tabitha Backoff) t_backoff@yahoo.com
 * @version $Id$
 * @copyright (c) 2012 t_backoff
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();


if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'Post Count Requirements';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'post_count_requirements_version';


// The language file which will be included when installing
$language_file = 'mods/post_count_requirements';


/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
//$logo_img = 'styles/prosilver/imageset/site_logo.gif';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'2.1.2' => array(
		'table_column_update' => array(
			array('phpbb_forums', 'forum_postcount_view', array('UINT', '0')),
			array('phpbb_forums', 'forum_postcount_post', array('UINT', '0')),
		),
	),

	'2.1.1' => array(
		// no changes
	),

	'2.1.0' => array(
		'table_column_add' => array(
			array('phpbb_forums', 'forum_postcount_view', array('BOOL', '0')),
			array('phpbb_forums', 'forum_postcount_post', array('BOOL', '0')),
			array('phpbb_groups', 'group_bypass_post_req', array('BOOL', '0')),
		),

		'custom' => 'group_bypass_function',
	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

function group_bypass_function($action, $version)
{
	global $db, $table_prefix, $umil;

	if ($action == 'install' || $action == 'update')
	{
		$sql = 'UPDATE ' . GROUPS_TABLE . '
			SET group_bypass_post_req = ' . 1 . "
			WHERE group_name = 'GLOBAL_MODERATORS'";
		$db->sql_query($sql);

		$sql = 'UPDATE ' . GROUPS_TABLE . '
			SET group_bypass_post_req = ' . 1 . "
			WHERE group_name = 'ADMINISTRATORS'";
		$db->sql_query($sql);

		return array('command' => 'GROUP_IDS_POPULATED', 'result' => 'SUCCESS');
	}
}