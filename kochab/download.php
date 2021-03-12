<?php
/*
 * %api {get} /download/:id Download bundle (temporary)
 * %apiName Download
 * %apiGroup Remote Update 
 * %apiDescription This is standard endpoint for download firmware   
 * %  
 * %apiSuccessExample Success-Response Download File:   
 * %   HTTP/1.1 200 OK
 * %   bundle_file 
 *
 * %apiErrorExample {json} Error-Response:
 *     HTTP/1.1 400 Not Found
 *     { 
 *     "error":"Not download"
 *     }
 */
require_once(__DIR__.'/../conf.php');
$response['error']= "Not download";
$response['path'] = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$response['query'] = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
if (isset($response['error']))
       http_response_code(400);
header("Content-type: application/json");
die(json_encode($response));
