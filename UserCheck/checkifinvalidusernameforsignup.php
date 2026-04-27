<?php
http_response_code(200);
header('Content-Type: application/json');

$username = $_POST['username'];

die('{"data":0}');