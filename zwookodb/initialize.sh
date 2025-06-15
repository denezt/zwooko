#!/bin/bash
# Initialize Script

error(){
	printf "\033[35mError:\t\033[31m${1}\033[0m\n"
	exit 1
}

commands(){
	printf "\033[36mCOMMANDS:\033[0m\n"
	printf "\033[35mStart Initializer\t\033[32m[ init, run, start]\033[0m\n"
}

usage(){
	printf "\033[36mUSAGE:\033[0m\n"
	printf "\033[34m# Start the initializer\033[0m\n"
	printf "\033[35m$0 \033[32m--action=\033[33minitialize\033[0m\n"
	printf "\033[34m# Show Help Menu\033[0m\n"
	printf "\033[35m$0 \033[32m--help\033[0m\n"
}

help_menu(){
	printf "\033[36mInitialize Database with Data\033[0m\n"
	printf "\033[35mExecute Action\t\033[32m[ --action=[COMMAND], action:[COMMAND] ]\033[0m\n"
	printf "\033[35mHelp Menu\t\033[32m[ -h, --help ]\033[0m\n"
	printf "\n"
	commands
	printf "\n"
	usage
	exit 0
}

for argv in $@
do
	case $argv in
		--action=*|action:*) _exec=$(echo "${argv}" | cut -d':' -f2 | cut -d'=' -f2);;
		-v|--verbose) verbose="-v";;
		-h|--help) help_menu;;
	esac
done

case ${_exec} in
	start|run|init) mysql "${verbose}" -s -e "source zwookodb.sql;" -p -N;;
	*) error "Missing or invalid parameter was given";;
esac
