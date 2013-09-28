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

$lang = array_merge($lang, array(
	'FB_TITLE'			=> 'Feedbacks des utilisateurs',
	'FB_FEEDBACK'		=> 'Feedback',
	'FB_FEEDBACKOF'		=> 'Feedback de',
	'FB_MAIN'			=> 'Page principale',
	'FB_BEST_USERS'		=> 'Meilleurs traders',
	'FB_WORST_USERS'	=> 'Mauvais traders',
	'FB_VIEWMORE'		=> 'Voir plus',	
	'FB_SEARCH'			=> 'Rechercher les feedbacks de',
	'FB_SCORE'			=> 'Score',
	'FB_PERCENTAGE'		=> 'Feedbacks positives',
	'FB_BUYER'			=> 'Acheteur',
	'FB_SELLER'			=> 'Vendeur',
	'FB_TRADE'			=> 'Trade',
	'FB_POS'			=> 'Positive',
	'FB_NEU'			=> 'Neutre',
	'FB_NEG'			=> 'N&eacute;gative',
	'FB_LINK'			=> 'ID du topic de trade',
	'FB_LINKOPT'		=> 'ID du topic de trade (optionnel)',
	'FB_ADD'			=> 'Ajouter Feedback',
	'FB_EDIT'			=> '&Eacute;diter Feedback',
	'FB_DELETE'			=> 'Supprimer Feedback',
	'FB_RANK'			=> 'Rang',
	'FB_USER'			=> 'Utilisateur',
	'FB_ROLE'			=> 'R&ocirc;le',
	'FB_ROLE_ALL'		=> 'Tous',
	'FB_ROLE_BUYER'		=> 'Acheteur',
	'FB_ROLE_SELLER'	=> 'Vendeur',
	'FB_ROLE_TRADE'		=> 'Trade',
	'FB_FILTER'			=> 'Filtre',
	'FB_FILTER_ALL'		=> 'Toutes',
	'FB_FILTER_POS'		=> 'positive',
	'FB_FILTER_NEU'		=> 'neutre',
	'FB_FILTER_NEG'		=> 'n&eacute;gative',
	'FB_DETAILS'		=> 'D&eacute;tails',
	'FB_FROM'			=> 'De',
	'FB_ONDATE'			=> 'Date',
	'FB_COMMENT'		=> 'Commentaires',
	'FB_IP'				=> 'IP',
	'FB_COMMENTOPT'		=> 'Commentaire (optionnel)',
	'FB_ADDED'			=> 'Feedback ajout&eacute;e, vous allez &ecirc;tre redirig&eacute; dans quelques secondes.',
	'FB_EDITED'			=> 'Feedback edit&eacute;e, vous allez &ecirc;tre redirig&eacute; dans quelques secondes.',
	'FB_DELETED'		=> 'Feedback supprim&eacute;e, vous allez &ecirc;tre redirig&eacute; dans quelques secondes.',
	'FB_ALREADYVOTED'	=> 'Vous avez d&eacute;ja donn&eacute; une feedback pour ce membre',
	'FB_NOFOUND'		=> 'Pas de feedback trouv&eacute;e',
	'FB_CANNOTACCESS'	=> 'Vous ne pouvez pas acc&egrave;der au module feedback',
	'FB_CANNOTYOURSELF'	=> 'Vous ne pouvez pas vous rajouter de feedback',
	'FB_CANNOTADD'		=> 'Vous ne pouvez pas ajouter de feedback',
	'FB_CANNOTEDIT'		=> 'Vous ne pouvez pas &eacute;diter cette feedback',
	'FB_CANNOTDELETE'	=> 'Vous ne pouvez pas supprimer cette feedback',
	'FB_ANTIFLOOD'		=> 'Vous ne pouvez rajouter une feedback que toutes les %s secondes',
	'FB_ANTIFLOOD_SAME'	=> 'Vous ne pouvez rajouter une feedback au m&ecirc;me utilisateur que toutes les %s secondes',
	'FB_INVALIDLINK'	=> 'ID du topic invalide',
	'FB_INVALIDLINK2'	=> 'ID du topic invalide, seul les topics du forum %s sont valides',
	'FB_INVALIDLINK3'	=> 'ID du topic invalide, le topic doit avoir &eacute;t&eacute; cr&eacute;&eacute; par vous ou par votre trader',
	'FB_NEWFEEDBACK'	=> 'Vous avez re&ccedil;u une nouvelle feedback',
	'FB_NEWFEEDBACKMSG'	=> 'Vous avec re&ccedil;u une nouvelle feedback %s de %s',
	'FB_COMMENT_SHORT'	=> 'Vous devez ins&eacute;rer un commentaire d\' au moins %d caracteres',
	'FB_COMMENT_LONG'	=> 'Vous ne pouvez pas ajouter un commentaire de plus de %d caracteres'
));

?>