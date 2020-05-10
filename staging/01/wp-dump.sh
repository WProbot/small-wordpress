#!/bin/bash

#
# 2019-10-24
#

 S=sitename

  WP="wp --allow-root --path=../htdocs"

#-------------------------------------

  echo ========= $(date +"%F %T") --- $0 --- $(pwd)

#-------------------------------------

  cd /var/www/$S

  mkdir -p tmp db

  cd db

#-------------------------------------

  KEY=secret.key

  $WP db export - | head -n -1 > full.sql

  test -f full.sec && rm full.sec
  gpg --batch --yes -z 9 -vv --passphrase-file $KEY  --output full.sec --symmetric  full.sql

#-------------------------------------
  echo --------- $(date +"%F %T")
#-------------------------------------

#-end-#

