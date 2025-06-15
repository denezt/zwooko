#!/bin/bash

printf "Change current 'root' password? Are you sure? [y|yes]\n"
read confirm
case $confirm in
	y|yes) mysql_secure_installation;;
	*) printf "Current, secure password left unchanged!\n";;
esac

printf "Add a user for zwooko. Are you sure? [y|yes]\n"
read confirm2
case $confirm2 in
	y|yes)
	printf "Enter your Zwooko username: "
	read _username
	printf "Enter your Zwooko password: "
	read _password
	printf "Enter 'superuser' password for database:\n"
	mysql -h localhost -u root -e "CREATE USER '${_username}'@'localhost' IDENTIFIED BY '${_password}';" -p
	;;
esac

printf "Add a user access to zwooko. Are you sure? [y|yes]\n"
read confirm3
case $confirm3 in
	y|yes) mysql -h localhost -u root -e "GRANT ALL PRIVILEGES ON zwookodb.* TO 'zwooko'@'localhost';FLUSH PRIVILEGES;" -p;;
esac
