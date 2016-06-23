<?php

/*
  Script Name: BPLATE-WPI
  Author: Andrew Druffner
  Contributors: Jonathan Buttigieg,Julio Potier
  Script URI: https://github.com/ajdruff/bplate-wpi
  Version: 1.0
  Licence: GPLv3
 */


/**
 * install_wp
 *
 * Install WordPress
 * @param string $task The task for the installer to perform
 * @param aray $install_config The array resulting from the parsing of the congifuration file
 * @param string $directory The directory path to the WordPress installation
 * @return void
 */
include(dirname( __FILE__ ) . '/bluedog-wpinstall.class.php');



//do not use $wp or other global object that WordPress uses, or your'll run into naming conflicts and odd errors when including the WordPress libraries.
$wpress = new bluedog_wpinstall; //avoid using $wp as the object name.
$wpress->sandbox();

/*
 * Show a Start Web Page if the interface is via Web
 * Otherwise, just execute the install script.
 */


if ( $wpress->isCommandLine() ) {

    $wpress->wpInstall();
} else {

    //include the front end html only if not called by command line and not requested with an action query
    if ( !isset( $_GET[ 'action' ] ) ) {
        include(dirname( __FILE__ ) . '/installer-templates/jumbotron-narrow.htm');
    }


    //evaluate query variables to see what to do next
    $wpress->parseQueryVar();
}





