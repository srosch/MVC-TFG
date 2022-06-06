#!/usr/bin/env bash

if [ -d "./data" ]; then
    mongorestore --db mvc ./data
else
	echo Error not exist data folder
fi
