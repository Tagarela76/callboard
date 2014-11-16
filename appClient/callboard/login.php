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

echo 'Server response: '.$response->getBody()."<br>";
$data = json_decode($response->getBody());
echo 'Status code: '.$data->status."<br>";
echo 'Server Message: '.$data->message.'<br>';
if(!is_null($data->data)){
    echo 'token: '.$data->data->token;
}


