#!/bin/bash

#
# 2019-10-24
#

 S=sitename

  cd /var/www/$S


  echo ====== $0 $(date +"%F %T") $(pwd)


  WP="wp --path=htdocs --allow-root"

  export HTTP_HOST=localhost

  $WP cron event run --due-now
