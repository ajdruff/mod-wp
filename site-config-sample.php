<?php

/* * *********************************
 * Site
 * ********************************* */

$site[ 'wp_options' ][ 'blogname' ] = 'My WordPress Site'; #default 'My WordPress Site';
$site[ 'wp_options' ][ 'blogdescription' ] = 'Just Another WordPress Site'; #default 'My WordPress Site';
$site[ 'wp_directory' ] = 'wordpress'; //the directory to install into
$site[ 'HTTP_HOST' ] = "example.com"; //required only for command line install

/* * *********************************
 * WordPress Administrative Login
 * ********************************* */
/* * *********************************
 * The script will automatically display a password for you when install completes.
 * If you forget the password, you'll need to reset it using the WordPress 
 * reset feature or re-run this script with all 'Installation Tasks' 
 * set to false except for $config['wpResetPassword'].
 * ********************************* */


$site[ 'wp_users' ][ 'user_login' ] = 'admin'; #default 'admin'
$site[ 'wp_users' ][ 'user_email' ] = 'admin@example.com'; #default 'admin@example.com' 

/* * *********************************
 * Database
 * ********************************* */

$site[ 'wp_config' ][ 'DB_NAME' ] = 'YOUR_DB_NAME'; #default 'YOUR_DB_NAME';
$site[ 'wp_config' ][ 'DB_HOST' ] = 'localhost'; #default 'localhost';
$site[ 'wp_config' ][ 'table_prefix' ] = 'wp_'; #default 'wp_';
$site[ 'wp_config' ][ 'DB_USER' ] = 'YOUR_DB_USER'; #default 'YOUR_DB_USER';
$site[ 'wp_config' ][ 'DB_PASSWORD' ] = 'YOUR_DB_PASSWORD'; #default 'YOUR_DB_PASSWORD'

/* * *********************************
 * Installation Profile
 * ********************************* */
$site[ 'profile' ] = 'default'; #default 'PROFILE_NAME'


/* * *********************************
 * Advanced-Selective Install
 * ********************************* */

$site[ 'wpDownload' ] = true; #default true
$site[ 'wpConfig' ] = true; #default true
$site[ 'wpInstallCore' ] = true; #default true
$site[ 'wpInstallThemes' ] = true; #default true
$site[ 'wpInstallPlugins' ] = true; #default true
$site[ 'wpResetPassword' ] = false; #default false

/* * *********************************
 * Advanced-Debug
 * ********************************* */
$site[ 'debug-show-exceptions' ] = false; #default false //shows detailed exception trace info

/* * *********************************
 * Advanced-Reinstall
 * ********************************* */

$site[ 'reinstall' ] = false; #default false //overwrites existing database and installation target directory


/* * *********************************
 * Advanced-Extras
 * ********************************* */

$site[ 'slide_rule' ] = false; #default false; whether to generate additional configuration files for slide_rule
$site[ 'set_permissions' ] = true; #default true; whether to set secure permissions after installation



?>