#!/bin/bash

#
# all-pull.sh
#

  cd

  find . | gawk '

      /[/][.]git$/ && !_[$0]++ {
        gsub("[/][.]git$", "");
        print "echo === $(date +%Y%n%d-%H%M%S)", $0;
        print "cd", $0;
        print "git pull";
        print "cd";
      }

  ' | bash | tee -a pull.log

#-#
