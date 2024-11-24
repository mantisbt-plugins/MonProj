<?php
$f_project_id = gpc_get_int( 'project_id' );
$f_user_id = gpc_get_int( 'user_id' );
$sql = "delete from {plugin_MonProj_monitored_projects} WHERE project_id = $f_project_id  and user_id= $f_user_id";

user_ensure_exists( $f_user_id );
$t_user = user_get_row( $f_user_id );

access_ensure_project_level( config_get( 'project_user_threshold' ), $f_project_id );
access_ensure_project_level( $t_user['access_level'], $f_project_id );

$t_project_name = project_get_name( $f_project_id );

# Confirm with the user
helper_ensure_confirmed( lang_get( 'sure_drop_monitor' ) .
	'<br />' . lang_get( 'project_name_label' ) . lang_get( 'word_separator' ) . $t_project_name,
	lang_get( 'remove_project_button' ) );

$result= db_query($sql);
	# do we need to remove monitor records for all existing issues ?
	$rem_his	= plugin_config_get( 'MonProj_remove_all' );
	if (ON == $rem_his){
		$sql2 = "select id from {bug} where project_id = $t_project_id ";
		$result2= db_query($sql2);
		while ($row = db_fetch_array($result2)) {
			$f_bug_id = $row['id'];
			bug_unmonitor( $f_bug_id, $f_user_id );
 		}
	}

$t_redirect_url = '/plugin.php?page=MonProj/manage_monitor';

print_header_redirect($t_redirect_url);
