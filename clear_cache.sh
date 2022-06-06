#!/bin/bash
FILES=var/logs/*
for f in $FILES
do
	echo "$(tail -1000 $f)" > $f
done