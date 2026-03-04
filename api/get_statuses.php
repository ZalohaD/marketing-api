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
    $body = [];
}

$filters = [
    'page'  => isset($body['page'])  ? (int) $body['page']  : 0,
    'limit' => isset($body['limit']) ? (int) $body['limit'] : 100,
];


if (!empty($body['date_from'])) {
    $filters['date_from'] = $body['date_from'];
}



if (!empty($body['date_to'])) {
    $filters['date_to'] = $body['date_to'];
}

$config = new Config(__DIR__ . '/../.env');
$client = new CrmApiClient($config);

$response = $client->getStatuses($filters);

http_response_code($response['status'] === true ? 200 : 400);

echo json_encode($response);
