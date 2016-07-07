#! /bin/sh


######################
# Unsets File Permissions
# Usage:
# cd /directory/that/contains/this file/
# ./unset-perms.sh /path/to/wordpress
######################


#stop and make sure an argument was passed. 
if [ $# -eq 0 ]
  then
    echo "Must specify the WordPress directory path"
exit;
fi



#get the directory this file is in
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )


#get its parent directory
MOD_WP_DIR=$(dirname $DIR)

#define permissions and their ACL equivilents (for cygwin)
DIR_PERMS=0755
DIR_PERMS_ACL=user::rwx,group::r-x,other::r-x

FILE_PERMS=0644
FILE_PERMS_ACL=user::rw-,group::r--,other::r--

echo "setting directory permissions..."


find "$1/" -type d -exec chmod "${DIR_PERMS}" {} \;
find "$1/" -type d -exec setfacl -s "${DIR_PERMS_ACL}"  {} \; #setfacl for cygwin


echo "setting file permissions..."

find "$1/" -type f -exec chmod "${FILE_PERMS}" {} \;
find "$1/" -type f -exec setfacl -s "${FILE_PERMS_ACL}" {} \; #setfacl for cygwin



echo "setting configuration file permissions..."


#site-config.php
find "${MOD_WP_DIR}/site-config.php" -type f -exec chmod "${FILE_PERMS}" {} \;
find "${MOD_WP_DIR}/site-config.php" -type f -exec setfacl -s "${FILE_PERMS_ACL}" {} \; #setfacl for cygwin


echo "completed setting permissions, exiting"
stat -c '%A %a %n' $1/* #displays permissions in octal format
exit


