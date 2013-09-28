<?php

/**
*
* @author Stoker 4.0
* @package Top Stats
* @version $Id: umil_top_stats_install.php, v1.0.10 2012/20/06 Stoker $
* @copyright (c) 2011 Stoker 4.0 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang)) 
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM
//

$lang = array_merge($lang, array(
		'INSTALL_TOP_STATS'					=> 'Install Top Stats',
		'INSTALL_TOP_STATS_CONFIRM'			=> 'Are you ready to install the Top Stats Mod?',
		'TOP_STATS'							=> 'Top Stats',
		'TOP_STATS_EXPLAIN'					=> 'Install Top Stats database changes with UMIL auto method.',
		'UNINSTALL_TOP_STATS'				=> 'Uninstall Top Stats',
		'UNINSTALL_TOP_STATS_CONFIRM'		=> 'Are you ready to uninstall the Top Stats? All settings and data saved by this mod will be removed!',
		'UPDATE_TOP_STATS'					=> 'Update Top Stats Mod',
		'UPDATE_TOP_STATS_CONFIRM'			=> 'Are you ready to update the Top Stats Mod?',

));

?>