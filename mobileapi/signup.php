<?php
http_response_code(200);
header('Content-Type: application/json');

include __DIR__ . '/../config/db.php';

$username = $_POST['userName'] ?? '';
$password = $_POST['password'] ?? '';
$gender = $_POST['gender'] ?? '';
$email = "";
$robux = 0;
$tickets = 0;

$dateOfBirth = null;
if (!empty($_POST['dateOfBirth'])) {
    $parsedDate = DateTime::createFromFormat('m/d/Y', $_POST['dateOfBirth'])
               ?? DateTime::createFromFormat('n/j/Y', $_POST['dateOfBirth']);
    if ($parsedDate) {
        $dateOfBirth = $parsedDate->format('Y-m-d');
    }
}
$stmt = $DBReq->prepare("SELECT id FROM users WHERE email = ? OR username = ? LIMIT 1");
if (!$stmt) {
    exit;
}
$stmt->bind_param('ss', $email, $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt->close();
    exit;
}
$stmt->close();
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$token = bin2hex(random_bytes(32));
$createdAt = date('Y-m-d H:i:s');
$stmt = $DBReq->prepare(
    "INSERT INTO users (username, email, `password`, date_of_birth, gender, token, robux, tickets, created_at) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);
if (!$stmt) {
    exit;
}
$stmt->bind_param('ssssssiis', $username, $email, $hashedPassword, $dateOfBirth, $gender, $token, $robux, $tickets, $createdAt);
if (!$stmt->execute()) {
    $stmt->close();
    exit;
}

$newUserId = $DBReq->insert_id;
$stmt->close();

$expire = 2147483647; // expire when its the year 2038
setcookie('username', $username, $expire, '/', '', false, true);
setcookie('password', $password, $expire, '/', '', false, true);

$data = [
    "Status" => "OK",
    "UserInfo" => [
        "UserID" => $newUserId,
        "UserName" => $username,
        "RobuxBalance" => $robux,
        "TicketsBalance" => $tickets,
        "ThumbnailUrl" => null,
        "IsAnyBuildersClubMember" => false
    ]
];

echo json_encode($data);

exit;