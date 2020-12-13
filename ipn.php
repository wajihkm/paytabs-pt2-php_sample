<?php

/**
 * Should be used as a Server-To-Server call
 * Must return a respnse code (200) that indicates receiving the response successfully
 * 
 * Note:
 * Make sure in this sample to give the write permission to "paytabs_ipn.log" file
 */

$request_body = file_get_contents('php://input');

$log_msg = date('c') . ' ' . $request_body . PHP_EOL;
file_put_contents('storage/paytabs_ipn.log', $log_msg, FILE_APPEND);
