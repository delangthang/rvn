<?php
/**
*
* acp_topic_prefix [English]
*
* @package language
* @version $Id$
* @copyright (c) 2011 daroPL dariuszwm@gmail.com http://www.phpbb.pl
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
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'FORUM_TOPIC_PREFIXES'					=> 'Topics prefixes',
	'FORUM_TOPIC_PREFIXES_EXPLAIN' 			=> 'Enter each prefix in a separated line.',
	'FORUM_TOPIC_PREFIX_REQUIRED' 			=> 'Topic prefix required',
	'FORUM_TOPIC_PREFIX_REQUIRED_EXPLAIN' 	=> 'A prefix is required if any prefixes were entered above.',
));

?>