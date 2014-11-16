  <?php 
 
require_once 'guzzle/vendor/autoload.php';
die('asd');
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

$url = 'http://511656.miabook.web.hosting-test.net/app/index.php?r=api/login';
//$url = 'http://localhost/callboard/app/index.php?r=api/login';
die('asd');
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

echo ($response->getBody());



