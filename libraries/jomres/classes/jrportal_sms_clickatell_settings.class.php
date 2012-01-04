<?php
/**
* Core file
* @author Vince Wooll <sales@jomres.net>
* @version Jomres 6
* @package Jomres
* @copyright	2005-2012 Vince Wooll
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly, however all images, css and javascript which are copyright Vince Wooll are not GPL licensed and are not freely distributable. 
**/


// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class jrportal_sms_clickatell_settings
	{
	function jrportal_sms_clickatell_settings()
		{
		$this->sms_clickatellConfigOptions=array();
		$this->sms_clickatellConfigOptions['active']="";
		$this->sms_clickatellConfigOptions['api_id']="";
		$this->sms_clickatellConfigOptions['username']="";
		$this->sms_clickatellConfigOptions['password']="";
		}
	
	
	function get_sms_clickatell_settings()
		{
		
		$query="SELECT setting,value FROM #__jomres_pluginsettings WHERE prid = 0 AND plugin = 'backend_sms_clickatell_settings'";
		$settingList=doSelectSql($query);
		foreach ($settingList as $s)
			{
			$this->sms_clickatellConfigOptions[$s->setting]=$s->value;
			}
		return $this->sms_clickatellConfigOptions;
		}

	function save_sms_clickatell_settings()
		{
		
		foreach ($_POST as $k=>$v)
			{
			$dirty = (string) $k;
			$k=addslashes($dirty);
			if ($k!='task' && $k!='plugin' && $k !="jomrestoken" && $k !="option" )
				$values[$k]=jomresGetParam( $_POST, $k, "" );
			}
		foreach ($values as $k=>$v)
			{
			$query="SELECT id FROM #__jomres_pluginsettings WHERE prid = 0 AND plugin = 'backend_sms_clickatell_settings' AND setting = '$k'";
			$settingList=doSelectSql($query);
			if (count($settingList)>0)
				{
				foreach ($settingList as $set)
					{
					$id=$set->id;
					}
				$query="UPDATE #__jomres_pluginsettings SET `value`='$v' WHERE prid = 0 AND plugin = 'backend_sms_clickatell_settings' AND setting = '$k'";
				doInsertSql($query,"");
				}
			else
				{
				$query="INSERT INTO #__jomres_pluginsettings
					(`prid`,`plugin`,`setting`,`value`) VALUES
					(0,'backend_sms_clickatell_settings','$k','$v')";
				doInsertSql($query,"");
				}
			}
		}
	}

?>