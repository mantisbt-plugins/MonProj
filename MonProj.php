<?php
include_once( 'plugins/MonProj/MonProj_api.php' );  

class MonProjPlugin extends MantisPlugin {
 
	function register() {
		$this->name        	= 'MonProj';
		$this->description 	= lang_get( 'MonProj_description' );
		$this->version     	= '1.13';
		$this->requires    	= array('MantisCore'       => '2.0.0',);
		$this->author      	= 'Cas Nuy';
		$this->contact     	= 'Cas-at-nuy.info';
		$this->url         	= 'http://www.nuy.info';
		$this->page			= 'config';
	}

	function init() { 
		event_declare('EVENT_ACCOUNT_DELETED');
		// above declaration may become obsolete once these are part of standard mantis

		plugin_event_hook('EVENT_REPORT_BUG', 'AddMon');
		plugin_event_hook('EVENT_ACCOUNT_DELETED', 'DelSelProj');
		plugin_event_hook('EVENT_MENU_ACCOUNT', 'SelProj');
	}

	function config() {
		// when project selected, start monitoring all open ( status  < RESOLVED )issues ( or just new ones)
		// when deselecting, remove monitoring from all issues ( or do not add to new ones only)
		return array(
			'MonProj_add_all'		=> ON,
			'MonProj_remove_all'	=> ON,
			'MonProj_admin'			=> ADMINISTRATOR,			);
	}

	function SelProj(){
		if( access_has_project_level( config_get( 'monitor_bug_threshold' ) ) && !current_user_is_anonymous() ) {
			return array( '<a href="' . plugin_page( 'manage_monitor' ) . '">' . lang_get( 'MonProj_description' ) .  '</a>', );
		} 
	}
	
	function AddMon($p_event,$p_bugdata){
		include( config_get( 'plugin_path' ) . 'MonProj' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'add_monitor.php');  
	}
	
	function DelSelProj($p_event,$f_user_id){
		$sql = "delete from {plugin_MonProj_monitored_projects} where user_id=$f_user_id";
		$result		= db_query($sql);
	}

 	function schema() {
		return array(
			array( 'CreateTableSQL', array( plugin_table( 'monitored_projects' ), "
						user_id 			I       NOTNULL UNSIGNED,
						project_id			I		NOTNULL UNSIGNED 
						" ) ),
		);
	} 
	
}
