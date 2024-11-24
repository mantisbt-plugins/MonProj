<?php 
require_once( 'core.php' );
require_api( 'api_token_api.php' );
require_api( 'authentication_api.php' );
require_api( 'current_user_api.php' );
require_api( 'database_api.php' );
require_api( 'html_api.php' );
auth_ensure_user_authenticated();
auth_reauthenticate();
current_user_ensure_unprotected();
layout_page_header( lang_get( 'MonProj_title' ) );
layout_page_begin();
print_account_menu( 'select_projects.php' ); 
$t_user_id = auth_get_current_user_id(); 
$t_user = user_get_row( $t_user_id ); 
?>
	<div class="col-md-12 col-xs-12">
	<div class="space-10"></div>
	<div class="form-container" > 
	        <form id="manage-monproj-add-form" method="post" action="<?php echo plugin_page( 'manage_monitor_add' ) ?>">
            <input type="hidden" name="user_id" value="<?php echo $t_user['id']?>" />
			
				<div class="widget-box widget-color-blue2">
	<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
<?php echo lang_get('add_monitor_title') ?>
</h4>
</div>
	<div class="widget-body">
	<div class="widget-main no-padding">
	<div class="table-responsive"> 
	<table class="table table-bordered table-condensed table-striped"> 	
<tr><td colspan=2 class="row-category"><div align="left"><a name="monitor_record"></a>

</td>
</tr>
        <tr>
            <td class="category">
                <?php echo lang_get( 'projects_monitored' ) ?>
	   </td>
            <td><?php print_monproj_user_list($t_user['id'] ) ?></td>
        </tr>

        <tr>
            <td class="category">
                <?php echo lang_get( 'project_monitor_label' ) ?>
            </td>
            <td>
                <select id="add-user-project-id" name="project_id[]" class="input-sm" multiple="multiple" size="5">
                    <?php  print_monproj_user_list_option_list2( $t_user['id'] ) ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary btn-sm btn-white btn-round" value="<?php echo lang_get( 'add_monitor_button' ) ?>" />
            </td>
        </tr>
       
	</table>
</div>
</div>
</div>
</div>
</div>
</div>
 </form>
<?php
layout_page_end();