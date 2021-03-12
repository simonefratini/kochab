<?php
$response['components'][]['firmware_family_id']='PVS-15.0';
$response['components'][]['firmware_family_id']='PVS-20.0';
$response['components'][]['firmware_family_id']='PVS-33.0';
header("Content-type: application/json");
die(json_encode($response));
