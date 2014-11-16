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

//$url2 = 'http://localhost/callboard/app/index.php?r=api/createProduct';
$url2 = 'http://511656.miabook.web.hosting-test.net/app/index.php?r=api/createProduct';

//SEND IMAGE
$imageData=file_get_contents('test.jpg');
$encodedImageData=base64_encode($imageData);
 
$data = array(
    'token' => $token,
    'productName' => 'RestProduct',
    'productPrice'=> 1000,
    'productImage' => $encodedImageData,
    'imageName' => 'create.jpg'
);

try {
    $response = $client->post($url2,array('body' => $data));
    
} catch (ClientException $e) {
    $response = $e->getResponse();
} catch (ServerException $e) {
    $response = $e->getResponse();
}

echo 'Server response: ';
echo($response->getBody());
$data = json_decode($response->getBody());
echo ' Message: '.($data->message);
if(!is_null($data->data)){
    echo ' Product Id: '.$data->data->productId;
}




