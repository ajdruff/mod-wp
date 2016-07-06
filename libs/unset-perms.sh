#! /bin/sh


######################
# Sets File Permissions
# Usage:
# cd /directory/that/contains/this file/
# ./unset-perms.sh /path/to/wordpress
######################




echo "setting directory permissions..."


find "$1/" -type d -exec chmod 755 {} \;
find "$1/" -type d -exec setfacl -s user::rwx,group::r-x,other::r-x  {} \; #setfacl for cygwin


echo "setting file permissions..."

find "$1/" -type f -exec chmod 744 {} \;
find "$1/" -type f -exec setfacl -s user::rwx,group::r--,other::r-- {} \; #setfacl for cygwin




echo "completed setting permissions, exiting"
stat -c '%A %a %n' $1/* #displays permissions in octal format
exit


