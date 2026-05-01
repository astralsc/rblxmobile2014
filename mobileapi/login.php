<?php
http_response_code(200);
header('Content-Type: application/json');

include __DIR__ . '/../config/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $DBReq->prepare("SELECT id, password, token, robux, tickets FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    exit;
}
if (!password_verify($password, $user['password'])) {
    exit;
}

$newToken = bin2hex(random_bytes(32));
$stmt = $DBReq->prepare("UPDATE users SET token = ? WHERE id = ?");
$stmt->bind_param('si', $newToken, $user['id']);
$stmt->execute();
$stmt->close();

$expire = 2147483647; // expire when its the year 2038
setcookie('username', $username, $expire, '/', '', false, true);
setcookie('password', $password, $expire, '/', '', false, true);

$data = [
    "Status" => "OK",
    "UserInfo" => [
        "UserID" => $user['id'],
        "UserName" => $username,
        "RobuxBalance" => $user['robux'],
        "TicketsBalance" => $user['tickets'],
        "ThumbnailUrl" => null,
        "IsAnyBuildersClubMember" => false
    ]
];

echo json_encode($data);

exit;