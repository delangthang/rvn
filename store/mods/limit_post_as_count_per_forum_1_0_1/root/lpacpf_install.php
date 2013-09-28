<?php
/**
*
* @package UMIL Limit Post as Count per Forum
* @version $Id: lpacpf_install.php v1.0.1 02h16 18/03/2013 Geolim4 Exp $
* @copyright (c) 2012 Geolim4.com  http://Geolim4.com
* @bug/function request: http://geolim4.com/tracker.php
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
$mod_name = 'Limit Post as Count per Forum';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'lpacpf_mod_version';


// The language file which will be included when installing
//$language_file = '';


/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
//$logo_img = 'images/fp_umil.png';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'1.0.1' => array(
		'cache_purge' => array(''),
	),
	'1.0.0' => array(
		//Some config we've need...
		'permission_add' => array(
			array('f_topic_limit', false),
			array('f_post_limit', false),
		),
		'permission_set' => array(
			//FORUMS ROLES
			array('ROLE_FORUM_FULL', array('f_topic_limit', 'f_post_limit') ),
		),
		'table_column_add' => array(
			array(FORUMS_TABLE, 'forum_topic_limit', array('UINT:10', 0)),
			array(FORUMS_TABLE, 'forum_post_limit', array('UINT:10', 0)),
		),
		'cache_purge' => array(''),
	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);