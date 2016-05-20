<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

$client = new Client();

$requests = function() {
    for ($i = 0; $i < 10; ++$i) {
        yield new Request('GET', 'http://localhost:8008/');
    }
};

foreach ($requests() as $request) {
    $response = $client->send($request);
    echo $response->getBody() . PHP_EOL;
}
