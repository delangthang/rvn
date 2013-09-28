<?php
/**
*
* @package shmk user feedback
* @version $Id: functions_feedback.php 1.0.6 shockmaker $
* @copyright (c) 2009 ShockMaker.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Retrieve user feedbacks
*
* @param string $uid the ID of the user
*/

function fb_get_user_feedback($uid){
	global $db, $config;
	
	$q='SELECT
		fb_pos,
		fb_neg,
		fb_neu
		FROM '.SHMK_FEEDBACKTOT_TABLE."
		WHERE fb_user='".(int)$uid."'";
	$r=$db->sql_query($q);
	if($a=$db->sql_fetchrow($r)){
		if($config['fb_score']){
			$score=$a['fb_pos']*$config['fb_score_pos']+$a['fb_neu']*$config['fb_score_neu']+$a['fb_neg']*$config['fb_score_neg'];
			$p=0;
			$tot=$a['fb_pos']+$a['fb_neg'];
			if($tot){
				$p=round(($a['fb_pos']/$tot)*100);
			}
			
			if($score==0)
				$c='neutral';
			elseif($score<0)
				$c='negative';
			else
				$c='positive';
			return "<span class=\"$c\">$score</span> ($p%)";
		}else{
			return '<span class="positive">'.$a['fb_pos'].'</span>|<span class="neutral">'.$a['fb_neu'].'</span>|<span class="negative">'.$a['fb_neg'].'</span>';
		}
	}else{
		if($config['fb_score']=='1'){
			return '<span class="neutral">0</span> (0%)';
		}else{
			return '<span class="positive">0</span>|<span class="neutral">0</span>|<span class="negative">0</span>';
		}
	}
	$db->sql_freeresult($r);
}

?>