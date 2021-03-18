<?php

require_once'setup.php';

use GuzzleHttp\Exception\GuzzleException;

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://api.jokes.one'          //uniform resource indicator
]);

try {
    $response = $client->get('/jod');
    $resposeData = $response->getBody()->getContents();
    $decodedResponse = json_decode($resposeData);

    $retrieveJoke = $decodedResponse->contents->jokes[0]->joke->text;
    echo $retrieveJoke;
}
catch (GuzzleException $e){
    echo 'Error: '. $e->getMessage;
}