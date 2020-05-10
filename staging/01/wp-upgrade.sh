#!/bin/bash

#
# 2019-10-24
#

 S=sitename

  cd /var/www/$S

  echo ====== $0 $(date +"%F %T") $(pwd)


  WP="wp --path=htdocs --allow-root"

  export HTTP_HOST=localhost

  $WP transient delete --all

  $WP core update
  $WP core update-db
  $WP core verify-checksums

  $WP theme update --all
  $WP language theme update --all

  $WP plugin update --all
  $WP language plugin update --all

