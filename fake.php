<?php
$response = null ;
$dir='./bundle/';
// gestione delete 

$file_hash='';
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] == 'HEAD') {
    http_response_code(405);
    die();
}

if (isset($_SERVER['REQUEST_URI'])) {
    $file_hash = basename(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
    error_log($file_hash);
}

if (strlen($file_hash)==128) {
    if (file_exists($dir.$file_hash)) {
        unlink($dir.$file_hash);
        $response['info']= "delete firmware $file_hash";
    } else {
        http_response_code(409);
        $response['warning']= "Not exists firmware $file_hash";
    }
} else {
    if(!isset($_FILES['description'])) {
        http_response_code(400);
        $response['error']= "Missing upload json release file";
    } else {
        if(!isset($_FILES['firmware'])) {
            http_response_code(400);
            $response['error']= "Missing upload firmware";
        } else {
            $file_hash = hash('sha512',file_get_contents($_FILES['firmware']['tmp_name']));
            if (file_exists($dir.$file_hash)) {
                http_response_code(409);
                $response['warning']= "Exists firmware  $file_hash";
            } else {
                if (!file_exists($dir))
                    mkdir($dir);
                $file = fopen($dir.$file_hash, 'w');
                fclose($file);
                $response['info']='OK';
            }
        }
    }
}
header("Content-type: application/json");
die(json_encode($response));
