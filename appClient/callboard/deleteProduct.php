<?php

require_once 'guzzle/vendor/autoload.php';

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

$url = 'http://localhost/callboard/app/index.php?r=api/login';

$client = new Client($url);

$authForm = array(
    'email' => 'denis.kv@kttsoft.com',
    'pass' => 'developer',
);
$request = $client->post('', array(), $authForm);

try {
    $response = $request->send();
} catch (ClientErrorResponseException $e) {
    $response = $e->getResponse();
}

$data = json_decode($response->getBody());
$token = ($data->data->token);
//update user
$url2 = 'http://localhost/callboard/app/index.php?r=api/deleteProductById';

$client2 = new Client($url2);

$data = array(
    'token' => $token,
    'productId'=>9
);

$request = $client2->post('', array(), $data);

try {
    $response = $request->send();
} catch (ClientErrorResponseException $e) {
    $response = $e->getResponse();
}

echo ($response->getBody());

