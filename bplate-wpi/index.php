<?php
/*
Script Name: BPLATE-WPI
Author: Andrew Druffner
Contributors: Jonathan Buttigieg,Julio Potier
Script URI: https://github.com/ajdruff/bplate-wpi
Version: 1.0
Licence: GPLv3
*/


@set_time_limit( 0 );

define( 'WP_API_CORE'				, 'http://api.wordpress.org/core/version-check/1.7/?locale=' );
define( 'WPQI_CACHE_PATH'			, 'cache/' );
define( 'WPQI_CACHE_CORE_PATH'		, WPQI_CACHE_PATH . 'core/' );
define( 'WPQI_CACHE_PLUGINS_PATH'	, WPQI_CACHE_PATH . 'plugins/' );

require( 'inc/functions.php' );



// Create cache directories
if ( ! is_dir( WPQI_CACHE_PATH ) ) {
	mkdir( WPQI_CACHE_PATH );
}
if ( ! is_dir( WPQI_CACHE_CORE_PATH ) ) {
	mkdir( WPQI_CACHE_CORE_PATH );
}
if ( ! is_dir( WPQI_CACHE_PLUGINS_PATH ) ) {
	mkdir( WPQI_CACHE_PLUGINS_PATH );
}

// We verify if there is a preconfig file
$data = array();
if ( file_exists( 'config.php' ) ) {
	#$data = json_encode( parse_ini_file( 'data.ini' ) );
        #$install_config =  parse_ini_file( 'data.ini' ) ;
    include('config.php');
}



// We add  ../ to directory
$directory = ! empty( $install_config['directory'] ) ? '../' . $install_config['directory'] . '/' : '../';
/**
 * install_wp
 *
 * Install WordPress
 * @param string $task The task for the installer to perform
  * @param aray $install_config The array resulting from the parsing of the congifuration file
  * @param string $directory The directory path to the WordPress installation
 * @return void
 */


#install_wp("check_before_upload");
#install_wp("download_wp");
#install_wp("unzip_wp");
#install_wp("wp_config");
install_wp("install_plugins");
#install_wp("install_theme");
#install_wp("install_wp");


/**
 * Install WP
 *
 * Install WordPress
 * @param string $task Each installation task to be completed, as defined within the function.
 * @return void
 */


function install_wp( $task ) {
 
global $install_config;
global $directory;
switch( $task ) {

		case "check_before_upload" :

			$data = array();

			/*--------------------------*/
			/*	We verify if we can connect to DB or WP is not installed yet
			/*--------------------------*/

			// DB Test
			try {
			   $db = new PDO('mysql:host='. $install_config['db']['dbhost'] .';dbname=' . $install_config['db']['dbname'] , $install_config['db']['uname'], $install_config['db']['pwd'] );
                          
			}
			catch (Exception $e) {
				$data['db'] = "error etablishing connection";
			}

			// WordPress test
			if ( file_exists( $directory . 'wp-config.php' ) ) {
				$data['wp'] = "error directory";
			}

			// We send the response
			echo json_encode( $data );

			break;

		case "download_wp" :

			// Get WordPress language
			$language = substr( $install_config['language'], 0, 6 );

			// Get WordPress data
			$wp = json_decode( file_get_contents( WP_API_CORE . $language ) )->offers[0];

			/*--------------------------*/
			/*	We download the latest version of WordPress
			/*--------------------------*/

			if ( ! file_exists( WPQI_CACHE_CORE_PATH . 'wordpress-' . $wp->version . '-' . $language  . '.zip' ) ) {
				file_put_contents( WPQI_CACHE_CORE_PATH . 'wordpress-' . $wp->version . '-' . $language  . '.zip', file_get_contents( $wp->download ) );
			}

			break;

		case "unzip_wp" :

			// Get WordPress language
			$language = substr( $install_config['language'], 0, 6 );

			// Get WordPress data
			$wp = json_decode( file_get_contents( WP_API_CORE . $language ) )->offers[0];

			/*--------------------------*/
			/*	We create the website folder with the files and the WordPress folder
			/*--------------------------*/

			// If we want to put WordPress in a subfolder we create it
			if ( ! empty( $directory ) ) {
				// Let's create the folder
				mkdir( $directory );

				// We set the good writing rights
				chmod( $directory , 0755 );
			}

			$zip = new ZipArchive;

			// We verify if we can use the archive
			if ( $zip->open( WPQI_CACHE_CORE_PATH . 'wordpress-' . $wp->version . '-' . $language  . '.zip' ) === true ) {

				// Let's unzip
				$zip->extractTo( '.' );
				$zip->close();

				// We scan the folder
				$files = scandir( 'wordpress' );

				// We remove the "." and ".." from the current folder and its parent
				$files = array_diff( $files, array( '.', '..' ) );

				// We move the files and folders
				foreach ( $files as $file ) {
					rename(  'wordpress/' . $file, $directory . '/' . $file );
				}

				rmdir( 'wordpress' ); // We remove WordPress folder
				unlink( $directory . '/license.txt' ); // We remove licence.txt
				unlink( $directory . '/readme.html' ); // We remove readme.html
				unlink( $directory . '/wp-content/plugins/hello.php' ); // We remove Hello Dolly plugin
			}

			break;

			case "wp_config" :

create_wp_config('dev');
create_wp_config('live');
create_wp_config('stage');                            
add_homedir_wp_config();                                
				break;

			case "install_wp" :

				/*--------------------------*/
				/*	Let's install WordPress database
				/*--------------------------*/

				define( 'WP_INSTALLING', true );

				/** Load WordPress Bootstrap */
				require_once( $directory . 'wp-load.php' );

				/** Load WordPress Administration Upgrade API */
				require_once( $directory . 'wp-admin/includes/upgrade.php' );

				/** Load wpdb */
				require_once( $directory . 'wp-includes/wp-db.php' );

				// WordPress installation
				wp_install( $install_config[ 'weblog_title' ], $install_config['admin']['user_login'], $install_config['admin']['email'], (int) $install_config[ 'blog_public' ], '', $install_config['admin']['password'] );

				// We update the options with the right siteurl et homeurl value
				$protocol = ! is_ssl() ? 'http' : 'https';
                $get = basename( dirname( __FILE__ ) ) . '/index.php/wp-admin/install.php?action=install_wp';
                $dir = str_replace( '../', '', $directory );
                $link = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $url = str_replace( $get, $dir, $link );
                $url = trim( $url, '/' );

				update_option( 'siteurl', $url );
				update_option( 'home', $url );

				/*--------------------------*/
				/*	We remove the default content
				/*--------------------------*/

				if ( $install_config['default_content'] == '1' ) {
					wp_delete_post( 1, true ); // We remove the article "Hello World"
					wp_delete_post( 2, true ); // We remove the "Exemple page"
				}

				/*--------------------------*/
				/*	We update permalinks
				/*--------------------------*/
				if ( ! empty( $install_config['permalink_structure'] ) ) {
					update_option( 'permalink_structure', $install_config['permalink_structure'] );
				}

				/*--------------------------*/
				/*	We update the media settings
				/*--------------------------*/

				if ( ! empty( $install_config['uploads']['thumbnail_size_w'] ) || !empty($install_config['uploads']['thumbnail_size_h'] ) ) {
					update_option( 'thumbnail_size_w', (int) $install_config['uploads']['thumbnail_size_w'] );
					update_option( 'thumbnail_size_h', (int) $install_config['uploads']['thumbnail_size_h'] );
					update_option( 'thumbnail_crop', (int) $install_config['uploads']['thumbnail_crop'] );
				}

				if ( ! empty( $install_config['uploads']['medium_size_w'] ) || !empty( $install_config['uploads']['medium_size_h'] ) ) {
					update_option( 'medium_size_w', (int) $install_config['uploads']['medium_size_w'] );
					update_option( 'medium_size_h', (int) $install_config['uploads']['medium_size_h'] );
				}

				if ( ! empty( $install_config['large_size_w'] ) || !empty( $install_config['large_size_h'] ) ) {
					update_option( 'large_size_w', (int) $install_config['uploads']['large_size_w'] );
					update_option( 'large_size_h', (int) $install_config['uploads']['large_size_h'] );
				}

				 update_option( 'uploads_use_yearmonth_folders', (int) $install_config['uploads']['uploads_use_yearmonth_folders'] );

				/*--------------------------*/
				/*	We add the pages we found in the data.ini file
				/*--------------------------*/




					// We verify if we have at least one page
					if ( count( $install_config['posts'] ) >= 1 ) {

						foreach ( $install_config['posts'] as $post ) {

							// We get the line of the page configuration
							$pre_config_post = explode( "-", $post );
							$post = array();

							foreach ( $pre_config_post as $config_post ) {

								// We retrieve the page title
								if ( preg_match( '#title::#', $config_post ) == 1 ) {
									$post['title'] = str_replace( 'title::', '', $config_post );
								}

								// We retrieve the status (publish, draft, etc...)
								if ( preg_match( '#status::#', $config_post ) == 1 ) {
									$post['status'] = str_replace( 'status::', '', $config_post );
								}

								// On retrieve the post type (post, page or custom post types ...)
								if ( preg_match( '#type::#', $config_post ) == 1 ) {
									$post['type'] = str_replace( 'type::', '', $config_post );
								}

								// We retrieve the content
								if ( preg_match( '#content::#', $config_post ) == 1 ) {
									$post['content'] = str_replace( 'content::', '', $config_post );
								}

								// We retrieve the slug
								if ( preg_match( '#slug::#', $config_post ) == 1 ) {
									$post['slug'] = str_replace( 'slug::', '', $config_post );
								}

								// We retrieve the title of the parent
								if ( preg_match( '#parent::#', $config_post ) == 1 ) {
									$post['parent'] = str_replace( 'parent::', '', $config_post );
								}

							} // foreach

							if ( isset( $post['title'] ) && !empty( $post['title'] ) ) {

								$parent = get_page_by_title( trim( $post['parent'] ) );
 								$parent = $parent ? $parent->ID : 0;

								// Let's create the page
								$args = array(
									'post_title' 		=> trim( $post['title'] ),
									'post_name'			=> $post['slug'],
									'post_content'		=> trim( $post['content'] ),
									'post_status' 		=> $post['status'],
									'post_type' 		=> $post['type'],
									'post_parent'		=> $parent,
									'post_author'		=> 1,
									'post_date' 		=> date('Y-m-d H:i:s'),
									'post_date_gmt' 	=> gmdate('Y-m-d H:i:s'),
									'comment_status' 	=> 'closed',
									'ping_status'		=> 'closed'
								);
								wp_insert_post( $args );

							}

						}
					}
		

				break;

			case "install_theme" :

				/** Load WordPress Bootstrap */
				require_once( $directory . 'wp-load.php' );

				/** Load WordPress Administration Upgrade API */
				require_once( $directory . 'wp-admin/includes/upgrade.php' );

				/*--------------------------*/
				/*	We install the new theme
				/*--------------------------*/

				// We verify if theme.zip exists
				if ( file_exists( 'theme.zip' ) ) {

					$zip = new ZipArchive;

					// We verify we can use it
					if ( $zip->open( 'theme.zip' ) === true ) {

						// We retrieve the name of the folder
						$stat = $zip->statIndex( 0 );
						$theme_name = str_replace('/', '' , $stat['name']);

						// We unzip the archive in the themes folder
						$zip->extractTo( $directory . 'wp-content/themes/' );
						$zip->close();

						// Let's activate the theme
						// Note : The theme is automatically activated if the user asked to remove the default theme
						if ( $install_config['activate_theme'] == 1 || $install_config['delete_default_themes'] == 1 ) {
							switch_theme( $theme_name, $theme_name );
						}

						// Let's remove the Tweenty family
						if ( $install_config['delete_default_themes'] == 1 ) {
							delete_theme( 'twentysixteen' );
							delete_theme( 'twentyfifteen' );
							delete_theme( 'twentyfourteen' );
							delete_theme( 'twentythirteen' );
							delete_theme( 'twentytwelve' );
							delete_theme( 'twentyeleven' );
							delete_theme( 'twentyten' );
						}

						// We delete the _MACOSX folder (bug with a Mac)
						delete_theme( '__MACOSX' );

					}
				}

			break;

			case "install_plugins" :

				/*--------------------------*/
				/*	Let's retrieve the plugin folder
				/*--------------------------*/

				if ( ! empty( $install_config['plugins'] ) ) {

					#$plugins     = explode( ";", $install_config['plugins'] );
					#$plugins     = array_map( 'trim' , $plugins );
                                    $plugins=$install_config['plugins'];
                                    
                                    
					$plugins_dir = $directory . 'wp-content/plugins/';


					foreach ( $plugins as $plugin ) {

						// We retrieve the plugin XML file to get the link to downlad it
					    $plugin_repo = file_get_contents( "http://api.wordpress.org/plugins/info/1.0/$plugin.json" );

					    if ( $plugin_repo && $plugin = json_decode( $plugin_repo ) ) {

							$plugin_path = WPQI_CACHE_PLUGINS_PATH . $plugin->slug . '-' . $plugin->version . '.zip';

							if ( ! file_exists( $plugin_path ) ) {
                                                         
								// We download the lastest version
								if ( $download_link = file_get_contents( $plugin->download_link ) ) {
 									file_put_contents( $plugin_path, $download_link );
 								}							}

					    	// We unzip it
					    	$zip = new ZipArchive;
							if ( $zip->open( $plugin_path ) === true ) {
								$zip->extractTo( $plugins_dir );
								$zip->close();
							}
					    }
					}
				}

				if ( $install_config['plugins_premium'] == 1 ) {

					// We scan the folder
					$plugins = scandir( 'plugins' );

					// We remove the "." and ".." corresponding to the current and parent folder
					$plugins = array_diff( $plugins, array( '.', '..' ) );

					// We move the archives and we unzip
					foreach ( $plugins as $plugin ) {

						// We verify if we have to retrive somes plugins via the WP Quick Install "plugins" folder
						if ( preg_match( '#(.*).zip$#', $plugin ) == 1 ) {

							$zip = new ZipArchive;

							// We verify we can use the archive
							if ( $zip->open( 'plugins/' . $plugin ) === true ) {

								// We unzip the archive in the plugin folder
								$zip->extractTo( $plugins_dir );
								$zip->close();

							}
						}
					}
				}

				/*--------------------------*/
				/*	We activate extensions
				/*--------------------------*/

				if ( $install_config['activate_plugins'] == 1 ) {

					/** Load WordPress Bootstrap */
					require_once( $directory . 'wp-load.php' );

					/** Load WordPress Plugin API */
					require_once( $directory . 'wp-admin/includes/plugin.php');

					// Activation
					activate_plugins( array_keys( get_plugins() ) );
				}

			break;

			case "success" :

				/*--------------------------*/
				/*	If we have a success we add the link to the admin and the website
				/*--------------------------*/

				/** Load WordPress Bootstrap */
				require_once( $directory . 'wp-load.php' );

				/** Load WordPress Administration Upgrade API */
				require_once( $directory . 'wp-admin/includes/upgrade.php' );

				/*--------------------------*/
				/*	We update permalinks
				/*--------------------------*/
				if ( ! empty( $install_config['permalink_structure'] ) ) {
					file_put_contents( $directory . '.htaccess' , null );
					flush_rewrite_rules();
				}

				echo '<div id="errors" class="alert alert-danger"><p style="margin:0;"><strong>' . _('Warning') . '</strong>: Don\'t forget to delete WP Quick Install folder.</p></div>';

				// Link to the admin
				echo '<a href="' . admin_url() . '" class="button" style="margin-right:5px;" target="_blank">'. _('Log In') . '</a>';
				echo '<a href="' . home_url() . '" class="button" target="_blank">' . _('Go to website') . '</a>';

				break;
	}

        
        
  
}

  /**
 * Short Description
 *
 * Long Description 
 * @param string $content The shortcode content
 * @return string The parsed output of the form body tag
 */
    function create_wp_config( $environment ) {
       
global $directory;
global $install_config;
				/*--------------------------*/
				/*	Let's create the wp-config file
				/*--------------------------*/

				// We retrieve each line as an array
				$wp_config = file( $directory . 'wp-config-sample.php' );

				// Managing the security keys
				$secret_keys = explode( "\n", file_get_contents( 'https://api.wordpress.org/secret-key/1.1/salt/' ) );

				foreach ( $secret_keys as $k => $v ) {
					$secret_keys[$k] = substr( $v, 28, 64 );
				}

				// We change the data
				$key = 0;
				foreach ( $wp_config as &$line ) {

					if ( '$table_prefix  =' == substr( $line, 0, 16 ) ) {
						$line = '$table_prefix  = \'' . sanit( $install_config['db'][ 'prefix' ] ) . "';\r\n";
						continue;
					}

					if ( ! preg_match( '/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match ) ) {
						continue;
					}

					$constant = $match[1];

					switch ( $constant ) {
						case 'WP_DEBUG'	   :

							// Debug mod
							if ( (int) $install_config['debug'] == 1 ) {
								$line = "define('WP_DEBUG', 'true');\r\n";

								// Display error
								if ( (int) $install_config['debug_display'] == 1 ) {
									$line .= "\r\n\n " . "/** Display Errors to Screen */" . "\r\n";
									$line .= "define('WP_DEBUG_DISPLAY', 'true');\r\n";
								}

								// To write error in a log files
								if ( (int) $install_config['debug_log'] == 1 ) {
									$line .= "\r\n\n " . "/** Enable Error Logging to File */" . "\r\n";
									$line .= "define('WP_DEBUG_LOG', 'true');\r\n";
								}
							}

							// We add the extras constant
							if ( ! empty( $install_config['uploads'] ) ) {
								$line .= "\r\n\n " . "/** Destination folder of files uploaded */" . "\r\n";
								$line .= "define('UPLOADS', '" . sanit( $install_config['uploads']['upload_dir']  ) . "');";
							}

							if ( (int) $install_config['post_revisions'] >= 0 ) {
								$line .= "\r\n\n " . "/** Disables Post Revisions */" . "\r\n";
								$line .= "define('WP_POST_REVISIONS', " . (int) $install_config['post_revisions'] . ");";
							}

							if ( (int) $install_config['disallow_file_edit'] == 1 ) {
								$line .= "\r\n\n " . "/** Disables Theme Editor */" . "\r\n";
								$line .= "define('DISALLOW_FILE_EDIT', true);";
							}

							if ( (int) $install_config['autosave_interval'] >= 60 ) {
								$line .= "\r\n\n " . "/** Automatic Save Interval */" . "\r\n";
								$line .= "define('AUTOSAVE_INTERVAL', " . (int) $install_config['autosave_interval'] . ");";
							}

							if ( ! empty( $install_config['wpcom_api_key'] ) ) {
								$line .= "\r\n\n " . "/** WordPress.com API Key */" . "\r\n";
								$line .= "define('WPCOM_API_KEY', '" . $install_config['wpcom_api_key'] . "');";
							}

							$line .= "\r\n\n " . "/** Memory Limit */" . "\r\n";
							$line .= "define('WP_MEMORY_LIMIT', '96M');" . "\r\n";

							break;
						case 'DB_NAME'     :
                                                        if ($environment !='dev') break;
							$line = "define('DB_NAME', '" . sanit( $install_config['db'][ 'dbname' ] ) . "');\r\n";
							break;
						case 'DB_USER'     :
                                                     if ($environment !='dev') break;
							$line = "define('DB_USER', '" . sanit( $install_config['db']['uname'] ) . "');\r\n";
							break;
						case 'DB_PASSWORD' :
                                                     if ($environment !='dev') break;
							$line = "define('DB_PASSWORD', '" . sanit( $install_config['db']['pwd'] ) . "');\r\n";
							break;
						case 'DB_HOST'     :
                                                     if ($environment !='dev') break;
							$line = "define('DB_HOST', '" . sanit( $install_config['db']['dbhost'] ) . "');\r\n";
							break;
						case 'AUTH_KEY'         :
						case 'SECURE_AUTH_KEY'  :
						case 'LOGGED_IN_KEY'    :
						case 'NONCE_KEY'        :
						case 'AUTH_SALT'        :
						case 'SECURE_AUTH_SALT' :
						case 'LOGGED_IN_SALT'   :
						case 'NONCE_SALT'       :
							$line = "define('" . $constant . "', '" . $secret_keys[$key++] . "');\r\n";
							break;

						case 'WPLANG' :
							$line = "define('WPLANG', '" . sanit( $install_config['language'] ) . "');\r\n";
							break;
					}
				}
				unset( $line );

                                
                                switch ($environment) {
                                    
                                    case "dev": 
                                        $config_directory=realpath(dirname($directory))."/config";
                                          if ( !file_exists($config_directory)) {
                                         
                                          mkdir ($config_directory);
                                          
                                           }
                                        break;
                                                                        case "live": 
                                                                       $config_directory_parent=realpath(dirname($directory))."/_live";
                                                                              if ( !file_exists($config_directory_parent)) {
                                                                          
                                                                                mkdir ($config_directory_parent);
                                                                                $config_directory=$config_directory_parent . "/config";
                                                                                 mkdir ($config_directory);
                                                                              }
                                        
                                        break;
                                    
                                                                        case "stage": 
                                                                            $config_directory_parent=realpath(dirname($directory))."/_stage";
                                                                              if ( !file_exists($config_directory_parent)) {
                                                                          
                                                                                mkdir ($config_directory_parent);
                                                                                $config_directory=$config_directory_parent . "/config";
                                                                                 mkdir ($config_directory);
                                                                              }
                                        break;
                                }



                          
                       #write out the configuration file if the directories exist
    if (isset($config_directory)&&file_exists($config_directory) ) {
    

                                $handle = fopen( $config_directory . '/wp-config.php', 'w' );
				foreach ( $wp_config as $line ) {
					fwrite( $handle, $line );
				}
				fclose( $handle );

				// We set the good rights to the wp-config file
				chmod( $config_directory . '/wp-config.php', 0666 );
}
                                
                                                             //make config directory
                            

                            


}

/**
 * add_homedir_wp_config
 *
 * Adds a wp_config file to the WordPress home directory. This file will include the wp-config file contained in the config directory above the webroot.
 * @param none
 * @return void
 */
function add_homedir_wp_config() {
    global $directory;
    $contents="<?php
	

	if ( !defined('ABSPATH') )
	define('ABSPATH', (dirname(__FILE__)) );

//include ('../config/wp-config.php');
include realpath(dirname(__FILE__). '/../config/wp-config.php')  ;

?>";


file_put_contents($directory . '/wp-config.php', $contents);
}
	
