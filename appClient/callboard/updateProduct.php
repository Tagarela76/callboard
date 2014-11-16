<?php 

require_once 'guzzle/vendor/autoload.php';

use \GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

$url = 'http://511656.miabook.web.hosting-test.net/app/index.php?r=api/login';
//$url = 'http://localhost/callboard/app/index.php?r=api/login';

$client = new Client();

$authForm = array(
    'email' => 'DisidentD@mail.ru',
    'pass' => 'developer',
);

try {
    $response = $client->post($url,array('body' => $authForm));
} catch (ClientException $e) {
    $response = $e->getResponse();
} catch (ServerException $e) {
    $response = $e->getResponse();
}
$data = json_decode($response->getBody());
if($data->status != 200){
    echo $data->message;
    die();
}

$token = $data->data->token;

//$url2 = 'http://localhost/callboard/app/index.php?r=api/updateProduct';
$url = 'http://511656.miabook.web.hosting-test.net/app/index.php?r=api/updateProduct';

//SEND IMAGE
$imageData=file_get_contents('update.jpg');
$encodedImageData=base64_encode($imageData);
 
$data = array(
    'token' => $token,
    'productName' => 'RestProductUpdate',
    'productPrice'=> 1200,
    'productImage' => $encodedImageData,
    'imageName' => 'update.jpg',
    'productId' => 25
);

try {
    $response = $client->post($url,array('body' => $data));
} catch (ClientException $e) {
    $response = $e->getResponse();
} catch (ServerException $e) {
    $response = $e->getResponse();
}

echo 'Server response: ';
echo($response->getBody()).'<br>';
$data = json_decode($response->getBody());
echo ' Message: '.($data->message).'<br>';
if(!is_null($data->data)){
    echo ' Product Id: '.$data->data->productId;
}



