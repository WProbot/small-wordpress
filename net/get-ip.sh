#!/bin/bash

  dig @ns1.google.com o-o.myaddr.l.google.com TXT -4 +short
  
  dig +short myip.opendns.com @resolver1.opendns.com
    