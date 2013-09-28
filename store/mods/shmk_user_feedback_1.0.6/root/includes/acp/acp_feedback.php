<?php
/** 
*
* @package acp
* @version $Id: acp_feedback.php 1.0.6 shockmaker $
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
* @package acp
*/
class acp_feedback
{
	var $u_action;
	
	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		
		include_once($phpbb_root_path.'includes/message_parser.'.$phpEx);
		include_once($phpbb_root_path.'includes/functions_privmsgs.'.$phpEx);
		
		$user->add_lang('posting');
		
		$this->tpl_name='acp_feedback';
		
		// extract configuration from database
		$q='SELECT *
			FROM '.SHMK_FEEDBACKCONFIG_TABLE;
		$r=$db->sql_query($q);
		$conf=array();
		while($a=$db->sql_fetchrow($r)){
			$conf[$a['fb_config']]=$a['fb_config_val'];
		}
		$db->sql_freeresult($r);
		
		switch($mode){

			case 'prefs':
				$this->page_title='ACP_FB_PREFS';
				
				$submit=(isset($_POST['submit'])) ? true : false;
				if($submit){
					$link_forum=request_var('link_forum','');
					$update=array(
						'm_haspower'	=> request_var('m_haspower',0),
						'u_canedit'		=> request_var('u_canedit',0),
						'u_morethenone'	=> request_var('u_morethenone',0),
						'role_enable'	=> request_var('role_enable',0),
						'link_enable'	=> request_var('link_enable',0),
						'link_force'	=> request_var('link_force',0),
						'link_force_in'	=> request_var('link_force_in',0),
						'link_forum'	=> preg_match('/^([0-9]+,)*[0-9]+$/D',$link_forum) ? $link_forum : '',
						'comm_minchars'	=> request_var('comm_minchars',0),
						'comm_maxchars'	=> request_var('comm_maxchars',0),
						'comm_bbcode'	=> request_var('comm_bbcode',0),
						'comm_smilies'	=> request_var('comm_smilies',0),
						'comm_url'		=> request_var('comm_url',0),
						'antiflood'		=> request_var('antiflood',0),
						'antiflood_same'=> request_var('antiflood_same',0),
						'top_main'		=> request_var('top_main',0),
						'top_best'		=> request_var('top_best',0),
						'top_worst'		=> request_var('top_worst',0)
					);
					foreach($update as $name => $value){
						$db->sql_query("UPDATE ".SHMK_FEEDBACKCONFIG_TABLE." SET fb_config_val='$value' WHERE fb_config='$name'");
					}
					
					$score=request_var('score',0);
					set_config('fb_score',$score);
					
					$score_pos=request_var('score_pos',1);
					set_config('fb_score_pos',$score_pos);
					
					$score_neu=request_var('score_neu',0);
					set_config('fb_score_neu',$score_neu);
					
					$score_neg=request_var('score_neg',-1);
					set_config('fb_score_neg',$score_neg);
														
					meta_refresh(3,append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=prefs"));
					trigger_error($user->lang['ACP_FB_CONFUPDATED']);
				}
				
				foreach($conf as $name => $val){
					$template->assign_vars(array(
						'FB_'.strtoupper($name) => $val,
					));
				}
				$db->sql_freeresult($r);
				$template->assign_vars(array(
					'FB_SCORE'		=> $config['fb_score'],
					'FB_SCORE_POS'	=> $config['fb_score_pos'],
					'FB_SCORE_NEU'	=> $config['fb_score_neu'],
					'FB_SCORE_NEG'	=> $config['fb_score_neg'],
					'FB_ACTION'		=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=prefs&amp;submit"),
					'ACP_FB_PAGE'	=> 'preferences'
				));
				break;

			case 'manage':
				$this->page_title='ACP_FB_MANAGE';

				$action=request_var('action','');
				
				if($action==="search"){
				
					$uid=request_var('u',ANONYMOUS);
					$un=request_var('un','',true);
					$filter_role=request_var('fr','all');
					$filter_vote=request_var('fv','all');
					$ord_by=request_var('ord_by','date');
					$ord_type=(isset($_GET['asc'])) ? 'asc' : 'desc';
					if(!in_array($filter_role,array('buyer','seller','trade'))) $filter_role='all';					
					if(!in_array($filter_vote,array('positive','neutral','negative'))) $filter_vote='all';					
					if(!in_array($ord_by,array('from','ip'))) $ord_by='date';
		
					$q='SELECT
						user_id,
						user_type,
						username,
						user_colour
						FROM '.USERS_TABLE.'
						WHERE '.(($un)?"username_clean='".$db->sql_escape(utf8_clean_string($un))."'":"user_id=$uid");
					$r=$db->sql_query($q);
					if(!$a=$db->sql_fetchrow($r)){
						trigger_error($user->lang['NO_USER']);
					}
					$db->sql_freeresult($r);
					if($a['user_type']==USER_IGNORE){
						trigger_error($user->lang['NO_USER']);		
					}
					$uid=$a['user_id'];
					$un=$a['username'];
					$uc=$a['user_colour'];
					
					$q='SELECT
						fb_pos,
						fb_neg,
						fb_neu
						FROM '.SHMK_FEEDBACKTOT_TABLE."
						WHERE fb_user='$uid'";
					$r=$db->sql_query($q);
					if(!$a=$db->sql_fetchrow($r)){
						$a['fb_pos']=0;
						$a['fb_neu']=0;
						$a['fb_neg']=0;
					}					
					$db->sql_freeresult($r);
					
					$score=false;
					$percentage=false;
					if($config['fb_score']){
						$score=$a['fb_pos']-$a['fb_neg'];
						$percentage=0;
						$tot=$a['fb_pos']+$a['fb_neg'];
						if($tot){
							$percentage=round(($a['fb_pos']/$tot)*100);
						}
					}
				
					$template->assign_vars(array(
						'FB_TOUSER'		=> get_username_string('full',$uid,$un,$uc),
						'FB_SCORE'		=> $score,
						'FB_PERCENTAGE'	=> $percentage,
						'FB_POS'		=> $a['fb_pos'],
						'FB_NEG'		=> $a['fb_neg'],
						'FB_NEU'		=> $a['fb_neu'],
						'FB_ACTION'		=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=add&amp;user_id=$uid"),
						'FB_ROLE_ALL'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fv=$filter_vote&amp;$ord_type"),
						'FB_ROLE_BUYER'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=buyer&amp;fv=$filter_vote&amp;$ord_type"),
						'FB_ROLE_SELLER'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=seller&amp;fv=$filter_vote&amp;$ord_type"),
						'FB_ROLE_TRADE'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=trade&amp;fv=$filter_vote&amp;$ord_type"),
						'FB_FILTER_ALL'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fr=$filter_role&amp;$ord_type"),
						'FB_FILTER_POS'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=positive&amp;$ord_type"),
						'FB_FILTER_NEU'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=neutral&amp;$ord_type"),
						'FB_FILTER_NEG'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=negative&amp;$ord_type"),
						'FB_ORDER_FROMA'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=from&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc"),
						'FB_ORDER_FROMD'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=from&amp;fr=$filter_role&amp;fv=$filter_vote"),
						'FB_ORDER_IPA'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=ip&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc"),
						'FB_ORDER_IPD'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=ip&amp;fr=$filter_role&amp;fv=$filter_vote"),				
						'FB_ORDER_DATEA'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=date&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc"),
						'FB_ORDER_DATED'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=date&amp;fr=$filter_role&amp;fv=$filter_vote"),
						'FB_S_ROLE'		=> $conf['role_enable'],
						'FB_S_LINK'		=> $conf['link_enable'],
						'FB_PAGE'		=> 'show'
					));

					$q='SELECT
						f.fb_id,
						f.fb_to,
						f.fb_from,
						f.fb_role,
						f.fb_vote,
						f.fb_link,
						f.fb_comment,
						f.fb_ip,
						f.fb_date,
						f.bbcode_bitfield,
						f.bbcode_uid,
						u.username,
						u.user_colour
						FROM '.SHMK_FEEDBACK_TABLE.' as f, '.USERS_TABLE." as u
						WHERE f.fb_to='$uid'
							AND u.user_id=f.fb_from";
					if($conf['role_enable']){
						if($filter_role==='trade'){
							$q.=" AND f.fb_role='0'";
						}elseif($filter_role==='buyer'){
							$q.=" AND f.fb_role='1'";
						}elseif($filter_role==='seller'){
							$q.=" AND f.fb_role='2'";
						}
					}
					if($filter_vote==='negative'){
						$q.=" AND f.fb_vote='0'";
					}elseif($filter_vote==='positive'){
						$q.=" AND f.fb_vote='1'";
					}elseif($filter_vote==='neutral'){
						$q.=" AND f.fb_vote='2'";
					}
					if($ord_by=='from'){
						$q.=" ORDER BY u.username_clean ".$ord_type;
					}elseif($ord_by=='ip'){
						$q.=" ORDER BY INET_ATON(f.fb_ip) ".$ord_type;						
					}else{
						$q.=" ORDER BY f.fb_".$ord_by." ".$ord_type;
					}
					$r=$db->sql_query($q);
					while($a=$db->sql_fetchrow($r)){
						if($a['fb_role']==1){
							$role=$user->lang['ACP_FB_ROLE_BUYER'];
						}elseif($a['fb_role']==2){
							$role=$user->lang['ACP_FB_ROLE_SELLER'];
						}else{
							$role=$user->lang['ACP_FB_ROLE_TRADE'];
						}
						if($a['fb_vote']==1){
							$vote='<span style="color:green;">'.$user->lang['ACP_FB_FILTER_POS'].'</span>';
						}elseif($a['fb_vote']==2){
							$vote='<span style="color:black;">'.$user->lang['ACP_FB_FILTER_NEU'].'</span>';
						}else{
							$vote='<span style="color:red;">'.$user->lang['ACP_FB_FILTER_NEG'].'</span>';
						}
						if($a['fb_link']){
							$link="{$phpbb_root_path}viewtopic.php?t=".$a['fb_link'];
						}else{
							$link=false;
						}
						
						$comm_parser = new parse_message($a['fb_comment']);
						$comm_parser->bbcode_bitfield=$a['bbcode_bitfield'];
						$comm_parser->bbcode_uid=$a['bbcode_uid'];
						$comm_parser->format_display(true,true,true);
					
						$template->assign_block_vars('feedback',array(
							'FB_URL'		=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=".$a['fb_from']),
							'FB_USER'		=> get_username_string('username',$a['fb_from'],$a['username'],$a['user_colour']),
							'FB_USER_COL'	=> get_username_string('colour',$a['fb_from'],$a['username'],$a['user_colour']),
							'FB_PROFILE'	=> get_username_string('profile',$a['fb_from'],$a['username'],$a['user_colour']),
							'FB_TO'			=> $a['fb_to'],
							'FB_FROM'		=> $a['fb_from'],
							'FB_ROLE'		=> $role,
							'FB_VOTE'		=> $vote,
							'FB_LINK'		=> $link,
							'FB_COMMENT'	=> $comm_parser->message,
							'FB_IP'			=> $a['fb_ip'],
							'FB_DATE'		=> $user->format_date($a['fb_date'],"d/m/y"),
							'FB_EDIT'		=> true,
							'FB_EDITURL'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=edit&amp;feedback=".$a['fb_id']),
							'FB_DELETEURL'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=delete&amp;feedback=".$a['fb_id']),
						));
					}
					
				}elseif($action==="add"){

					$to_id=request_var('user_id',0);
					$submit=(isset($_POST['submit'])) ? true : false;
					
					$q='SELECT
					user_type,
					username,
					user_lang,
					user_colour
					FROM '.USERS_TABLE."
					WHERE user_id='$to_id'";
					$r=$db->sql_query($q);
					$a=$db->sql_fetchrow($r);
					$db->sql_freeresult($r);
					if($a){
						if($a['user_type']==USER_IGNORE){
							trigger_error($user->lang['NO_USER']);		
						}
					
						$to_lang=$a['user_lang'];
						if(!$submit){

							$hidden=build_hidden_fields(array(
								'submit'	=> true,
								'user_id'	=> $to_id,
							));

							add_form_key('add_feedback');
							$template->assign_vars(array(
								'FB_TOUSER'	=> get_username_string('full',$to_id,$a['username'],$a['user_colour']),
								'FB_ACTION'	=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=add"),
								'FB_HIDDEN'	=> $hidden,
								'FB_S_ROLE'	=> $conf['role_enable'],
								'FB_S_LINK'	=> $conf['link_enable'],
								'FB_S_LINK_FORCE'	=> $conf['link_force'],
								'FB_PAGE'	=> 'add'
							));
						}else{
						
							if(!check_form_key('add_feedback')){
								trigger_error($user->lang['FORM_INVALID']);
							}
						
							$to_un=$a['username'];
							$from_un=request_var('from','',true);
							$role=request_var('role',0);
							$vote=request_var('vote',0);
							$link=request_var('link',0);
							$comm=utf8_normalize_nfc(request_var('comment','',true));
							if($role!==1&&$role!==2) $role=0; // trade
							if($vote!==0&&$vote!==1) $vote=2; // neutral
							
							$q='SELECT
								user_id
								FROM '.USERS_TABLE."
								WHERE username_clean='".$db->sql_escape(utf8_clean_string($from_un))."'";
							$r=$db->sql_query($q);
							if(!$a=$db->sql_fetchrow($r)){
								trigger_error($user->lang['NO_USER']);
							}
							$db->sql_freeresult($r);
							$from_id=$a['user_id'];
							
							$q='SELECT * 
								FROM '.SHMK_FEEDBACKTOT_TABLE."
								WHERE fb_user='$to_id'";
							$r=$db->sql_query($q);
							if(!$db->sql_fetchrow($r)){
								$insert=array(
									'fb_user'	=> $to_id
								);
								$db->sql_query("INSERT INTO ".SHMK_FEEDBACKTOT_TABLE." ".$db->sql_build_array('INSERT',$insert));
							}
							$db->sql_freeresult($r);
							
							$comm_parser = new parse_message($comm);
							$comm_parser->parse(true,true,true,false,false,false,true);
							
							$insert=array(
								'fb_to'				=> $to_id,
								'fb_from'			=> $from_id,
								'fb_role'			=> $role,
								'fb_vote'			=> $vote,
								'fb_link'			=> $link,
								'fb_comment'		=> $comm_parser->message,
								'fb_ip'				=> $user->ip,
								'fb_date'			=> time(),
								'bbcode_bitfield'	=> $comm_parser->bbcode_bitfield,
								'bbcode_uid'		=> $comm_parser->bbcode_uid,
							);
							$db->sql_query("INSERT INTO ".SHMK_FEEDBACK_TABLE." ".$db->sql_build_array('INSERT',$insert));
							
							$to_lang=(file_exists($phpbb_root_path.'language/'.$to_lang. "/mods/info_acp_feedback.$phpEx")) ? $to_lang : $config['default_lang'];
							include($phpbb_root_path.'language/'.basename($to_lang)."/mods/info_acp_feedback.$phpEx");

							if($vote===0){		
								$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neg=fb_neg+1 WHERE fb_user='$to_id'");
								$vote_text=$lang['ACP_FB_FILTER_NEG'];
							}elseif($vote===1){
								$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_pos=fb_pos+1 WHERE fb_user='$to_id'");
								$vote_text=$lang['ACP_FB_FILTER_POS'];
							}else{
								$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neu=fb_neu+1 WHERE fb_user='$to_id'");
								$vote_text=$lang['ACP_FB_FILTER_NEU'];
							}
							
							$pm_parser = new parse_message();
							$pm_parser->message=sprintf($lang['ACP_FB_NEWFEEDBACKMSG'],$vote_text,$from_un);
							$pm_parser->parse(true,true,true,false,false,true,true);
							
							$pm_data = array(
								'from_user_id'		=> $from_id,
								'from_user_ip'		=> $user->ip,
								'from_username'		=> $from_un,
								'enable_sig'		=> false,
								'enable_bbcode'		=> true,
								'enable_smilies'	=> true,
								'enable_urls'		=> false,
								'icon_id'			=> 0,
								'bbcode_bitfield'	=> $pm_parser->bbcode_bitfield,
								'bbcode_uid'		=> $pm_parser->bbcode_uid,
								'message'			=> $pm_parser->message,
								'address_list'		=> array('u' => array($to_id => 'to')),
							);
	
							submit_pm('post',$lang['ACP_FB_NEWFEEDBACK'],$pm_data,false);
		
							meta_refresh(3,append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=".$to_id));
							trigger_error($user->lang['ACP_FB_ADDED']);
						}
					}else{
						trigger_error($user->lang['NO_USER']);
					}
				
				}elseif($action==="edit"){
				
					$feed_id=request_var('feedback',0);
					$submit=(isset($_POST['submit'])) ? true : false;
	
					$q='SELECT
						f.fb_to,
						f.fb_from,
						f.fb_role,
						f.fb_vote,
						f.fb_link,
						f.fb_comment,
						f.bbcode_bitfield,
						f.bbcode_uid,
						u.username,
						u.user_colour
						FROM '.SHMK_FEEDBACK_TABLE.' as f, '.USERS_TABLE." as u
						WHERE f.fb_id='$feed_id'
							AND f.fb_to=u.user_id";
					$r=$db->sql_query($q);
					$a=$db->sql_fetchrow($r);
					$db->sql_freeresult($r);
					if($a){
						if(!$submit){
							$hidden=build_hidden_fields(array(
								'submit'	=> true,
								'feedback'	=> $feed_id
							));
							
							$comm_parser = new parse_message($a['fb_comment']);
							$comm_parser->decode_message($a['bbcode_uid']);
							
							add_form_key('edit_feedback');
							$template->assign_vars(array(
								'FB_FROM'		=> $a['fb_from'],
								'FB_TOUSER'		=> get_username_string('full',$a['fb_to'],$a['username'],$a['user_colour']),
								'FB_ROLE'		=> $a['fb_role'],
								'FB_VOTE'		=> $a['fb_vote'],
								'FB_LINK'		=> $a['fb_link'],
								'FB_COMM'		=> $comm_parser->message,
								'FB_ACTION'		=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=edit"),
								'FB_HIDDEN'		=> $hidden,
								'FB_S_ROLE'		=> $conf['role_enable'],
								'FB_S_LINK'		=> $conf['link_enable'],
								'FB_S_LINK_FORCE'	=> $conf['link_force'],
								'FB_PAGE'		=> 'edit'
							));
						}else{
						
							if(!check_form_key('edit_feedback')){
								trigger_error($user->lang['FORM_INVALID']);
							}

							$role=request_var('role',0);
							$vote=request_var('vote',0);
							$link=request_var('link',0);
							$comm=utf8_normalize_nfc(request_var('comment','',true));
							if($role!==1&&$role!==2) $role=0; // trade
							if($vote!==0&&$vote!==1) $vote=2; // neutral

							$comm_parser = new parse_message($comm);
							$comm_parser->parse(true,true,true,false,false,false,true);
							$update=array(
								'fb_to'				=> $a['fb_to'],
								'fb_from'			=> $a['fb_from'],
								'fb_role'			=> $role,
								'fb_vote'			=> $vote,
								'fb_link'			=> $link,
								'fb_comment'		=> $comm_parser->message,
								'fb_ip'				=> $user->ip,
								'fb_date'			=> time(),
								'bbcode_bitfield'	=> $comm_parser->bbcode_bitfield,
								'bbcode_uid'		=> $comm_parser->bbcode_uid,
							);
							$db->sql_query("UPDATE ".SHMK_FEEDBACK_TABLE." SET ".$db->sql_build_array('UPDATE',$update)." WHERE fb_id='$feed_id'");

							if($vote!=$a['fb_vote']){
								if($a['fb_vote']==0){	
									$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neg=fb_neg-1 WHERE fb_user='".$a['fb_to']."'");
								}elseif($a['fb_vote']==1){
									$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_pos=fb_pos-1 WHERE fb_user='".$a['fb_to']."'");		
								}else{
									$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neu=fb_neu-1 WHERE fb_user='".$a['fb_to']."'");
								}
								if($vote===0){	
									$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neg=fb_neg+1 WHERE fb_user='".$a['fb_to']."'");
								}elseif($vote===1){
									$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_pos=fb_pos+1 WHERE fb_user='".$a['fb_to']."'");		
								}else{
									$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neu=fb_neu+1 WHERE fb_user='".$a['fb_to']."'");
								}
							}				
		
							meta_refresh(3,append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=".$a['fb_to']));
							trigger_error($user->lang['ACP_FB_EDITED']);
						}
					}else{
						trigger_error($user->lang['FB_NOFOUND']);
					}
				
				}elseif($action==="delete"){
				
					if($user->data['user_id']==ANONYMOUS) login_box('');
					
					$confirm=false;
					if(confirm_box(true)){
						$confirm=true;
					}else{
						confirm_box(false,$user->lang['ACP_FB_DELETE']);
					}
					
					$from_id=(int)$user->data['user_id'];
					$feed_id=request_var('feedback',0);
					
					$q='SELECT
						f.fb_to,
						f.fb_vote,
						u.username
						FROM '.SHMK_FEEDBACK_TABLE.' as f, '.USERS_TABLE." as u
						WHERE f.fb_id='$feed_id'
							AND f.fb_to=u.user_id";
					$r=$db->sql_query($q);
					$a=$db->sql_fetchrow($r);
					$db->sql_freeresult($r);
					if($a){
					
						if(!$confirm){
							meta_refresh(1,append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=".$a['fb_to']));
							trigger_error($user->lang['BACK_TO_PREV']);
						}
					
						$db->sql_query("DELETE FROM ".SHMK_FEEDBACK_TABLE." WHERE fb_id='$feed_id'");

						if($a['fb_vote']==0){	
							$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neg=fb_neg-1 WHERE fb_user='".$a['fb_to']."'");
						}elseif($a['fb_vote']==1){
							$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_pos=fb_pos-1 WHERE fb_user='".$a['fb_to']."'");		
						}else{
							$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neu=fb_neu-1 WHERE fb_user='".$a['fb_to']."'");
						}
						
						$q='DELETE
							FROM '.SHMK_FEEDBACKTOT_TABLE."
							WHERE fb_pos='0'
							AND fb_neg='0'
							AND fb_neu='0'";
						$r=$db->sql_query($q);
						
						meta_refresh(3,append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search&amp;u=".$a['fb_to']));
						trigger_error($user->lang['ACP_FB_DELETED']);
					}else{
						trigger_error($user->lang['ACP_FB_NOFOUND']);
					}
				
				}else{
					$template->assign_vars(array(
						'FB_ACTION'		=> append_sid("{$phpbb_admin_path}index.$phpEx","i=feedback&amp;mode=manage&amp;action=search"),
						'ACP_FB_PAGE'	=> 'search'
					));
				}
				break;
			
			default:
		}
	}
}
			
?>