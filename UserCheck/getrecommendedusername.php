<?php
http_response_code(200);
header('Content-Type: application/json');

$usernameToTry = $_GET['usernameToTry'];

die($usernameToTry);