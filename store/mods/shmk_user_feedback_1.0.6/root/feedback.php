<?php
/** 
*
* @package shmk user feedback
* @version $Id: feedback.php 1.0.6 shockmaker $
* @copyright (c) 2009 ShockMaker.com 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB',true);
$phpbb_root_path=(defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx=substr(strrchr(__FILE__,'.'),1);
include($phpbb_root_path.'common.'.$phpEx);
include_once($phpbb_root_path.'includes/message_parser.'.$phpEx);
include_once($phpbb_root_path.'includes/functions_privmsgs.'.$phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/feedback');
$user->add_lang('posting');

page_header($user->lang['FB_TITLE']);

$template->assign_block_vars('navlinks',array(
	'FORUM_NAME'	=> $user->lang['FB_FEEDBACK'],
	'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}feedback.$phpEx"),
));

if(!$auth->acl_get('u_fb_access')){
	trigger_error($user->lang['FB_CANNOTACCESS']);
}

$mode=request_var('mode','');
switch($mode){
	case "feedback":
		show_feedback(0);
		break;
	case "myfeedback":
		show_feedback(1);
		break;
	case "add":
		add_feedback();
		break;
	case "edit":
		edit_feedback();
		break;
	case "delete":
		delete_feedback();
		break;
	case "best";
		best_feedback();
		break;
	case "worst";
		worst_feedback();
		break;
	default:
		index();
}

$template->set_filenames(array(
	'body' => 'feedback_body.html'
));

page_footer();
exit();

// extract configuration from database
function getconfig(){
	global $db;
	
	$q='SELECT *
		FROM '.SHMK_FEEDBACKCONFIG_TABLE;
	$r=$db->sql_query($q);
	$conf=array();
	while($a=$db->sql_fetchrow($r)){
		$conf[$a['fb_config']]=$a['fb_config_val'];
	}
	$db->sql_freeresult($r);
	return $conf;
}

// main page
function index(){
	global $db, $config, $user, $template, $phpbb_root_path, $phpEx;
	$conf=getconfig();
	
	$r=extract_best_worst('best',$conf['top_main']);
	$template->assign_block_vars('best',array());
	while($a=$db->sql_fetchrow($r)){
		if(!$config['fb_score']){
			$template->assign_block_vars('best',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),			
				'FB_POS'		=> $a['fb_pos'],
				'FB_NEG'		=> $a['fb_neg'],
				'FB_NEU'		=> $a['fb_neu'],
			));
		}else{
			$template->assign_block_vars('best',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),			
				'FB_SCORE'		=> $a['fb_score'],
			));
		}	
	}
	$db->sql_freeresult($r);
	
	$r=extract_best_worst('worst',$conf['top_main']);
	$template->assign_block_vars('worst',array());
	while($a=$db->sql_fetchrow($r)){
		if(!$config['fb_score']){
			$template->assign_block_vars('worst',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_POS'		=> $a['fb_pos'],
				'FB_NEG'		=> $a['fb_neg'],
				'FB_NEU'		=> $a['fb_neu'],
			));
		}else{
			$template->assign_block_vars('worst',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_SCORE'		=> $a['fb_score'],
			));
		}
	}
	$db->sql_freeresult($r);
	
	$template->assign_vars(array(
		'FB_ACTION'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback"),
		'FB_MOREBEST'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=best"),
		'FB_MOREWORST'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=worst"),
		'FB_S_SCORE'	=> $config['fb_score'],
		'FB_PAGE'		=> 'index'
	));
}

// show the feedback page of a user
function show_feedback($my_feedback){
	global $db, $config, $user, $template, $phpbb_root_path, $phpEx, $auth;
	$conf=getconfig();
	
	if($my_feedback){
		if($user->data['user_id']==ANONYMOUS){
			login_box('');
		}
		$uid=$user->data['user_id'];
		$un='';
	}else{
		$uid=request_var('u',ANONYMOUS);
		$un=request_var('un','',true);
		if($uid==ANONYMOUS && !$un){
			trigger_error('NO_USER');
		}
	}
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
		$score=$a['fb_pos']*$config['fb_score_pos']+$a['fb_neu']*$config['fb_score_neu']+$a['fb_neg']*$config['fb_score_neg'];
		$percentage=0;
		$tot=$a['fb_pos']+$a['fb_neg'];
		if($tot){
			$percentage=round(($a['fb_pos']/$tot)*100);
		}
	}
	
	$template->assign_vars(array(
		'FB_TOUSER'			=> get_username_string('full',$uid,$un,$uc),
		'FB_SCORE'			=> $score,
		'FB_PERCENTAGE'		=> $percentage,
		'FB_POS'			=> $a['fb_pos'],
		'FB_NEG'			=> $a['fb_neg'],
		'FB_NEU'			=> $a['fb_neu'],
		'FB_ACTION'			=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=add&amp;user_id=$uid"),
		'FB_ROLE_ALL' 		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fv=$filter_vote&amp;$ord_type"),
		'FB_ROLE_BUYER'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=buyer&amp;fv=$filter_vote&amp;$ord_type"),
		'FB_ROLE_SELLER'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=seller&amp;fv=$filter_vote&amp;$ord_type"),
		'FB_ROLE_TRADE'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=trade&amp;fv=$filter_vote&amp;$ord_type"),
		'FB_FILTER_ALL'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;$ord_type"),
		'FB_FILTER_POS' 	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=positive&amp;$ord_type"),
		'FB_FILTER_NEU' 	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=neutral&amp;$ord_type"),
		'FB_FILTER_NEG'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=negative&amp;$ord_type"),
		'FB_ORDER_FROMA'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=from&amp;&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc"),
		'FB_ORDER_FROMD'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=from&amp;fr=$filter_role&amp;fv=$filter_vote"),
		'FB_ORDER_IPA'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=ip&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc"),
		'FB_ORDER_IPD'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=ip&amp;fr=$filter_role&amp;fv=$filter_vote"),				
		'FB_ORDER_DATEA'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=date&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc"),
		'FB_ORDER_DATED'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=$uid&amp;ord_by=date&amp;fr=$filter_role&amp;fv=$filter_vote"),
		'ATTACH_ICON_IMG'	=> $user->img('icon_topic_latest',''),
		'EDIT_IMG' 			=> $user->img('icon_post_edit',''),
		'DELETE_IMG'		=> $user->img('icon_post_delete',''),
		'FB_SHOWIP'			=> $auth->acl_get('m_fb_viewip'),
		'FB_S_ROLE'			=> $conf['role_enable'],
		'FB_S_LINK'			=> $conf['link_enable'],
		'FB_PAGE'			=> 'show'
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
		$role=decode_role($a['fb_role']);
		$vote=decode_vote($a['fb_vote']);
		if($a['fb_link']){
			$link="{$phpbb_root_path}viewtopic.php?t=".$a['fb_link'];
		}else{
			$link=false;
		}
		
		$comm_parser = new parse_message($a['fb_comment']);
		$comm_parser->bbcode_bitfield=$a['bbcode_bitfield'];
		$comm_parser->bbcode_uid=$a['bbcode_uid'];
		$comm_parser->format_display(true,$conf['comm_url'],true);
		
		$template->assign_block_vars('feedback',array(
			'FB_URL'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['fb_from']),
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
			'FB_EDIT'		=> ($auth->acl_get('m_fb_edit')||($auth->acl_get('u_fb_edit')&&$a['fb_from']==(int)$user->data['user_id'])),
			'FB_DELETE'		=> ($auth->acl_get('m_fb_delete')||($auth->acl_get('u_fb_delete')&&$a['fb_from']==(int)$user->data['user_id'])),
			'FB_EDITURL'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=edit&amp;feedback=".$a['fb_id']),
			'FB_DELETEURL'	=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=delete&amp;feedback=".$a['fb_id'])
		));
	}
}

// add a feedback
function add_feedback(){
	global $db, $user, $template, $phpbb_root_path, $phpEx, $auth, $config;
	$conf=getconfig();
	
	if($user->data['user_id']==ANONYMOUS) login_box('');
	
	if(!$auth->acl_get('u_fb_add')){
		trigger_error($user->lang['FB_CANNOTADD']);
	}
	
	$from_id=(int)$user->data['user_id'];
	$to_id=request_var('user_id',0);
	$submit=(isset($_POST['submit'])) ? true : false;
	
	if($from_id==$to_id){
		trigger_error($user->lang['FB_CANNOTYOURSELF']);
	}
	
	if(!$auth->acl_get('u_fb_addmore')){
		$q='SELECT fb_date
			FROM '.SHMK_FEEDBACK_TABLE."
			WHERE fb_from='$from_id'
				AND fb_to='$to_id'";
		$r=$db->sql_query($q);
		if($db->sql_fetchrow($r)){
			trigger_error($user->lang['FB_ALREADYVOTED']);
		}
		$db->sql_freeresult($r);
	}
	
	if($conf['antiflood']>0 && !$auth->acl_get('u_fb_ignoreflood')){
		$antiflood_time=time()-$conf['antiflood'];
		$q='SELECT fb_date
			FROM '.SHMK_FEEDBACK_TABLE."
			WHERE fb_from='$from_id'
				AND fb_date>'$antiflood_time'";
		$r=$db->sql_query($q);
		if($db->sql_fetchrow($r)){
			trigger_error(sprintf($user->lang['FB_ANTIFLOOD'],$conf['antiflood']));
		}
		$db->sql_freeresult($r);
	}
	
	if($conf['antiflood_same']>0 && !$auth->acl_get('u_fb_ignoreflood')){
		$antiflood_same_time=time()-$conf['antiflood_same'];
		$q='SELECT fb_date
			FROM '.SHMK_FEEDBACK_TABLE."
			WHERE fb_from='$from_id'
				AND fb_to='$to_id'
				AND fb_date>'$antiflood_same_time'";
		$r=$db->sql_query($q);
		if($db->sql_fetchrow($r)){
			trigger_error(sprintf($user->lang['FB_ANTIFLOOD_SAME'],$conf['antiflood_same']));
		}
		$db->sql_freeresult($r);
	}
	
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
				'FB_TOUSER'			=> get_username_string('full',$to_id,$a['username'],$a['user_colour']),
				'FB_ACTION'			=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=add"),
				'FB_HIDDEN'			=> $hidden,
				'FB_S_ROLE'			=> $conf['role_enable'],
				'FB_S_LINK'			=> $conf['link_enable'],
				'FB_S_LINK_FORCE'	=> $conf['link_force'],
				'FB_S_COMM_OPT'		=> $conf['comm_minchars'] ? false : true,
				'FB_PAGE'			=> 'add'
			));
	
		}else{
		
			if(!check_form_key('add_feedback')){
				trigger_error($user->lang['FORM_INVALID']);
			}
		
			$role=request_var('role',0);
			$vote=request_var('vote',0);
			$link=request_var('link',0);
			$comm=utf8_normalize_nfc(request_var('comment','',true));
			if($role!==1&&$role!==2) $role=0; // trade
			if($vote!==0&&$vote!==1) $vote=2; // neutral
			if($conf['link_enable']){
				if($link_error=check_link($link,$from_id,$to_id,$conf)){
					trigger_error($link_error);
				}
			}else{
				$link=0;
			}
			if(strlen($comm)<$conf['comm_minchars']){
				trigger_error(sprintf($user->lang['FB_COMMENT_SHORT'],$conf['comm_minchars']));
			}
			if(strlen($comm)>$conf['comm_maxchars']){
				trigger_error(sprintf($user->lang['FB_COMMENT_LONG'],$conf['comm_maxchars']));
			}
			
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
			$comm_parser->parse($auth->acl_get('u_fb_bbcode'),$conf['comm_url'],$auth->acl_get('u_fb_smilies'),false,false,false,true);
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

			$to_lang=(file_exists($phpbb_root_path.'language/'.$to_lang. "/mods/feedback.$phpEx")) ? $to_lang : $config['default_lang'];
			include($phpbb_root_path.'language/'.basename($to_lang)."/mods/feedback.$phpEx");
			
			if($vote===0){
				$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neg=fb_neg+1 WHERE fb_user='$to_id'");
				$vote_text=$lang['FB_FILTER_NEG'];
			}elseif($vote===1){
				$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_pos=fb_pos+1 WHERE fb_user='$to_id'");
				$vote_text=$lang['FB_FILTER_POS'];
			}else{
				$db->sql_query("UPDATE ".SHMK_FEEDBACKTOT_TABLE." SET fb_neu=fb_neu+1 WHERE fb_user='$to_id'");
				$vote_text=$lang['FB_FILTER_NEU'];
			}
			
			$pm_parser = new parse_message();
			$pm_parser->message=sprintf($lang['FB_NEWFEEDBACKMSG'],$vote_text,$user->data['username']);
			$pm_parser->parse(true,true,true,false,false,true,true);
			
			$pm_data = array(
				'from_user_id'		=> $user->data['user_id'],
				'from_user_ip'		=> $user->ip,
				'from_username'		=> $user->data['username'],
				'enable_sig'		=> false,
				'enable_bbcode'		=> false,
				'enable_smilies'	=> false,
				'enable_urls'		=> false,
				'icon_id'			=> 0,
				'bbcode_bitfield'	=> $pm_parser->bbcode_bitfield,
				'bbcode_uid'		=> $pm_parser->bbcode_uid,
				'message'			=> $pm_parser->message,
				'address_list'		=> array('u' => array($to_id => 'to')),
			);
	
			submit_pm('post',$lang['FB_NEWFEEDBACK'],$pm_data,false);
		
			meta_refresh(3,append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$to_id));
			trigger_error($user->lang['FB_ADDED']);
		}

	}else{
		trigger_error($user->lang['NO_USER']);
	}
}

// edit a feedback
function edit_feedback(){
	global $db, $user, $template, $phpbb_root_path, $phpEx, $auth, $config;
	$conf=getconfig();
	
	if($user->data['user_id']==ANONYMOUS) login_box('');
	
	$from_id=(int)$user->data['user_id'];
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
	
		if(!$auth->acl_get('m_fb_edit') && (!$auth->acl_get('u_fb_edit') || $a['fb_from']!=$from_id) ){
			trigger_error($user->lang['FB_CANNOTEDIT']);
		}
	
		if(!$submit){

			$hidden=build_hidden_fields(array(
				'submit'	=> true,
				'feedback'	=> $feed_id
			));
			
			$comm_parser = new parse_message($a['fb_comment']);
			$comm_parser->decode_message($a['bbcode_uid']);
			
			add_form_key('edit_feedback');
			$template->assign_vars(array(
				'FB_TOUSER'			=> get_username_string('full',$a['fb_to'],$a['username'],$a['user_colour']),
				'FB_ROLE'			=> $a['fb_role'],
				'FB_VOTE'			=> $a['fb_vote'],
				'FB_LINK'			=> $a['fb_link'] ? $a['fb_link'] : '',
				'FB_COMM'			=> $comm_parser->message,
				'FB_ACTION'			=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=edit"),
				'FB_HIDDEN'			=> $hidden,
				'FB_S_ROLE'			=> $conf['role_enable'],
				'FB_S_LINK'			=> $conf['link_enable'],
				'FB_S_LINK_FORCE'	=> $conf['link_force'],
				'FB_S_COMM_OPT'		=> $conf['comm_minchars'] ? false : true,
				'FB_PAGE'			=> 'edit'
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
			if($conf['link_enable']){
				if($link_error=check_link($link,$a['fb_from'],$a['fb_to'],$conf)){
					trigger_error($link_error);
				}
			}else $link=0;
			if(strlen($comm)<$conf['comm_minchars']){
				trigger_error(sprintf($user->lang['FB_COMMENT_SHORT'],$conf['comm_minchars']));
			}
			if(strlen($comm)>$conf['comm_maxchars']){
				trigger_error(sprintf($user->lang['FB_COMMENT_LONG'],$conf['comm_maxchars']));
			}

			$comm_parser = new parse_message($comm);
			$comm_parser->parse($auth->acl_get('u_fb_bbcode'),$conf['comm_url'],$auth->acl_get('u_fb_smilies'),false,false,false,true);
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
		
			meta_refresh(3,append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['fb_to']));
			trigger_error($user->lang['FB_EDITED']);
		}
	}else{
		trigger_error($user->lang['FB_NOFOUND']);
	}
}

// delete a feedback
function delete_feedback(){
	global $db, $user, $template, $phpbb_root_path, $phpEx, $auth;
	$conf=getconfig();

	if($user->data['user_id']==ANONYMOUS) login_box('');
	
	$confirm=false;
	if(confirm_box(true)){
		$confirm=true;
	}else{
		confirm_box(false,$user->lang['FB_DELETE']);
	}

	$from_id=(int)$user->data['user_id'];
	$feed_id=request_var('feedback',0);
		
	$q='SELECT
		f.fb_to,
		f.fb_from,
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
			meta_refresh(1,append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['fb_to']));
			trigger_error($user->lang['BACK_TO_PREV']);
		}
	
		if(!$auth->acl_get('m_fb_delete') && (!$auth->acl_get('u_fb_delete') || $a['fb_from']!=$from_id) ){
			trigger_error($user->lang['FB_CANNOTDELETE']);
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
		
		meta_refresh(3,append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['fb_to']));
		trigger_error($user->lang['FB_DELETED']);
	}else{
		trigger_error($user->lang['FB_NOFOUND']);
	}
}

// show the best users
function best_feedback(){
	global $db, $config, $user, $template, $phpbb_root_path, $phpEx;
	$conf=getconfig();

	$r=extract_best_worst('best',$conf['top_best']);
	$template->assign_block_vars('best',array());
	while($a=$db->sql_fetchrow($r)){
		if(!$config['fb_score']){
			$template->assign_block_vars('best',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_POS'		=> $a['fb_pos'],
				'FB_NEG'		=> $a['fb_neg'],
				'FB_NEU'		=> $a['fb_neu'],
			));
		}else{
			$template->assign_block_vars('best',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_SCORE'		=> $a['fb_score'],
			));
		}
	}

	$template->assign_vars(array(
		'FB_S_SCORE'	=> $config['fb_score'],
		'FB_PAGE'		=> 'best'
	));
}

// show the worst users
function worst_feedback(){
	global $db, $config, $user, $template, $phpbb_root_path, $phpEx;
	$conf=getconfig();

	$r=extract_best_worst('worst',$conf['top_worst']);
	$template->assign_block_vars('worst',array());
	while($a=$db->sql_fetchrow($r)){
		if(!$config['fb_score']){
			$template->assign_block_vars('worst',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_POS'		=> $a['fb_pos'],
				'FB_NEG'		=> $a['fb_neg'],
				'FB_NEU'		=> $a['fb_neu'],
			));
		}else{
			$template->assign_block_vars('worst',array(
				'FB_LINK'		=> append_sid("{$phpbb_root_path}feedback.$phpEx","mode=feedback&amp;u=".$a['user_id']),
				'FB_USER'		=> get_username_string('username',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_USER_COL'	=> get_username_string('colour',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_PROFILE'	=> get_username_string('profile',$a['user_id'],$a['username'],$a['user_colour']),
				'FB_SCORE'		=> $a['fb_score'],
			));
		}
	}

	$template->assign_vars(array(
		'FB_S_SCORE'	=> $config['fb_score'],
		'FB_PAGE'		=> 'worst'
	));
}

// decode role to text
function decode_role($r){
	global $user;
	
	if($r==1) return '<span class="buyer">'.$user->lang['FB_ROLE_BUYER'].'</span>';
	elseif($r==2) return '<span class="seller">'.$user->lang['FB_ROLE_SELLER'].'</span>';
	else return '<span class="trade">'.$user->lang['FB_ROLE_TRADE'].'</span>';
}

// decode vote to text
function decode_vote($v){
	global $user;
	
	if($v==1) return '<span class="positive">'.$user->lang['FB_FILTER_POS'].'</span>';
	elseif($v==2) return '<span class="neutral">'.$user->lang['FB_FILTER_NEU'].'</span>';
	else return '<span class="negative">'.$user->lang['FB_FILTER_NEG'].'</span>';
}

// check if topic inserted is valid
function check_link($topic,$from,$to,$conf){
	global $db, $user;
	
	if(!$conf['link_force'] && $topic==0) return false;
	
	$q='SELECT
		forum_id,
		topic_poster
		FROM '.TOPICS_TABLE."
		WHERE topic_id='$topic'";
	$r=$db->sql_query_limit($q,1);
	$a=$db->sql_fetchrow($r);
	$db->sql_freeresult($r);
	if($a){
		if($conf['link_forum']){
			if(!in_array($a['forum_id'],explode(',',$conf['link_forum']))){
				return sprintf($user->lang['FB_INVALIDLINK2'],$conf['link_forum']);
			}
		}
		if($conf['link_force_in']){
			if(($a['topic_poster']!=$from)&&($a['topic_poster']!=$to)){
				return $user->lang['FB_INVALIDLINK3'];
			}
		}
		return false;
	}
	return $user->lang['FB_INVALIDLINK'];
}

// extract best or worst users
function extract_best_worst($bw,$x){
	global $db, $config;

	if(!$config['fb_score']){
		if($bw==='worst'){
			$bw='fb_neg DESC, fb_pos ASC, fb_neu ASC';
		}else{
			$bw='fb_pos DESC, fb_neg ASC, fb_neu ASC';
		}
		$q='SELECT
			f.fb_pos,
			f.fb_neg,
			f.fb_neu,
			u.user_id,
			u.username,
			u.user_colour
			FROM '.SHMK_FEEDBACKTOT_TABLE.' as f, '.USERS_TABLE." as u
			WHERE u.user_id=f.fb_user
			ORDER BY $bw";
	}else{
		if($bw==='worst'){
			$bw='ASC';
		}else{
			$bw='DESC';
		}
		$q='SELECT
			((f.fb_pos*'.$config['fb_score_pos'].')+
			(f.fb_neg*'.$config['fb_score_neg'].')+
			(f.fb_neu*'.$config['fb_score_neu'].')) as fb_score,
			u.user_id,
			u.username,
			u.user_colour
			FROM '.SHMK_FEEDBACKTOT_TABLE.' as f, '.USERS_TABLE." as u
			WHERE u.user_id=f.fb_user
			ORDER BY fb_score $bw";
	}
	return $r=$db->sql_query_limit($q,abs((int)$x));
}

?>