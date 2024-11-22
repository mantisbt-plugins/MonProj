
# MonProj plugin for Mantisbt

Version 1.12
Copyright 2024 Cas Nuy
Only available for Mantis version 2.x

## Description
This plugin allows users to initiate monitoring for a project. Once selected the user will be added to the monitorlist for each new issue that is added to the project.
In addition, monitoring can be enabled for all existing issues with a status below RESOLVED (***).
When removing a project from the monitorlist, the user will no longer be added as monitor for new is=sues.
In addition it is possible to remove all existing monitor registration for the project (***).
(***) these are settings on plugin level and cannot be set by the individual user.
Depending on the access level set for maintaining this monitoring, it can be done by each individual user.
If allowed a separate tab will appear with My Account.
Whoever has access rights to maintain users, will be able to adjust these settings within User maintenance.

### based on monitor_bug_threshold
IMPORTANT:
The plugin will adhere to existing Mantis authorizations.
For example in case a user has no access for monitoring for a certain projcet, this plugin will also not allow it. 
Please align where needed.

## Installation                                                                             
- Copy MonProj directory to the plugins directory of your mantis installation
After copying to your webserver :
- Start mantis ad administrator
- Select manage
- Select manage Plugins
- Select Install behind MonProj 1.10
- Click on MonProj to configure 3 settings
	- Add_all		Default ON	Add monitoring to all existing issues with status < Resolved for project 
							OFF Add monitoring only to new issues for the project
	- Remove_all	Default ON	Remove monitoring from all existing issues for project 
							OFF No longer add monitoring for new issues for the project
	- Admin			Required access level to manage this option
- Once installed, further maintenance is user-driven via the My Account page and/or User Maintenance

## Customizing
The events below may appear in standard Mantis in one of the next versions.
Mantis can be patched manual like this:
Do ensure to define a signal in manage_user_edit_page.php.
Add the following line :
	event_signal( 'EVENT_MANAGE_USER_FORM'); 
Just before :
	include( dirname( __FILE__ ) . '/account_prefs_inc.php' );

Ensure to define a signal in manage_user_delete.php.
Add the following line :
	event_signal( 'EVENT_ACCOUNT_DELETED', $f_user_id ); 
Just before :
	form_security_purge('manage_user_delete');

Also ensure to define a signal in account_delete.php.
Add the following line :
	event_signal( 'EVENT_ACCOUNT_DELETED', $f_user_id ); 
Just before :
	layout_page_header(); 
	

## Performance tip                                                                        
in case this plugin slows down the Mantis application, add some indexes to the table.
Within PHP-MyAdmin or something similar execute the following commenad:
ALTER TABLE `XXX_plugin_MonProj_monitored_projects_table`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);
  Please replace "XXX"wth whatever is your prefix for the tables.

## License                                                                                    
This plugin is distributed under the same conditions as Mantis itself.

## Support

Please visit https://github.com/mantisbt-plugins/MonProj


## Greetings                                                                                  
Cas Nuy 
cas@nuy.info
http://www.nuy.info

