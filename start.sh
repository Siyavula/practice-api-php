#!/bin/bash
red=`tput setaf 1`
green=`tput setaf 2`
yellow=`tput setaf 3`
reset=`tput sgr0`

# Add environment variables
source my.env

echo "${yellow}Starting question_api_php${reset}"
echo "${yellow}Go to http://localhost:8001/responsive.php or http://localhost:8001/basic.php${reset}"
php -S localhost:8001