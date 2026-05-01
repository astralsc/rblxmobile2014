<?php
http_response_code(200);
header('Content-Type: application/json');

$password = $_POST['password'];
$username = $_POST['username'];

die('{"success": true}');