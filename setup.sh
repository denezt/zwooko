#!/bin/bash

DB_TEMPL='zwooko/model/template.database.php'
DB_SCRIPT='zwooko/model/database.php'

printf "Enter Database Hostname:\n"
read _hostname
case $_hostname in
  q|quit) printf "Exiting, setup script.\n"; exit 0;;
  *) sed "s|%HOSTNAME%|${_hostname}|g" zwooko/model/template.database.php | tee $DB_SCRIPT;;
esac

printf "Enter Database Username:\n"
read _username
case $_username in
  q|quit) printf "Exiting, setup script.\n"; exit 0;;
  *) sed -i "s|%USERNAME%|${_username}|g" $DB_SCRIPT;;
esac

printf "Enter Database Password:\n"
read -s _password
case $_password in
  q|quit) printf "Exiting, setup script.\n"; exit 0;;
  *) printf "Password Length: ${#_password}\n"
  sed -i "s|%PASSWORD%|${_password}|g" $DB_SCRIPT
  ;;
esac
