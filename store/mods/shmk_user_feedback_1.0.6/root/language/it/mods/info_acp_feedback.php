<?php
/** 
*
* shmk user feedback [Italian]
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
	'ACP_FB'		=> 'Referenze Utente',
	'ACP_FB_PREFS'	=> 'Preferenze',
	'ACP_FB_MANAGE'	=> 'Gestione Referenze',
	// Preferences
	'ACP_FB_PERM_EXPLAIN'	=> '
	<p>Per settare i poteri di utenti e moderatori vai in Permessi -> Permessi Gruppi<br />quindi per ogni gruppo setta i permessi della categoria "Feedback" come vuoi.</p>
	',
	'ACP_FB_ROLE_SET'		=> 'Opzioni Ruolo',
	'ACP_FB_ROLE_ENABLE'	=> 'Aggiungi il campo Ruolo alla referenza',
	'ACP_FB_SCORE_ENABLE'	=> 'Abilita lo score',
	'ACP_FB_SCORE_POS'		=> 'Moltiplicatore positive',
	'ACP_FB_SCORE_NEU'		=> 'Moltiplicatore neutrali',
	'ACP_FB_SCORE_NEG'		=> 'Moltiplicatore negative',
	'ACP_FB_LINK_SET'		=> 'Opzioni Link',
	'ACP_FB_LINK_ENABLE'	=> 'Aggiungi il campo Link al Topic alla referenza<br />(se settato a "no", le prossime opzioni saranno ignorate)',
	'ACP_FB_LINK_FORCE'		=> 'Inserire un link è obbligatorio',
	'ACP_FB_LINK_FORCE_IN'	=> 'Uno dei soggetti deve aver creato il topic collegato',
	'ACP_FB_LINK_FORUM'		=> 'Il topic collegato deve essere in uno di questi forum<br />(lascia vuoto se non vuoi questo controllo)',
	'ACP_FB_LINK_FORUM_D'	=> 'Forum ID separati da virgola (es: 1,3,4)',
	'ACP_FB_COMM_SET'		=> 'Opzioni dei Commenti',
	'ACP_FB_COMM_MINCHARS'	=> 'Lunghezza minima (in caratteri)',
	'ACP_FB_COMM_MAXCHARS'	=> 'Lunghezza massima (in caratteri)',
	'ACP_FB_COMM_URL'		=> 'Gli URL inseriti diventeranno Link cliccabili',
	'ACP_FB_ANTIFLOOD'		=> 'Anti-flood',
	'ACP_FB_ANTIFLOOD_DESC'	=> 'Lasso di tempo, in secondi, dopo il quale l’utente può inserire una nuova referenza',
	'ACP_FB_ANTIFLOOD_SAME'	=> 'Lasso di tempo, in secondi, dopo il quale l’utente può inserire una nuova referenza allo stesso utente',
	'ACP_FB_RANKINGS'		=> 'Classifica',
	'ACP_FB_TOP_MAIN'		=> 'Utenti mostrati in Migliori/Peggiori nella pagina principale',
	'ACP_FB_TOP_BEST'		=> 'Utenti mostrati nella pagina Migliori Utenti',
	'ACP_FB_TOP_WORST'		=> 'Utenti mostrati nella pagina Peggiori Utenti',
	'ACP_FB_IGNOREDACP'		=> '(ignorato nell’ACP)',
	'ACP_FB_CONFUPDATED'	=> 'Preferenze Referenze aggiornate',
	// Manage
	'ACP_FB_SEARCH'			=> 'Ricerca Utente',
	'ACP_FB_FEEDBACK'		=> 'Referenze',
	'ACP_FB_FEEDBACKOF'		=> 'Referenze di',
	'ACP_FB_SCORE'			=> 'Score',
	'ACP_FB_PERCENTAGE'		=> 'Feedback positivi',
	'ACP_FB_BUYER'			=> 'Compratore',
	'ACP_FB_SELLER'			=> 'Venditore',
	'ACP_FB_TRADE'			=> 'Scambio',
	'ACP_FB_POS'			=> 'Positiva',
	'ACP_FB_NEU'			=> 'Neutrale',
	'ACP_FB_NEG'			=> 'Negativa',
	'ACP_FB_LINK'			=> 'ID Topic trattativa',
	'ACP_FB_LINKOPT'		=> 'ID Topic trattativa (opzionale)',
	'ACP_FB_ADD'			=> 'Aggiungi Referenza',
	'ACP_FB_EDIT'			=> 'Modifica Referenza',
	'ACP_FB_DELETE'			=> 'Cancella Referenza',
	'ACP_FB_ADDED'			=> 'Referenza aggiunta, sarai a breve reindirizzato alle referenze utente.',
	'ACP_FB_EDITED'			=> 'Referenza modificata, sarai a breve reindirizzato alle referenze utente.',	
	'ACP_FB_DELETED'		=> 'Referenza cancellata, sarai a breve reindirizzato alle referenze utente.',
	'ACP_FB_ROLE'			=> 'Ruolo',
	'ACP_FB_ROLE_ALL'		=> 'tutte',
	'ACP_FB_ROLE_BUYER'		=> 'compratore',
	'ACP_FB_ROLE_SELLER'	=> 'venditore',
	'ACP_FB_ROLE_TRADE'		=> 'scambio',
	'ACP_FB_FILTER'			=> 'Filtro',
	'ACP_FB_FILTER_ALL'		=> 'tutte',
	'ACP_FB_FILTER_POS'		=> 'positiva',
	'ACP_FB_FILTER_NEU'		=> 'neutrale',
	'ACP_FB_FILTER_NEG'		=> 'negativa',
	'ACP_FB_DETAILS'		=> 'Dettagli',
	'ACP_FB_FROM'			=> 'Da',
	'ACP_FB_ONDATE'			=> 'Il',
	'ACP_FB_COMMENT'		=> 'Commento',
	'ACP_FB_IP'				=> 'IP',
	'ACP_FB_COMMENTOPT'		=> 'Commento (opzionale)',
	'ACP_FB_NOFOUND'		=> 'Nessuna referenza trovata',
	'ACP_FB_INVALIDLINK'	=> 'Topic ID non valido',
	'ACP_FB_NEWFEEDBACK'	=> 'Hai ricevuto una nuova referenza',
	'ACP_FB_NEWFEEDBACKMSG'	=> 'Hai ricevuto una nuova referenza %s da %s',
));
			
?>