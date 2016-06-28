Mod WP
================
Mod WP is a WordPress installer that enables you to modify the installation of 
WordPress to install custom content, themes and plugins. 

#Why use Mod WP to install WordPress?

* You always get the latest version of WordPress and plugins
* You can add custom pages and posts
* You can add custom plugins and themes
* You can remove default WordPress content like the 'Hello World' post and comments.
* You can remove the default plugins and themes like TwentyEleven and Hello Dolly


**What makes Mod WP better than other installation scripts?**

* **Installation Profiles** - You can create one installation profile and reuse it for multiple site setups. For example, does one of your clients have a set of plugins they always want activated? No problem, create one profile for them and reuse it for each install - you'll always install the latest plugin versions and even install their premium themes or plugins.
* **Choice of either a Web Form or Command Line Interface** 
    Install WordPress using Mod WP's web form for a quick point and click installation, call it from the command line or even integrate it into your own deployment scripts.
* **No special installation requirements**. Mod WP doesn't use bash or anything other than whats required for a typical WordPress installation.
* **More secure**
    -   You are never allowed to choose your own WP Admin password on installation, the script always creates one for you. 
    -   wp-config.php is moved to outside the web root.
    -   Secure File permissions are set automatically.
    -   Your database username and password aren't exposed over the web form.




#How to Install WordPress with Mod WP

## Installation Overview

1. Create the WordPress database
2. Download Mod WP and configure its installation settings
3. Run the Installer from the web interface or via command line

##Detailed Installation Steps


1. **Create the WordPress database**

    *by command line:*

        mysql -h localhost -u <database-username> -p
        mysql> CREATE DATABASE <database-name>;

    *by cPanel or other webhost configuration panel:*

      Login into your control panel and follow the steps provided by your host provider. For detailed steps, consult your hosting control panel's help or do a [web search for your web host](https://www.google.com/search?q=cPanel%20create%20database)




1. **Download Mod WP** and unzip the mod-wp directory, so that the `mod-wp` directory is placed into your website's web root.

   
    **download manually**

     1. Go to [https://github.com/ajdruff/mod-wp](https://github.com/ajdruff/mod-wp) and click 'Clone or Download' and click the 'Download ZIP' link, or download from [https://github.com/ajdruff/mod-wp/archive/master.zip](https://github.com/ajdruff/mod-wp/archive/master.zip)
     
     2.  extract to your site's root folder




    **download using git clone**

            cd /path/to/webroot/
            git clone https://github.com/ajdruff/mod-wp.git


    **download using wget**

             cd /path/to/webroot/ 
             wget -qO- https://github.com/ajdruff/mod-wp/archive/master.tar.gz | tar -zx
             mv mod-wp* mod-wp


    **download using curl**

            cd /path/to/webroot/
            curl -L https://github.com/ajdruff/mod-wp/archive/master.tar.gz | tar -zx
            mv mod-wp* mod-wp




      Your website's directory structure should now look something like this :

            
                        public_html
                            ├───mod-wp
            
3. **Configure Mod WP** 

    Make a copy of `mod-wp/site-config-sample.php` and rename it to `site-config.php`. 

        cd /path/to/mod-wp/
        cp site-config-sample.php site-config.php



    Edit `site-config.php` with the desired values for your site. 

    At a minimum, you'll need to change the following: 

        + $site[ 'wp_users' ][ 'user_login' ]  (the WordPress administor's username)
        + $site[ 'wp_users' ][ 'user_email' ] (the WordPress administor's email)
        + $site[ 'wp_config' ][ 'DB_NAME' ](the WordPress database name)
        + $site[ 'wp_config' ][ 'DB_USER' ] (A username that WordPress can use to access the database)
        + $site[ 'wp_config' ][ 'DB_PASSWORD' ] (The WordPress database user's password)

3. **Run the Installer**

    ** *Run the Installer Using the Web Form* **

    1. Browse to the `mod-wp` directory e.g: `http://example.com/mod-wp/` 


    2. Select the profile you'd like to use by selecting from the dropdown.

    3. Review and edit any values as necessary. Some values are easily editable via the webform. Other less used settings require that you edit the `site-config.php` or `profile-config.php` file directly using a text editor.

    4. Click the `Install` button

    ** *Run the Installer Using the Command Line* **

            cd /path/to/mod-wp/
            php index.php

    >You may have to use the absolute path to the php executable if you start receiving errors, e.g:     `/c/UwAmp/bin/php/php-5.3.25/php" -f index.php`



#Passwords


Mod WP doesn't let you set your own admin password, but generates one for you. The password is generated by a cryptographically secure algorythmn which ensures complexity and uniqueness with each install. 

If you run the installer and forget to note the password, you'll be locked out of your newly installed site. You can fix this by re-running the installer to reset your password but keep the rest of the intallation intact. See the 'Password Reset' section under 'Advanced Usage'.







#Configuration 

Configuration settings are divided into 2 categories, *Site* and *Profile* which are contained in the `site-config.php` and `profile-config.php` files. 

**Site Configuration**

The `site-config.php` file contains site specific settings, such as the name of the site and its description. The settings contained in this file may change for each new site for which you run the installer.


**Profile Configuration**


Installation profiles are contained in the `profiles` directory and contain settings, plugins, and themes that are common across similar sites. For example, if you have a client that likes a common set of plugins for all their sites, you can create a profile that can be used again and again for that client, ensuring consistency across installations.


An installation profile is configured by editing the $site['profile'] setting contained in the `site-config.php` file or as selected from the `[profile]` dropdown in the web interface. 

To create a new profile, copy the `profiles/default` directory and rename it to the name of your profile. Change the `$site['profile']` setting to the name of the directory. Edit the `profiles/profile-name/profile-config` file as needed to fit your installation requirements, and add any custom themes or plugins to the either the `themes` or `plugins` subdirectory.

>* Refresh the Web Interface page after each edit of  `site-config.php` or `profile-config.php` . 
* For boolean values, use true or false, without quotes. ( Mod WP treats the following values as true or false:  '1','0','on','off','true','false','yes' or 'no'. 1 and 0 without quotes are treated as numbers not as true or false).



#Leverage Profiles to save time

Here are some ways you can use profiles to save time:

* Create a 'base' profile that includes your favorite backup, caching, gallery or other plugins that you want installed 'by default' when you run your install script
* Create a profile for each client so you know exactly what was installed and so you can replicate their installation for similar sites they may want to build.
* Use GitHub to share profiles with your team. Use your source control repository such as GitHub to share installation profiles that work best for your team.





#Advanced Usage


##Password Reset

To reset the admin password for the admin user configured during the initiall installation:

Edit the site-config.php file and under the *Advanced-Selective Install* section, set the following values to false:

* wpDownload
* wpConfig
* WpInstallCore
* wpInstallPlugins
* wpInstallThemes

Set the following value to true:

* wpResetPassword

Now re-run installation using either the web interface or command line. Your admin password will be reset for the configured admin user.

If you get database connection errors, make sure your database username and password is set correctly under the `Database` section and re-run the install.

##Selective Install

Normally, Mod WP does the following when it installs WordPress:

* Download WordPress (wpDownload)
* Creates wp-config.php files (wpConfig)
* Installs WordPress Core (WpInstallCore)
* Installs Plugins (wpInstallPlugins)
* Installs Themes (wpInstallThemes)

You can instead choose to selectively execute any one of these steps  by editing their true or false values in the `site-config.php` file under the `Selective Install` setting, or check or uncheck the option from the installation web form.

For example, if you just want to download WordPress and unzip it, but not perform configuration or installation of core,themes or plugin (and therefore not actualy populate the install's database), then the settings would be:


    /* * *********************************
     - Advanced-Selective Install
     - ********************************* */

    $site[ 'wpDownload' ] = true; #default true
    $site[ 'wpConfig' ] = false; #default true
    $site[ 'wpInstallCore' ] = false; #default true
    $site[ 'wpInstallThemes' ] = false; #default true
    $site[ 'wpInstallPlugins' ] = false; #default true
    $site[ 'wpResetPassword' ] = false; #default false

>Note that you may run into errors if you try to re-run setup without the `reinstall` option set to true. See the **Reinstall** section for more information.

##Reinstall

Re-installing WordPress on a site that has been operating for some time where the site has accumulated new posts, users and uploads that were not included in the initial installation will delete those new users and posts. 

To safeguard against that potential loss of data, re-running setup under its default settings will result in errors warning that it will overwrite your already downloaded files or your already installed database and the instaler will refuse to continue.

If however, you simply want to re-install WordPress and don't care if your data or database is overwritten (maybe because you changed your mind and want to rerun setup using a different profile, for example) , then find the `$site[ 'reinstall' ]` option and set it true. Re-run setup and setup will overwrite your old files and database without throwing an error or prompting.

>**Caution** : Always delete the `mod-wp` directory or at least change this 







##Custom `wp_option` settings


The default site-config.php and site-profile.php files contain a few settings that are saved to the `wp_options` WordPress database table.

You can add any valid option during install by simply adding an equivilent setting within the site-profile.php file.

For example, if you wanted to set the number of posts per page for your installation to 5 vs the default 10, you can add the following line to `site-config.php`

    $site[ 'wp_options' ][ 'posts_per_page' ] = 5;



##Temporary Settings Override

When installing via the web form, most settings are not available to edit except by editing the site-config.php or profile-config.php file using a text editor.

If you want to temporarily change any settings without having to edit the appropriate configuration file, you can add a Query String paramater to override the value.



If for example, you would normally call the script using something like this: 

    http://example.com/mod-wp/

You can override a site configuration setting such as $site['wpConfig'] which is normally set to false, to true by visiting the following url and clicking 'Install': 

     http://example.com/mod-wp/?SITE_CONFIG[wpConfig]=false

You can override  both  a site configuration and a profile configuration value using a url similar to: 

    http://example.com/mod-wp/?SITE_CONFIG[wpConfig]=false&PROFILE_CONFIG[wp_options][permalink_structure]=test





#Troubleshooting



**Exception Info**

You can get more info on exceptions by setting $site[ 'debug-show-exceptions' ] = true;


**Persistent retrys**

A 'retry' mechanism was added to try to overcome what is probably a timing limitation that doesn't always allow wpUnzip or wpConfig to complete. 3 retrys are attempted and if they all fail, the installation fails. Usually if you just do a hard refresh of the page and restart the install it will work.



##Errors


**'Cannot proceed without a site-config.php file! Create one from `site-config-sample.php`**

Make a copy of mod-wp/site-config-sample.php and rename the copy to  mod-wp/site-config.php.  Edit the new file for with your site's database configuration and username and login.


**Memory Errors**

If you receive a memory error, increase the `memory_limit` setting in the php.ini file. 256M should be the most you'll need.


    ; Maximum amount of memory a script may consume (128MB)
    ; http://php.net/memory-limit
    memory_limit = 256M


**Table 'dbname.wp_options' doesn't exist'**

This occurred intermittently during testing when reinstall=true. The only way that appeared to fix it was to delete wp-config.php, replace it with a copy of config-sample.php with database values replaced for correct connection credentials, and rerun setup with $site[ 'wpDownload' ] = false and $site[ 'wpConfig' ] = false. Once it works, re-run it again with wpConfig enabled so you can get back your configuration. Not sure why this fixes it, it may have something to do with permissions on wp-config.php. 

**Fatal error: Uncaught exception 'ErrorException' with message Directory not empty**

This error may happen when running from a command line. Try again and it should work without error.


**stream_socket_client() errors**

This is likely due to HTTP_HOST not being set to a resolvable host.

We did see this error and fixed it by setting WP_SITEURL before wp_install was callled, setting it to a value calculated from `_wpGetSiteUrl`


##History


1.0
-----------


6.22.2016 - Initial Release

5.9.2016 - Initial commit forked from WP Quick Install 1.4.2 by Jonathan Buttigieg

The following changes were made from the original WP Quick Install fork:

- The code was refactored into a PHP class that does the heavy lifting
- Command Line Support was added
- A different front end was added, replacing nearly all the original html and javascript
- The original javascript used separate ajax requests for each installation action. The new script loops through a configurable array of actions supplied by the server side script to repeatedly call the same ajax call until all actions are completed. This allows greater flexibility in adding or re-ordering actions without having to edit the javascript.
- The original script parsed ini files for configuration. Mod WP instead uses 2 configuration files that are PHP scripts. The reason ini files were abandones was due to an apparent bug that prevented the ini parser to handle complex passwords.
- Passwords are handled more securely - the database password is never revealed or editable on the browser page, and the WP admin password is automatically generated by a cryptographically secure function with no option for the user to create their own. This not only ensures a strong password, but it also means there is no risk that the same password will be used for each new installation.
- Configuration options were renamed to be more consistent with WordPress standards.  See the Configuration section for more detail.
- Site Profiles were added. Profiles contain non-site specific installation options such as which  plugins and themes should be installed. They should not contain any options that require you to specify a options that can't be used for multiple sites (for example, domain name or admin user name)

