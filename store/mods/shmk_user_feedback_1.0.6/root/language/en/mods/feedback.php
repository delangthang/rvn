<?php
/**
*
* shmk user feedback [English]
*
* @package language
* @version $Id: feedback.php 1.0.6 shockmaker $
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
	'FB_TITLE'			=> 'User Feedback',
	'FB_FEEDBACK'		=> 'Feedback',
	'FB_FEEDBACKOF'		=> 'Feedback of',
	'FB_MAIN'			=> 'Main Page',
	'FB_BEST_USERS'		=> 'Best Users',
	'FB_WORST_USERS'	=> 'Worst Users',
	'FB_VIEWMORE'		=> 'View More',	
	'FB_SEARCH'			=> 'Search User Feedback',
	'FB_SCORE'			=> 'Score',
	'FB_PERCENTAGE'		=> 'Positive Feedback',
	'FB_BUYER'			=> 'Buyer',
	'FB_SELLER'			=> 'Seller',
	'FB_TRADE'			=> 'Trade',
	'FB_POS'			=> 'Positive',
	'FB_NEU'			=> 'Neutral',
	'FB_NEG'			=> 'Negative',
	'FB_LINK'			=> 'Trade topic ID',
	'FB_LINKOPT'		=> 'Trade topic ID (optional)',
	'FB_ADD'			=> 'Add Feedback',
	'FB_EDIT'			=> 'Edit Feedback',
	'FB_DELETE'			=> 'Delete Feedback',
	'FB_RANK'			=> 'Rank',
	'FB_USER'			=> 'User',
	'FB_ROLE'			=> 'Role',
	'FB_ROLE_ALL'		=> 'all',
	'FB_ROLE_BUYER'		=> 'buyer',
	'FB_ROLE_SELLER'	=> 'seller',
	'FB_ROLE_TRADE'		=> 'trade',
	'FB_FILTER'			=> 'Filter',
	'FB_FILTER_ALL'		=> 'all',
	'FB_FILTER_POS'		=> 'positive',
	'FB_FILTER_NEU'		=> 'neutral',
	'FB_FILTER_NEG'		=> 'negative',
	'FB_DETAILS'		=> 'Details',
	'FB_FROM'			=> 'From',
	'FB_ONDATE'			=> 'On',
	'FB_COMMENT'		=> 'Comment',
	'FB_IP'				=> 'IP',
	'FB_COMMENTOPT'		=> 'Comment (optional)',
	'FB_ADDED'			=> 'Feedback added, you\'ll be redirected to user feedback in seconds.',
	'FB_EDITED'			=> 'Feedback edited, you\'ll be redirected to user feedback in seconds.',
	'FB_DELETED'		=> 'Feedback deleted, you\'ll be redirected to user feedback in seconds.',
	'FB_ALREADYVOTED'	=> 'You have already voted for this user',
	'FB_NOFOUND'		=> 'No feedback found',
	'FB_CANNOTACCESS'	=> 'You cannot access feedback mod',
	'FB_CANNOTYOURSELF'	=> 'You cannot insert a feedback to yourself',
	'FB_CANNOTADD'		=> 'You cannot add feedback',
	'FB_CANNOTEDIT'		=> 'You cannot edit this feedback',
	'FB_CANNOTDELETE'	=> 'You cannot delete this feedback',
	'FB_ANTIFLOOD'		=> 'You can insert a feedback only every %s seconds',
	'FB_ANTIFLOOD_SAME'	=> 'You can insert a feedback to the same user only every %s seconds',
	'FB_INVALIDLINK'	=> 'Invalid topic ID',
	'FB_INVALIDLINK2'	=> 'Invalid topic ID, only topics of forums %s are valid',
	'FB_INVALIDLINK3'	=> 'Invalid topic ID, the topic must be created by you or your trade partner',
	'FB_NEWFEEDBACK'	=> 'You have received new feedback',
	'FB_NEWFEEDBACKMSG'	=> 'You have received new %s feedback from %s',
	'FB_COMMENT_SHORT'	=> 'You have to insert a comment of at least %d characters',
	'FB_COMMENT_LONG'	=> 'You cannot insert a comment longer than %d characters'
));

?>