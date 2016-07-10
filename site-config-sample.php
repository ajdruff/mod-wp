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
 * Advanced-Extras
 * ********************************* */

$config[ 'slide_rule' ] = false; #default false; whether to generate additional configuration files for slide_rule
$config[ 'set_permissions' ] = true; #default true; whether to set secure permissions after installation
$config['max_execution_time']=0; #default 0 The maximum amount of time a script is allowed to run.
$config['move_wpconfig']=true; #default true. Whether to move wp_config from web root to its own directory that can be placed above the web root.


?>