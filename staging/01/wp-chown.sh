#!/bin/bash

#
# 2019-10-24
#

 S=sitename

  cd /var/www/$S

  echo ====== $0 $(date +"%F %T") $(pwd)


  chown -R www-data:www-data htdocs
