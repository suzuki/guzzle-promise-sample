<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

$client = new Client();

$requests = function() {
    for ($i = 0; $i < 10000; ++$i) {
        yield new Request('GET', 'http://localhost:8008/');
    }
};

$pool = new Pool($client, $requests(), [
    'concurrency' => 1000,
    'fulfilled' => function(ResponseInterface $response, $index) {
        echo sprintf("%5d: %s\n", $index, $response->getBody());
    },
]);

$promise = $pool->promise();
$promise->wait();
