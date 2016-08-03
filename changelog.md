
* *Tue Aug 2 18:55:46 2016 -0700*  
bugfix - fixed help link typo 


* *Tue Aug 2 18:49:50 2016 -0700*  
bugfix - renamed config-profile.json 


* *Tue Aug 2 18:46:10 2016 -0700*  
removed wp_users from config-profile-sample 


* *Tue Aug 2 18:43:11 2016 -0700*  
updated gitignore for json conversion 


* *Tue Aug 2 18:41:14 2016 -0700*  
json configuration conversion, command line switches to generate samples and help 


* *Tue Aug 2 18:40:15 2016 -0700*  
added command line switch info & json configuration 


* *Tue Aug 2 18:39:28 2016 -0700*  
added web ui tabs for advanced/profile/site 


* *Tue Aug 2 18:38:46 2016 -0700*  
modified index.php to accomodate command line switches 


* *Tue Aug 2 18:37:44 2016 -0700*  
converted configuration files to json 


* *Thu Jul 14 15:04:49 2016 -0700*  
working except for config objects. 


* *Wed Jul 13 23:38:02 2016 -0700*  
added labels and descriptions 


* *Wed Jul 13 23:36:44 2016 -0700*  
added config props json 


* *Wed Jul 13 23:36:04 2016 -0700*  
updated readme 


* *Wed Jul 13 23:35:14 2016 -0700*  
removed unnecessary jquery 


* *Wed Jul 13 23:33:46 2016 -0700*  
deleted unnecessary bootstrap and jquery since using cdn 


* *Sun Jul 10 13:58:41 2016 -0700*  


* *Sun Jul 10 13:57:44 2016 -0700*  
combined site and profile settings into one $config array, allowing overriding of profile settings. 


* *Thu Jul 7 22:48:53 2016 -0700*  
combined site profile configs. bug exists if dont specify theme. 


* *Wed Jul 6 17:02:00 2016 -0700*  


* *Wed Jul 6 16:37:29 2016 -0700*  


* *Wed Jul 6 16:37:14 2016 -0700*  
added reinstall option prompt upon db overwrite warning 


* *Wed Jul 6 16:34:14 2016 -0700*  
bugfix - htaccess and wp-config not found when setting perms 


* *Wed Jul 6 16:17:09 2016 -0700*  
tested perms locally. added variables to perm shell scripts. locked down site-config.php 


* *Wed Jul 6 15:36:24 2016 -0700*  


* *Wed Jul 6 15:27:13 2016 -0700*  
tested and fixed PHP chmod 


* *Wed Jul 6 14:19:41 2016 -0700*  
bugfix - die after displayMessages only when not command line bugfix - added prompt when HTTP_HOST not set correctly. 


* *Wed Jul 6 14:16:44 2016 -0700*  
updated Readme for permissions and command line stuff. 


* *Wed Jul 6 14:15:51 2016 -0700*  
added an unset-perms.sh file 


* *Wed Jul 6 11:10:58 2016 -0700*  


* *Wed Jul 6 11:10:27 2016 -0700*  
bugfix-perms-removed sandbox code and tested perms. removed old code from phplib. still untested on linux 


* *Wed Jul 6 10:54:48 2016 -0700*  


* *Wed Jul 6 10:52:49 2016 -0700*  
updated readme with security and permission notes 


* *Wed Jul 6 10:51:54 2016 -0700*  
set permissions via php and bash. 


* *Tue Jul 5 16:09:09 2016 -0700*  


* *Tue Jul 5 16:08:05 2016 -0700*  
bugfix - fixed config creation so it gets created above webroot or inside wordpress installation directory added updates to readme for WordPress configuration 


* *Tue Jul 5 13:08:19 2016 -0700*  


* *Tue Jul 5 13:07:17 2016 -0700*  
updated readme with wp_config.php location and configuration info 


* *Tue Jul 5 13:06:38 2016 -0700*  
add $site['move_wpconfig'] option to allow for standard install 


* *Tue Jul 5 11:46:53 2016 -0700*  


* *Tue Jul 5 11:44:08 2016 -0700*  
updated bad profile messaging. 


* *Tue Jul 5 10:59:28 2016 -0700*  


* *Tue Jul 5 10:59:00 2016 -0700*  
bugfix - set dropdown profile selection to site-config.php setting. 


* *Tue Jul 5 10:47:17 2016 -0700*  


* *Tue Jul 5 10:45:48 2016 -0700*  
added timing setting and increased time allowed for each retry. 


* *Tue Jul 5 10:06:36 2016 -0700*  


* *Tue Jul 5 09:51:15 2016 -0700*  
fixed web root installation bug by fixing _wpCreateWPConfigHome() to calculate include path correctly 


* *Mon Jul 4 18:30:34 2016 -0700*  
fixed bug that lost db connection after wpCheck on reinstall (since wpCheck deleted db) 


* *Mon Jul 4 18:09:08 2016 -0700*  
removed reinstall from ajax requests (already included in post) 


* *Mon Jul 4 18:08:49 2016 -0700*  
fixed displayMessages bug (added die after it) 


* *Mon Jul 4 13:32:37 2016 -0700*  
check for wp-config.php above web root. 


* *Mon Jul 4 13:04:12 2016 -0700*  


* *Mon Jul 4 13:03:20 2016 -0700*  
fixed out of memory bug. the bug was caused by the way _getDbConnection errors were handled combined with 2 different servers running with different root user setups. I refactored the _getDBConnection() method and provided better error handling. Also, I added error handling for users that don't have permissions to create/drop a database. 


* *Mon Jul 4 12:59:12 2016 -0700*  
updated readme with troubleshooting steps for db delete and create errors 


* *Sun Jul 3 10:31:18 2016 -0700*  
fixed bug, undefined property site_profile 


* *Sun Jul 3 10:03:16 2016 -0700*  
spellchecked readme and updated troubleshooting notes. 


* *Sun Jul 3 10:02:32 2016 -0700*  
added new settings to sample 


* *Sun Jul 3 10:02:10 2016 -0700*  
added slide_rule setting and .defaults 


* *Sun Jul 3 10:01:02 2016 -0700*  
added .defaults files to supply 'factory defaults' 


* *Wed Jun 29 23:17:05 2016 -0700*  


* *Wed Jun 29 23:16:27 2016 -0700*  
rewrote password functions to incorporate RandomLib 


* *Wed Jun 29 23:16:24 2016 -0700*  
updated readme docs 


* *Wed Jun 29 23:16:23 2016 -0700*  
added RandomLib 


* *Tue Jun 28 15:11:03 2016 -0700*  


* *Tue Jun 28 15:10:23 2016 -0700*  
moved templates directory to assets 


* *Tue Jun 28 15:00:35 2016 -0700*  


* *Tue Jun 28 13:31:01 2016 -0700*  
Update README.md 


* *Tue Jun 28 13:28:58 2016 -0700*  
Update README.md 


* *Tue Jun 28 12:46:32 2016 -0700*  


* *Tue Jun 28 12:45:59 2016 -0700*  


* *Tue Jun 28 12:45:11 2016 -0700*  
attempt to keep empty plugins and themes directory by adding a .gitignore file to them 


* *Tue Jun 28 12:44:30 2016 -0700*  
refactored template files renamed installer-templates to templates directory and relocated install.htm to templates directory 


* *Tue Jun 28 12:43:39 2016 -0700*  
relocated functions and class to libs directory 


* *Tue Jun 28 12:43:08 2016 -0700*  
updated readme 


* *Tue Jun 28 11:41:56 2016 -0700*  


* *Tue Jun 28 11:40:51 2016 -0700*  


* *Tue Jun 28 11:40:08 2016 -0700*  
added gitattributes 


* *Tue Jun 28 11:36:52 2016 -0700*  
deleted gitmodules 


* *Tue Jun 28 11:17:43 2016 -0700*  


* *Tue Jun 28 07:21:58 2016 -0700*  
deleted .gitignore and mod-wp subdirectory 


* *Tue Jun 28 07:16:02 2016 -0700*  
moved files outside of mod-wp directory for easier download and installation 


* *Tue Jun 28 00:16:02 2016 -0700*  


* *Mon Jun 27 23:57:22 2016 -0700*  


* *Mon Jun 27 23:56:24 2016 -0700*  
updated docs 


* *Mon Jun 27 23:51:16 2016 -0700*  
updated gitignore 


* *Mon Jun 27 23:48:32 2016 -0700*  
removed gitmodules 


* *Mon Jun 27 23:45:58 2016 -0700*  
updated branding from bplage-wpi/bluedog installer to Mod WP 


* *Wed Jun 22 20:29:23 2016 -0700*  
initial branding sweep bplate-wpi and BlueDog Installer to Mod WP 


* *Wed Jun 22 19:39:26 2016 -0700*  


* *Wed Jun 22 19:38:30 2016 -0700*  


* *Wed Jun 22 18:19:47 2016 -0700*  
updated gitignore 


* *Tue Jun 21 17:10:45 2016 -0700*  
refactored into class and made multiple changes: 
* Command Line Support was added 
* A different front end was added, replacing nearly all the original html and javascript 
* The original javascript used separate ajax requests for each installation action. The new script loops through a configurable array of actions supplied by the server side script to repeatedly call the same ajax call until all actions are completed. This allows greater flexibility in adding or re-ordering actions without having to edit the javascript. 
* The original script parsed ini files for configuration. BlueDog Installer instead uses 2 configuration files that are PHP scripts. The original instigator for this was the inability for the ini parser to handle complex passwords. 
* Passwords are handled more securely - the database password is never revealed or editable on the browser page, and the WP admin password is automatically generated by a cryptographically secure function with no option for the user to create their own. This not only ensures a strong password, but it also means there is no risk that the same password will be used for each new installation. 
* Configuration options were renamed to be more consistent with WordPress standards.  See the Configuration section for more detail. 
* Site Profiles were added. Profiles contain non-site specific installation options such as which  plugins and themes should be installed. They should not contain any options that require you to specify a options that can't be used for multiple sites (for example, domain name or admin user name) 


* *Tue Jun 21 17:09:12 2016 -0700*  
added phplib common functions class 


* *Tue Jun 21 16:37:30 2016 -0700*  
added bootstrap table classes 


* *Tue Jun 21 16:37:10 2016 -0700*  
started docs 


* *Tue Jun 21 16:36:40 2016 -0700*  
added installer templates 


* *Tue Jun 21 16:35:35 2016 -0700*  
refactored config and added profiles 


* *Tue May 10 14:15:59 2016 -0700*  
updated gitignore 


* *Tue May 10 14:15:43 2016 -0700*  
switched to config-sample vs config to prevent uploading of secure configuration info 


* *Tue May 10 14:13:56 2016 -0700*  
updated gitignore 


* *Tue May 10 14:13:42 2016 -0700*  
initial working version 


* *Tue May 10 14:13:06 2016 -0700*  
renamed to bplate-wpi 


* *Tue May 10 05:29:33 2016 -0700*  
renamed data.ini to data-sample.ini to prevent check-in of configuration changes 


* *Tue May 10 05:28:24 2016 -0700*  
updated readme with new project name 


* *Fri Mar 4 11:42:44 2016 +0100*  
Update readme 


* *Fri Mar 4 11:40:58 2016 +0100*  
Add Imagify on default plugin 


* *Fri Mar 4 11:40:01 2016 +0100*  
Delete TweetySixteen 


* *Fri Mar 4 11:32:44 2016 +0100*  


* *Wed Jun 10 11:14:36 2015 +0200*  
fixing tab issue 


* *Wed Jun 10 11:09:46 2015 +0200*  
adding twenty fifteen deletion 


* *Fri Jan 9 09:47:53 2015 +0100*  
update readme to 1.4.1 & update changelog 


* *Fri Jan 9 09:46:57 2015 +0100*  
commit 1.4.1 


* *Thu Jan 8 16:47:52 2015 +0100*  
Update version 


* *Thu Jan 8 16:46:04 2015 +0100*  
Tagging readme to 1.4 


* *Thu Jan 8 16:45:22 2015 +0100*  
commit 1.4 


* *Tue Jul 15 00:58:59 2014 +0200*  
commit 1.3.3 


* *Fri Jul 11 17:39:21 2014 +0200*  
Update readme =_= 


* *Fri Jul 11 17:38:42 2014 +0200*  
commit 1.3.2 


* *Fri Jul 11 11:33:26 2014 +0200*  
Update version in read me. 


* *Fri Jul 11 11:32:37 2014 +0200*  
Commit 1.3.1 


* *Thu Jul 10 16:43:43 2014 +0200*  
Fix stupid error with website URL 


* *Thu Jul 10 16:31:25 2014 +0200*  
Remove old CSS files 


* *Thu Jul 10 16:28:18 2014 +0200*  
Update counter 


* *Thu Jul 10 16:23:08 2014 +0200*  
Commit 1.3 


* *Fri May 16 10:02:45 2014 +0200*  


* *Fri May 16 09:54:19 2014 +0200*  
Wrong val on post_revisions 


* *Wed Apr 30 11:51:06 2014 +0200*  


* *Wed Apr 30 11:44:01 2014 +0200*  
Delete new themes from wordpress 3.8 and 3.9 


* *Sat Jan 12 19:59:01 2013 +0100*  
correctif readme 


* *Sat Jan 12 19:58:19 2013 +0100*  
comment 1.2.8.1 


* *Sat Jan 12 19:58:05 2013 +0100*  
commit 1.2.8.1 


* *Sun Dec 16 12:42:04 2012 +0100*  
commit 1.2.8 


* *Tue Oct 2 10:17:54 2012 +0200*  
ajout commentaire data.ini 


* *Mon Oct 1 15:17:08 2012 +0200*  
maj README 


* *Mon Oct 1 14:56:42 2012 +0200*  
suppression du fichier .DS_Store 


* *Mon Oct 1 14:47:06 2012 +0200*  
commit 1.2.7.2 


* *Mon Oct 1 10:50:52 2012 +0200*  
commit 1.2.7.1 


* *Fri Sep 21 17:33:15 2012 +0200*  
maj readme 


* *Fri Sep 21 17:26:55 2012 +0200*  
commit 1.2.7 


* *Wed Sep 12 21:12:49 2012 +0200*  
commit 1.2.6 


* *Fri Sep 7 09:45:30 2012 +0200*  
maj readme 


* *Fri Sep 7 09:44:17 2012 +0200*  
maj readme 


* *Fri Sep 7 09:43:30 2012 +0200*  
commit 1.25 


* *Fri Aug 31 21:26:00 2012 +0200*  
commit v1.2.4 


* *Fri Aug 31 19:15:37 2012 +0200*  
man readme 


* *Wed Aug 29 09:56:25 2012 +0200*  
fix bug for SEO 


* *Tue Aug 28 23:43:09 2012 +0200*  
correction faute de frappe 


* *Tue Aug 28 23:01:08 2012 +0200*  
commit v1.2.2 


* *Tue Aug 28 17:01:17 2012 +0200*  
man readme 


* *Tue Aug 28 16:52:27 2012 +0200*  
améliorations diverses 


* *Tue Aug 28 16:01:15 2012 +0200*  
suppression required sur pass bdd 


* *Tue Aug 28 11:44:58 2012 +0200*  
fix bug JS 


* *Tue Aug 28 02:09:01 2012 +0200*  
man readme 


* *Tue Aug 28 02:07:51 2012 +0200*  
ajout du data.ini d'exemple 


* *Tue Aug 28 01:58:29 2012 +0200*  
commit v2 


* *Mon Aug 27 16:09:45 2012 +0200*  
suppression de la class "required" pour le pass user 


* *Mon Aug 27 16:05:47 2012 +0200*  
fix bug wp-config.php 


* *Sun Aug 26 23:36:29 2012 +0200*  
fix notice bugs 


* *Sun Aug 26 22:39:32 2012 +0200*  
optimisation du code 


* *Sat Aug 25 23:30:40 2012 +0200*  
suppression du fichier css en trop bootstrap.css 


* *Sat Aug 25 19:53:42 2012 +0200*  
suppression du parasite .DS_Store 


* *Sat Aug 25 19:50:00 2012 +0200*  
correction bug constante-wp-config.php 


* *Sat Aug 25 19:41:54 2012 +0200*  
maj 


* *Sat Aug 25 18:50:58 2012 +0200*  
ajout des informations wp-config.php 


* *Sat Aug 25 01:39:08 2012 +0200*  
correction faute de frappe 


* *Sat Aug 25 01:37:47 2012 +0200*  
correction faute de grammaire 


* *Sat Aug 25 01:31:48 2012 +0200*  
Optimisations diverses 


* *Fri Aug 24 13:57:19 2012 -0700*  


* *Fri Aug 24 22:05:04 2012 +0300*  
Grammatical error fixed 


* *Fri Aug 24 16:17:23 2012 +0200*  
MAJ Readme 


* *Fri Aug 24 16:04:31 2012 +0200*  
Commit initial 


* *Fri Aug 24 03:58:07 2012 -0700*  
Initial commit 
