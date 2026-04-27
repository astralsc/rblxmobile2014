<?php
http_response_code(200);
header('Content-Type: application/json');

$password = $_POST['password'];
$username = $_POST['username'];

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

die(json_encode($data));