#!/bin/bash

  PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin

  cd /var/www/_log

  wget -T 3 -t 2 -S -o wget.log https://domain.tld/?s=e -O wget.html

  gawk '

    /wget.*saved/ {
      OK++;
      print $0 >> "ok.log";
    }

    END {
      if(1 > OK) {
        print strftime("%Y-%m-%d %H:%M:%S") >> "error.log";
        system("wo stack restart --nginx");
      }
    }

  ' wget.log
