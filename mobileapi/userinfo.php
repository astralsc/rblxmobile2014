<?php
http_response_code(200);
header('Content-Type: application/json');

$data = [
    "UserInfo" => [
        "UserID" => 1,
        "UserName" => "ROBLOX",
        "RobuxBalance" => 0,
        "TicketsBalance" => 0,
        "ThumbnailUrl" => null,
        "IsAnyBuildersClubMember" => true
    ]
];

echo json_encode($data);