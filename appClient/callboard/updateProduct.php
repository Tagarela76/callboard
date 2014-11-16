  <?php 
 
require_once 'guzzle/vendor/autoload.php';

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

//$url = 'http://localhost/callboard/app/index.php?r=api/login';
$url = 'http://511656.miabook.web.hosting-test.net/app/index.php?r=api/login';

$client = new Client($url);

$authForm = array(
    'email' => 'DisidentD@mail.ru',
    'pass' => 'developer',
);
$request = $client->post('', array(), $authForm);

try {
    $response = $request->send();
} catch (ClientErrorResponseException $e) {
    $response = $e->getResponse();
}

$data = json_decode($response->getBody());
$data = $data->data;
$token = $data->token;

//$url2 = 'http://localhost/callboard/app/index.php?r=api/updateProduct';
$url2 = 'http://511656.miabook.web.hosting-test.net/app/index.php?r=api/updateProduct';
$client2 = new Client($url2);

//SEND IMAGE
$imageData=file_get_contents('update.jpg');
$encodedImageData=base64_encode($imageData);
 
$data = array(
    'token' => $token,
    'productName' => 'RestProductUpdate',
    'productPrice'=> 1200,
    'productImage' => $encodedImageData,
    'imageName' => 'update.jpg',
    'productId' => 12
);
$request = $client2->post('', array(), $data);

try {
    $response = $request->send();
} catch (ClientErrorResponseException $e) {
    $response = $e->getResponse();
}
echo 'Server response: ';
echo($response->getBody());
$data = json_decode($response->getBody());
$data = $data->message;
echo ' Message: '.($data);



