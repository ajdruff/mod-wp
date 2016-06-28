<?php

/* * *********************************
 * Customization
 * ********************************* */
$profile[ 'wp_options' ][ 'template' ] = ''; #default '' //theme to activate if exists.

$profile[ 'add_custom_content' ] = 1; //Add the custom content specified under the 'Custom Content' section

$profile[ 'set_media_options' ] = 0; //sets the options configured under the 'Advanced-Media' section


$profile[ 'add_custom_themes' ] = 1; //install  the themes that are added to the 'themes' directory

$profile[ 'add_custom_plugins' ] = 1; //install  plugins that are added to the 'plugins' directory
//$profile[ 'plugins' ][] = 'wordpress-seo'; //download and install this plugin slug
#$profile['plugins'][] = 'backwpup';//download and install this plugin slug

$profile[ 'install_dropin' ] = 0; //copies install_dropin.php to wp-content/install.php to override wp_install_defaults() function




/* * *********************************
 * Configuration
 * ********************************* */


$profile[ 'allow_search_engines' ] = 0; //Allow Search Engines to Crawl Site
$profile[ 'activate_plugins' ] = 1; //Activate plugins after WordPress Installation


$profile[ 'wp_options' ][ 'permalink_structure' ] = '%postname%'; //permalink structure


$profile[ 'wp_config' ][ 'media' ] = 'uploads'; //upload directory
$profile[ 'wp_config' ][ 'WPLANG' ] = 'en_US'; #default 'en_US';
$profile[ 'wp_config' ][ 'WP_POST_REVISIONS' ] = '0'; #default 0
$profile[ 'wp_config' ][ 'DISALLOW_FILE_EDIT' ] = 1; #default 1
$profile[ 'wp_config' ][ 'AUTOSAVE_INTERVAL' ] = 7200; #default 7200
$profile[ 'wp_config' ][ 'WP_DEBUG' ] = true; #default 0
$profile[ 'wp_config' ][ 'WP_DEBUG_DISPLAY' ] = true; #default 0
$profile[ 'wp_config' ][ 'WP_DEBUG_LOG' ] = true; #default 0
$profile[ 'wp_config' ][ 'WPCOM_API_KEY' ] = ''; #default ''
$profile [ 'script_debug' ] = 0;//allow non-minified javascript

/* * *********************************
 * Cruft
 * ********************************* */

$profile[ 'remove_file_cruft' ] = 1; //removes license.txt,readme,etc from web root.

$profile[ 'remove_default_content' ] = 1; //remove WordPress default post and pages , i.e.: "Hello World"

$profile[ 'remove_default_plugins' ] = 1; //remove WordPress default plugins, i.e.: askimet

$profile[ 'remove_default_themes' ] = 1; //remove default WordPress themes



/* * *********************************
 * Advanced-Media Options
 * ********************************* */

$profile[ 'wp_options' ][ 'thumbnail_crop' ] = 1; #default 1
$profile[ 'wp_options' ][ 'uploads_use_yearmonth_folders' ] = 1;
$profile[ 'wp_options' ][ 'thumbnail_size_w' ] = 150; #default 150
$profile[ 'wp_options' ][ 'thumbnail_size_h' ] = 150; #default 150
$profile[ 'wp_options' ][ 'medium_size_w' ] = 300; #default 300
$profile[ 'wp_options' ][ 'medium_size_h' ] = 300; #default 300
$profile[ 'wp_options' ][ 'large_size_w' ] = 1024; #default 1024
$profile[ 'wp_options' ][ 'large_size_h' ] = 1024; #default 1024







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
$profile[ 'posts' ][ 0 ][ 'title' ] = "Mod WP";
$profile[ 'posts' ][ 0 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$profile[ 'posts' ][ 0 ][ 'type' ] = "post"; #Post Type. Default : post;
$profile[ 'posts' ][ 0 ][ 'slug' ] = "mod-wp-welcome"; #Slug;
$profile[ 'posts' ][ 0 ][ 'parent' ] = ""; #Parent page Title;
$profile[ 'posts' ][ 0 ][ 'content' ] = "Thanks for installing WordPress using the Mod WP WordPress Installer!"; #Content (HTML allowed);
//an example of a preinstalled post.
$profile[ 'posts' ][ 1 ][ 'title' ] = "Example Preinstalled Post";
$profile[ 'posts' ][ 1 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$profile[ 'posts' ][ 1 ][ 'type' ] = "post"; #Post Type. Default : post;
$profile[ 'posts' ][ 1 ][ 'slug' ] = "example-post"; #Slug;
$profile[ 'posts' ][ 1 ][ 'parent' ] = "Mod WP"; #Parent page Title;
$profile[ 'posts' ][ 1 ][ 'content' ] = "This content was automatically added when WordPress was installed using Mod WP. If you don't want this content, re-install setting \$profile['add_custom_content']=false. To modify it, edit the profile-config.php file and look for the 'Custom Content' section.";

//an example of a preinstalled page.
$profile[ 'posts' ][ 2 ][ 'title' ] = "About Mod WP";
$profile[ 'posts' ][ 2 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$profile[ 'posts' ][ 2 ][ 'type' ] = "page"; #Post Type. Default : post;
$profile[ 'posts' ][ 2 ][ 'slug' ] = "about"; #Slug;
$profile[ 'posts' ][ 2 ][ 'parent' ] = ""; #Parent page Title;
$profile[ 'posts' ][ 2 ][ 'content' ] = "Do you install multiple WordPress sites for clients or for your business? You need the Mod WP Installer. Simply configure, upload the script and run the installer. You'll get the following benefits: a clean installation (no 'Hello World' content, no example comments,plugins,themes etc., the ability to add your own custom themes, plugins and content that will be automatically added with each installation,automatic cryptographically secure password generation, and a more secure setup of your WordPress configuration files. ";
//an example of a preinstalled page with parent.
$profile[ 'posts' ][ 3 ][ 'title' ] = "About Me";
$profile[ 'posts' ][ 3 ][ 'status' ] = "publish"; #Status (publish, draft, etc...). Default : draft;
$profile[ 'posts' ][ 3 ][ 'type' ] = "page"; #Post Type. Default : post;
$profile[ 'posts' ][ 3 ][ 'slug' ] = "me"; #Slug;
$profile[ 'posts' ][ 3 ][ 'parent' ] = "About Mod WP"; #Parent page Title;
$profile[ 'posts' ][ 3 ][ 'content' ] = "This is a little about me."; #Content (HTML allowed);
?>