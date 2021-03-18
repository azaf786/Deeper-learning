<?php

$ch = curl_init(); //initialises the curl
curl_setopt($ch, CURLOPT_URL, 'https://api.jokes.one/jod');
curl_setopt($ch, CURLOPT_RETURNTRANSFER,  1); // returns something back ie true

$response = curl_exec($ch);
curl_close($ch);

$decoded = json_decode($response);
var_dump($decoded);
$joke = $decoded->contents->jokes[0]->joke->text;

echo nl2br($joke); //

