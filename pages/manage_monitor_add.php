<?php

$f_project_id	= gpc_get_int_array( 'project_id', array() );
$f_user_id	= gpc_get_int( 'user_id' );

# We should check both since we are in the project section and an
#  admin might raise the first threshold and not realize they need
#  to raise the second
access_ensure_project_level( config_get( 'manage_project_threshold' ), $f_project_id );
access_ensure_project_level( config_get( 'project_user_threshold' ), $f_project_id );

# Add projects for monitoring
foreach( $f_project_id as $t_project_id ) {
	// insert record in plugin_table
	$sql = "insert into {plugin_MonProj_monitored_projects} (user_id,project_id) values ($f_user_id, $t_project_id)";
	$result	= db_query($sql);
	# do we need to create monitor records for all existing issues with status < RESOLVED?
	$add_his	= config_get( 'plugin_MonProj_MonProj_add_all' );
	If (ON == $add_his){
		$sql2 = "select id from {bug} where project_id = $t_project_id and status<80";
		$result2= db_query($sql2);
		while ($row = db_fetch_array($result2)) {
			$t_issue_id = $row['id'];
			bug_monitor( $t_issue_id, $f_user_id ); 
		}
	}

}

$t_redirect_url = '/plugin.php?page=MonProj/manage_monitor';

print_header_redirect( $t_redirect_url );