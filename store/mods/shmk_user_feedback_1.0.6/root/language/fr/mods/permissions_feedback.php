<?php
/**
*
* shmk user feedback [French]
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

$lang['permission_cat']['feedback'] = 'Feedback';

$lang = array_merge($lang, array(
	'acl_u_fb_access'		=> array('lang' => 'Peut acc&eacute;der au feedback mod', 'cat' => 'feedback'),
	'acl_u_fb_viewdetails'	=> array('lang' => 'Peut voir les d&eacute;tails dans la page des feedback', 'cat' => 'feedback'),
	'acl_u_fb_add'			=> array('lang' => 'Peut ajouter des feedback', 'cat' => 'feedback'),
	'acl_u_fb_edit'			=> array('lang' => 'Peut &eacute;diter ses feedback', 'cat' => 'feedback'),
	'acl_u_fb_delete'		=> array('lang' => 'Peut supprimer ses feedback', 'cat' => 'feedback'),
	'acl_u_fb_addmore'		=> array('lang' => 'Peut ajouter plus d\'une feedback par utilisateur', 'cat' => 'feedback'),
	'acl_u_fb_ignoreflood'	=> array('lang' => 'Peut ignorer la limite de flood', 'cat' => 'feedback'),
	'acl_u_fb_bbcode'		=> array('lang' => 'Peut utiliser le bbcode dans les commentaires', 'cat' => 'feedback'),
	'acl_u_fb_smilies'		=> array('lang' => 'Peut utiliser des smileys dans les commentaires', 'cat' => 'feedback'),
	'acl_m_fb_edit'			=> array('lang' => 'Peut &eacute;diter les feedback', 'cat' => 'feedback'),
	'acl_m_fb_delete'		=> array('lang' => 'Peut supprimer les feedback', 'cat' => 'feedback'),
	'acl_m_fb_viewip'		=> array('lang' => 'Peut voir les adresses IP', 'cat' => 'feedback'),
));

?>