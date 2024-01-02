#!/bin/bash

query_content(){
	query="${1}"
	target_file="${2}"
	if [ -n "$query" ];
	then
		grep -i --color "${query}" "${target_file}"
	fi
}

get_untracked_files(){
	search_term=${1}
	for f in $(git status --untracked-files --short | awk '{print $2}');
	do
		if [ -e "${f}" ];
		then
			printf "$f\n";
			query_content "${search_term}" "${f}"
		fi
	done
}

extract_value(){
	input=${1}
	results=$(echo $input | cut -d':' -f2  | cut -d'=' -f2 )
	echo "${results}"
}

usage(){
	printf "\033[36mUSAGE:\033[0m\n"
	printf "\033[35m$0 \033[32m--action=COMMAND --term=SEARCH_WORD\033[0m\n"
}

commands(){
	printf "\033[36mCOMMANDS:\033[0m\n"
	printf "\033[35mSearch for changes\t\033[32m[ search, scan ]\033[0m\n"
}

help_menu(){
	printf "\033[36mHelp Menu\033[0m\n"
	printf "\033[35mExecute Action\t\033[32m[ action:{COMMAND}, --action={COMMAND} ]\033[0m\n"
	echo;
	commands
	echo;
	usage
	exit 0
}

for argv in ${@};
do
	case $argv in
		--action=*|action:*) _action=$(extract_value $argv);;
		--term=*|term:*) term=$(extract_value $argv);;
		*) help_menu;;
	esac
done

case $_action in
	'search'|'scan'|'find') get_untracked_files "${term}";;
esac