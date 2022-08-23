#!/usr/bin/bash

for f in $(find -type f | egrep -v '.git');
do
  printf "$f\n"
  dos2unix $f
done
