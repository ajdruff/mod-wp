#!/usr/bin/bash

#################
# git-make-changelog.sh
#
#
# Description
#
#  Usage:
# ./git-make-changelog.sh
#
#
# @author <user@example.com>
#
#################
 




#get the directory this file is in
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

#get its parent directory pat
DIR_PARENT=$(dirname $DIR)

#read common variables for all bash scripts
#source "${DIR%%/}/config-bash.conf";
# cd "${LOCAL_REPO_PATH%%/}/"
cd "${DIR_PARENT%%/}/"
#pwd;
#exit;
#git log 1.0.0...1.1.1 
#git log  --pretty=format:'%n* *%cd*  %n%s %n[view commit](http://github.com/simpliwp/downcastwp/commit/%H) ' | grep -v Merge >>changelog.md

git log  --pretty=format:'%n* *%cd*  %n%s %n' | grep -v Merge >changelog.md



