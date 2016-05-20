<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Psr\Http\Message\ResponseInterface;

$client = new Client();

$promises = [];
for ($i = 0; $i < 10; ++$i) {
    $promise = $client->requestAsync(
        'GET',
        'http://localhost:8008/'
    );
    $promise
        ->then(function(ResponseInterface $response) {
            echo $response->getBody() . PHP_EOL;
        })
        ;
    $promises[] = $promise;
}

Promise\all($promises)->wait();
