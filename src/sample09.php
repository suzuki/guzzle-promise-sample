<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

$client = new Client();

$requests = function() {
    for ($i = 0; $i < 10; ++$i) {
        yield new Request('GET', 'http://localhost:8008/');
    }
};

$pool = new Pool($client, $requests(), [
    'concurrency' => 5,
    'fulfilled' => function(ResponseInterface $response, $index) {
        echo $response->getBody() . PHP_EOL;
    },
]);

$promise = $pool->promise();
$promise->wait();