<?php
/**
*
* shmk user feedback [Italian]
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
	'FB_TITLE'			=> 'Referenze Utente',
	'FB_FEEDBACK'		=> 'Referenze',
	'FB_FEEDBACKOF'		=> 'Referenze di',
	'FB_MAIN'			=> 'Pagina Principale',
	'FB_BEST_USERS'		=> 'Migliori Utenti',
	'FB_WORST_USERS'	=> 'Peggiori Utenti',
	'FB_VIEWMORE'		=> 'Mostra altri',
	'FB_SEARCH'			=> 'Ricerca Referenze Utente',
	'FB_SCORE'			=> 'Score',
	'FB_PERCENTAGE'		=> 'Feedback positivi',
	'FB_BUYER'			=> 'Compratore',
	'FB_SELLER'			=> 'Venditore',
	'FB_TRADE'			=> 'Scambio',
	'FB_POS'			=> 'Positiva',
	'FB_NEU'			=> 'Neutrale',
	'FB_NEG'			=> 'Negativa',
	'FB_LINK'			=> 'ID Topic trattativa',
	'FB_LINKOPT'		=> 'ID Topic trattativa (opzionale)',
	'FB_ADD'			=> 'Aggiungi Referenza',
	'FB_EDIT'			=> 'Modifica Referenza',
	'FB_DELETE'			=> 'Cancella Referenza',
	'FB_RANK'			=> 'Posizione',
	'FB_USER'			=> 'Utente',
	'FB_ROLE'			=> 'Ruolo',
	'FB_ROLE_ALL'		=> 'tutte',
	'FB_ROLE_BUYER'		=> 'compratore',
	'FB_ROLE_SELLER'	=> 'venditore',
	'FB_ROLE_TRADE'		=> 'scambio',
	'FB_FILTER'			=> 'Filtro',
	'FB_FILTER_ALL'		=> 'tutte',
	'FB_FILTER_POS'		=> 'positiva',
	'FB_FILTER_NEU'		=> 'neutrale',
	'FB_FILTER_NEG'		=> 'negativa',
	'FB_DETAILS'		=> 'Dettagli',
	'FB_FROM'			=> 'Da',
	'FB_ONDATE'			=> 'Il',
	'FB_COMMENT'		=> 'Commento',
	'FB_IP'				=> 'IP',
	'FB_COMMENTOPT'		=> 'Commento (opzionale)',
	'FB_ADDED'			=> 'Referenza aggiunta, sarai a breve reindirizzato alle referenze utente.',
	'FB_EDITED'			=> 'Referenza modificata, sarai a breve reindirizzato alle referenze utente.',	
	'FB_DELETED'		=> 'Referenza cancellata, sarai a breve reindirizzato alle referenze utente.',
	'FB_ALREADYVOTED'	=> 'Hai già votato per questo utente',	
	'FB_NOFOUND'		=> 'Nessuna referenza trovata',
	'FB_CANNOTACCESS'	=> 'Non puoi accedere alla mod referenze',
	'FB_CANNOTYOURSELF'	=> 'Non puoi inserirti una referenza',
	'FB_CANNOTADD'		=> 'Non puoi inserire referenze',
	'FB_CANNOTEDIT'		=> 'Non puoi modificare questa referenza',
	'FB_CANNOTDELETE'	=> 'Non puoi cancellare questa referenza',
	'FB_INVALIDLINK'	=> 'Topic ID non valido',
	'FB_INVALIDLINK2'	=> 'Topic ID non valido, solo i topic dei forum %s sono validi',
	'FB_INVALIDLINK3'	=> 'Topic ID non valido, il topic deve essere stato creato da te o dal tuo partner nello scambio',
	'FB_ANTIFLOOD'		=> 'Puoi inserire una referenza soltanto ogni %s secondi',
	'FB_ANTIFLOOD'		=> 'Puoi inserire una referenza allo stesso utente soltanto ogni %s secondi',
	'FB_NEWFEEDBACK'	=> 'Hai ricevuto una nuova referenza',
	'FB_NEWFEEDBACKMSG'	=> 'Hai ricevuto una nuova referenza %s da %s',
	'FB_COMMENT_SHORT'	=> 'Devi inserire un commento di almeno %d caratteri',
	'FB_COMMENT_LONG'	=> 'Non puoi inserire un commento più lungo di %d caratteri'
));

?>