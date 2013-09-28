<?php
/** 
*
* shmk user feedback [French]
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
	'ACP_FB'		=> 'Feedbacks des utilisateurs',
	'ACP_FB_PREFS'	=> 'Pr&eacute;f&eacute;rences',
	'ACP_FB_MANAGE'	=> 'G&eacute;rer les Feedbacks',
	// Preferences
	'ACP_FB_PERM_EXPLAIN'	=> '
	<p> Pour r&eacute;gler les permissions d\'utilisateur et de mod&eacute;rateur, allez dans Permissions -> Permissions des groupes<br /> Apr&egrave;s pour chaque groupe, r&eacute;gler les permissions dans la cat&eacute;gorie "Feedback" comme vous le souhaitez.</p>
	',
	'ACP_FB_ROLE_SET'		=> 'R&eacute;glages des r&ocirc;les',
	'ACP_FB_ROLE_ENABLE'	=> 'Ajouter le champ r&ocirc;le dans les feedback',
	'ACP_FB_SCORE_ENABLE'	=> 'Activer le syst&egrave;me de score',
	'ACP_FB_SCORE_POS'		=> 'Multiplicateur Positif',
	'ACP_FB_SCORE_NEU'		=> 'Multiplicateur Neutre',
	'ACP_FB_SCORE_NEG'		=> 'Multiplicateur Negatif',
	'ACP_FB_LINK_SET'		=> 'R&eacute;glages des liens',
	'ACP_FB_LINK_ENABLE'	=> 'Ajouter le lien du topic dans les champs<br />(si "non", les autres options seront ignor&eacute;s)',
	'ACP_FB_LINK_FORCE'		=> 'Lien du topic requis',
	'ACP_FB_LINK_FORCE_IN'	=> 'Un des traders doit avoir cr&eacute;&eacute; le topic',
	'ACP_FB_LINK_FORUM'		=> 'Les liens des topics doivent etre dans un de ces forums<br />(laisser blanc si vous ne voulez pas cette option)',
	'ACP_FB_LINK_FORUM_D'	=> 'Les id des forums s&eacute;par&eacute;s par des virgules (ex: 1,3,4)',
	'ACP_FB_COMM_SET'		=> 'R&eacute;glages des commentaires',
	'ACP_FB_COMM_MINCHARS'	=> 'Taille minimale(en caract&egrave;res)',
	'ACP_FB_COMM_MAXCHARS'	=> 'Taille maximale (en caract&egrave;res)',
	'ACP_FB_COMM_URL'		=> 'Les URL ajout&eacute;es deviennent des liens cliquables',
	'ACP_FB_ANTIFLOOD'		=> 'Anti-flood',
	'ACP_FB_ANTIFLOOD_DESC'	=> 'Temps n&eacute;cessaire, en secondes, pour que l\'utilisateur puisse rajouter une nouvelle feedback',
	'ACP_FB_ANTIFLOOD_SAME'	=> 'Temps n&eacute;cessaire, en secondes, pour que l\'utilisateur puisse rajouter une nouvelle feedback au m&ecirc;me utilisateur',
	'ACP_FB_RANKINGS'		=> 'Classement',
	'ACP_FB_TOP_MAIN'		=> 'Nombre d\'utilisateurs montr&eacute; dans la page d\'accueil "Meilleurs/Mauvais"',
	'ACP_FB_TOP_BEST'		=> 'Nombre d\'utilisateurs montr&eacute; dans le "Meilleurs traders"',
	'ACP_FB_TOP_WORST'		=> 'Nombre d\'utilisateurs montr&eacute; dans le "Mauvais traders"',
	'ACP_FB_IGNOREDACP'		=> '(ignor&eacute; dans l\'ACP)',
	'ACP_FB_CONFUPDATED'	=> 'Mise a jour des pr&eacute;ferences des Feedbacks',
	// Manage
	'ACP_FB_SEARCH'			=> 'Rechercher utilisateur',
	'ACP_FB_FEEDBACK'		=> 'Feedback',
	'ACP_FB_FEEDBACKOF'		=> 'Feedback de',
	'ACP_FB_SCORE'			=> 'Score',
	'ACP_FB_PERCENTAGE'		=> 'Feedbacks positives',
	'ACP_FB_BUYER'			=> 'Acheteur',
	'ACP_FB_SELLER'			=> 'Vendeur',
	'ACP_FB_TRADE'			=> 'Trade',
	'ACP_FB_POS'			=> 'Positive',
	'ACP_FB_NEU'			=> 'Neutre',
	'ACP_FB_NEG'			=> 'N&eacute;gative',
	'ACP_FB_LINK'			=> 'Trade topic ID',
	'ACP_FB_LINKOPT'		=> 'Trade topic ID (optionnel)',
	'ACP_FB_ADD'			=> 'Ajouter une Feedback',
	'ACP_FB_EDIT'			=> '&Eacute;diter Feedback',
	'ACP_FB_DELETE'			=> 'Supprimer Feedback',
	'ACP_FB_ADDED'			=> 'Feedback ajout&eacute;e, vous allez &ecirc;tre redirig&eacute; dans quelques secondes.',
	'ACP_FB_EDITED'			=> 'Feedback édit&eacute;e, vous allez &ecirc;tre redirig&eacute; dans quelques secondes.',	
	'ACP_FB_DELETED'		=> 'Feedback supprim&eacute;e, vous allez &ecirc;tre redirig&eacute; dans quelques secondes.',
	'ACP_FB_ROLE'			=> 'R&ocirc;le',
	'ACP_FB_ROLE_ALL'		=> 'Tous',
	'ACP_FB_ROLE_BUYER'		=> 'Acheteur',
	'ACP_FB_ROLE_SELLER'	=> 'Vendeur',
	'ACP_FB_ROLE_TRADE'		=> 'Trade',
	'ACP_FB_FILTER'			=> 'Filtre',
	'ACP_FB_FILTER_ALL'		=> 'Toutes',
	'ACP_FB_FILTER_POS'		=> 'positive',
	'ACP_FB_FILTER_NEU'		=> 'neutre',
	'ACP_FB_FILTER_NEG'		=> 'n&eacute;gative',
	'ACP_FB_DETAILS'		=> 'D&eacute;tails',
	'ACP_FB_FROM'			=> 'De',
	'ACP_FB_ONDATE'			=> 'Date',
	'ACP_FB_COMMENT'		=> 'Commentaires',
	'ACP_FB_IP'				=> 'IP',
	'ACP_FB_COMMENTOPT'		=> 'Commentaire (optionnel)',
	'ACP_FB_NOFOUND'		=> 'Pas de feedback trouv&eacute;e',
	'ACP_FB_INVALIDLINK'	=> 'ID du topic invalide',	
	'ACP_FB_NEWFEEDBACK'	=> 'Vous avez re&ccedil;u une nouvelle feedback',
	'ACP_FB_NEWFEEDBACKMSG'	=> 'Vous avez re&ccedil;u une feedback %s de %s'
));
			
?>