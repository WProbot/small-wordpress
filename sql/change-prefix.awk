#
# change-predix.awk
#
# v1.0
#

/cdn_7_/ {
  gsub("cdn_7_", "wp_");
}

/cdn_/ {
  gsub("cdn_", "wp_");
}

1 {
  print $0;
}

