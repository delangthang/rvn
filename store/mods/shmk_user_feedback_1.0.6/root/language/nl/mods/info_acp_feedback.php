<?php
/** 
*
* shmk user feedback [Dutch]
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
	'ACP_FB'		=> 'Gebruiker\'s feedback',
	'ACP_FB_PREFS'	=> 'Voorkeuren',
	'ACP_FB_MANAGE'	=> 'Beheer Feedback',
	// Preferences
	'ACP_FB_PERM_EXPLAIN'	=> '
	<p>To set user and moderators powers go to Permissions -> Groups’ Permissions<br />then for every group set the permissions inside category "Feedback" as you want.</p>
	',
	'ACP_FB_ROLE_SET'		=> 'Rollen instellingen',
	'ACP_FB_ROLE_ENABLE'	=> 'Add Role field in feedback',
	'ACP_FB_SCORE_ENABLE'	=> 'Schakel score systeem in(Ebay)',
	'ACP_FB_SCORE_POS'		=> 'Positieve multiplicatoreffecten',
	'ACP_FB_SCORE_NEU'		=> 'Neutrale multiplicatoreffecten',
	'ACP_FB_SCORE_NEG'		=> 'Negatieve multiplicatoreffecten',
	'ACP_FB_LINK_SET'		=> 'Link instellingen',
	'ACP_FB_LINK_ENABLE'	=> 'Onderwerp Link toevoegen in feedback veld <br />(Indien het is ingesteld op "nee",worden de volgende opties worden genegeerd)',
	'ACP_FB_LINK_FORCE'		=> 'Onderwerp link is vereist',
	'ACP_FB_LINK_FORCE_IN'	=> 'Een van de handelaren moet het onderwerp hebben gestart',
	'ACP_FB_LINK_FORUM'		=> 'Het gelinkt onderwerp moet uit een van deze forums komen<br />(Laat dit leeg als je het niet wilt gebruiken.)',
	'ACP_FB_LINK_FORUM_D'	=> 'Forum id\'s moeten door een komma gescheiden worden (bvb: 1,3,4)',
	'ACP_FB_COMM_SET'		=> 'Reactie instellingen',
	'ACP_FB_COMM_MINCHARS'	=> 'Minimale lengte (in tekens)',
	'ACP_FB_COMM_MAXCHARS'	=> 'Maximale lengte (in tekens)',
	'ACP_FB_COMM_URL'		=> 'De ingevoegde url wordt klikbaar',
	'ACP_FB_ANTIFLOOD'		=> 'Anti-flood',
	'ACP_FB_ANTIFLOOD_DESC'	=> 'Tijd in seconden, nadat een gebruiker een nieuwe feedback kan toevoegen(3600 is gelijk aan 1 uur)',
	'ACP_FB_ANTIFLOOD_SAME'	=> 'Tijd in seconden, nadat een gebruiker een nieuwe feedback kan toevoegen aan dezelfde gebruiker(3600 is gelijk aan 1 uur)',
	'ACP_FB_RANKINGS'		=> 'Rangen',
	'ACP_FB_TOP_MAIN'		=> 'Gebruikers die getoond worden in de beste/slechtste pagina',
	'ACP_FB_TOP_BEST'		=> 'Gebruikers die getoond worden in de beste pagina',
	'ACP_FB_TOP_WORST'		=> 'Gebruikers die getoond worden in de slechtste pagina',
	'ACP_FB_IGNOREDACP'		=> '(genegeerd in ACP)',
	'ACP_FB_CONFUPDATED'	=> 'Feedback voorkeurs instellingen bijgewerkt',
	// Manage
	'ACP_FB_SEARCH'			=> 'Zoek gebruiker',
	'ACP_FB_FEEDBACK'		=> 'Feedback',
	'ACP_FB_FEEDBACKOF'		=> 'Feedback van',
	'ACP_FB_SCORE'			=> 'Score',
	'ACP_FB_PERCENTAGE'		=> 'Positieve Feedback',
	'ACP_FB_BUYER'			=> 'Koper',
	'ACP_FB_SELLER'			=> 'verkoper',
	'ACP_FB_TRADE'			=> 'Ruiler',
	'ACP_FB_POS'			=> 'Positief',
	'ACP_FB_NEU'			=> 'Neutraal',
	'ACP_FB_NEG'			=> 'Negatief',
	'ACP_FB_LINK'			=> 'Handel onderwerp ID',
	'ACP_FB_LINKOPT'		=> 'Handel onderwerp (optional)',
	'ACP_FB_ADD'			=> 'Voeg feedback toe',
	'ACP_FB_EDIT'			=> 'Bewerk Feedback',
	'ACP_FB_DELETE'			=> 'Verwijder Feedback',
	'ACP_FB_ADDED'			=> 'Feedback is toegevoegd! Je wordt binnen enkele seconden doorverwezen.',
	'ACP_FB_EDITED'			=> 'Feedback is bewerkt!, Je wordt binnen enkele seconden doorverwezen.',	
	'ACP_FB_DELETED'		=> 'Feedback is verwijderd, Je wordt binnen enkele seconden doorverwezen.',
	'ACP_FB_ROLE'			=> 'Rol',
	'ACP_FB_ROLE_ALL'		=> 'alle',
	'ACP_FB_ROLE_BUYER'		=> 'Koper',
	'ACP_FB_ROLE_SELLER'	=> 'Verkoper',
	'ACP_FB_ROLE_TRADE'		=> 'Ruiler',
	'ACP_FB_FILTER'			=> 'Filter',
	'ACP_FB_FILTER_ALL'		=> 'alle',
	'ACP_FB_FILTER_POS'		=> 'positief',
	'ACP_FB_FILTER_NEU'		=> 'neutraal',
	'ACP_FB_FILTER_NEG'		=> 'negatief',
	'ACP_FB_DETAILS'		=> 'Details',
	'ACP_FB_FROM'			=> 'Van',
	'ACP_FB_ONDATE'			=> 'Op',
	'ACP_FB_COMMENT'		=> 'Reactie',
	'ACP_FB_IP'				=> 'IP',
	'ACP_FB_COMMENTOPT'		=> 'Reactie (optional)',
	'ACP_FB_NOFOUND'		=> 'Er werd geen feedback gevonden',
	'ACP_FB_INVALIDLINK'	=> 'Ongeldige onderwerp ID',	
	'ACP_FB_NEWFEEDBACK'	=> 'Je hebt zonet een nieuwe feedback ontvangen',
	'ACP_FB_NEWFEEDBACKMSG'	=> 'Je hebt zonet een nieuwe %s feedback ontvangen van  %s'
));
			
?>