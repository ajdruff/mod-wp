<?php
# Enter below the installation folder (uncomment to use):
####

$install_config['directory'] = '';#default '';


####
# Enter below the code language (uncomment to use):
####

$install_config['language'] = 'en_US';#default 'en_US';


####
# Enter below the Site Title (uncomment to use):
####

$install_config[ 'weblog_title' ] = 'My WordPress Site';#default 'My WordPress Site';


####
# Enter below your database connection detail (uncomment to use):
####

$install_config['db']['dbname']= 'YOUR_DB_NAME';#default 'YOUR_DB_NAME';
$install_config['db']['dbhost']          = 'localhost';#default 'localhost';
$install_config['db']['prefix']          = 'wp_';#default 'wp_';
$install_config['db']['uname']           = 'YOUR_DB_USER';#default 'YOUR_DB_USER';
$install_config['db']['pwd']             ='YOUR_DB_PASSWORD';#default 'YOUR_DB_PASSWORD'

$install_config['default_content'] = 1;#default 1


####
# Enter below the admin username and password (uncomment to use):
####

$install_config['admin']['user_login'] = 'admin' ;#default 'YOUR_WP_LOGIN'
$install_config['admin']['password']   = bin2hex(openssl_random_pseudo_bytes(6)) ;#default bin2hex(openssl_random_pseudo_bytes(6)) generates a 12 digit random password.
$install_config['admin']['email']      = 'admin@example.com' ;#default 'admin@example.com' 


####
# Enable SEO ?  
# 1 = Yes, 0 = No
####

$install_config['blog_public'] = 0;#default 0


####
# Activate Theme after WordPress installation? (uncomment to use):
# 1 = Yes, 0 = No
####

$install_config['activate_theme'] = 1;#default 1


####
# Delete Twenty Themes ? 
# 1 = Yes, 0 = No
####

$install_config['delete_default_themes'] = 0;#default 0


####
# Add a line for each plugin you want to automatically install.
####

$install_config['plugins'][] = '';
#example:
#$install_config['plugins'][] = 'wordpress-seo';#default ''
#$install_config['plugins'][] = 'backwpup';


####
# Install  plugins that are added to the 'bplate-wpi/plugins' directory):
# 1 = Yes, 0 = No
####

$install_config['plugins_premium'] = 1;#default 1


####
# Activate plugins after WordPress Installation
# 1 = Yes, 0 = No
####

$install_config['activate_plugins'] = 0;#default 0


####
# Permalink Structure (uncomment to use):
####

$install_config['permalink_structure'] = '%postname%';#default '%postname%'

####
# Medias (uncomment to use):
####

$install_config['uploads']['upload_dir'] 				= 'images';#
#$install_config['uploads']['thumbnail_size_w'] 			 = 0;#default 0
#$install_config['uploads']['thumbnail_size_h'] 			 = 0;#default 0
#$install_config['uploads']['thumbnail_crop'] 				 = 1;#default 1
#$install_config['uploads']['medium_size_w'] 				 = 0;#default 0
#$install_config['uploads']['medium_size_h'] 				 = 0;#default 0
#$install_config['uploads']['large_size_w'] 				 = 0;#default 0
#$install_config['uploads']['large_size_h'] 				 = 0;#default 0
$install_config['uploads']['uploads_use_yearmonth_folders'] = 1;

####
# Constant to add to wp-config.php 
# 1 = Yes, 0 = No
####

$install_config['post_revisions']     = 0;#default 0
$install_config['disallow_file_edit'] = 1;#default 1
$install_config['autosave_interval']  = 7200;#default 7200
$install_config['debug']              = 0;#default 0
$install_config['debug_display']              = 0;#default 0
$install_config['debug_log']              = 0;#default 0
#$install_config['wpcom_api_key']      = '';#default ''


####
# Post to automatically add after WordPress installation (uncomment to use):
# $install_config['title']   = "Title";
# $install_config['status']  = "publish";#Status (publish, draft, etc...). Default : draft;
# $install_config['type']    = "post";#Post Type. Default : post;
# $install_config['content'] = "content goes here";#Content (HTML allowed);
# $install_config['slug']    = "my-test-post";#Slug;
# $install_config['parent']  = "Parent TItle"; #Parent page Title;
####

$install_config['posts']=array();#default array()
#posts[0] = title::Legal - status::publish - content::Lorem ipsum dolor sit amet - type::page
#posts[1] = title::Contact - status::publish - content::Lorem ipsum dolor sit amet - type::page - parent::Legal
        
?>