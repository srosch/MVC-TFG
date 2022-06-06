#!/usr/bin/env bash
if [ -d "$1" ]; then
    mongorestore --db mvc $1
else
	echo Error not exist data folder
fi
