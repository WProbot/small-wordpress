#
# innodb.awk
#
# v1.0
#

  /ENGINE=MyISAM/ {
    gsub("ENGINE=MyISAM", "ENGINE=InnoDB");
  }


  1 {
    print $0;
  }


#-eof-#
