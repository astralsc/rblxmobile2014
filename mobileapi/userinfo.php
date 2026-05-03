<?php
http_response_code(200);
header('Content-Type: application/json');

$data = [
    "UserInfo" => [
        "UserID" => 1,
        "UserName" => "ROBLOX",
        "RobuxBalance" => 0,
        "TicketsBalance" => 0,
        "ThumbnailUrl" => "https://web.archive.org/web/20070808165254im_/http://t3.roblox.com:80/Avatar-100x100-83e75d04a99ca6e52c16a17cce5af580.Png",
        "IsAnyBuildersClubMember" => true
    ]
];

echo json_encode($data);