
#todo:

* test install.php


* generate dev docs (optional)
* review comments for javascript
* add password library via modules (after you commit once) 
* add an archived folder
* add install.php functionality, where it will add the install.php file. 
* remove all plugins option ( delete any directories in plugins directory
* create a module for each of the themes in the themes folder.
#Full Install (Web Based)

#Full Install (Command Line)


#Selective Install


#Passwords


#Reinstall

The installer will by default prevent re-installing by throwing an error whenever the download directory exists or when the database is not empty.
You can override this behavior by adding '?reinstall=true' to the web url or adding $config['reinstall']=true for command line.

Note this can be dangerous if you inadvertently re-run the script with reinstall=true. Always be sure to remove $config['reinstall']=true from the configuration file when you are done testing.


#Faqs

##Why doesn't the installer show the final 'WordPress Login' message displaying username and password?

This will happen if you have wpInstallCore set to false.

You can either set wpInstallCore to true (and delete the database if it already exists if you get an error indicating an existing database) or use the existing username, password, and site urls from the previous install if you know them.

With wpInstallCore set to false, the installer won't access the database at all (because it doesnt know if the database is available or contains valid data) and won't return username, password or the site urls. 




#Bugs

With reinstall=true, sometimes the installer will hang when trying to overwrite the download directory, throwing rename errors. Simply restart the installer and it should complete normally. this is may be due to a timing issue on some systems.



