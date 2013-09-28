<?php
//
//	file: adm/mods/lpacpf_version.php
//	author: Geolim4
//	begin: 21/01/2013
//	version: 1.0.1 - 18/03/2013
//	licence: http://opensource.org/licenses/gpl-license.php GNU Public License
//

// ignore
if ( !defined('IN_PHPBB') )
{
	exit;
}

class lpacpf_version
{
	function version()
	{
		return array(
			'author' => 'Geolim4',
			'title' => 'Limit Post as Count per Forum',
			'tag' => 'lpacpf',
			'version' => '1.0.1',
			'file' => array('geolim4.com', 'buildversion', 'lpacpf_version.xml'), //Direct link: http://geolim4.com/buildversion/lpacpf_version.xml
		);
	}
}
