<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'error' => 'Method not allowed']);
    die;
}

$body = json_decode(file_get_contents('php://input'), true);

if (!is_array($body)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'error' => 'Invalid request body']);
    die;
}

$required = ['firstName', 'lastName', 'phone', 'email'];

foreach ($required as $field) {
    if (empty($body[$field])) {
        http_response_code(422);
        echo json_encode(['status' => false, 'error' => "Field '{$field}' is required"]);
        die;
    }
}
//Get user ip
$ip = $_SERVER['REMOTE_ADDR'];

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

$config = new Config(__DIR__ . '/../.env');
$client = new CrmApiClient($config);

$response = $client->addLead([
    'firstName'  => $body['firstName'],
    'lastName'   => $body['lastName'],
    'phone'      => $body['phone'],
    'email'      => $body['email'],
    'ip'         => $ip,
    'landingUrl' => $_SERVER['HTTP_HOST']

]);

http_response_code($response['status'] === true ? 200 : 400);
echo json_encode($response);
