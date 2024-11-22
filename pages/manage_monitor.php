<?php 
include( config_get( 'plugin_path' ) . 'MonProj' . DIRECTORY_SEPARATOR .  'MonProj_api.php');  
global $t_user;
?>
	<div class="col-md-12 col-xs-12">
	<div class="space-10"></div>
	<div class="form-container" > 
	        <form id="manage-monproj-add-form" method="post" action="<?php echo plugin_page( 'manage_monitor_add' ) ?>">
            <?php echo form_security_field( 'manage_user_proj_add' ) ?>
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
