#!/bin/bash/env bats
# CONFIGURAZIONI 
load config
NOME="AWS"
TEMP=/tmp/aws/
FAKEFILE=release.json
#
@test "$NOME Prepare Environment" {
# controllo se esiste cartella 
if [ ! -d "$TEMP" ]; then
    mkdir $TEMP    
else
    # rimozione preventiva dei file dell'esecuzione precedente
    rm -f $TEMP*
fi
lorem > $TEMP$FAKEFILE

[[ "$status" -eq 0 ]]
}

@test "$NOME Pubblica" {
cd $TEMP
PAGINA=$KOCHAB_URL"fake.php"
OUTPUT="pubblica.json"
OUTPUT_CODE="$OUTPUT.code"
$CURL -s -w "%{http_code}" $PAGINA  -F "description=@/$TEMP$FAKEFILE"  -F "firmware=@/$TEMP$FAKEFILE" --output $OUTPUT  > $OUTPUT_CODE
if [ "$?" -eq "0" ]; then
    HTTP_CODE=$(cat $OUTPUT_CODE)
    if [ "$HTTP_CODE" -eq "200" ]  || [ "$HTTP_CODE" -eq "409" ];then
        $JSONVALID $OUTPUT
    else
        status=1
    fi
fi
CODE=$(cat $OUTPUT_CODE)
MESSAGGIO=$(cat $OUTPUT)
echo -e "Http Code:$CODE\n${MESSAGGIO}\n"
[[ "$status" -eq 0 ]]
}

@test "$NOME Cancella" {
cd $TEMP
PAGINA=$KOCHAB_URL"fake.php/"
FILE_HASH=$(sha512sum $TEMP$FAKEFILE)
OUTPUT="delete.json"
OUTPUT_CODE="$OUTPUT.code"
$CURL  -s -f  -w "%{http_code}" $PAGINA$FILE_HASH --output $OUTPUT  > $OUTPUT_CODE
if [ "$?" -eq "0" ]; then
    HTTP_CODE=$(cat $OUTPUT_CODE)
    if [ "$HTTP_CODE" -eq "200" ]  || [ "$HTTP_CODE" -eq "409" ];then
        $JSONVALID $OUTPUT
    else
        status=1
    fi
fi
CODE=$(cat $OUTPUT_CODE)
MESSAGGIO=$(cat $OUTPUT)
echo -e "Http Code:$CODE\n${MESSAGGIO}\n"
[[ "$status" -eq 0 ]]
}
