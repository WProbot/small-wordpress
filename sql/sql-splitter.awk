#
# sql-splitter.awk
#
# v1.0
#


  BEGIN {
    table = "sqlheader";
    tablen = 1000;
    system("mkdir -p out");
  }


  /Table structure for table `/ {
    tablen++;
    table = $6;
    gsub("`", "", table)
  }


  1 {
    of = "out/" tablen "-" table ".sql";
    print $0 > of;
  }


#-eof-#
