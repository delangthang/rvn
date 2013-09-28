<?php
/**
*
* shmk user feedback [Italian]
*
* @package language
* @version $Id: permissions_feedback.php 1.0.6 shockmaker $
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

$lang['permission_cat']['feedback'] = 'Feedback';

$lang = array_merge($lang, array(
	'acl_u_fb_access'		=> array('lang' => 'Può accedere alla mod referenze', 'cat' => 'feedback'),
	'acl_u_fb_viewdetails'	=> array('lang' => 'Può vedere i dettagli nella pagina referenze', 'cat' => 'feedback'),
	'acl_u_fb_add'			=> array('lang' => 'Può inserire referenze', 'cat' => 'feedback'),
	'acl_u_fb_edit'			=> array('lang' => 'Può modificare i suoi feedback', 'cat' => 'feedback'),
	'acl_u_fb_delete'		=> array('lang' => 'Può cancellare i suoi feedback', 'cat' => 'feedback'),
	'acl_u_fb_addmore'		=> array('lang' => 'Può inserire più di una referenza allo stesso utente', 'cat' => 'feedback'),
	'acl_u_fb_ignoreflood'	=> array('lang' => 'Può ignorare i limiti dell’antiflood', 'cat' => 'feedback'),
	'acl_u_fb_bbcode'		=> array('lang' => 'Può usare BBCode nei commenti', 'cat' => 'feedback'),
	'acl_u_fb_smilies'		=> array('lang' => 'Può usare smilies nei commenti', 'cat' => 'feedback'),
	'acl_m_fb_edit'			=> array('lang' => 'Può modificare i feedback', 'cat' => 'feedback'),
	'acl_m_fb_delete'		=> array('lang' => 'Può cancellare i feedback', 'cat' => 'feedback'),
	'acl_m_fb_viewip'		=> array('lang' => 'Can view IPs', 'cat' => 'feedback'),
));

?>