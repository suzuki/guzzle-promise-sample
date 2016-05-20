<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

$client = new Client();
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
    $promise->wait();
}
