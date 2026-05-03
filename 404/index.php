<?php
$logFile = __DIR__ . '/404_log.txt';

$url = $_SERVER['REQUEST_URI'];
$ip = $_SERVER['REMOTE_ADDR'];
$time = date('Y-m-d H:i:s');
$method = $_SERVER['REQUEST_METHOD'];
$entry = "[$time] 404 - $method $url\n";
file_put_contents($logFile, $entry, FILE_APPEND);

http_response_code(404);

echo "ok u hit 404";
?>