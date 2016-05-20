<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request(
    'GET',
    'http://localhost:8008/'
);

echo $response->getBody() . PHP_EOL;
