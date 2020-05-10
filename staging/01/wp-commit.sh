#!/bin/sh

#
# 2019-10-24
#

 S=sitename

  F=$S.fossil

  FU=ubuntu
  FD=/home/$FU/F

#-------------------------------------
  cd /var/www/$S
  mkdir -p conf/nginx-etc
  cp /etc/nginx/sites-available/$S conf/nginx-etc/$S
#-------------------------------------

  cd /var/www/$S
  ./wp-dump.sh

#-------------------------------------

  echo ========= $(date +"%F %T") --- $0 --- $(pwd)

#-------------------------------------

  cd /var/www/$S

  if [ ! -w $FD/$F ]
  then

    mkdir -p $FD
    fossil new  $FD/$F

    fossil open $FD/$F trunk

    fossil set autosync       0
    fossil set repo-cksum     1
    fossil set manifest       0
    fossil set mtime-changes  0
    fossil set allow-symlinks 1

  fi


#-------------------------------------

  if [ $3 ]
  then
    echo "$3" > conf/tag.txt
  fi

#-------------------------------------

  fossil addr --dotfiles --ignore "logs/*,/.git/*,*tmp,*sql,*/cache/*"
  fossil commit -m "$(hostname) $1 " --no-warnings --delta --allow-fork $2 $3 $4

#-------------------------------------

  cd /var/www/$S

  chown -R www-data:www-data htdocs

  chown $FU:$FU $FD/$F

#-------------------------------------
  echo --------- $(date +"%F %T")
#-------------------------------------

#-end-#
