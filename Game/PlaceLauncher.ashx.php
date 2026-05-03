<?php
http_response_code(200);
header('Content-Type: application/json');

$data = [
    'jobId' => 'Test',
    'status' => 2,
    'joinScriptUrl' => 'http://localhost/Game/Join.ashx',
    'authenticationUrl' => 'http://localhost/Login/Negotiate.ashx',
    'authenticationTicket' => 'SomeTicketThatDosentCrash',
    'message' => '',
];

echo json_encode($data);