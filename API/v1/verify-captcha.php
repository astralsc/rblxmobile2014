<?php
http_response_code(200);
header('Content-Type: application/json');

$data = [
    'success' => true,
    'msg' => 'Captcha Verified!',
    'data' => [
        'token' => 'test',
    ]
];

echo json_encode($data);