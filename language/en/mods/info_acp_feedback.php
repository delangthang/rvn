<?php
/** 
*
* shmk user feedback [English]
*
* @package language
* @version $Id: info_acp_feedback.php 1.0.6 shockmaker $
* @copyright (c) 2009 ShockMaker.com
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
	'ACP_FB'		=> 'User Feedback',
	'ACP_FB_PREFS'	=> 'Preferences',
	'ACP_FB_MANAGE'	=> 'Manage Feedback',
	// Preferences
	'ACP_FB_PERM_EXPLAIN'	=> '
	<p>To set user and moderators powers go to Permissions -> Groups’ Permissions<br />then for every group set the permissions inside category "Feedback" as you want.</p>
	',
	'ACP_FB_ROLE_SET'		=> 'Role Settings',
	'ACP_FB_ROLE_ENABLE'	=> 'Add Role field in feedback',
	'ACP_FB_SCORE_ENABLE'	=> 'Enable score system',
	'ACP_FB_SCORE_POS'		=> 'Positive multiplier',
	'ACP_FB_SCORE_NEU'		=> 'Neutral multiplier',
	'ACP_FB_SCORE_NEG'		=> 'Negative multiplier',
	'ACP_FB_LINK_SET'		=> 'Link Settings',
	'ACP_FB_LINK_ENABLE'	=> 'Add Topic Link field in feedback<br />(if set to "no", next options will be ignored)',
	'ACP_FB_LINK_FORCE'		=> 'Topic link is required',
	'ACP_FB_LINK_FORCE_IN'	=> 'One of the traders must have created the linked topic',
	'ACP_FB_LINK_FORUM'		=> 'Linked topic has to be in one of these forums<br />(leave blank if you don\'t want this check)',
	'ACP_FB_LINK_FORUM_D'	=> 'Forum IDs comma separated (ex: 1,3,4)',
	'ACP_FB_COMM_SET'		=> 'Comment Settings',
	'ACP_FB_COMM_MINCHARS'	=> 'Minimum length (in characters)',
	'ACP_FB_COMM_MAXCHARS'	=> 'Maximum length (in characters)',
	'ACP_FB_COMM_URL'		=> 'URL inserted will become a clickable Link',
	'ACP_FB_ANTIFLOOD'		=> 'Anti-flood',
	'ACP_FB_ANTIFLOOD_DESC'	=> 'Amount of time, in seconds, after a user can insert a new feedback',
	'ACP_FB_ANTIFLOOD_SAME'	=> 'Amount of time, in seconds, after a user can insert a new feedback to the same user',
	'ACP_FB_RANKINGS'		=> 'Rankings',
	'ACP_FB_TOP_MAIN'		=> 'Users shown on Best/Worst in main page',
	'ACP_FB_TOP_BEST'		=> 'Users shown on Best Users page',
	'ACP_FB_TOP_WORST'		=> 'Users shown on Worst Users page',
	'ACP_FB_IGNOREDACP'		=> '(ignored in ACP)',
	'ACP_FB_CONFUPDATED'	=> 'Feedback preferences updated',
	// Manage
	'ACP_FB_SEARCH'			=> 'Search User',
	'ACP_FB_FEEDBACK'		=> 'Feedback',
	'ACP_FB_FEEDBACKOF'		=> 'Feedback of',
	'ACP_FB_SCORE'			=> 'Score',
	'ACP_FB_PERCENTAGE'		=> 'Positive Feedback',
	'ACP_FB_BUYER'			=> 'Buyer',
	'ACP_FB_SELLER'			=> 'Seller',
	'ACP_FB_TRADE'			=> 'Trade',
	'ACP_FB_POS'			=> 'Positive',
	'ACP_FB_NEU'			=> 'Neutral',
	'ACP_FB_NEG'			=> 'Negative',
	'ACP_FB_LINK'			=> 'Trade topic ID',
	'ACP_FB_LINKOPT'		=> 'Trade topic ID (optional)',
	'ACP_FB_ADD'			=> 'Add Feedback',
	'ACP_FB_EDIT'			=> 'Edit Feedback',
	'ACP_FB_DELETE'			=> 'Delete Feedback',
	'ACP_FB_ADDED'			=> 'Feedback added, you\'ll be redirected to user feedback in seconds.',
	'ACP_FB_EDITED'			=> 'Feedback edited, you\'ll be redirected to user feedback in seconds.',	
	'ACP_FB_DELETED'		=> 'Feedback deleted, you\'ll be redirected to user feedback in seconds.',
	'ACP_FB_ROLE'			=> 'Role',
	'ACP_FB_ROLE_ALL'		=> 'all',
	'ACP_FB_ROLE_BUYER'		=> 'buyer',
	'ACP_FB_ROLE_SELLER'	=> 'seller',
	'ACP_FB_ROLE_TRADE'		=> 'trade',
	'ACP_FB_FILTER'			=> 'Filter',
	'ACP_FB_FILTER_ALL'		=> 'all',
	'ACP_FB_FILTER_POS'		=> 'positive',
	'ACP_FB_FILTER_NEU'		=> 'neutral',
	'ACP_FB_FILTER_NEG'		=> 'negative',
	'ACP_FB_DETAILS'		=> 'Details',
	'ACP_FB_FROM'			=> 'From',
	'ACP_FB_ONDATE'			=> 'On',
	'ACP_FB_COMMENT'		=> 'Comment',
	'ACP_FB_IP'				=> 'IP',
	'ACP_FB_COMMENTOPT'		=> 'Comment (optional)',
	'ACP_FB_NOFOUND'		=> 'No feedback found',
	'ACP_FB_INVALIDLINK'	=> 'Invalid topic ID',	
	'ACP_FB_NEWFEEDBACK'	=> 'You have received a new feedback',
	'ACP_FB_NEWFEEDBACKMSG'	=> 'You have received a new %s feedback from %s'
));
			
?>