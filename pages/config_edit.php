<?php
// authenticate
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
// Read results
$f_MonProj_add_all = gpc_get_int( 'MonProj_add_all', ON );
$f_MonProj_remove_all = gpc_get_int( 'MonProj_remove_all', ON );
// update results
plugin_config_set( 'MonProj_add_all', $f_MonProj_add_all );
plugin_config_set( 'MonProj_remove_all', $f_MonProj_remove_all );
// redirect
print_header_redirect( plugin_page( 'config',TRUE ) );