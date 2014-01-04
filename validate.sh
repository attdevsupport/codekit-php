#!/bin/bash

# Basic script to wrap commands for validating PHP lib code

echo 'Validating php code...'

# php unit
which phpunit >/dev/null 2>&1
if [ "$?" -eq 0 ]; then
	echo 'Performing unit tests...'
	phpunit tests 
else
	echo 'Unable to find phpunit command' >&2
fi

# pear convention
which phpcs >/dev/null 2>&1
if [ "$?" -eq 0 ]; then
	echo 'PEAR convention check...'
	phpcs lib 
else
	echo 'Unable to find phpcs command' >&2
fi

# code analysis
which phpmd >/dev/null 2>&1
if [ "$?" -eq 0 ]; then
	echo 'Performing code analysis...'
	phpmd lib text naming,unusedcode,codesize,design 
else
	echo 'Unable to find phpmd command' >&2
fi
