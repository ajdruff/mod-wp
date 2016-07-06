#! /bin/sh


######################
# Sets File Permissions
# Usage:
# cd /directory/that/contains/this file/
# ./set-perms.sh /path/to/wordpress
######################




echo "setting directory permissions..."


find "$1/" -type d -exec chmod 755 {} \;
find "$1/" -type d -exec setfacl -s user::rwx,group::r-x,other::r-x  {} \; #setfacl for cygwin


echo "setting file permissions..."

find "$1/" -type f -exec chmod 644 {} \;
find "$1/" -type f -exec setfacl -s user::rw-,group::r--,other::r-- {} \; #setfacl for cygwin



echo "setting configuration file permissions..."


chmod 600  "$1/wp-config.php"
setfacl -s user::rw-,group::---,other::--- "$1/wp-config.php" #setfacl for cygwin


chmod 600  "$1/config/wp-config.php"
setfacl -s user::rw-,group::---,other::--- "$1/config/wp-config.php" #setfacl for cygwin


chmod 644 "$1/.htaccess"
setfacl -s user::rw-,group::r--,other::r-- "$1/.htaccess" #setfacl for cygwin

#setfacl for cygwin
chmod 644 "$1/index.php"
setfacl -s user::rw-,group::r--,other::r-- "$1/index.php" #setfacl for cygwin


echo "completed setting permissions, exiting"
stat -c '%A %a %n' $1/* #displays permissions in octal format
exit


