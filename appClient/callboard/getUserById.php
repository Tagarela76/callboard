  <?php 
 
require_once 'guzzle/vendor/autoload.php';

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

$url = 'http://localhost/callboard/app/index.php?r=api/getUserById';

$client = new Client($url);

$data = array(
    'userId' => 11,
);

$request = $client->post('', array(), $data);

try {
    $response = $request->send();
} catch (ClientErrorResponseException $e) {
    $response = $e->getResponse();
}

echo $response->getBody();

die();



