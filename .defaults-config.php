<?php

/* * *********************************
 * Site
 * ********************************* */

$config[ 'wp_options' ][ 'blogname' ] = 'My WordPress Site'; #default 'My WordPress Site';
$config[ 'wp_options' ][ 'blogdescription' ] = 'Just Another WordPress Site'; #default 'My WordPress Site';
$config[ 'wp_directory' ] = 'wordpress'; //the directory to install into
$config[ 'HTTP_HOST' ] = "example.com"; //required only for command line install

/* * *********************************
 * WordPress Administrative Login
 * ********************************* */
/* * *********************************
 * The script will automatically display a password for you when install completes.
 * If you forget the password, you'll need to reset it using the WordPress 
 * reset feature or re-run this script with all 'Installation Tasks' 
 * set to false except for $config['wpResetPassword'].
 * ********************************* */


$config[ 'wp_users' ][ 'user_login' ] = 'admin'; #default 'admin'
$config[ 'wp_users' ][ 'user_email' ] = 'admin@example.com'; #default 'admin@example.com' 

/* * *********************************
 * Database
 * ********************************* */

$config[ 'wp_config' ][ 'DB_NAME' ] = 'YOUR_DB_NAME'; #default 'YOUR_DB_NAME';
$config[ 'wp_config' ][ 'DB_HOST' ] = 'localhost'; #default 'localhost';
$config[ 'wp_config' ][ 'table_prefix' ] = 'wp_'; #default 'wp_';
$config[ 'wp_config' ][ 'DB_USER' ] = 'YOUR_DB_USER'; #default 'YOUR_DB_USER';
$config[ 'wp_config' ][ 'DB_PASSWORD' ] = 'YOUR_DB_PASSWORD'; #default 'YOUR_DB_PASSWORD'

/* * *********************************
 * Installation Profile
 * ********************************* */
$config[ 'profile' ] = 'default'; #default 'PROFILE_NAME'


/* * *********************************
 * Advanced-Selective Install
 * ********************************* */

$config[ 'wpDownload' ] = true; #default true
$config[ 'wpConfig' ] = true; #default true
$config[ 'wpInstallCore' ] = true; #default true
$config[ 'wpInstallThemes' ] = true; #default true
$config[ 'wpInstallPlugins' ] = true; #default true
$config[ 'wpResetPassword' ] = false; #default false

/* * *********************************
 * Advanced-Debug
 * ********************************* */
$config[ 'debug-show-exceptions' ] = false; #default false //shows detailed exception trace info

/* * *********************************
 * Advanced-Reinstall
 * ********************************* */

$config[ 'reinstall' ] = false; #default false //overwrites existing database and installation target directory

/* * *********************************
 * Advanced-Security
 * ********************************* */
$site[ 'set_permissions' ] = true; #default true; whether to set secure permissions after installation
$site[ 'move_wp_config' ] = true; #default true; whether to move wp_config into a separate directory


/* * *********************************
 * Advanced-Extras
 * ********************************* */

$config[ 'slide_rule' ] = false; #default false; whether to generate additional configuration files for slide_rule
$config['max_execution_time']=0; #default 0 The maximum amount of time a script is allowed to run.



/* * *********************************
 * Customization
 * ********************************* */
$config[ 'wp_options' ][ 'template' ] = ''; #default '' //theme to activate if exists.

$config[ 'add_custom_content' ] = 0; //Add the custom content specified under the 'Custom Content' section

$config[ 'set_media_options' ] = 0; //sets the options configured under the 'Advanced-Media' section


$config[ 'add_custom_themes' ] = 1; //install  the themes that are added to the 'themes' directory

$config[ 'add_custom_plugins' ] = 1; //install  plugins that are added to the 'plugins' directory
$config[ 'plugins' ][] = 'wordpress-seo'; //download and install this plugin slug
#$config['plugins'][] = 'backwpup';//download and install this plugin slug

$config[ 'install_dropin' ] = 0; //copies install_dropin.php to wp-content/install.php to override wp_install_defaults() function




/* * *********************************
 * Configuration
 * ********************************* */



$config[ 'wp_config' ][ 'media' ] = 'uploads';//upload directory
$config[ 'wp_options' ][ 'permalink_structure' ] = '%postname%'; //permalink structure  

$config[ 'allow_search_engines' ] = 1; //Allow Search Engines to Crawl Site
$config[ 'activate_plugins' ] = 1; //Activate plugins after WordPress Installation

$config[ 'wp_config' ][ 'WPLANG' ] = 'en_US'; #default 'en_US';

$config[ 'wp_config' ][ 'WP_POST_REVISIONS' ] = 0; #default 0
$config[ 'wp_config' ][ 'DISALLOW_FILE_EDIT' ] = 1; #default 1
$config[ 'wp_config' ][ 'AUTOSAVE_INTERVAL' ] = 7200; #default 7200

$config[ 'wp_config' ][ 'WP_DEBUG' ]= 0; #default 0
$config[ 'wp_config' ][ 'WP_DEBUG_DISPLAY' ] = 0; #default 0
$config[ 'wp_config' ][ 'WP_DEBUG_LOG' ] = 0; #default 0
$config[ 'wp_config' ][ 'WPCOM_API_KEY' ] = ''; #default ''
$config [ 'script_debug' ] = 0;//allow non-minified javascript

/* * *********************************
 * Cruft
 * ********************************* */

$config[ 'remove_file_cruft' ] = 0; //removes license.txt,readme,etc from web root.

$config[ 'remove_default_content' ] = 1; //remove WordPress default post and pages , i.e.: "Hello World"

$config[ 'remove_default_plugins' ] = 1; //remove WordPress default plugins, i.e.: askimet

$config[ 'remove_default_themes' ] = 0; //remove default WordPress themes





/* * *********************************
 * Advanced-Media Options
 * ********************************* */

$config[ 'wp_options' ][ 'thumbnail_crop' ] = 1; #default 1
$config[ 'wp_options' ][ 'uploads_use_yearmonth_folders' ] = 1;
$config[ 'wp_options' ][ 'thumbnail_size_w' ] = 150; #default 150
$config[ 'wp_options' ][ 'thumbnail_size_h' ] = 150; #default 150
$config[ 'wp_options' ][ 'medium_size_w' ] = 301; #default 300
$config[ 'wp_options' ][ 'medium_size_h' ] = 300; #default 300
$config[ 'wp_options' ][ 'large_size_w' ] = 1024; #default 1024
$config[ 'wp_options' ][ 'large_size_h' ] = 1024; #default 1024








/* * *********************************
 * Custom Content
 * ********************************* */
/* * *********************************
 * The following posts will be added when 'add_custom_content' is set to true
 * Modify the below posts as needed.
 * Note that parents are not supported by post types by default, only page types.
 * In the below example, the About Me page can be accessed using http://example.com/about/me/ . 
 * This is because the About Me page gives
 * the 'About the Mod WP' as its parent.
 * ********************************* */

//an example of a preinstalled post.
$config[ 'posts' ][ 0 ][ 'title' ] = "Mod WP";
$config[ 'posts' ][ 0 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$config[ 'posts' ][ 0 ][ 'type' ] = "post"; #Post Type. Default : post;
$config[ 'posts' ][ 0 ][ 'slug' ] = "mod-wp-welcome"; #Slug;
$config[ 'posts' ][ 0 ][ 'parent' ] = ""; #Parent page Title;
$config[ 'posts' ][ 0 ][ 'content' ] = "Thanks for installing WordPress using the Mod WP WordPress Installer!"; #Content (HTML allowed);
//an example of a preinstalled post.
$config[ 'posts' ][ 1 ][ 'title' ] = "Example Preinstalled Post";
$config[ 'posts' ][ 1 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$config[ 'posts' ][ 1 ][ 'type' ] = "post"; #Post Type. Default : post;
$config[ 'posts' ][ 1 ][ 'slug' ] = "example-post"; #Slug;
$config[ 'posts' ][ 1 ][ 'parent' ] = "Mod WP"; #Parent page Title;
$config[ 'posts' ][ 1 ][ 'content' ] = "This content was automatically added when WordPress was installed using Mod WP. If you don't want this content, re-install setting \$config['add_custom_content']=false. To modify it, edit the profile-config.php file and look for the 'Custom Content' section.";

//an example of a preinstalled page.
$config[ 'posts' ][ 2 ][ 'title' ] = "About Mod WP";
$config[ 'posts' ][ 2 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$config[ 'posts' ][ 2 ][ 'type' ] = "page"; #Post Type. Default : post;
$config[ 'posts' ][ 2 ][ 'slug' ] = "about"; #Slug;
$config[ 'posts' ][ 2 ][ 'parent' ] = ""; #Parent page Title;
$config[ 'posts' ][ 2 ][ 'content' ] = "Do you install multiple WordPress sites for clients or for your business? You need the Mod WP Installer. Simply configure, upload the script and run the installer. You'll get the following benefits: a clean installation (no 'Hello World' content, no example comments,plugins,themes etc., the ability to add your own custom themes, plugins and content that will be automatically added with each installation,automatic cryptographically secure password generation, and a more secure setup of your WordPress configuration files. ";
//an example of a preinstalled page with parent.
$config[ 'posts' ][ 3 ][ 'title' ] = "About Me";
$config[ 'posts' ][ 3 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$config[ 'posts' ][ 3 ][ 'type' ] = "page"; #Post Type. Default : post;
$config[ 'posts' ][ 3 ][ 'slug' ] = "me"; #Slug;
$config[ 'posts' ][ 3 ][ 'parent' ] = "About Mod WP"; #Parent page Title;
$config[ 'posts' ][ 3 ][ 'content' ] = "This is a little about me."; #Content (HTML allowed);
?>