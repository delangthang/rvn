<?php
/**
*
* shmk user feedback [Dutch]
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
	'FB_TITLE'			=> 'Gebruiker\'s feedback',
	'FB_FEEDBACK'		=> 'Feedback',
	'FB_FEEDBACKOF'		=> 'Feedback voor',
	'FB_MAIN'			=> 'Hoofd pagina',
	'FB_BEST_USERS'		=> 'Hall of fame',
	'FB_WORST_USERS'	=> 'Hall of shame',
	'FB_VIEWMORE'		=> 'Bekijk meer',	
	'FB_SEARCH'			=> 'Zoek Gebruiker\'s feedback',
	'FB_SCORE'			=> 'Score',
	'FB_PERCENTAGE'		=> 'Positieve Feedback',
	'FB_BUYER'			=> 'Koper',
	'FB_SELLER'			=> 'Verkoper',
	'FB_TRADE'			=> 'Ruiler',
	'FB_POS'			=> 'Positief',
	'FB_NEU'			=> 'Neutraal',
	'FB_NEG'			=> 'Negatief',
	'FB_LINK'			=> 'Onderwerp ID van de deal',
	'FB_LINKOPT'		=> 'Onderwerp ID van de deal(optioneel)',
	'FB_ADD'			=> 'Voeg feedback toe',
	'FB_EDIT'			=> 'Bewerk feedback',
	'FB_DELETE'			=> 'Verwijder Feedback',
	'FB_RANK'			=> 'Rang',
	'FB_USER'			=> 'Gebruiker',
	'FB_ROLE'			=> 'Rol',
	'FB_ROLE_ALL'		=> 'Alle',
	'FB_ROLE_BUYER'		=> 'Koper',
	'FB_ROLE_SELLER'	=> 'Verkoper',
	'FB_ROLE_TRADE'		=> 'Ruiler',
	'FB_FILTER'			=> 'Filter',
	'FB_FILTER_ALL'		=> 'alle',
	'FB_FILTER_POS'		=> 'positief',
	'FB_FILTER_NEU'		=> 'neutraal',
	'FB_FILTER_NEG'		=> 'negatief',
	'FB_DETAILS'		=> 'Details',
	'FB_FROM'			=> 'Van',
	'FB_ONDATE'			=> 'Op',
	'FB_COMMENT'		=> 'Commentaar',
	'FB_IP'				=> 'IP',
	'FB_COMMENTOPT'		=> 'Commentaar (optioneel)',
	'FB_ADDED'			=> 'Feedback is toegevoegd! Je wordt binnen enkele seconden doorverwezen',
	'FB_EDITED'			=> 'Feedback is bewerkt!, Je wordt binnen enkele seconden doorverwezen.',
	'FB_DELETED'		=> 'Feedback is verwijderd, Je wordt binnen enkele seconden doorverwezen.',
	'FB_ALREADYVOTED'	=> 'Je hebt al gestemd op deze gebruiker!',
	'FB_NOFOUND'		=> 'Er werd geen feedback gevonden',
	'FB_CANNOTACCESS'	=> 'You cannot access feedback mod',
	'FB_CANNOTYOURSELF'	=> 'Je kan geen feedback aan jezelf geven!',
	'FB_CANNOTADD'		=> 'You cannot add feedback',
	'FB_CANNOTEDIT'		=> 'Je beschikt niet over voldoende permissies om deze feedback aan te passen!',
	'FB_CANNOTDELETE'	=> 'Je beschikt niet over voldoende permissies om deze feedback te verwijderen',
	'FB_ANTIFLOOD'		=> 'Je kan slechts feedback toevoegen om de  %s seconden(3600=1uur!)',
	'FB_ANTIFLOOD_SAME'	=> 'Je kan pas opnieuw feedback toevoegen na %s seconden(3600=1 uur) aan dezelfde gebruiker',
	'FB_INVALIDLINK'	=> 'Ongeldig onderwerp ID',
	'FB_INVALIDLINK2'	=> 'Ongeldige onderwerp ID, alleen onderwerpen uit de volgende forums <strong>%s</strong> zijn geldig',
	'FB_INVALIDLINK3'	=> 'Invalid topic ID, the topic must be created by you or your trade partner',
	'FB_NEWFEEDBACK'	=> 'Je hebt zonet een nieuwe feedback ontvangen',
	'FB_NEWFEEDBACKMSG'	=> 'Je hebt zonet een nieuwe %s feedback ontvangen van  %s',
	'FB_COMMENT_SHORT'	=> 'Je moet een opmerking ingeven van op zijn minst %d tekens',
	'FB_COMMENT_LONG'	=> 'Je kan geen reactie toevoegen die meer dan  %d tekens bevat',
));

?>