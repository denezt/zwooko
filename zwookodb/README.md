# ZwookoDB - Zwooko Database

## This is Repository will maintain the Database Schema and Data.

### Requirements
* Ubuntu Linux Distro 18.10 or higher, preferable 20.10
* mysql-server: Ver 8.0.28


# Initialize the Zwooko Database

``` sh
$ ./initialize.sh --verbose
# Next you will need to enter the MySQL Database password
Enter password:
```

``` sh
# The fixup script is for change all files to Unix LF
$ ./fixup.sh
```
