  <?php 
 
require_once 'guzzle/vendor/autoload.php';

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

$url = 'http://localhost/callboard/app/index.php?r=api/getAllProductList';

$client = new Client($url);

$request = $client->post('', array(), array());

try {
    $response = $request->send();
} catch (ClientErrorResponseException $e) {
    $response = $e->getResponse();
}

$body = json_decode($response->getBody());
header("Content-Type: text/html; charset=utf-8");

var_dump($body->data->productList);



