#!/bin/bash
function check_command()
{
    ESISTE=$(which $1)
    if [ -z "$ESISTE" ]; then
        echo "Missing $1 command!"
        exit 1;
    fi 
    echo $ESISTE 
}

random_string()
{
    cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w ${1:-32} | head -n 1
}
# check i comandi 
BENHUR=$(check_command benhur)
JSONVALID="python3 -mjson.tool"
HTMLVALID=$(check_command tidy)
CURL=$(check_command curl)
SREC_INFO=$(check_command srec_info)
LOREM=$(check_command lorem)
TESTJS="nodejs ./js/puppeteer.js"
JQ=$(check_command jq)
KOCHAB_URL="http://ktulu:82/"



