<?php
/*
$response = null ;
 (isset($_SERVER['REQUEST_URI'])) {
    $file_hash = basename(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
    error_log($file_hash);
}
*/
header("Content-type: application/xml");
$risponsa= <<<EOD
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<ns2:firmwareResponse xmlns:ns2="http://www.fatspaniel.net/ws/fwupdate/">
<status>SUCCESS</status>
<approvedFirmware>true</approvedFirmware>
</ns2:firmwareResponse>
EOD;
echo $risponsa;
