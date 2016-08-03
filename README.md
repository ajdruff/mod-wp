![Mod WP](https://cdn.rawgit.com/ajdruff/mod-wp/master/assets/images/mod-wp-logo-150x150.png)
================

**Mod WP** is a WordPress installer that enables you to modify the installation of 
WordPress to install custom content, themes and plugins. 

#Why use Mod WP to install WordPress?

With Mod WP you can:

* Be sure you always get latest version of WordPress and plugins with each installation
* Add custom pages, posts, plugins, and themes 
* Remove default WordPress content, plugins and themes. No more 'Hello Dolly' plugin, or 'Hello World' post to delete.


**What makes Mod WP better than other installation scripts?**

* **Installation Profiles** - You can create one installation profile and reuse it for multiple site setups. For example, does one of your clients have a set of plugins they always want activated? No problem, create one profile for them and reuse it for each install - you'll always install the latest plugin versions and even install their premium themes or plugins.
* **Choice of either a Web Form or Command Line Interface** 
    Install WordPress using Mod WP's web form for a quick point and click installation, call it from the command line or even integrate it into your own deployment scripts.
* **No special installation requirements**. Mod WP uses pure PHP to install WordPress, so if your server supports WordPress, it will support Mod WP.
* **Password Handling**
    -   Mod WP always generates your WordPress Admin password, ensuring a unique and complex password for each install.
    -   Mod WP provides an option to move your wp-config.php file outside the web root, potentially making it harder for an attacker to grab your database password.
    -   Mod WP doesn't allow you to edit your database username and password over the installation web form, thereby preventing accidental exposure over the web if accessing the installation form over a non-https channel.




#How to Install WordPress with Mod WP

## Installation Overview

1. Create the WordPress database
2. Download Mod WP and configure its installation settings
3. Run the Installer from the web interface or via command line

##Detailed Installation Steps


1. **Create the WordPress database**
>**Note: if the database user that you are using to install WordPress includes database creation permissions, you may skip this step **

    *by command line:*

        mysql -h localhost -u <database-username> -p
        mysql> CREATE DATABASE <database-name>;

    *by cPanel or other webhost configuration panel:*

      Login into your control panel and follow the steps provided by your host provider. For detailed steps, consult your hosting control panel's help or do a [web search for your web host](https://www.google.com/search?q=cPanel%20create%20database)




1. **Download Mod WP** and unzip the mod-wp directory, so that the `mod-wp` directory is placed into your website's web root.

   
    **download manually**

     1. Go to [https://github.com/ajdruff/mod-wp](https://github.com/ajdruff/mod-wp) and click 'Clone or Download' and click the 'Download ZIP' link, or download from [https://github.com/ajdruff/mod-wp/archive/master.zip](https://github.com/ajdruff/mod-wp/archive/master.zip)
     
     2.  Extract `mod-wp-master.zip` to your site's root folder (e.g: `public_html` or `htdocs`)
     3.  Rename the parent directory from `mod-wp-master` to `mod-wp`




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

    Make a copy of `mod-wp/config-site-sample.json` and rename it to `config-site.json`. 

        cd /path/to/mod-wp/
        cp config-site-sample.json config-site.json



    Edit `config-site.json` with the desired values for your site. 

    At a minimum, you'll need to change the following: 

        "wp_config": {

            "DB_NAME": "YOUR_DATABASE_NAME", 
            "DB_PASSWORD": "YOUR_DATABASE_PASSWORD",
            "DB_USER": "YOUR_DATABASE_USERNAME",
        },




3. **Run the Installer**

    ** *Run the Installer Using the Web Form* **

    1. Browse to the `mod-wp` directory e.g: `http://example.com/mod-wp/` 


    2. Select the profile you'd like to use by selecting from the dropdown.

    3. Review and edit any values as necessary. Some values are easily editable via the webform. Other less used settings require that you edit the `config-site.json` or `config-profile.json` file directly using a text editor.

    4. Click the `Install` button

    ** *Run the Installer Using the Command Line* **

            cd /path/to/mod-wp/
            chmod +x ./index.php

    >You may have to use the absolute path to the php executable if you start receiving errors, e.g:     `/c/UwAmp/bin/php/php-5.3.25/php" -f index.php`




##Security

>**Always delete the `mod-wp` directory** or at least the `config-site.json` when you are done with installation. The config-site.json file contains your database password and username and any attacker will be able to compromise your site resulting in data compromise and/or loss. 
Maintain proper file permissions for the wp-config.php files that are generated. 

**File and Directory Permissions**
Mod WP attempts to set recommended file permissions for all files, but you'll need to check that permissions are set properly for your risk environment. Setting permissions via PHP script sometimes fails silently due to the specifics of a particular site's configuration. For example, PHP `chmod` frequently fails in cygwin environments since the newer versions of cygwin rely on `setfacl` vs `chmod`. 

**Setting Permissions Using the bash script set-perms.sh**

Sometimes, the PHP script may fail to set the correct permissions. Mod WP comes with a bash script that you can use to execute recommended file permissions:

    cd /path/to//mod-wp/libs/
    chmod +x ./set-perms.sh
    ./set-perms.sh /absolute/path/to/wordpress

>**Permissions provided are not necessarily appropriate for your risk environment.**

**WordPress Hardening**

Since there are many different ways to harden WordPress, some with significant tradeoffs to performance and convienance, Mod WP doesn't attempt to harden WordPress. 


#Passwords


Mod WP doesn't let you set your own admin password, but generates one for you. The password is generated by a cryptographically secure algorithm which ensures complexity and uniqueness with each install. 

If you run the installer and forget to note the password, you'll be locked out of your newly installed site. You can fix this by re-running the installer to reset your password but keep the rest of the installation intact. See the 'Password Reset' section under 'Advanced Usage'.







#Mod WP Configuration 

Configuration settings are divided into 2 categories, *Site* and *Profile* which are contained in the `config-site.json` and `config-profile.json` files. 


**JSON Configuration File Format**

Configuration files use the [JSON](http://www.json.org/)  format. JSON is an easy to read, easy to parse data-interchange format. 

For help with troubleshooting common syntax errors in configuration files, see the troubleshooting section. 


>**Note** that some examples showing configuration settings show an elipsis in place of other settings. This is done for readability. Including the elipsis in practice will cause the JSON format to break and Mod WP to fail to start.

**Site Configuration**

The `config-site.json` file contains site specific settings, such as the name of the site and its description. The settings contained in this file may change for each new site for which you run the installer.

For typical Site settings, see the `config-site-sample.json` file. 


**Profile Configuration**

The `config-profile.json` file contains profile specific settings, such as which plugins and themes should be activated. 

For sample configuration settings, see the `config-profile-sample.json` file or the default `config-profile.json` file.


Installation profiles are contained in the `profiles` directory and contain settings, plugins, and themes that are common across similar sites. For example, if you have a client that likes a common set of plugins for all their sites, you can create a profile that can be used again and again for that client, ensuring consistency across installations.


An installation profile is configured by editing the `general:profile` setting contained in the `config-site.json` file or as selected from the `Profile` dropdown in the web form. 

To create a new profile, copy the `profiles/default` directory and rename it to the name of your profile. Change the `general:profile` setting to the name of the directory. Edit the `profiles/profile-name/profile-config.json` file as needed to fit your installation requirements, and add any custom themes or plugins to the either the `themes` or `plugins` subdirectory.

>* Refresh the Web Interface page after each edit of  `config-site.json` or `config-profile.json` . 
* For boolean values, use true or false, without quotes. ( Mod WP treats the following values as true or false:  '1','0','on','off','true','false','yes' or 'no'. 1 and 0 without quotes are treated as numbers not as true or false).



*Profile Configuration Settings*

For available Profile settings, see the `profiles/default/config-profile.json` file. 

**Viewing the full list of available configuration settings**

The full list of configuration settings and their descriptions can be found by visiting 

    http://example.com/mod-wp/?action=help-config

where `example.com` is the domain to your local site that contains the mod-wp directory. 


or via command line: 

    php index.php --help-config

*Site Configuration Settings*

For sample Site settings, see the `config-site-sample.json` file. 



**Leverage Profiles to save time**

Here are some ways you can use profiles to save time:

* Create a 'base' profile that includes your favorite backup, caching, gallery or other plugins that you want installed 'by default' when you run your install script
* Create a profile for each client so you know exactly what was installed and so you can replicate their installation for similar sites they may want to build.
* Use GitHub to share profiles with your team. Use your source control repository such as GitHub to share installation profiles that work best for your team.

**Default Configuration Settings**

`mod-wp.config.json` contains the properties of all settings, and the defaults when generating the sample files. It also supplies the default setting before your `config-profile.json` and `config-site.json` files are read, thereby acting as the 'factory defaults'.

It should never be edited and will be overridden by any settings that you set in `config-site.json` or the `config-profile.json` files . If you forget (or delete) a setting in either of those two files, the settings from  `mod-wp.config.json` files will be used.


**Configuration Order of Precedence**

Mod WP processes configuration settings in the following order:
* defaults from `mod-wp.config.json`
* settings from config-profile.json
* settings from config-site.json 


What this means in practice is that you can overwrite a Profile configuration by simply adding a similar setting in your `config-site.json` file with a different value. This means you can avoid having to edit the original `config-profile.json` file.

For example, if a `config-profile.json` has the following setting:

        "wp_options": {
        ...            
        "template": "twentyfifteen",
        ...
        },


You can override it by adding the following setting in config-site.json:

        "wp_options": {
        ...
        "template": "twentyfourteen",
        ...
        },

The installer will set the theme as 'twentyfourteen'.




#Generating Sample Configuration Files

Its always recommended that you start configuration using a copy of  `config-site-sample.json`  and `config-profile-sample.json` or  `default/config-profile.json`.

If you delete the configuration sample files and want to regenerate them from scratch, you can do so by by visiting 

    http://example.com/mod-wp/?action=samples

where `example.com` is the domain to your local site that contains the mod-wp directory. 


or via command line: 

    php index.php --samples

This will create new sample files and place them in the root of the `mod-wp` directory.

The sample files are generated using the following guidelines which you should also use whenever you create or modify the files:

* `config-profile.json` should include debug settings and recommended that they are turned off. 
* `config-profile.json`  should never include site specific settings or credentials ( site name, usernames, password). 
* `config-site.json` should include debug settings 

These recommendations are encoded in the configuration generator according to the boolean configuration properties '`site`' and '`profile`' found in `mod-wp.config.json`.

These are just recommendations. In practice,  any setting can be added to any file.If identical settings are found in both files, `config-site.json` will override `config-profile.json`.



The overall principal is that profiles (`config-profile.json`) are intended to be common settings that can be re-used over and over without modification for similar site installations. Site settings (`config-site.json`) are intended to override profile settings for a site specific installation.

#Why can't you edit Profile settings using the web form?

Profile settings are intentionally not editable via the web form. If you feel you need to modify a profile setting, and the new value is needed for your current installation, edit the `config-site.json` file and add or edit an equivilent setting. The site setting you add/edit will override the setting in the profile.

If you want to make a permanent change to the profile that will effect all future installations that use that profile,  edit its `config-profile.json` file. 

You may also consider creating an entirely new profile if your modifications will be needed for future installations.


#WordPress Configuration 

**How Mod WP Configures WordPress**

Mod WP takes the settings found in your `config-site.json` and `config-profile.json` files that are under the 'wp-config' section and creates a customized `wp-config.php` file that includes those settings. 

In addition, it updates the `wp_options` database table with any settings that are contained in the 'wp-options' section of the configuration file.


Other modifications it makes:

* moves the wp-config.php to its own separate directory (see the next section for more information)
* updates wp-config.php with custom salts
* optionally creates  `_live` , `_stage`, and `_dev` `wp-config.php` files when used with the [Slide Rule project](https://github.com/ajdruff/slide-rule) ( set `general:slide_rule` to true);

If you'd like to re-configure WordPress without overwriting your site's installation, you can do so by changing all options under the `install_switches` section to false except `wpConfig`.

**Location of the wp-config.php file**

The `wp-config.php` file contains your database username and password, and many other settings used by WordPress to configure your site. A typical installation of WordPress places this file alongside the other files contained in the WordPress installation directory, above your web server's root directory. 

With the right file permissions, this location can be fine in terms of security, but some prefer `wp-config.php` to be located outside the web root to further protect against unauthorized viewing or editing.

By default, Mod WP creates a directory `config` in the WordPress directory and places `wp-config.php` file within it, and then modifies the `wp-config.php` contained in the WordPress installation directory to  include  `config/wp-config.php`. The user may then keep the `config` directory in the web root, or move it above the web root. Either way, Mod WP makes sure that WordPress can find it.

To disable this default behavior of moving the wp-config.php file, set `general:move_wpconfig` to true. This will keep `wp-config.php` alongside the other files as intended with a typical installation.




#Advanced Usage


##Password Reset

To reset the admin password for the admin user configured during the initiall installation:

Edit the config-site.json file and under the *Advanced-Selective Install* section, set the following values to false:

* wpDownload
* wpConfig
* WpInstallCore
* wpInstallPlugins
* wpInstallThemes

Set the following value to true:

* wpResetPassword

Now re-run installation using either the web interface or command line. Your admin password will be reset for the configured admin user.

If you get database connection errors, make sure your database username and password is set correctly under the `Database` section and re-run the install.

##Installation Switches

Normally, Mod WP does the following when it installs WordPress:

* Download WordPress (wpDownload)
* Creates wp-config.php files (wpConfig)
* Installs WordPress Core (WpInstallCore)
* Installs Plugins (wpInstallPlugins)
* Installs Themes (wpInstallThemes)

You can instead choose to selectively execute any one of these steps  by editing their true or false values in the `config-site.json` file under the `install_switches` section, or check or uncheck the option from the advanced tab in the installation web form.

For example, if you just want to download WordPress and unzip it, but not perform configuration or installation of core,themes or plugin (and therefore not actualy populate the install's database), then the settings would be:


    "install_switches": {
        "wpDownload": true,
        "wpConfig": false,
        "wpInstallCore": false,
        "wpInstallThemes": false,
        "wpInstallPlugins": false,
        "wpResetPassword": false
    }

>Note that you may run into errors if you try to re-run setup without the `reinstall` option set to true. See the **Reinstall** section for more information.

##Reinstall

Re-installing WordPress on a site that has been operating for some time where the site has accumulated new posts, users and uploads that were not included in the initial installation will delete those new users and posts. 

To safeguard against that potential loss of data, re-running setup under its default settings will result in errors warning that it will overwrite your already downloaded files or your already installed database and the installer will refuse to continue.

If however, you simply want to re-install WordPress and don't care if your data or database is overwritten (maybe because you changed your mind and want to rerun setup using a different profile, for example) , then find the `general:reinstall` option and set it true. 

    "general": {
        ...
        "reinstall": true,
        ...
    }

Re-run setup and setup will overwrite your old files and database without throwing an error or prompting.







##Custom `wp_option` settings


The default `config-site.json` and `config-profile.json` files contain a few settings that are saved to the `wp_options` WordPress database table.

You can add any valid option during install by simply adding an equivilent setting within the `config-site.json` file.

For example, if you wanted to set the number of posts per page for your installation to 5 vs the default 10, you can add the following line to `config-site.json`


        "wp_options": {
        "blogdescription": "Just Another WordPress Site",
        "blogname": "My WordPress Site",
        "permalink_structure": "%postname%",
        "posts_per_page": "5"
        }





##Temporary Settings Override

When installing via the web form, most settings are not available to edit except by editing the `config-site.json` or `config-profile.json` file using a text editor.

If you want to temporarily change any settings without having to edit the appropriate configuration file, you can add a Query String paramater to override the value.



If for example, you would normally call the script using something like this: 

    http://example.com/mod-wp/

You can override a site configuration setting such as `general:add_custom_content` (for example if the profile has set it to false) to true by visiting the following url and clicking 'Install': 

     http://example.com/mod-wp/?SITE_CONFIG[general][add_custom_content]=true

You can also override  both  a site configuration and a profile configuration value using a url similar to: 

    http://example.com/mod-wp/?SITE_CONFIG[general][add_custom_content]=true&PROFILE_CONFIG[general][add_custom_plugins]=true

>**Note** In practice, you would likley never need to override profile values (the second example) since site settings always override profile values.




#Troubleshooting



##Exception Info

You can get more info on Mod WP errors by setting `general:show_exceptions` to true.


##Persistent retrys

A 'retry' mechanism was added to try to overcome what is usually a timing limitation that doesn't always allow wpUnzip or wpConfig to complete. A number of retrys for each installation task are attempted and if they all fail, the installation fails. 

A mechanism was also added to increase the script execution time each time a retry is attempted. 

Even upon failure,  if you just do a hard refresh of the page and restart the install, the new attempt will usually be successful.

For more information on troubleshooting script timing issues, see the **'Timing Issues'** section under **'Errors'**.


##JSON Configuration files

JSON may be easy to use, but it will choke quite badly if you add an extra comma or miss a quotation mark. 

If Mod WP refuses to start due to a JSON parsing error, do a [web search](https://goo.gl/rwGt8O)  for a JSON validator, paste in your configuration file and let it catch your mistake. 

**Common JSON Errors**

***Syntax Error - Extra Comma***

You added a comma at the end of a section (extra comma for the table_prefix setting) : 

        "wp_config": {
                "DB_HOST": "localhost",
                "DB_NAME": "YOUR_DATABASE_NAME",
                "DB_PASSWORD": "YOUR_DATABASE_PASSWORD",
                "DB_USER": "YOUR_DATABASE_USERNAME",
                "table_prefix": "wp_",
            },
        


***Syntax Error - Missing Comma***

* You forgot to add comma for a setting(missing comma for DB_NAME)

        "wp_config": {
                "DB_HOST": "localhost",
                "DB_NAME": "YOUR_DATABASE_NAME"
                "DB_PASSWORD": "YOUR_DATABASE_PASSWORD",
                "DB_USER": "YOUR_DATABASE_USERNAME",
                "table_prefix": "wp_"
            },

***Correct Syntax***

    "wp_config": {
            "DB_HOST": "localhost",
            "DB_NAME": "YOUR_DATABASE_NAME",
            "DB_PASSWORD": "YOUR_DATABASE_PASSWORD",
            "DB_USER": "YOUR_DATABASE_USERNAME",
            "table_prefix": "wp_",
        },



##Errors & Installation Failures


**'Cannot proceed without a config-site.json file! Create one from `config-site-sample.json`'**

Make a copy of mod-wp/config-site-sample.json and rename the copy to  mod-wp/config-site.json.  Edit the new file with your site's database configuration and username and login. See the *Configuration* section for more information.

**Timing Issues** 
**e.g.:** **Install failed during wpUnzip, please check your settings and try again.**

Usually this is the result of a timing issue with how long it takes to delete and unzip your files and how long the script is allowed to run per your PHP  settings.

Try  restarting the install again. If after repeated attempts it still doesn't work, you can adjust how long PHP allows the script to run by trying one of the following:

*option 1, Edit config-site.json and change max_execution_time*

        "general": {
        ...
        "max_execution_time": 300,
        ...
        },

*option 2, Edit the php.ini file*

    ; Maximum execution time of each script, in seconds
    max_execution_time = 120



**Cannot create the WordPress database...**

This error occurs because the credentials you provided do not have permissions to create a WordPress database. You can still continue, but you'll need to create the database manually or provide credentials for a user that has been granted the 'Create' permission.


Either update the config-site.json with user credentials that have permissions to create a database, or do one of the following:



*For shared web hosting accounts*

Use the Control Panel or phpMyAdmin tools that are provided by your web hosting provider. 

*By Command Line:*

Login using MySQL credentials with permissions to create a database:

    mysql -u username -p
    password:******

Execute the Create Database query:

    mysql> CREATE DATABASE IF NOT EXISTS `YOUR_DB_NAME`;


*Using a MySQL Query*

While logged in as a user with the create permissions into a MySQL Admin tool such as phpMyAdmin, Netbeans, or Toad, execute the following query:

    CREATE DATABASE IF NOT EXISTS `YOUR_DB_NAME`


**Cannot drop the existing database ...**

You may receive this error when attempting to re-install with a user account that does not have permissions to drop a database.

Either update the config-site.json with user credentials that have permissions to drop a database, or do one of the following:


*For shared web hosting accounts*

Use the Control Panel or phpMyAdmin tools that are provided by your web hosting provider. 

*By Command Line:*

Login using MySQL credentials with permissions to create a database:

    mysql -u username -p
    password:******

Execute the Drop Database query:

    mysql> DROP DATABASE IF EXISTS `YOUR_DB_NAME`;


*Using a MySQL Query*

While logged in as a user with  drop permissions into a MySQL Admin tool such as phpMyAdmin, Netbeans, or Toad, execute the following query:

    DROP DATABASE IF EXISTS `YOUR_DB_NAME`;

**WordPress pages are generated partially or without styling**

When you browse to your WordPress site after installation, pages may appear unstyled or with some text missing. This can occur for several reasons which may include:

* a reinstallation occurred into a different directory but `wpInstallCore`wasn't executed so that it could update the site and home urls.
* the installation was interrupted due to an error

To fix this, simply re-install, setting all options under the Selective Installation tasks to true , except for `install_switches:wpResetPassword` which should be set to false. You will also have to set  `general:Reinstall` to true to overwrite your existing database settings. Be aware that this will overwrite your database and the files in your installation directory.

If overwriting is not an option and you are worried about losing data, you can add the following in your wp-config.php file and you should be able to access your site:

    define('WP_SITEURL','/path/to/your/wordpress/directory')



**WordPress page is blank or not accessible after installing from command line**

Verify that the `general:HTTP_HOST` setting is correct and is an accessible domain name that points to the web root that contains your WordPress directory.



**Access Denied Errors**

You may receive the following types of errors if you are trying to run Mod WP from the command line but are doing it from a shell account that doesn't have permissions to required directories and files:

    Warning: rename(wordpress/wp-content,/path/to/wordpress/wp-content): Access is denied. (code: 5) in mod-wp\libs\mod-wp.class.php on line 806



 or 



    ERRORS:WordPress has not been downloaded yet ...

To fix these errors, you'll need to first login as the owner of the files, or, alternately, change the ownership of all the files to your account.

This is a common issue in cygwin environments where you are trying to install using a console shell that is using a different account than what the server (uWamp/WAMP) used in creating the files.  If, for example, you tried to use a Git for Windows shell to run the script, you'll receive these errors. The fix would be switch to a cygwin shell , verify you have access to the required files, and run  Mod WP from that shell.


**WordPress has not been downloaded yet**

Usually this error is exactly as it says and you should follow its instructions on how to fix it. The WordPress directory is empty and you are trying to proceed to install without any of the files needed to do the installation.

Alternately, it may  be a result of permissions issues preventing Mod WP from viewing the files that you downloaded. See 'Access Denied Errors'

**Memory Errors**

If you receive a memory error, similar to ***Fatal error: Allowed memory size of xxxx bytes exhausted * , increase the `memory_limit` setting in the php.ini file. 256M should be the most you'll need. After you install WordPress, you can reset the memory limit to its original value.


    ; Maximum amount of memory a script may consume (128MB)
    ; http://php.net/memory-limit
    memory_limit = 256M


**Table 'dbname.wp_options' doesn't exist'**

This occurred intermittently during testing when reinstall=true. The only way that appeared to fix it was to delete wp-config.php, replace it with a copy of config-sample.php with database values replaced for correct connection credentials, and rerun setup with `install_switches:wpDownload` = false and `install_switches:wpConfig` = false. Once it works, re-run it again with `install_switches:wpConfig` = true so you can get back your configuration. Not sure why this fixes it, it may have something to do with permissions on wp-config.php. 

**Fatal error: Uncaught exception 'ErrorException' with message Directory not empty**

This error may happen when running from a command line. Try again and it should work without error.


**stream_socket_client() errors**

This is likely due to HTTP_HOST not being set to a resolvable host.

>*Developer note:* We did see this error and fixed it by setting `WP_SITEURL` to a value calculated from `_wpGetSiteUrl`, before `wp_install()` was callled. Its value was calculated from `_wpGetSiteUrl`


##History


1.0
-----------


6.22.2016 - Initial Release

5.9.2016 - Initial commit forked from WP Quick Install 1.4.2 by Jonathan Buttigieg

The following changes were made from the original WP Quick Install fork:

- The code was re-factored into a PHP class that does the heavy lifting
- Command Line Support was added
- A different front end was added, replacing nearly all the original html and Javascript
- The original Javascript used separate Ajax requests for each installation action. The new script loops through a configurable array of actions supplied by the server side script to repeatedly call the same ajax call until all actions are completed. This allows greater flexibility in adding or re-ordering actions without having to edit the Javascript.
- The original script parsed ini files for configuration. Mod WP instead uses 2 configuration files that are PHP scripts. The reason ini files were abandoned was due to an apparent bug that prevented the ini parser from handling complex passwords.
- Passwords are handled more securely - the database password is never revealed or editable on the browser page, and the WP admin password is automatically generated by a cryptographically secure function with no option for the user to create their own. This not only ensures a strong password, but it also means there is no risk that the same password will be used for each new installation.
- Configuration options were renamed to be more consistent with WordPress standards.  See the Configuration section for more detail.
- Site Profiles were added. Profiles contain non-site specific installation options such as which  plugins and themes should be installed. They should not contain any options that require you to specify a options that can't be used for multiple sites (for example, domain name or admin user name)



### Authors and Contributors
Andrew Druffner (@ajdruff)

### Support or Contact
Having trouble with Mod WP? Check the [readme](https://github.com/ajdruff/mod-wp/blob/master/README.md) or [submit an issue](https://github.com/ajdruff/mod-wp/issues).


