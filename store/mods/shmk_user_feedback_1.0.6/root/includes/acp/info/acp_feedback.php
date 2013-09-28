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
* @package module_install
*/
class acp_feedback_info
{
	function module()
	{
	return array(
		'filename'	=> 'acp_feedback',
		'title'		=> 'ACP_FB',
		'version'	=> '1.0.6',
		'modes'		=> array(
			'prefs'		=> array('title'=>'ACP_FB_PREFS','auth'=>'','cat'=>array('')),
			'manage'	=> array('title'=>'ACP_FB_MANAGE','auth'=>'','cat'=>array('')),
		));
	}
							
	function install()
	{
	}
								
	function uninstall()
	{
	}

}
?>