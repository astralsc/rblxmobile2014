<?php
http_response_code(200);
header('Content-Type: application/json');

$data = [
    "data" => [
        "UpgradeAction" => "None"
    ]
];

echo json_encode($data);