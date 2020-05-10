#!/bin/bash

#
# monthly incremental backup
#
# v2
#

  ID=lxc-www

  SRC=/var/www
  DIR=/BACKUP/www

  HOST=$(hostname)

  CPU=2

# --------------------------------------------

  touch $SRC/backup.flag

  NOW=$(date +%Y-%m)

  LOG=$DIR/log/$NOW.log

  mkdir -p $DIR/log

# --------------------------------------------

  echo ====== $(date +"%Y-%m-%d %H:%M:%S") >> $LOG

  time mksquashfs $SRC $DIR/$ID-$HOST-$NOW.sq \
         -comp lz4         \
         -Xhc              \
         -b 1m             \
         -processors $CPU  \
         -root-becomes ... | tee -a           $LOG

  echo ------ $(date +"%Y-%m-%d %H:%M:%S") >> $LOG

# --------------------------------------------

#-eof-#
