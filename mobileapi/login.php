<?php
http_response_code(200);
header('Content-Type: application/json');

$username = $_POST['username'];
$password = $_POST['password'];

$data = [
    "Status" => "OK",
    "UserInfo" => [
        "UserName" => $username,
        "RobuxBalance" => 0,
        "TicketsBalance" => 0,
        "IsAnyBuildersClubMember" => false,
        "ThumbnailUrl" => null,
        "UserID" => 1
    ]
];

echo json_encode($data);