#!/bin/bash

verbose="${1}"

case $verbose in
  verbose|-v|--verbose) mysql -s -v -e "source zwookodb.sql;" -p -N;;
  *) mysql -s -e "source zwookodb.sql;" -p -N;;
esac
