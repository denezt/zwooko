#!/bin/bash

query_content(){
	query="${1}"
	target_file="${2}"
	if [ "$query" ];
	then
		grep -iw --color "${query}" "${target_file}"
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

for argv in ${@};
do
	case $argv in
		--action=*|action:*) _action=$(extract_value $argv);;
		--term=*|term:*) term=$(extract_value $argv);;
		*) printf "$argv\n";;
	esac
done

case $_action in
	'search') get_untracked_files "${term}";;
esac